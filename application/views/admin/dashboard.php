<!-- Navbar -->
<div id="navbar-wrapper">
  <div class="navbar-affix" data-spy="affix">
      <div class="container-fluid">
          <div class="row">
                <?= $this->load->view('admin/navbar', '', true) ?>
          </div>
      </div>
  </div>
</div>

<!-- Dashboard -->
<div id="dashboard">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2><?= $page_title ?></h2>
                <hr/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Population by Gender
                            </div>
                            <div class="panel-body">
                                <canvas id="gender-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Population by Status
                            </div>
                            <div class="panel-body">
                                <canvas id="status-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Line Chart
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Line Chart
                            </div>
                            <div class="panel-body">
                                <canvas id="line-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Markup -->
<div id="group">
    <div class="container-fluid">
        <div class="row">
        </div>
    </div>
</div>

<!-- Footer -->
<?= $this->load->view('_shared/footer', '', true) ?>

<!-- jQuery -->
<script type="text/javascript" src="<?= base_url('assets/script/jquery-2.1.4.min.js') ?>"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?= base_url('assets/pace/js/pace.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/tb/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/script/chart.bundle.min.js'); ?>"></script>

<script type="text/javascript">
    $(function () {

        // Active link
        var active_list = function() {
            var str = location.href.toLowerCase();
            $(".navbar-nav li a").each(function () {
                if (str.indexOf(this.href.toLowerCase()) > -1) {
                    $(".navbar-nav li.active").removeClass("active");
                    $(this).parent().addClass("active");
                }
            });
            $(".navbar-nav li.active").parents().each(function () {
                if ($(this).is("li")) {
                    $(this).addClass("active");
                }
            });
        }

        // GET: Population by gender
        var gender = function() {

          var ctx = $('#gender-chart');
          var url = location.origin + '/admin/gender';
          var data = ctx.serialize();

          $.ajax({
              url: url,
              method: 'GET',
              dataType: 'json',
              data: data,
              success: function(data) {
                var res = data;
                var chart_data = {
                    labels: res.labels,
                    datasets: [
                      {
                        backgroundColor: ['rgba(54, 162, 235, 0.25)', 'rgba(255, 99, 132, 0.25)'],
                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                        hoverBackgroundColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                        borderWidth: 1,
                        data: res.gender
                      }
                    ]
                }
                var myChart = new Chart(ctx, {
                    data: chart_data,
                    type: "polarArea",
                    options: {
                        elements: {
                            arc: {
                                borderColor: "#000000"
                            }
                        }
                    }
                });
              },
              error: function (jqXHR, textStatus, errorThrown) {
                  // For debugging
                  console.log('The following error occurred: ' + textStatus, errorThrown);
              }
          });
        }

        // GET: Population by status
        var status = function() {

          var ctx = $('#status-chart');
          var url = location.origin + '/admin/status';
          var data = ctx.serialize();

          $.ajax({
              url: url,
              method: 'GET',
              dataType: 'json',
              data: data,
              success: function(data) {
                var res = data;
                var chart_data = {
                    labels: [],
                    datasets: [
                      {
                        label: res.labels[0],
                        data: [res.status[0]],
                        backgroundColor: 'rgba(92, 184, 92, 0.25)',
                        borderColor: 'rgba(92, 184, 92, 1)',
                        borderWidth: 1,
                      },
                      {
                        label: res.labels[1],
                        data: [res.status[1]],
                        backgroundColor: 'rgba(240, 173, 78, 0.25)',
                        borderColor: 'rgba(240, 173, 78, 1)',
                        borderWidth: 1,
                      },
                      {
                        label: res.labels[2],
                        data: [res.status[2]],
                        backgroundColor: 'rgba(54, 162, 235, 0.25)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                      },
                      {
                        label: res.labels[3],
                        data: [res.status[3]],
                        backgroundColor: 'rgba(255, 99, 132, 0.25)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                      }
                    ]
                }
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: chart_data,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
              },
              error: function (jqXHR, textStatus, errorThrown) {
                  // For debugging
                  console.log('The following error occurred: ' + textStatus, errorThrown);
              }
          });
        }

        // GET: Line Chart
        var line = function() {

          var data = {
              labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
              datasets: [
                  {
                      label: "Month",
                      data: [5, 15, 10, 25, 35, 40, 25, 60, 60, 70, 75, 90],
                      fill: true,
                      lineTension: 0.25,
                      backgroundColor: "rgba(240, 173, 78, .25)",
                      borderColor: "rgba(240, 173, 78, 1)",
                      borderWidth: 2,
                      borderCapStyle: 'butt',
                      borderDash: [],
                      borderDashOffset: 0.0,
                      borderJoinStyle: 'miter',
                      pointStyle: "circle",
                      pointBorderColor: "rgba(240, 173, 78, 1)",
                      pointBackgroundColor: "rgba(240, 173, 78, 1)",
                      pointBorderWidth: 3,
                      pointHoverRadius: 5,
                      pointHoverBackgroundColor: "rgba(240, 173, 78, 1)",
                      pointHoverBorderColor: "#fff",
                      pointHoverBorderWidth: 3,
                      pointRadius: 2,
                      pointHitRadius: 10,
                      spanGaps: true
                  }
              ]
          };

          var ctx = $('#line-chart');
          var myLineChart = new Chart(ctx, {
              type: 'line',
              data: data,
              options: {
                  scales: {
                      yAxes: [{
                          stacked: true
                      }]
                  }
              }
          });
        }

        // Navbar Affix
        var navbar_affix = function() {
            $('.navbar-affix').affix({
                offset: {
                    top: 50
                }
            });
        }

        active_list();
        gender();
        status();
        //line();
        navbar_affix();
    });
</script>

</body>
</html>
