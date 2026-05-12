<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magasin Virtuel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #F53003;
            --dark: #1a1a1a;
            --light: #fdfdfd;
            --gray: #9ca3af;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--light) !important;
            color: var(--dark);
            margin: 0;
            line-height: 1.5;
        }
        .grid { display: grid; gap: 2rem; }
        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
        .grid-cols-12 { grid-template-columns: repeat(12, minmax(0, 1fr)); }
        .max-w-7xl { max-width: 80rem; }
        .mx-auto { margin-left: auto; margin-right: auto; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .relative { position: relative; }
        .overflow-hidden { overflow: hidden; }
        .bg-white { background-color: white !important; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-16 { gap: 4rem; }
        .gap-6 { gap: 1.5rem; }
        .gap-4 { gap: 1rem; }
        .hidden { display: none; }
        .aspect-square { aspect-ratio: 1 / 1; }
        .py-24 { padding-top: 6rem; padding-bottom: 6rem; }
        .py-20 { padding-top: 5rem; padding-bottom: 5rem; }
        .mb-16 { margin-bottom: 4rem; }
        .mb-8 { margin-bottom: 2rem; }
        .mb-4 { margin-bottom: 1rem; }
        .h-\[500px\] { height: 500px; }
        .w-\[70\%\] { width: 70%; }
        .w-\[65\%\] { width: 65%; }
        .z-20 { z-index: 20; }
        .z-10 { z-index: 10; }
        .flex-col { flex-direction: column; }
        .justify-center { justify-content: center; }
        .w-full { width: 100%; }
        .inline-block { display: inline-block; }
        @media (min-width: 640px) { 
            .sm\:flex-row { flex-direction: row; }
            .sm\:w-1\/2 { width: 50%; }
            .sm\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); } 
            .sm\:px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
        }
        @media (min-width: 1024px) { 
            .lg\:px-8 { padding-left: 2rem; padding-right: 2rem; }
            .lg\:block { display: block; }
            .lg\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); } 
            .lg\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
            .lg\:grid-cols-6 { grid-template-columns: repeat(6, minmax(0, 1fr)); }
            .lg\:grid-cols-12 { grid-template-columns: repeat(12, minmax(0, 1fr)); }
            .lg\:col-span-5 { grid-column: span 5 / span 5; }
            .lg\:col-span-6 { grid-column: span 6 / span 6; }
            .lg\:col-span-7 { grid-column: span 7 / span 7; }
            .lg\:col-span-12 { grid-column: span 12 / span 12; }
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 1.25rem 2.5rem;
            border-radius: 1rem;
            font-weight: 900;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(245, 48, 3, 0.3);
            border: none;
        }
        .btn-primary:hover { background: #ff4d24; transform: translateY(-2px); }
        
        .hero-title {
            font-size: 5rem;
            font-weight: 900;
            line-height: 0.9;
            letter-spacing: -0.05em;
            margin: 2rem 0;
        }
        @media (max-width: 768px) { .hero-title { font-size: 3rem; } }
        
        .hero-card {
            background: white;
            border-radius: 2.5rem;
            border: 1px solid #f3f4f6;
            padding: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .product-card {
            background: white;
            border-radius: 1.5rem;
            border: 1px solid #f3f4f6;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
        .badge {
            font-size: 0.7rem;
            font-weight: 900;
            padding: 0.4rem 0.8rem;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .badge-new { background: var(--primary); color: white; }
        .badge-promo { background: var(--dark); color: white; }
        
        .product-image-container {
            height: 16rem;
            background: #f9fafb;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }
        .product-image-container img { max-height: 100%; width: auto; transition: transform 0.5s; }
        .product-card:hover .product-image-container img { transform: scale(1.1); }
        
        .product-info { padding: 2rem; flex-grow: 1; display: flex; flex-direction: column; }
        .product-category { font-size: 0.6rem; font-weight: 900; color: var(--primary); text-transform: uppercase; margin-bottom: 0.5rem; }
        .product-name { font-size: 1.25rem; font-weight: 900; color: var(--dark); text-decoration: none; margin-bottom: 1rem; display: block; }
        .product-price { font-size: 1.5rem; font-weight: 900; color: var(--dark); }
        
        .btn-cart {
            background: var(--dark);
            color: white;
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        .btn-cart:hover { background: var(--primary); transform: scale(1.1); }
        
        .details-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .product-card:hover .details-overlay { opacity: 1; }
        .btn-details {
            background: var(--dark);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 9999px;
            font-weight: 900;
            font-size: 0.7rem;
            text-transform: uppercase;
            text-decoration: none;
        }

        /* Navbar Fallback */
        .navbar {
            background: white;
            border-bottom: 1px solid #f3f4f6;
            height: 4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        .nav-container {
            width: 100%;
            max-width: 80rem;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: 900;
            text-decoration: none;
            letter-spacing: -0.05em;
        }
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        .nav-link {
            text-decoration: none;
            color: #4b5563;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        .nav-link:hover { color: var(--primary); }
        .btn-register {
            background: var(--primary);
            color: white !important;
            padding: 0.6rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 700;
            text-decoration: none;
            font-size: 0.9rem;
            box-shadow: 0 4px 6px -1px rgba(245, 48, 3, 0.2);
        }

        /* Product Show Fallback */
        .show-container {
            max-width: 80rem;
            margin: 4rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr;
            gap: 4rem;
        }
        @media (min-width: 1024px) { .show-container { grid-template-columns: 1fr 1fr; } }
        
        .show-image-side {
            background: #f9fafb;
            border-radius: 2rem;
            padding: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .show-image-side img { max-width: 100%; height: auto; border-radius: 1.5rem; }
        
        .show-content-side { display: flex; flex-direction: column; justify-content: center; }
        .show-title { font-size: 3.5rem; font-weight: 900; color: var(--dark); margin: 1rem 0; line-height: 1.1; }
        .show-price { font-size: 2.5rem; font-weight: 900; color: var(--dark); margin-bottom: 2rem; }
        .show-desc { font-size: 1.1rem; color: #4b5563; line-height: 1.7; margin-bottom: 3rem; }
        
        .quantity-form {
            display: flex;
            gap: 1.5rem;
            align-items: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #f3f4f6;
        }
        .input-group { display: flex; flex-direction: column; gap: 0.5rem; }
        .input-group label { font-size: 0.7rem; font-weight: 900; text-transform: uppercase; color: #9ca3af; }
        .input-field {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 1rem;
            border-radius: 1rem;
            font-weight: 700;
            font-size: 1.1rem;
            width: 8rem;
        }
        .btn-add {
            flex-grow: 1;
            background: var(--dark);
            color: white;
            padding: 1.25rem;
            border-radius: 1rem;
            font-weight: 900;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-add:hover { background: var(--primary); transform: translateY(-2px); }
        /* Modern Pagination Styles */
        .pagination-container nav {
            display: flex;
            justify-content: center;
            padding: 2rem 0;
        }
        .pagination-container nav div:first-child { display: none; } /* Hide the 'Showing X to Y' text */
        .pagination-container nav div:last-child { display: flex !important; gap: 0.5rem; }
        
        .pagination-container a, 
        .pagination-container span[aria-current="page"] span,
        .pagination-container span[aria-disabled="true"] span {
            min-width: 3rem;
            height: 3rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            background: white;
            border: 1px solid #f3f4f6;
            color: var(--dark);
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        
        .pagination-container a:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .pagination-container span[aria-current="page"] span {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .pagination-container svg { width: 1.25rem; height: 1.25rem; }

        /* Ensure card visibility */
        .product-card {
            background: white !important;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05) !important;
        }
    </style>
</head>
<body class="bg-[#fdfdfd] text-[#1a1a1a] antialiased font-sans flex flex-col min-h-screen">
    <nav class="navbar">
        <div class="nav-container">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo">
                <span style="color: var(--primary);">VIRTUAL</span><span style="color: var(--dark);">STORE</span>
            </a>
            
            <!-- Links -->
            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link">Accueil</a>
                <a href="{{ route('shop.index') }}" class="nav-link">Boutique</a>
                
                <a href="{{ route('cart.index') }}" class="nav-link" style="position: relative;">
                    Panier 
                    @php $cartQty = array_sum(array_column(session('cart', []), 'quantity')); @endphp
                    @if($cartQty > 0)
                        <span style="position: absolute; top: -10px; right: -15px; background: var(--primary); color: white; font-size: 10px; padding: 2px 6px; border-radius: 10px;">{{ $cartQty }}</span>
                    @endif
                </a>

                @auth
                    <a href="{{ route('wishlist.index') }}" class="nav-link">Favoris</a>
                    <a href="{{ route('orders.index') }}" class="nav-link">Commandes</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                        @csrf
                        <button type="submit" class="nav-link flex items-center group transition-all" style="background: none; border: none; padding: 0; cursor: pointer;">
                            <span class="mr-1.5 group-hover:text-[#F53003]">Déconnexion</span>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-[#F53003] transform group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                    <a href="{{ route('register') }}" class="btn-register">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 mb-4 mx-auto max-w-7xl mt-6 rounded-xl shadow-lg backdrop-blur-md animate-fade-in" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 mb-4 mx-auto max-w-7xl mt-6 rounded-xl shadow-lg backdrop-blur-md animate-fade-in" role="alert">
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-black border-t border-white/5 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 gap-6">
                <div class="font-medium text-gray-400">&copy; {{ date('Y') }} <span class="text-[#F53003]">VirtualStore</span>. Tous droits réservés.</div>
                <div class="flex space-x-8">
                    <a href="#" class="hover:text-white transition-colors duration-300">Politique de confidentialité</a>
                    <a href="#" class="hover:text-white transition-colors duration-300">CGV</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
