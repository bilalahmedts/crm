<table class="table align-items-center table-flush">
    <thead>
        <tr>
            <th>Sale Date</th>
            <th>HRMS ID</th>
            <th>Agent ID</th>
            <th>Billable Hours</th>
            <th>Call Hours</th>
            <th>Calls Per Billable Hours
            </th>
            <th>Total Calls
            </th>
            <th>Total Connects
            </th>
            <th>Connects
            </th>
            <th>Connect Percentage
            </th>
            <th>Deassign Percentage
            </th>
            <th>AHT
            </th>
            <th>Edu Transfers
            </th>
            <th>Edu TPH
            </th>
            <th>Edu Transfer Rate
            </th>
            <th>Edu Conversions
            </th>
            <th>Edu CPH
            </th>
            <th>Edu Conv Percentage of Transfers
            </th>
            <th>Edu Conv Percentage of Connects
            </th>
            <th>Edu Conv Percentage of total calls
            </th>
            <th>Transfers
            </th>
            <th>Transfers Percentage
            </th>
            <th>People
            </th>
            <th>Forms
            </th>
            <th>LTs
            </th>
            <th>Conv Percentage
            </th>
            <th>LT Percentage
            </th>
            <th>LPP
            </th>
            <th>LPH
            </th>
            <th>WLPH
            </th>
            <th>PPH
            </th>
            <th>WLPC
            </th>
            <th>Type</th>
            <th>Created at</th>

        </tr>
    </thead>
    <tbody>
        <?php if(!$eddy->isEmpty()): ?>
            <?php $count = 1; ?>
            <?php $__currentLoopData = $eddy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(date('m-d-Y', strtotime(@$row->sale_date))); ?></td>
                    <td><?php echo e(@$row->hrms_id ?? ''); ?></td>
                    <td><?php echo e(@$row->agent_id ?? 0); ?> </td>
                    <td><?php echo e(@$row->billable_hours ?? ''); ?></td>
                    <td><?php echo e(@$row->call_hours ?? ''); ?></td>
                    <td><?php echo e(@$row->calls_per_billable_hours ?? ''); ?></td>
                    <td><?php echo e(@$row->total_calls ?? ''); ?></td>
                    <td><?php echo e(@$row->total_connects ?? ''); ?></td>
                    <td><?php echo e(@$row->connects ?? ''); ?></td>
                    <td><?php echo e(@$row->connect_percentage ?? ''); ?></td>
                    <td><?php echo e(@$row->deassign_percentage ?? ''); ?></td>
                    <td><?php echo e(@$row->aht ?? ''); ?></td>
                    <td><?php echo e(@$row->edu_transfers ?? ''); ?></td>
                    <td><?php echo e(@$row->edu_tph ?? ''); ?></td>
                    <td><?php echo e(@$row->edu_transfer_rate ?? ''); ?></td>
                    <td><?php echo e(@$row->edu_conversions ?? ''); ?></td>
                    <td><?php echo e(@$row->edu_cph ?? ''); ?></td>
                    <td><?php echo e(@$row->edu_conv_percentage_of_transfers ?? ''); ?></td>
                    <td><?php echo e(@$row->edu_conv_percentage_of_connects ?? ''); ?></td>
                    <td><?php echo e(@$row->edu_conv_percentage_of_total_calls ?? ''); ?></td>
                    <td><?php echo e(@$row->transfers ?? ''); ?></td>
                    <td><?php echo e(@$row->transfers_percentage ?? ''); ?></td>
                    <td><?php echo e(@$row->people ?? ''); ?></td>
                    <td><?php echo e(@$row->forms ?? ''); ?></td>
                    <td><?php echo e(@$row->lts ?? ''); ?></td>
                    <td><?php echo e(@$row->conv_percentage ?? ''); ?></td>
                    <td><?php echo e(@$row->lt_percentage ?? ''); ?></td>
                    <td><?php echo e(@$row->lpp ?? ''); ?></td>
                    <td><?php echo e(@$row->lph ?? ''); ?></td>
                    <td><?php echo e(@$row->wlph ?? ''); ?></td>
                    <td><?php echo e(@$row->pph ?? ''); ?></td>
                    <td><?php echo e(@$row->wlpc ?? ''); ?></td>
                    <td><?php echo e(@$row->type); ?></td>
                    <td><?php echo e(date('m-d-Y', strtotime(@$row->created_at))); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </tbody>
</table>
<?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/eddy-sales/eddy-export.blade.php ENDPATH**/ ?>