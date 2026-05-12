@extends('layouts.client')

@section('content')
<style>
    .hero-mesh {
        background: radial-gradient(at 0% 0%, rgba(245, 48, 3, 0.15) 0px, transparent 50%),
                    radial-gradient(at 100% 0%, rgba(29, 0, 2, 0.4) 0px, transparent 50%);
    }
    .glass-card-premium {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .glass-card-premium:hover {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(245, 48, 3, 0.3);
        transform: translateY(-8px);
    }
    .text-gradient {
        background: linear-gradient(to right, #ffffff, #F53003);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<div class="relative overflow-hidden hero-mesh">
    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-5xl lg:text-7xl font-black text-white mb-6 tracking-tight leading-tight">
                VOTRE BOUTIQUE <span class="text-gradient">DIGITALE</span> PREMIMUM
            </h1>
            <p class="text-xl text-gray-400 mb-10 leading-relaxed font-medium">
                Découvrez une sélection exclusive de produits technologiques et accessoires avec une expérience d'achat fluide et sécurisée.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('shop.index') }}" class="px-8 py-4 bg-[#F53003] hover:bg-[#ff4d24] text-white rounded-xl font-bold text-lg shadow-2xl shadow-[#F53003]/30 transition-all transform hover:-translate-y-1">
                    Découvrir la Boutique
                </a>
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white/5 hover:bg-white/10 text-white border border-white/10 rounded-xl font-bold text-lg backdrop-blur-md transition-all transform hover:-translate-y-1">
                    Créer un Compte
                </a>
            </div>
        </div>
    </div>

    <!-- Floating Stats -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-12">
            <div class="glass-card-premium p-8 rounded-2xl text-center">
                <div class="text-3xl font-black text-[#F53003] mb-1">5K+</div>
                <div class="text-gray-500 text-sm font-bold uppercase tracking-wider">Produits</div>
            </div>
            <div class="glass-card-premium p-8 rounded-2xl text-center">
                <div class="text-3xl font-black text-[#F53003] mb-1">12K+</div>
                <div class="text-gray-500 text-sm font-bold uppercase tracking-wider">Clients</div>
            </div>
            <div class="glass-card-premium p-8 rounded-2xl text-center">
                <div class="text-3xl font-black text-[#F53003] mb-1">24/7</div>
                <div class="text-gray-500 text-sm font-bold uppercase tracking-wider">Support</div>
            </div>
            <div class="glass-card-premium p-8 rounded-2xl text-center">
                <div class="text-3xl font-black text-[#F53003] mb-1">100%</div>
                <div class="text-gray-500 text-sm font-bold uppercase tracking-wider">Sécurisé</div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-24 bg-black/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="flex-1">
                <h2 class="text-4xl font-black text-white mb-6">La Qualité <span class="text-[#F53003]">Sans Compromis</span></h2>
                <p class="text-lg text-gray-400 mb-8 leading-relaxed">
                    Nous sélectionnons rigoureusement chaque article de notre catalogue pour vous garantir une satisfaction totale. Du design à la performance, nous ne laissons rien au hasard.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-center text-white font-medium">
                        <svg class="w-6 h-6 text-[#F53003] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        Livraison express en 24/48h
                    </li>
                    <li class="flex items-center text-white font-medium">
                        <svg class="w-6 h-6 text-[#F53003] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        Garantie constructeur incluse
                    </li>
                    <li class="flex items-center text-white font-medium">
                        <svg class="w-6 h-6 text-[#F53003] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        Retours gratuits sous 30 jours
                    </li>
                </ul>
            </div>
            <div class="flex-1 relative">
                <div class="absolute inset-0 bg-[#F53003]/20 blur-[100px] rounded-full"></div>
                <div class="relative glass-card-premium p-4 rounded-3xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&q=80&w=1000" alt="Produit Premium" class="rounded-2xl w-full">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-24">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-[#1D0002] to-black border border-white/5 p-12 lg:p-20 rounded-[3rem] text-center relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#F53003]/10 blur-[80px] -mr-32 -mt-32"></div>
            <h2 class="text-4xl lg:text-5xl font-black text-white mb-8">Prêt à changer votre <br><span class="text-[#F53003]">Quotidien Digital ?</span></h2>
            <p class="text-xl text-gray-400 mb-12 max-w-2xl mx-auto font-medium">
                Rejoignez des milliers de clients satisfaits et profitez de nos offres exclusives membres.
            </p>
            <a href="{{ route('register') }}" class="inline-block px-12 py-5 bg-white text-black hover:bg-gray-200 rounded-2xl font-black text-lg transition-all transform hover:scale-105 active:scale-95 shadow-xl">
                S'inscrire Maintenant
            </a>
        </div>
    </div>
</div>

@endsection

