<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0"><?php echo e(__('labels.new_department')); ?></h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form method="post" action="<?php echo e(route('departments.store')); ?>" id="my-form" autocomplete="off">
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

                <div class="form-group<?php echo e($errors->has('user') ? ' has-danger' : ''); ?>">
                    <label class="form-control-label" for="input-user"><?php echo e(__('labels.default_assigned_user')); ?></label>
                    <select name="assigned_user_id" id="input-user" class="form-control" data-toggle="select">
                        <option value="">Select User</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>" <?php echo e(old('assigned_user_id')==$user->id ? 'selected' :''); ?>><?php echo e($user->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('assigned_user_id')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('assigned_user_id')); ?></strong>
                        </span>
                    <?php endif; ?>
                    <span class="help-text text-muted" style="font-size: .8rem; font-style: italic;"><?php echo e(__('labels.future_tickets_message')); ?></span>
                </div>

                <div class="text-left">
                    <button type="submit" class="btn btn-info mt-4"><?php echo e(__('labels.submit')); ?></button>
                </div>
            </div>

        </form>
    </div>

</div><?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/department/partials/add_new_form.blade.php ENDPATH**/ ?>