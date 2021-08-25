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
                    <h5>Voucher</h5>
                                   
                <h5><b><i>({{date('F d, Y')}})</i></b> </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                     
                        
                    </div>
                </div>
               
                <div class="ibox-content">
                  <form method='Post' action='new-request' onsubmit='show();'  enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group"><label>Supplier Name</label> <input  type="text" name="supplier_name" placeholder="" class="form-control upperText" required></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Driver's Name</label> <input type="text" name="driver_name" placeholder="" class="form-control upperText" required></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Plate No.</label> <input type="text" name="plate_number" placeholder="" class="form-control upperText" required></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Truck Type</label> <input type="text" name="truck_type" placeholder="" class="form-control upperText" required></div>
                        </div> 
                        <div class="col-sm-2">
                            <div class="form-group"><label>Material Type</label> 
                                <select class="form-control" name="item" placeholder="Item" required>
                                    <option value=""></option>
                                    <option value="LOCC">LOCC</option>
                                    <option value="MW">MW</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label>Gross Weight</label> 
                                <div class="input-group m-b">
                                    <input type="number" name="gross" placeholder="" class="form-control" required><span class="input-group-addon">KG</span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label>TARE WEIGHT</label>
                                <div class="input-group m-b">
                                    <input type="number" name="tare" placeholder="" class="form-control" required><span class="input-group-addon">KG</span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group"> <label>MC</label> 
                                <div class="input-group m-b">
                                   <input type="number" min="0"  step="0.01"  name="mc" placeholder="" class="form-control" required><span class="input-group-addon">%</span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group"> <label>OT</label> 
                                <div class="input-group m-b">
                                   <input type="number" min="0"  step="0.01"  name="ot" value="0.00" placeholder="" class="form-control" required><span class="input-group-addon">%</span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group"> <label>PM</label> 
                                <div class="input-group m-b">
                                   <input type="number" min="0"  step="0.01"  name="pm" value="0.00" placeholder="" class="form-control" required><span class="input-group-addon">%</span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"> <label>Unit Price</label> 
                                <div class="input-group m-b">
                                    <span class="input-group-addon"> &#8369;</span> <input type="number" min="0"  step="0.01"  name="unit_price"  placeholder="" class="form-control" required>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-3">
                            <div class="form-group"><label>Prepared By</label> <input type="text"  placeholder="" class="form-control upperText" value="{{auth()->user()->name}}" readonly></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Checked By</label>  
                                <input type="text" class="form-control upperText" name='checked_by' @if($last_request != null) value="{{$last_request->check_by}}" @endif placeholder="Checked By" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Approved By</label>  
                                <input type="text" class="form-control upperText" name='approved_by' @if($last_request != null) value="{{$last_request->verified_by}}" @endif placeholder="Approved By" required>
                            </div>
                        </div>
                    </div>
                        <div class="col-sm-12">
                            <button type='submit'  class="btn btn-primary pull-right" >Submit</button>
                            <br>
                            <br>
                        </div>
                        
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
           
            <div class="ibox-content">

                <div class="table-responsive">
     
            <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                
                <th>System Code </th>
                <th>Supplier</th>
                <th>Type</th>
                <th>Gross Weight</th>
                <th>Tare Weight</th>
                <th>MC</th>
                <th>NET</th>
                <th>DEDUCTION</th>
                <th>UNIT PRICE</th>
                <th>PAYMENT WEIGHT</th>
                <th>AMOUNT</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody>
                @foreach($all_request_today as $request)

                <tr>
                    <td>{{date('Y-m',strtotime($request->date_encode))}}-{{str_pad($request->code, 5, '0', STR_PAD_LEFT)}}</td>
                 
                    <td>{{$request->supplier}}</td>
                    <td>{{$request->material_type}}</td>
                    <td>{{$request->gross}}</td>
                    <td>{{$request->tare}}</td>
                    <td>{{$request->mc}} %</td>
                    <td>{{$request->net}}</td>
                    <td>{{$request->deduction}}</td>
                    <td>{{$request->unit_price}}</td>
                    <td>{{$request->payment_weight}}</td>
                    <td>{{$request->total}}</td>
                    <td> 
                        <a href="{{ url('/voucher-print/'.$request->id.'') }}" target='_blank'> <button class="btn btn-sm btn-warning" data-target="#edit_data{{$request->id}}" title='print' data-toggle="modal" ><i class="fa fa-print"></i></button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
               
            </table>
                </div>

            </div>
        </div>
    </div>
    </div>
</div>

@endsection
