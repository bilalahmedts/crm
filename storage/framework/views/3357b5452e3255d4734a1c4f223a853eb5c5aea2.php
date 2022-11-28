

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />

<div class="container mt-5">

  <div class="row">
    <div class="col">

      <div class="row">
        <div class="col-xl-4 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e(__('frontend.all_tickets')); ?></h5>
                  <span class="h2 font-weight-bold mb-0"><?php echo e($totalAll); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                    <i class="ni ni-support-16"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e(__('frontend.open')); ?></h5>
                  <span class="h2 font-weight-bold mb-0"><?php echo e($totalOpen); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                    <i class="ni ni-support-16"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e(__('frontend.closed')); ?></h5>
                  <span class="h2 font-weight-bold mb-0"><?php echo e($totalClosed); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                    <i class="ni ni-support-16"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="card bg-white mt-4">

              <!-- Card header -->
              <div class="card-header bg-white border-0">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <h3 class="mb-0"><?php echo e(__('frontend.tickets')); ?></h3>
                  </div>
                  <div class="col-12 col-md-6 text-right">
                      <a href="<?php echo e(route('customer.ticket_new')); ?>" class="btn btn-primary" data-original-title="" title="">
                      <?php echo __('frontend.create_ticket'); ?>

                        
                      </a>
                  </div>
                </div>
                
              </div>
              <div class="card-body px-0">
                
              <form action="<?php echo e(route('customer.tickets.filter', $ticketStatus )); ?>" method="GET">
                <div class="row px-3">
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <input type="text" name="query" placeholder="Search Title, Description, ID..." class="form-control" value="<?php echo e(request('query')); ?>" />
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <button type="submit" class="btn btn-dark"><?php echo e(__('labels.search')); ?></button>
                    </div>
                  </div>
                </div>
              </form>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link <?php echo e($ticketStatus=='all' ? 'active' :''); ?>" href="<?php echo e(route('customer.tickets.filter', 'all')); ?>"><?php echo e(__('frontend.all_tickets')); ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo e($ticketStatus=='open' ? 'active' :''); ?>" href="<?php echo e(route('customer.tickets.filter', 'open')); ?>"><?php echo e(__('frontend.open')); ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo e($ticketStatus=='closed' ? 'active' :''); ?>" href="<?php echo e(route('customer.tickets.filter', 'closed')); ?>"><?php echo e(__('frontend.closed')); ?></a>
                  </li>
                </ul>
              </div>
              <!-- Light table -->
              <div class="table-responsive">
                <table class="table" id="basic-datatables">
                  <thead>
                      <tr>
                          <th class="text-center">#</th>
                          <th><?php echo e(__('labels.title')); ?></th>
                          <th><?php echo e(__('labels.status')); ?></th>
                          <th width="20%"><?php echo e(__('labels.date')); ?></th>
                          <th class="text-right" width="10%"></th>
                      </tr>
                  </thead>
                  <tbody>

                    <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td class="text-center"><a href="<?php echo e(route('customer.tickets_view', $ticket->id)); ?>"><?php echo $ticket->id ?></a></td>
                          <td width="40%"><a href="<?php echo e(route('customer.tickets_view', $ticket->id)); ?>"><?php echo e($ticket->title); ?></a></td>
                          <td><?php echo $ticket->status=='open' ? front_reply_status_label($ticket->status_reply) : front_status_label($ticket->status); ?></td>
                          <td title="<?php echo e($ticket->created_at->format(setting('datetime_format'))); ?>"><?php echo e($ticket->created_at->diffForHumans()); ?></td>
                          <td class="td-actions text-center">
                            <a href="<?php echo e(route('customer.tickets_view', $ticket->id)); ?>" rel="tooltip" class="text-primary" data-original-title="" title="">
                              <i data-feather="link" width="17" stroke-width="2"></i>
                              </a>
                          </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </tbody>
              </table>
              </div>
              <!-- Card footer -->
              <div class="card-footer bg-white py-4">

              <?php echo e($tickets->links('customer-panel.tickets.partials.pagination')); ?>

                
              </div>

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
      "order": [],
      // "ordering": false,
      "info":     false
    });
} );
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', ['body_class' => 'bg-default', 'nav_class' => 'navbar-theme'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/customer-panel/tickets/index.blade.php ENDPATH**/ ?>