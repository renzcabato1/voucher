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
                    <h5>Daily Report Reimbursement</h5>
                                   
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
                            <div class="form-group"><label>Date From</label> <input value="{{$date}}" max="{{date('Y-m-d')}}" type="date" name="date" placeholder="" class="form-control " required>
                            </div>
                            
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Date To</label> <input value="{{$dateto}}" max="{{date('Y-m-d')}}" type="date" name="dateto" placeholder="" class="form-control " required>
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
    @if($data_info) <button class="btn btn-success "  onclick="printDiv('print')"  type="button"><i class="fa fa-print"></i>&nbsp;&nbsp;<span class="bold">Print</span></button>
        <br>
        <br>
     
    <div class="row" id='print' style='color:black;'>
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">

                <div class="table-responsive">
            <table style="border:1px solid black;" class="table table-hover text-center" >
            <thead>
                <tr>
                    <th style="border:1px solid black;" colspan = 8>@if($data_info){{$data_info->location}} | Date : {{date('M d, Y', strtotime($date))}} - {{date('M d, Y', strtotime($dateto))}}@endif </th>
                </tr>
            <tr>
                <th style="border:1px solid black;" rowspan = 2>Date </th>
                <th style="border:1px solid black;" rowspan = 2>System Code </th>
                <th style="border:1px solid black;" rowspan = 2>Supplier</th>
                <th style="border:1px solid black;" colspan = 2>Items</th>
                <th style="border:1px solid black;" rowspan = 2>UNIT PRICE</th>
                <th style="border:1px solid black;" rowspan = 2>AMOUNT</th>
                <th style="border:1px solid black;" rowspan = 2>BALANCE</th>
            </tr>
            <tr>
                <th style="border:1px solid black;">LOCC </th>
                <th style="border:1px solid black;">MW</th>
            </tr>
            </thead>
            @php
                $total_balance = 0;
                $locc = 0;
                $mw = 0;
                $amount_loc = 0;
                $amount_mw = 0;
            @endphp
                @foreach($data_all as $key => $data_a)
                <tr>
                    <td style="border:1px solid black;">
                        {{date('d-M-y',strtotime($data_a->date_encode))}}
                    </td>
                    <td style="border:1px solid black;"> 
                        {{date('Y-m',strtotime($data_a->date_encode))}}-{{str_pad($data_a->code, 5, '0', STR_PAD_LEFT)}}
                    </td>
                    <td style="border:1px solid black;">
                        {{$data_a->supplier}}
                    </td>
                    <td style="border:1px solid black;">
                        @if($data_a->material_type == "LOCC")
                            {{number_format($data_a->payment_weight,2)}}
                            @php
                                $locc = $locc + $data_a->payment_weight;
                                $amount_loc = $amount_loc + $data_a->total;
                            @endphp
                        @endif
                    </td>
                    <td style="border:1px solid black;">
                        @if($data_a->material_type == "MW")
                            {{number_format($data_a->payment_weight,2)}}
                            @php
                                $mw = $mw + $data_a->payment_weight;
                                $amount_mw = $amount_mw + $data_a->total;
                            @endphp
                        @endif
                    </td>
                    <td style="border:1px solid black;">
                        {{number_format($data_a->unit_price,2)}}
                    </td>
                    <td style="border:1px solid black;">
                        {{number_format($data_a->total,2)}}
                    </td>
                    <td style="border:1px solid black;">
                        @php
                            if($key == 0)
                            {
                                $total_balance = $data_a->total;
                            }
                            else 
                            {
                                $total_balance = $data_a->total+$total_balance;
                            }

                        @endphp
                        {{number_format($total_balance,2)}}
                    </td>
                </tr>
                @endforeach
                @if($data_info)
                <tr>
                    <td style='border:none;'>
                      
                    </td>
                    <td style='border:none;'>
                       
                    </td>
                    <td style='border:none;'>
                      
                    </td>
                    <td style="border:1px solid black;">
                       <b>{{number_format($locc,2)}}</b>
                    </td>
                    <td style="border:1px solid black;"> 
                        <b>{{number_format($mw,2)}}</b>
                    </td>
                    <td style='border:none;'>
                       
                    </td>
                    <td style='border:none;'>
                       
                    </td>
                    <td style="border:1px solid black;">
                        <b> {{number_format($total_balance,2)}} </b>
                    </td>
                </tr>
                <tr>
                    <td colspan=8 style="border:1px solid black;" >
                       <b>INCENTIVES</b>
                    </td>
                </tr>
                <tr>
                    <td style="border:1px solid black;">
                      
                    </td>
                    <td style="border:1px solid black;">
                       <b>{{$data_info->verified_by}}</b>
                    </td>
                    <td style="border:1px solid black;">
                      LAM
                    </td>
                    <td style="border:1px solid black;">
                       
                    </td>
                    <td style="border:1px solid black;">
                      
                    </td>
                    <td style="border:1px solid black;">
                       0.3
                    </td>
                    <td style="border:1px solid black;">
                       
                    </td>
                    <td style="border:1px solid black;">
                        {{number_format($total_balance,2)}}
                    </td>
                </tr>
                <tr>
                    <td style="border:1px solid black;">
                      
                    </td>
                    <td style="border:1px solid black;">
                       <b>{{$data_info->verified_by}}</b>
                    </td>
                    <td style="border:1px solid black;">
                      
                    </td>
                    <td style="border:1px solid black;" colspan="2">
                        <b>{{number_format($locc + $mw,2)}}</b>
                    </td>
                    <td style="border:1px solid black;">
                       0.15
                    </td>
                    <td style="border:1px solid black;">
                        @php
                            $incentive = ($locc + $mw)*.15 ;
                        @endphp
                        {{number_format($incentive,2)}}
                    </td>
                    <td style="border:1px solid black;">
                        <b>{{number_format($total_balance+$incentive,2)}}</b>
                    </td>
                </tr>
                @endif

            </table>
                @if($data_info)
                <table  class="table" style="width: 100%;text-align: center;"  >
                    <tr>
                        <td style="width: 40%;">

                            <table class="table" style="width: 100%;text-align: center;" > 
                                <tr>
                                    <td style="border:2px solid black;" colspan="4">
                                        <b>TOTAL SUMMARY</b>
                                    </td>
                                </tr>
                                <tr>

                                    <td style="border:2px solid black;">
                                        <b>ITEMS</b>
                                    </td>
                                    <td style="border:2px solid black;">
                                        <b>LOCC</b>
                                    </td>
                                    <td style="border:2px solid black;">
                                        <b>MW</b>
                                    </td>
                                    <td style="border:2px solid black;" >
                                        <b>TOTAL</b>
                                    </td>
                                </tr>
                                <tr>

                                    <td style="border:2px solid black;">
                                        <b>AMOUNT</b>
                                    </td>
                                    <td style="border:2px solid black;">
                                        <b>{{number_format($amount_loc,2)}}</b>
                                    </td>
                                    <td style="border:2px solid black;">
                                        <b>{{number_format($amount_mw,2)}}</b>
                                    </td>
                                    <td style="border:2px solid black;" >
                                        <b>{{number_format($total_balance,2)}}</b>
                                    </td>
                                </tr>
                                <tr>

                                    <td style="border:2px solid black;">
                                        <b>TONNAGE</b>
                                    </td>
                                    <td style="border:2px solid black;">
                                        <b>{{number_format($locc,2)}}</b>
                                    </td>
                                    <td style="border:2px solid black;">
                                        <b>{{number_format($mw,2)}}</b>
                                    </td>
                                    <td style="border:2px solid black;" >
                                        <b>{{number_format($locc + $mw,2)}}</b>
                                    </td>
                                </tr>
                            </table>

                        </td>
                        <td style="width: 60%;">
                                <br>
                                <br>
                                <br>
                            <table class="table" style="width: 100%;text-align: center;" > 
                                
                                <tr>

                                    <td style="border:1px solid black;">
                                        <br><br>
                                        {{strtoupper($data_info->encode_by)}}<br>
                                        <span style="text-decoration:overline">PREPARED BY</span>
                                    </td>
                                    <td style="border:1px solid black;">
                                        <br><br>
                                        {{strtoupper($data_info->check_by)}}<br>
                                        <span style="text-decoration:overline">CHECKED BY</span>
                                    </td>
                                    <td style="border:1px solid black;"><br><br>
                                        {{strtoupper($data_info->verified_by)}}<br>
                                        <span style="text-decoration:overline;">APPROVED BY</span>
                                   
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
                @endif

                </div>
            </div>
        </div>
    </div>
    @endif
    </div>
</div>
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
