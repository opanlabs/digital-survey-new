<!--begin::Header-->
<div id="kt_header" style="" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Aside mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
            <div class="btn btn-icon btn-active-light w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!--end::Aside mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="#" class="d-lg-none">
                <div class="">
                    <h2>
                        <span style="color: #F2951C">Jingga</span> Teknologi<span style="color: #F2951C">.</span>
                    </h2>
                </div>
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <!--begin::Menu wrapper-->
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                </div>
                <!--end::Menu wrapper-->
            </div>
            <!--end::Navbar-->
            <!--begin::Toolbar wrapper-->
            <div class="d-flex align-items-stretch flex-shrink-0">
                <!--begin::User menu-->
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <!--begin::Username Menu-->
                    <div class="d-flex align-items-center cursor-pointer" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <div class="symbol symbol-30px symbol-md-40px mx-2">
                            <img 
                                class="rounded-circle" 
                                @if(!(Auth::user()->photo_url))
                                    src="{{ asset('media/png/avatar-default.png') }}" 
                                @else
                                    src="{{ asset('storage/images/'. basename(Auth::user()->photo_url) ) }}"
                                @endif
                                alt="user" 
                            />
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bolder d-flex align-items-center fs-5">{{ Auth::user()->name }}</div>
                            <a class="fw-bold text-muted fs-7">{{ Auth::user()->roles->role }}</a>
                        </div>
                    </div>
                    <!--end::Username Menu-->

                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg py-4 fs-6 w-275px" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a class="menu-link" href="{{ route('profile') }}">
                                <span class="menu-icon"><i class="bi bi-person-circle fs-3"></i></span>
                                <span class="menu-title">Personal Information</span>
                            </a>
                        </div>
                        <div class="menu-item px-5">
                            <a class="menu-link" href="{{ route('profile') }}">
                                <span class="menu-icon"><i class="bi bi-shield-lock fs-3"></i></span>
                                <span class="menu-title">Change Password</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                         <!--begin::Menu separator-->
                         <div class="separator my-2"></div>
                         <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a class="menu-link" 
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <span class="menu-icon"><i class="bi bi-box-arrow-right fs-3"></i></span>
                                <span class="menu-title">Logout</span>
                            </a>
                        </div>
                    </div>
                    <!--end::User account menu-->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
               
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Breadcrumb-->
            <ol class="breadcrumb breadcrumb-line text-muted fs-6 fw-semibold">
                <li class="breadcrumb-item pe-3 text-muted">Dashboard</li>
                <li class="breadcrumb-item pe-3 text-dark">{{ ucfirst(Route::currentRouteName())  }}</li>
            </ol>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->