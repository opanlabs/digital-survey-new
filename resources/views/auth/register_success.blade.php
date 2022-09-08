@extends('layout.main')

@section('content')

<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" >
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <!--begin::Wrapper-->
        <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Logo-->
            <a class="mb-12 d-flex flex-wrap justify-content-center">
                <img alt="Logo" src="{{ asset('media/png/success.png') }}" class="h-80px" />
            </a>
            <!--end::Logo-->
            <!--begin::Heading-->
            <div class="text-center mb-10">
                <!--begin::Title-->
                <h1 class="text-dark mb-3">User Registered Successfully</h1>
                <!--end::Title-->
                <!--begin::Link-->
                <div class="text-gray-400 fw-bold fs-4">Your account has been registered successfully.
                    <br>Please wait for admin to confirm your registration
                </div>
                <!--end::Link-->
            </div>
            <!--begin::Heading-->
            <!--begin::Actions-->
            <div class="d-flex flex-wrap justify-content-center pb-lg-0 fv-row mb-5">
                <a href="{{ route('profile') }} " style="width: -webkit-fill-available;">
                <button type="button" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder" style="width: -webkit-fill-available;">
                    <span  class="indicator-label text-white">Continue</span>
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </a>
            </div>
                <!--begin::Link-->
                <div class="text-gray-400 fw-bold fs-7 text-center">
                <a href="{{ route('profile') }}" class="text-gray-400 fw-bold fs-7 text-center">
                    
                    
                </a>
            </div>
            <!--end::Link-->
            <!--end::Actions-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
</div>
@endsection
