<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.headers.cards', [ 'title' => 'Dashboard' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    
    
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-4 col-md-6">
          <div class="card bg-gradient-info">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Leads</h5>
                  <span class="h2 font-weight-bold mb-0 text-white"><?php echo e($open_tickets); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-primary rounded-circle shadow">
                    <i class="fa fa-life-ring"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card bg-gradient-dark">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Sales</h5>
                  <span class="h2 font-weight-bold mb-0 text-white"><?php echo e($total_tickets); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                    <i class="fa fa-life-ring"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card bg-gradient-success">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Billable Leads</h5>
                  <span class="h2 font-weight-bold mb-0 text-white"><?php echo e($unreplied_tickets); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-success rounded-circle shadow">
                    <i class="fa fa-life-ring"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo e(asset('admin')); ?>/vendor/chart.js/dist/Chart.extension.js"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'dashboard' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/agent_dashboard.blade.php ENDPATH**/ ?>