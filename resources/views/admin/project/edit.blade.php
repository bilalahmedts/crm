@extends('admin.layouts.app', [ 'current_page' => 'projects' ])

@section('content')

    @push('header-buttons')
        <div class="col-lg-6 col-5 text-right">
          <a href="{{ route('projects.index') }}" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> {{__('labels.projects')}}</a>
        </div>
    @endpush

    @include('admin.layouts.headers.cards', ['title' =>  "Projects"])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">

                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ "Edit"}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('projects.update', $client->id) }}" id="my-form" autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('labels.name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('labels.name') }}" value="{{ old('name', $client->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('project_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Product ID</label>
                                    <input type="text" disabled name="project_id" id="project_id" class="form-control {{ $errors->has('project_id') ? ' is-invalid' : '' }}" placeholder="Product ID" value="{{ old('project_id',$client->project_id) }}" required autofocus>
                
                                    @if ($errors->has('project_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('project_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                



                                <div class="form-group{{ $errors->has('client') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-client">{{ __('labels.default_assigned_client') }}</label>
                                    <select name="client_id" id="input-client" class="form-control" data-toggle="select">
                                        <option value="" {{ old('client_id', $client->client_id) == '' ? 'selected' : '' }}>Select client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ old('client_id', $client->client_id)==$client->id ? 'selected' :'' }}>{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('client_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('client_id') }}</strong>
                                        </span>
                                    @endif
                                    <span class="help-text text-muted" style="font-size: .8rem; font-style: italic;">{{ __('labels.future_tickets_message') }}</span>
                                </div>

                                <div class="text-left">
                                    <button type="submit" class="btn btn-info mt-4">{{ __('labels.update') }}</button>
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
            $(document).ready(() => {

                $('#basic-datatable').DataTable();
            });
        </script>

        <form action="#" method="post" id="FORM_DELETE">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
        @endpush
