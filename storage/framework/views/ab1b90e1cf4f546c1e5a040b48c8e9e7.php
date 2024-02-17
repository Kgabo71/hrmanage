<?php
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

?>
<!DOCTYPE html>
<html lang="en">
<html lang="en" dir="<?php echo e($setting['SITE_RTL'] == 'on' ? 'rtl' : ''); ?>">

<head>
    <title><?php echo e(env('APP_NAME')); ?></title>
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />

    <meta name="title" content="<?php echo e($metatitle); ?>">
    <meta name="description" content="<?php echo e($metadesc); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($metatitle); ?>">
    <meta property="og:description" content="<?php echo e($metadesc); ?>">
    <meta property="og:image"
        content="<?php echo e(isset($meta_logo) && !empty(asset('storage/uploads/meta/' . $meta_logo)) ? asset('storage/uploads/meta/' . $meta_logo) : 'hrmgo.png'); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($metatitle); ?>">
    <meta property="twitter:description" content="<?php echo e($metadesc); ?>">
    <meta property="twitter:image"
        content="<?php echo e(isset($meta_logo) && !empty(asset('storage/uploads/meta/' . $meta_logo)) ? asset('storage/uploads/meta/' . $meta_logo) : 'hrmgo.png'); ?>">

    <!-- Favicon icon -->
    
    <link rel="icon"
        href="<?php echo e($sup_logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
        type="image/x-icon" />

    <!-- font css -->
    <link rel="stylesheet" href=" <?php echo e(Module::asset('LandingPage:Resources/assets/fonts/tabler-icons.min.css')); ?>" />
    <link rel="stylesheet" href=" <?php echo e(Module::asset('LandingPage:Resources/assets/fonts/feather.css')); ?>" />
    <link rel="stylesheet" href="  <?php echo e(Module::asset('LandingPage:Resources/assets/fonts/fontawesome.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/fonts/material.css')); ?>" />



    <!-- vendor css -->
    <link rel="stylesheet" href="  <?php echo e(Module::asset('LandingPage:Resources/assets/css/style.css')); ?>" />
    <link rel="stylesheet" href=" <?php echo e(Module::asset('LandingPage:Resources/assets/css/customizer.css')); ?>" />
    <link rel="stylesheet" href=" <?php echo e(Module::asset('LandingPage:Resources/assets/css/landing-page.css')); ?>" />
    <link rel="stylesheet" href=" <?php echo e(Module::asset('LandingPage:Resources/assets/css/custom.css')); ?>" />

    <style>
        :root {
            --color-customColor: <?=$color ?>;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('css/custom-color.css')); ?>">

    <?php if($SITE_RTL == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">
    <?php endif; ?>

    <?php if($setting['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/css/style.css')); ?>"
            id="main-style-link">
    <?php endif; ?>

</head>

<?php if($setting['cust_darklayout'] == 'on'): ?>

    <body class="<?php echo e($themeColor); ?> landing-dark">
    <?php else: ?>

        <body class="<?php echo e($themeColor); ?>">
<?php endif; ?>
<!-- [ Header ] start -->
<header class="main-header">
    <?php if($settings['topbar_status'] == 'on'): ?>
        <div class="announcement bg-dark text-center p-2">
            <p class="mb-0"><?php echo $settings['topbar_notification_msg']; ?></p>
        </div>
    <?php endif; ?>
    <?php if($settings['menubar_status'] == 'on'): ?>
        <div class="container">
            <nav class="navbar navbar-expand-md  default top-nav-collapse">
                <div class="header-left">
                    <a class="navbar-brand bg-transparent" href="#">
                        <img src="<?php echo e($logo . '/' . $settings['site_logo'] . '?' . time()); ?>" alt="logo">
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
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-dark rounded"><span
                            class="hide-mob me-2"><?php echo e(__('Login')); ?></span> <i data-feather="log-in"></i></a>
                    <?php if(isset($adminSettings['disable_signup_button']) && $adminSettings['disable_signup_button'] == 'on'): ?>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-dark rounded"><span
                                class="hide-mob me-2"><?php echo e(__('Register')); ?></span> <i
                                data-feather="user-check"></i></a>
                    <?php endif; ?>
                    <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </div>
    <?php endif; ?>

</header>
<!-- [ Header ] End -->
<!-- [ Banner ] start -->
<?php if($settings['home_status'] == 'on'): ?>
    <section class="main-banner bg-primary" id="home">
        <div class="container-offset">
            <div class="row gy-3 g-0 align-items-center">
                <div class="col-xxl-4 col-md-6">
                  
                        <?php echo e($settings['home_offer_text']); ?></span>
                    <h1 class="mb-3">
                        
                        <?php echo e($settings['home_heading']); ?>

                    </h1>

                    <h6 class="mb-0"><?php echo e($settings['home_description']); ?></h6>
                    <div class="d-flex gap-3 mt-4 banner-btn">
                        <?php if($settings['home_live_demo_link']): ?>
                            <a href="<?php echo e($settings['home_live_demo_link']); ?>"
                                class="btn btn-outline-dark"><?php echo e(__('Live Demo')); ?> <i data-feather="play-circle"
                                    class="ms-2"></i></a>
                        <?php endif; ?>
                        <?php if($settings['home_buy_now_link']): ?>
                            <a href="<?php echo e($settings['home_buy_now_link']); ?>"
                                class="btn btn-outline-dark"><?php echo e(__('Buy Now')); ?> <i data-feather="lock"
                                    class="ms-2"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xxl-8 col-md-6">
                    <div class="dash-preview">
                        <img class="img-fluid preview-img" src="<?php echo e($logo . '/' . $settings['home_banner']); ?>"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row g-0 gy-2 mt-4 align-items-center">
               
                <div class="col-xxl-9">
                    <div class="row gy-3 row-cols-9">
                        <?php $__currentLoopData = explode(',', $settings['home_logo']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $home_logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-auto">
                                <img src="<?php echo e($logo . '/' . $home_logo); ?>" alt="" class="img-fluid"
                                    style="width: 130px;">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- [ Banner ] start -->

<!-- [ Footer ] start -->
<footer class="site-footer bg-gray-100">
    <div class="container">
        <div class="footer-row">
            <div class="ftr-col cmp-detail">
                <div class="footer-logo mb-3">
                    <a href="#">
                        <img src="<?php echo e($logo . '/' . $settings['site_logo'] . '?' . time()); ?>" alt="logo">
                    </a>
                </div>
             

            </div>
       
            

        &copy;<?php echo e(date(' Y')); ?>

        <?php echo e(App\Models\Utility::getValByName('footer_text') ? App\Models\Utility::getValByName('footer_text') : config('app.name', 'HRMGo SaaS')); ?>


    </div>
</footer>
<!-- [ Footer ] end -->
<!-- Required Js -->

<script src="<?php echo e(Module::asset('LandingPage:Resources/assets/js/plugins/popper.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('LandingPage:Resources/assets/js/plugins/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(Module::asset('LandingPage:Resources/assets/js/plugins/feather.min.js')); ?>"></script>

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

<?php echo $__env->yieldPushContent('custom-scripts'); ?>
<?php if($enable_cookie['enable_cookie'] == 'on'): ?>
    <?php echo $__env->make('layouts.cookie_consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>

</html>
<?php /**PATH C:\wamp64\www\main-file\Modules/LandingPage\Resources/views/layouts/landingpage.blade.php ENDPATH**/ ?>