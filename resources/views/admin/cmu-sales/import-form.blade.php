@extends('admin.layouts.app', ['current_page' => 'cmu-sales-import-form'])
@section('content')
    @include('admin.layouts.headers.cards', ['title' => 'CMU-Sales-Import-Form'])
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        @if ($errors->any())
                            <div class="alert alert-danger"style="color: white;">
                                <strong class="text-secondary">Oops!</strong> There were some problems with your
                                input.<br><br>
                                <ul style="color: white;padding-left:20px">
                                    @foreach ($errors->all() as $error)
                                        <li style="color: white">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="col-lg-12 text-center"
                                style="margin-top:10px;margin-bottom: 10px; padding-left:50px">
                                <div class="alert alert-success" style="color: white">
                                    {{ $message }}
                                </div>
                            </div>
                        @endif
                        <form action="{{ route('cmu-sales.import') }}" method="POST" id="webform"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label">Upload File</label><a href="{{ asset("cmu-sample-import-data-file.csv") }}" download>(Click here to download relevant file format)</a>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile02" name="file">
                                    <label class="custom-file-label text-left" for="inputGroupFile02"><i
                                            data-feather="upload" width="15"></i> {{ __('labels.select_file') }}</label>
                                </div>
                                <div class="text-left">
                                    <button type="submit" class="btn btn-info mt-4">Upload</button>
                                </div>
                            </div>

                            <div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="mb-0">Call CMU Salesheet</h3>
                            </div>							 
                        </div>
                    </div>
                    <div class="table-responsive pb-3">
                        <table class="table align-items-center table-flush"  > 
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="3%">ID</th>
                                    <th scope="col" width="3%">Name</th>
                                    <th scope="col" width="3%">HRMSID</th>
									<th scope="col" width="3%">Project Name</th> 
									<th scope="col" width="3%">Project Code</th> 
									<th scope="col" width="3%">Count</th> 
                                    <th scope="col" width="3%">Created at</th>	
                                    @if (in_array(Auth::user()->roles[0]->name, ['Super Admin'])) 
                                    <th scope="col" width="3%">Action</th>	
                                    @endif
                                     
                                </tr>
                            </thead>
                            <tbody>  
                                @if(!$sales->isEmpty())
                                    @foreach($sales as $row)
                                        <tr>
                                            <td>{{@$row->id}}</td>
                                            <!--<td>{{@$row->user->name ?? 'N/A'}}</td>-->
                                            <!--<td>{{@$row->user->HRMSID ?? 0}} </td>--> 
											<td>{{@$row->name ?? 'N/A'}}</td>
											<td>{{@$row->hrms_id ?? 0}} </td>
                                            <td>{{@$row->project->name}}</td>
                                            <td>{{@$row->project->project_code}}</td> 
                                            <td>{{@$row->count}}</td> 
                                            <td>{{@$row->created_at}}</td> 
                                            @if (in_array(Auth::user()->roles[0]->name, ['Super Admin']))
                                            <td width="3%">  
                                                <a href="{{ route('cmu-sales-delete', $row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                             @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div style="padding: 22px;">
                            {{$sales->links()}}
                        </div>
                        
                    </div>
                </div>
            </div>
             

        </div>
        @include('admin.layouts.footers.auth')
    </div>
@endsection
@push('js')
    <script>
        $('#inputGroupFile02').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
@endpush
