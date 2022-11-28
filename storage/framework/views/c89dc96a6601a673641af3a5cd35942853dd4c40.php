

<?php $__env->startSection('content'); ?>
<div class="container">
  

<div class="section-page-header text-center">
  <div class="container d-flex align-items-center">

  </div>
</div>

<div class="row">
  <div class="col">

    <div class="card bg-white mt-7 mx-lg-9">

      <div class="card-header bg-white">
          <div class="row align-items-center">
            <div class="col-12 col-lg-8">
              <h3 class="mb-0"><?php echo e(__('frontend.create_new_ticket')); ?> </h3>
            </div>
          </div>
        </div>

      <div class="card-body">

            <form action="<?php echo e(route('customer.ticket_save')); ?>" method="post" id="my-form" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('post'); ?>
                  <div class="form-group">
                    <label class="form-control-label" for="input-department"><?php echo e(__('labels.departments')); ?></label>
                    <select id="input-department" class="form-control" name="department_id" required autofocus>
                      <option value=""><?php echo e(__('labels.select_department')); ?></option>
                      <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('department_id')): ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('department_id')); ?></strong>
                          </span>
                      <?php endif; ?>
                  </div>

                  <div class="form-group">
                    <label class="form-control-label" for="input-priority"><?php echo e(__('labels.priority')); ?></label>
                    <select id="input-priority" class="form-control" name="priority_id" required>
                      <?php $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($priority->id); ?>"><?php echo e($priority->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('priority_id')): ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('priority_id')); ?></strong>
                          </span>
                      <?php endif; ?>
                  </div>

                  <div class="form-group">
                    <label class="form-control-label" for="input-name"><?php echo e(__('labels.subject')); ?></label>
                    <input type="text" id="input-name" name="title" class="form-control" required placeholder="<?php echo e(__('labels.subject')); ?>" required minlength="3" value="">
                    <?php if($errors->has('title')): ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('title')); ?></strong>
                          </span>
                      <?php endif; ?>
                  </div>

              <div class="form-group">
                <label class="form-control-label" for="input-description"><?php echo e(__('labels.description')); ?></label>
                <textarea class="form-control" name="description" id="input-description" rows="12"  required minlength="15" placeholder="<?php echo e(__('labels.description')); ?>"></textarea>
                    <?php if($errors->has('description')): ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('description')); ?></strong>
                          </span>
                      <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="exampleFormControlFile1"><?php echo e(__('labels.attachment')); ?></label>
                <input type="file" class="form-control-file" name="reply_attachments" multiple id="exampleFormControlFile1">
                    <?php if($errors->has('reply_attachments')): ?>
                          <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('reply_attachments')); ?></strong>
                          </span>
                      <?php endif; ?>
              </div>

              

              <div class="form-group">
                  <?php if(setting('RECAPTCH_TYPE')=='GOOGLE'): ?>
                    <div class="g-recaptcha" data-sitekey="<?php echo e(setting('GOOGLE_RECAPTCHA_KEY')); ?>"></div>
                     <?php if($errors->has('g-recaptcha-response')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                        </span>
                    <?php endif; ?>
                  <?php endif; ?>

                </div>

                <div class="form-group mt-5">
                  <button type="submit" class="btn btn-md btn-primary"><i data-feather="save" width="15" stroke-width="2"></i> &nbsp; <?php echo e(__('labels.submit')); ?></button>
            </div>
            
          </form>
      
      </div>

  </div>

</div>


</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>


<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready( function () {
    $('#basic-datatables').DataTable({
      "searching":   false,
      "paging":   false,
      // "ordering": false,
      "info":     false
    });
} );


if ( document.getElementById('my-form') ) {
  $("#my-form").parsley({
     errorClass: 'is-invalid text-danger',
     // successClass: 'is-valid',
     errorsWrapper: '<span class="form-text text-danger"></span>',
     errorTemplate: '<span></span>',
     trigger: 'change',
     errorsContainer: function(el) {
          return el.$element.closest('.form-group');
      },
   });
}
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', ['body_class' => 'bg-default', 'nav_class' => 'navbar-theme'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/customer-panel/tickets/create.blade.php ENDPATH**/ ?>