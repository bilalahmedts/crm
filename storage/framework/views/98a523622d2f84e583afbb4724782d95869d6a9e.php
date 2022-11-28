<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => 'CMU-Sales-Import-Form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                        <form action="<?php echo e(route('cmu-sales.import')); ?>" method="POST" id="webform"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="form-control-label" for="upload_image">Upload File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="upload_image"
                                        lang="en">
                                    <label class="custom-file-label text-left" for="upload_image"><i data-feather="upload"
                                            width="15"></i> <?php echo e(__('labels.select_file')); ?></label>
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
        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', ['current_page' => 'cmu-sales-import-form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/cmu-sales/import-form.blade.php ENDPATH**/ ?>