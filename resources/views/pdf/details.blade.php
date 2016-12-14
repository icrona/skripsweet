<!DOCTYPE html>
<html>
<head>
	<title>Order Details Download</title>
</head>
<body>
			<h1>Order Details</h1>
			<a href="{{ url('/orders'.$order->id) }}"><small>{{ url('/orders'.$order->id) }}</small> </a>
			<p>Date Received : {{$order->created_at}}</p>
			<p>Status : {{$order->status}}</p>
			
<table>
	<tr>
		<td>
			<img src="{{ public_path('images/') . $order->cake_image }}" style="width:200px;height:200px;">

		</td>
		<td>

			<p>Name       : {{$order->name}}<p>
			<p>Phone       : {{$order->phone}}<p>
			<p>Email       : {{$order->email}}<p>
			<p>Address       : {{$order->address}}<p>
			<p>Delivery Date       : {{$order->date}}<p>
			<p>Notes      : {{$order->notes}}<p>
		</td>
	</tr>
</table>
<br>

<p><small>Printed at : {{$order->time}}</small></p>


</body>
</html>