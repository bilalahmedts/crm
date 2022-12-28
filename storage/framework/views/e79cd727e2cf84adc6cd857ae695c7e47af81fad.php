

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
          <a href="<?php echo e(route('eddyusers')); ?>" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> <?php echo e(__('labels.users')); ?></a>
        </div>
    <?php $__env->stopPush(); ?>

    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => __('labels.users') ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('labels.new_user')); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('eddyuserCreate')); ?>" id="my-form" autocomplete="off" enctype="multipart/form-data">
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

                            <div class="  row"> 
                                <div class="form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?> col-md-4">
                                    <label class="form-control-label" for="input-name"><?php echo e(__('labels.name')); ?></label>
                                    <input type="text" name="name" id="input-name" class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('labels.name')); ?>" value="<?php echo e(old('name')); ?>" required autofocus>

                                    <?php if($errors->has('name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
								
								
								<div class="form-group col-md-4">
                                    <label class="form-control-label" for="input-password-confirmation">HRMSID</label>
                                    <input type="text" name="HRMSID" id="HRMSID" class="form-control " placeholder="HRMSID" value="<?php echo e(old('HRMSID')); ?>" required>
                                    <?php if($errors->has('HRMSID')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('HRMSID')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div> 
                                <div class="form-group col-md-4">
                                    <label class="form-control-label" for="input-password-confirmation">Agent ID</label>
                                    <input type="text" name="agent_name" id="agent_name" class="form-control " placeholder="Agent ID" value="<?php echo e(old('agent_name')); ?>" required>
                                    <?php if($errors->has('agent_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('agent_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div> 
                                <div class="form-group col-md-4">
                                    <label class="form-control-label" for="input-password-confirmation">Pesudo Name</label>
                                    <input type="text" name="psedo_name" id="psedo_name" class="form-control " placeholder="Pesudo Name" value="<?php echo e(old('psedo_name')); ?>" required>
                                    <?php if($errors->has('psedo_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('psedo_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div> 

                                
                                <div class="form-group col-md-4">
                                    <label class="form-control-label" for="input-password-confirmation">Type</label>
                                    <select required name="type" id="" class="form-control">
                                        <option value="">--Select--</option>
                                        <option value="InBound">In-Bound</option>
                                        <option value="OutBound">Out-Bound</option>
                                        <option value="EddyEdu">EddyEdu</option>
                                    </select>
                                     
                                </div> 
								   
                                <div class="form-group col-md-4">
                                    <label class="form-control-label" for="input-password-confirmation">&nbsp;</label>
                                    <button type="submit" name="submit" value="submit" class="btn btn-info btn-block  "><?php echo e(__('labels.submit')); ?></button>
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
<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'user' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/eddy-sales/create.blade.php ENDPATH**/ ?>