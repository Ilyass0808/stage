@extends('layouts.client')

@section('content')
<!-- Hero Section Premium -->
<div class="relative overflow-hidden bg-white pt-16 pb-32">
    <!-- Abstract background elements -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-[#F53003]/5 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[400px] h-[400px] bg-blue-500/5 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-12 gap-16 items-center">
            
            <!-- Left Side: Hero Text -->
            <div class="lg:col-span-7">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gray-100 border border-gray-200 mb-8 animate-fade-in-up">
                    <span class="flex h-2 w-2 rounded-full bg-[#F53003] mr-3"></span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-600">Nouvelle Collection 2026</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 leading-[0.9] tracking-tighter mb-6 animate-fade-in-up" style="animation-delay: 0.1s;">
                    L'ÉLITE DU <br>
                    <span class="text-[#F53003]">DIGITAL.</span>
                </h1>
                
                <p class="text-lg text-gray-500 max-w-lg leading-relaxed mb-10 animate-fade-in-up" style="animation-delay: 0.2s;">
                    Découvrez une sélection exclusive des technologies les plus avancées. Performance, design et innovation réunis dans une expérience unique.
                </p>
                
                <div class="flex flex-wrap gap-4 animate-fade-in-up" style="animation-delay: 0.3s;">
                    <a href="{{ route('shop.index') }}" class="btn-primary">
                        Explorer Tout
                    </a>
                    <a href="#categories" class="px-8 py-4 bg-white text-gray-900 border border-gray-200 font-black rounded-xl hover:bg-gray-50 transition-all">
                        Catégories
                    </a>
                </div>
            </div>
            
            <!-- Right Side: Hero Products -->
            <div class="lg:col-span-5 hidden lg:block">
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    @foreach($heroProducts as $index => $hp)
                    <div class="w-full sm:w-1/2 animate-fade-in-up" style="animation-delay: {{ 0.4 + ($index * 0.2) }}s;">
                        <div class="bg-white border border-gray-100 p-4 rounded-[2rem] shadow-xl hover:shadow-2xl transition-all transform hover:-translate-y-2">
                            <div class="aspect-square bg-gray-50 rounded-2xl flex items-center justify-center p-4 mb-4 overflow-hidden">
                                <img src="{{ Storage::url($hp->image) }}" alt="{{ $hp->name }}" class="max-h-full object-contain">
                            </div>
                            <div class="px-1 text-center">
                                <div class="text-[8px] font-black text-[#F53003] uppercase tracking-widest mb-1">{{ $hp->category->name }}</div>
                                <div class="text-xs font-black text-gray-900 truncate mb-1">{{ $hp->name }}</div>
                                <div class="text-sm font-black text-gray-900 mb-4">{{ number_format($hp->price, 2) }} DHS</div>
                                <a href="{{ route('shop.show', $hp) }}" class="inline-block w-full py-2 bg-gray-900 text-white text-[10px] font-black uppercase rounded-lg hover:bg-[#F53003] transition-colors">
                                    Détails
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Category Navigation -->
<div id="categories" class="bg-gray-50 py-24 border-y border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-[10px] font-black text-[#F53003] tracking-[0.4em] uppercase mb-4">Navigation Rapide</h2>
            <h3 class="text-4xl font-black text-gray-900 tracking-tight">Parcourir par <span class="text-gray-400 italic">Univers</span></h3>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
            <a href="{{ route('shop.index', ['category' => $category->id]) }}" class="group bg-white border border-gray-200 p-6 rounded-2xl text-center hover:border-[#F53003] hover:shadow-lg hover:shadow-[#F53003]/5 transition-all transform hover:-translate-y-1">
                <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-[#F53003]/10 transition-colors">
                    <svg class="w-8 h-8 text-gray-400 group-hover:text-[#F53003] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @php
                            $icons = [
                                'Ordinateurs' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                                'Smartphones' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                                'Tablettes' => 'M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                                'Audio' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3',
                                'Périphériques' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                                'Composants PC' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z'
                            ];
                        @endphp
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icons[$category->name] ?? 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4' }}"></path>
                    </svg>
                </div>
                <div class="font-black text-gray-900 text-sm mb-1">{{ $category->name }}</div>
                <div class="text-[10px] text-gray-400 font-bold uppercase">{{ $category->products_count }} Articles</div>
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Trust Highlights -->
<div class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-12">
            <div class="flex items-start gap-6">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <h4 class="font-black text-gray-900 mb-2">Qualité Certifiée</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Chaque produit est rigoureusement testé pour garantir une performance optimale et une durabilité accrue.</p>
                </div>
            </div>
            <div class="flex items-start gap-6">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-black text-gray-900 mb-2">Livraison Express</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Expédition prioritaire sous 24h/48h partout au Maroc avec suivi en temps réel de votre commande.</p>
                </div>
            </div>
            <div class="flex items-start gap-6">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <div>
                    <h4 class="font-black text-gray-900 mb-2">Paiement Sécurisé</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Transactions 100% sécurisées via les protocoles les plus récents ou paiement à la livraison.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products Selection Section -->
<div class="bg-gray-50 py-20 border-t border-gray-100 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-16">
            <div>
                <h2 class="text-[10px] font-black text-[#F53003] tracking-[0.4em] uppercase mb-4">Premium Selection</h2>
                <h3 class="text-5xl font-black text-gray-900 tracking-tighter">
                    LES <span class="text-[#F53003]">INCONTOURNABLES.</span>
                </h3>
            </div>
            <a href="{{ route('shop.index') }}" class="mt-8 sm:mt-0 text-gray-900 font-black uppercase tracking-[0.2em] text-[10px] flex items-center bg-white px-8 py-4 rounded-2xl border border-gray-200 hover:bg-[#F53003] hover:text-white hover:border-[#F53003] transition-all transform hover:-translate-y-1 shadow-sm">
                Catalogue Complet <svg class="ml-3 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @foreach($products as $product)
                @include('client.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</div>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}
.animate-float {
    animation: float 6s ease-in-out infinite;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
}
</style>
@endsection

