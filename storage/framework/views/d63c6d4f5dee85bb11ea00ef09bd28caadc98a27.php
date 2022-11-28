<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">HRMS ID</th>
			 <th scope="col">Pseudonym</th>
            <!--<th scope="col">Agent Name</th>-->
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Phone</th>
            <th scope="col">State</th>
            <th scope="col">Closers</th>
            <th scope="col">Other Closers</th>
            <th scope="col">Remarks</th>
            <th scope="col">Client</th>
            <th scope="col">Created Date</th>
            <th scope="col">Status</th>
			<?php if(auth()->user()->hasRole('MortgageClient') || auth()->user()->hasRole('Super Admin')): ?>
			<th scope="col" width="10%">Client Status</th>		 
			<?php endif; ?>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($home_warranties) > 0): ?>
            <?php $__currentLoopData = $home_warranties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $home_warranty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td width="3%"><?php echo e($home_warranty->hrms_id ?? ''); ?></td>
					<td width="3%"><?php echo e($home_warranty->agent_detail->pseudo_name ?? ''); ?></td>
                    <!--<td><?php echo e($home_warranty->agent_detail->name ?? ''); ?></td>-->
                    <td width="3%"><?php echo e($home_warranty->first_name ?? ''); ?></td>
                    <td width="3%"><?php echo e($home_warranty->last_name ?? ''); ?></td>
                    <td width="3%"><?php echo e($home_warranty->phone ?? ''); ?></td>
                    <td width="3%"><?php echo e($home_warranty->state ?? ''); ?></td>
                    <td width="3%"><?php echo e($home_warranty->closers ?? ''); ?></td>
                    <td width="3%"><?php echo e($home_warranty->other_closers ?? ''); ?></td>
                    <td width="3%"><?php echo e($home_warranty->remarks ?? ''); ?></td>
                    <td width="3%"><?php echo e($home_warranty->client ?? ''); ?></td>
                    <td width="3%"><?php echo e($home_warranty->created_at ?? ''); ?></td>
                    <td width="3%"><?php echo e($home_warranty->status ?? ''); ?></td>
					
					
					<?php if(auth()->user()->hasRole('MortgageClient') || auth()->user()->hasRole('Super Admin')): ?>
					<?php $status = ['billable'=>"Accepeted",'not-billable'=>"Rejected" ,'pending'=>"Pending"];?>
					<td width="3%"> 
						<select onchange="remarks(this.value,<?php echo e($home_warranty->id); ?>)" class="form-control bg bg-default">
							<?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option 
									<?php if($key==$home_warranty->client_status): ?> 
								<?php echo e('selected'); ?> 
								<?php endif; ?>
								<?php if( $home_warranty->client_status !="pending"): ?> 
								<?php echo e('disabled'); ?> 
								<?php endif; ?>
								value="<?php echo e($key); ?>"><?php echo e(($st)); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>

					<?php endif; ?>
                    <td width="3%">
                        <a href="<?php echo e(route('home-warranties.show', $home_warranty)); ?>" class="btn btn-success btn-sm"><i
                                class="fas fa-eye"></i></a>
                        <a href="<?php echo e(route('home-warranties.edit', $home_warranty)); ?>" class="btn btn-primary btn-sm"><i
                                class="fas fa-edit"></i></a>
                        <?php if(in_array(Auth::user()->roles[0]->name, ['Super Admin'])): ?>
                            <a href="<?php echo e(route('home-warranties.delete', $home_warranty)); ?>"
                                class="btn btn-warning btn-sm"><i class="fas fa-trash"></i></a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No record found!</td>
            </tr>
        <?php endif; ?>

    </tbody>

</table>
<?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/home-warranties/sales-report.blade.php ENDPATH**/ ?>