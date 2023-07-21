<!-- resources/views/products/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Product Listing</h1>
  <div class="grid grid-cols-3 gap-4">
    @foreach($products as $product)
      <div class="border p-4 rounded-md shadow-md">
        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
        <p class="text-gray-600 mb-2">{{ $product->description }}</p>
        <p class="text-gray-800">Price: ${{ $product->price }}</p>
        <p class="text-gray-800">Inventory Status: {{ $product->inventory_status }}</p>
      </div>
    @endforeach
  </div>
</div>
@endsection
