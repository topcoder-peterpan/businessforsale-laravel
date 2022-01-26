<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Messenger;
use App\Notifications\NewMessageNotification;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MessangerController extends Controller
{
    /**
     * Messenger
     *
     * @param String $username
     * @return View
     */
    public function index($username = null)
    {
        $data['messages'] = [];
        $data['user'] = auth()->user();

        $users = Messenger::join('customers',  function ($join) {
            $join->on('messengers.from_id', '=', 'customers.id')
                ->orOn('messengers.to_id', '=', 'customers.id');
        })
            ->where(function ($q) {
                $q->where('messengers.from_id', Auth::user()->id)
                    ->orWhere('messengers.to_id', Auth::user()->id);
            })
            ->orderBy('messengers.created_at', 'desc')
            ->select('customers.id as id', 'customers.name', 'customers.username', 'customers.image',)
            ->get()
            ->unique('id');

        $data['users'] = $users->where('id', '!=', Auth::user()->id);
        $data['selected_user'] =  Customer::where('username', $username)->first();

        if ($data['selected_user']) {
            $data['messages'] = $this->getMessages($data['selected_user']);
        }

        return view('frontend.messenger.index', $data);
    }



    /**
     * Get selected user messages
     *
     * @param App\Models\Customer $user
     * @return Collection
     */
    public function getMessages($user)
    {
        $id = $user->id;
        return Messenger::where(function ($query) use ($id) {
            $query->where(function ($q) use ($id) {
                $q->where('from_id', auth()->id());
                $q->where('to_id', $id);
            })
                ->orWhere(function ($q) use ($id) {
                    $q->where('to_id', auth()->id());
                    $q->where('from_id', $id);
                });
        })
            ->where('body', '!=', '.')
            ->latest()
            ->get();
    }



    /**
     * Send message to user
     *
     * @param Request $request
     * @param String $username
     * @return void

     */
    public function sendMessage(Request $request, $username)
    {
        $request->validate([
            'body'      =>  ['required',],
        ]);

        $user = Customer::where('username', $username)->firstOrFail();

        if($user->id === auth()->user()->id){
            return redirect()->route('frontend.message', $user->username);
        }

        if (!$this->checkMessageLists($user->id)) {
            $message = Messenger::create([
                'from_id'   =>  auth()->id(),
                'to_id'     =>  $user->id,
                'body'      =>  '.',
            ]);

            return redirect()->route('frontend.message', $user->username);
        }

        $message = Messenger::create([
            'from_id'   =>  auth()->id(),
            'to_id'     =>  $user->id,
            'body'      =>  $request->body,
        ]);

        $user->notify(new NewMessageNotification($message, auth()->user()));

        return redirect()->route('frontend.message', $user->username);
    }




    /**
     * Check is already in message lists
     *
     * @param init  $id
     * @return bool
     */
    public function checkMessageLists($id)
    {
        return (bool) Messenger::where(function ($query) use ($id) {
            $query->where(function ($q) use ($id) {
                $q->where('from_id', auth()->id());
                $q->where('to_id', $id);
            })
                ->orWhere(function ($q) use ($id) {
                    $q->where('to_id', auth()->id());
                    $q->where('from_id', $id);
                });
        })
            ->count();
    }
}
