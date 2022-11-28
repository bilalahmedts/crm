<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title> <?php echo e(__('labels.login')); ?> | <?php echo e(setting('site_title')); ?></title>

        <!-- Favicon -->
        <link href="<?php echo e(asset('admin')); ?>/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="<?php echo e(asset('admin')); ?>/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="<?php echo e(asset('admin')); ?>/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Admin CSS -->
        <link type="text/css" href="<?php echo e(asset('admin')); ?>/css/admin.css?v=1.0.0" rel="stylesheet">
    </head>
    <body class="<?php echo e($class ?? ''); ?>">

        <div class="main-content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <script src="<?php echo e(asset('admin')); ?>/vendor/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo e(asset('admin')); ?>/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        <?php echo $__env->yieldPushContent('js'); ?>
        
        <!-- Admin JS -->
        <script src="<?php echo e(asset('admin')); ?>/js/admin.js?v=1.0.0"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script>
            feather.replace()
        </script>
    </body>
</html><?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/layouts/login.blade.php ENDPATH**/ ?>