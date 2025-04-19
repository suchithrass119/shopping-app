
@include('public_layout.header')

        <div>
            <a href="{{ url('/cart') }}" class="btn btn-outline-light btn-sm">🛒 View Cart</a>
        </div>
    </header>

    @if(session('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">✅ {{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    <div class="container mt-4">
        <div class="row g-4">
            <div class="col-md-2">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="filter-box">
                            <h5>Categories</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Electronics</a></li>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Home Appliances</a></li>
                                <li><a href="#">Books</a></li>
                                <li><a href="#">Sports</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="filter-box">
                            <h5>Price Range</h5>
                            <form action="{{ url('/filter-products') }}" method="GET">
                                <div class="mb-2">
                                    <label for="min-price" class="form-label">Min Price</label>
                                    <input type="number" class="form-control" id="min-price" name="min-price" placeholder="₹0">
                                </div>
                                <div class="mb-2">
                                    <label for="max-price" class="form-label">Max Price</label>
                                    <input type="number" class="form-control" id="max-price" name="max-price" placeholder="₹5000">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Apply Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row g-4">
                    @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="product-card h-100">
                            <div class="product-image" style="background-image: url('{{ asset('storage/' . $product->image) }}');"></div>
                            <div class="product-details">
                                <h2>{{ $product->name }}</h2>
                                <div class="d-flex align-items-center mb-1">
                                    <span class="badge badge-custom me-2">★ 4.3</span>
                                    <small class="text-muted">(1,234 ratings)</small>
                                </div>
                                <p class="text-truncate">{{ $product->description }}</p>
                                <p class="price mt-auto mb-2">
                                    ₹{{ number_format($product->price, 2) }}
                                    <span class="text-muted text-decoration-line-through ms-2">₹{{ number_format($product->price + 300, 2) }}</span>
                                    <span class="text-danger fw-semibold ms-2">25% off</span>
                                </p>
                                <a href="{{ url('/add-to-cart/' . $product->id) }}" class="btn-add-to-cart">🛍 Add to Cart</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@include('public_layout.footer')
