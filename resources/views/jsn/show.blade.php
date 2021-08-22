<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Json Data View</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Json table</h2>
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
<th>Date</th>
<th>trade Code</th>
<th>high</th>
<th>low</th>
<th>close</th>
<th>open</th>
<th>volume</th>
</tr>
@foreach ($stocks as $stock_market)
<tr>
<td>{{ $stock_market['date'] }}</td>
<td>{{ $stock_market['trade_code'] }}</td>
<td>{{ $stock_market['high'] }}</td>
<td>{{ $stock_market['low'] }}</td>
<td>{{ $stock_market['close'] }}</td>
<td>{{ $stock_market['open'] }}</td>
<td>{{ $stock_market['volume'] }}</td>

</tr>
@endforeach
</table>

</body>
</html>