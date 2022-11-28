

<?php $__env->startSection('content'); ?>


    <?php echo $__env->make('admin.layouts.headers.cards', ['title' => "Mortgage"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                <h3 class="mb-0">Mortgage Campaigns Submission</h3>
                            </div>
                            <div class="col-2">
                                <h3 class="mb-0 text text-danger" id="recordNotFoundLabel" style="display: none">Record Not Found</h3>
                            </div>
                            <div class="col-3 ">
                                <input style="color: black" style="color: black" style="border: 2px solid;"  type="number" id="search" name="search" class="form-control" placeholder="Record ID">
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
                        <form action="<?php echo e(route('mortgages.store')); ?>" method="POST" id="webform">
                            <?php echo csrf_field(); ?>
                            <div class="user-details">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="recieving_rep">
                                        <strong>recieving_rep:</strong>
                                        <select name="recieving_rep" class="form-control selection_style">
                                            <option>Ken</option>
                                            <option>Koorosh</option>
                                            <option>Lilia</option>
                                            <option>Marlon</option>
                                            <option>Tom</option>
                                        </select>
                                    </div>
                                    <input style="color: black" type="hidden" name="record_id" id="record_id">
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="recieving_rep_qms_361">
                                        <strong>recieving_rep:</strong>
                                        <select name="recieving_rep" class="form-control selection_style">
                                            <option>BRIAN</option>
                                            <option>JEFFERY</option>
                                            <option>JIM</option>
                                            <option>JOHN jr</option>
                                            <option>JOHN Sr</option>
                                            <option>JOHN F</option>
                                            <option>JOSEPH</option>
                                            <option>ROBERT</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: block" id="first_name" >
                                        <span class="details">First name</span>
                                        <input style="color: black" required readonly type="text" name="first_name" class="form-control" placeholder="First name">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: block" id="last_name">
                                        <span class="details">Last Name</span>
                                        <input style="color: black" required readonly type="text" name="last_name"  class="form-control" placeholder="Last Name">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="title">
                                        <span class="details">Title</span>
                                        <input style="color: black" type="text" name="title"  class="form-control" placeholder="Title">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: block" id="phone">
                                        <span class="details">Phone</span>
                                        <input style="color: black" required readonly type="text" name="phone" id="phn" class="form-control" placeholder="Phone">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="work_phone">
                                        <span class="details">Work Phone</span>
                                        <input style="color: black" type="text" readonly name="work_phone"  class="form-control" placeholder="Work Phone">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: block" id="email">
                                        <span class="details">Email</span>
                                        <input style="color: black"  type="text" readonly name="email"  class="form-control" placeholder="Email">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: block" id="address">
                                        <span class="details">Mail Address</span>
                                        <input style="color: black" readonly  type="text" name="address" id="priaddress"  class="form-control" placeholder="Address">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: block" id="city">
                                        <span class="details">City</span>
                                        <input style="color: black" readonly type="text" name="city"  class="form-control" placeholder="City">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: block" id="state">
                                        <span class="details">STATE</span>
                                        <select name="state" id="st" readonly class="form-control selection_style">
                                            <option>AL</option>
                                            <option>AK</option>
                                            <option>AZ</option>
                                            <option>AR</option>
                                            <option>CA</option>
                                            <option>CO</option>
                                            <option>CT</option>
                                            <option>DE</option>
                                            <option>FL</option>
                                            <option>GA</option>
                                            <option>HI</option>
                                            <option>ID</option>
                                            <option>IL</option>
                                            <option>IN</option>
                                            <option>IA</option>
                                            <option>KS</option>
                                            <option>KY</option>
                                            <option>LA</option>
                                            <option>ME</option>
                                            <option>MD</option>
                                            <option>MA</option>
                                            <option>MI</option>
                                            <option>MN</option>
                                            <option>MS</option>
                                            <option>MO</option>
                                            <option>MT</option>
                                            <option>NE</option>
                                            <option>NV</option>
                                            <option>NH</option>
                                            <option>NJ</option>
                                            <option>NM</option>
                                            <option>NY</option>
                                            <option>NC</option>
                                            <option>ND</option>
                                            <option>OH</option>
                                            <option>OK</option>
                                            <option>OR</option>
                                            <option>PA</option>
                                            <option>RI</option>
                                            <option>SC</option>
                                            <option>SD</option>
                                            <option>TN</option>
                                            <option>UT</option>
                                            <option>VT</option>
                                            <option>VA</option>
                                            <option>WA</option>
                                            <option>WV</option>
                                            <option>WI</option>
                                            <option>WY</option>
                                            <option>TX</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: block" id="zip" >
                                        <span class="details">ZIP</span>
                                        <input style="color: black" readonly type="number" name="zip" id="zipCode" class="form-control" placeholder="ZIP">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="best_timing" >
                                        <span class="details">Best to Timing</span>
                                        <input style="color: black" type="text" name="best_timing" class="form-control" placeholder="Best Timing">
                                    </div>
                
                
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="cash_amount">
                                        <span class="details">Cash Amount</span>
                                        <input style="color: black" type="text" name="cash_amount"  class="form-control" placeholder="Cash Amount">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="current_amount">
                                        <span class="details">Current Amount</span>
                                        <input style="color: black" type="text" name="current_amount"  class="form-control" placeholder="Current Amount">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="current_rate">
                                        <span class="details">Current rate</span>
                                        <input style="color: black" type="text" name="current_rate"  class="form-control" placeholder="Current rate">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="income">
                                        <span class="details">Income</span>
                                        <input style="color: black" type="text" name="income"  class="form-control" placeholder="Income">
                                    </div>
                
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="property_value">
                                        <span class="details">Property value</span>
                                        <input style="color: black" type="text" name="property_value"  class="form-control" placeholder="Property value">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="property_type" >
                                        <span class="details">Property Type</span>
                                        <input style="color: black" type="text" name="property_type" class="form-control" placeholder="Property Type">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="monthly_payment" >
                                        <span class="details">Monthly Payment</span>
                                        <input style="color: black" type="text" name="monthly_payment" class="form-control" placeholder="Monthly Payment">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="late_payment" >
                                        <span class="details">Late Payment</span>
                                        <input style="color: black" type="text" name="late_payment" class="form-control" placeholder="Late Payment">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="company">
                                        <span class="details">Company</span>
                                        <input style="color: black" type="text" name="company"  class="form-control" placeholder="Company">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="ltv">
                                        <span class="details">LTV</span>
                                        <input style="color: black" type="text" name="ltv"  class="form-control" placeholder="LTV">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="credit_rating" >
                                        <span class="details">Credit Rating</span>
                
                                        <select name="credit_rating" class="form-control selection_style">
                                            <option>Excellent</option>
                                            <option>Good</option>
                                            <option>Fair</option>
                                            <option>Poor</option>
                                            <option>EXCELLENT</option>
                                            <option>GOOD</option>
                                            <option>FAIR</option>
                                            <option>POOR</option>
                                        </select>
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="mortgage_balance" >
                                        <span class="details">Mortage Balance</span>
                                        <input style="color: black" type="text" name="mortgage_balance" class="form-control" placeholder="mortgage_balance">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="cash_out" >
                                        <span class="details">Cash out</span>
                                        <input style="color: black" type="text" name="cash_out" class="form-control" placeholder="Cash out">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="interest_rate" >
                                        <span class="details">Intrest Rate</span>
                                        <input style="color: black" type="text" name="interest_rate" class="form-control" placeholder="Intrest Rate">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="loan_amount" >
                                        <span class="details">Loan Amount</span>
                                        <input style="color: black" type="text" name="loan_amount" class="form-control" placeholder="Loan Amount">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="rate_type" >
                                        <span class="details">Rate Type</span>
                                        <input style="color: black" type="text" name="rate_type" class="form-control" placeholder="Rate Type">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="loan_type" >
                                        <span class="details">Loan type</span>
                                        <input style="color: black" type="text" name="loan_type" class="form-control" placeholder="Loan type">
                                    </div>
                
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="purpose_of_loan" >
                                        <span class="details">Purpose of loan</span>
                                        <input style="color: black" type="text" name="purpose_of_loan" class="form-control" placeholder="Purpose of loan">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="age" >
                                        <span class="details">Age</span>
                                        <input style="color: black" type="text" name="age" class="form-control" placeholder="Age">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="transfer_by" >
                                        <span class="details">Transfer By</span>
                                        <input style="color: black" type="text" name="transfer_by" class="form-control" placeholder="Transfer By">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="call_transfer_status" >
                                        <span class="details">Call Transfer Status</span>
                                        <input style="color: black" type="text" name="call_transfer_status" class="form-control" placeholder="Call Transfer Status">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="notes">
                                        <span class="details">Notes</span>
                                        <input style="color: black" type="text" name="notes"  class="form-control" placeholder="notes">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="rate">
                                        <span class="details">Rate</span>
                                        <input style="color: black" type="text" name="rate"  class="form-control" placeholder="Rate">
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: none" id="loanofficername" >
                                        <strong>Loan Officer Name:</strong>
                                        <select name="loanofficername" class="form-control selection_style">
                                            <option value="">--Select--</option>
                                            <option value="48">Jeff Ditmar</option>
                                            <option value="50">Robert Frankovich</option>
                                            <option value="1482">Mitchell King</option>
                                            <option value="288">Chris Malizzio</option>
                                            <option value="313">Robert Blodgett</option>
                                            <option value="328">Dustin Mol</option>
                                            <option value="340">Christy Ford</option>
                                            <option value="354">David Gray</option>
                                            <option value="479">Robert Lawrence</option>
                                            <option value="528">Paul Vasquez</option>
                                            <option value="555">Robert Paulsen</option>
                                            <option value="617">James Mazzaro</option>
                                            <option value="621">Addam Pence</option>
                                            <option value="624">Douglas Smith</option>
                                            <option value="646">Rick Reynolds</option>
                                            <option value="647">Micheal Boyd</option>
                                            <option value="652">Eddie Torres</option>
                                            <option value="655">Brent Rosenberg</option>
                                            <option value="687">Gary Wing</option>
                                            <option value="697">Melissa Renteria</option>
                                            <option value="710">Kenneth Andresen</option>
                                            <option value="726">Randy Enders</option>
                                            <option value="731">Anna Jahangir</option>
                                            <option value="746">Joseph Bird</option>
                                            <option value="750">Rahat Riaz</option>
                                            <option value="753">Nels Seastrom</option>
                                            <option value="756">William Boyd</option>
                                            <option value="780">Will Lyons</option>
                                            <option value="802">Max Blum</option>
                                            <option value="826">Evan Gordon</option>
                                            <option value="828">Bill Hayes</option>
                                            <option value="892">Drew Ziegler</option>
                                            <option value="897">Christopher Jorgensen</option>
                                            <option value="917">Ryan Sawyer</option>
                                            <option value="918">Philip Pallozzi</option>
                                            <option value="923">Eric Tanski</option>
                                            <option value="924">Sara Shirback</option>
                                            <option value="937">Stephen Porter</option>
                                            <option value="944">Wayne Spindler</option>
                                            <option value="1003">Tom Kalustian</option>
                                            <option value="1014">Jason Shell</option>
                                            <option value="1018">Cole Roland</option>
                                            <option value="1019">Owen Raymundo</option>
                                            <option value="1043">Monika Jones</option>
                                            <option value="1049">Billy Couillard</option>
                                            <option value="1060">Steven Meekhof</option>
                                            <option value="1062">Garrett Delory</option>
                                            <option value="1073">Denisse Bird</option>
                                            <option value="1105">Christopher Bielawa</option>
                                            <option value="1109">Willis Keeton</option>
                                            <option value="1132">George Kallas</option>
                                            <option value="1135">Michael Soberanes</option>
                                            <option value="1138">Jaron Rowland</option>
                                            <option value="1170">William McConnell</option>
                                            <option value="1189">Holt Stockett</option>
                                            <option value="1193">Ryan Englehardt</option>
                                            <option value="1197">Myra Jahangir</option>
                                            <option value="1199">Cody Lane</option>
                                            <option value="1205">Ryan Poch</option>
                                            <option value="1211">Hunter Jones</option>
                                            <option value="1217">Cade Shelton</option>
                                            <option value="1224">Jonathan Archer</option>
                                            <option value="1236">Jeremy Abbate</option>
                                            <option value="1268">Mohammad Qureshi</option>
                                            <option value="1291">Chris Abbey</option>
                                            <option value="1294">Dan Furman</option>
                                            <option value="1295">Val Lawson</option>
                                            <option value="1298">Ryan Pierce</option>
                                            <option value="1301">David Naranjo</option>
                                            <option value="1306">Jason Bluis</option>
                                            <option value="1307">Aaron Rodriguez</option>
                                            <option value="1314">Samantha Burkart</option>
                                            <option value="1316">Brandon Loperfido</option>
                                            <option value="1337">Howard Litwak</option>
                                            <option value="1343">Carolyn Brown</option>
                                            <option value="1349">Nicholas Herrera</option>
                                            <option value="1357">Brandon Curtis</option>
                                            <option value="1359">Enri Memetaj</option>
                                            <option value="1376">John Eilers</option>
                                            <option value="1411">Jalen Brooks</option>
                                            <option value="1418">Ryan Griffiths</option>
                                            <option value="1420">Kirk Thomas</option>
                                            <option value="1421">Melanie Paquin</option>
                                            <option value="1425">Chase Anderson</option>
                                            <option value="1426">Mike Willeford</option>
                                            <option value="1427">Josh Kutchey</option>
                                            <option value="1428">Jazmin De La Torre</option>
                                            <option value="1430">Bridgette McClain</option>
                                            <option value="1431">Henry Fairleigh</option>
                                            <option value="1432">Andrew Doubek</option>
                                            <option value="1433">Abby Shields</option>
                                            <option value="1436">Adam Ward</option>
                                            <option value="1437">Janet Hoskins</option>
                                            <option value="1445">Hussein Rahil</option>
                                            <option value="1446">Sony Gay</option>
                                            <option value="1449">Chris Finley</option>
                                            <option value="1450">Daniel Johnston</option>
                                            <option value="1451">Shawn Gasaway</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group" style="display: block" id="clients">
                                        <span class="details">Select Client</span>
                                        <select required readonly name="clients" onchange="selectClient(this.value)" class="form-control selection_style" style=" background: lightblue; color: black;">
                                            <option value="">Select </option>
                                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($row->project_code); ?>"><?php echo e($row->name); ?></option> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6 form-group"id="submit" style="display: block;">
                                        <span class="details">&nbsp;</span>
                                        <input style="color: black" type="submit" class="btn btn-info form-control" value="Submit">
                                    </div>
                                </div>
                            </div>
            
                            
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
    // $(document).ready(() => {
    //     $('#basic-datatable').DataTable();
    // });
</script> 
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
                data: {record_id :id },
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
                        document.getElementById("st").value = res.data.State;
                        document.getElementById("phn").value = res.data.Phone;
                        document.getElementById("zipCode").value = res.data.ZipCode;
                        document.getElementById("priaddress").value = res.data.PriAddress; 
                    }else{ 
                        $.notify({   
                            message: 'Record Does not Exist',
                            icon: 'ni ni-fat-remove',
                        },{ 
                            type: 'danger',
                            offset: 50,
                        });
                        document.querySelector("input[name=first_name]").value ="";
                        document.querySelector("input[name=last_name]").value = "";
                        document.querySelector("input[name=email]").value = "";
                        document.querySelector("input[name=city]").value = "";
                        document.getElementById("st").value = "";
                        document.getElementById("phn").value = "";
                        document.getElementById("zipCode").value = "";
                        document.getElementById("priaddress").value = "";
                    }
                   
                }
            });
         
        
    } 
</script> 


<script>
    function selectClient(val){
        
        document.getElementById("submit").style.display="block";
        
        if(val == "MKC0003"  ){



            document.getElementById("first_name").style="display:block";
            document.getElementById("last_name").style="display:block";
            document.getElementById("phone").style="display:block";
            document.getElementById("address").style="display:block";
            document.getElementById("state").style="display:block";
            document.getElementById("zip").style="display:block";

            document.getElementById("title").style="display:block";
            document.getElementById("work_phone").style="display:block";
            document.getElementById("email").style="display:block";
            document.getElementById("city").style="display:block";
            document.getElementById("best_timing").style="display:block";
            document.getElementById("notes").style="display:block";
            document.getElementById("cash_amount").style="display:block";
            document.getElementById("current_amount").style="display:block";
            document.getElementById("current_rate").style="display:block";
            document.getElementById("income").style="display:block";
            document.getElementById("property_value").style="display:block";
            document.getElementById("company").style="display:block";
            document.getElementById("credit_rating").style="display:block";

            document.getElementById("mortgage_balance").style="display:none";
            document.getElementById("loan_type").style="display:block";
            document.getElementById("interest_rate").style="display:none";
            document.getElementById("loan_amount").style="display:none";
            document.getElementById("address").style="display:none";
            document.getElementById("purpose_of_loan").style="display:none";
            document.getElementById("loanofficername").style="display:none";
            document.getElementById("ltv").style="display:none";
            document.getElementById("rate_type").style="display:none";
            document.getElementById("age").style="display:none";
            document.getElementById("transfer_by").style="display:none";
            document.getElementById("call_transfer_status").style="display:none";
            document.getElementById("monthly_payment").style="display:none";
            document.getElementById("late_payment").style="display:none";
            document.getElementById("rate").style="display:none";
            document.getElementById("cash_out").style="display:none";
            document.getElementById("property_type").style="display:none";
            document.getElementById("recieving_rep_qms_361").style="display:none";
            document.getElementById("recieving_rep").style="display:none";
            document.getElementById("cash_amount").style="display:block";




        }
        else if(val == "PRO0022" || val == "ALLIEDNC0016" || val == "PRO0024" || val == "PRO0028" || val == "SRWVA0019" ){
            
            document.getElementById("first_name").style="display:block";
            document.getElementById("last_name").style="display:block";
            document.getElementById("phone").style="display:block";
            document.getElementById("address").style="display:block";
            document.getElementById("state").style="display:block";
            document.getElementById("zip").style="display:block";
            if(val=="srwcs")
                document.getElementById("title").style="display:none";
            else
                document.getElementById("title").style="display:block";

            document.getElementById("work_phone").style="display:block";
            document.getElementById("email").style="display:block";
            document.getElementById("city").style="display:block";
            document.getElementById("best_timing").style="display:block";
            document.getElementById("notes").style="display:block";
            document.getElementById("cash_amount").style="display:block";
            document.getElementById("current_amount").style="display:block";
            document.getElementById("current_rate").style="display:block";
            document.getElementById("income").style="display:block";
            document.getElementById("property_value").style="display:block";
            document.getElementById("company").style="display:block";
            document.getElementById("credit_rating").style="display:block";

            document.getElementById("mortgage_balance").style="display:none";
            document.getElementById("loan_type").style="display:none";
            document.getElementById("interest_rate").style="display:none";
            document.getElementById("loan_amount").style="display:none";

            document.getElementById("purpose_of_loan").style="display:none";
            document.getElementById("loanofficername").style="display:none";
            document.getElementById("ltv").style="display:none";
            document.getElementById("rate_type").style="display:none";
            document.getElementById("age").style="display:none";
            document.getElementById("transfer_by").style="display:none";
            document.getElementById("call_transfer_status").style="display:none";
            document.getElementById("monthly_payment").style="display:none";
            document.getElementById("late_payment").style="display:none";
            document.getElementById("rate").style="display:none";
            document.getElementById("cash_out").style="display:none";
            document.getElementById("property_type").style="display:none";
            document.getElementById("recieving_rep_qms_361").style="display:none";
            document.getElementById("recieving_rep").style="display:none";
            document.getElementById("cash_amount").style="display:block";




        } 
        else if(val == "PRO0057" ){
            document.getElementById("recieving_rep").style="display:none";
            document.getElementById("first_name").style="display:block";
            document.getElementById("last_name").style="display:block";
            document.getElementById("phone").style="display:block";
            document.getElementById("address").style="display:block";
            document.getElementById("state").style="display:block";
            document.getElementById("zip").style="display:block";
            document.getElementById("title").style="display:none";
            document.getElementById("work_phone").style="display:none";
            document.getElementById("email").style="display:none";
            document.getElementById("city").style="display:block";
            document.getElementById("best_timing").style="display:none";
            document.getElementById("notes").style="display:none";
            document.getElementById("cash_amount").style="display:none";
            document.getElementById("current_amount").style="display:none";
            document.getElementById("current_rate").style="display:none";
            document.getElementById("income").style="display:none";
            document.getElementById("property_value").style="display:none";
            document.getElementById("company").style="display:none";
            document.getElementById("credit_rating").style="display:none";
            document.getElementById("mortgage_balance").style="display:none";
            document.getElementById("interest_rate").style="display:none";
            document.getElementById("loan_amount").style="display:none";
            document.getElementById("loan_type").style="display:none";
            document.getElementById("purpose_of_loan").style="display:none";
            document.getElementById("loanofficername").style="display:none";
            document.getElementById("ltv").style="display:none";
            document.getElementById("rate_type").style="display:none";
            document.getElementById("age").style="display:none";
            document.getElementById("transfer_by").style="display:none";
            document.getElementById("call_transfer_status").style="display:none";
            document.getElementById("monthly_payment").style="display:none";
            document.getElementById("late_payment").style="display:none";
            document.getElementById("rate").style="display:none";
            document.getElementById("cash_out").style="display:none";
            document.getElementById("property_type").style="display:none";
            document.getElementById("recieving_rep_qms_361").style="display:none";


        } 
        else if(val == "PRO0032" || val == "PRO0031"   || val == "PRO0064"){


            document.getElementById("recieving_rep").style="display:none";
            document.getElementById("first_name").style="display:block";
            document.getElementById("last_name").style="display:block";
            document.getElementById("phone").style="display:block";
            document.getElementById("address").style="display:block";
            document.getElementById("city").style="display:block";
            document.getElementById("state").style="display:block";
            document.getElementById("zip").style="display:block";
            document.getElementById("property_value").style="display:block";
            document.getElementById("credit_rating").style="display:none";
            document.getElementById("current_rate").style="display:none";
            document.getElementById("title").style="display:none";
            document.getElementById("work_phone").style="display:none";
            document.getElementById("email").style="display:none";

            document.getElementById("best_timing").style="display:none";
            document.getElementById("notes").style="display:none";

            document.getElementById("current_amount").style="display:none";

            document.getElementById("income").style="display:none";

            document.getElementById("company").style="display:none";



            if(val == "reverselg"){
                document.getElementById("cash_amount").style="display:none";
                document.getElementById("purpose_of_loan").style="display:none";
                document.getElementById("loanofficername").style="display:none";
                document.getElementById("company").style="display:none";


            }
            else if(val == "radebt"){
                document.getElementById("purpose_of_loan").style="display:none";
                document.getElementById("loanofficername").style="display:none";

            }
            else{
                document.getElementById("cash_amount").style="display:block";
                document.getElementById("purpose_of_loan").style="display:block";

                document.getElementById("loan_amount").style="display:block";
                document.getElementById("credit_rating").style="display:block";
            }
            document.getElementById("loan_type").style="display:block";
            document.getElementById("mortgage_balance").style="display:block";
            if (val == "camp8")
            {
                document.getElementById("mortgage_balance").style="display:block";
                document.getElementById("loan_amount").style="display:block";
            }
            if (val == "camp21")
            {
                document.getElementById("credit").style="display:block";
            }
            document.getElementById("interest_rate").style="display:block";


            document.getElementById("ltv").style="display:none";
            document.getElementById("rate_type").style="display:none";
            document.getElementById("age").style="display:none";
            document.getElementById("transfer_by").style="display:none";
            document.getElementById("call_transfer_status").style="display:none";
            document.getElementById("monthly_payment").style="display:none";
            document.getElementById("late_payment").style="display:none";
            document.getElementById("rate").style="display:none";
            document.getElementById("cash_out").style="display:none";
            document.getElementById("property_type").style="display:none";
            document.getElementById("recieving_rep_qms_361").style="display:none";



        } 
        else if(val == "PRO0056" ){

            document.getElementById("recieving_rep").style="display:none";
            document.getElementById("first_name").style="display:block";
            document.getElementById("last_name").style="display:block";
            document.getElementById("phone").style="display:block";
            document.getElementById("address").style="display:block";
            document.getElementById("state").style="display:block";
            document.getElementById("zip").style="display:block";
            document.getElementById("city").style="display:block";
            document.getElementById("property_value").style="display:block";
            document.getElementById("credit_rating").style="display:block";
            document.getElementById("loan_type").style="display:block";
            document.getElementById("rate").style="display:block";
            document.getElementById("current_rate").style="display:none";
            document.getElementById("monthly_payment").style="display:none";
            document.getElementById("late_payment").style="display:none";

            document.getElementById("title").style="display:none";
            document.getElementById("work_phone").style="display:none";
            document.getElementById("email").style="display:none";
            document.getElementById("best_timing").style="display:none";
            document.getElementById("notes").style="display:none";
            document.getElementById("cash_amount").style="display:none";
            document.getElementById("current_amount").style="display:none";
            document.getElementById("income").style="display:none";

            document.getElementById("company").style="display:none";
            document.getElementById("mortgage_balance").style="display:none";
            document.getElementById("interest_rate").style="display:none";
            document.getElementById("loan_amount").style="display:block";
            document.getElementById("purpose_of_loan").style="display:none";
            document.getElementById("loanofficername").style="display:none";
            document.getElementById("ltv").style="display:none";
            document.getElementById("rate_type").style="display:none";
            document.getElementById("age").style="display:none";
            document.getElementById("transfer_by").style="display:none";
            document.getElementById("call_transfer_status").style="display:none";
            document.getElementById("cash_out").style="display:none";
            document.getElementById("property_type").style="display:none";
            document.getElementById("recieving_rep_qms_361").style="display:none";




        } 
        else if(val == "REVLB23440014" ||  val == "rev_lb_2367" || val == "REVLB23740008" || val == "REVLB23970009" || val == "REVLB23990013"){
            if(val == "REVLB23740008")
                document.getElementById("recieving_rep").style="display:block";
            else
            document.getElementById("recieving_rep").style="display:none";

            document.getElementById("first_name").style="display:block";
            document.getElementById("last_name").style="display:block";
            document.getElementById("phone").style="display:block";
            document.getElementById("address").style="display:block";
            document.getElementById("city").style="display:block";
            document.getElementById("state").style="display:block";
            document.getElementById("zip").style="display:block";
            document.getElementById("mortgage_balance").style="display:block";
            document.getElementById("property_value").style="display:block";
            document.getElementById("cash_out").style="display:block";
            document.getElementById("loan_amount").style="display:block";
            document.getElementById("ltv").style="display:block";
            document.getElementById("credit_rating").style="display:block";
            document.getElementById("interest_rate").style="display:block";
            document.getElementById("rate_type").style="display:none";
            document.getElementById("property_type").style="display:block";
            document.getElementById("monthly_payment").style="display:block";
            document.getElementById("late_payment").style="display:block";
            document.getElementById("age").style="display:block";
            document.getElementById("income").style="display:block";
            document.getElementById("transfer_by").style="display:block";
            document.getElementById("notes").style="display:block";

            document.getElementById("loan_type").style="display:none";
            document.getElementById("rate").style="display:none";
            document.getElementById("current_rate").style="display:none";


            document.getElementById("title").style="display:none";
            document.getElementById("work_phone").style="display:none";
            document.getElementById("email").style="display:none";
            document.getElementById("best_timing").style="display:none";

            document.getElementById("cash_amount").style="display:none";
            document.getElementById("current_amount").style="display:none"; 
            document.getElementById("company").style="display:none"; 
            document.getElementById("purpose_of_loan").style="display:none";
            document.getElementById("loanofficername").style="display:none"; 
            document.getElementById("rate_type").style="display:none"; 
            document.getElementById("recieving_rep_qms_361").style="display:none";
        } 
        else if(val == "REVLB23980010" ){
            document.getElementById("recieving_rep").style="display:none";
            document.getElementById("first_name").style="display:block";
            document.getElementById("last_name").style="display:block";
            document.getElementById("phone").style="display:block";
            document.getElementById("address").style="display:block";
            document.getElementById("city").style="display:block";
            document.getElementById("state").style="display:block";
            document.getElementById("zip").style="display:block";
            document.getElementById("mortgage_balance").style="display:block";
            document.getElementById("property_value").style="display:block";
            document.getElementById("cash_out").style="display:block";
            document.getElementById("loan_amount").style="display:block";
            document.getElementById("ltv").style="display:block";
            document.getElementById("credit_rating").style="display:block";
            document.getElementById("interest_rate").style="display:block";
            document.getElementById("rate_type").style="display:none";
            document.getElementById("property_type").style="display:block";
            document.getElementById("monthly_payment").style="display:block";
            document.getElementById("late_payment").style="display:block";
            document.getElementById("age").style="display:block";
            document.getElementById("income").style="display:block";
            document.getElementById("transfer_by").style="display:block";
            document.getElementById("notes").style="display:block";

            document.getElementById("loan_type").style="display:none";
            document.getElementById("rate").style="display:none";
            document.getElementById("current_rate").style="display:none";


            document.getElementById("title").style="display:none";
            document.getElementById("work_phone").style="display:none";
            document.getElementById("email").style="display:none";
            document.getElementById("best_timing").style="display:none";

            document.getElementById("cash_amount").style="display:none";
            document.getElementById("current_amount").style="display:none";


            document.getElementById("company").style="display:none";



            document.getElementById("purpose_of_loan").style="display:none";
            document.getElementById("loanofficername").style="display:none";

            document.getElementById("rate_type").style="display:none";





        } 
        else if(val == "QMS3610020" || val=="QMS3630024"){
            document.getElementById("recieving_rep_qms_361").style="display:block";
            document.getElementById("first_name").style="display:block";
            document.getElementById("last_name").style="display:block";
            document.getElementById("phone").style="display:block";
            document.getElementById("address").style="display:block";
            document.getElementById("city").style="display:block";
            document.getElementById("state").style="display:block";
            document.getElementById("zip").style="display:block";
            document.getElementById("mortgage_balance").style="display:block";
            document.getElementById("property_value").style="display:block";
            document.getElementById("cash_out").style="display:block";
            document.getElementById("loan_amount").style="display:block";
            document.getElementById("ltv").style="display:block";
            document.getElementById("credit_rating").style="display:block";
            document.getElementById("interest_rate").style="display:block";
            document.getElementById("rate_type").style="display:none";
            document.getElementById("property_type").style="display:block";
            document.getElementById("monthly_payment").style="display:block";
            document.getElementById("late_payment").style="display:block";
            document.getElementById("age").style="display:block";
            document.getElementById("income").style="display:block";
            document.getElementById("transfer_by").style="display:block";
            document.getElementById("call_transfer_status").style="display:block";
            document.getElementById("notes").style="display:block";

            document.getElementById("loan_type").style="display:none";
            document.getElementById("rate").style="display:none";
            document.getElementById("current_rate").style="display:none";


            document.getElementById("title").style="display:none";
            document.getElementById("work_phone").style="display:none";
            document.getElementById("email").style="display:none";
            document.getElementById("best_timing").style="display:none";

            document.getElementById("cash_amount").style="display:none";
            document.getElementById("current_amount").style="display:none"; 

            document.getElementById("company").style="display:none";
 
            document.getElementById("purpose_of_loan").style="display:none";
            document.getElementById("loanofficername").style="display:none";

            document.getElementById("rate_type").style="display:none";





        }
        else if(val == "PRO0036"){

            document.getElementById("recieving_rep").style="display:none";
            document.getElementById("first_name").style="display:block";
            document.getElementById("last_name").style="display:block";
            document.getElementById("phone").style="display:block";
            document.getElementById("address").style="display:block";
            document.getElementById("state").style="display:block";
            document.getElementById("zip").style="display:block";
            document.getElementById("title").style="display:none";
            document.getElementById("work_phone").style="display:none";
            document.getElementById("email").style="display:none";
            document.getElementById("city").style="display:block";
            document.getElementById("best_timing").style="display:none";
            document.getElementById("notes").style="display:none";
            document.getElementById("current_amount").style="display:none";
            document.getElementById("current_rate").style="display:none";
            document.getElementById("income").style="display:none";
            document.getElementById("property_value").style="display:block";
            document.getElementById("company").style="display:none";
            document.getElementById("credit_rating").style="display:block";
            document.getElementById("loan_type").style="display:block";
            document.getElementById("mortgage_balance").style="display:block";
            document.getElementById("interest_rate").style="display:block";
            document.getElementById("ltv").style="display:none";
            document.getElementById("rate_type").style="display:none";
            document.getElementById("age").style="display:none";
            document.getElementById("transfer_by").style="display:none";
            document.getElementById("call_transfer_status").style="display:none";
            document.getElementById("monthly_payment").style="display:none";
            document.getElementById("late_payment").style="display:none";
            document.getElementById("rate").style="display:none";
            document.getElementById("cash_out").style="display:none";
            document.getElementById("property_type").style="display:none";
            document.getElementById("purpose_of_loan").style="display:none";
            document.getElementById("cash_amount").style="display:block";

        }
    }
</script>



<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'mortgage-submission' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/mortgage/create.blade.php ENDPATH**/ ?>