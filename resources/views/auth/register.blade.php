@extends('layout.main')

@section('content')
    <div class="d-flex" >
        <!--begin::Content-->
        <div style="width: 60%" class="login-image d-none d-xl-block">
            
        </div>
        <div class="d-flex flex-center flex-column flex-column-fluid">
            <!--begin::Logo-->
            <a href="#" class="text-center pt-10">
                <h1 class="hs-1"><span style="color: #F2951C">Jingga</span> Teknologi<span style="color: #F2951C">.</span></h1>
                
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px p-10 p-lg-10 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" method="POST" action="{{ route('register') }}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-left mb-10">
                        <!--begin::Title-->
                        <h2 class="text-dark mb-3">Sign Up</h2>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" autocomplete="off" placeholder="name" value="{{ old('name') }}" required autocomplete="email" autofocus/>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">Branch</label>
                        <!--end::Label-->
                        <!--begin::Input-->
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
                        </select>
                        @error('id_branch')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">Phone Number</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg @error('phone_number') is-invalid @enderror" type="text" name="phone_number" autocomplete="off" placeholder="Phone Number" value="{{ old('phone_number') }}" required autocomplete="phone_numebr" autofocus/>
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="text" name="email" autocomplete="off" placeholder="Phone Number/Email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" placeholder="Password"/>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Confirm Password</label>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg" name="password_confirmation" required autocomplete="current-password" type="password" placeholder="Confirm Password"/>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            Sign Up
                        </button>
                        <!--end::Submit button-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-7">Already have an account?
                            <a href="{{ route('login') }}" class="link-primary fw-bolder">Sign in</a>
                        </div>
                        <!--end::Link-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
@endsection
