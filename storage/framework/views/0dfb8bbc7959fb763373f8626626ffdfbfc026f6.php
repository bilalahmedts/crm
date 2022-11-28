<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0"><?php echo e(__('labels.priority')); ?></h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form method="post" action="<?php echo e(route('priorities.store')); ?>" id="my-form" autocomplete="off">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="pl-lg-4">
                <div class="form-group <?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
                    <label class="form-control-label" for="input-name"><?php echo e(__('labels.name')); ?></label>
                    <input type="text" name="name" id="input-name" class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('labels.name')); ?>" value="<?php echo e(old('name')); ?>" onkeyup="$('#badge-preview').text(this.value)" required autofocus>

                    <?php if($errors->has('name')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('name')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group <?php echo e($errors->has('color') ? ' has-danger' : ''); ?>">
                    <label for="example-color-input" class="form-control-label"><?php echo e(__('labels.color')); ?></label>
                      <input class="form-control" name="color" type="text" value="#217ff3" id="example-color-input">
                </div>

                <div class="form-group <?php echo e($errors->has('color_text') ? ' has-danger' : ''); ?>">
                    <label for="color-text-input" class="form-control-label"><?php echo e(__('labels.color_text')); ?></label>
                      <input class="form-control" name="color_text" type="text" value="#fff" id="color-text-input">
                </div>

                <div class="form-group">
                    <label for="" class="form-control-label"><?php echo e(__('labels.preview')); ?> </label>
                    <div>
                        <span class="badge badge-pill" id="badge-preview" style="background-color: #217ff3; color: #fff;"><?php echo e(__('labels.test')); ?></span>
                    </div>
                </div>

                <div class="text-left">
                    <button type="submit" class="btn btn-info mt-4"><?php echo e(__('labels.submit')); ?></button>
                </div>
            </div>

        </form>
    </div>

</div>

<?php $__env->startPush('js'); ?>
<script>
    let backgroundColor = setColorPicker('#example-color-input', document.querySelector('#example-color-input').value);
    let colortext = setColorPicker('#color-text-input', document.querySelector('#color-text-input').value);

    backgroundColor.on('change', (color, instance) => {
        $('#badge-preview').css('background-color', color.toRGBA().toString(0));
    });

    colortext.on('change', (color, instance) => {
        $('#badge-preview').css('color', color.toRGBA().toString(0));
    });

</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/priority/partials/add_new_form.blade.php ENDPATH**/ ?>