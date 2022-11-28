<?php $__env->startSection('content'); ?>


    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => "DSS"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php

        $start_date = '';
        $end_date = '';
        $phone = '';

        if (isset($_GET['search'])) {
            if (!empty($_GET['start_date'])) {
                $start_date = $_GET['start_date'];
            }
            if (!empty($_GET['end_date'])) {
                $end_date = $_GET['end_date'];
            }
        }
        if (isset($_GET['search'])) {
            if (!empty($_GET['phone'])) {
                $phone = $_GET['phone'];
            }
        }
    ?>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h3 class="mb-0">Manage Dss Campaign</h3>
                            </div>
                            <div class="col-3">
                                <a href="<?php echo e(route('dss.create')); ?>" class="btn btn-info float-right">Sale Submission</a>
                                <?php if(isset($_GET['search'])): ?>
                                    <a href="<?php echo e(route('dss.sales-report')); ?>?start_date=<?php echo e($start_date); ?>&end_date=<?php echo e($end_date); ?>&phone=<?php echo e($phone); ?>"
                                        class="btn btn-info float-right">Export</a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('dss.sales-report')); ?>"
                                        class="btn btn-info float-right">Export</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <form action="<?php echo e(route('dss.index')); ?>" method="GET" class="search p-3">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <input type="hidden" name="search" value="1">
                                <div class="col-md-3">
                                    <span class="details">Start Date</span>
                                    <input type="date" name="start_date" value="<?php echo e($start_date); ?>" class="form-control"
                                        placeholder="Start Date">
                                </div>
                                <div class="form-group col-md-3">
                                    <span class="details">End Date</span>
                                    <input type="date" name="end_date" value="<?php echo e($end_date); ?>" class="form-control"
                                        placeholder="End Date">
                                </div>
                                <div class="form-group col-md-3">
                                    <span class="details">Phone</span>
                                    <input type="text" name="phone" value="<?php echo e($phone); ?>" class="form-control"
                                        placeholder="Phone">
                                </div>
                                <div class="col-md-1" style="margin-top: -8px;">
                                    <label for="">&nbsp;</label>
                                    <input style="color: white" type="submit" class="btn btn-info btn-block"
                                        value="Search">
                                </div>
                                
                                <div>


                        </form>
                    </div>



                    <div class="table-responsive pb-3">
                        <?php echo $__env->make('admin.dss.sales-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

        <form action="#" method="post" id="FORM_DELETE">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        </form>
        <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'DSS ' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/dss/index.blade.php ENDPATH**/ ?>