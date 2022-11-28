

<?php $__env->startSection('content'); ?>

<style>
    /*div.dataTables_wrapper div.dataTables_filter{
        text-align: left;
    }

    div.dataTables_length{
        text-align: right;
    }*/
</style>

    <?php $__env->startPush('header-buttons'); ?>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> <?php echo e(__('labels.roles')); ?></a>
        </div>
    <?php $__env->stopPush(); ?>

    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => __('labels.manage_roles') ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('labels.new_role')); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('roles.store')); ?>" id="my-form" autocomplete="off" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('post'); ?>

                            <?php if(session('status')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo e(session('status')); ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>  
                            <?php endif; ?>

                            <div class="pl-lg-4">

                                <div class="form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-name"><?php echo e(__('labels.name')); ?></label>
                                    <input type="text" name="name" id="input-name" class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('labels.name')); ?>" value="<?php echo e(old('name')); ?>" required autofocus>

                                    <?php if($errors->has('name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group permissions-select-wrapper">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input class="custom-control-input" id="setCheckboxPermission-SELECT-ALL" type="checkbox" onchange="selectAllPermissions(this)">
                                        <label class="custom-control-label" for="setCheckboxPermission-SELECT-ALL"><?php echo e(__('labels.select_all_permissions')); ?></label>
                                      </div>
                                </div>

                                <div class="row permissions-select-wrapper">
                                    <?php $__empty_1 = true; $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input permission-input-checkbox" id="setCheckboxPermission-<?php echo e($permission->id); ?>" name="permissions[]" type="checkbox" value="<?php echo e($permission->name); ?>">
                                                <label class="custom-control-label" for="setCheckboxPermission-<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></label>
                                              </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="col-12">
                                            <div class="alert alert-danger">
                                                <p><?php echo e(__('labels.no_permissions_found')); ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
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

    window.selectAllPermissions = function (el) {

        $('.permission-input-checkbox').not(el).prop('checked', el.checked);
        
    }

    $('[name=role_type_type]').on('change', function() {

        if(this.value=='Custom'){
            $('.permissions-select-wrapper').show()
        }else{
            $('.permissions-select-wrapper').hide()

        }
        
    })

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'roles' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/role/create.blade.php ENDPATH**/ ?>