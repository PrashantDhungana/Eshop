
@extends('admin.layout')
@section('content')
@if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif
<div class="az-content az-content-dashboard">
    <div class="container">
      <div class="az-content-body">
        <a href="{{ route('products.create') }}">Create Product</a>
        {{-- {{ Auth::user()->name }} --}}
        <table width="900" align="center" border="1px solid black">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Description</td>
                <td>New price</td>
                <td>Old price</td>
                <td>Image</td>
                <td colspan="2"><center>Action</center></td>
            </tr>
            @foreach ($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td> {{ $product->name }} </td>
                <td> {{ substr($product->details, 0, 50) }}...</td>
                <td>{{ $product->new_price }}</td>
                <td>{{ $product->old_price }}</td>
                <td> <img src="/storage/images/{{ $product->image }}" height="200" width="200"/></td>
                <td>
                  @can('update-product', $product)
                  <a class="btn btn-primary" href="{{ route('products.edit', $product->slug)}}"> Edit </a>
                  @endcan
                </td>
                <td>
                  <form action="{{ route('products.destroy', $product->slug)}}" method="POST">
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

