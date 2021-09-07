<?php


namespace App\Http\Controllers;
use App\Models\Stock;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class jsonController extends Controller
{


    public function index(Request $request)
        {
            if(request()->ajax())
            {
                if(!empty($request->trade_code))
                    {
                    $data = Stock::select('date', 'trade_code', 'high', 'low', 'open', 'close','volume')
                        ->where('trade_code', $request->trade_code)->orderBy('date', 'ASC')
                        ->get();
                    }
                else
                    {
                    $data = Stock::select('date', 'trade_code', 'high', 'low', 'open', 'close','volume')->orderBy('date', 'ASC')
                        ->get();
                    }
            return datatables()->of($data)->make(true);
            }

        $date = Stock::select('date')->orderBy('date', 'ASC')->get()->toArray();
        $close = Stock::select('close')->orderBy('date', 'ASC')->get()->toArray();
        $trade_code = Stock::select('trade_code')->orderBy('date', 'ASC')->get()->toArray();
        $volume = Stock::select('volume')->orderBy('date', 'ASC')->get()->toArray();

        $stock = new Stock;
        $stock->date = $date;
        $stock->close = $close;
        $stock->trade_code = $trade_code;
        $stock->volume = $volume;

        $trade_code = Stock::select('trade_code')
            ->groupBy('trade_code')
            ->orderBy('date', 'ASC')
            ->get();
        return view('jsn.custom_search', compact('trade_code','stock'));
        }
    
}
