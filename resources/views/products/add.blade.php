@extends('layouts.app')

@section('content')
    <div class="bg-light p-4 rounded">
        <h2>Add Product</h2>

        <div class="container mt-4">

            <form method="POST" action="{{ route('products.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input value="{{ old('product_name') }}" 
                        type="text" 
                        class="form-control" 
                        name="product_name" 
                        placeholder="Product Name" required>

                    @if ($errors->has('product_name'))
                        <span class="text-danger text-left">{{ $errors->first('product_name') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="product_type" class="form-label">Product Type</label>
                    <select class="form-control" name="product_type">
                        <option value="">Select Product Type</option>
                        <option value="konsumsi">Konsumsi</option>
                        <option value="pembersih">Pembersih</option>
                    </select>

                    @if ($errors->has('model'))
                        <span class="text-danger text-left">{{ $errors->first('model') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input value="{{ old('stock') }}" 
                        type="text" 
                        class="form-control" 
                        name="stock" 
                        placeholder="Stock" required>

                    @if ($errors->has('stock'))
                        <span class="text-danger text-left">{{ $errors->first('stock') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Add Product</button>
                <a href="{{route('products.index')}}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection