@extends('layouts.header')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
   
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Monthly Amounts Paid</h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <canvas id="monthly_report" height="140"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Monthly Weight Paid</h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <canvas id="daily_request" height="140"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
   
</div>
@endsection
