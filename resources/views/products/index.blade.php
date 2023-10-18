@extends('layouts.app')

@section('content')
    
    <h1 class="mb-3">Products</h1>

    <div class="bg-light p-4 rounded">
        <form method="GET" action="/products" class="form-inline">
        <div class="row" style="margin-bottom: 50px">
            <div class="col-md-4">
                <input type="search" name="search" class="form-control form-control" placeholder="Search..." aria-label="Search" value="{{ request()->get('search') }}">
            </div>
            <div class="col-md-6">
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control" name="sort">
                                <option value="">Sort</option>
                                <option value="n-asc" {{ request()->get('sort') == 'n-asc'  ? 'selected' : ''}}>A - Z</option>
                                <option value="n-desc" {{ request()->get('sort') == 'n-desc'  ? 'selected' : ''}}>Z - A</option>
                                <option value="u-desc" {{ request()->get('sort') == 'u-desc'  ? 'selected' : ''}}>Recent Add</option>
                                <option value="u-asc" {{ request()->get('sort') == 'u-asc'  ? 'selected' : ''}}>Oldest Add</option>
                                <option value="sales-desc" {{ request()->get('sort') == 'sales-desc'  ? 'selected' : ''}}>Highest Sales</option>
                                <option value="sales-asc" {{ request()->get('sort') == 'sales-asc'  ? 'selected' : ''}}>Lowest Sales</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary mb-2">Go</button>
                    </div>
                </div>
            </form>
            </div>
            <div class=col-md-2>
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
             <th>Total Sales</th>
             <th width="3%" colspan="3">Action</th>
          </tr>
            @foreach ($products as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item['product_name'] }}</td>
                <td>{{ $item['product_type'] }}</td>
                <td>{{ $item['stock'] }}</td>
                <td>{{ $item['total_sales']}}</td>
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
