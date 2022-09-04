@extends('layout.main')

@section('content')
<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" >
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
            <form class="form w-100" method="POST" action="{{ route('password.email') }}" novalidate="novalidate">
             @csrf
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">Forgot Password ?</h1>
                    <!--end::Title-->
                    <!--begin::Link-->
                    <div class="text-gray-400 fw-bold fs-4">No worries, we'll send you reset instructions.</div>
                    <!--end::Link-->
                </div>
                <!--begin::Heading-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
                    <input class="form-control form-control-solid @error('email') is-invalid @enderror" type="email" placeholder="email" name="email" autocomplete="off" value="{{ old('email') }}" />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--end::Input group-->
                @if (session('status'))
                    <div class="alert alert-success mb-5" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
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
