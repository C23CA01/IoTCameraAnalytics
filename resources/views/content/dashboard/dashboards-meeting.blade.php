@extends('layouts/contentNavbarLayout')

@section('title', 'Parking Area')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-meeting.js')}}"></script>
@endsection

@section('content')
<h3>Meeting Dashboard</h2>
<div class="row">
  <div class="col-lg-15 order-1">
    <div class="row">
      <div class="col-lg-3 col-md-8 mb-4">
        <div class="card">
          <div class="card-body">
            <!-- <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/top.png')}}" alt="chart success" class="rounded">
              </div>
            </div> -->
            <span class="d-block mb-1">Today's Average</span>
            <h4 class="card-title mb-2">12</h3>
            <small class="text-success fw-semibold"></i>People</small>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-8 mb-4">
        <div class="card">
          <div class="card-body">
            <!-- <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/top.png')}}" alt="chart success" class="rounded">
              </div>
            </div> -->
            <span class="d-block mb-1">Weekly Average</span>
            <h4 class="card-title mb-2">15</h3>
            <small class="text-success fw-semibold"></i>People</small>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-8 mb-4">
        <div class="card">
          <div class="card-body">
            <!-- <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/top.png')}}" alt="chart success" class="rounded">
              </div>
            </div> -->
            <span class="d-block mb-1">Top Meeting Day</span>
            <h4 class="card-title mb-2">Wednesday</h3>
            <small class="text-success fw-semibold"></i>15 People</small>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-8 mb-4">
        <div class="card">
          <div class="card-body">
            <!-- <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/top.png')}}" alt="chart success" class="rounded">
              </div>
            </div> -->
            <span class="d-block mb-1">Lowest Meeting Day</span>
            <h4 class="card-title mb-2">Friday</h3>
            <small class="text-success fw-semibold"></i>9 People</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Today's Parking Usage -->
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-8">
          <h5 class="card-header m-0 me-2 pb-3">Today's Parking Usage</h5>
            <div class="dropdown text-end">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Real Time  
                <i class="bx bx-chevron-down"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item" href="javascript:void(0);">Today</a>
                </div>
              </div>
          <div id="DailyChart" class="px-2"></div>
        </div>
        <div class="col-md-4">
          <div class="card-body">
            <div class="text-end">
            <h6 class="" id="currentDateTime"></h6>
            </div>
          </div>
          
          <div id="growthChart"></div>
          <div class="text-center fw-medium pt-3 mb-2">11/15 Space Used</div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Total Revenue -->
  <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
     
      <!-- </div>
    <div class="row"> -->
      <div class="col-12 mb-4">
        <div class="card">
          <div class="card-body">
                <div class="card-title">
                  <h5 class="text-nowrap mb-2">Weekly Parking Usage</h5>
                </div>
              <div id="WeeklyChart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
