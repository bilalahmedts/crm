<?php $__env->startSection('content'); ?> 
    <?php $__env->startPush('header-buttons'); ?>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?php echo e(route('eddyuserCreate')); ?>" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="plus" stroke-width="3" width="12"></i> <?php echo e(__('labels.new_user')); ?></a>
        </div>
    <?php $__env->stopPush(); ?>

    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => __('labels.users')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('labels.manage_users')); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive pb-3">
                        <table class="table align-items-center table-flush" id="basic-datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">HRMSID</th>
                                    <th scope="col">Name</th>  
                                    <th scope="col">PseudoName</th>  
                                    <th scope="col">Agent ID</th>         
                                    <th scope="col">Type</th>         
                                    <th scope="col">Project Code</th>         
                                    <th scope="col">Action</th>         
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter=1;?>
                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    
                                    <tr> 
                                        <td>
                                            <a href="#"><?php echo e($counter++); ?></a>
                                        </td>
                                        <td>
                                            <a href="#"><?php echo e($user->HRMSID); ?></a>
                                        </td>
                                        <td>
                                            <a href="#"><?php echo e($user->name); ?></a>
                                        </td>
                                        <td>
                                            <a href="#"><?php echo e($user->psedo_name); ?></a>
                                        </td>
										<td>
                                            <a href="#"><?php echo e($user->agent_name); ?></a>
                                        </td>
                                        <td>
                                            <a href="#"><?php echo e($user->type); ?></a>
                                        </td>
                                        <td>
                                            <a href="#"><?php echo e($user->project_code); ?></a>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('eddyuserDelete',$user->id)); ?>"> <i class="fas fa-trash"></i></a>
                                        </td>
                                         
                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6">
                                        <?php echo e(__('labels.no_data_found')); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    </div>
<?php $__env->stopSection(); ?>


        <?php $__env->startPush('js'); ?>

        <script>
            $(document).ready(() => {

                $('#basic-datatable').DataTable({
                    ordering:true
                });
            });
        </script>

        <form action="#" method="post" id="FORM_DELETE">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
        <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'users' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/eddy-sales/index.blade.php ENDPATH**/ ?>