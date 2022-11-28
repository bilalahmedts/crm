@extends('admin.layouts.app', [ 'current_page' => 'mortgage' ])

@section('content')


    @include('admin.layouts.headers.cards', ['title' => "Mortgage"])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <form action="{{route('mortgages.index')}}" method="GET">
                                    <div class="row">
                                        <div class="col-md-2 col-lg-2 form-group">
                                            <label>Phone</label>
                                            <input type="text" value="{{@$_GET['search']}}" name="search" class="form-control">                                             
                                        </div>
                                        <div class="col-md-2 col-lg-2 form-group">
                                            <label>From Date</label>
                                            <input type="date" value="{{@$_GET['start_date']}}"  name="start_date" class="form-control">                                             
                                        </div>
                                        <div class="col-md-2 col-lg-2 form-group">
                                            <label>To Date</label>
                                            <input type="date" value="{{@$_GET['end_date']}}"  name="end_date" class="form-control">                                             
                                        </div>
                                        @if (in_array(Auth::user()->roles[0]->name, ['Super Admin','MortgageManager','AllSheet']))
                                        <div class="col-md-2 col-lg-2 form-group">
                                            <label>Client</label>
                                            <select name="client_id" id="" onchange ="selectClient(this.value)" value="{{@$_GET['client_id']}}"  class="form-control">
                                                <option value="">--Select--</option>
                                                @foreach($clients as $client)
                                                <option value="{{$client->client_code}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>                                             
                                        </div>
                                        
                                        <div class="col-md-2 col-lg-2 form-group">
                                            <label>Project</label>
                                            <select name="project_id" value="{{@$_GET['project_id']}}" id="project_id"  class="form-control">
                                                <option value="">--Select--</option>
                                                @foreach($projects as $project)
                                                <option value="{{$project->project_code}}">{{$project->name}}</option>
                                                @endforeach
                                            </select>                                             
                                        </div>
                                        @endif
                                        <div class="col-md-1 col-lg-1 form-group">
                                            <label>&nbsp;</label>
                                            <input type="submit" name="submit"  value="search" class="form-control btn btn-primary">                                             
                                        </div>
                                        <div class="col-md-1 col-lg- form-group">
                                            <label>&nbsp;</label>
                                            <input type="submit" name="export"  value="Export" class="form-control btn btn-primary">
                                            {{-- <a href="{{url('admin/mortgageExport')}}" class="form-control btn btn-primary">Export</a>                                              --}}
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
							@if(auth()->user()->hasRole('MortgageAgent') || auth()->user()->hasRole('Mortgage Manager'))
                            <div class="col-2 ">
                                <a href="{{route('mortgages.create')}}" class="btn btn-info float-right">
									<i class="fa fa-arrow-left"></i>Sale Submission</a>
                            </div>
							@endif
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
									@if(auth()->user()->hasRole('MortgageClient') || auth()->user()->hasRole('Super Admin'))
									<th scope="col" width="10%">Client Status</th> 
									@endif

                                    <th scope="col" width="3%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 {{-- @php
                                 
                                 $reporting_to = \DB::select(DB::raw("Select u.name from users u inner join users us On u.HRMSID=us.reporting_to_id;"));
                                //  dd($reporting_to)
                                @endphp - --}}
                                @foreach($mortgages as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->record_id}}</td>
                                        <td>{{$row->first_name}} </td> 
										<td>{{$row->last_name}}</td>
                                        <td>{{$row->phone}}</td>
                                        <td>{{$row->state}}</td> 
                                        <td>{{$row->created_at}}</td> 
                                        <td>{{($row->user) ? $row->user->name:'' }}</td>
                                        <td>{{($row->user) ? $row->user->HRMSID:'' }}</td>
                                        <td>{{ $row->user->reporting_to_name->name ?? '' }}</td>
                                         {{-- @foreach($reporting_to as $rt=>$value)
                                        <td> @php htmlspecialchars($value) @endphp</td>
                                        @endforeach --}}
                                        {{-- <td>{{($row->user) ? $row->user->reporting_to_name->name:'' }}</td> --}}
                                        {{-- @php
                                        if($row->user)
                                        {
                                            print_r($row->user->reporting_to_name->name);
                                        }
                                        
                                        
                                        @endphp --}}
										<td>{{$row->client_status}}</td>
										<td>{{$row->qa_status}}</td>
                                        <td><b> {{($row->client) ? $row->client->name:'' }} </b></td>
										<td><b> {{($row->project) ? $row->project->name:'' }} </b></td>	
										@if(auth()->user()->hasRole('MortgageClient') || auth()->user()->hasRole('Super Admin'))
											<?php $status = ['billable'=>"Accepeted",'not-billable'=>"Rejected" ,'pending'=>"Pending"];?>
											<td> 
												<select onchange="remarks(this.value,{{$row->id}})" class="form-control bg bg-default">
													@foreach($status as $key=> $st)
														<option 
															@if($key==$row->client_status) 
															{{'selected'}} 
															@endif
															@if( $row->client_status !="pending") 
															{{'disabled'}} 
															@endif
															value="{{$key}}">{{ ($st)}}</option>
													@endforeach
												</select>
											</td>
										 
										@endif
                                        <td>
                                            <a href="#" >
                                                {{-- <i class="fas fa-trash"></i> --}}
                                                <form action="{{route('mortgages.destroy',[$row->id])}}" method="post">
                                                    <a href="{{route('mortgages.show',[$row->id])}}" class="btn btn-success btn-sm">View</a>                                                     
                                                    @if (in_array(Auth::user()->roles[0]->name, ['Super Admin']))
                             						<input class="btn btn-default btn-sm" value="Delete" type="submit"  />
                                                    {!! method_field('delete') !!}
                                                    {!! csrf_field() !!}
                        						@endif
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="padding: 22px;">
                            {{$mortgages->links()}}
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

        @include('admin.layouts.footers.auth')



    </div>
@endsection


        @push('js')

        <script>
			function remarks(val,id){
				$('#remarks').modal('show');
				document.getElementById('id_status').value=id;				
				document.getElementById('qa_status').value=val;

			}
            function selectClient(val){
                $.ajax({
                    url:"{{url('api/selectClient')}}",
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
					url: "{{url('api/changeStatusClient')}}",
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
            @csrf
            @method('DELETE')
        </form>
        @endpush
