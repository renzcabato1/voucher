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
        $request->validate([
            'scf' => 'required|unique:requests,scf|max:255'
            ]);

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
        $data->supplier = $request->supplier;
        $data->material_type = $request->item;
        $data->scf = $request->scf;
        $data->gross = $request->gross;
        $data->mc = $request->mc;
        $percent =((100-$request->mc)/88);
        $net = round($request->gross * $percent);
        $deduction = $data->gross-$net;
        $total = round($net * $request->unit_price);
        $data->net = $net;
        $data->deduction = $deduction;
        $data->unit_price = $request->unit_price;
        $data->total = $total;
        $data->date_encode = date('Y-m-d');
        $data->encode_by = auth()->user()->name;
        $data->check_by = $request->checked_by;
        $data->verified_by = $request->approved_by;
        $data->code = $code;
        $data->save();

        $return = json_encode($data->getAttributes());
        // dd($return);

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
