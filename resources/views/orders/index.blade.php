@extends('layouts.app')

@section('content')
    
    <h1 class="mb-3">Orders</h1>

    <div class="bg-light p-4 rounded">
        <form method="GET" action="/orders" class="form-inline">
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
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary mb-2">Go</button>
                        </div>
                    </div>
            </form>
            </div>
            <form method="GET" action="/orders">
                <div class="row">
                    <div class="col-md-5">
                        <label for="start_book" class="form-label">From Date</label>
                        <input value="{{ request()->get('from') }}" 
                            id="start-datepicker"
                            type="text" 
                            class="form-control date" 
                            name="from" 
                            placeholder="From Date" required>

                        @if ($errors->has('from'))
                            <span class="text-danger text-left">{{ $errors->first('from') }}</span>
                        @endif
                    </div>
                    <div class="col-md-5">
                        <label for="end_book" class="form-label">To Date</label>
                        <input value="{{ request()->get('to') }}" 
                            id="end-datepicker"
                            type="text" 
                            class="form-control date"  
                            name="to" 
                            placeholder="To Date" required>

                        @if ($errors->has('to'))
                            <span class="text-danger text-left">{{ $errors->first('to') }}</span>
                        @endif
                    </div>
                    <div class="col-md-2" style="margin-top: 30px;">
                        <button type="submit" class="form-control btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
            </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>Product Name</th>
             <th>Quantity</th>
             <th>Order Date</th>
             <th width="3%" colspan="3">Action</th>
          </tr>
            @foreach ($orders as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item['product_name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ date('d M Y', strtotime($item['created_at'])) }}</td>
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
