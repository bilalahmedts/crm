

<?php $__env->startSection('content'); ?>
<?php $__env->startPush('header-buttons'); ?>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?php echo e(route('home-warranties.index')); ?>" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> Go Back</a>
        </div>
    <?php $__env->stopPush(); ?>
    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => 'Home-Warranty'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid mt--6">

        <div class="row">

            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <img style="display: block;margin-left: auto; margin-right: auto;width: 50%; display:none"
                                    src="<?php echo e(url('loader.gif')); ?>" id="loader">
                            </div>
                        </div>

                        <div class="row" id="searchForm">
                            <div class="col-5">
                                <h3 class="mb-0">Home Warranty</h3>
                            </div>
                        </div>
                        <div class="table-responsive pb-3">
                            <table class="table align-items-center table-flush">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo e($home_warranty->first_name ?? ''); ?> <?php echo e($home_warranty->last_name ?? ''); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td><?php echo e($home_warranty->phone ?? ''); ?></td>

                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><?php echo e($home_warranty->address ?? ''); ?></td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td><?php echo e($home_warranty->city ?? ''); ?></td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td><?php echo e($home_warranty->state ?? ''); ?></td>

                                    </tr>
                                    <tr>
                                        <th>Zip Code</th>
                                        <td><?php echo e($home_warranty->zip_code ?? ''); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Client</th>
                                        <td><b><?php echo e($home_warranty->client ?? ''); ?></b></td>

                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><?php echo e($home_warranty->status ?? ''); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Notes</th>
                                        <td><?php echo e($home_warranty->notes ?? ''); ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        
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
            $('#basic-datatable').DataTable();
        });
    </script>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', ['current_page' => 'home-warranties-submission'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/home-warranties/show.blade.php ENDPATH**/ ?>