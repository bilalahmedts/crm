@extends('admin.layouts.app', [ 'current_page' => 'projects' ])

@section('content')


    @include('admin.layouts.headers.cards', ['title' => 'Projects'])

    <div class="container-fluid mt--6">
        <div class="col">
            @if(auth()->user()->hasRole("Super Admin"))
            @can('project.create')
                @include('admin.project.partials.add_new_form')
            @endcan
            @endif
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ "Manage Projects" }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive pb-3">
                        <table class="table align-items-center table-flush" id="basic-datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('labels.id') }}</th>
                                    <th scope="col">{{ __('labels.name') }}</th>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">{{ __('labels.created_at') }}</th>                                    
                                    <th scope="col">IsFixed</th>
                                    <th scope="col">Hours</th>
                                    <th scope="col">Seats</th>
                                    <th scope="col">Action</th> 
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($projects as $project)
                                    
                                    <tr>
                                        <td>
                                            <a href="{{ route('projects.edit', $project->id) }}">{{$project->id}}</a>
                                        </td>
                                        <td class="table-user">
                                            {{ $project->name }}
                                        </td>
                                        <td class="table-user">
                                            {{ @$project->project_code }}
                                        </td>
                                        <td class="table-user">
                                            {{ (@$project->client) ? @$project->client->name:'' }}
                                        </td>
                                        <td>{{$project->created_at}}</td>
                                        <td class="text-right">
                                            <!-- Default checked -->
                                            <div class="custom-control custom-switch">
                                                <input onchange="changeStatus({{$project->id}},this)" type="checkbox" class="custom-control-input" id="{{ $project->id }}" @if($project->isFixed ) checked @endif>
                                                <label class="custom-control-label" for="{{ $project->id }}"> </label>
                                            </div>
                                        </td>
                                        <td class="table-user">
                                            {{ (@$project->hours) }}
                                        </td>
                                        <td class="table-user">
                                            {{ (@$project->seats) }}
                                        </td>
                                        
                                        <td  >
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    @can('projects.edit')
                                                        <a class="dropdown-item" href="{{ route('projects.edit', $project->id) }}">{{ __('labels.edit') }}</a>
                                                    @endcan
                                                    @can('projects.delete')
                                                        <a class="dropdown-item delete-btn" href="#" onclick="if(confirm('{{ __('labels.confirm_delete') }}')){  $('#FORM_DELETE').attr('action', '{{ route('projects.destroy', $project->id) }}').submit(); }" >{{ __('labels.delete') }}</a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            {{ __('labels.no_data_found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            

        </div>

        @include('admin.layouts.footers.auth')



    </div>
@endsection


        @push('js')

        <script>
            $(document).ready(() => {

                $('#basic-datatable').DataTable();
            }); 
            function changeStatus(id,obj){  
                var val=0;
                if(obj.checked==true)
                    var val=1; 
				$.ajax({
					url: "{{url('api/changeIsFixed')}}",
					type: "get", 
					data: { 
						'isFixed':val,
						'id':id,   
						'table':"sale_mortgages",
					} ,
					success: function (response) {   
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
        </script>

        <form action="#" method="post" id="FORM_DELETE">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
        @endpush
