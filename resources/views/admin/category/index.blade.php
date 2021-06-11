
@extends('admin.layout')
@section('content')
@if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif
<div class="az-content az-content-dashboard">
    <div class="container">
      <div class="az-content-body">
        <a href="{{ route('categories.create') }}">Create Product</a>
        {{-- {{ Auth::user()->name }} --}}
        <table width="900" align="center" border="1px solid black">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Description</td>
                <td>Slug</td>
                <td>Parent ID</td>
                <td>Created At</td>
                <td>Updated At</td>
                <td colspan="2"><center>Actions</center></td>
            </tr>
            @foreach ($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td> {{ $category->name }} </td>
                <td> {{ substr($category->description, 0, 50) }}...</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->parent_id }}</td>
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }} </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('categories.edit', $category->slug)}}"> Edit </a>
                </td>
                <td><form action="{{ route('categories.destroy', $category->slug)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"> Delete </button>
                
                </form></td>
              </tr>
            @endforeach
        </table>
      </div>
    </div>
  </div>
@endsection

