

<?php $__env->startSection('content'); ?>
<?php $__env->startPush('header-buttons'); ?>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?php echo e(route('solars.index')); ?>" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> Go Back</a>
        </div>
    <?php $__env->stopPush(); ?>
    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => 'Solar-Sale View'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid mt--6">

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="table-responsive pb-3">
                    <table class="table align-items-center table-flush">
                        <tbody>

                            <tr>
                                <th>Name</th>
                                <td><?php echo e($data->first_name ?? ''); ?> <?php echo e($data->last_name ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>Agent Name</th>
                                <td><?php echo e($data->user->name ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?php echo e($data->phone ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>Client</th>
                                <td><b><?php echo e($data->client ? $data->client->name : '' ?? ''); ?></b></td>

                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo e($data->email ?? ''); ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><?php echo e($data->address ?? ''); ?></td>
                            </tr>
                            <tr>
                                <th>Zip Code</th>
                                <td><?php echo e($data->zipcode ?? ''); ?></td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td><?php echo e($data->city ?? ''); ?></td>
                            </tr>


                            <tr>
                                <th>State</th>
                                <td><?php echo e($data->state ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>Lead ID</th>
                                <td><?php echo e($data->lead_id ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>Home Owner</th>
                                <td><?php echo e($data->homeowner ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>Eletric Bill</th>
                                <td><?php echo e($data->electric_bill ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>Electric Provider</th>
                                <td><?php echo e($data->electric_provider ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>Roof Shade</th>
                                <td><?php echo e($data->roof_shade ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>Credit Score</th>
                                <td><?php echo e($data->credit_score ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>Credit Rating</th>
                                <td><?php echo e($data->credit_rating ?? ''); ?></td>

                            </tr>
                            <tr>
                                <th>Age</th>
                                <td><?php echo e($data->age ?? ''); ?></td>
                            </tr>
<tr>
                                <th>Notes</th>
                                <td><?php echo e($data->notes ?? ''); ?></td>
                            </tr>
                        </tbody>
                    </table>
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

    <form action="#" method="post" id="FORM_DELETE">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', ['current_page' => 'solar'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/solar/view.blade.php ENDPATH**/ ?>