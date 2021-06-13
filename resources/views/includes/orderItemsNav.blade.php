<?php
    use App\Models\OrderItem;
    $orders = OrderItem::all();
    $count = count($orders);
?>
<div class="sinlge-bar shopping">
    <a href="{{ route('order.index') }}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{$count}}</span></a>
    
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ $count }} Item{{$count ==1?'':'s'}}</span>
            <a href="{{ route('order.index') }}">View Cart</a>
        </div>
        <ul class="shopping-list">
        @foreach ($orders as $order)	
            <li>
                <form action="{{ route('cart.destroy',$order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="fa fa-remove"></button></a>
                </form>
                <a class="cart-img" href="{{ route('product.show',$order->product->slug)}}"><img src="/storage/images/{{ $order->product->image }}" alt="{{ $order->product->name }}"></a>
                <h4><a href="{{ route('product.show',$order->product->slug)}}">{{ $order->product->name}}</a></h4>
                <p class="quantity">{{ $order->quantity }}x - <span class="amount">Rs.{{$order->product->new_price}}</span></p>
            </li>
        @endforeach
        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">Rs.</span>
            </div>
            <a href="checkout.html" class="btn animate">Checkout</a>
        </div>
    </div>
    <!--/ End Shopping Item -->
</div>

