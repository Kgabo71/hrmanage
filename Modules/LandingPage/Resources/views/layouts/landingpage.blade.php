@php
    use App\Models\Utility;
    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
    $logo = Utility::get_file('uploads/landing_page_image/');
    $sup_logo = Utility::get_file('uploads/logo');
    $adminSettings = Utility::settings();
    $language = \App\Models\Utility::getValByName('default_language');
    $admin_payment_setting = Utility::getAdminPaymentSetting();
    $getseo = App\Models\Utility::getSeoSetting();
    $metatitle = isset($getseo['meta_title']) ? $getseo['meta_title'] : '';
    $metadesc = isset($getseo['meta_description']) ? $getseo['meta_description'] : '';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($getseo['meta_image']) ? $getseo['meta_image'] : '';
    $enable_cookie = \App\Models\Utility::getCookieSetting('enable_cookie');
    $setting = \App\Models\Utility::colorset();
    $SITE_RTL = Utility::getValByName('SITE_RTL');
    $color = !empty($setting['theme_color']) ? $setting['theme_color'] : 'theme-3';
    if ($language == 'ar' || $language == 'he') {
        $setting['SITE_RTL'] = 'on';
    }
    if (isset($setting['color_flag']) && $setting['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }

@endphp
<!DOCTYPE html>
<html lang="en">
<html lang="en" dir="{{ $setting['SITE_RTL'] == 'on' ? 'rtl' : '' }}">

<head>
    <title>{{ env('APP_NAME') }}</title>
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />

    <meta name="title" content="{{ $metatitle }}">
    <meta name="description" content="{{ $metadesc }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ $metatitle }}">
    <meta property="og:description" content="{{ $metadesc }}">
    <meta property="og:image"
        content="{{ isset($meta_logo) && !empty(asset('storage/uploads/meta/' . $meta_logo)) ? asset('storage/uploads/meta/' . $meta_logo) : 'hrmgo.png' }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{ $metatitle }}">
    <meta property="twitter:description" content="{{ $metadesc }}">
    <meta property="twitter:image"
        content="{{ isset($meta_logo) && !empty(asset('storage/uploads/meta/' . $meta_logo)) ? asset('storage/uploads/meta/' . $meta_logo) : 'hrmgo.png' }}">

    <!-- Favicon icon -->
    {{-- <link rel="icon" href="{{ $sup_logo.'/'. $adminSettings['company_favicon'] }}" type="image/x-icon" /> --}}
    <link rel="icon"
        href="{{ $sup_logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}"
        type="image/x-icon" />

    <!-- font css -->
    <link rel="stylesheet" href=" {{ Module::asset('LandingPage:Resources/assets/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href=" {{ Module::asset('LandingPage:Resources/assets/fonts/feather.css') }}" />
    <link rel="stylesheet" href="  {{ Module::asset('LandingPage:Resources/assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/fonts/material.css') }}" />



    <!-- vendor css -->
    <link rel="stylesheet" href="  {{ Module::asset('LandingPage:Resources/assets/css/style.css') }}" />
    <link rel="stylesheet" href=" {{ Module::asset('LandingPage:Resources/assets/css/customizer.css') }}" />
    <link rel="stylesheet" href=" {{ Module::asset('LandingPage:Resources/assets/css/landing-page.css') }}" />
    <link rel="stylesheet" href=" {{ Module::asset('LandingPage:Resources/assets/css/custom.css') }}" />

    <style>
        :root {
            --color-customColor: <?=$color ?>;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/custom-color.css') }}">

    @if ($SITE_RTL == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    @endif

    @if ($setting['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
    @else
        <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/css/style.css') }}"
            id="main-style-link">
    @endif

</head>

@if ($setting['cust_darklayout'] == 'on')

    <body class="{{ $themeColor }} landing-dark">
    @else

        <body class="{{ $themeColor }}">
@endif
<!-- [ Header ] start -->
<header class="main-header">
    @if ($settings['topbar_status'] == 'on')
        <div class="announcement bg-dark text-center p-2">
            <p class="mb-0">{!! $settings['topbar_notification_msg'] !!}</p>
        </div>
    @endif
    @if ($settings['menubar_status'] == 'on')
        <div class="container">
            <nav class="navbar navbar-expand-md  default top-nav-collapse">
                <div class="header-left">
                    <a class="navbar-brand bg-transparent" href="#">
                        <img src="{{ $logo . '/' . $settings['site_logo'] . '?' . time() }}" alt="logo">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
           
                    <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="ms-auto d-flex justify-content-end gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-dark rounded"><span
                            class="hide-mob me-2">{{ __('Login') }}</span> <i data-feather="log-in"></i></a>
                    @if (isset($adminSettings['disable_signup_button']) && $adminSettings['disable_signup_button'] == 'on')
                        <a href="{{ route('register') }}" class="btn btn-outline-dark rounded"><span
                                class="hide-mob me-2">{{ __('Register') }}</span> <i
                                data-feather="user-check"></i></a>
                    @endif
                    <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </div>
    @endif

</header>
<!-- [ Header ] End -->
<!-- [ Banner ] start -->
@if ($settings['home_status'] == 'on')
    <section class="main-banner bg-primary" id="home">
        <div class="container-offset">
            <div class="row gy-3 g-0 align-items-center">
                <div class="col-xxl-4 col-md-6">
                  
                        {{ $settings['home_offer_text'] }}</span>
                    <h1 class="mb-3">
                        {{-- <b class="fw-bold">{{ env('APP_NAME') }}</b> <br> --}}
                        {{ $settings['home_heading'] }}
                    </h1>

                    <h6 class="mb-0">{{ $settings['home_description'] }}</h6>
                    <div class="d-flex gap-3 mt-4 banner-btn">
                        @if ($settings['home_live_demo_link'])
                            <a href="{{ $settings['home_live_demo_link'] }}"
                                class="btn btn-outline-dark">{{ __('Live Demo') }} <i data-feather="play-circle"
                                    class="ms-2"></i></a>
                        @endif
                        @if ($settings['home_buy_now_link'])
                            <a href="{{ $settings['home_buy_now_link'] }}"
                                class="btn btn-outline-dark">{{ __('Buy Now') }} <i data-feather="lock"
                                    class="ms-2"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-xxl-8 col-md-6">
                    <div class="dash-preview">
                        <img class="img-fluid preview-img" src="{{ $logo . '/' . $settings['home_banner'] }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row g-0 gy-2 mt-4 align-items-center">
               
                <div class="col-xxl-9">
                    <div class="row gy-3 row-cols-9">
                        @foreach (explode(',', $settings['home_logo']) as $k => $home_logo)
                            <div class="col-auto">
                                <img src="{{ $logo . '/' . $home_logo }}" alt="" class="img-fluid"
                                    style="width: 130px;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- [ Banner ] start -->

<!-- [ Footer ] start -->
<footer class="site-footer bg-gray-100">
    <div class="container">
        <div class="footer-row">
            <div class="ftr-col cmp-detail">
                <div class="footer-logo mb-3">
                    <a href="#">
                        <img src="{{ $logo . '/' . $settings['site_logo'] . '?' . time() }}" alt="logo">
                    </a>
                </div>
             

            </div>
       
            

        &copy;{{ date(' Y') }}
        {{ App\Models\Utility::getValByName('footer_text') ? App\Models\Utility::getValByName('footer_text') : config('app.name', 'HRMGo SaaS') }}

    </div>
</footer>
<!-- [ Footer ] end -->
<!-- Required Js -->

<script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/feather.min.js') }}"></script>

<script>
    // Start [ Menu hide/show on scroll ]
    let ost = 0;
    document.addEventListener("scroll", function() {
        let cOst = document.documentElement.scrollTop;
        if (cOst == 0) {
            document.querySelector(".navbar").classList.add("top-nav-collapse");
        } else if (cOst > ost) {
            document.querySelector(".navbar").classList.add("top-nav-collapse");
            document.querySelector(".navbar").classList.remove("default");
        } else {
            document.querySelector(".navbar").classList.add("default");
            document
                .querySelector(".navbar")
                .classList.remove("top-nav-collapse");
        }
        ost = cOst;
    });
    // End [ Menu hide/show on scroll ]

    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: "#navbar-example",
    });
    feather.replace();
</script>

@stack('custom-scripts')
@if ($enable_cookie['enable_cookie'] == 'on')
    @include('layouts.cookie_consent')
@endif
</body>

</html>
