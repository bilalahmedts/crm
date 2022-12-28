<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => 'Eddy-Sales-Import-Form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger"style="color: white;">
                                <strong class="text-secondary">Oops!</strong> There were some problems with your
                                input.<br><br>
                                <ul style="color: white;padding-left:20px">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li style="color: white"><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if($message = Session::get('success')): ?>
                            <div class="col-lg-12 text-center"
                                style="margin-top:10px;margin-bottom: 10px; padding-left:50px">
                                <div class="alert alert-success" style="color: white">
                                    <?php echo e($message); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('eddy-sales.import')); ?>" method="POST" id="webform"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="form-control-label">Upload File
                                        <a href="<?php echo e(asset('Eddy-Import-Format-Files.zip')); ?>" download>
                                            (Click here to download relevant files format)</a></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile02"
                                            name="file">
                                        <label class="custom-file-label text-left" for="inputGroupFile02">
                                            <i data-feather="upload" width="15"></i>
                                            <?php echo e(__('labels.select_file')); ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <button type="submit" class="form-control btn btn-info">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="mb-0">Search</h3>
                            </div>
                        </div>
                    </div>
                    <form action="<?php echo e(route('eddy-sales.import-form')); ?>" method="GET" id="webform" style="padding:15px"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="form-control-label">AGENT ID</label>
                                <input type="text" value="<?php echo e(@$_GET['agent_id']); ?>" name="agent_id" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label">Date</label>
                                <input type="date" value="<?php echo e(@$_GET['date']); ?>" name="date" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label">Select Type</label>
                                <select value="<?php echo e(@$_GET['type']); ?>" name="type" class="form-control">
                                    <option value="">--Select--</option>
                                    <option <?php echo e(@$_GET['type'] == 'Inbound' ? 'selected' : ''); ?> value="Inbound">Inbound
                                    </option>
                                    <option <?php echo e(@$_GET['type'] == 'Outbound' ? 'selected' : ''); ?> value="Outbound">
                                        Outbound
                                    </option>
                                    <option <?php echo e(@$_GET['type'] == 'EddyEdu' ? 'selected' : ''); ?> value="EddyEdu">EddyEdu
                                    </option>
                                </select>
                            </div>
                        </div>
						<div class="row">
						<div class="form-group col-sm-2">
                            <button type="submit" class="form-control btn btn-info">Search</button>
                        </div>
						<div class="form-group col-sm-2">
                            <a href="<?php echo e(route('eddy-sales.import-form')); ?>" class="form-control btn btn-info">Clear</a>
                        </div>
						</div>
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-11">
                                <h3 class="mb-0">Eddy Salesheet</h3>
                            </div>
                            <div class="col-1">
                                <a href="<?php echo e(route('eddy-sales.eddy-export')); ?>?agent_id=<?php echo e(@$_GET['agent_id']); ?>&date=<?php echo e(@$_GET['date']); ?>&type=<?php echo e(@$_GET['type']); ?>"
                                    class="btn btn-info btn-md">Export</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive pb-3">
                        <table class="table align-items-center table-flush" id="basic-datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="3%">ID</th>
                                    <th scope="col" width="3%">Sale Date</th>
                                    <th scope="col" width="3%">HRMS ID</th>
                                    <th scope="col" width="3%">Agent ID</th>
                                    <th scope="col" width="3%">Billable Hours</th>
                                    <th scope="col" width="3%">Call Hours</th>
                                    <th scope="col" width="3%">Calls Per Billable Hours
                                    </th>
                                    <th scope="col" width="3%">Total Calls
                                    </th>
                                    <th scope="col" width="3%">Total Connects
                                    </th>
                                    <th scope="col" width="3%">Connects
                                    </th>
                                    <th scope="col" width="3%">Connect Percentage
                                    </th>
                                    <th scope="col" width="3%">Deassign Percentage
                                    </th>
                                    <th scope="col" width="3%">AHT
                                    </th>
                                    <th scope="col" width="3%">Edu Transfers
                                    </th>
                                    <th scope="col" width="3%">Edu TPH
                                    </th>
                                    <th scope="col" width="3%">Edu Transfer Rate
                                    </th>
                                    <th scope="col" width="3%">Edu Conversions
                                    </th>
                                    <th scope="col" width="3%">Edu CPH
                                    </th>
                                    <th scope="col" width="3%">Edu Conv Percentage of Transfers
                                    </th>
                                    <th scope="col" width="3%">Edu Conv Percentage of Connects
                                    </th>
                                    <th scope="col" width="3%">Edu Conv Percentage of total calls
                                    </th>
                                    <th scope="col" width="3%">Transfers
                                    </th>
                                    <th scope="col" width="3%">Transfers Percentage
                                    </th>
                                    <th scope="col" width="3%">People
                                    </th>
                                    <th scope="col" width="3%">Forms
                                    </th>
                                    <th scope="col" width="3%">LTs
                                    </th>
                                    <th scope="col" width="3%">Conv Percentage
                                    </th>
                                    <th scope="col" width="3%">LT Percentage
                                    </th>
                                    <th scope="col" width="3%">LPP
                                    </th>
                                    <th scope="col" width="3%">LPH
                                    </th>
                                    <th scope="col" width="3%">WLPH
                                    </th>
                                    <th scope="col" width="3%">PPH
                                    </th>
                                    <th scope="col" width="3%">WLPC
                                    </th>
                                    <th scope="col" width="3%">Type</th>
                                    <th scope="col" width="3%">Created at</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!$eddy->isEmpty()): ?>
                                    <?php $count = 1; ?>
                                    <?php $__currentLoopData = $eddy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>

                                            <td><?php echo e($count++); ?></td>
                                            <td><?php echo e(date('m-d-Y', strtotime(@$row->sale_date))); ?></td>
                                            <td><?php echo e(@$row->hrms_id ?? ''); ?></td>
                                            <td><?php echo e(@$row->agent_id ?? 0); ?> </td>
                                            <td><?php echo e(@$row->billable_hours ?? ''); ?></td>
                                            <td><?php echo e(@$row->call_hours ?? ''); ?></td>
                                            <td><?php echo e(@$row->calls_per_billable_hours ?? ''); ?></td>
                                            <td><?php echo e(@$row->total_calls ?? ''); ?></td>
                                            <td><?php echo e(@$row->total_connects ?? ''); ?></td>
                                            <td><?php echo e(@$row->connects ?? ''); ?></td>
                                            <td><?php echo e(@$row->connect_percentage ?? ''); ?></td>
                                            <td><?php echo e(@$row->deassign_percentage ?? ''); ?></td>
                                            <td><?php echo e(@$row->aht ?? ''); ?></td>
                                            <td><?php echo e(@$row->edu_transfers ?? ''); ?></td>
                                            <td><?php echo e(@$row->edu_tph ?? ''); ?></td>
                                            <td><?php echo e(@$row->edu_transfer_rate ?? ''); ?></td>
                                            <td><?php echo e(@$row->edu_conversions ?? ''); ?></td>
                                            <td><?php echo e(@$row->edu_cph ?? ''); ?></td>
                                            <td><?php echo e(@$row->edu_conv_percentage_of_transfers ?? ''); ?></td>
                                            <td><?php echo e(@$row->edu_conv_percentage_of_connects ?? ''); ?></td>
                                            <td><?php echo e(@$row->edu_conv_percentage_of_total_calls ?? ''); ?></td>
                                            <td><?php echo e(@$row->transfers ?? ''); ?></td>
                                            <td><?php echo e(@$row->transfers_percentage ?? ''); ?></td>
                                            <td><?php echo e(@$row->people ?? ''); ?></td>
                                            <td><?php echo e(@$row->forms ?? ''); ?></td>
                                            <td><?php echo e(@$row->lts ?? ''); ?></td>
                                            <td><?php echo e(@$row->conv_percentage ?? ''); ?></td>
                                            <td><?php echo e(@$row->lt_percentage ?? ''); ?></td>
                                            <td><?php echo e(@$row->lpp ?? ''); ?></td>
                                            <td><?php echo e(@$row->lph ?? ''); ?></td>
                                            <td><?php echo e(@$row->wlph ?? ''); ?></td>
                                            <td><?php echo e(@$row->pph ?? ''); ?></td>
                                            <td><?php echo e(@$row->wlpc ?? ''); ?></td>
                                            <td><?php echo e(@$row->type); ?></td>
                                            <td><?php echo e(date('m-d-Y', strtotime(@$row->created_at))); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        $('#inputGroupFile02').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $(document).ready(function() {
            $('#basic-datatable').DataTable();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', ['current_page' => 'eddy-sales-import-form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/eddy-sales/import-form.blade.php ENDPATH**/ ?>