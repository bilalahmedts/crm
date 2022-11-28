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
                                <label class="form-control-label" for="upload_image">Upload File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="upload_image"
                                        lang="en">
                                    <label class="custom-file-label text-left" for="upload_image"><i data-feather="upload"
                                            width="15"></i> {{ __('labels.select_file') }}</label>
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
        @include('admin.layouts.footers.auth')
    </div>
@endsection
