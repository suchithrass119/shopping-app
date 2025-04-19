<x-app-layout>
    <x-slot name="header">
        <h2>Add Product</h2>
    </x-slot>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <p>Name: <input type="text" name="name" value="{{ old('name') }}"></p>
        <p>Price: <input type="number" name="price" step="0.01" value="{{ old('price') }}"></p>
        <p>Description: <textarea name="description">{{ old('description') }}</textarea></p>
        <p>Image: <input type="file" name="image"></p>
        <button type="submit">Save</button>
    </form>
</x-app-layout>
