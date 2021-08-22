<?php

namespace App\Http\Controllers;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockCRUDController extends Controller
{
    public function index()
        {
            

            $data['stocks'] = Stock::orderBy('id','desc')->paginate(50);
            return view('stocks.index', $data);
        }


    public function create()
        {
            return view('stocks.create');
        }


    public function store(Request $request)
        {
            $request->validate([
                'date' => 'required',
                'trade_code' => 'required',
                'high' => 'required',
                'low' => 'required',
                'open' => 'required',
                'close' => 'required',
                'volume' => 'required'
            ]);
            $stock_market = new Stock;
            $stock_market->date = $request->date;
            $stock_market->trade_code = $request->trade_code;
            $stock_market->high = $request->high;
            $stock_market->low = $request->low;
            $stock_market->open = $request->open;
            $stock_market->close = $request->close;
            $stock_market->volume = $request->volume;
            $stock_market->save();
            return redirect()->route('stocks.index')
            ->with('success',' has been created successfully.');
        }

    public function edit(Stock $stock)
        {
            return view('stocks.edit',compact('stock'));
        }

    public function update(Request $request, $id)
        {
            $request->validate([
                'date' => 'required',
                'trade_code' => 'required',
                'high' => 'required',
                'low' => 'required',
                'open' => 'required',
                'close' => 'required',
                'volume' => 'required'
            ]);
            $stock_market->date = $request->date;
            $stock_market->trade_code = $request->trade_code;
            $stock_market->high = $request->high;
            $stock_market->low = $request->low;
            $stock_market->open = $request->open;
            $stock_market->close = $request->close;
            $stock_market->volume = $request->volume;
            $stock_market->save();
            return redirect()->route('stocks.index')
            ->with('success',' Has Been updated successfully');
        }

    public function destroy(Stock $stock)
        {
            $stock->delete();
            return redirect()->route('stocks.index')
            ->with('success',' has been deleted successfully');
        }
}


