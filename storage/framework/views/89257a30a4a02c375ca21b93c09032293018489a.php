

<?php $__env->startSection('content'); ?>
    
    <div class="section section-hero section-shaped section-header">
      <div class="shape shape-style-theme shape-background" style="background-image: url('<?php echo e(asset('uploads/'.setting('frontend_home_header'))); ?>')">
        <div class="shape-overlay bg-gradient-primary opactiy-9"></div>
      </div>
      <div class="page-header">
        <div class="container shape-container text-center py-lg">
          <div class="px-0">
            <h1 class="display-title-home"><?php echo __('frontend.home_title'); ?></h1>
            <p class="text-white" style="letter-spacing: 2px;"><?php echo e(__('frontend.home_subtitle')); ?></p>
            
            <br>
            <form action="<?php echo e(route('search')); ?>" method="get" id="search_form">
              <div class="search-header mt-4 mb-6">
                <input type="text" autocomplete="off" name="query" class="form-control search-header-input" placeholder="<?php echo e(__('frontend.search_placeholder')); ?>" />
                <a href="#" onclick="$(this).parents('form').submit();"><span class="search-icon"></span></a>
                <p class="text-white text-left pt-3" style="font-style: italic; font-size: .9rem;"><?php echo e(__('frontend.home_popular_topics')); ?>                  <?php $__currentLoopData = json_decode(setting('popular_categories')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(kb_category_url(\App\Models\KbCategory::find($id))); ?>"><?php echo e(\App\Models\KbCategory::find($id)->name); ?></a>
                <?php if($key < count(json_decode(setting('popular_categories')))-1): ?>
                  ,&nbsp;
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon style="fill: #fafafa;" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <div class="section section-blocks">
      <div class="container">
        <h3 class="text-center my-5"><?php echo __('frontend.home_explore_kb'); ?></h3>
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
        <div class="text-center pt-5">
          <a href="<?php echo e(route('kb.all-categories')); ?>" class="btn btn-primary"><?php echo __('frontend.view_all'); ?></a>
        </div>
      </div>
    </div>
    <div class="section section-articles">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h3 class="title"><?php echo e(__('frontend.popular_articles')); ?></h3>
              <ul class="kb-list">
                <?php $__currentLoopData = $popular_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><a href="<?php echo kb_article_url($article); ?>"><span><i class="fa fa-file-text-o"></i></span> <?php echo e($article->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
          </div>
          <div class="col-md-4">
            <h3 class="title"><?php echo e(__('frontend.recent_articles')); ?></h3>
              <ul class="kb-list">
                <?php $__currentLoopData = $recent_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><a href="<?php echo kb_article_url($article); ?>"><span><i class="fa fa-file-text-o"></i></span> <?php echo e($article->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
                
          </div>
          <div class="col-md-4">
            <h3 class="title"><?php echo e(__('frontend.helpful_articles')); ?></h3>
              <ul class="kb-list">
                <?php $__currentLoopData = $helpful_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><a href="<?php echo kb_article_url($article); ?>"><span><i class="fa fa-file-text-o"></i></span> <?php echo e($article->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
                
          </div>
        </div>
      </div>
    </div>

    <?php echo $__env->make('frontend.layouts.partials.block_create_ticket', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', ['body_class' => 'bg-default', 'nav_class' => 'navbar-transparent'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/frontend/home.blade.php ENDPATH**/ ?>