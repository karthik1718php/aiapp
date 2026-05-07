@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Products') }}</span>
                    @if(auth()->user() && in_array(auth()->user()->role, ['admin', 'user']))
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Add Product</a>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            <a class="btn btn-sm btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                                            
                                            @if(auth()->user() && in_array(auth()->user()->role, ['admin', 'user']))
                                                <a class="btn btn-sm btn-warning" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                            @endif

                                            @if(auth()->user() && auth()->user()->role === 'admin')
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
