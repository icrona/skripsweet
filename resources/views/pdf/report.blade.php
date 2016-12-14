<!DOCTYPE html>
<html>
<head>
	<title>Report Download</title>
</head>
<body>
    <style type="text/css">
    table td, table th{
        border:1px solid black;
    }
			<h1>Report</h1>
			<h4>Period : {{$from}} - {{$to}} <h4> 
			<p><small>Printed at : {{$time_report}}</small></p>
			<p>Total Price : {{$total_report}}</p>
			
<table>
	<tr>
        <th>Delivery Date</th>
        <th>Customer Name</th>
        <th>Cake Name</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    @foreach($reports as $report)
    <tr>
        <td>{{$report->date}}</td>
        <td>{{$report->name}}</td> 
        <td>{{$report->cake_name}}</td>
        <td>Rp. {{$report->cake_price}}</td>
        <td><a href={{url('/orders/')}}{{$report->id}}>Details</a></td>
    </tr>
    @endforeach()                    
</table>
<br>




</body>
</html>