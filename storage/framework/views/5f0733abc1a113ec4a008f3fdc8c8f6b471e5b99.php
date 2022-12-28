
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.headers.cards', [ 'title' => 'Dashboard' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Page content -->
    <div class="container-fluid mt--6">
       
        <form action="" method="GET" id="webform" style="padding:15px"
          enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="row"> 
              <div class="form-group col-md-4">
                  <label class="form-control-label">From Date</label>
                  <input type="date" value="<?php echo e(@$_GET['f_date']); ?>" name="f_date" class="form-control">
              </div>
              <div class="form-group col-md-4">
                  <label class="form-control-label">To Date</label>
                  <input type="date" value="<?php echo e(@$_GET['t_date']); ?>" name="t_date" class="form-control">
              </div> 
              <div class="form-group col-md-4">
                <label class="form-control-label">&nbsp;</label>
                <button type="submit" class="form-control btn btn-info">Search</button>
              </div> 
          </div>                
        </form>
       
      <div class="row">
        
        <div class="col-xl-4 col-md-6">
          <div class="card bg-gradient-info">
            <!-- Card body -->            
            <div class="card-body">
              <div class="row">
                <div class="col-md-10">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total In-Bounds</h5>
                  <span class="h2 font-weight-bold mb-0 text-white"><?php echo e(@$totals[0]->Inbound); ?></span>

                </div>
                <div class="col-md-2">
                  <div class="icon icon-shape bg-white text-primary rounded-circle shadow">
                    <i class="fa fa-life-ring"></i>
                  </div>
                </div>                
              </div>
                <hr style="border:1px solid white">
                <div class="row" style="color: black">    
                    <div class="col-md-6">
                        <p>Billable-Hours <span class="text text-left"><?php echo e(@$totals[0]->InBillableHours); ?></span></p> 
                    </div> 
                    <div class="col-md-6">
                        <p>Connect  <span class="text text-left"><?php echo e(round(@$totals[0]->InConnectPercentage,2)); ?> %</span></p> 
                    </div> 
                    <div class="col-md-6">
                        <p>Edu Tranfer rate  <span class="text text-left"><?php echo e(@$totals[0]->InEduTransferRate); ?></span></p> 
                    </div>  
                    
                    <div class="col-md-6">
                        <p>EDU Conv Total calls <span class="text text-left"><?php echo e(round(@$totals[0]->InEduConvTotalCalls,2)); ?>%</span></p> 
                    </div> 
                    <div class="col-md-6">
                        <p>Edu Transfer  <span class="text text-left"><?php echo e(@$totals[0]->InEduTransfers); ?></span></p> 
                    </div>  
                    <div class="col-md-6">
                        <p>Edu Conversions  <span class="text text-left"><?php echo e(@$totals[0]->InEduConversions); ?></span></p> 
                    </div>  
                    
                </div>
            </div>
            
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card bg-gradient-dark">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Out-Bounds</h5>
                  <span class="h2 font-weight-bold mb-0 text-white"><?php echo e(@$totals[0]->Outbound); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                    <i class="fa fa-life-ring"></i>
                  </div>
                </div>
              </div>

              <hr style="border:1px solid white">
              <div class="row" style="color: white">    
                <div class="col-md-6">
                    <p>Billable-Hours <span class="text text-left"><?php echo e(@$totals[0]->OutBillableHours); ?></span></p> 
                </div> 
                <div class="col-md-6">
                    <p>Connect  <span class="text text-left"><?php echo e(round(@$totals[0]->OutConnectPercentage,2)); ?> %</span></p> 
                </div> 
                <div class="col-md-6">
                    <p>Edu Tranfer rate  <span class="text text-left"><?php echo e(@$totals[0]->OutEduTransferRate); ?></span></p> 
                </div>  
                
                <div class="col-md-6">
                    <p>EDU Conv Total calls <span class="text text-left"><?php echo e(round( @$totals[0]->OutEduConvTotalCalls,2)); ?>%</span></p> 
                </div> 
                <div class="col-md-6">
                    <p>Edu Transfer  <span class="text text-left"><?php echo e(@$totals[0]->OutEduTransfers); ?></span></p> 
                </div>  
                <div class="col-md-6">
                    <p>Edu Conversions  <span class="text text-left"><?php echo e(@$totals[0]->OutEduConversions); ?></span></p> 
                </div>  
                
            </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card bg-gradient-success">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total EddyEdu</h5>
                  <span class="h2 font-weight-bold mb-0 text-white"><?php echo e(@$totals[0]->EddyEdu); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-success rounded-circle shadow">
                    <i class="fa fa-life-ring"></i>
                  </div>
                </div>
              </div>
              <hr style="border:1px solid white">
              <div class="row" style="color: white">    
                <div class="col-md-6">
                    <p>Billable-Hours <span class="text text-left"><?php echo e(@$totals[0]->EddyBillableHours); ?></span></p> 
                </div> 
                <div class="col-md-6">
                    <p>Fomrs  <span class="text text-left"><?php echo e(@$totals[0]->forms); ?></span></p> 
                </div> 
                <div class="col-md-6">
                    <p>LTs  <span class="text text-left"><?php echo e(@$totals[0]->lts); ?></span></p> 
                </div>  
                
                <div class="col-md-6">
                    <p>Conversions <span class="text text-left"><?php echo e(round(@$totals[0]->conv_percentage,2)); ?> %</span></p> 
                </div> 
                <div class="col-md-6">
                    <p>LT   <span class="text text-left"><?php echo e(round(@$totals[0]->lt_percentage,2)); ?> %</span></p> 
                </div>  
                <div class="col-md-6">
                    <p>WLPH  <span class="text text-left"><?php echo e(@$totals[0]->wlph); ?></span></p> 
                </div>  
                
             </div>
            </div>
          </div>
        </div>
      </div>
       
        <div class="row">
          <div class="col-md-6"> 
            <div id="lineChart" style="height: 30vh"></div>
          </div>
          <div class="col-md-6"> 
            <div id="pieChart" style="height: 30vh"></div>
          </div>
        </div>
      <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
 <script>
  // Data retrieved from https://netmarketshare.com
  Highcharts.chart('pieChart', {
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
      },
      title: {
          text: 'Eddy Sale Percentage',
          align: 'left'
      },
      tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      accessibility: {
          point: {
              valueSuffix: '%'
          }
      },
      plotOptions: {
          pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                  enabled: true,
                  format: '<b>{point.name}</b>: {point.percentage:.1f} %'
              }
          }
      },
      series: [{
          name: 'Projects',
          colorByPoint: true,
          data: [{
              name: 'EddyEdu',
              y: <?php echo e(@$totals[0]->EddyEdu); ?>

          }, {
              name: 'InBound',
              y: <?php echo e(@$totals[0]->Inbound); ?>

          },  {
              name: 'OutBound',
              y: <?php echo e(@$totals[0]->Outbound); ?>

          } ]
      }]
  });

  Highcharts.chart('lineChart', {
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
        series: [{
          name: 'Inbound',
          data: [
             <?php foreach($lastSevenDaysData as $row){?> 
              <?php echo e($row['inbound']); ?>,  
            <?php } ?>
          ]
        }, {
          name: 'OutBound',
          data: [
            <?php foreach($lastSevenDaysData as $row){?> 
              <?php echo e($row['outbound']); ?>,  
            <?php } ?>
          ]
        }, {
            name: 'EddyEdu',
            data: [<?php foreach($lastSevenDaysData as $row){?> 
              <?php echo e($row['eddy']); ?>,  
            <?php } ?> ]
        }  ]
  });

 </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', [ 'current_page' => 'dashboard' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/eddydashboard.blade.php ENDPATH**/ ?>