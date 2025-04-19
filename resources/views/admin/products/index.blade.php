<x-app-layout>
    <x-slot name="header">
        <h2>All Products</h2>
        <a href="{{ route('products.create') }}">➕ Add Product</a>
    </x-slot>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Name</th><th>Price</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>₹{{ $product->price }}</td>
                <td>
                    <a href="{{ route('products.edit', $product) }}">✏️ Edit</a> |
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this product?')">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>
