<x-app-layout>
    <x-slot name="header">
        <h2>Edit Product</h2>
    </x-slot>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <p>Name: <input type="text" name="name" value="{{ $product->name }}"></p>
        <p>Price: <input type="number" name="price" step="0.01" value="{{ $product->price }}"></p>
        <p>Description: <textarea name="description">{{ $product->description }}</textarea></p>
        <p>Current Image: 
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" width="100">
            @endif
        </p>
        <p>New Image: <input type="file" name="image"></p>
        <button type="submit">Update</button>
    </form>
</x-app-layout>
