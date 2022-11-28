<html>
    <head>
        <title>Export Mortgage</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Zip</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Client</th>
                    <th>Agent Name</th>
                    <th>Agent HRMSID</th>
                    <th>Created At</th>
                </tr>
                
            </thead>
            <tbody>
                <?php $cout=1; ?>
                <?php $__currentLoopData = $saleSolars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($cout++); ?></td>
                        <td><?php echo e($row->first_name ?? ''); ?></td>
                        <td><?php echo e($row->last_name ?? ''); ?></td>
                        <td><?php echo e($row->phone ?? ''); ?></td>
                        <td><?php echo e($row->email ?? ''); ?></td>
                        <td><?php echo e($row->address ?? ''); ?></td>
                        <td><?php echo e($row->zipcode ?? ''); ?></td>
                        <td><?php echo e($row->city ?? ''); ?></td>
                        <td><?php echo e($row->state ?? ''); ?></td>
                        <td><?php echo e(@$row->client->name ?? ''); ?></td>
                        <td><?php echo e(@$row->user->name ?? ''); ?></td>
                        <td><?php echo e(@$row->user->HRMSID ?? ''); ?></td>
                        <td><?php echo e($row->created_at ?? ''); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>            
        </table>
    </body>
</html><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/solar/export.blade.php ENDPATH**/ ?>