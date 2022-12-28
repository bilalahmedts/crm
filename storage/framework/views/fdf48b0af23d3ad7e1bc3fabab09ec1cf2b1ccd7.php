<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => 'Call-Analytic-Sales-Import-Form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-md-12">
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
                        <form action="<?php echo e(route('call-analytic-sales.import')); ?>" method="POST" id="webform"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="form-control-label">Upload File</label><a href="<?php echo e(asset("call-analytics-sample-import-file.csv")); ?>" download>(Click here to download relevant file format)</a>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile02" name="file">
                                    <label class="custom-file-label text-left" for="inputGroupFile02"><i
                                            data-feather="upload" width="15"></i> <?php echo e(__('labels.select_file')); ?></label>
                                </div>
                                <div class="text-left">
                                    <button type="submit" class="btn btn-info mt-4">Upload</button>
                                </div>
                            </div>

                            <div>
                        </form>
                    </div>
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
                                <h3 class="mb-0">Call Analytics Salesheet</h3>
                            </div>							 
                        </div>
                    </div>
                    <div class="table-responsive pb-3">
                        <table class="table align-items-center table-flush"  > 
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="3%">ID</th>
									<th scope="col" width="3%">Sale Date</th>
                                    <th scope="col" width="3%">Name</th>
                                    <th scope="col" width="3%">HRMSID</th>
									<th scope="col" width="3%">Project Name</th> 
									<th scope="col" width="3%">Project Code</th> 
									<th scope="col" width="3%">Count</th> 
                                    <th scope="col" width="3%">Created at</th>	
                                    <?php if(in_array(Auth::user()->roles[0]->name, ['Super Admin'])): ?> 
                                    <th scope="col" width="3%">Action</th>	
                                    <?php endif; ?>
                                     
                                </tr>
                            </thead>
                            <tbody>  
                                <?php if(!$sales->isEmpty()): ?>
                                    <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(@$row->id); ?></td>
											<td><?php echo e(@$row->sale_date ?? ''); ?></td>
                                            
											<td><?php echo e(@$row->name ?? ''); ?></td>
                                            <td><?php echo e(@$row->hrms_id ?? ''); ?> </td>
                                            <td><?php echo e(@$row->project->name); ?></td>
                                            <td><?php echo e(@$row->project->project_code); ?></td> 
                                            <td><?php echo e(@$row->count); ?></td> 
                                            <td><?php echo e(@$row->created_at); ?></td> 
                                            <?php if(in_array(Auth::user()->roles[0]->name, ['Super Admin'])): ?>
                                            <td width="3%">  
                                                <a href="<?php echo e(route('call-analytic-sales-delete', $row->id)); ?>" class="btn btn-warning btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                             <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div style="padding: 22px;">
                            <?php echo e($sales->links()); ?>

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
        $('#inputGroupFile02').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', ['current_page' => 'call-analytic-sales-import-form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/call-analytic-sales/import-form.blade.php ENDPATH**/ ?>