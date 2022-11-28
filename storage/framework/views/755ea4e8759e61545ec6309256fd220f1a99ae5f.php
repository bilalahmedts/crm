<?php $__env->startSection('content'); ?>

<?php $__env->startPush('header-buttons'); ?>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?php echo e(route('solars.index')); ?>" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> Go Back</a>
        </div>
    <?php $__env->stopPush(); ?>
    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => "Solar"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid mt--6">
        
        <div class="row">
            
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0"> 
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <img style="display: block;margin-left: auto; margin-right: auto;width: 50%; display:none" src="<?php echo e(url('loader.gif')); ?>" id="loader">
                            </div>
                        </div>
                        
                        <div class="row" id="searchForm">
                            <div class="col-5">
                                <h3 class="mb-0">Solar Campaigns Submission</h3>
                            </div>
                            <div class="col-2">
                                <h3 class="mb-0 text text-danger" id="recordNotFoundLabel" style="display: none">Record Not Found</h3>
                            </div>
                            <div class="col-3 ">
                                <input style="color: black" style="border: 2px solid;"  type="number" id="search" name="search" class="form-control" placeholder="Record ID or Phone #">
                            </div>  
                            <div class="col-2 ">
                                <a href="#" onclick="searchRecord()" class="btn btn-primary float-right">Search Sale Record</a>
                            </div>  
                        </div>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger"style="color: red;" >
                                <strong class="text-secondary" >Oops!</strong> There were some problems with your input.<br><br>
                                <ul style="color: red;padding-left:20px">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li style="color: red"><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if($message = Session::get('success')): ?>
                            <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px; padding-left:50px">
                                    <div class="alert alert-success" style="color: lightgreen">
                                        <?php echo e($message); ?>

                                    </div>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('solars.store')); ?>" method="POST" id="webform">
                            <?php echo csrf_field(); ?>                     
                            <input style="color: black" type="hidden" name="leadid_token" id="leadid_token"  class="form-control" placeholder="leadid_token"> 
                            <input style="color: black" type="hidden" name="optin_cert" id="optin_cert" class="form-control" >
                            <input style="color: black" type="hidden" name="record_id" id="record_id">
                            <input style="color: black" type="hidden" name="JornayaIDSolarT" id="JornayaIDSolarT">
                                <div class="row"> 
									                                <div class="form-group col-md-6" style="display: block;" id="clients">
                                    <b class="details">Select Client</b>
                                    <select name="clients" required   onchange="selectClient(this.value)" class="form-control selection_style" style=" background: lightblue; color: black;">
                                        <option value="">Select </option>
                                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->project_code); ?>"><?php echo e($row->name); ?></option> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div> 
                                <div class="form-group col-md-6" style="display: block" id="first_name" >
                                    <span class="details">First name</span>
                                    <input style="color: black" required    type="text" name="first_name" data-id="first_name" class="form-control" placeholder="First name">
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="last_name" >
                                    <span class="details">Last name</span>
                                    <input style="color: black" required    type="text" name="last_name" data-id="last_name" class="form-control" placeholder="Last name">
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="agent_name" >
                                    <span class="details">Agent Name</span>
                                    <input style="color: black"    type="text" name="agent_name" class="form-control" placeholder="Agent Name">
                                </div>
                                
                                <div class="form-group col-md-6" style="display: block" id="phone" >
                                    <span class="details">Phone</span>
                                    <input style="color: black" required readonly  type="text" name="phone" data-id="phone" class="form-control" placeholder="Phone">
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="address" >
                                    <span class="details">Address</span>
                                    <input style="color: black" required    type="text" name="address" data-id="address" class="form-control" placeholder="Address">
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="city" >
                                    <span class="details">City</span>
                                    <input style="color: black" required    type="text" name="city" data-id="city" class="form-control" placeholder="City">
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="state" >
                                    <span class="details">state</span>
                                    <select onchange="slectState(this)" name="state" id="st" class="form-control"> 
                                        <option value="">Select State</option>
                                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option><?php echo e($row->state); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div> 
                                <div class="form-group col-md-6" style="display: none" id="electric_provider" >
                                    <span class="details">Electric Provider</span>
                                    <select  name="electric_provider" class="form-control" id="electric_providers">
                                        <option>Select<option>
                                    </select>
                                </div>
									
									
                                <div class="form-group col-md-6" style="display: block" id="zip_code" >
                                    <span class="details">Zip Code</span>
                                    <input style="color: black"  type="text"   name="zip_code" data-id="zip_code" class="form-control" placeholder="Zip Code">
                                </div>
                                <div class="form-group col-md-6" style="display: block" id="email" >
                                    <span class="details">Email</span>
                                    <input style="color: black"  type="text"   name="email" data-id="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="smoker" >
                                    <span class="details">Smoker</span>
                                    <select name="smoker" class="form-control"> 
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="beneficiary" >
                                    <span class="details">Beneficiary</span>
                                    <select name="beneficiary" class="form-control"> 
                                        <option>Spouse</option>
                                        <option>Daughter </option>
                                        <option>Son</option>
                                        <option>Sibling </option>
                                        <option>Others</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="age" >
                                    <span class="details">Age</span>
                                    <input style="color: black"  type="number" name="age" class="form-control" placeholder="Age">
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="coverage" >
                                    <span class="details">Coverage</span>
                                    <input style="color: black"  type="text" name="coverage" class="form-control" placeholder="Coverage">
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="disclaimer" >
                                    <span class="details">Disclaimer</span>
                                    <select name="disclaimer" class="form-control"> 
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="major_health_issues" >
                                    <span class="details">Major Health Issues:</span>
                                    <select name="major_health_issues" class="form-control"> 
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="app_date_time" >
                                    <span class="details">Appointment Date</span>
                                    <input style="color: black" type="datetime-local" ="" name="app_date_time" class="form-control" placeholder="Appointment Date-T-me">
                                </div>
                                
                                <div class="form-group col-md-6" style="display: none" id="electric_bill_monthly" >
                                    <span class="details">Electric Bill Monthly</span>
                                    <input style="color: black"  type="text" name="electric_bill_monthly" id="electric_bills_monthly" class="form-control" placeholder="Electric Bill Monthly">
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="roof_shade" >
                                    <span class="details">Roof Shade</span>
                                    <input style="color: black"  type="text" name="roof_shade" class="form-control" placeholder="Roof Shade">
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="homeowner" >
                                    <span class="details">Home Owner</span>
                                    <select name="homeowner" class="form-control">
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                        <option value="COMMERCIAL">COMMERCIAL</option>
                                        <option value="CONDO">CONDO</option>
                                        <option value="MOBILE HOME">MOBILE HOME</option> 
                                    </select>
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="credit_score" >
                                    <span class="details">Credit Score</span>
                                    <input style="color: black"  type="text" name="credit_score" id="CreditScore" class="form-control" placeholder="Credit Score">
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="credit_rating" >
                                    <span class="details">Credit rating</span>
                                    <select name="credit_rating" id="" class="form-control">
                                        <option value="750">Excellent</option>
                                        <option value="650">Good</option>
                                        <option value="620">Fair</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="notes" >
                                    <span class="details">Notes</span>
                                    <textarea name="notes" class="form-control" cols="30" rows="4"></textarea>
                                </div>
                                <div class="form-group col-md-6" style="display: none" id="call_url" >
                                    <span class="details">Call Recording url</span>
                                    <input type="url" name="call_url" class="form-control" > 
                                </div>

                                <div class="form-group col-md-6" id="submit" style="display: block; margin-top: -8px;" >
                                    <label for="">&nbsp;</label>
                                    <input style="color: black" type="submit" class="btn btn-info btn-block" value="Submit">
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
    function searchRecord(){
        $('#loader').show();
        $('#searchForm').hide();
        $('#webform').hide();
        var id = document.getElementById('search').value; 
        document.getElementById('search').style.border="2px solid lightgray";
        var request = $.ajax({
            url: "<?php echo e(url('/search_record')); ?>",
            type: "GET",
            data: {record_id :id,table:"sale_records" },
            dataType: "JSON",
            success:function (res){
                $('#loader').hide();
                $('#searchForm').show();
                $('#webform').show(); 
                if(res.status==200){ 
                    document.getElementById('record_id').value = res.data.ID;
                    document.querySelector("input[name=first_name]").value = res.data.FirstName;
                    document.querySelector("input[name=last_name]").value = res.data.LastName;
                    document.querySelector("input[name=email]").value = res.data.Email;
                    document.querySelector("input[name=city]").value = res.data.City;
                    document.querySelector("input[name=phone]").value = res.data.Phone;
                    document.querySelector("input[name=zip_code]").value = res.data.ZipCode;
                    document.querySelector("input[name=address]").value = res.data.PriAddress; 
                    document.getElementById("electric_bills_monthly").value = res.data.ElectricBill; 
                    document.getElementById("electric_providers").value = res.data.ElectricProvider; 
                    document.getElementById("CreditScore").value = res.data.CreditScore; 
                    document.getElementById('st').value  = res.data.State;
                     
                    if(res.data.Client_id ==42){  
                        document.getElementById("electric_providers").innerHTML = "<option>"+res.data.ElectricProvider+"</option>"; 
                        document.getElementById('st').innerHTML  ="<option>"+res.data.State+"</option>" ;
                        document.getElementById('JornayaIDSolarT').value = res.data.JornayaID;
                    }else{
                        document.getElementById('JornayaIDSolarT').value = "";
                    }
                    
                    
                }else{ 
                    $.notify({   
                       message: res.data.message,
                        icon: 'ni ni-fat-remove',
                    },{ 
                        type: 'danger',
                        offset: 50,
                    });
                    document.querySelector("input[name=first_name]").value ="";
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
        
    }
    function slectState(val){  
          
        $.ajax({
        url: "<?php echo e(url('/api/select_electric')); ?>",
        type: "GET",
        data: {val :val.value }, 
        success:function (res){  
            
            if(res){
                var options ='';
                for(let i=0; i<res.length;i++){ 
                    let vr = (res[i].id); 
                    options +="<option>"+(res[i].electric_provider)+"</option>"; 
                    
                }
                document.getElementById("electric_providers").innerHTML=options;
                    
            }
        }
        }); 
        
    }
    function selectClient(val){
        document.getElementById('call_url').style.display="none";
        if(val=="PRO0033"){
            document.getElementById("submit").style.display="block";
            document.getElementById('first_name').style.display="block";         
            document.getElementById('last_name').style.display="block";  
            document.getElementById('agent_name').style.display="none";        
            document.getElementById('email').style.display="block";         
            document.getElementById('phone').style.display="block";         
            document.getElementById('address').style.display="block";         
            document.getElementById('state').style.display="block";         
            document.getElementById('zip_code').style.display="block";         
            document.getElementById('electric_provider').style.display="block";         
            document.getElementById('electric_bill_monthly').style.display="block";         
            document.getElementById('roof_shade').style.display="block";         
            document.getElementById('homeowner').style.display="block";         
            document.getElementById('credit_score').style.display="block";         
            document.getElementById('credit_rating').style.display="block";         
            document.getElementById('notes').style.display="block";
            document.getElementById('app_date_time').style.display="none";

            document.getElementById('smoker').style.display="none";         
            document.getElementById('beneficiary').style.display="none";         
            document.getElementById('age').style.display="none";         
            document.getElementById('coverage').style.display="none";         
            document.getElementById('major_health_issues').style.display="none";
        }else if(val=="CS0002" || val=="SS0003" || val=="SE0005" || 
            val=="PRO0074" || val=="PP0008" || val=="PE0009" ||  val=="SW0013"|| val=="PT0015" || val=="EP0016" ||
            val=="SB0010" || val=="TA0012" || val=="PR0014") {
			
            document.getElementById("submit").style.display="block";
            document.getElementById('first_name').style.display="block";         
            document.getElementById('last_name').style.display="block"; 
			
            
            if(val=="PRO0074")  
                document.getElementById('agent_name').style.display="none"; 
            else   
                document.getElementById('agent_name').style.display="none"; 
			
            if(val=="PR0014")
                document.getElementById('call_url').style.display="block";

            document.getElementById('email').style.display="block";         
            document.getElementById('phone').style.display="block";         
            document.getElementById('address').style.display="block";         
            document.getElementById('state').style.display="block";         
            document.getElementById('zip_code').style.display="block";         
            document.getElementById('electric_provider').style.display="none";         
            document.getElementById('roof_shade').style.display="none";         
            document.getElementById('homeowner').style.display="none";         
            document.getElementById('credit_score').style.display="none";         
            document.getElementById('credit_rating').style.display="none";         
            document.getElementById('notes').style.display="none";
            document.getElementById('app_date_time').style.display="none";
            document.getElementById('electric_bill_monthly').style.display="none"; 

            document.getElementById('smoker').style.display="none";         
            document.getElementById('beneficiary').style.display="none";         
            document.getElementById('age').style.display="none";         
            document.getElementById('coverage').style.display="none";         
            document.getElementById('major_health_issues').style.display="none";
        }
        else if(val=="SN0004" || val=="PRO0093" || val=="PRO0095"){
            document.getElementById("submit").style.display="block";
            document.getElementById('first_name').style.display="block";         
            document.getElementById('last_name').style.display="block";         
            document.getElementById('agent_name').style.display="none";         
            document.getElementById('email').style.display="block";         
            document.getElementById('phone').style.display="block";         
            document.getElementById('address').style.display="block";         
            document.getElementById('state').style.display="block";         
            document.getElementById('zip_code').style.display="block";         
            document.getElementById('electric_provider').style.display="none";  
            document.getElementById('electric_bill_monthly').style.display="block";        
            document.getElementById('roof_shade').style.display="none";         
            document.getElementById('homeowner').style.display="block";         
            document.getElementById('credit_score').style.display="block";         
            document.getElementById('credit_rating').style.display="none";         
            document.getElementById('notes').style.display="block";
            document.getElementById('app_date_time').style.display="block";

            document.getElementById('smoker').style.display="none";         
            document.getElementById('beneficiary').style.display="none";         
            document.getElementById('age').style.display="none";         
            document.getElementById('coverage').style.display="none";         
            document.getElementById('major_health_issues').style.display="none"; 
        }else if(val=="FE0007"  ){
            document.getElementById("submit").style.display="block";
            document.getElementById('first_name').style.display="block";         
            document.getElementById('last_name').style.display="block";         
            document.getElementById('agent_name').style.display="none";         
            document.getElementById('email').style.display="block";         
            document.getElementById('phone').style.display="block";         
            document.getElementById('address').style.display="block";         
            document.getElementById('state').style.display="block";         
            document.getElementById('zip_code').style.display="block";         
            document.getElementById('smoker').style.display="block";         
            document.getElementById('beneficiary').style.display="block";         
            document.getElementById('age').style.display="block";         
            document.getElementById('coverage').style.display="block";         
            document.getElementById('major_health_issues').style.display="block";         
            document.getElementById('electric_provider').style.display="none";  
            document.getElementById('electric_bill_monthly').style.display="none";        
            document.getElementById('roof_shade').style.display="none";         
            document.getElementById('homeowner').style.display="none";         
            document.getElementById('credit_score').style.display="none";         
            document.getElementById('credit_rating').style.display="none";         
            document.getElementById('notes').style.display="none";
            document.getElementById('app_date_time').style.display="none";
        }
        else if(val=="PRO0075" || val=="PRO0097" || val=="PRO0098" ){
            document.getElementById("submit").style.display="block";
            document.getElementById('first_name').style.display="block";
            if(val=="PRO0098")         
                document.getElementById('call_url').style.display="none";
            else
            document.getElementById('call_url').style.display="block";

            document.getElementById('last_name').style.display="block";         
            document.getElementById('agent_name').style.display="none";         
            document.getElementById('email').style.display="block";         
            document.getElementById('phone').style.display="block";         
            document.getElementById('address').style.display="block";         
            document.getElementById('state').style.display="block";         
            document.getElementById('zip_code').style.display="block";         
            document.getElementById('smoker').style.display="none";         
            document.getElementById('beneficiary').style.display="none";         
            document.getElementById('age').style.display="none";         
            document.getElementById('coverage').style.display="none";         
            document.getElementById('major_health_issues').style.display="none";         
            document.getElementById('electric_provider').style.display="block";  
            document.getElementById('electric_bill_monthly').style.display="block";        
            document.getElementById('roof_shade').style.display="block";         
            document.getElementById('homeowner').style.display="block";         
            document.getElementById('credit_score').style.display="block";         
            document.getElementById('credit_rating').style.display="block";         
            document.getElementById('notes').style.display="block";
            document.getElementById('app_date_time').style.display="none";
        }                      
    }
</script>

<script id="LeadiDscript" type="text/javascript">
    (function() {
    var s = document.createElement('script');
    s.id = 'LeadiDscript_campaign';
    s.type = 'text/javascript';
    s.async = true;
    s.src = '//create.lidstatic.com/campaign/bf7f77bd-face-feed-cafe-bcb51cf20276.js?snippet_version=2';
    var LeadiDscript = document.getElementById('LeadiDscript');
    LeadiDscript.parentNode.insertBefore(s, LeadiDscript);
    })();
</script>
<!-- TrustedForm -->
<script type="text/javascript">
(function() {
    var tf = document.createElement('script');
    tf.type = 'text/javascript'; tf.async = true;
    tf.src = ("https:" == document.location.protocol ? 'https' : 'http') + "://api.trustedform.com/trustedform.js?field=xxTrustedFormCertUrl&ping_field=xxTrustedFormPingUrl&l=" + new Date().getTime() + Math.random();
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(tf, s);
    document.getElementById("optin_cert").value = s.src;
})();
</script>
<noscript>
<img src="https://api.trustedform.com/ns.gif" />
</noscript>
<!-- End TrustedForm -->


 
<script>   
// var ip='';        
// $.getJSON("https://api.ipify.org?format=json", function(data) {          
//     document.getElementById('ip_address').value = data.ip;
//     console.log(data);
// });
</script>
<noscript><img src='//create.leadid.com/noscript.gif?lac=BF7F77BD-87EC-7538-6E77-BCB51CF20276&lck=bf7f77bd-face-feed-cafe-bcb51cf20276&snippet_version=2' /></noscript>





<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'solar-submission' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/solar/create.blade.php ENDPATH**/ ?>