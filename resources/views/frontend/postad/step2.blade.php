@extends('frontend.postad.index')

@section('title', __('website.step2'))

@section('post-ad-content')
 <!-- Step 02 -->
 <div class="tab-pane fade show active" id="pills-post" role="tabpanel" aria-labelledby="pills-post-tab">
    <div class="dashboard-post__ads step-information">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{ route('frontend.post.step2.store') }}" method="POST">
            @csrf
            <div class="input-field__group">
                <div class="input-field">
                    <label for="phoneNumber">Phone Number <span class="text-danger">*</span></label>
                    <input required name="phone" id="phoneNumber" type="tel" placeholder="Phone" value="{{ $ad->phone ?? '' }}" class="@error('phone') border-danger @enderror"/>
                </div>
                <div class="input-field">
                    <label for="backupPhone">Backup phone Number <span>(optional)</span> </label>
                    <input name="phone_2" id="backupPhone" type="tel" class="backupPhone" placeholder="Phone Number" value="{{ $ad->phone_2 ?? '' }}"/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-field__group">
                        <div class="input-select">
                            <label for="cityy">city</label>
                            <select required name="city_id" id="cityy" class="form-control select-bg @error('city_id') border-danger @enderror">
                                <option class="d-none" value="" selected>Select City</option>
                                @isset($ad->brand_id)
                                    @foreach ($citis as $city)
                                        <option {{ $city->id == $ad->city_id ? 'selected':'' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($citis as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="input-select">
                            <label for="townn">Town</label>
                            <select required name="town_id" id="townn" class="form-control select-bg @error('town_id') border-danger @enderror">
                                <option value="" hidden>Select Town</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-post__action-btns">
                <a href="{{ route('frontend.post.step1.back') }}" class="btn btn--lg btn--outline">
                    Previous
                </a>
                <button type="submit" class="btn btn--lg">
                    Next Step
                    <span class="icon--right">
                        <x-svg.right-arrow-icon />
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
