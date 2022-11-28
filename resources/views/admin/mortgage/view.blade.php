@extends('admin.layouts.app', ['current_page' => 'mortgages'])

@section('content')
@push('header-buttons')
        <div class="col-lg-6 col-5 text-right">
          <a href="{{ route('mortgages.index') }}" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> Go Back</a>
        </div>
    @endpush
    @include('admin.layouts.headers.cards', ['title' => 'Mortgage-Sale View'])

    <div class="container-fluid mt--6">

                <div class="card shadow">
                    <div class="card-header border-0">


                                <div class="table-responsive pb-3">
                                    <table class="table align-items-center table-flush">
                                        <tbody>


                                                    <tr>
                                                        <th >ID</th>
                                                        <td>{{ $data->id ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Name</th>
                                                        <td>{{ $data->first_name ?? '' }} {{ $data->last_name ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Agent Name</th>
                                                        <td>{{ $data->user->name ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Phone</th>
                                                        <td>{{ $data->phone ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Client</th>
                                                        <td><b>{{ $data->client ? $data->client->name : '' ?? '' }}</b></td>

                                                    </tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td>{{ $data->email ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td>{{ $data->address ?? '' }}</td>
                                                    </tr>
                                                        <tr>
                                                            <th>Zip Code</th>
                                                            <td>{{ $data->zipcode ?? '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>City</th>
                                                            <td>{{ $data->city ?? '' }}</td>
                                                        </tr>


                                                    <tr>
                                                        <th>State</th>
                                                        <td>{{ $data->state ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Property Value</th>
                                                        <td>{{ $data->property_value ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Income</th>
                                                        <td>{{ $data->income ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Current Amount</th>
                                                        <td>{{ $data->current_amount ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Current Rate</th>
                                                        <td>{{ $data->current_rate ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Credit Score</th>
                                                        <td>{{ $data->credit_score ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Credit Rating</th>
                                                        <td>{{ $data->credit_rating ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Age</th>
                                                        <td>{{ $data->age ?? '' }}</td>

                                                    </tr>
                                                    <tr>
                                                        <th>Notes</th>
                                                        <td>{{ $data->notes ?? '' }}</td>
                                                    </tr>





                                        </tbody>
                                    </table>
                                </div>
                                {{-- <form action="#">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>First Name</label>
                                            <input disabled type="text"  value="{{$data->first_name}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Last Name</label>
                                            <input disabled type="text"  value="{{$data->last_name}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Agent Name</label>
                                            <input disabled type="text"  value="{{$data->user->name}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Phone</label>
                                            <input disabled type="text"  value="{{$data->phone}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Client</label>
                                            <input disabled type="text"  value="{{@$data->client->name}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Email</label>
                                            <input disabled type="text"  value="{{$data->email}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Address</label>
                                            <input disabled type="text"  value="{{$data->address}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Zip</label>
                                            <input disabled type="text"  value="{{$data->zipcode}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>City</label>
                                            <input disabled type="text"  value="{{$data->city}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>State</label>
                                            <input disabled type="text"  value="{{$data->state}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Property Value</label>
                                            <input disabled type="text"  value="{{$data->property_value}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Incom</label>
                                            <input disabled type="text"  value="{{$data->income}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Notes</label>
                                            <input disabled type="text"  value="{{$data->notes}}" class="form-control">
                                        </div>

                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Current Amount</label>
                                            <input disabled type="text"  value="{{$data->current_amount}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Current Rate</label>
                                            <input disabled type="text"  value="{{$data->current_rate}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Credit Score</label>
                                            <input disabled type="text"  value="{{$data->credit_score}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Credit Rating</label>
                                            <input disabled type="text"  value="{{$data->credit_rating}}" class="form-control">
                                        </div>
                                        <div class="col-md-3 col-lg-3 form-group">
                                            <label>Age</label>
                                            <input disabled type="text"  value="{{$data->age}}" class="form-control">
                                        </div>
                                    </div>
                                </form> --}}


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
