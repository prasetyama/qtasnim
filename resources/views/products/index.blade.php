@extends('layouts.app')

@section('content')
    
    <h1 class="mb-3">Products</h1>

    <div class="bg-light p-4 rounded">
        <div class="row" style="margin-bottom: 50px">
            <div class="col-md-4">
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="/products" method="GET">
                    <input type="search" name="search" class="form-control form-control" placeholder="Search..." aria-label="Search" value="{{ request()->get('search') }}">
                </form>
            </div>
            <div class=col-md-8>
                <div class="lead">
                    <a href="{{ route('products.add') }}" class="btn btn-primary btn-sm float-right">Add Product</a>
                </div>
            </div>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>Product Name</th>
             <th>Product Type</th>
             <th>Stock</th>
             <th width="3%" colspan="3">Action</th>
          </tr>
            @foreach ($products as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item['product_name'] }}</td>
                <td>{{ $item['product_type'] }}</td>
                <td>{{ $item['stock'] }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('products.edit', $item['id']) }}">Edit</a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['products.delete', $item['id']],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </table>

    </div>
@endsection