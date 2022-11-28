<table class="table align-items-center table-flush" id="basic-datatable">
    <thead class="thead-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">FirstName</th>
            <th scope="col">LastName</th>
            <th scope="col">Customer-No</th>
            <th scope="col">Customer-Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">City</th>
            <th scope="col">Zip</th>
            <th scope="col">PromoCode</th>
            <th scope="col">Area</th>
            <th scope="col">comments</th>
            <th scope="col">From which vendor do yo usually buy or supplies from?</th>
            <th scope="col">What was the reason for you to purchase your supplies from other supplies?</th>
            <th scope="col">Created at</th>
            <th scope="col">Agent Name</th>
            <th scope="col">Agent HRMSID</th>

        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $dsses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td><?php echo e($row->id); ?></td>
                <td><?php echo e($row->first_name); ?> </td>
                <td><?php echo e($row->last_name); ?></td>
                <td><?php echo e($row->customer_no); ?></td>
                <td><?php echo e($row->customer_name); ?></td>
                <td><?php echo e($row->email); ?></td>
                <td><?php echo e($row->phone); ?></td>
                <td><?php echo e($row->address); ?></td>
                <td><?php echo e($row->city); ?></td>
                <td><?php echo e($row->zipcode); ?></td>
                <td><?php echo e($row->promo_code); ?></td>
                <td><?php echo e($row->area); ?></td>
                <td><?php echo e($row->comments); ?></td>
                <td><?php echo e($row->question_1); ?></td>
                <td><?php echo e($row->question_2); ?></td>
                <td><?php echo e($row->created_at); ?></td>
                <td><?php echo e(($row->user) ? $row->user->name:''); ?></td>
                <td><?php echo e(($row->user) ? $row->user->HRMSID:''); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/dss/sales-report.blade.php ENDPATH**/ ?>