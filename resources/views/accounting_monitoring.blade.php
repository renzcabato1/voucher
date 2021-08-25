@extends('layouts.header')

@section('content')

@if(session()->has('status'))
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{session()->get('status')}}
    </div>
@endif
@include('error')

{{-- @include('new_request') --}}
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{$subheader}}</h5>
                                   
                {{-- <h5><b><i>({{date('F d, Y')}})</i></b> </h5> --}}
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                     
                        
                    </div>
                </div>
               
                <div class="ibox-content">
                  <form method='GET' onsubmit='show();'  enctype="multipart/form-data" >
                    {{-- {{ csrf_field() }} --}}
                    <div class="row"> 
                    
                        <div class="col-sm-3">
                            <div class="form-group"><label>Date From</label> <input value="{{$date_from}}" max="{{date('Y-m-d')}}" type="date" name="date_from" placeholder="" class="form-control " required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Date To</label> <input value="{{$date_to}}" max="{{date('Y-m-d')}}" type="date" name="date_to" placeholder="" class="form-control " required>
                            </div>
                            
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">      <label>&nbsp;</label>
                            <br>
                            <button type='submit'  class="btn btn-primary pull-right" >Generate</button>
                            </div>
                        </div>
                       
                    </div>
                     
                        
                </div>
            </div>
        </div>
    </div>
    @if($date_from) <button class="btn btn-success "  onclick="printDiv('renz')"  type="button"><i class="fa fa-print"></i>&nbsp;&nbsp;<span class="bold">Print</span></button>
    <br>
    <br>
    <div class="row" id='renz' style='color:black;'>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    <div class="table-responsive">
                <table  style="border:1px solid black;font-size:8px;" width="100%" class=" text-center" >
                    <thead>
                        <tr>
                            <th style="border:1px solid black;" colspan = 30>Date : {{date('F d, Y',strtotime($date_from))}} - {{date('F d, Y',strtotime($date_to))}} </th>
                        </tr>
                        <tr>
                            <th style="border:1px solid black;" >DATE </th>
                            <th style="border:1px solid black;" >SYSTEM CODE</th>
                            <th style="border:1px solid black;" >PAID TO</th>
                            <th style="border:1px solid black;" >SUPPLIER</th>
                            <th style="border:1px solid black;" >DRIVER NAME</th>
                            <th style="border:1px solid black;" >PLATE NUMBER</th>
                            <th style="border:1px solid black;" >MATERIAL TYPE</th>
                            <th style="border:1px solid black;" >TRUCK TYPE</th>
                            <th style="border:1px solid black;" >LOCATION</th>
                            <th style="border:1px solid black;" >GROSS</th>
                            <th style="border:1px solid black;" >TARE</th>
                            <th style="border:1px solid black;" >NET</th>
                            <th style="border:1px solid black;" >MC</th>
                            <th style="border:1px solid black;" >OT</th>
                            <th style="border:1px solid black;" >DEDUCTION</th>
                            <th style="border:1px solid black;" >PAYMENT WEIGTH</th>
                            <th style="border:1px solid black;" >UNIT PRICE</th>
                            <th style="border:1px solid black;" >TOTAL</th>
                        </tr>
                
                    </thead>
                <tbody>
                  @foreach($data_all as $data)
                  <tr>
                    <td style="border:1px solid black;" >{{date('M-d-y',strtotime($data->date_encode))}} </td>
                    <td style="border:1px solid black;" > {{date('Y-m',strtotime($data->date_encode))}}-{{str_pad($data->code, 5, '0', STR_PAD_LEFT)}}</td>
                    <td style="border:1px solid black;" >{{$data->supplier}}</td>
                    <td style="border:1px solid black;" >{{$data->verified_by}}</td>
                    <td style="border:1px solid black;" >{{$data->driver_name}}</td>
                    <td style="border:1px solid black;" >{{$data->plate_number}}</td>
                    <td style="border:1px solid black;" >{{$data->material_type}}</td>
                    
                    <td style="border:1px solid black;" >{{$data->truck_type}}</td>
                    <td style="border:1px solid black;" >{{$data->location}}</td>
                    <td style="border:1px solid black;" >{{$data->gross}}</td>
                    <td style="border:1px solid black;" >{{$data->tare}}</td>
                    <td style="border:1px solid black;" >{{$data->net}}</td>
                    <td style="border:1px solid black;" >{{$data->mc}}</td>
                    <td style="border:1px solid black;" >{{$data->ot}}</td>
                    <td style="border:1px solid black;" >{{$data->deduction}}</td>
                    <td style="border:1px solid black;" >{{$data->payment_weight}}</td>
                    <td style="border:1px solid black;" >{{$data->unit_price}}</td>
                    <td style="border:1px solid black;" >{{$data->total}}</td>
                    </tr>
                  @endforeach
                </tbody>
            
                </table>

                
            </div>
        </div>
    </div>
    @endif
<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
    }
</script>
@endsection
