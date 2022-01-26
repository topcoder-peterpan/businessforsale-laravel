<div>
    <!-- Comment Box  -->
    <div class="single-blog__comment-box">
        <h2 class="text--body-1-600 title">{{ __('website.leave_comments') }}</h2>
        <form wire:submit.prevent="storeComment">
            @if (!auth('customer')->check())
            <div class="input-field__group">
                <div class="input-field">
                    <label for="name">{{ __('website.full_name') }}</label>
                    <input required type="text" id="name" wire:model.defer="name" autocomplete="off" class="@error('name') is-invalid border-danger @enderror" placeholder="{{ __('website.full_name') }}" />
                    @error('name') <span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="input-field">
                    <label for="email">{{ __('website.email') }}</label>
                    <input required type="email" wire:model.defer="email" autocomplete="off" class=" @error('email') is-invalid border-danger @enderror" placeholder="{{ __('website.email_address') }}" id="email" />
                    @error('email') <span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>
            @endif
            <div class="input-field--textarea">
                <label for="comments">{{ __('website.comments') }}</label>
                <textarea required wire:model.defer="body" autocomplete="off" class=" @error('body') is-invalid border-danger @enderror" placeholder="What’s your thought..." id="comments"></textarea>
                @error('body') <span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <button onclick="countComments('{{ $post_id }}')" type="submit" class="btn">{{ __('website.comment') }}</button>
        </form>
    </div>

    <!-- User comments -->
    <div class="single-blog__user-comments">
        <h2 class="text--body-1 title">{{ __('website.comments') }}</h2>
        @if ($comments->count() > 0)
            <div class="user-comments">
                @if ($total != 0)
                    <div class="comments-area-content">
                        @foreach ($comments as $comment)
                        <div class="user-comments__item">
                            <div class="user-img">
                                <img src="{{ asset('backend/image/default.png') }}" alt="user-img">
                            </div>
                            <div class="user-info">
                                <h2 class="user-name text--body-4-600">{{ $comment->name }} <span class="date">{{ $comment->created_at->diffForHumans() }}</span></h2>
                                <p class="user-comments__text text--body-3">
                                    {{ $comment->body }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
                @if ($loadbutton && $total >= 5)
                    @if (count($comments) >= $total)
                        <div class="text-center">{{ __('website.no_more_comments_found') }}</div>
                    @else
                        @if ($loading)
                            <button wire:loading class="btn btn--bg">
                                {{ __('website.loading') }}
                                <span class="icon--right">
                                    <x-svg.sync-icon/>
                                </span>
                            </button>
                        @else
                            <button wire:click="load" wire:loading.remove class="btn btn--bg">
                                {{ __('website.load_more') }}
                                <span class="icon--right">
                                    <x-svg.sync-icon/>
                                </span>
                            </button>
                        @endif



                    @endif
                @endif
            </div>
        @else
            <div class="text-center">{{ __('website.no_more_comments_found') }}</div>
        @endif
    </div>
</div>
