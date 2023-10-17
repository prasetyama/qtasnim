@extends('layouts.app')

@section('content')
    <div class="bg-light p-4 rounded">
        <h2>Edit Product</h2>

        <div class="container mt-4">

            <form method="POST" action="{{ route('products.update', $product['id']) }}">
                @csrf
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input value="{{ $product['product_name'] }}" 
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
                        <option value="Konsumsi" {{ $product['product_type'] == 'Konsumsi'  ? 'selected' : ''}}>Konsumsi</option>
                        <option value="Pembersih" {{ $product['product_type'] == 'Pembersih'  ? 'selected' : ''}}>Pembersih</option>
                    </select>

                    @if ($errors->has('product_type'))
                        <span class="text-danger text-left">{{ $errors->first('product_type') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input value="{{ $product['stock'] }}" 
                        type="text" 
                        class="form-control" 
                        name="stock" 
                        placeholder="Stock" required>

                    @if ($errors->has('stock'))
                        <span class="text-danger text-left">{{ $errors->first('stock') }}</span>
                    @endif
                </div>
                

                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('products.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection