@extends('layouts.client')

@section('content')
<div class="show-container">
    <!-- Image Side -->
    <div class="show-image-side">
        <div style="position: relative; width: 100%;">
            @if($product->is_new)
                <div class="badge badge-new" style="position: absolute; top: -1rem; left: -1rem; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">Nouveau</div>
            @endif
            
            @if($product->image)
                <img id="main-product-image" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
            @else
                <div style="height: 300px; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 5rem; height: 5rem; color: #e5e7eb;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
            @endif

            @if($product->images->count() > 1)
                <div style="display: flex; gap: 1rem; margin-top: 2rem; justify-content: center;">
                    @foreach($product->images as $img)
                        <button onclick="changeMainImage('{{ Storage::url($img->image_path) }}')" style="width: 4rem; height: 4rem; padding: 0.5rem; background: white; border: 2px solid #f3f4f6; border-radius: 1rem; cursor: pointer;">
                            <img src="{{ Storage::url($img->image_path) }}" style="width: 100%; height: 100%; object-contain;">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Content Side -->
    <div class="show-content-side">
        <div class="product-category">{{ $product->category->name }}</div>
        <h1 class="show-title">{{ $product->name }}</h1>
        <div class="show-price">{{ number_format($product->price, 2) }} <span style="font-size: 1rem; color: #9ca3af; font-weight: 500;">DHS</span></div>
        
        <div class="show-desc">
            {{ $product->description ?: 'Aucune description disponible pour ce produit.' }}
        </div>

        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem;">
            <div style="width: 0.75rem; height: 0.75rem; border-radius: 50%; background: {{ $product->stock > 0 ? '#10b981' : '#ef4444' }};"></div>
            <span style="font-size: 0.8rem; font-weight: 800; color: {{ $product->stock > 0 ? '#10b981' : '#ef4444' }}; text-transform: uppercase; letter-spacing: 0.1em;">
                {{ $product->stock > 0 ? $product->stock . ' Unités disponibles' : 'Rupture de stock' }}
            </span>
        </div>

        @if($product->stock > 0)
        <form action="{{ route('cart.add', $product) }}" method="POST" class="quantity-form">
            @csrf
            <div class="input-group">
                <label for="quantity">Quantité</label>
                <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->stock }}" value="1" class="input-field">
            </div>
            <button type="submit" class="btn-add">
                Ajouter au Panier
            </button>
        </form>
        @endif
    </div>
</div>

<div style="max-width: 80rem; margin: 8rem auto; padding: 0 2rem;">
    <h3 style="font-size: 2rem; font-weight: 900; margin-bottom: 3rem;">Produits <span style="color: var(--primary);">Similaires</span></h3>
    <div class="grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1">
        @php
            $related = \App\Models\Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(4)->get();
        @endphp
        @foreach($related as $rel)
            @include('client.partials.product-card', ['product' => $rel])
        @endforeach
    </div>
</div>

<script>
    function changeMainImage(src) {
        const mainImg = document.getElementById('main-product-image');
        if (mainImg) {
            mainImg.style.opacity = '0';
            setTimeout(() => {
                mainImg.src = src;
                mainImg.style.opacity = '1';
            }, 200);
        }
    }
</script>
@endsection
