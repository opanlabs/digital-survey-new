@extends('layout.main')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <!--begin::Wrapper-->
        <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Logo-->
            <a class="mb-12 d-flex flex-wrap justify-content-center">
                <img alt="Logo" src="{{ asset('media/png/reset_key.png') }}" class="h-80px" />
            </a>
            <!--end::Logo-->
            <!--begin::Form-->
            <form class="form w-100" method="POST" action="{{ route('password.update') }}" novalidate="novalidate">
            @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" id="email"  value="{{ $email ?? old('email') }}">
                
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">Set new Password</h1>
                    <!--end::Title-->
                    <!--begin::Link-->
                    <div class="text-gray-400 fw-bold fs-4">Your new password must be diffrent to previously used password.</div>
                    <!--end::Link-->
                </div>
                <!--begin::Heading-->
                <!--begin::Input group-->
                <div class="fv-row mb-5 fv-plugins-icon-container">
                    <label class="form-label fw-bolder text-gray-900 fs-6">New Password</label>
                    <input id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" placeholder="Password"/>
                    <i class="bi bi-eye-slash me-4 mt-5 fs-3 mt-13" style="position: absolute; right: 0; top: 0;cursor: pointer;" id="togglePassword"></i>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5 fv-plugins-icon-container">
                    <label class="form-label fw-bolder text-gray-900 fs-6">Confirm new password</label>
                    <input id="password_confirm" class="form-control form-control-lg" name="password_confirmation" required autocomplete="current-password" type="password" placeholder="Confirm Password"/>
                    <i class="bi bi-eye-slash me-4 mt-5 fs-3 mt-13" style="position: absolute; right: 0; top: 0;cursor: pointer;" id="togglePassword_confirm"></i>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--end::Input group-->
                @error('email')
                <div class="alert alert-danger mb-5" role="alert">
                        {{ $message }}
                </div>
                @enderror
                <!--begin::Actions-->
                <div class="d-flex flex-wrap justify-content-center pb-lg-0 fv-row mb-5">
                    <button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder" style="width: -webkit-fill-available;">
                        <span class="indicator-label">Reset Password</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                 <!--begin::Link-->
                 <div class="text-gray-400 fw-bold fs-7 text-center">
                    <a href="{{ route('login') }}" class="text-gray-400 fw-bold fs-7 text-center">
                    </a>
                </div>
                <div class="menu-item px-5">
                    <a class="menu-link" href="{{ route('login') }}">
                        <span class="menu-title text-gray-400 fw-bold fs-7 text-center d-flex flex-wrap justify-content-center"><i class="bi bi-arrow-left-short fs-1"></i>Back To Login</span>
                    </a>
                </div>
                <!--end::Link-->
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
</div>


@endsection

@push('scripts')
<script>
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

    const togglePassword_confirm = document
            .querySelector('#togglePassword_confirm');
        const password_confirm = document.querySelector('#password_confirm');
        togglePassword_confirm.addEventListener('click', () => {
            const type = password_confirm
                .getAttribute('type') === 'password' ?
                'text' : 'password';
                password_confirm.setAttribute('type', type);
            togglePassword_confirm.classList.toggle('bi-eye');
        });
</script>
@endpush