      <div class="container">
        <div class="row align-items-center justify-content-md-between">

          <div class="col-md-4">
            <div class="copyright text-left">
              &copy; <?php echo e(date('Y')); ?> <a href="<?php echo e(url('/')); ?>" class="text-primary" target="_blank"><?php echo e(setting('site_title')); ?></a>.
            </div>
          </div>
          <div class="col-md-4 text-lg-right btn-wrapper">
            <?php if( !empty($socialLink = setting('social_media_facebook')) ): ?>
            <a target="_blank" href="<?php echo e($socialLink); ?>" rel="nofollow" class="btn-icon-only rounded-circle btn btn-facebook" data-toggle="tooltip" data-original-title="Like us">
              <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
            </a>
            <?php endif; ?>
            <?php if( !empty($socialLink = setting('social_media_instagram')) ): ?>
            <a target="_blank" href="<?php echo e($socialLink); ?>" rel="nofollow" class="btn btn-icon-only btn-instagram rounded-circle" data-toggle="tooltip" data-original-title="Follow us">
              <span class="btn-inner--icon"><i class="fa fa-instagram"></i></span>
            </a>
            <?php endif; ?>
            <?php if( !empty($socialLink = setting('social_media_twitter')) ): ?>
            <a target="_blank" href="<?php echo e($socialLink); ?>" rel="nofollow" class="btn btn-icon-only btn-twitter rounded-circle" data-toggle="tooltip" data-original-title="Follow us">
              <span class="btn-inner--icon"><i class="fa fa-twitter"></i></span>
            </a>
            <?php endif; ?>
            <?php if( !empty($socialLink = setting('social_media_youtube')) ): ?>
            <a target="_blank" href="<?php echo e($socialLink); ?>" rel="nofollow" class="btn btn-icon-only btn-youtube rounded-circle" data-toggle="tooltip" data-original-title="Follow us">
              <span class="btn-inner--icon"><i class="fa fa-youtube"></i></span>
            </a>
            <?php endif; ?>
            <?php if( !empty($socialLink = setting('social_media_pinterest')) ): ?>
            <a target="_blank" href="<?php echo e($socialLink); ?>" rel="nofollow" class="btn btn-icon-only btn-pinterest rounded-circle" data-toggle="tooltip" data-original-title="Follow us">
              <span class="btn-inner--icon"><i class="fa fa-pinterest"></i></span>
            </a>
            <?php endif; ?>
            <?php if( !empty($socialLink = setting('social_media_envato')) ): ?>
            <a target="_blank" href="<?php echo e($socialLink); ?>" rel="nofollow" class="btn btn-icon-only btn-slack rounded-circle" data-toggle="tooltip" data-original-title="Follow us">
              <span class="btn-inner--icon"><img src="<?php echo e(asset('frontend')); ?>/img/envato.png" width="15" alt=""></span>
            </a>
            <?php endif; ?>
          </div>

        </div>
      </div>

<?php /**PATH C:\xampp\htdocs\crm\resources\views/frontend/layouts/footers/footer.blade.php ENDPATH**/ ?>