<?php

namespace App\Http\Controllers;
use \Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Illuminate\Http\Request;
use App\Voucher;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $dateS = Carbon::now()->endOfMonth()->subMonth(6)->format('Y-m-d');
        $dateE = Carbon::now()->endOfMonth()->format('Y-m-d');

        $monthRange = CarbonPeriod::create($dateS, '1 month', $dateE);
            foreach ($monthRange as $month){
            $items[] = Carbon::parse($month)->format('F Y');
        }
        $requests = Voucher::select(
                    DB::raw('sum(total) as sums'), 
                    DB::raw("count(*) as data"),
                    DB::raw("sum(payment_weight) as paid_weight"),
                    DB::raw("DATE_FORMAT(date_encode,'%M %Y') as months")
        )
        ->whereBetween('date_encode',[$dateS,$dateE])
        ->groupBy('months')
        ->orderBy('date_encode','asc')
        ->get();
        // dd(json_encode($orders));
        return view('home',array(
            
            'subheader' => 'Dashboards',
            'header' => 'Home',
            'requests' => $requests,
            'items' => $items,
        ));
    }
}
