<?php

namespace App\Http\Controllers;
use App\Requests;
use PDF;
use App\History;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    //

    public function index()
    {

        $last_request = Requests::orderBy('id','desc')->first();
        $all_request_today = Requests::orderBy('id','desc')->where('date_encode','=',date('Y-m-d'))->get();
     
        return view('requests',array(

            'subheader' => '',
            'header' => 'Requests',
            'last_request' => $last_request,
            'all_request_today' => $all_request_today,
        ));
    }
    public function forVerifications()
    {

        return view('for_verifications',array(

            'subheader' => '',
            'header' => 'For Verifications',
        ));
    }

    public function newRequest(Request $request)
    {
        // dd($request->all());

        $last_request = Requests::orderBy('id','desc')->first();
        if($last_request == null)
        {
            $code = 1;
        }
        else
        {
            if(date('Y-m',strtotime($last_request->date_encode)) == data('Y-m'))
            {
            $code = $last_request->code + 1;
            }
            else
            {
            $code = 1;
            }
        }

        
        $data = new Requests;
        $data->supplier = strtoupper($request->supplier);
        $data->driver_name = strtoupper($request->driver_name);
        $data->plate_number = strtoupper($request->plate_number);
        $data->truck_type = strtoupper($request->truck_type);
        $data->material_type = $request->item;
        $data->gross = $request->gross;
        $data->tare = $request->tare;
        $data->net = round($request->gross - $request->tare);
        $data->mc = $request->mc;
        $data->ot = $request->ot;
        $data->pm = $request->pm;
        if($data->mc > 12)
        {
            $payment_weight = round(((100-$request->mc)/88)*$data->net);
            $deduction = $net - $payment_weight;
        }
        else
        {
            $deduction = 0;
            $payment_weight = $data->net;
        }
        $data->deduction = $deduction;
        $data->payment_weight = $payment_weight;
        $total = round($payment_weight * $request->unit_price);
        $data->unit_price = $request->unit_price;
        $data->total = $total;
        $data->date_encode = date('Y-m-d');
        $data->encode_by = strtoupper(auth()->user()->name);
        $data->check_by = strtoupper($request->checked_by);
        $data->verified_by = strtoupper($request->approved_by);
        $data->code = $code;
        $data->save();

        $return = json_encode($data->getAttributes());

        $new_history = new History;
        $new_history->requests_id = $data->id;
        $new_history->action = "New Request";
        $new_history->action_by = auth()->user()->id;
        $new_history->data =  $return;
        $new_history->save();

        $request->session()->flash('status','Successfully submitted new Request');
        return back();

    }

    public function voucherPrint(Request $request,$id)
    {
        $request = Requests::where('id',$id)->first();
        $pdf = PDF::loadView('voucher_print',array(

            'request' => $request,
        )); 
        // $pdf->setPaper(array(0, 0, 612, 440), 'portrait');
      
        return $pdf->stream('voucher_print.pdf');
    }
}
