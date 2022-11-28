

<?php $__env->startSection('content'); ?>

<div class="container pt-lg-7">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card bg-white">
            <div class="card-header bg-white text-center py-5">
                <h3><?php echo e(__('frontend.create_account')); ?></h3>
            </div>
            <div class="card-body px-lg-5 py-lg-5">

              <p class="text-center text-muted"><small><?php echo e(__('frontend.already_account')); ?></small>
              <a href="<?php echo e(route('customer.login')); ?>" class="text-primary"><small> <?php echo e(__('frontend.login')); ?></small></a></p>

              <?php if($errors->any()): ?>
                <?php echo alert_html( __('frontend.fill_all_fields'), 'danger'); ?>

              <?php endif; ?>
              
              <form role="form" action="<?php echo e(route('customer.do_register')); ?>" method="post" id="my-form" autocomplete="off">
                <?php echo csrf_field(); ?>
                <?php echo method_field('post'); ?>

                <div class="form-group mb-3">
                    <label class="form-control-label" for="input-name"><?php echo e(__('labels.name')); ?><span class="text-danger">*</span> </label>
                    <input type="text" class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" placeholder="<?php echo e(__('labels.name')); ?>" autofocus value="<?php echo e(old('name')); ?>" required minlength="3" />
                    <?php if($errors->has('name')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('name')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-3">
                    <label class="form-control-label" for="input-name"><?php echo e(__('labels.email')); ?><span class="text-danger">*</span> </label>
                  <input type="email" class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('labels.email')); ?>" name="email" value="<?php echo e(old('email')); ?>" required />
                    <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="input-name"><?php echo e(__('labels.password')); ?><span class="text-danger">*</span> </label>
                  <input type="password" class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('labels.password')); ?>" name="password"  required minlength="6" />
                    <?php if($errors->has('password')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <?php if(setting('RECAPTCH_TYPE')=='GOOGLE'): ?>
                  <div class="form-group pt-4">
                      <div class="g-recaptcha" data-sitekey="<?php echo e(setting('GOOGLE_RECAPTCHA_KEY')); ?>"></div>
                      <?php if($errors->has('g-recaptcha-response')): ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                          </span>
                      <?php endif; ?>
                  </div>
                <?php endif; ?>


                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" value="agreed" name="agree_terms" type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin"><?php echo __('frontend.agree_terms' ); ?></label>
                    <?php if($errors->has('agree_terms')): ?>
                        <p class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('agree_terms')); ?></strong>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-login my-4"><i data-feather="user" width="20"></i> &nbsp; <?php echo e(__('frontend.signup' )); ?></button>
                </div>
                
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
            </div>
            <div class="col-6 text-right">
              <a href="<?php echo e(route('customer.login')); ?>" class="text-primary"><small> <?php echo e(__('frontend.login' )); ?></small></a>
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
         successClass: 'is-valid',
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

<?php echo $__env->make('frontend.layouts.app', ['body_class' => 'bg-default', 'nav_class' => 'navbar-theme'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/customer-panel/auth/register.blade.php ENDPATH**/ ?>