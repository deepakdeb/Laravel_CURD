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
        $high= Stock::select('high')->orderBy('date', 'ASC')->get()->toArray();
        $low = Stock::select('low')->orderBy('date', 'ASC')->get()->toArray();
        $open = Stock::select('open')->orderBy('date', 'ASC')->get()->toArray();
        $volume = Stock::select('volume')->orderBy('date', 'ASC')->get()->toArray();

        $stock = new Stock;
        $stock->date = $date;        
        $stock->trade_code = $trade_code;
        $stock->high = $high;
        $stock->low = $low;
        $stock->open = $open;
        $stock->close = $close;
        $stock->volume = $volume;

        $data['stocks'] = Stock::orderBy('id','desc');

        $trade_code = Stock::select('trade_code')->groupBy('trade_code')->get();
        return view('jsn.custom_search',  compact('trade_code','stock',$data));
        }
    
}
