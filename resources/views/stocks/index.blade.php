<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Stock Market</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    </head>
    <body>
        <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Stock Market Data</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('stocks.create') }}"> Add Data</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>S.No</th>
                <th>Date</th>
                <th>trade Code</th>
                <th>high</th>
                <th>low</th>
                <th>close</th>
                <th>open</th>
                <th>volume</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($stocks as $stock_market)
            <tr>
                <td>{{ $stock_market->id }}</td>
                <td>{{ $stock_market->date }}</td>
                <td>{{ $stock_market->trade_code }}</td>
                <td>{{ $stock_market->high }}</td>
                <td>{{ $stock_market->low }}</td>
                <td>{{ $stock_market->close }}</td>
                <td>{{ $stock_market->open }}</td>
                <td>{{ $stock_market->volume }}</td>
                <td>
                <form action="{{ route('stocks.destroy',$stock_market->id) }}" method="Post">
                <a class="btn btn-primary" href="{{ route('stocks.edit',$stock_market->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                 </td>
            </tr>
            @endforeach
        </table>
        {!! $stocks->links() !!}
    </body>
</html>