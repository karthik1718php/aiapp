@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Product Details') }}</span>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary">Back</a>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Name') }}:</label>

                        <div class="col-md-6 col-form-label">
                            {{ $product->name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Price') }}:</label>

                        <div class="col-md-6 col-form-label">
                            ${{ number_format($product->price, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
