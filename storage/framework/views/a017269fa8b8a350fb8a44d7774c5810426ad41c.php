<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Designation</h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form method="post" action="<?php echo e(route('designations.store')); ?>" id="my-form" autocomplete="off">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="pl-lg-4">
                <div class="form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
                    <label class="form-control-label" for="input-name"><?php echo e(__('labels.name')); ?></label>
                    <input type="text" name="name" id="input-name" class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Name')); ?>" value="<?php echo e(old('name')); ?>" required autofocus>

                    <?php if($errors->has('name')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('name')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                 

                <div class="text-left">
                    <button type="submit" class="btn btn-info mt-4"><?php echo e(__('labels.submit')); ?></button>
                </div>
            </div>

        </form>
    </div>

</div><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/designation/partials/add_new_form.blade.php ENDPATH**/ ?>