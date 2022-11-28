

<?php $__env->startSection('content'); ?>

        <div class="section-page-header bg-gradient-primary shadow text-center pt-9 pb-6 mb-6">
          <div class="container d-flex align-items-center">
            <div class="row w-100">
              <div class="col">
                <h1 class="display-title-home text-white"><?php echo e(__('frontend.frequently_asked_questions')); ?></h1>
              </div>
            </div>                

          </div>
        </div>
        <div class="container">

          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(setting('site_title')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('frontend.frequently_asked_questions')); ?></li>
            </ol>
          </nav>

        <div class="row">
          <div class="col">

            <?php $__empty_1 = true; $__currentLoopData = $faq_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

              <?php if(count($category->faqs) > 0): ?>

              <div class="section section-page">
                <h3 class="faq-title my-4" id="list-item-1"><?php echo e($category->name); ?></h3>
                <hr>

                <div class="accordion faq-accordion" id="question-category-<?php echo e($category->id); ?>">
  
                  <?php $__currentLoopData = $category->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="card">
                      <div class="card-header" id="question-heading-<?php echo e($category->id.'-'.$faq->id); ?>">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#question-<?php echo e($category->id.'-'.$faq->id); ?>" aria-expanded="true" aria-controls="question-<?php echo e($category->id.'-'.$faq->id); ?>">
                            <?php echo e($faq->question); ?>

                          </button>
                        </h5>
                      </div>

                      <div id="question-<?php echo e($category->id.'-'.$faq->id); ?>" class="collapse" aria-labelledby="question-heading-<?php echo e($category->id.'-'.$faq->id); ?>" data-parent="#question-category-<?php echo e($category->id); ?>">
                        <div class="card-body">
                        <?php echo e($faq->answer); ?>

                        </div>
                      </div>
                    </div>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div><!--.accordion-->
              </div>

              <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <div class="alert alert-danger">
              <?php echo e(__('frontend.no_faq_found')); ?>

            </div>

            <?php endif; ?>



      </div>

</div>

<?php echo $__env->make('frontend.layouts.partials.block_create_ticket', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

  <?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', ['body_class' => 'bg-default'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/frontend/faq.blade.php ENDPATH**/ ?>