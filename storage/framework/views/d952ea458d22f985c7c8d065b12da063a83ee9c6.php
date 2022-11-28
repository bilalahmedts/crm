<!-- Topnav -->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-gradient-info border-bottom">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar links -->
      <ul class="navbar-nav align-items-left">
        <li class="nav-item">
          <!-- Sidenav toggler -->
          <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </li>
      </ul>

      <ul class="navbar-nav align-items-center ml-md-auto">

        <!-- <li class="nav-item">
          <a class="nav-link" href="<?php echo e(route('home')); ?>" target="_blank">
            <?php echo e(__('labels.visit_site')); ?> <i data-feather="external-link" width="17"></i>
          </a>
        </li> -->

        <!-- <li class="nav-item dropdown text-uppercase">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-globe-europe"></i> <span class="pl-1"> <?php echo e(strtoupper(app()->getLocale())); ?> </span>
          </a>          
          <div class="dropdown-menu dropdown-menu-right">
            <?php $__currentLoopData = getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('front.set_language', [$lang])); ?>" class="dropdown-item">
                  <span class="nav-link-inner--text"><?php echo e(strtoupper($lang)); ?></span>
                </a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </li> -->
        
      </ul>
      <ul class="navbar-nav align-items-center ml-auto ml-md-0">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="<?php echo e(asset('uploads/user/'.auth()->user()->image)); ?>" class="profile-user-image">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo e(auth()->user()->name); ?></span>
                </div>
            </div>
          </a>          
          <div class="dropdown-menu dropdown-menu-right">
            <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0"><?php echo e(__('labels.welcome')); ?></h6>
            </div>
            <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span><?php echo e(__('labels.profile')); ?></span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#!" class="dropdown-item" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="ni ni-button-power"></i>
                <span><?php echo e(__('labels.logout')); ?></span>
            </a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/layouts/navbars/navbar.blade.php ENDPATH**/ ?>