<?php

namespace App\Http\Controllers;
use App\Models\Stock;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class jsonController extends Controller
{
    public function index()
        {
            $path = storage_path('stock_market_data.json'); 
            $json =json_decode(file_get_contents($path), true); 
            $i=0;
            foreach($json as $stock_market) { 
                
                $i=$i+1;
                $stock = new Stock;
                $stock->date = $stock_market['date'];
                $stock->trade_code = $stock_market['trade_code'];
                $stock->high = $stock_market['high'];
                $stock->low = $stock_market['low'];
                $stock->open = $stock_market['open'];
                $stock->close = $stock_market['close'];
                $stock->volume = $stock_market['volume'];
                $stock->save();
                if ($i==100){
                    break;
                }
            }

            $data['stocks'] = json_decode(file_get_contents($path), true);
        
        return view('jsn.show', $data);
        }
    
}
