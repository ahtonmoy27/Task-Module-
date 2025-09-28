
      @if ($products)
    @foreach ($products as $product)
    <div class="card" style="width: 18rem;">
          @if(!empty($product->image))
                <a href="{{ route('product.details', ['slug' => $product->slug]) }}">
                    <img src="{{ asset('img/products/' . $product->image) }}" 
                        class="card-img-top" 
                        style="height: 250px; object-fit: cover;" 
                        alt="Product Image">
                </a>
          @endif
        <div class="card-body">
          <h5 class="card-title">
            
            {{-- {{ $product->name }} --}}

             <a href="#" class="text-decoration-none">
                        {{ $product->name }}
           </a>
        
        </h5>
          <p class="card-text">
                <span class="text-muted text-decoration-line-through me-2">${{ number_format($product->old_price, 2) }}</span>
                <span class="text-danger fw-bold">${{ number_format($product->new_price, 2) }}</span>
         </p>
        </div>
      </div>




    @endforeach
@else
    <tr>
        <td colspan="5">No product Found</td>
    </tr>
@endif