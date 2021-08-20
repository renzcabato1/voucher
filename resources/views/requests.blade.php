@extends('layouts.header')

@section('content')
@if(session()->has('status'))
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{session()->get('status')}}
    </div>
@endif
@include('error')
@include('new_request')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <button data-target="#new_request" data-toggle="modal" class="btn btn-primary " type="button"><i class="fa fa-plus"></i>&nbsp;New Voucher</button>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    
                <h5><b><i>({{date('F d, Y')}})</i></b> </h5>
            <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Supplier</th>
                <th>System Code </th>
                <th>SCF #</th>
                <th>Gross</th>
                <th>MC</th>
                <th>NET</th>
                <th>DEDUCTION</th>
                <th>UNIT PRICE</th>
                <th>AMOUNT</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody>
                @foreach($all_request_today as $request)

                <tr>
                    <td>{{$request->supplier}}</td>
                    <td>{{date('Y-m',strtotime($request->date_encode))}}-{{str_pad($request->code, 5, '0', STR_PAD_LEFT)}}</td>
                    <td>{{$request->scf}}</td>
                    <td>{{$request->gross}}</td>
                    <td>{{$request->mc}} %</td>
                    <td>{{$request->net}}</td>
                    <td>{{$request->deduction}}</td>
                    <td>{{$request->unit_price}}</td>
                    <td>{{$request->total}}</td>
                    <td> <a href="{{ url('/voucher-print/'.$request->id.'') }}" target='_'> <button class="btn btn-sm btn-warning" data-target="#edit_data{{$request->id}}" title='print' data-toggle="modal" ><i class="fa fa-print"></i></button></a></td>
                </tr>
                @endforeach
            
            </tfoot>
            </table>
                </div>

            </div>
        </div>
    </div>
    </div>
</div>

@endsection
