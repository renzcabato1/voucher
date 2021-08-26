<?php

namespace App\Http\Controllers;
use App\Voucher;
use App\History;
use PDF;
use DB;
use \Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    //
    
    public function index()
    {

        $last_request = Voucher::orderBy('id','desc')->first();
        $all_request_today = Voucher::orderBy('id','desc')->where('date_encode','=',date('Y-m-d'))->get();
        
        return view('requests',array(

            'subheader' => '',
            'header' => 'Vouchers',
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

        $last_request = Voucher::orderBy('id','desc')->first();
        if($last_request == null)
        {
            $code = 1;
        }
        else
        {
            if(date('Y-m',strtotime($last_request->date_encode)) == date('Y-m'))
            {
            $code = $last_request->code + 1;
            }
            else
            {
            $code = 1;
            }
        }

        
        $data = new Voucher;
        // dd(($request->all()));
        $data->supplier = strtoupper($request->supplier_name);
        $data->driver_name = strtoupper($request->driver_name);
        $data->plate_number = strtoupper($request->plate_number);
        $data->truck_type = strtoupper($request->truck_type);
        $data->material_type = $request->item;
        $data->gross = $request->gross;
        $data->tare = $request->tare;
        $net = round($request->gross - $request->tare);
        $data->net = round($request->gross - $request->tare);
        $data->mc = $request->mc;
        $data->ot = $request->ot;
        $data->pm = $request->pm;
        if($data->mc > 12)
        {
            $payment_weight = round(((100-$request->mc)/88)*$net);
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
        $data->location = "VALENZUELA";
        $data->save();

        $return = json_encode($data->getAttributes());

        $new_history = new History;
        $new_history->voucher_id = $data->id;
        $new_history->action = "New Request";
        $new_history->action_by = auth()->user()->id;
        $new_history->data =  $return;
        $new_history->save();

        $request->session()->flash('status','Successfully submitted new Request');
        return back();

    }
    public function editRequest(Request $request,$id)
    {
        $data = Voucher::where('id','=',$id)->first();
        $history_data = json_encode($data);
        $data->supplier = strtoupper($request->supplier_name);
        $data->driver_name = strtoupper($request->driver_name);
        $data->plate_number = strtoupper($request->plate_number);
        $data->truck_type = strtoupper($request->truck_type);
        $data->material_type = $request->item;
        $data->gross = $request->gross;
        $data->tare = $request->tare;
        $net = round($request->gross - $request->tare);
        $data->net = round($request->gross - $request->tare);
        $data->mc = $request->mc;
        $data->ot = $request->ot;
        $data->pm = $request->pm;
        if($data->mc > 12)
        {
            $payment_weight = round(((100-$request->mc)/88)*$net);
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
        $data->location = "VALENZUELA";
        $data->save();

        $return = json_encode($data->getAttributes());

        $new_history = new History;
        $new_history->voucher_id = $data->id;
        $new_history->action = "Edit Request";
        $new_history->action_by = auth()->user()->id;
        $new_history->data =  $history_data;
        $new_history->save();

        $request->session()->flash('status','Successfully submitted edit Request');
        return back();

    }
    public function voucherPrint(Request $request,$id)
    {
        $request = Voucher::where('id',$id)->first();
        $pdf = PDF::loadView('voucher_print',array(

            'request' => $request,
        )); 
        // $pdf->setPaper(array(0, 0, 612, 440), 'portrait');
      
        return $pdf->stream('voucher_print.pdf');
    }

    public function reportDailyReimbursement (Request $request)
    {
        $date = $request->date;
        $dateto = $request->dateto;
        $data_info = Voucher::where('date_encode','=',$request->dateto)->first();
        $data_all = Voucher::whereBetween('date_encode', [$date, $dateto])->orderBy('id','asc')->get();
        return view('daily_reimbursement',array(

            'subheader' => 'Reimbursement',
            'header' => 'Reports',
            'date' => $date,
            'data_info' => $data_info,
            'data_all' => $data_all,
            'dateto' => $dateto,
            

        ));
    }
    public function accountingMonitoring (Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        // dd($data);
        $data_all = Voucher::whereBetween('date_encode', [$date_from, $date_to])->orderBy('id','asc')->get();
        
        return view('accounting_monitoring',array(

            'subheader' => 'Accounting Monitoring',
            'header' => 'Accounting Reports',
            'date_from' => $date_from,
            'date_to' => $date_to,
            'data_all' => $data_all,
            

        ));
    }
}
