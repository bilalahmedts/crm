<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <?php echo $__env->make('frontend.layouts.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>

  <body class="page bg-theme">


    <?php echo $__env->make('frontend.layouts.partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  

    <div class="wrapper">

      <main class="page-content">
        <?php echo $__env->make('frontend.layouts.partials.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="footer footer-light mt-8 py-4">
      <?php echo $__env->make('frontend.layouts.footers.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </footer>

  </div>

    <?php echo $__env->make('frontend.layouts.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
    <?php echo $__env->yieldPushContent('js'); ?>
    
</body>

</html>
<?php /**PATH C:\xampp\htdocs\crm\resources\views/frontend/layouts/app.blade.php ENDPATH**/ ?>