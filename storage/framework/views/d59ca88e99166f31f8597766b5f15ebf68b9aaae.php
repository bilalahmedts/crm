

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
          <a href="<?php echo e(route('faqs.index')); ?>" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> <?php echo e(__('labels.faqs')); ?></a>
        </div>
    <?php $__env->stopPush(); ?>

    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => __('labels.faqs')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('labels.new_faq')); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?php echo e(route('faqs.store')); ?>" id="my-form" autocomplete="off">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('post'); ?>

                            <div class="pl-lg-4">

                                <div class="form-group<?php echo e($errors->has('category_id') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-category_id"><?php echo e(__('labels.category')); ?></label>
                                    <select name="category_id" id="input-category_id" class="form-control" required>
                                        <?php $__currentLoopData = $faq_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id')==$category->id ? 'selected' :''); ?>><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('category_id')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('category_id')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-question"><?php echo e(__('labels.question')); ?></label>
                                    <input type="text" name="question" id="input-question" class="form-control <?php echo e($errors->has('question') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Question')); ?>" value="<?php echo e(old('question')); ?>" required autofocus>

                                    <?php if($errors->has('question')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('question')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group<?php echo e($errors->has('answer') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-answer"><?php echo e(__('labels.answer')); ?></label>

                                    <textarea name="answer" id="input-answer" rows="6" class="form-control <?php echo e($errors->has('answer') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('answer')); ?>" required><?php echo e(old('answer')); ?></textarea>

                                    <?php if($errors->has('answer')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('answer')); ?></strong>
                                        </span>
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
            $(document).ready(() => {
                $('#basic-datatable').DataTable();
            });
        </script>
        <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'faq' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/faq/create.blade.php ENDPATH**/ ?>