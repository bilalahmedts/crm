

<?php $__env->startSection('content'); ?>

    <?php $__env->startPush('header-buttons'); ?>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> <?php echo e(__('labels.customers')); ?></a>
        </div>
    <?php $__env->stopPush(); ?>

    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => __('labels.customers') ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('labels.new_customer')); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('customers.store')); ?>" id="my-form" autocomplete="off" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('post'); ?>

                            <div class="pl-lg-4">

                                <div class="form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-name"><?php echo e(__('labels.name')); ?></label>
                                    <input type="text" name="name" id="input-name" class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('labels.name')); ?>" value="<?php echo e(old('name')); ?>" required autofocus />

                                    <?php if($errors->has('name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group<?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-email"><?php echo e(__('labels.email')); ?></label>
                                    <input type="email" name="email" id="input-email" class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('labels.email')); ?>" value="<?php echo e(old('email')); ?>" required>

                                    <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group<?php echo e($errors->has('password') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-password"><?php echo e(__('labels.password')); ?></label>
                                    <input type="password" name="password" id="input-password" class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('labels.password')); ?>" value="<?php echo e(old('password')); ?>" required>

                                    <?php if($errors->has('password')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation"><?php echo e(__('labels.confirm_password')); ?></label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control " placeholder="<?php echo e(__('labels.confirm_password')); ?>" value="" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="upload_image"><?php echo e(__('labels.profile_image')); ?></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="upload_image" lang="en">
                                        <label class="custom-file-label text-left" for="upload_image"><i data-feather="upload" width="15"></i> <?php echo e(__('labels.select_file')); ?></label>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <img src="<?php echo e(asset('uploads/customer/default.png')); ?>" width="100" id="preview-image" class="rounded-circle" alt="" />
                                </div>


                                <div class="text-left">
                                    <button type="submit" class="btn btn-info mt-4"><?php echo e(__('labels.submit')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    
                </div>
            </div>
        </div>

        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>

<script>
    $('#upload_image').on('change', (e) => {
        preview_image(e);
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'customers' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/customers/create.blade.php ENDPATH**/ ?>