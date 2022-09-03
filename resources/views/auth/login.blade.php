@extends('layout.main')

@section('content')
    <div class="d-flex" >
        <!--begin::Content-->
        <div class="d-none d-xl-block" 
             style="width: 60%; background-image: url({{ asset('/media/png/login.png') }}); height: 100vh; background-size: cover">
            
        </div>
        <div class="d-flex flex-center flex-column flex-column-fluid">
            <!--begin::Logo-->
            <a href="#" class="mb-12 text-center pt-20">
                <h1 class="hs-1"><span style="color: #F2951C">Jingga</span> Teknologi<span style="color: #F2951C">.</span></h1>
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" method="POST" action="{{ route('login') }}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-left mb-10">
                        <!--begin::Title-->
                        <h2 class="text-dark mb-3">Sign In</h2>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
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
                            <!--begin::Link-->
                            <a href="{{url('password/reset')}}" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <div class="fv-row fv-plugins-icon-container">
                            <input id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" placeholder="Password"/>
                            <i class="bi bi-eye-slash me-4 mt-5 fs-3" style="position: absolute; right: 0; top: 0;cursor: pointer;" id="togglePassword"></i>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            Login
                        </button>
                        <!--end::Submit button-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-7">Don't Have an Account?
                            <a href="{{ route('register') }}" class="link-primary fw-bolder">Create an Account</a>
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
</script>
@endpush