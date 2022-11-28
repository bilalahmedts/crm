

<?php $__env->startSection('content'); ?>

    <?php $__env->startPush('header-buttons'); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.create')): ?>
            <div class="col-lg-6 col-5 text-right">
              <a href="<?php echo e(route('tickets.create')); ?>" class="btn btn-sm btn-icon btn-neutral">
                <i data-feather="plus" stroke-width="3" width="12"></i> <?php echo e(__('labels.new_ticket')); ?></a>
            </div>
        <?php endif; ?>
    <?php $__env->stopPush(); ?>

    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => __('labels.tickets')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <h3 class="mb-0"><?php echo e(__('labels.manage_tickets')); ?></h3>
                            </div>
                            <div class="col-8">
                                <!-- Filter Buttons -->

                                <form id="filter-form" action="<?php echo e(url()->current()); ?>" method="GET">
                                    
                                    <div class="row">
                                        <div class="col"></div>
                                        <div class="col-2">
                                            <div class="form-group text-center">
                                                <select name="sort" id="sort" class="select2-select" onchange="$(this).parents('form').submit()">
                                                    <option value="latest" <?php echo e(request()->sort == 'latest' ? 'selected' : ''); ?>><?php echo e(__('labels.latest')); ?></option>
                                                    <option value="oldest" <?php echo e(request()->sort == 'oldest' ? 'selected' : ''); ?>><?php echo e(__('labels.oldest')); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                                

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive pb-3">
                        <table class="table align-items-center table-flush" id="basic-datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="customCheckAll">
                                          <label class="custom-control-label" for="customCheckAll"></label>
                                        </div>
                                    </th>
                                    <th scope="col"><?php echo e(__('labels.id')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.title')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.customer')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.user')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.department')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.priority')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.status')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.reply_status')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.last_update')); ?></th>
                                    <th scope="col"><?php echo e(__('labels.created_at')); ?></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                              <input type="checkbox" class="custom-control-input checkbox-tickets-select" id="customCheck<?php echo e($i); ?>" value="<?php echo e($ticket->id); ?>">
                                              <label class="custom-control-label" for="customCheck<?php echo e($i); ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('tickets.show', $ticket->id)); ?>"><?php echo e($ticket->id); ?></a>
                                        </td>
                                        <td class="table-user">
                                            <a href="<?php echo e(route('tickets.show', $ticket->id)); ?>" class="text-gray-dark"><b class="pl-3"><?php echo e($ticket->title); ?></b></a>
                                        </td>
                                        <td>
                                            <img alt="Image placeholder" src="<?php echo e(asset('uploads/customer/'.@$ticket->customer->image)); ?>" class="avatar avatar-sm rounded-circle profile-user-image">
                                            <span class="pl-3"><?php echo e(@$ticket->customer->name); ?></span>
                                        </td>
                                        <td>
                                            <?php if($ticket->user_id > 0 && !empty($ticket->user)): ?>
                                                <img alt="Image placeholder" src="<?php echo e(asset('uploads/user/'.@$ticket->user->image)); ?>" class="avatar avatar-sm rounded-circle profile-user-image">
                                                <span class="pl-3"><?php echo e(@$ticket->user->name); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($ticket->department->name); ?>

                                        </td>
                                        <td>
                                            <?php echo priority_label($ticket->priority); ?>

                                        </td>
                                        <td>
                                            <?php echo status_label($ticket->status); ?>

                                        </td>
                                        <td>
                                            <?php echo reply_status_label($ticket->status_reply); ?>

                                        </td>
                                        <td>
                                            <span title="<?php echo e($ticket->updated_at->format( setting('datetime_format') )); ?>"><?php echo e($ticket->updated_at->diffForHumans()); ?></span>
                                        </td>
                                        <td>
                                            <span title="<?php echo e($ticket->created_at->format( setting('datetime_format') )); ?>"><?php echo e($ticket->created_at->format( setting('date_format') )); ?></span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.reply_ticket')): ?>
                                                            <a class="dropdown-item" href="<?php echo e(route('tickets.show', $ticket->id)); ?>"><?php echo e(__('labels.view_reply')); ?></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.assign_user')): ?>
                                                            <a class="dropdown-item" href="#" onclick="$('#assign_user_ticket_ids').val(<?php echo e($ticket->id); ?>)" data-toggle="modal" data-target="#modal-assign-user-ticket-form"><?php echo e(__('labels.assign_user')); ?></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.edit')): ?>
                                                            <a class="dropdown-item" href="<?php echo e(route('tickets.edit', $ticket->id)); ?>"><?php echo e(__('labels.edit')); ?></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.delete')): ?>
                                                            <a class="dropdown-item delete-btn" href="#" onclick="if(confirm('<?php echo e(__('labels.confirm_delete')); ?>')){  $('#FORM_DELETE').attr('action', '<?php echo e(route('tickets.destroy', $ticket->id)); ?>').submit(); }" ><?php echo e(__('labels.delete')); ?></a>
                                                        <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="11" class="text-center">
                                            <?php echo e(__('labels.no_data_found')); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([ 'ticket.edit', 'ticket.delete' ])): ?>
                          <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="ticketWithSelected"><?php echo e(__('labels.with_selected')); ?></button>
                                <div class="dropdown-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.edit')): ?>
                                  <a class="dropdown-item text-primary" href="#" onclick="assignMultipleUsers(); return false;"><i class="fa fa-user"></i> &nbsp;<?php echo e(__('labels.assign_user')); ?></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.delete')): ?>
                              <a class="dropdown-item text-primary" href="#" onclick="deleteTickets(); return false;"><i class="fa fa-trash"></i> &nbsp;<?php echo e(__('labels.delete')); ?></a>
                                <?php endif; ?>
                            </div>
                          </div><!-- /btn-group -->
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>

        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.edit')): ?>
            <?php echo $__env->make('admin.ticket.modal_assign_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>



    </div>
<?php $__env->stopSection(); ?>


        <?php $__env->startPush('js'); ?>

        <script>
            $(document).ready(() => {

                $('#basic-datatable').DataTable();

                $('#customCheckAll').on('change', function() {
                    $('.checkbox-tickets-select').prop('checked', $(this).is(':checked')).trigger('change');
                    ticketCheckUpdateFunc();
                });

                $('.checkbox-tickets-select').on('change', function() {

                    if($(this).is(':checked'))
                        $(this).parents('tr').addClass('bg-secondary');
                    else
                        $(this).parents('tr').removeClass('bg-secondary');

                    if(!$(this).is(':checked')){
                        $('#customCheckAll').prop('checked', false);
                    }
                    ticketCheckUpdateFunc();
                });


                window.ticketCheckUpdateFunc = () => {

                    var isAnyChecked = false;

                    $('.checkbox-tickets-select').each(function() {
                        if($(this).is(':checked')){
                            isAnyChecked = true;
                            return false;
                        }
                    });

                    $('#ticketWithSelected').prop('disabled', !isAnyChecked);

                };

                ticketCheckUpdateFunc();

            });

            window.assignMultipleUsers = () => {
                let values = $('.checkbox-tickets-select:checked').map(function() {return parseInt(this.value);}).get().join(',');

                $('#assign_user_ticket_ids').val(values);
                $('#modal-assign-user-ticket-form').modal('show');
            };

            window.deleteTickets = () => {

                if(!confirm('Are you want to delete the selected tickets ?'))
                    return false;

                let values = $('.checkbox-tickets-select:checked').map(function() {return parseInt(this.value);}).get().join(',');

                $('#FORM_MULTI_DELETE').find('input[name=ticket_ids]').val(values);
                $('#FORM_MULTI_DELETE').attr('action', '<?php echo e(route('tickets.destroy_multiple')); ?>').submit();

            };


            /**
             * Filters
             */
            $('select.select2-select').select2({
                minimumResultsForSearch: -1
            });

        </script>

        <form action="#" method="post" id="FORM_DELETE">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>

            <form action="#" method="post" id="FORM_MULTI_DELETE">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <input type="hidden" name="ticket_ids" value="0" />
            </form>

        <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'tickets' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/ticket/index.blade.php ENDPATH**/ ?>