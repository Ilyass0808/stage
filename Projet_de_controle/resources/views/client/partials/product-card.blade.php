<div class="product-card group bg-transparent border-none shadow-none hover:transform-none">
    <!-- Image Section -->
    <div class="relative aspect-square overflow-hidden bg-gray-50 rounded-[2.5rem] flex items-center justify-center p-12 group-hover:bg-gray-100/30 transition-all duration-500">
        <!-- Badges -->
        <div class="absolute top-5 left-5 z-20">
            @if($product->is_new)
                <span style="background-color: #F53003 !important; color: white !important;" class="text-white text-[9px] font-black px-4 py-2 rounded-full uppercase tracking-[0.2em] shadow-xl shadow-[#F53003]/30 border-2 border-white">Nouveau</span>
            @endif
            @if($product->stock <= 0)
                <span class="mt-2 block bg-black text-white text-[8px] font-black px-3 py-1.5 rounded-full uppercase tracking-[0.15em] shadow-lg">Épuisé</span>
            @endif
        </div>

        @if($product->image)
            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : Storage::url($product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="max-w-full max-h-full object-contain transform group-hover:scale-105 transition-transform duration-700 ease-out">
        @else
            <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        @endif
        
        <!-- Hover Detail Link -->
        <a href="{{ route('shop.show', $product) }}" class="absolute inset-0 z-10"></a>
    </div>
    
    <!-- Info Section -->
    <div class="pt-5 px-1">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[8px] font-black text-[#F53003] uppercase tracking-[0.2em]">{{ $product->category->name }}</span>
        </div>
        
        <a href="{{ route('shop.show', $product) }}" class="text-base font-black text-gray-900 group-hover:text-[#F53003] transition-colors tracking-tight block mb-3 line-clamp-1 capitalize">{{ $product->name }}</a>
        
        <div class="flex items-center justify-between gap-2">
            <div class="flex flex-col flex-grow">
                @if($product->is_promo ?? false)
                    <span class="text-[10px] text-gray-400 line-through font-bold mb-0.5">{{ number_format($product->price * 1.2, 2) }}</span>
                @endif
                <span class="text-lg font-black text-gray-900 tracking-tighter">
                    {{ number_format($product->price, 2) }} <span class="text-[8px] text-gray-400 ml-0.5">DHS</span>
                </span>
            </div>
            
            <div class="flex items-center gap-2">
                @if($product->stock > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" style="background-color: #F53003 !important;" class="w-10 h-10 hover:bg-black rounded-xl flex items-center justify-center text-white transition-all shadow-lg shadow-[#F53003]/20 flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </button>
                </form>
                @endif
                
                @auth
                    @php
                        $inWishlist = auth()->user()->wishlists()->where('product_id', $product->id)->exists();
                    @endphp
                    <form action="{{ $inWishlist ? route('wishlist.remove', $product) : route('wishlist.add', $product) }}" method="POST">
                        @csrf
                        @if($inWishlist) @method('DELETE') @endif
                        <button type="submit" class="w-10 h-10 rounded-xl flex items-center justify-center transition-all border flex-shrink-0 {{ $inWishlist ? 'bg-[#F53003] text-white border-[#F53003] shadow-lg shadow-[#F53003]/20' : 'bg-gray-50 text-gray-400 hover:bg-[#F53003]/10 hover:text-[#F53003] border-gray-100' }}">
                            <svg class="w-4 h-4" fill="{{ $inWishlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#F53003]/10 hover:text-[#F53003] transition-colors border border-gray-100 flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
