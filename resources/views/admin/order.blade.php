@extends('admin.layout')
@section('content')
<div class="az-content az-content-dashboard">
    <div class="container">
      <div class="az-content-body">
        {{-- {{ Auth::user()->name }} --}}
        <table width="900" align="center" border="1px solid black">
            <tr>
                <td>Order ID</td>
                <td>User Name</td>
                <td>Order Status</td>
                <td>Sub Total</td>
                <td>Discount</td>
                <td>Shipping Address</td>
                <td>Shipping Price</td>
                <td>Total Price</td>
                <td colspan="2"><center>Delete</center></td>
            </tr>
            @foreach ($orders as $order)
              <tr>
                <td><a href="{{ route('order.show',$order->id) }}">{{ $order->id }}</a></td>
                <td> {{ $order->user->name }} </td>
                <td> {{ $order->order_status }}</td>
                <td>{{ $order->sub_total }}</td>
                <td>{{ $order->discount }}</td>
                <td>{{ $order->shipping_address }}</td>
                <td>{{ $order->shipping_price }}</td>
                <td>{{ $order->total_price }}</td>
                <td><a class="btn btn-primary" href="{{route('order.show',$order->id)}}" style="padding: 5px;margin:5px;"
                  title="@foreach($order->orderItems as $item){{ substr($item->product->name,0,500) }}
@endforeach">
                  View({{$count = count($order->orderItems)}} item{{ $count==1?'':'s'}})</a></td>
                <td>
                  <form action="{{ route('order.destroy',$order->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"> Delete </button>
                  </form>
                </td>
              </tr>
            @endforeach
        </table>
      </div>
    </div>
  </div>
@endsection