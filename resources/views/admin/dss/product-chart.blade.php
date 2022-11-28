@extends('admin.layouts.app', [ 'current_page' => 'DSS ' ])

@section('content')
<style>
    #container {
        height: 400px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }


</style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
@push('header-buttons')
        <div class="col-lg-6 col-5 text-right">
          <a href="{{ route('dss.index') }}" class="btn btn-sm btn-icon btn-neutral">
            <i data-feather="arrow-left" stroke-width="3" width="12"></i> Go Back</a>
        </div>
    @endpush
    @include('admin.layouts.headers.cards', ['title' => "DSS"])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="mb-0">DSS Graphs</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-header">{{ __('Graphical Representation of Sales Data / Campaign Wise') }}</div>
                            <form action="#" method="GET">
                                <div class="row" style="padding:10px;">
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <a href="?Today=Today" style="text-decoration:none;text-align:center" class="form-control ">Today</a>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                       <div class="form-group">
                                            <a href="?LastWeek=LastWeek" style="text-decoration:none;text-align:center" class="form-control  ">Last Week</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                       <div class="form-group">
                                            <a href="?LastMonth=LastMonth" style="text-decoration:none;text-align:center" class="form-control  ">Last Month</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                <figure class="highcharts-figure  col-md-12">
                    <div id="container"></div>
                    <p class="highcharts-description" style="text-align:center" >
                        Discount School Supply.
                    </p>

                </figure>
                  <figure class="highcharts-figure col-md-12">
                    <div id="container2"></div>
                    <p class="highcharts-description" style="text-align:center" >
                        Discount School Supply.
                    </p>
                </figure>
        </div>

        @include('admin.layouts.footers.auth')



    </div>
@endsection


        @push('js')
        <script>
            Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'From which vendor do yo usually buy or supplies from?'
            },

            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Discount School Supply'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Leads Count'
            },
            series: [{
                name: 'Population',
                data: [
                  [ 'Amazon', {{ $amazon_count }}],
                  [ 'becker',{{ $becker_count }}],
                  [ 'lackshore',{{ $lackshore_count }}],
                  [ 'kaplan',{{ $kaplan_count }}],
                  [ 'Discount School Supply',{{ $discount_school_supply_count }}],
                  [ 'School Speciality',{{ $school_speciality_count }}],
                  [ 'Oriental Trading',{{ $oriental_trading_count }}],
                  [ 'Use multiple vender',{{ $use_multiple_vendor_count }}],
                  [ 'Others',{{ $others_question_1_count }}]
                ],



                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });

           Highcharts.chart('container2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'What was the reason for you to purchase your supplies from other supplies?'
            },

            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Discount School Supply'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Leads Count'
            },
            series: [{
                name: 'Population',
                data: [
                  [ 'Pricing', {{ $pricing_count}}],
                  [ 'Lack of products',{{ $lack_of_products_count}}],
                  [ 'Fast Shipping',{{ $fast_shipping_count }}],
                  [ 'Free Shipping',{{ $free_shipping_count}}],
                  [ 'Quality',{{ $quality_count  }}],
                  [ 'Customer Service',{{ $customer_service_count }}],
                  [ 'Happy with Dss',{{ $happy_with_dss_count }}],
                  [ 'Others',{{ $others_question_2_count }}]

                ],




                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });



            </script>

        @endpush
