<?php $__env->startSection('content'); ?>


    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => "Mortgage"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <form action="<?php echo e(route('mortgages.index')); ?>" method="GET">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Phone</label>
                                            <input type="text" value="<?php echo e(@$_GET['search']); ?>" name="search" class="form-control">                                             
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>From Date</label>
                                            <input type="date" value="<?php echo e(@$_GET['start_date']); ?>"  name="start_date" class="form-control">                                             
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>To Date</label>
                                            <input type="date" value="<?php echo e(@$_GET['end_date']); ?>"  name="end_date" class="form-control">                                             
                                        </div>
                                        <?php if(in_array(Auth::user()->roles[0]->name, ['Super Admin','MortgageManager','AllSheet'])): ?>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Client</label>
                                            <select name="client_id" id="" onchange ="selectClient(this.value)"    class="form-control">
                                                <option value="">--Select--</option>
                                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php 
                                                    $select='';
                                                    if(@$_GET['client_id'] == $client->client_code)
                                                        $select="selected";
                                                    else
                                                    $select="";

                                                ?>
                                                <option <?php echo e($select); ?> value="<?php echo e($client->client_code); ?>"><?php echo e($client->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>                                             
                                        </div>
                                        
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Project</label>
                                            <select name="project_id" id="project_id"  class="form-control">
                                                <option value="">--Select--</option>
                                                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php 
                                                    
                                                    $select='';
                                                    if(@$_GET['project_id'] == $project->project_code)
                                                        $select="selected";
                                                    else
                                                    $select="";

                                                ?>
                                                <option  <?php echo e($select); ?> value="<?php echo e($project->project_code); ?>"><?php echo e($project->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>                                             
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Agents</label>
                                            <select name="user_id" id="user_id"  class="form-control">
                                                <option value="">--Select--</option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php  
                                                if(is_int($user->HRMSID))
                                                continue;
                                                    $select='';
                                                    if(@$_GET['user_id'] == $user->HRMSID)
                                                        $select="selected";
                                                    else
                                                    $select="";

                                                ?>
                                                <option  <?php echo e($select); ?> value="<?php echo e($user->HRMSID); ?>"><?php echo e($user->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>                                             
                                        </div>
                                        <div class="col-md-2 col-lg-2 form-group">
                                            <label>&nbsp;</label>
                                            <input type="submit" name="submit"  value="search" class="form-control btn btn-primary">                                             
                                        </div>
                                        <div class="col-md-2 col-lg-2 form-group">
                                            <label>&nbsp;</label>
                                            <input type="submit" name="export"  value="Export" class="form-control btn btn-primary">
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>                             
                        </div>
                    </div> 
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="mb-0">Mortgage Campaign Salesheet</h3>
                            </div>
							<?php if(auth()->user()->hasRole('MortgageAgent') || auth()->user()->hasRole('Mortgage Manager')): ?>
                            <div class="col-2 ">
                                <a href="<?php echo e(route('mortgages.create')); ?>" class="btn btn-info float-right">
									<i class="fa fa-arrow-left"></i>Sale Submission</a>
                            </div>
							<?php endif; ?>
                        </div>
                    </div>
                    <div class="table-responsive pb-3">
                        <table class="table align-items-center table-flush"  > 
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="3%">No</th>
                                    <th scope="col" width="3%">Record ID</th>
                                    <th scope="col" width="3%">First Name</th>
									<th scope="col" width="3%">Last Name</th>
                                    <th scope="col" width="3%">Phone</th>
                                    <th scope="col" width="3%">State</th> 
                                    <th scope="col" width="3%">Created at</th>	
                                    <th scope="col" width="3%">Agent Name</th>
                                    <th scope="col" width="3%">Agent HRMSID</th>
                                    <th scope="col" width="3%">Reporting To</th>
									<th scope="col" width="3%">Client status</th>	
									<th scope="col" width="3%">QA status</th>
                                    <th scope="col" width="3%">Client</th>
									<th scope="col" width="3%">Project</th>	
									<?php if(auth()->user()->hasRole('MortgageClient') || auth()->user()->hasRole('Super Admin') || auth()->user()->HRMSID=="854157"): ?>
									<th scope="col" width="10%">Client Status</th> 
									<?php endif; ?>

                                    <th scope="col" width="3%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 
                                <?php $__currentLoopData = $mortgages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?>-<?php echo e(auth()->user()->HRMSID); ?></td>
                                        <td><?php echo e($row->record_id); ?></td>
                                        <td><?php echo e($row->first_name); ?> </td> 
										<td><?php echo e($row->last_name); ?></td>
                                        <td><?php echo e($row->phone); ?></td>
                                        <td><?php echo e($row->state); ?></td> 
                                        <td><?php echo e($row->created_at); ?></td> 
                                        <td><?php echo e(($row->user) ? $row->user->name:''); ?></td>
                                        <td><?php echo e(($row->user) ? $row->user->HRMSID:''); ?></td>
                                        <td><?php echo e($row->user->reporting_to_name->name ?? ''); ?></td>
                                         
                                        
                                        
										<td><?php echo e($row->client_status); ?></td>
										<td><?php echo e($row->qa_status); ?></td>
                                        <td><b> <?php echo e(($row->client) ? $row->client->name:''); ?> </b></td>
										<td><b> <?php echo e(($row->project) ? $row->project->name:''); ?> </b></td>	
										<?php if(auth()->user()->hasRole('MortgageClient') || auth()->user()->hasRole('Super Admin') || auth()->user()->HRMSID=="854157"): ?>
											<?php $status = ['billable'=>"Accepeted",'not-billable'=>"Rejected" ,'pending'=>"Pending"];?>
											<td> 
												<select onchange="remarks(this.value,<?php echo e($row->id); ?>)" class="form-control bg bg-default">
													<?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option 
															<?php if($key==$row->client_status): ?> 
															<?php echo e('selected'); ?> 
															<?php endif; ?>
															<?php if( $row->client_status !="pending"): ?> 
															<?php echo e('disabled'); ?> 
															<?php endif; ?>
															value="<?php echo e($key); ?>"><?php echo e(($st)); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
											</td>
										 
										<?php endif; ?>
                                        <td>
                                            <a href="#" >
                                                
                                                <form action="<?php echo e(route('mortgages.destroy',[$row->id])); ?>" method="post">
                                                    <a href="<?php echo e(route('mortgages.show',[$row->id])); ?>" class="btn btn-success btn-sm">View</a>                                                     
                                                    <?php if(in_array(Auth::user()->roles[0]->name, ['Super Admin'])): ?>
                             						<input class="btn btn-default btn-sm" value="Delete" type="submit"  />
                                                    <?php echo method_field('delete'); ?>

                                                    <?php echo csrf_field(); ?>

                        						<?php endif; ?>
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div style="padding: 22px;">
                            <?php echo e($mortgages->links()); ?>

                        </div>
                        
                    </div>
                </div>
            </div>
             

        </div>
		
		<div id="remarks" class="modal fade" runat="server"  role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header"> 
				<h4 class="modal-title">Remarks</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
			  <div class="modal-body">
				<input type="hidden" id="qa_status">				
				<input type="hidden" id="id_status">

				<label class="lable">Enter Remarks</label>
				<input type="text" class="form-control" id="remarksValue">
			  </div>
			  <div class="modal-footer">          
				<button type="button" class="btn btn-info" onclick="changeStatus()" id="submitRemarks" data-dismiss="modal">Submit</button>				
				<button type="button" class="btn btn-danger" id="dissmiss" data-dismiss="modal">No</button> 	  
			  </div>
			</div>
		  </div>
		</div>

        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    </div>
<?php $__env->stopSection(); ?>


        <?php $__env->startPush('js'); ?>

        <script>
			function remarks(val,id){
				$('#remarks').modal('show');
				document.getElementById('id_status').value=id;				
				document.getElementById('qa_status').value=val;

			}
            function selectClient(val){
                $.ajax({
                    url:"<?php echo e(url('api/selectClient')); ?>",
                    type:"get",
                    data:{
                        "client_id":val
                    },
                    success:function(res){
                        var options="";
                        for(let i=0;i<res.length;i++){
                            options +="<option value="+ res[i].project_code+">"+res[i].name+"</option>";
                        }
                        console.log(options);
                        document.getElementById('project_id').innerHTML=options

                    }
                });
            }
			function changeStatus(){
				
				let id=document.getElementById('id_status').value;				
				let val=document.getElementById('qa_status').value;
				let remarks=document.getElementById('remarksValue').value;
				$.ajax({
					url: "<?php echo e(url('api/changeStatusClient')); ?>",
					type: "get", 
					data: { 
						'client_status':val,
						'id':id,  
						'remarks':remarks,
						'table':"sale_mortgages",
					} ,
					success: function (response) {  
						 document.getElementById('id_status').value='';				
						 document.getElementById('qa_status').value='';
						 document.getElementById('remarks').value='';
						 $.notify({ 
							message: 'Status Change Succeesfully',
							icon: 'ni ni-check-bold',
						  },{ 
							type: 'success',
							offset: 50,
						  });
					},

				});
			}
            $(document).ready(() => {

                $('#basic-datatable').DataTable();
            });
        </script>

        <form action="#" method="post" id="FORM_DELETE">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        </form>
        <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'mortgage' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/mortgage/index.blade.php ENDPATH**/ ?>