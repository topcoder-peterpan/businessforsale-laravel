@extends('frontend.postad.index')

@section('title')
    Edit Ad (Step-3) - {{ $ad->title }}
@endsection

@section('post-ad-content')
 <!-- Steop 03 -->
 <div class="tab-pane fade show active" id="pills-advance" role="tabpanel" aria-labelledby="pills-advance-tab">
    <div class="dashboard-post__step02 step-information">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('frontend.post.step3.update',$ad->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-field--textarea">
                <label for="description">{{ __('website.ad_description') }}</label>
                <textarea name="description" placeholder="{{ __('website.your_thought') }}..." id="description" class="@error('description') border-danger @enderror">{{ $ad->description }}</textarea>
            </div>
            <div class="input-field--textarea">
                <label for="feature">{{ __('website.feature') }} <span>({{ __('website.optional') }})</span> </label>
                <div id="multiple_feature_part">
                    <div class="row">
                        <div class="col-lg-10">
                             <div class="input-field">
                                 <input name="features[]" type="text" placeholder="Feature" id="adname" class="@error('title') border-danger @enderror"/>
                             </div>
                        </div>
                        <div class="col-lg-2 mt-10">
                         <a role="button" onclick="add_features_field()"
                         class="btn bg-primary btn-sm text-light"><i class="fas fa-plus"></i></a>
                        </div>
                     </div>
                    @foreach ($ad->features as $feature)
                        <div class="row">
                            <div class="col-lg-10">
                                    <div class="input-field">
                                        <input value="{{ $feature->name }}" name="features[]" type="text" placeholder="Feature" id="adname" class="@error('title') border-danger @enderror"/>
                                    </div>
                            </div>
                            <div class="col-lg-2 mt-10">
                                <button onclick="remove_single_field()" id="remove_item" class="btn btn-sm bg-danger text-light"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="upload-wrapper">
                <h3>{{ __('website.upload_photos') }}</h3>
                <div class="upload-area @error('images') border-danger @enderror">
                    <div class="uploaded-items">
                        @foreach ($ad->galleries as $gallery)
                            <div class="uploaded-item">
                                <img src="{{ asset($gallery->image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                    <div class="add-new">
                        <x-svg.image-select-icon />
                        <input name="images[]" multiple type="file" hidden id="addNew" accept="image/*">
                    </div>
                </div>
            </div>
            <div class="dashboard-post__ads-bottom">
                <div class="form-check">
                </div>
                <div class="dashboard-post__action-btns">
                    <a onclick="return confirm('Do you really want to go previous page? If you go then your step 3 data wont save!')" href="{{ route('frontend.post.step2.back',$ad->slug) }}" class="btn btn--lg btn--outline">
                        {{ __('website.previous') }}
                    </a>
                    <button type="submit" class="btn btn--lg">
                        {{ __('website.finish_update') }}
                        <span class="icon--right">
                            <x-svg.right-arrow-icon />
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('frontend_script')
<script>
    function add_features_field() {
        $("#multiple_feature_part").append(`
            <div class="row">
                <div class="col-lg-10">
                        <div class="input-field">
                            <input name="features[]" type="text" placeholder="Feature" id="adname" class="@error('title') border-danger @enderror"/>
                        </div>
                </div>
                <div class="col-lg-2 mt-10">
                    <button onclick="remove_single_field()" id="remove_item" class="btn btn-sm bg-danger text-light"><i class="fas fa-times"></i></button>
                </div>
            </div>
        `);
    }

    $(document).on("click", "#remove_item", function() {
        $(this).parent().parent('div').remove();
    });
</script>
<script>
// File Upload
const uploadArea = document.querySelector('.upload-area');
const uploadedItems = document.querySelector('.uploaded-items');
const input = document.querySelector('#addNew');
const inputButton = document.querySelector('.add-new');

// add new file
if (inputButton) {
    inputButton.addEventListener('click', (event) => {
        handleDragArea(true);
        input.click();
    });
}

// display file on file upload
if (input) {
    input.addEventListener('change', (event) => {
        let files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            displayFile(files[i]);
            handleDragArea(false);
        }
    });
}

// dragover event
if (uploadArea) {
    uploadArea.addEventListener('dragover', (event) => {
        handleDragArea(true);
        event.preventDefault();
    });
}

// dragleave event
if (uploadArea) {
    uploadArea.addEventListener('dragleave', (event) => {
        handleDragArea(false);
    });
}

// drop event
if (uploadArea) {
    uploadArea.addEventListener('drop', (event) => {
        event.preventDefault();
        let file = event.dataTransfer.files[0];
        displayFile(file);
    });
}

// Handle drag over and drag leave effect
function handleDragArea(param) {
    if (param == true) {
        uploadArea.classList.add('active');
    } else {
        uploadArea.classList.remove('active');
    }
}

// display uploadedFile
function displayFile(file) {
    let fileType = file.type;
    let validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
    let fileURL;

    if (validExtensions.includes(fileType)) {
        let fileReader = new FileReader();

        fileReader.onload = () => {
            fileURL = fileReader.result;
            addNewfile(fileURL);
        };
        fileReader.readAsDataURL(file);
    } else {
        alert('File type not supported');
        handleDragArea(false);
    }
}

// Append New File in HTML
function addNewfile(file) {
    let imgTag = `
    <div class="uploaded-item">
        <img src="${file}" alt="">
        <div class="remove-icon">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </div>
    </div>`;
    uploadedItems.insertAdjacentHTML('beforeend', imgTag);
}

$(document).on('click', '.remove-icon', function () {
    $(this).closest('.uploaded-item').remove()
});
</script>
@endsection
