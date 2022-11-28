

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.headers.cards', [ 'title' => 'Dashboard' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php
$total_dss = \DB::table('sale_dsses')->count();
$total_home_warranty = \DB::table('home_warranties')->count();
$total_mortgage = \DB::table('sale_mortgages')->count();
$total_solar = \DB::table('sale_records')->count();
?>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="card bg-gradient-info">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total DSS Submissions</h5>
                  <span class="h2 font-weight-bold mb-0 text-white"><?php echo e(@$total_dss); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-primary rounded-circle shadow">
                    <i class="fa fa-life-ring"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-gradient-dark">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Home Warranty Submissions</h5>
                  <span class="h2 font-weight-bold mb-0 text-white"><?php echo e(@$total_home_warranty); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                    <i class="fa fa-life-ring"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-gradient-success">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Mortgage Submissions</h5>
                  <span class="h2 font-weight-bold mb-0 text-white"><?php echo e(@$total_mortgage); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-success rounded-circle shadow">
                    <i class="fa fa-users"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-gradient-danger">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Solar Submissions</h5>
                  <span class="h2 font-weight-bold mb-0 text-white"><?php echo e(@$total_solar); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-danger rounded-circle shadow">
                    <i class="fa fa-users"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6">  
          <div id="drilldown" style="height: 30vh"  ></div>
        </div>
        <div class="col-xl-6">                
            <div id="piechart" style="height: 30vh"></div> 
        </div><br>
        <div class="col-xl-12">                
          <div id="columnchart" style="height: 40vh"></div> 
        </div>
      </div> 
      <div class="row"  style="position: relative; min-height: 500px;">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0"><?php echo e(__('labels.latest_tickets')); ?></h3>
                </div>
                <div class="col text-right">
                  <a href="<?php echo route('tickets.index') ?>?sort=latest" class="btn btn-sm btn-primary"><?php echo e(__('labels.see_all')); ?></a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col" class="sort">#</th>
                      <th scope="col" class="sort"><?php echo e(__('labels.title')); ?></th>
                      <th scope="col" class="sort"><?php echo e(__('labels.customer')); ?></th>
                      <th scope="col"><?php echo e(__('labels.priority')); ?></th>
                      <th scope="col"><?php echo e(__('labels.status')); ?></th>
                      <th scope="col"><?php echo e(__('labels.created_at')); ?></th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody class="list">
                    <?php $__empty_1 = true; $__currentLoopData = $latest_tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                      <td class="budget">
                        <?php echo $ticket->id ?>
                      </td>
                      <td class="budget">
                        <?php echo $ticket->title ?>
                      </td>
                      <th scope="row">
                        <div class="media align-items-center">
                          <a href="#!" class="avatar rounded-circle mr-3">
                            <img alt="Image placeholder" src="<?php echo e(asset('uploads/customer/'.@$ticket->customer->image)); ?>">
                          </a>
                          <div class="media-body">
                            <span class="name mb-0 text-sm"><?php echo e(@$ticket->customer->name); ?></span>
                          </div>
                        </div>
                      </th>
                      <td>
                        <?php echo priority_label($ticket->priority); ?>

                      </td>
                      <td>
                        <?php echo status_label($ticket->status); ?>

                      </td>
                      <td title="<?php echo e(@$ticket->created_at->format(setting('datetime_format'))); ?>">
                        <?php echo e($ticket->created_at->diffForHumans()); ?>

                      </td>
                      <td class="text-right">
                        <a href="<?php echo e(route('tickets.show', $ticket->id)); ?>" class="btn btn-sm btn-primary"><?php echo e(__('labels.view')); ?></a>
                      </td>
                    </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6">
                                <?php echo e(__('labels.no_data_found')); ?>

                            </td>
                        </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?> 
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
  
  Highcharts.chart('piechart', {
      colors: ['#01BAF2', '#f6fa4b', '#FAA74B', '#baf201', '#f201ba'],
      chart: {
          type: 'pie'
      },
      title: {
          text: 'Sales Of Every Campaign'
      },
      tooltip: {
          valueSuffix: '%'
      },
      // subtitle: {
      //     text:        ''
      // },
      plotOptions: {
          pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                  enabled: true,
                  format: '{point.name}: {point.percentage:.1f}%'
              },
              showInLegend: true
          }
      },
      series: [
          {
              name: 'Percentage',
              colorByPoint: true,
              data: [
                <?php $__currentLoopData = $pieChart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$chart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  {
                      name: '<?php echo e($key); ?>',
                      y: <?php echo e($chart); ?>

                  },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              ]
          }
      ]
  });

  Highcharts.chart('columnchart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Emissions to air in Norway'
    }, 
    xAxis: {
        categories: [
            '2010',
            '2011',
            '2012',
            '2013',
            '2014'
             
        ],
        crosshair: true
    },
    yAxis: {
        title: {
            useHTML: true,
            text: 'Million tonnes CO<sub>2</sub>-equivalents'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Oil and gas extraction',
        data: [13.93, 13.63, 13.73, 13.67, 14.37 ]

    }, {
        name: 'Manufacturing industries and mining',
        data: [12.24, 12.24, 11.95, 12.02, 11.65 ]

    }, {
        name: 'Road traffic',
        data: [10.00, 9.93, 9.97, 10.01, 10.23 ]

    }, {
        name: 'Agriculture',
        data: [4.35, 4.32, 4.34, 4.39, 4.46  ]

    }]
  });
  Highcharts.chart('drilldown', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Last 7 Days Submissions'
        },
        subtitle: {
            text: 'Source: ' +
                ''
        },
        xAxis: {
            categories: [
                <?php foreach($lastSevenDaysData as $row){?> 
                    "<?php echo e($row['date']); ?>",  
                <?php } ?> 
            ]
        },
        yAxis: {
            title: {
                text: 'Goal and Ach '
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
        series: [
            {
                name: 'Mortgage',
                data: [
                  <?php foreach($lastSevenDaysData as $row){?> 
                    <?php echo e($row['mortgage_count']); ?>,  
                <?php } ?>
                ]
            },{
                name: 'Solar',
                data: [
                  <?php foreach($lastSevenDaysData as $row){?> 
                    <?php echo e($row['solar_count']); ?>,  
                <?php } ?>
                ]
            }
            ,{
                name: 'DSS',
                data: [
                  <?php foreach($lastSevenDaysData as $row){?> 
                    <?php echo e($row['warranty_count']); ?>,  
                <?php } ?>
                ]
            } ,{
                name: 'HomeWarranty',
                data: [
                  <?php foreach($lastSevenDaysData as $row){?> 
                    <?php echo e($row['dss_count']); ?>,  
                <?php } ?>
                ]
            }  
            
        ]
  });


</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'dashboard' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crm\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>