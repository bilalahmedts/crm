

<?php $__env->startSection('content'); ?>


    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => __('labels.manage_priority')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('labels.priority')); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive pb-3">
                        <table class="table align-items-center table-flush" id="basic-datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"><?php echo e(__('labels.id')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.name')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.created_at')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.preview')); ?></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__empty_1 = true; $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('priorities.edit', $priority->id)); ?>"><?php echo e($priority->id); ?></a>
                                        </td>
                                        <td class="table-user">
                                            <?php echo e($priority->name); ?>

                                        </td>
                                        <td><?php echo e($priority->created_at->format( setting('date_format') )); ?></td>
                                        <td><?php echo priority_label($priority); ?></td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('priority.edit')): ?>
                                                        <a class="dropdown-item" href="<?php echo e(route('priorities.edit', $priority->id)); ?>"><?php echo e(__('labels.edit')); ?></a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('priority.delete')): ?>
                                                        <a class="dropdown-item delete-btn" href="#" onclick="if(confirm('<?php echo e(__('labels.confirm_delete')); ?>')){  $('#FORM_DELETE').attr('action', '<?php echo e(route('priorities.destroy', $priority->id)); ?>').submit(); }" ><?php echo e(__('labels.delete')); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
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

            <div class="col-4">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('priority.create')): ?>
                    <?php echo $__env->make('admin.priority.partials.add_new_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>

        </div>

        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    </div>
<?php $__env->stopSection(); ?>


        <?php $__env->startPush('js'); ?>

        <script>
            $(document).ready(() => {

                $('#basic-datatable').DataTable();
            });
        </script>

            <form action="#" method="post" id="FORM_DELETE">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
            </form>
        <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'priorities' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/priority/index.blade.php ENDPATH**/ ?>