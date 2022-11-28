

<?php $__env->startSection('content'); ?>

<div class="container pt-lg-7">
      <div class="row justify-content-center">
        <div class="col-lg-5">

        <?php if(session('status')): ?>
            <?php echo alert_html(session('status'), 'success'); ?>

        <?php endif; ?>          
          
          <div class="card bg-white">
            <div class="card-header bg-white text-center py-5">
                <h3><?php echo e(__('frontend.reset_password' )); ?></h3>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              
              <form role="form" id="my-form" action="<?php echo e(route('customer.send_password')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" required name="email" placeholder="<?php echo __('labels.email' ); ?>" autofocus type="email">
                  </div>
                  <span class="text-muted" style="font-size: .9rem;"><?php echo __('frontend.reset_password_email' ); ?></span>
                   <?php if($errors->has('email')): ?>
                      <span class="invalid-feedback" role="alert">
                          <strong><?php echo e($errors->first('email')); ?></strong>
                      </span>
                  <?php endif; ?>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-login my-4"> <?php echo e(__('frontend.reset_password' )); ?></button>
                </div>
               

              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="<?php echo e(route('customer.login')); ?>" class="color-theme"><small><?php echo __('frontend.back_to_login' ); ?></a>
            </div>
            <div class="col-6 text-right">
            </div>
          </div>
        </div>
      </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script>
if ( document.getElementById('my-form') ) {
  $("#my-form").parsley({
     errorClass: 'is-invalid text-danger',
     // successClass: 'is-valid',
     errorsWrapper: '<span class="form-text text-danger"></span>',
     errorTemplate: '<span></span>',
     trigger: 'change',
     errorsContainer: function(el) {
          return el.$element.closest('.form-group');
      },
   });
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', ['body_class' => 'bg-default', 'nav_class' => 'navbar-theme'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/customer-panel/auth/forget_password.blade.php ENDPATH**/ ?>