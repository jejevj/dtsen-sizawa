<!--begin::Header-->
<div id="kt_app_header" class="app-header align-items-stretch">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <!--begin::Header-->
        <div class="d-flex align-items-center justify-content-between flex-row-fluid" id="kt_app_header_wrapper">
            <!--begin::Header logo-->
            <div class="app-header-logo d-flex align-items-center">
                <!--begin::Header mobile toggle-->
                <div class="d-flex align-items-center d-lg-none ms-n2" title="Show sidebar menu">
                    <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
                        <i class="ki-outline ki-abstract-14 fs-2"></i>
                    </div>
                </div>
                <!--end::Header mobile toggle-->
                <!--begin::Logo image-->
                <a href="index.html" class="me-5 me-lg-9">
                    <img alt="Logo" src="https://2017.kemenag.go.id/public/templates/unify/img/logo-kemenag-dark.png"
                        class="h-25px h-lg-30px theme-light-show" />
                    <img alt="Logo" src="https://i.ibb.co.com/4Zth5784/image.png"
                        class="h-25px h-lg-30px theme-dark-show" />
                </a>
                <!--end::Logo image-->
            </div>
            <!--end::Header logo-->
            <!--begin::Menu wrapper-->
            <div class="d-flex align-items-stretch" id="kt_app_header_menu_wrapper">
                <!--begin::Menu holder-->
                <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                    data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                    data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle"
                    data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_menu_wrapper'}">
                    <!--begin::Menu-->
                    <div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-600 menu-state-primary menu-arrow-gray-500 fw-semibold fw-semibold fs-6 align-items-stretch my-5 me-20 my-lg-0 px-2 px-lg-0"
                        id="#kt_app_header_menu" data-kt-menu="true">
                        <!--begin:Menu item (Dashboards)-->
                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="bottom-start" data-kt-menu-offset="-250,0"
                            class="menu-item menu-lg-down-accordion me-lg-2 {{ Route::currentRouteName() == 'dashboard' ? 'here show menu-here-bg' : '' }}">

                            <!--begin:Menu link-->
                            <a href="{{ route('dashboard') }}"
                                class="menu-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-category fs-3"></i>
                                </span>
                                <span class="menu-title">Dashboards</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->

                        <!--begin:Menu item (Report)-->
                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="bottom-start" data-kt-menu-offset="-400,0"
                            class="menu-item menu-lg-down-accordion me-lg-2 {{ Route::currentRouteName() == 'report' ? 'here show menu-here-bg' : '' }}">

                            <!--begin:Menu link-->
                            <a href="{{ route('report') }}"
                                class="menu-link {{ Route::currentRouteName() == 'report' ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-notepad-bookmark fs-3"></i>
                                </span>
                                <span class="menu-title">Report</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Menu holder-->
            </div>
            <!--end::Menu wrapper-->
            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0">
                <!--begin::User menu-->
                <div class="app-navbar-item me-3" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="btn btn-icon btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-outline ki-user fs-2"></i>
                    </div>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        {{-- <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="assets/media/avatars/300-5.jpg" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">Max Smith
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">max@kt.com</a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item--> --}}



                        <!--begin::Menu separator-->
                        {{-- <div class="separator my-2"></div> --}}
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-title position-relative">Mode
                                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                        <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                                        <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                                    </span></span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                data-kt-menu="true" data-kt-element="theme-mode-menu">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                        data-kt-value="light">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-outline ki-night-day fs-2"></i>
                                        </span>
                                        <span class="menu-title">Light</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-outline ki-moon fs-2"></i>
                                        </span>
                                        <span class="menu-title">Dark</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                        data-kt-value="system">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-outline ki-screen fs-2"></i>
                                        </span>
                                        <span class="menu-title">System</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Menu item-->

                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            @if(Auth::check())
                                <!-- Display Logout button if the user is logged in -->
                                <a href="{{ route('logout') }}" class="menu-link px-5"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="menu-title position-relative">Logout
                                        <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                            <i class="ki-outline ki-security-user theme-light-show fs-2"></i>
                                        </span>
                                    </span>
                                </a>

                                <!-- Logout Form (hidden form to POST logout) -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <!-- Display Login button if the user is not logged in -->
                                <a href="#" class="menu-link px-5" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <span class="menu-title position-relative">Login
                                        <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                            <i class="ki-outline ki-security-user theme-light-show fs-2"></i>
                                        </span>
                                    </span>
                                </a>
                            @endif
                        </div>


                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->

                <!--begin::Sidebar menu toggle-->
                <!--end::Sidebar menu toggle-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header-->
    </div>
    <!--end::Header container-->
</div>
<!--end::Header-->