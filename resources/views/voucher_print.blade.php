
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="{{ asset('/images/icon.png')}}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
         
        /* * { padding: 0; margin: 0; } */
       
        table { 
            border-spacing: 0;
            border-collapse: collapse;
            font-family: Candara;
            font-size: 15px;
        }
        body{
            /* font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;             */
        }
        th, td {
        padding: 5px;
        }
    </style>
</head>
<body>
   <table width='100%' style='text-align:center;'>
    <tr>
        <td style="font-size:25px;">
            GKC
        </td>
    </tr>
       <tr>
           <td style="font-size:20px;">
               <b><i>{{$request->location}}</i></b> Baling Station
           </td>
       </tr>
   </table>
   <br>

   <table width='100%' border=1 cellspacing='0px'>
        <tr>
            <td width='70%;'>
                PAID TO : <b> {{$request->supplier}} </b>
            </td>
            <td width='30%;'>
                Date : <b> {{date('M d, Y h:i A')}}</b>
            </td>
        </tr>
        <tr>
            <td>
                DRIVER'S NAME :  <b>{{$request->driver_name}} </b>
            </td>
            <td>
                System Code : <b> {{date('Y-m',strtotime($request->date_encode))}}-{{str_pad($request->code, 5, '0', STR_PAD_LEFT)}} </b>
            </td>
        </tr>
    </table>
    <br>
    <table width='100%' border=1 cellspacing='0px'>
        <tr>
            <td colspan=3 width='60%'>
               MATERIAL TYPE :  {{$request->material_type}}
            </td>
            <td width='40%'>
                GROSS WEIGHT : {{$request->gross}} KG
            </td>
        </tr>
        <tr>
            <td colspan=3>
              PLATE NO. : {{$request->plate_number}}
            </td>
              <td>
                TARE WEIGHT :  {{$request->tare}} KG
            </td>
        </tr>
        <tr>
            <td colspan=3>
              TRUCK TYPE : 
            </td>
              <td>
                NET WEIGHT : {{$request->net}} KG
            </td>
        </tr>
        <tr>
            <td >
                MC : {{$request->mc}} %
            </td>
            <td  >
                OT : 0 %
            </td>
            <td>
                PM : 0 %
            </td>
            <td>
                DEDUCTED WEIGHT : {{$request->deduction}} KG
            </td>
        </tr>
        <tr >
            <td colspan="3">
                UNIT PRICE : {{$request->unit_price}}
            </td>
            <td>
                PAYMENT WEIGHT : {{$request->payment_weight}} KG
            </td>
        </tr>
       
    </table>
    <br>
    <table border="0" width='100%' style='border-top:3px solid black;'>
        <tr style="border:0px;">
            <td style="border:0px;" colspan="3" width='60%'>
                &nbsp;
            </td>
            <td style="border:0px;" width='40%'>
                TOTAL AMOUNT : <b style='font-size:25px;'>{{number_format($request->total,2)}}</b>
            </td>
        </tr>
    </table>
    <br>
    <table border="1" width='100%' style='text-align:center;font-size:10px;'>
        <tr style="border:0px;">
            <td ><br><br>
                {{strtoupper($request->encode_by)}}<br>
                <span style="text-decoration:overline">PREPARED BY</span>
            </td>
            <td >
                <br><br>
                {{strtoupper($request->check_by)}}<br>
                <span style="text-decoration:overline">CHECKED BY</span>
            </td>
            <td >
                <br><br>
                {{strtoupper($request->verified_by)}}<br>
                <span style="text-decoration:overline">  APPROVED BY</span>
            </td>
            <td >
                <br><br>
                <br>
                <span style="text-decoration:overline"> RECEIVED THE FULL PAYMENT </span><br>DESCRIBED ABOVE BY
            </td>
        </tr>
    </table>
</body>
</html>
        
        
        
        