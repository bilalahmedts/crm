

<?php $__env->startSection('content'); ?>
    
    
<div class="section-page-header bg-gradient-primary shadow text-center pt-9 pb-6 mb-6">
  <div class="container d-flex align-items-center">
    <div class="row w-100">
      <div class="col">
        <h1 class="display-title-home text-white"><?php echo __('frontend.home_explore_kb'); ?></h1>
      </div>
    </div>                

  </div>
</div>


    <div class="section section-blocks">
      <div class="container">
        <div class="row align-items-center">
          <?php $__currentLoopData = $kb_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kb_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-4">
            <a href="<?php echo e(kb_category_url($kb_category)); ?>">
              <div class="block-info">
                  <div class="block-icon">
                    <img src="<?php echo e(decode_icon_url($kb_category->img)); ?>" alt="">
                  </div>
                  <h5 class="title"><?php echo e($kb_category->name); ?></h5>
              </div>
            </a>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

      </div>
    </div>

    <?php echo $__env->make('frontend.layouts.partials.block_create_ticket', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', ['body_class' => 'bg-default', 'nav_class' => 'navbar-transparent'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/frontend/knowledge_bases/all-categories.blade.php ENDPATH**/ ?>