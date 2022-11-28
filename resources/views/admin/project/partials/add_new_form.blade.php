<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">New Projects</h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form method="post" action="{{ route('projects.store') }}" id="my-form" autocomplete="off">
            @csrf
            @method('post')

            <div class="pl-lg-4">
                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">{{ __('labels.name') }}</label>
                    <input type="text" name="name" id="input-name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('project_code') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-name">Project Code</label>
                    <input type="text" name="project_code" id="project_code" class="form-control {{ $errors->has('project_code') ? ' is-invalid' : '' }}" placeholder="Project Code" value="{{ old('project_code') }}" required autofocus>

                    @if ($errors->has('project_code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('project_code') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('client') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-client">client</label>
                    <select name="client_id" id="input-client" class="form-control" data-toggle="select"  required>
                        <option value="">Select client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id')==$client->id ? 'selected' :'' }}>{{$client->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('client_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('client_id') }}</strong>
                        </span>
                    @endif
                    <!-- <span class="help-text text-muted" style="font-size: .8rem; font-style: italic;">{{ __('labels.future_tickets_message') }}</span> -->
                </div>

                <div class="text-left">
                    <button type="submit" class="btn btn-info mt-4">{{ __('labels.submit') }}</button>
                </div>
            </div>

        </form>
    </div>

</div>