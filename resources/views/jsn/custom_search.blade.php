<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stock Data</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    
 </head>
 <body>
  <div class="container">    
     <br />
  
  
    <div class="container">  
        <div class="row">  
            <div class="col-md-10 col-md-offset-1">  
                <div class="panel panel-default">  
                    <div class="panel-heading">Dashboard</div>  
                    <div class="panel-body">  
                        <canvas id="canvas" height="280" width="600"></canvas>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </div>  
   

     <h3 align="center">Custom Search in Datatables using Datatable </h3>
     <br />
            <br />
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="trade_code" id="trade_code" class="form-control" required>
                            <option value="">Select trade code</option>
                            @foreach($trade_code as $trade_code)

                            <option value="{{ $trade_code->trade_code }}">{{ $trade_code->trade_code }}</option>

                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group" align="center">
                        <button onclick="myFun()" type="button" name="filter" id="filter" class="btn btn-info">Filter</button>

                        <button type="button" name="reset" id="reset" class="btn btn-default">Reset</button>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br />
   <div class="table-responsive">
    <table id="customer_data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>trade code</th>
                            <th>high</th>
                            <th>low</th>
                            <th>open</th>
                            <th>close</th>
                            <th>volume</th>
                        </tr>
                    </thead>
                </table>
   </div>
            <br />
            <br />
  </div>



<script>
$(document).ready(function(){

    fill_datatable();

    function fill_datatable( trade_code = '')
    {
        var dataTable = $('#customer_data').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('json.index') }}",
                data:{trade_code:trade_code}
            },
            columns: [
                {
                    data:'date',
                    name:'date'
                },
                {
                    data:'trade_code',
                    name:'trade_code'
                },
                {
                    data:'high',
                    name:'high'
                },
                {
                    data:'low',
                    name:'low'
                },
                {
                    data:'open',
                    name:'open'
                },
                {
                    data:'close',
                    name:'close'
                },
                {
                    data:'volume',
                    name:'volume'
                }
            ]
        });
    }

    $('#filter').click(function(){
        var trade_code = $('#trade_code').val();

        if(trade_code != '')
        {
            $('#customer_data').DataTable().destroy();
            fill_datatable(trade_code);
        }   

    });

    $('#reset').click(function(){
        $('#trade_code').val('');
        $('#customer_data').DataTable().destroy();
        fill_datatable();
    });

});



function myFun() {
    var close = {!!json_encode($stock->close)!!} 

    var date = {!!json_encode($stock->date)!!} 
    var trade_code = {!!json_encode($stock->trade_code)!!} 
    var volume = {!!json_encode($stock->volume)!!} 
    var dat =date;
    var cls =close;
    var tc=trade_code;
    var volum = volume;
    for (let i = 0; i < date.length; i++) {
        dat[i]=date[i].date;
        tc[i]=trade_code[i].trade_code;
        cls[i]=close[i].close;
        volum[i]=volume[i].volume;
    }
    var trade_cod = $('#trade_code').val();

    var j=0;
    var datt=[];
    var clst=[];
    var vol=[];
    for (let i = 0; i < tc.length; i++) {
        
    if(tc[i]=== trade_cod){
        datt[j]=dat[i];
        clst[j]=cls[i];
        vol[i]=volum[i]
        j=j+1
    }
    
    }

    var barChartData = {  
        labels: datt,  

        datasets: [ {  
            label: 'close',  
            backgroundColor: "rgba(69,10,10,0.5)",  
            data: clst  
        },{  
            label: 'volume',  
            backgroundColor: "rgba(151,187,205,0.5)",  
            data: vol  
        }
        
        ]  
    };  
  
 
        var ctx = document.getElementById("canvas").getContext("2d");  
        window.myBar = new Chart(ctx, {  
            type: 'bar',  
            data: barChartData,  
            options: {  
                elements: {  
                    rectangle: {  
                        borderWidth: 2,  
                        borderColor: 'rgb(0, 255, 0)',  
                        borderSkipped: 'bottom'  
                    }  
                },  
                responsive: true,  
                title: {  
                    display: true,  
                    text: 'Statistics Graph'  
                }  
            }  
        });  

}


  


var close = {!!json_encode($stock->close)!!} 

var date = {!!json_encode($stock->date)!!} 
var trade_code = {!!json_encode($stock->trade_code)!!} 
var volume = {!!json_encode($stock->volume)!!} 
var dat =date;
var cls =close;
var tc=trade_code;
var volum = volume;
for (let i = 0; i < date.length; i++) {
    dat[i]=date[i].date;
    tc[i]=trade_code[i].trade_code;
    cls[i]=close[i].close;
    volum[i]=volume[i].volume;
}
    
    var barChartData = {  
        labels: dat,  

        datasets: [ {  
            label: 'close',  
            backgroundColor: "rgba(69,10,10,0.5)",  
            data: cls  
        },
        {  
            label: 'volume',  
            backgroundColor: "rgba(151,187,205,0.5)",  
            data: volum 
        }]  
    };  
  
    window.onload = function() {  
        var ctx = document.getElementById("canvas").getContext("2d");  
        window.myBar = new Chart(ctx, {  
            type: 'bar',  
            data: barChartData,  
            options: {  
                elements: {  
                    rectangle: {  
                        borderWidth: 2,  
                        borderColor: 'rgb(0, 255, 0)',  
                        borderSkipped: 'bottom'  
                    }  
                },  
                responsive: true,  
                title: {  
                    display: true,  
                    text: 'Statistics Graph'
                }  
            }  
        });  
  
    };
</script>
  
</body>
</html>