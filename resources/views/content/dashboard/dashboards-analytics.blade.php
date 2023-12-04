@extends('layouts/contentNavbarLayout')

@section('title', 'Parking Area')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<h3>Parking Dashboard</h2>
<div class="row">
  <div class="col-lg-15 order-1">
    <div class="row">
      <div class="col-lg-3 col-md-8 mb-4">
        <div class="card">
          <div class="card-body">
            <span class="d-block mb-1">Today's Average</span>
            <h4 class="card-title mb-2">{{ $todayAverage }}</h3>
            <small class="text-success fw-semibold"></i>Vehicle</small>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-8 mb-4">
        <div class="card">
          <div class="card-body">
            <span class="d-block mb-1">Weekly Average</span>
            <h4 class="card-title mb-2">{{ $weeklyAverage }}</h3>
            <small class="text-success fw-semibold"></i>Vehicle</small>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-8 mb-4">
        <div class="card">
          <div class="card-body">
            <span class="d-block mb-1">Top Parking Day</span>
            <h4 class="card-title mb-2">{{ $topParkingDay->day }}</h3>
            <small class="text-success fw-semibold"></i>{{ $topParkingDay->average }} Vehicle</small>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-8 mb-4">
        <div class="card">
          <div class="card-body">
            <span class="d-block mb-1">Lowest Parking Day</span>
            <h4 class="card-title mb-2">{{ $lowestParkingDay->day }}</h3>
            <small class="text-success fw-semibold"></i>{{ $lowestParkingDay->average }} Vehicle</small>
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
          <div id="dailyChart" class="px-2"></div>
        </div>
        <div class="col-md-4">
          <div class="card-body">
            <div class="text-end">
            <h6 class="" id="currentDateTime"></h6>
            </div>
          </div>
          
          <div id="growthChart" data-chart-data="{{ $percentage }}"></div>
          <div class="text-center fw-medium pt-3 mb-2">{{ $spaceUsed }}/25 Space Used</div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Weekly Parking Usage -->
  <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">

      <div class="col-12 mb-4">
        <div class="card">
          <div class="card-body">
                <div class="card-title">
                  <h5 class="text-nowrap mb-2">Weekly Parking Usage</h5>
                </div>
              <div id="weeklyChart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    var weeklyParkingUsage = {!! $weeklyParkingUsage !!};
    var timeLabels = <?php echo json_encode($timeLabels); ?>;
    var vehicleCounts = <?php echo json_encode($vehicleCounts); ?>;
</script>
@endsection
