@extends('layout.main')

@section('content')
{{-- @foreach ($errors->all() as $error)
                    {{ $error }}<br/>
@endforeach --}}
@error('phone_number')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

@if($errors->any())
   <ul class="alert alert-danger">
      @foreach ($errors->all() as $error)
           <li >{{ $error }}</li>
       @endforeach
    </ul>
@endif 


<form action='{{ route('profile.edit', ['id' => Auth::user()->id_user]) }}' method="post"  enctype="multipart/form-data">
    @csrf
    @method('put')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-lg-6">
        <!--begin::Card-->										
        <div class="card mb-5 h-lg-100">
            <!--begin::Card body-->
            <div class="card-body card-p">
                <img class="card-background-right d-none d-sm-none d-md-block img-fluid" src="{{ asset('media/png/user-card.png') }}" alt="">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between ">
                            <div class="fs-4 fw-bold text-gray-400 mb-7 ">User</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="image-input image-input-outline me-6" data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            @if(!(Auth::user()->photo_url))
                                <div class="image-input-wrapper w-125px rounded-circle h-125px" style="background-image: url({{ asset('/media/png/avatar-default.png') }})"></div>
                           
                            @else
                                <div class="image-input-wrapper w-125px rounded-circle h-125px" style="background-image: url({{ Auth::user()->photo_url }})"></div>
                                <!--begin::Remove-->
                                <span onclick="removeBtn()" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow profile-icon" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="Remove avatar" style="position: absolute !important;left: 9rem !important; top: 8.5rem !important;">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            @endif
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow profile-icon" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar" style="position: absolute !important;left: 9rem !important; top: 1rem !important;">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input class="photo" type="file" name="photo" accept=".jpg, .jpeg , .png">
                                <input class="photo" type="hidden" name="photo_remove">
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="Cancel avatar" style="position: absolute !important;left: 9rem !important; top: 8.5rem !important;">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                        </div>
                        <div class="d-flex flex-column">
                            <h1 class="fw-bolder d-flex text-capitalize">Hi!, {{ Auth::user()->name }}</h1>
                            <span class="fw-bold fs-7">{{ Auth::user()->roles->role }}</span>
                        </div>
                    </div>
                    <div class="row d-none" id="btn-photo">
                        <div class="d-flex flex-column align-items-end">
                            <input type="hidden" name="id_user" value="{{ Auth::user()->id_user }}">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
                <!--end::Wrapper-->
                
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-lg-6">
            <!--begin::Card-->										
            <div class="card mb-5 h-lg-100">
                <!--begin::Card body-->
                <div class="card-body card-p">
                <img class="card-background-right d-none d-sm-none d-md-block img-fluid" src="{{ asset('media/png/contact.png') }}" alt="">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between ">
                            <div class="fs-4 fw-bold text-gray-400 mb-7 ">User Profile</div>
                        </div>
                        <div class="d-flex align-items-center pe-2 fs-4 text-black mb-2">
                            <div class="me-3">
                                <span><i class="bi bi-telephone text-primary fs-4"></i></span>
                            </div>
                            <!--begin::Text-->
                            <span>{{ Auth::user()->phone_number }}</span>
                            <!--end::Text-->
                        </div>
                        <div class="d-flex align-items-center pe-2 fs-4 text-black mb-2">
                            <div class="me-3">
                                <span><i class="bi bi-envelope text-primary fs-4"></i></span>
                            </div>
                            <!--begin::Text-->
                            <span>{{ Auth::user()->email }}</span>
                            <!--end::Text-->
                        </div>
                        <div class="d-flex align-items-center pe-2 fs-4 text-black mb-2">
                            <div class="me-3">
                                <span><i class="bi bi-geo-alt text-primary fs-4"></i></span>
                            </div>
                            <!--begin::Text-->
                            <span>{{ Auth::user()->branch->province_name }}</span>
                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Wrapper-->
                    
                    
                    
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <div class="row gy-5 g-xl-8 pt-8">
        <div class="col-lg-6">
            <div class="card mb-5 h-lg-100">
                <div class="card-body card-p">
                    <div class="fs-4 fw-bold text-gray-400 mb-7 ">Personal Information</div>
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">Name</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Name" value="{{ Auth::user()->name }}">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">Phone Number</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input type="number" name="phone_number" class="form-control form-control-lg number" placeholder="Name" value="{{ Auth::user()->phone_number }}">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        
                        <!--end::Col-->
                    </div>
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">Email</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input type="text" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Name" value="{{ Auth::user()->email }}" readonly>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Col-->
                    </div>
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">Branch</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <select
                                id="branch_AC"
                                class="form-select form-select form-control-lg @error('id_branch') is-invalid @enderror"
                                name="id_branch" 
                                autocomplete="off" 
                                placeholder="branch" 
                                value="{{ old('id_branch') }}"
                                required 
                                autocomplete="id_branch" 
                                autofocus
                                data-allow-clear="true">
                                <option value="{{ Auth::user()->id_branch }}" selected="selected">
                                    {{ Auth::user()->branch->province_name }}
                                </option>
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-6">
                        <div class="d-flex flex-column align-items-end">
                            <input type="hidden" name="id_user" value="{{ Auth::user()->id_user }}">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-5 h-lg-100">
                <div class="card-body card-p">
                    <div class="fs-4 fw-bold text-gray-400 mb-7 ">Change Password</div>
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">Current Password</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input id="password" type="password" name="current-password" class="form-control form-control-lg" placeholder="Current Password" value="">
                            <i class="bi bi-eye-slash me-8 mt-5 fs-3" style="position: absolute; right: 0; top: 0;cursor: pointer;" id="togglePassword"></i>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">New Password</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input id="password_new" type="password" name="new-password" class="form-control form-control-lg" placeholder="New Password" value="">
                            <i class="bi bi-eye-slash me-8 mt-5 fs-3" style="position: absolute; right: 0; top: 0;cursor: pointer;" id="togglePassword_new"></i>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">Confirm New Password</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                            <input id="password_new_confirm" type="password" name="new-password_confirmation" class="form-control form-control-lg" placeholder="Confirm New Password" value="">
                            <i class="bi bi-eye-slash me-8 mt-5 fs-3" style="position: absolute; right: 0; top: 0;cursor: pointer;" id="togglePassword_new_confirm"></i>
                            <div class="fv-plugins-message-container invalid-feedback">
                                @error('new-password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-6">
                        <div class="d-flex flex-column align-items-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script type="text/javascript">
    //menampilkan tombol update foto jiga gambar diubah
    const btn_photo = document.getElementById("btn-photo")
    $('.photo').on('change', function() {
        btn_photo.classList.remove("d-none");
    });

    function removeBtn(){
        btn_photo.classList.remove("d-none");
    }

    //function eye pada password field
    const togglePassword = document
            .querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', () => {
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.classList.toggle('bi-eye');
        });

    const togglePassword_new = document
            .querySelector('#togglePassword_new');
        const password_new = document.querySelector('#password_new');
        togglePassword_new.addEventListener('click', () => {
            const type = password_new
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            password_new.setAttribute('type', type);
            togglePassword_new.classList.toggle('bi-eye');
        });
    
    const togglePassword_new_confirm = document
            .querySelector('#togglePassword_new_confirm');
        const password_new_confirm = document.querySelector('#password_new_confirm');
        togglePassword_new_confirm.addEventListener('click', () => {
            const type = password_new_confirm
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            password_new_confirm.setAttribute('type', type);
            togglePassword_new_confirm.classList.toggle('bi-eye');
        });

</script>
@endpush