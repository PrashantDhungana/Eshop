@extends('admin.layout')
@section('content')
    <h6>Order Items for Order ID <span>#{{ $order_items[0]->order->id }}</span></h6>
    <div class="az-content az-content-dashboard">
        <div class="container">
          <div class="az-content-body">
            {{-- {{ Auth::user()->name }} --}}
            <table width="900" align="center" border="1px solid black">
                <tr>
                    <td>Order Item ID</td>
                    <td>User Name</td>
                    <td>Product Image</td>
                    <td>Product Name</td>
                    <td>Product Price</td>
                    <td>Quantity</td>
                    <td>Total Price</td>
                    <td colspan="2"><center>Delete</center></td>
                </tr>
                @foreach ($order_items as $item)
                  <tr>
                    <td><a href="#">{{ $item->id }}</a></td>
                    <td> {{ $item->order->user->name }} </td>
                    <td><img src="/storage/images/{{ $item->product->image }}" height="350" width="250"></td>
                    <td> {{ $item->product->name }}</td>
                    <td>{{ $item->product_price }}</td>
                    <td>{{ $item->quantity}}</td>
                    <td>{{ $item->total }}</td>
                    <td>
                      <form action="{{ route('order.destroy',$item->id) }}" method="POST">
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