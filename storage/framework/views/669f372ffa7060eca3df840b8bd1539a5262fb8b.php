

<?php $__env->startSection('content'); ?>

<div class="container pt-lg-7">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card bg-white">
            <div class="card-header bg-white text-center py-5">
                <img src="<?php echo e(asset('uploads/logo/'.setting('frontend_dark_logo')).'?'.time()); ?>" class="w-50">
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <?php if($errors->any()): ?>
                <?php echo alert_html( __('frontend.invalid_password'), 'danger'); ?>

              <?php endif; ?>
              <div class="text-center text-muted mb-4">
                <small><?php echo e(__('frontend.login_with_credentails' )); ?></small>

              </div>
              <form role="form" action="<?php echo e(route('customer.do_login')); ?>" id="my-form" method="post">
                <?php echo csrf_field(); ?>
                <?php echo method_field('post'); ?>
                <div class="form-group mb-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('labels.email' )); ?>" name="email" value="<?php echo e(old('email')); ?>" autofocus type="email">
                  </div>
                    <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group">

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('labels.password' )); ?>" name="password" value="" type="password">
                  </div>
                  <p class="text-right mt-2 text-muted" style="font-size: .8rem;"><?php echo __('frontend.reset_password_if_not_remember' ); ?> </p>
                    <?php if($errors->has('password')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                  <?php if(setting('RECAPTCH_TYPE')=='GOOGLE'): ?>
                    <div class="g-recaptcha" data-sitekey="<?php echo e(setting('GOOGLE_RECAPTCHA_KEY')); ?>"></div>
                     <?php if($errors->has('g-recaptcha-response')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                        </span>
                    <?php endif; ?>
                  <?php endif; ?>

                </div>

                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" checked type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin"><span><?php echo e(__('frontend.rememberme' )); ?></span></label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-login my-4"><i data-feather="lock" width="20"></i> &nbsp; <?php echo e(__('frontend.login' )); ?></button>
                </div>

                <!-- <div class="text-muted text-center mb-3"><small>or</small></div>
                  <div class="btn-wrapper text-center">
                    <a href="#" class="btn btn-neutral text-dark btn-icon">
                      <span class="btn-inner--icon"><img src="<?php echo e(asset('frontend')); ?>/img/icons/common/facebook.svg"></span>
                      <span class="btn-inner--text">Facebook</span>
                    </a>
                    <a href="#" class="btn btn-neutral text-dark btn-icon">
                      <span class="btn-inner--icon"><img src="<?php echo e(asset('frontend')); ?>/img/icons/common/google.svg"></span>
                      <span class="btn-inner--text">Google</span>
                    </a>
                  </div> -->
                  </form>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-6">
                  <a href="<?php echo e(route('customer.forget_password')); ?>" class="color-theme"><small><?php echo e(__('frontend.forgot_password' )); ?></small></a>
                </div>
                <div class="col-6 text-right">
                  <small><?php echo __('frontend.create_if_no_account' ); ?></a>
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

<?php echo $__env->make('frontend.layouts.app', ['body_class' => 'bg-default', 'nav_class' => 'navbar-theme'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/customer-panel/auth/login.blade.php ENDPATH**/ ?>