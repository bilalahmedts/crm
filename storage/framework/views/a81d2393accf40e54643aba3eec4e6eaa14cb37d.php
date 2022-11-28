

<?php $__env->startSection('content'); ?>

<?php $__env->startPush('header-buttons'); ?>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?php echo e(route('home-warranties.index')); ?>" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> Go Back</a>
        </div>
    <?php $__env->stopPush(); ?>
    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => 'Home-Warranty-Submission'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid mt--6">

        <div class="row">

            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <img style="display: block;margin-left: auto; margin-right: auto;width: 50%; display:none"
                                    src="<?php echo e(url('loader.gif')); ?>" id="loader">
                            </div>
                        </div>

                        <div class="row" id="searchForm">
                            <div class="col-5">
                                <h3 class="mb-0">Home Warranty Submission</h3>
                            </div>
                            <div class="col-2">
                                <h3 class="mb-0 text text-danger" id="recordNotFoundLabel" style="display: none">Record Not
                                    Found</h3>
                            </div>
                            <div class="col-3 ">
                                <input style="color: black" style="border: 2px solid;" type="text" id="search"
                                    name="search" class="form-control" placeholder="Record ID">
                            </div>
                            <div class="col-2 ">
                                <a href="#" onclick="searchRecord()" class="btn btn-primary float-right">Search
                                    Record</a>
                            </div>
                        </div>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger"style="color: red;">
                                <strong class="text-secondary">Oops!</strong> There were some problems with your
                                input.<br><br>
                                <ul style="color: red;padding-left:20px">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li style="color: red"><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if($message = Session::get('success')): ?>
                            <div class="col-lg-12 text-center"
                                style="margin-top:10px;margin-bottom: 10px; padding-left:50px">
                                <div class="alert alert-success" style="color: lightgreen">
                                    <?php echo e($message); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('home-warranties.update', $home_warranty)); ?>" method="POST" id="webform">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="row">
                                <input type="hidden" name="hrms_id" value="<?php echo e($home_warranty->hrms_id); ?>">
                                <div class="form-group col-md-6" style="display: block" id="first_name">
                                    <span class="details">First name</span>
                                    <input style="color: black" required type="text" name="first_name"
                                        data-id="first_name" value="<?php echo e($home_warranty->first_name); ?>" class="form-control"
                                        placeholder="First name" readonly>
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="last_name">
                                    <span class="details">Last name</span>
                                    <input style="color: black" required type="text" name="last_name" data-id="last_name"
                                        value="<?php echo e($home_warranty->last_name); ?>" class="form-control" placeholder="Last name"
                                        readonly>
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="phone">
                                    <span class="details">Phone</span>
                                    <input style="color: black" required type="text" name="phone" data-id="phone"
                                        class="form-control" placeholder="Phone" value="<?php echo e($home_warranty->phone); ?>"
                                        readonly>
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="address">
                                    <span class="details">Address</span>
                                    <input style="color: black" required type="text" name="address" data-id="address"
                                        class="form-control" placeholder="Address" value="<?php echo e($home_warranty->address); ?>"
                                        readonly>
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="city">
                                    <span class="details">City</span>
                                    <input style="color: black" required type="text" name="city" data-id="city"
                                        class="form-control" placeholder="City" value="<?php echo e($home_warranty->city); ?>"
                                        readonly>
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="state">
                                    <span class="details">State</span>
                                    <input style="color: black" required type="text" name="state" data-id="state"
                                        class="form-control" placeholder="state" value="<?php echo e($home_warranty->state); ?>"
                                        readonly>
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="zip_code">
                                    <span class="details">Zip Code</span>
                                    <input style="color: black" type="text" name="zip_code" data-id="zip_code"
                                        class="form-control" placeholder="Zip Code"
                                        value="<?php echo e($home_warranty->zip_code); ?>" readonly>
                                </div>
                               <!-- <div class="form-group col-md-6" disabled style="display: block;" id="client">
                                    <b class="details">Select Client</b>
                                    <select name="client"  class="form-control selection_style"
                                        style=" background: white; color: black;" disabled>
                                        <option value="">Select </option>
                                        <option value="D1" <?php if($home_warranty->client == 'D1'): ?> selected <?php endif; ?>>D1
                                        </option>
                                        <option value="D2" <?php if($home_warranty->client == 'D2'): ?> selected <?php endif; ?>>D2
                                        </option>
                                        <option value="D3" <?php if($home_warranty->client == 'D3'): ?> selected <?php endif; ?>>D3
                                        </option>
                                        <option value="D4" <?php if($home_warranty->client == 'D4'): ?> selected <?php endif; ?>>D4
                                        </option>
                                        <option value="GHW" <?php if($home_warranty->client == 'GHW'): ?> selected <?php endif; ?>>GHW
                                        </option>
                                        <option value="HW CH" <?php if($home_warranty->client == 'HW CH'): ?> selected <?php endif; ?>>HW CH
                                        </option>
                                        <option value="HW CH less than 58"
                                            <?php if($home_warranty->client == 'HW CH less than 58'): ?> selected <?php endif; ?>>HW CH less than 58</option>
                                        <option value="HW CH 50 Years" <?php if($home_warranty->client == 'HW CH 50 Years'): ?> selected <?php endif; ?>>HW
                                            CH 50 Years</option>
                                    </select>
                                </div>-->
                                <div class="form-group col-md-6" style="display: block;" id="client">
                                    <b class="details">Select Status</b>
                                    <select name="status"  class="form-control selection_style"
                                        style=" background: white; color: black;">
                                        <option value="">Select </option>
                                        <option value="Accepted"
                                            <?php if($home_warranty->status == 'Accepted' ||
                                                $home_warranty->status == 'Rejected' ||
                                                $home_warranty->status == 'Unsuccessful Transfer'): ?> disabled selected <?php endif; ?>>
                                            Accepted
                                        </option>
                                        <option value="Rejected"
                                            <?php if($home_warranty->status == 'Accepted' ||
                                                $home_warranty->status == 'Rejected' ||
                                                $home_warranty->status == 'Unsuccessful Transfer'): ?> disabled selected <?php endif; ?>>
                                            Rejected
                                        </option>
                                        <option value="Unsuccessful Transfer"
                                            <?php if($home_warranty->status == 'Accepted' ||
                                                $home_warranty->status == 'Rejected' ||
                                                $home_warranty->status == 'Unsuccessful Transfer'): ?> disabled selected <?php endif; ?>>Unsuccessful
                                            Transfer
                                        </option>
                                        
                                    </select>
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="notes">
                                    <span class="details">Remarks</span>
                                    <textarea style="color: black" rows="3" name="remarks" data-id="notes" class="form-control"
                                        placeholder="Remarks"></textarea>
                                </div>
                                <div class="form-group col-md-6" id="submit"
                                    style="display: block; margin-top: -8px;">
                                    <label for="">&nbsp;</label>
                                    <input style="color: black" type="submit" class="btn btn-info btn-block"
                                        value="Submit">
                                </div>
                                <div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(() => {
            $('#basic-datatable').DataTable();
        });
    </script>
    <script>
        function searchRecord() {
            $('#loader').show();
            $('#searchForm').hide();
            $('#webform').hide();
            var id = document.getElementById('search').value;
            if (id) {
                document.getElementById('search').style.border = "2px solid lightgray";
                var request = $.ajax({
                    url: "<?php echo e(url('/search_record')); ?>",
                    type: "GET",
                    data: {
                        record_id: id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        $('#loader').hide();
                        $('#searchForm').show();
                        $('#webform').show();
                        if (res.data) {
                            // alert(res.data.ID);
                            document.getElementById('record_id').value = res.data.ID;
                            document.querySelector("input[name=first_name]").value = res.data.FirstName;
                            document.querySelector("input[name=last_name]").value = res.data.LastName;
                            document.querySelector("input[name=email]").value = res.data.Email;
                            document.querySelector("input[name=city]").value = res.data.City;
                            document.querySelector("input[name=state]").value = res.data.State;
                            document.querySelector("input[name=phone]").value = res.data.Phone;
                            document.querySelector("input[name=zip_code]").value = res.data.ZipCode;
                            document.querySelector("input[name=address]").value = res.data.PriAddress;
                        } else {
                            $.notify({
                                message: 'Record Does not Exist',
                                icon: 'ni ni-fat-remove',
                            }, {
                                type: 'danger',
                                offset: 50,
                            });
                            document.querySelector("input[name=first_name]").value = "";
                            document.querySelector("input[name=last_name]").value = "";
                            document.querySelector("input[name=email]").value = "";
                            document.querySelector("input[name=city]").value = "";
                            document.querySelector("input[name=state]").value = "";
                            document.querySelector("input[name=phone]").value = "";
                            document.querySelector("input[name=zip_code]").value = "";
                            document.querySelector("input[name=address]").value = "";
                        }

                    }
                });
            } else {
                document.getElementById('search').style.border = "2px solid #e65939";
            }

        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', ['current_page' => 'home-warranties-submission'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/home-warranties/edit.blade.php ENDPATH**/ ?>