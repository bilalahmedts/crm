@extends('admin.layouts.app', [ 'current_page' => 'mortgage-submission' ])

@section('content')
@push('header-buttons')
        <div class="col-lg-6 col-5 text-right">
          <a href="{{ route('mortgages.index') }}" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> Go Back</a>
        </div>
    @endpush

    @include('admin.layouts.headers.cards', ['title' => "Mortgage"])
    <div class="container-fluid mt--6">
        
        <div class="row">
            
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0"> 
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <img style="display: block;margin-left: auto; margin-right: auto;width: 50%; display:none" src="{{url('loader.gif')}}" id="loader">
                            </div>
                        </div>
                        
                        <div class="row" id="searchForm">
                            <div class="col-3">
                                <h3 class="mb-0">Mortgage Campaigns Submission</h3>
                            </div>
                            <div class="col-2">
                                <h3 class="mb-0 text text-danger" id="recordNotFoundLabel" style="display: none">Record Not Found</h3>
                            </div>
                            <div class="col-2">
                                <h3 class="mb-0 text text-danger" id="alreadyASaleLabel" style="display: none">Already a Sale</h3>
                            </div>							
                            <div class="col-3 ">
                                <input style="color: black" style="color: black" style="border: 2px solid;"  type="number" id="search" name="search" class="form-control" placeholder="Record ID">
                            </div>  
                            <div class="col-2 ">
                                <a href="#" onclick="searchRecord()" class="btn btn-primary float-right">Search Sale Record</a>
                            </div>  
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger"style="color: red;" >
                                <strong class="text-secondary" >Oops!</strong> There were some problems with your input.<br><br>
                                <ul style="color: red;padding-left:20px">
                                    @foreach ($errors->all() as $error)
                                    <li style="color: red">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px; padding-left:50px">
                                    <div class="alert alert-success" style="color: lightgreen">
                                        {{ $message }}
                                    </div>
                            </div>
                        @endif  
						<label style="display:none;color:red" class="label label-success" id="successLabel">Check Lead successfully</label>
    					<label style="display:none;color:green" class="label label-success" id="errorLabel"></label>
                        <form action="{{route('mortgages.store')}}" method="POST" id="webform">
                            <input type="hidden" name="leadid_token" id="leadid_token"  class="form-control" placeholder="leadid_token">
                            @csrf
                            <div class="user-details">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 form-group" style="display: block" id="clients">
                                        <span class="details">Select Client</span>
                                        <select required readonly name="clients" onchange="selectClient(this.value)" class="form-control selection_style" style=" background: lightblue; color: black;">
                                            <option value="">Select </option>
                                            @foreach($clients as $row)
                                                <option value="{{$row->project_code}}">{{$row->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="recieving_rep">
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
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="recieving_rep_qms_361">
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
                                    
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="title">
                                        <span class="details">Title</span>
                                        <input style="color: black" type="text" name="title"  class="form-control" placeholder="Title">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: block" id="first_name" >
                                        <span class="details">First Name</span>
                                        <input style="color: black" required  type="text" name="first_name" class="form-control" placeholder="First Name">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: block" id="last_name">
                                        <span class="details">Last Name</span>
                                        <input style="color: black" required  type="text" name="last_name"  class="form-control" placeholder="Last Name">
                                    </div>
                                    
                                    <div class="col-md-4 col-lg-4 form-group" style="display: block" id="phone">
                                        <span class="details">Phone</span>
                                        <input style="color: black" required readonly type="text" name="phone" id="phn" class="form-control" placeholder="Phone">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="work_phone">
                                        <span class="details">Work Phone</span>
                                        <input style="color: black" type="text" readonly name="work_phone"  class="form-control" placeholder="Work Phone">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: block" id="email">
                                        <span class="details">Email</span>
                                        <input style="color: black"  type="text"  name="email"  class="form-control" placeholder="Email">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: block" id="address">
                                        <span class="details">Mail Address</span>
                                        <input style="color: black"  type="text" name="address" id="priaddress"  class="form-control" placeholder="Address">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: block" id="city">
                                        <span class="details">City</span>
                                        <input style="color: black"  type="text" name="city"  class="form-control" placeholder="City">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: block" id="state">
                                        <span class="details">STATE</span>
                                        <select name="state" id="st"  class="form-control selection_style">
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
                                    <div class="col-md-4 col-lg-4 form-group" style="display: block" id="zip" >
                                        <span class="details">Zip Code</span>
                                        <input style="color: black" type="number" name="zip" id="zipCode" class="form-control" placeholder="Zip Code">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="cash_amount">
                                        <span class="details">Cash Amount</span>
                                        <input style="color: black" type="number" name="cash_amount"  class="form-control" placeholder="Cash Amount">
                                    </div>
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="current_amount">
                                        <span class="details">Current Amount</span>
                                        <input style="color: black" type="number" name="current_amount"  class="form-control" placeholder="Current Amount">
                                    </div>
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="current_rate">
                                        <span class="details">Current rate</span>
                                        <input style="color: black" type="text" name="current_rate"  class="form-control" placeholder="Current rate">
                                    </div>
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="income">
                                        <span class="details">Income</span>
                                        <input style="color: black" type="number" name="income"  class="form-control" placeholder="Income">
                                    </div>
                
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="property_value">
                                        <span class="details">Property Value</span>
                                        <input style="color: black" type="number" name="property_value"  class="form-control" placeholder="Property value">
                                    </div>
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="property_type" >
                                        <span class="details">Property Type</span>
                                        <input style="color: black" type="text" name="property_type" class="form-control" placeholder="Property Type">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="lender" >
                                        <span class="details">Lender</span>
                                        <input style="color: black" type="text" name="lender" class="form-control" placeholder="Lender">
                                    </div>
                
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="monthly_payment" >
                                        <span class="details">Monthly Payment</span>
                                        <input style="color: black" type="number" name="monthly_payment" class="form-control" placeholder="Monthly Payment">
                                    </div>
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="late_payment" >
                                        <span class="details">Late Payment</span>
                                        <input style="color: black" type="number" name="late_payment" class="form-control" placeholder="Late Payment">
                                    </div>
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="company">
                                        <span class="details">Company</span>
                                        <input style="color: black" type="text" name="company"  class="form-control" placeholder="Company">
                                    </div>
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="ltv">
                                        <span class="details">LTV</span>
                                        <input style="color: black" type="text" name="ltv"  class="form-control" placeholder="LTV">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="credit_score">
                                        <span class="details">Credit Score</span>
                                        <input style="color: black" type="text" name="credit_score" id="credit_score_value" class="form-control" placeholder="Credit Score">
                                    </div>
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="credit_rating" >
                                        <span class="details">Credit Rating</span>
                
                                        <select name="credit_rating" id="cr"  class="form-control selection_style">
                                            <option>Excellent</option>
                                            <option>Good</option>
                                            <option>Fair</option>
                                            <option>Poor</option>
                                        </select>
                                    </div>
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="mortgage_balance" >
                                        <span class="details">Mortage Balance</span>
                                        <input style="color: black" type="number" name="mortgage_balance" class="form-control" placeholder="mortgage_balance">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="cash_out" >
                                        <span class="details">Cash out</span>
                                        <input style="color: black" type="number" name="cash_out" class="form-control" placeholder="Cash out">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="interest_rate" >
                                        <span class="details">Interest Rate</span>
                                        <input style="color: black" type="text" name="interest_rate" class="form-control" placeholder="Intrest Rate">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="loan_amount" >
                                        <span class="details">Loan Amount</span>
                                        <input style="color: black" type="number" name="loan_amount" class="form-control" placeholder="Loan Amount">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="loan_balance" >
                                        <span class="details">Loan Balance</span>
                                        <input style="color: black" type="number" name="loan_balance" class="form-control" placeholder="Loan Balance">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="rate_type" >
                                        <span class="details">Rate Type</span>
                                            <select name="rate_type" id="rt" class="form-control selection_style">
                                                <option >--Select--</option>
                                                <option >FIXED</option>
                                                <option >ADJ</option>
                                            </select>
                                        </div>
                                    {{-- <div class="col-md-4 col-lg-4 form-group" style="display: none" id="rate_type" >
                                        <span class="details">Rate Type</span>
                                        <input style="color: black" type="text" name="rate_type" class="form-control" placeholder="Rate Type">
                                    </div> --}}
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="loan_type" >
                                        <span class="details">Loan Type</span>
                                            <select name="loan_type" id="lt" class="form-control selection_style">
                                                <option >--Select--</option>
                                                <option >FHA</option>
                                                <option >VA</option>
                                            </select>
                                        </div>

                                    {{-- <div class="col-md-4 col-lg-4 form-group" style="display: none" id="loan_type" >
                                        <span class="details">Loan type</span>
                                        <input style="color: black" type="text" id="lt" name="loan_type" class="form-control" placeholder="Loan type">
                                    </div>  --}}
                
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="purpose_of_loan" >
                                        <span class="details">Purpose of loan</span>
                                        <input style="color: black" type="text" name="purpose_of_loan" class="form-control" placeholder="Purpose of loan">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="age" >
                                        <span class="details">Age</span>
                                        <input style="color: black" type="number" name="age" class="form-control" placeholder="Age">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="transfer_by" >
                                        <span class="details">Transfer By</span>
                                        <input style="color: black" type="text" name="transfer_by" class="form-control" placeholder="Transfer By">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="call_transfer_status" >
                                    <span class="details">Call transfer status</span>
                                        <select name="call_transfer_status" id="c_transfer" class="form-control selection_style">
                                            <option >--Select--</option>
                                            <option >Call Transferred Successfully</option>
                                            <option >No Response During Requested Call-Time</option>
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-4 col-lg-4 form-group" style="display: none" id="call_transfer_status" >
                                        <span class="details">Call Transfer Status</span>
                                        <input style="color: black" type="text" name="call_transfer_status" class="form-control" placeholder="Call Transfer Status">
                                    </div> 
                                     -->
<div class="col-md-4 col-lg-4 form-group" style="display: block" id="notes">
                                    <span class="details">Notes</span>
                                    <textarea style="color: black" rows="3" name="notes" data-id="notes" class="form-control"
                                        placeholder="Notes"></textarea>
                                </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="rate">
                                        <span class="details">Rate</span>
                                        <input style="color: black" type="number" name="rate"  class="form-control" placeholder="Rate">
                                    </div>
                                    <!-- <div class="col-md-4 col-lg-4 form-group" style="display: none" id="debt_type" >
                                        <span class="details">Debt Type</span>
                                        <input style="color: black" type="text" name="debt_type" class="form-control" placeholder="Debt Type">
                                    </div> -->

                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="debt_type" >
                                    <span class="details">Debt Type</span>
                                        <select name="debt_type" id="d_type" class="form-control selection_style">
                                            <option >--Select--</option>
                                            <option >CREDIT-CARD</option>
                                            <option >MEDICAL BILL</option>
                                            <option >RETAIL STORE CARD</option>
                                            <option >AUTO LOAN REPOSSESSION</option>
                                            <option >RETAIL STORE CARD</option>
                                            <option >UNSECURED BUSINESS DEBT</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="call_transfer_status" >
                                    <span class="details">Call Transfer status</span>
                                        <select name="call_transfer_status" id="c_status" class="form-control selection_style">
                                            <option >--Select--</option>
                                            <option >Call Transferred Successfully</option>
                                            <option> No Response During Requested Call-Time</option>
                                        </select>
                                    </div>


                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="loanofficername" >
                                        <strong>Loan Officer Name:</strong>
                                        <select name="loanofficername" id="camp8_loanofficername" class="form-control selection_style">
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
										<select style="display:none" name="loanofficername" id="mtgr_loanofficername" class="form-control"> 
                        							<option value="">--Select--</option>
                                                    <option value="aedwards@thefederalsavingsbank.com"> Aaron Edwards </option>
                                                    <option value="acoronado@thefederalsavingsbank.com"> Alex Coronado </option>
                                                    <option value="aperez@thefederalsavingsbank.com"> Alex Perez </option>
                                                    <option value="aakbar@thefederalsavingsbank.com"> Andrew Akbar </option>
                                                    <option value="avarda@thefederalsavingsbank.com"> Anthony Varda </option>
                                                    <option value="aelias@thefederalsavingsbank.com"> Antonio Elias </option>
                                                    <option value="aesmaili@thefederalsavingsbank.com"> Aria Esmaili </option>
                                                    <option value="acuellar@thefederalsavingsbank.com"> Arthur Cuellar </option>
                                                    <option value="adowns@thefederalsavingsbank.com"> Austin Downs </option>
                                                    <option value="ahirsch@thefederalsavingsbank.com"> Austin Hirsch </option>
                                                    <option value="bbaume@thefederalsavingsbank.com"> Barry Baume </option>
                                                    <option value="bscatena@thefederalsavingsbank.com"> Bill Scatena </option>
                                                    <option value="Bdowns@thefederalsavingsbank.com"> Brandon Downs </option>
                                                    <option value="btallale@thefederalsavingsbank.com"> Brandon Tallale </option>
                                                    <option value="bsims@thefederalsavingsbank.com"> Brett Sims </option>
                                                    <option value="bquintana@thefederalsavingsbank.com"> Brian Quintana </option>
                                                    <option value="bhale@thefederalsavingsbank.com"> Brock Hale </option>
                                                    <option value="caleb.sommer@thefederalsavingsbank.com"> Caleb Sommer </option>
                                                    <option value="csimmons@thefederalsavingsbank.com"> Cedric Simmons </option>
                                                    <option value="creynolds@thefederalsavingsbank.com"> Chad Reynolds </option>
                                                    <option value="cnigro@thefederalsavingsbank.com"> Chiara Nigro </option>
                                                    <option value="cstiller@thefederalsavingsbank.com"> Chris Stiller </option>
                                                    <option value="cbeadles@thefederalsavingsbank.com"> Chris Beadles </option>
                                                    <option value="chorn@thefederalsavingsbank.com"> Chris Horn </option>
                                                    <option value="cloghnane@thefederalsavingsbank.com"> Chris Loughnane </option>
                                                    <option value="chris.davis@thefederalsavingsbank.com"> Chris Davis </option>
                                                    <option value="cjameson@thefederalsavingsbank.com"> Chris Jameson </option>
                                                    <option value="cnavarro@thefederalsavingsbank.com"> Christopher Navarro</option>
                                                    <option value="csexton@thefederalsavingsbank.com"> Cinder Sexton </option>
                                                    <option value="ccolter@thefederalsavingsbank.com"> Cleveland Colter </option>
                                                    <option value="cstroble@thefederalsavingsbank.com"> Clint Stroble </option>
                                                    <option value="csommer@thefederalsavingsbank.com"> Colin Sommer </option>
                                                    <option value="codom@thefederalsavingsbank.com"> Cornell Odom </option>
                                                    <option value="cleiby@thefederalsavingsbank.com"> Courtney Leiby </option>
                                                    <option value="dpayne@thefederalsavingsbank.com"> Damien Payne </option>
                                                    <option value="dguerra@thefederalsavingsbank.com"> Daniel Guerra </option>
                                                    <option value="dwitherspoon@thefederalsavingsbank.com"> Darren Witherspoon
                                                    </option>
                                                    <option value="dlovett@thefederalsavingsbank.com"> David Lovett </option>
                                                    <option value="dboirum@thefederalsavingsbank.com"> Dillon Boirum </option>
                                                    <option value="dnolletti@thefederalsavingsbank.com"> Dom Nolletti </option>
                                                    <option value="dkehayias@thefederalsavingsbank.com"> Dominick Kehayias</option>
                                                    <option value="earredondomendoza@thefederalsavingsbank.com"> Elizabeth Arrendondo-Mendoza </option>
                                                    <option value="eannabi@thefederalsavingsbank.com"> Emaan Annabi </option>
                                                    <option value="elee@thefederalsavingsbank.com"> Eric Lee </option>
                                                    <option value="esatterwhite@thefederalsavingsbank.com"> Eric Satterwhite
                                                    </option>
                                                    <option value="ekatz@thefederalsavingsbank.com"> Eric Katz </option>
                                                    <option value="fromero@thefederalsavingsbank.com"> Frank Romero </option>
                                                    <option value="gwimer@thefederalsavingsbank.com"> Garrett Wimer </option>
                                                    <option value="ggalindo@thefederalsavingsbank.com"> Gene Galindo </option>
                                                    <option value="gsilvestri@thefederalsavingsbank.com"> Giancarlo Silvestri
                                                    </option>
                                                    <option value="gnzunga@thefederalsavingsbank.com"> Giguya Nzunga </option>
                                                    <option value="gholzworth@thefederalsavingsbank.com"> Grant Holzworth </option>
                                                    <option value="gfranks@thefederalsavingsbank.com"> Greg Franks </option>
                                                    <option value="hserhan@thefederalsavingsbank.com"> Hadi Serhan </option>
                                                    <option value="hjebori@thefederalsavingsbank.com"> Henry Jebori </option>
                                                    <option value="ierives@thefederalsavingsbank.com"> Ivette Erives </option>
                                                    <option value="jhazouri@thefederalsavingsbank.com"> Jacob Hazouri </option>
                                                    <option value="jjalaf@thefederalsavingsbank.com"> Jacob Jalaf </option>
                                                    <option value="jacob.wilson@thefederalsavingsbank.com"> Jacob Wilson </option>
                                                    <option value="jlott@thefederalsavingsbank.com"> James Lott </option>
                                                    <option value="jhansen@thefederalsavingsbank.com"> James Hansen </option>
                                                    <option value="jvogt@thefederalsavingsbank.com"> Jared Vogt </option>
                                                    <option value="jsoldait@thefederalsavingsbank.com"> Jason Soldati </option>
                                                    <option value="jmunoz@thefederalsavingsbank.com"> Jay Munoz </option>
                                                    <option value="jcbrock@thefederalsavingsbank.com"> JC Brock </option>
                                                    <option value="Jkatz@thefederalsavingsbank.com"> Jennifer Katz </option>
                                                    <option value="jroe@thefederalsavingsbank.com"> Jennifer Roe </option>
                                                    <option value="jdewitt@thefederalsavingsbank.com"> Jese DeWitt </option>
                                                    <option value="jmaxon@thefederalsavingsbank.com"> Jessica Maxon </option>
                                                    <option value="jalfaro@thefederalsavingsbank.com"> Johann Alfaro </option>
                                                    <option value="jheinrich@thefederalsavingsbank.com"> John Heinrich </option>
                                                    <option value="jafzal@thefederalsavingsbank.com"> John Afzal </option>
                                                    <option value="jmarshall@thefederalsavingsbank.com"> Jon Marshall </option>
                                                    <option value="jmoss@thefederalsavingsbank.com"> Jonathan Moss </option>
                                                    <option value="jhugger@thefederalsavingsbank.com"> Jonathan Hugger </option>
                                                    <option value="jwolff@thefederalsavingsbank.com"> Jonathan Wolff </option>
                                                    <option value="jupshaw@thefederalsavingsbank.com"> Jonathan Upshaw </option>
                                                    <option value="Jordan.brown@thefederalsavingsbank.com"> Jordan Brown </option>
                                                    <option value="jalvarez@thefederalsavingsbank.com"> Jorge Alvarez </option>
                                                    <option value="jcardenas@thefederalsavingsbank.com"> Jose Cardenas </option>
                                                    <option value="jdoyle@thefederalsavingsbank.com"> Joseph Doyle </option>
                                                    <option value="jgaskins@thefederalsavingsbank.com"> Joseph Gaskins </option>
                                                    <option value="jdahoui@thefederalsavingsbank.com"> Joseph Dahoui </option>
                                                    <option value="jborba@thefederalsavingsbank.com"> Josh Borba </option>
                                                    <option value="jedson@thefederalsavingsbank.com"> Josiah Edson </option>
                                                    <option value="jwick@thefederalsavingsbank.com"> Justin Wick </option>
                                                    <option value="justin.brooks@thefederalsavingsbank.com"> Justin Brooks
                                                    </option>
                                                    <option value="kaishaun.scott@thefederalsavingsbank.com"> Kaishaun Scott
                                                    </option>
                                                    <option value="kchilds@thefederalsavingsbank.com"> Kara Childs </option>
                                                    <option value="kfolding@thefederalsavingsbank.com"> Keith Folding </option>
                                                    <option value="Kfoster@thefederalsavingsbank.com"> Kelli Foster </option>
                                                    <option value="koreilly@thefederalsavingsbank.com"> Kimmer Oreilly </option>
                                                    <option value="lminnefee@thefederalsavingsbank.com"> Larry Minnefee </option>
                                                    <option value="lsifuentes@thefederalsavingsbank.com"> Larry Sifuentes </option>
                                                    <option value="mquintero@thefederalsavingsbank.com"> Maritza Quintero </option>
                                                    <option value="mzavala@thefederalsavingsbank.com"> Mark Zavala </option>
                                                    <option value="mdobbs@thefederalsavingsbank.com"> Marquis Dobbs </option>
                                                    <option value="mowen@thefederalsavingsbank.com"> Matt Owen </option>
                                                    <option value="msaba@thefederalsavingsbank.com"> Matthew Saba </option>
                                                    <option value="mtio@thefederalsavingsbank.com"> Maxx Tio </option>
                                                    <option value="mwynne@thefederalsavingsbank.com"> Megan Wynne </option>
                                                    <option value="mmackinder@thefederalsavingsbank.com"> Michael Mackinder
                                                    </option>
                                                    <option value="mpotolicchio@thefederalsavingsbank.com"> Michael Potolicchio
                                                    </option>
                                                    <option value="mkirkegaard@thefederalsavingsbank.com"> Michael Kirkegaard
                                                    </option>
                                                    <option value="mgagg@thefederalsavingsbank.com"> Miles Gagg </option>
                                                    <option value="cfloyd@thefederalsavingsbank.com"> Missed Call Chris Floyd
                                                    </option>
                                                    <option value="mazarian@thefederalsavingsbank.com"> Mozzy Azarian </option>
                                                    <option value="ntanious@thefederalsavingsbank.com"> Nadim Tanious </option>
                                                    <option value="nmansour@thefederalsavingsbank.com"> Nicholas Mansour </option>
                                                    <option value="nmaffei@thefederalsavingsbank.com"> Nick Maffei </option>
                                                    <option value="nmartin@thefederalsavingsbank.com"> Nick Martin </option>
                                                    <option value="nbischoff@thefederalsavingsbank.com"> Nicole Bischoff </option>
                                                    <option value="nbrown@thefederalsavingsbank.com"> Nikolais Brown </option>
                                                    <option value="pablo.perez@thefederalsavingsbank.com"> Pablo Perez </option>
                                                    <option value="patrickn@thefederalsavingsbank.com"> Patrick Nguyen </option>
                                                    <option value="ppotolicchio@thefederalsavingsbank.com"> Paul Potolicchio
                                                    </option>
                                                    <option value="pfranklin@thefederalsavingsbank.com"> Paul Franklin </option>
                                                    <option value="pperez@thefederalsavingsbank.com"> Peter Perez </option>
                                                    <option value="pbeck@thefederalsavingsbank.com"> Preston Beck </option>
                                                    <option value="rbaume@thefederalsavingsbank.com"> Randall Baume </option>
                                                    <option value="rsierra@thefederalsavingsbank.com"> Rey Sierra </option>
                                                    <option value="rrozendaal@thefederalsavingsbank.com"> Rick Rozendaal </option>
                                                    <option value="rmellody@thefederalsavingsbank.com"> Robert Mellody </option>
                                                    <option value="rsoto@thefederalsavingsbank.com"> Rodolfo Soto </option>
                                                    <option value="rdanishyar@thefederalsavingsbank.com"> Roma Danishyar </option>
                                                    <option value="rbrown@thefederalsavingsbank.com"> Ryan Brown </option>
                                                    <option value="Rsabouneh@thefederalsavingsbank.com"> Ryan Sabouneh </option>
                                                    <option value="rsims@thefederalsavingsbank.com"> Ryan Sims </option>
                                                    <option value="rpost@thefederalsavingsbank.com"> Ryan Post </option>
                                                    <option value="rweltz@thefederalsavingsbank.com"> Ryan Weltz </option>
                                                    <option value="saljebori@thefederalsaviingsbank.com"> Sam Aljebori </option>
                                                    <option value="smargoles@thefederalsavingsbank.com"> Sam Margoles </option>
                                                    <option value="slepe@thefederalsavingsbank.com"> Samantha Lepe </option>
                                                    <option value="skubicki@thefederalsavingsbank.com"> Sarah Kubicki </option>
                                                    <option value="sarah.aljebori@thefederalsavingsbank.com"> Sarah Aljebori
                                                    </option>
                                                    <option value="sforrester@thefederalsavingsbank.com"> Schyler Forrester
                                                    </option>
                                                    <option value="sholt@thefederalsavingsbank.com"> Scott Holt </option>
                                                    <option value="sayub@thefederalsavingsbank.com"> Shoaib Ayub </option>
                                                    <option value="stavakoli@thefederalsavingsbank.com"> Sina Tavakoli </option>
                                                    <option value="sdoyle@thefederalsavingsbank.com"> Steven Doyle </option>
                                                    <option value="ssosna@thefederalsavingsbank.com"> Steven Sosna </option>
                                                    <option value="tclemons@thefederalsavingsbank.com"> Taylor Clemons </option>
                                                    <option value="twilliams@thefederalsavingsbank.com"> Terry Williams </option>
                                                    <option value="twhitehurst@thefederalsavingsbank.com"> Thomas Whitehurst
                                                    </option>
                                                    <option value="tdibona@thefederalsavingsbank.com"> Tim Dibona </option>
                                                    <option value="Tflatt@thefederalsavingsbank.com"> Tonya Flatt </option>
                                                    <option value="tandrews@thefederalsavingsbank.com"> Travis Andrews </option>
                                                    <option value="wtrick@thefederalsavingsbank.com"> Whitney Trick </option>
                                                    <option value="xalcala@thefederalsavingsbank.com"> Xavier Alcala </option>
                                                    <option value="xmedina@thefederalsavingsbank.com"> Xavier Medina </option>
                                                    <option value="yalsharif@thefederalsavingsbank.com"> Yazan Alsharif </option>
                                                    <option value="zkatz@thefederalsavingsbank.com"> Zalen Katz </option>
                                
                                            </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="bankrupty" >
                                        <span class="details">Bankrupty</span>
                                        <select name="bankrupty" id="bankr" class="form-control"> 
											<option>YES</option>
											<option>NO</option>
											
										</select>
                                    </div>
									{{-- <div class="col-md-4 col-lg-4 form-group" style="display: none" id="bankrupty" >
                                        <span class="details">Bankrupty</span>
                                        <input style="color: black" type="text" name="bankrupty" class="form-control" placeholder="Bankrupty">
                                    </div> --}}
									<div class="col-md-4 col-lg-4 form-group" style="display: none" id="debt" >
                                        <span class="details">Debt</span>
                                        <input style="color: black" type="number" name="debt" class="form-control" placeholder="Debt">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="house_value" >
                                        <span class="details">House Value</span>
                                        <input style="color: black" type="text" name="house_value" class="form-control" placeholder="HouseValue">
                                    </div>
                                    <div class="col-md-4 col-lg-4 form-group" style="display: none" id="debt_amt_1" >
                                        <span class="details"> Debt Amount 1</span>
                                        <input style="color: black" type="text" name="debt_amt_1" class="form-control" placeholder="Debt">
                                    </div>
									<!-- <div class="col-md-4 col-lg-4 form-group" style="display: none" id="debt_type" >
                                        <span class="details">Debt Type</span>
                                        <input style="color: black" type="text" name="debt_type" class="form-control" placeholder="Debt Type">
                                    </div> -->
									<div class="col-md-4 col-lg-4 form-group" style="display: none" id="creditor" >
                                        <span class="details">Creditor</span>
                                        <input style="color: black" type="text" name="creditor" class="form-control" placeholder="creditor">
                                    </div>
									<div class="col-md-4 col-lg-4 form-group" style="display: none" id="agent" >
                                        <span class="details">Agent</span>
                                        <input style="color: black" type="text" name="agent" class="form-control" placeholder="Agent">
                                    </div>
									<div class="col-md-4 col-lg-4 form-group" style="display: none" id="employment" >
                                        <span class="details">Employment</span>
                                        <select name="employment" id="emp_mtg_r" class="form-control"> 
											<option value="Unemployed">Unemployed</option>
											<option value="Self-Employed">Self-employed</option>
											<option value="EMPLOYED">EMPLOYED</option> 
											<option value="Retired/Fixedincome">retired/fixedincome</option> 
										</select>
                                    </div>
										
                                    <div class="col-md-4 col-lg-4 form-group"id="submit" style="display: block;">
                                        <span class="details">&nbsp;</span>
										<div class="row">
											<div class="col-md-6 col-lg-6">
												<a style="display:none;color:white" class="btn btn-primary form-control" 
										   			id="lead_verification" onclick="checkLead()">Lead Verification</a> 
											</div>
											<div class="col-md-6 col-lg-6">												
                                        		<input style="color: black" type="submit" class="btn btn-info form-control" value="Submit">
											</div>
                                        </div>
                                   </div>
                            </div>
            
                            
                        </form>
                    </div> 
                </div>
            </div>
        </div>
        @include('admin.layouts.footers.auth')
    </div>
@endsection
@push('js')
<script>
    // $(document).ready(() => {
    //     $('#basic-datatable').DataTable();
    // });
</script> 
<script>  
        function checkLead(){
			$('#loader').show();
        $('#searchForm').hide();
        $('#webform').hide();
            document.getElementById("successLabel").style.display="none";
            document.getElementById("errorLabel").style.display="none"; 
            $.ajax({
                url: "https://bestoptionsquote.com/api/checkLead",
                type: "get", 
                data: { 
                    'Phone1':document.querySelector("input[name=phone]").value,
                    'LoanBal':document.querySelector("input[name=loan_amount]").value,
                    'StateCd':document.getElementById("st").value,
                    'LoanType':document.getElementById("lt").value,
                    'Rate':document.querySelector("input[name=interest_rate]").value,
                    'RateType':document.getElementById("rt").value,
                    'LTV':document.querySelector("input[name=ltv]").value,
                    'Debt':document.querySelector("input[name=debt]").value,  
                    'Employment':document.getElementById("emp_mtg_r").value,
                    'Credit':document.getElementById("credit_score_value").value,
                    'Agent':"{{auth()->user()->name}}",
                    'Affiliate':"Touchstone",
                    
                     
                } ,
                success: function (response) {  
                    if(response.status==200){
						$('#loader').hide();
						$('#searchForm').show();
						$('#webform').show(); 
                        document.getElementById("successLabel").style.display="block";
                        document.getElementById("errorLabel").style="color:green";

                        document.getElementById("leadVerification").style.display="none";
                        document.getElementById("submit").style.display="block";
                        $.notify({   
                            message: 'Lead Ping Successfully',
                            icon: 'ni ni-fat-remove',
                        },{ 
                            type: 'success',
                            offset: 50,
                        });
                    }else{
						$('#loader').hide();
						$('#searchForm').show();
						$('#webform').show(); 
                        document.getElementById("errorLabel").style="display:block";
                        document.getElementById("errorLabel").style="color:red";
                        document.getElementById("errorLabel").innerHTML=response.result;
                        $.notify({   
                            message: 'Lead Verification Failed',
                            icon: 'ni ni-fat-remove',
                        },{ 
                            type: 'danger',
                            offset: 50,
                        });
                    }
                },
                 
            });
        }
         
    function searchRecord(){

        $('#loader').show();
        $('#searchForm').hide();
        $('#webform').hide();
        var id = document.getElementById('search').value; 
       
            document.getElementById('search').style.border="2px solid lightgray";
            var request = $.ajax({
                url: "{{url('/search_record')}}",
                type: "GET",
                data: {record_id :id,table:"sale_mortgages" },
                dataType: "JSON",
                success:function (res){
                    $('#loader').hide();
                    $('#searchForm').show();
					/*if(res.status==204){
						$('#webform').hide();
						$('#alreadyASaleLabel').show();
					}
					if(res.status==200){
						$('#webform').show();
						$('#alreadyASaleLabel').hide();	
					}	*/				

                    if(res.status==200){
                        $('#webform').show();
                        document.getElementById('record_id').value = res.data.ID;
                        document.querySelector("input[name=first_name]").value = res.data.FirstName;
                        document.querySelector("input[name=last_name]").value = res.data.LastName;
                        
                        document.querySelector("input[name=city]").value = res.data.City;
                        document.getElementById("st").value = res.data.State;
                        document.getElementById("phn").value = res.data.Phone;
                        document.getElementById("zipCode").value = res.data.ZipCode;
                        document.getElementById("priaddress").value = res.data.PriAddress; 
                        document.querySelector("input[name=email]").value = res.data.Email;
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
                        document.querySelector("input[name=city]").value = "";
                        document.getElementById("st").value = "";
                        document.getElementById("phn").value = "";
                        document.getElementById("zipCode").value = "";
                        document.getElementById("priaddress").value = "";
                        document.querySelector("input[name=email]").value = "";
                    }
                   
                }
            });
         
        
    } 
</script> 


<script>
    function selectClient(val) {
        document.getElementById("phn").readOnly = true;

    document.getElementById("submit").style.display = "block";
	document.getElementById("employment").style = "display:none";
	document.getElementById("bankrupty").style = "display:none";	
		document.getElementById("debt").style = "display:none";
	document.getElementById("agent").style = "display:none";	
		document.getElementById("lead_verification").style = "display:none";



    if (val == "PRO0022" || val == "ALLIEDNC0016" || val == "PRO0024" ||
        val == "PRO0028" || val == "SRWVA0019" || val == "PRO0078" ) {

        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        if (val == "PRO0024")
            document.getElementById("title").style = "display:none";
        else
            document.getElementById("title").style = "display:block";

        document.getElementById("work_phone").style = "display:block";
        document.getElementById("email").style = "display:block";
        document.getElementById("city").style = "display:block";

        document.getElementById("notes").style = "display:block";
        document.getElementById("cash_amount").style = "display:block";
        document.getElementById("current_amount").style = "display:block";
        document.getElementById("current_rate").style = "display:block";
        document.getElementById("income").style = "display:block";
        document.getElementById("property_value").style = "display:block";
        document.getElementById("company").style = "display:block";
        document.getElementById("credit_rating").style = "display:block";

        document.getElementById("mortgage_balance").style = "display:none";
        document.getElementById("loan_type").style = "display:none";
        document.getElementById("interest_rate").style = "display:none";
        document.getElementById("loan_amount").style = "display:none";

        document.getElementById("purpose_of_loan").style = "display:none";
        document.getElementById("loanofficername").style = "display:none";
        document.getElementById("ltv").style = "display:none";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("age").style = "display:none";
        document.getElementById("transfer_by").style = "display:none";
        document.getElementById("call_transfer_status").style = "display:none";
        document.getElementById("monthly_payment").style = "display:none";
        document.getElementById("late_payment").style = "display:none";
        document.getElementById("rate").style = "display:none";
        document.getElementById("cash_out").style = "display:none";
        document.getElementById("property_type").style = "display:none";
        document.getElementById("recieving_rep_qms_361").style = "display:none";
        document.getElementById("recieving_rep").style = "display:none";
        document.getElementById("cash_amount").style = "display:block";




    }
    else if ( val == "PRO0079") {
        document.getElementById("recieving_rep").style = "display:none";
        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        document.getElementById("title").style = "display:none";
        document.getElementById("work_phone").style = "display:none";
        document.getElementById("email").style = "display:block";
        document.getElementById("city").style = "display:block";
        document.getElementById("notes").style = "display:block";
        document.getElementById("cash_amount").style = "display:none";
        document.getElementById("current_amount").style = "display:none";
        document.getElementById("current_rate").style = "display:none";
        document.getElementById("income").style = "display:none";
        document.getElementById("property_value").style = "display:block";
        document.getElementById("company").style = "display:none";
        document.getElementById("credit_rating").style = "display:none";
        document.getElementById("mortgage_balance").style = "display:none";
        document.getElementById("interest_rate").style = "display:block";
        document.getElementById("loan_amount").style = "display:block";
        document.getElementById("loan_type").style = "display:none";
        document.getElementById("purpose_of_loan").style = "display:none";
        document.getElementById("loanofficername").style = "display:none";
        document.getElementById("ltv").style = "display:none";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("age").style = "display:none";
        document.getElementById("transfer_by").style = "display:none";
        document.getElementById("call_transfer_status").style = "display:none";
        document.getElementById("monthly_payment").style = "display:none";
        document.getElementById("late_payment").style = "display:none";
        document.getElementById("rate").style = "display:none";
        document.getElementById("cash_out").style = "display:block";
        document.getElementById("property_type").style = "display:none";
        document.getElementById("recieving_rep_qms_361").style = "display:none";


    }
    
    else if (val == "PRO0057") {
        document.getElementById("recieving_rep").style = "display:none";
        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        document.getElementById("title").style = "display:none";
        document.getElementById("work_phone").style = "display:none";
        document.getElementById("email").style = "display:none";
        document.getElementById("city").style = "display:block";

        document.getElementById("notes").style = "display:none";
        document.getElementById("cash_amount").style = "display:none";
        document.getElementById("current_amount").style = "display:none";
        document.getElementById("current_rate").style = "display:none";
        document.getElementById("income").style = "display:none";
        document.getElementById("property_value").style = "display:none";
        document.getElementById("company").style = "display:none";
        document.getElementById("credit_rating").style = "display:none";
        document.getElementById("mortgage_balance").style = "display:none";
        document.getElementById("interest_rate").style = "display:none";
        document.getElementById("loan_amount").style = "display:none";
        document.getElementById("loan_type").style = "display:none";
        document.getElementById("purpose_of_loan").style = "display:none";
        document.getElementById("loanofficername").style = "display:none";
        document.getElementById("ltv").style = "display:none";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("age").style = "display:none";
        document.getElementById("transfer_by").style = "display:none";
        document.getElementById("call_transfer_status").style = "display:none";
        document.getElementById("monthly_payment").style = "display:none";
        document.getElementById("late_payment").style = "display:none";
        document.getElementById("rate").style = "display:none";
        document.getElementById("cash_out").style = "display:none";
        document.getElementById("property_type").style = "display:none";
        document.getElementById("recieving_rep_qms_361").style = "display:none";


    }
    
    else if (val == "PRO0100") {
        document.getElementById("recieving_rep").style = "display:none";
        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        document.getElementById("title").style = "display:none";
        document.getElementById("work_phone").style = "display:none";
        document.getElementById("email").style = "display:block";
        document.getElementById("city").style = "display:block";

        document.getElementById("notes").style = "display:block";
        document.getElementById("cash_amount").style = "display:block";
        document.getElementById("current_amount").style = "display:none";
        document.getElementById("current_rate").style = "display:none";
        document.getElementById("income").style = "display:none";
        document.getElementById("property_value").style = "display:none";
        document.getElementById("company").style = "display:none";
        document.getElementById("credit_rating").style = "display:none";
        document.getElementById("mortgage_balance").style = "display:none";
        document.getElementById("interest_rate").style = "display:block";
        document.getElementById("loan_amount").style = "display:block";
        document.getElementById("loan_type").style = "display:none";
        document.getElementById("purpose_of_loan").style = "display:none";
        document.getElementById("loanofficername").style = "display:none";
        document.getElementById("ltv").style = "display:none";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("age").style = "display:none";
        document.getElementById("transfer_by").style = "display:none";
        document.getElementById("call_transfer_status").style = "display:none";
        document.getElementById("monthly_payment").style = "display:none";
        document.getElementById("late_payment").style = "display:none";
        document.getElementById("rate").style = "display:none";
        document.getElementById("cash_out").style = "display:none";
        document.getElementById("property_type").style = "display:none";
        document.getElementById("recieving_rep_qms_361").style = "display:none";
    }
    
    else if (val == "PRO0105") {
        document.getElementById("recieving_rep").style = "display:none";
        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        document.getElementById("title").style = "display:none";
        document.getElementById("work_phone").style = "display:none";
        document.getElementById("email").style = "display:block";
        document.getElementById("city").style = "display:block";
        document.getElementById("debt").style = "display:block";	
        document.getElementById("notes").style = "display:block";
        document.getElementById("cash_amount").style = "display:none";
        document.getElementById("current_amount").style = "display:none";
        document.getElementById("current_rate").style = "display:none";
        document.getElementById("income").style = "display:none";
        document.getElementById("property_value").style = "display:none";
        document.getElementById("company").style = "display:none";
        document.getElementById("credit_rating").style = "display:none";
        document.getElementById("mortgage_balance").style = "display:none";
        document.getElementById("interest_rate").style = "display:none";
        document.getElementById("loan_amount").style = "display:none";
        document.getElementById("loan_type").style = "display:none";
        document.getElementById("purpose_of_loan").style = "display:none";
        document.getElementById("loanofficername").style = "display:none";
        document.getElementById("ltv").style = "display:none";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("age").style = "display:none";
        document.getElementById("transfer_by").style = "display:none";
        document.getElementById("call_transfer_status").style = "display:none";
        document.getElementById("monthly_payment").style = "display:none";
        document.getElementById("late_payment").style = "display:none";
        document.getElementById("rate").style = "display:none";
        document.getElementById("cash_out").style = "display:none";
        document.getElementById("property_type").style = "display:none";
        document.getElementById("recieving_rep_qms_361").style = "display:none";


    }
    
    else if (val == "PRO0032" || val == "PRO0031" || val == "PRO0064") {


        document.getElementById("recieving_rep").style = "display:none";
        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("city").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        document.getElementById("property_value").style = "display:block";
        document.getElementById("credit_rating").style = "display:none";
        document.getElementById("current_rate").style = "display:none";
        document.getElementById("title").style = "display:none";
        document.getElementById("work_phone").style = "display:none";
        document.getElementById("email").style = "display:none";
        document.getElementById("loanofficername").style = "display:block";
        document.getElementById("camp8_loanofficername").style = "display:block";


        document.getElementById("notes").style = "display:none";

        document.getElementById("current_amount").style = "display:none";

        document.getElementById("income").style = "display:none";

        document.getElementById("company").style = "display:none";



        if (val == "PRO0064") {
            document.getElementById("cash_amount").style = "display:none";
            document.getElementById("purpose_of_loan").style = "display:none";
            document.getElementById("loanofficername").style = "display:none";
            document.getElementById("company").style = "display:none";


        } else if (val == "radebt") {
            document.getElementById("purpose_of_loan").style = "display:none";
            document.getElementById("loanofficername").style = "display:none";

        } else {
            document.getElementById("cash_amount").style = "display:block";
            document.getElementById("purpose_of_loan").style = "display:block";

            document.getElementById("loan_amount").style = "display:block";
            document.getElementById("credit_rating").style = "display:block";
        }
        document.getElementById("loan_type").style = "display:block";
        document.getElementById("mortgage_balance").style = "display:block";
        if (val == "camp8") {
            document.getElementById("mortgage_balance").style = "display:block";
            document.getElementById("loan_amount").style = "display:block";
        }
        if (val == "camp21") {
            document.getElementById("credit").style = "display:block";
        }
        document.getElementById("interest_rate").style = "display:block";


        document.getElementById("ltv").style = "display:none";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("age").style = "display:none";
        document.getElementById("transfer_by").style = "display:none";
        document.getElementById("call_transfer_status").style = "display:none";
        document.getElementById("monthly_payment").style = "display:none";
        document.getElementById("late_payment").style = "display:none";
        document.getElementById("rate").style = "display:none";
        document.getElementById("cash_out").style = "display:none";
        document.getElementById("property_type").style = "display:none";
        document.getElementById("recieving_rep_qms_361").style = "display:none";



    } else if (val == "PRO0056") {

        document.getElementById("recieving_rep").style = "display:none";
        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        document.getElementById("city").style = "display:block";
        document.getElementById("property_value").style = "display:block";
        document.getElementById("credit_rating").style = "display:block";
        document.getElementById("loan_type").style = "display:block";
        document.getElementById("rate").style = "display:block";
        document.getElementById("current_rate").style = "display:none";
        document.getElementById("monthly_payment").style = "display:none";
        document.getElementById("late_payment").style = "display:none";

        document.getElementById("title").style = "display:none";
        document.getElementById("work_phone").style = "display:none";
        document.getElementById("email").style = "display:none";

        document.getElementById("notes").style = "display:none";
        document.getElementById("cash_amount").style = "display:none";
        document.getElementById("current_amount").style = "display:none";
        document.getElementById("income").style = "display:none";

        document.getElementById("company").style = "display:none";
        document.getElementById("mortgage_balance").style = "display:none";
        document.getElementById("interest_rate").style = "display:none";
        document.getElementById("loan_amount").style = "display:block";
        document.getElementById("purpose_of_loan").style = "display:none";
        document.getElementById("loanofficername").style = "display:none";
        document.getElementById("ltv").style = "display:none";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("age").style = "display:none";
        document.getElementById("transfer_by").style = "display:none";
        document.getElementById("call_transfer_status").style = "display:none";
        document.getElementById("cash_out").style = "display:none";
        document.getElementById("property_type").style = "display:none";
        document.getElementById("recieving_rep_qms_361").style = "display:none";




    } else if (val == "REVLB23440014" || val == "rev_lb_2367" ||
        val == "REVLB23740008" || val == "REVLB23970009" || val == "REVLB23990013" ||
        val == "PRO0076"  || val == "PRO0077" || val == "PRO0080" ) {
        if (val == "REVLB23740008"){
            document.getElementById("recieving_rep").style = "display:block";
		}
        else{
            document.getElementById("recieving_rep").style = "display:none";
			}
		
	
		

        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("city").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        document.getElementById("mortgage_balance").style = "display:block";
        document.getElementById("property_value").style = "display:block";
        document.getElementById("cash_out").style = "display:block";
        document.getElementById("loan_amount").style = "display:block";
        document.getElementById("ltv").style = "display:block";
        document.getElementById("credit_rating").style = "display:block";
        document.getElementById("interest_rate").style = "display:block";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("property_type").style = "display:block";
        document.getElementById("monthly_payment").style = "display:block";
        document.getElementById("late_payment").style = "display:block";
        document.getElementById("age").style = "display:block";
        document.getElementById("income").style = "display:block";
        document.getElementById("transfer_by").style = "display:block";
        document.getElementById("notes").style = "display:block";

        document.getElementById("loan_type").style = "display:none";
        document.getElementById("rate").style = "display:none";
        document.getElementById("current_rate").style = "display:none";


        document.getElementById("title").style = "display:none";
        document.getElementById("work_phone").style = "display:none";
        document.getElementById("email").style = "display:none";


        document.getElementById("cash_amount").style = "display:none";
        document.getElementById("current_amount").style = "display:none";
        document.getElementById("company").style = "display:none";
        document.getElementById("purpose_of_loan").style = "display:none";
        document.getElementById("loanofficername").style = "display:none";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("recieving_rep_qms_361").style = "display:none";
    }
     else if(val == "PRO0102" )
     {
         document.getElementById("first_name").style = "display:block";
         document.getElementById("last_name").style = "display:block";
         document.getElementById("phone").style = "display:block";
         document.getElementById("address").style = "display:block";
         document.getElementById("city").style = "display:block";
         document.getElementById("state").style = "display:block";
         document.getElementById("zip").style = "display:block";
         document.getElementById("mortgage_balance").style = "display:block";
         document.getElementById("property_value").style = "display:block";
         document.getElementById("cash_out").style = "display:block";
         document.getElementById("loan_amount").style = "display:block";
         document.getElementById("ltv").style = "display:block";
         document.getElementById("credit_rating").style = "display:block";
         document.getElementById("interest_rate").style = "display:block";
         document.getElementById("rate_type").style = "display:none";
         document.getElementById("property_type").style = "display:block";
         document.getElementById("monthly_payment").style = "display:block";
         document.getElementById("late_payment").style = "display:block";
         document.getElementById("age").style = "display:block";
         document.getElementById("income").style = "display:block";
         document.getElementById("transfer_by").style = "display:block";
         document.getElementById("call_transfer_status").style = "display:block"
         document.getElementById("notes").style = "display:block"
         document.getElementById("loan_type").style = "display:none";
         document.getElementById("rate").style = "display:none";
         document.getElementById("current_rate").style = "display:none"
         document.getElementById("title").style = "display:none";
         document.getElementById("work_phone").style = "display:none";
         document.getElementById("email").style = "display:none"
         document.getElementById("cash_amount").style = "display:none";
         document.getElementById("current_amount").style = "display:none";
         document.getElementById("company").style = "display:none";
         document.getElementById("purpose_of_loan").style = "display:none";
         document.getElementById("loanofficername").style = "display:none";
         document.getElementById("rate_type").style = "display:none";
         document.getElementById("recieving_rep_qms_361").style = "display:none"
     }
    
    else if(val == "PRO0096"){


        
        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("debt_amt_1").style = "display:block";
        document.getElementById("city").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        document.getElementById("mortgage_balance").style = "display:none";
        document.getElementById("property_value").style = "display:none";
        document.getElementById("cash_out").style = "display:none";
        document.getElementById("loan_amount").style = "display:none";
        document.getElementById("ltv").style = "display:none";
        document.getElementById("credit_rating").style = "display:none";
        document.getElementById("interest_rate").style = "display:none";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("property_type").style = "display:none";
        document.getElementById("monthly_payment").style = "display:block";
        document.getElementById("late_payment").style = "display:block";
        document.getElementById("age").style = "display:none";
        document.getElementById("income").style = "display:block";
        document.getElementById("transfer_by").style = "display:block";
        document.getElementById("notes").style = "display:block";

        document.getElementById("loan_type").style = "display:none";
        document.getElementById("rate").style = "display:none";
        document.getElementById("current_rate").style = "display:none";


        document.getElementById("title").style = "display:none";
        document.getElementById("work_phone").style = "display:none";
        document.getElementById("email").style = "display:none";


        document.getElementById("cash_amount").style = "display:none";
        document.getElementById("current_amount").style = "display:none";
        document.getElementById("company").style = "display:none";
        document.getElementById("purpose_of_loan").style = "display:none";
        document.getElementById("loanofficername").style = "display:none";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("recieving_rep_qms_361").style = "display:none";

	     document.getElementById("debt").style = "display:block";			
		document.getElementById("debt_type").style = "display:block";
		document.getElementById("creditor").style = "display:block";
         document.getElementById("phn").readOnly = false;
            
        }


    else if (val == "REVLB23980010") {
        document.getElementById("recieving_rep").style = "display:none";
        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("city").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        document.getElementById("mortgage_balance").style = "display:block";
        document.getElementById("property_value").style = "display:block";
        document.getElementById("cash_out").style = "display:block";
        document.getElementById("loan_amount").style = "display:block";
        document.getElementById("ltv").style = "display:block";
        document.getElementById("credit_rating").style = "display:block";
        document.getElementById("interest_rate").style = "display:block";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("property_type").style = "display:block";
        document.getElementById("monthly_payment").style = "display:block";
        document.getElementById("late_payment").style = "display:block";
        document.getElementById("age").style = "display:block";
        document.getElementById("income").style = "display:block";
        document.getElementById("transfer_by").style = "display:block";
        document.getElementById("notes").style = "display:block";

        document.getElementById("loan_type").style = "display:none";
        document.getElementById("rate").style = "display:none";
        document.getElementById("current_rate").style = "display:none";


        document.getElementById("title").style = "display:none";
        document.getElementById("work_phone").style = "display:none";
        document.getElementById("email").style = "display:none";


        document.getElementById("cash_amount").style = "display:none";
        document.getElementById("current_amount").style = "display:none";


        document.getElementById("company").style = "display:none";



        document.getElementById("purpose_of_loan").style = "display:none";
        document.getElementById("loanofficername").style = "display:none";

        document.getElementById("rate_type").style = "display:none";




    } else if (val == "PRO0036") {

        document.getElementById("recieving_rep").style = "display:none";
        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        document.getElementById("title").style = "display:none";
        document.getElementById("work_phone").style = "display:none";
        document.getElementById("email").style = "display:none";
        document.getElementById("city").style = "display:block";
        document.getElementById("notes").style = "display:none";
        document.getElementById("current_amount").style = "display:none";
        document.getElementById("current_rate").style = "display:none";
        document.getElementById("income").style = "display:none"; 

        document.getElementById("property_value").style = "display:block";
        document.getElementById("company").style = "display:none";
        document.getElementById("credit_rating").style = "display:block";
        document.getElementById("loan_type").style = "display:block";
        document.getElementById("mortgage_balance").style = "display:block";
        document.getElementById("interest_rate").style = "display:block";
        document.getElementById("ltv").style = "display:none";
        document.getElementById("rate_type").style = "display:none";
        document.getElementById("age").style = "display:none";
        document.getElementById("transfer_by").style = "display:none";
        document.getElementById("call_transfer_status").style = "display:block";
        document.getElementById("monthly_payment").style = "display:none";
        document.getElementById("late_payment").style = "display:none";
        document.getElementById("rate").style = "display:none";
        document.getElementById("cash_out").style = "display:none";
        document.getElementById("property_type").style = "display:none";
        document.getElementById("purpose_of_loan").style = "display:none";
        document.getElementById("cash_amount").style = "display:block";

    }
		
		else if (val == "PRO0094" ) { 
        document.getElementById("first_name").style = "display:block";
        document.getElementById("last_name").style = "display:block";
        document.getElementById("phone").style = "display:block";
        document.getElementById("address").style = "display:block";
        document.getElementById("city").style = "display:block";
        document.getElementById("state").style = "display:block";
        document.getElementById("zip").style = "display:block";
        document.getElementById("mortgage_balance").style = "display:none";
        document.getElementById("property_value").style = "display:block";
        document.getElementById("loan_amount").style = "display:block";
        document.getElementById("ltv").style = "display:block";
        document.getElementById("credit_rating").style = "display:none";
        document.getElementById("interest_rate").style = "display:block";
        document.getElementById("rate_type").style = "display:block";
        document.getElementById("lt").style = "display:block";
        document.getElementById("property_type").style = "display:block";
        document.getElementById("house_value").style = "display:block";
        document.getElementById("loan_balance").style = "display:block";
        document.getElementById("lender").style = "display:block";
        document.getElementById("notes").style = "display:block";
        document.getElementById("rate").style = "display:block";
        document.getElementById("purpose_of_loan").style = "display:none";
        document.getElementById("mtgr_loanofficername").style = "display:block";         
		//document.getElementById("mtg_loanofficername").style = "display:none"; 
		document.getElementById("loanofficername").style = "display:block";
        document.getElementById("rate_type").style = "display:block";
        document.getElementById("credit_score").style = "display:block";
		document.getElementById("employment").style = "display:block";
		document.getElementById("bankrupty").style = "display:block";		
		document.getElementById("debt").style = "display:block";
		document.getElementById("agent").style = "display:block";
		document.getElementById("lead_verification").style = "display:block;color:white";

        document.getElementById("cash_out").style = "display:none";
        document.getElementById("monthly_payment").style = "display:none";
        document.getElementById("late_payment").style = "display:none";
        document.getElementById("age").style = "display:none";
        document.getElementById("income").style = "display:none";
        document.getElementById("transfer_by").style = "display:none";
        document.getElementById("loan_type").style = "display:block";
        document.getElementById("current_rate").style = "display:none";
        document.getElementById("call_transfer_status").style = "display:none";
        document.getElementById("title").style = "display:none";
        document.getElementById("work_phone").style = "display:none";
        document.getElementById("email").style = "display:none";
        document.getElementById("cash_amount").style = "display:none";
        document.getElementById("current_amount").style = "display:none";
        document.getElementById("company").style = "display:none";
        document.getElementById("recieving_rep_qms_361").style = "display:none";
		document.getElementById("camp8_loanofficername").style = "display:none";
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
<noscript><img src='//create.leadid.com/noscript.gif?lac=BF7F77BD-87EC-7538-6E77-BCB51CF20276&lck=bf7f77bd-face-feed-cafe-bcb51cf20276&snippet_version=2' /></noscript>





@endpush
