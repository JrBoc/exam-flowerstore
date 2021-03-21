<div>
    @if (count($flash_message))
        <div class="alert mx-4 mt-3 {{ $flash_message['type'] == 'success' ? 'text-succuss alert-success' : 'text-danger alert-danger' }}">
            <strong>{{ $flash_message['message'] }}</strong>
        </div>
    @endif
    <div class="border-top">
        <ul class="list-group list-group-flush">
            @forelse ($products as $product)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-1 d-flex justify-content-between align-items-center">
                            <img src="{{ asset('storage/' . $product->photo) }}" class="img-fluid" alt="{{ $product->name }}">
                        </div>
                        <div class="col-11 d-flex justify-content-between align-items-center">
                            <div>
                                <span class="d-block">
                                    <b>Product Name:</b> {{ $product->name }}
                                </span>
                                <span class="d-block">
                                    <b>Price:</b> {{ $product->readable_price }}
                                </span>
                                <span class="d-block">
                                    <b>Quantity:</b> {{ $product->quantity }}
                                </span>
                                <span class="d-block">
                                    <b>Description:</b> {{ $product->description }}
                                </span>
                                <small class="d-block mt-3 text-muted">
                                    <b>Uploaded By:</b> {{ $product->createdBy ? $product->createdBy->name : 'User not found' }}
                                </small>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right text-right shadow" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item btn-view" type="button" value="{{ $product->id }}">View</button>
                                        <button class="dropdown-item btn-edit" type="button" value="{{ $product->id }}">Edit</button>
                                        <button class="dropdown-item btn-delete" type="button" value="{{ $product->id }}">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li class="list-group-item text-center">
                    No Products Listed
                </li>
            @endforelse
        </ul>
    </div>
    <div class="card-body border-top">
        {{ $products->links() }}
    </div>
    <!-- Other Related Livewire Components -->
    @livewire('product.create')
    @livewire('product.edit')
</div>
