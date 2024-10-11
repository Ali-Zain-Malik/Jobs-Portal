@extends('admin.layouts.masterLayout')
@section("title")
    Admin - Dashboard
@endsection
@section('main')
    <main id="main" class="main">
        {{-- Start page title --}}
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("admin.dashboard")}}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </nav>
          </div>
          {{-- End page title --}}

          {{-- section starts --}}
          <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                  <div class="row">
                    
                    <!-- users Card -->
                    <div class="col-xxl-4 col-xl-12">
        
                      <div class="card info-card customers-card p-0">
        
                        <div class="card-body p-0 p-3">
                          <h5 class="card-title">Users</h5>
        
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="ps-3">
                              <h6>{{$total_users}}</h6>
                            </div>
                          </div>
        
                          <div class="row mt-3 py-1">
                            <div class="col-4 text-center border-end border-primary">
                              <div class="content d-flex flex-column align-items-center">
                                <p class="h6 fw-semibold">Employer</p>
                                <span class="employer-number">{{$employers}}</span>
                              </div>
                            </div>
                            <div class="col-4 text-center border-end border-primary">
                              <div class="content d-flex flex-column align-items-center">
                                <p class="h6 fw-semibold">Applicant</p>
                                <span class="employer-number">{{$applicants}}</span>
                              </div>
                            </div>
                            <div class="col-4 text-center">
                              <div class="content d-flex flex-column align-items-center">
                                <p class="h6 fw-semibold">Admin</p>
                                <span class="employer-number">{{$admins}}</span>
                              </div>
                            </div>
                          </div>
        
                        </div>
                      </div>
        
                    </div><!-- End users Card -->
        
        
        
                    <!-- start jobs posted number card -->
                    <div class="col-xxl-4 col-xl-12">
        
                      <div class="card info-card customers-card p-0">
        
                        <div class="card-body p-0 p-3">
                          <h5 class="card-title">Jobs Posted</h5>
        
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bx bxs-briefcase-alt-2"></i>
                            </div>
                            <div class="ps-3">
                              <h6>{{ $total_jobs }}</h6>
                            </div>
                          </div>
        
        
                          <div class="row mt-3 py-1">
                            <div class="col-4 text-center border-end border-primary">
                              <div class="content d-flex flex-column align-items-center">
                                <p class="h6 fw-semibold">Active</p>
                                <span class="active-jobs-number">{{$active_jobs}}</span>
                              </div>
                            </div>
                            <div class="col-4 text-center border-end border-primary">
                              <div class="content d-flex flex-column align-items-center">
                                <p class="h6 fw-semibold">Inactive</p>
                                <span class="active-jobs-number">{{$inactive_jobs}}</span>
                              </div>
                            </div>
                            <div class="col-4 text-center">
                              <div class="content d-flex flex-column align-items-center">
                                <p class="h6 fw-semibold">Expired</p>
                                <span class="active-jobs-number">{{$expired_jobs}}</span>
                              </div>
                            </div>
                          </div>
        
        
                        </div>
                      </div>
        
                    </div>
                    <!-- End jobs posted card -->
        
        
                    <!-- Start Feedbacks card -->
                    <div class="col-xxl-4 col-xl-12">
        
                      <div class="card info-card customers-card p-0">
        
                        <div class="card-body p-0 p-3">
                          <h5 class="card-title">Feedbacks</h5>
        
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bx bxs-comment-dots"></i>
                            </div>
                            <div class="ps-3">
                              <h6>{{$feedbacks}}</h6>
                            </div>
                          </div>
        
                        </div>
                      </div>
        
                    </div>
                    
                    <!-- End feedback card -->
        
                  </div>
                </div><!-- End Left side columns -->
        
                <!-- Right side columns -->
                <div class="col-lg-4">
        
                 
                  <!-- Classification Column -->
                  <div class="card">
                    <div class="card-body pt-3 pb-0">
                      <h5 class="card-title">Classification</h5>
        
                      <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          echarts.init(document.querySelector("#trafficChart")).setOption({
                            tooltip: {
                              trigger: 'item'
                            },
                            legend: {
                              top: '5%',
                              left: 'center'
                            },
                            series: [{
                              name: 'Access From',
                              type: 'pie',
                              radius: ['40%', '70%'],
                              avoidLabelOverlap: false,
                              label: {
                                show: false,
                                position: 'center'
                              },
                              emphasis: {
                                label: {
                                  show: true,
                                  fontSize: '18',
                                  fontWeight: 'bold'
                                }
                              },
                              labelLine: {
                                show: false
                              },
                              data: [{
                                  value: {{ $employers }},
                                  name: 'Employers'
                                },
                                {
                                  value: {{ $applicants }},
                                  name: 'Applicants'
                                },
                                {
                                    value: {{ $admins }},
                                    name: "Admins"
                                }
                              ]
                            }]
                          });
                        });
                      </script>
        
                    </div>
                  </div>
        
                </div>
        
                <div class="col-12">
        
                  <div class="col-12">
                    @include("admin.includes.feedbacks")
                  </div>
        
        
                  

                  <div class="col-12">
                      <div class="card">
                        <div class="card-body pt-4">
                          <h5 class="card-title">Graph</h5>
        
                          <div id="linegraph"></div>
        
        
                        
        
                          <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                let user_count  =   [];
                                @foreach($byDateUsers as $user_count)
                                    user_count.push({{ $user_count->user_count }})
                                @endforeach

                                let job_count   =   [];
                                @foreach($byDateJobs as $job_count)
                                    job_count.push({{ $job_count->job_count }})
                                @endforeach
                                function getCurrentWeekDates() 
                                {
                                    const currentDate = new Date();
                                    const firstDayOfWeek = new Date(currentDate.setDate(currentDate.getDate() - currentDate.getDay()));
                                    
                                    const weekDates = [];
                                    
                                    for (let i = 0; i < 7; i++) {
                                        let day = new Date(firstDayOfWeek);
                                        day.setDate(firstDayOfWeek.getDate() + i);
                                        weekDates.push(day.toISOString().slice(0, 10)); // Format: YYYY-MM-DD
                                    }
                                    
                                    return weekDates;
                                }

                              new ApexCharts(document.querySelector("#linegraph"), {
                                series: [{
                                  name: 'Users',
                                  data: user_count,      
                                }, {
                                  name: 'Jobs',
                                  data: job_count
                                }, 
                                ],
                                chart: {
                                  height: 350,
                                  type: 'area',
                                  toolbar: {
                                    show: false
                                  },
                                },
                                markers: {
                                  size: 4
                                },
                                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                fill: {
                                  type: "gradient",
                                  gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.3,
                                    opacityTo: 0.4,
                                    stops: [0, 90, 100]
                                  }
                                },
                                dataLabels: {
                                  enabled: false
                                },
                                stroke: {
                                  curve: 'smooth',
                                  width: 2
                                },
                                xaxis: {
                                  type: 'date',
                                  categories: getCurrentWeekDates(),
                                },
                                tooltip: {
                                  x: {
                                    format: 'Y-m-d'
                                  },
                                }
                              }).render();
                            });
                          </script>
        
                        </div>
        
                      </div>
                    </div>
        
                </div>
        
              </div>
          </section>
          {{-- section ends --}}
    </main>
@endsection