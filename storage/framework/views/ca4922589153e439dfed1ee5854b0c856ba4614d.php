<?php $__env->startSection('content'); ?>
    <?php

        $start_date = '';
        $end_date = '';
        $phone = '';

        if (isset($_GET['search'])) {
            if (!empty($_GET['start_date'])) {
                $start_date = $_GET['start_date'];
            }
            if (!empty($_GET['end_date'])) {
                $end_date = $_GET['end_date'];
            }
        }
        if (isset($_GET['search'])) {
            if (!empty($_GET['phone'])) {
                $phone = $_GET['phone'];
            }
        }
    ?>
    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => 'Home Warranty'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid mt--6">

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h3 class="mb-0">Manage Home Warranty Campaigns</h3>
                            </div>
                            
                        </div>
                    </div>
                    <div>
                        <form action="<?php echo e(route('home-warranties.index')); ?>" method="GET" class="search p-3">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <input type="hidden" name="search" value="1">
                                <div class="col-md-3">
                                    <span class="details">Start Date</span>
                                    <input type="date" name="start_date" value="<?php echo e($start_date); ?>" class="form-control"
                                        placeholder="Start Date">
                                </div>
                                <div class="form-group col-md-3">
                                    <span class="details">End Date</span>
                                    <input type="date" name="end_date" value="<?php echo e($end_date); ?>" class="form-control"
                                        placeholder="End Date">
                                </div>
                                <div class="form-group col-md-3">
                                    <span class="details">Phone</span>
                                    <input type="text" name="phone" value="<?php echo e($phone); ?>" class="form-control"
                                        placeholder="Phone">
                                </div>
                                <div class="col-md-1" style="margin-top: -8px;">
                                    <label for="">&nbsp;</label>
                                    <input style="color: white" type="submit" class="btn btn-info btn-block"
                                        value="Search">
                                </div>
                                <?php if(in_array(Auth::user()->roles[0]->name, ['Super Admin','HomeWarranty Director','HomeWarranty Manager'])): ?>
                                <div class="form-group col-md-1" style="margin-top: 20px;">

                                    <a href="<?php echo e(route('home-warranties.create')); ?>" class="btn btn-info float-right m-1">Submission</a>
                                </div>
                                <?php endif; ?>
                                <div class="form-group col-md-1" style="margin-top: 20px;">
                                    <?php if(isset($_GET['search'])): ?>
                                        <a href="<?php echo e(route('home-warranties.sales-report')); ?>?start_date=<?php echo e($start_date); ?>&end_date=<?php echo e($end_date); ?>&phone=<?php echo e($phone); ?>"
                                            class="btn btn-info float-right form-control m-1">Export</a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('home-warranties.sales-report')); ?>"
                                            class="btn btn-info float-right form-control m-1">Export</a>
                                    <?php endif; ?>
                                </div>
                                <div>
                        </form>
                    </div>
                    <div class="table-responsive pb-3">
                        <?php echo $__env->make('admin.home-warranties.sales-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="col-md-12 p-2">
                            <?php echo e($home_warranties->links()); ?>

                        </div>
                    </div>

                </div>

            </div>

        </div>
        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    <script>
		function remarks(val,id){
				$('#remarks').modal('show');
				document.getElementById('id_status').value=id;				
				document.getElementById('qa_status').value=val;

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
						'table':"home_warranties",
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

<?php echo $__env->make('admin.layouts.app', ['current_page' => 'home-warranties'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/home-warranties/index.blade.php ENDPATH**/ ?>