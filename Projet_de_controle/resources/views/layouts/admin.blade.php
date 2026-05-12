<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - VirtualStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f9fafb; color: #111827; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f9fafb; }
        ::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #d1d5db; }
    </style>
</head>
<body class="antialiased">
    <div class="flex h-screen overflow-hidden bg-gray-50">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col hidden md:flex z-50">
            <div class="p-6 mb-2">
                <div class="flex items-center space-x-3 group">
                    <div style="background-color: #F53003 !important;" class="p-2 rounded-xl shadow-lg shadow-[#F53003]/20 group-hover:rotate-12 transition-transform duration-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <span class="text-lg font-black tracking-tighter text-gray-900 uppercase">Admin<span class="text-[#F53003]">Panel</span></span>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto pt-2">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.3em] mb-4 ml-4 opacity-50">Principal</p>
                
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'label' => 'Tableau de bord', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                        ['route' => 'admin.categories.index', 'label' => 'Catégories', 'icon' => 'M4 6h16M4 10h16M4 14h16M4 18h16'],
                        ['route' => 'admin.products.index', 'label' => 'Produits', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                        ['route' => 'admin.orders.index', 'label' => 'Commandes', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                        ['route' => 'admin.revenue.index', 'label' => 'Revenus', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['route' => 'admin.users.index', 'label' => 'Utilisateurs', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php $isActive = request()->routeIs($item['route'] . '*'); @endphp
                    <a href="{{ route($item['route']) }}" 
                       @if($isActive) style="background-color: #F53003 !important;" @endif
                       class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 group relative {{ $isActive ? 'text-white shadow-lg shadow-[#F53003]/20' : 'text-gray-400 hover:bg-gray-50 hover:text-gray-900 hover:translate-x-1' }}">
                        
                        @if($isActive)
                            <div class="absolute left-0 w-1 h-4 bg-white rounded-full"></div>
                        @endif

                        <svg class="w-5 h-5 transition-transform {{ $isActive ? 'scale-110' : 'group-hover:scale-110' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $item['icon'] }}"></path>
                        </svg>
                        
                        <span class="font-black text-[10px] uppercase tracking-widest">{{ $item['label'] }}</span>
                        
                        @if(!$isActive)
                            <div class="absolute right-4 w-1 h-1 bg-[#F53003] rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        @endif
                    </a>
                @endforeach
            </nav>

            <div class="p-6 mt-auto border-t border-gray-50 bg-gray-50/30 space-y-1">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-400 hover:bg-gray-100 hover:text-gray-900 transition-all group">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-black text-[9px] uppercase tracking-widest">Voir Boutique</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex w-full items-center space-x-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-50 hover:text-red-600 transition-all group">
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="font-black text-[9px] uppercase tracking-widest">Déconnexion</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col bg-[#fdfdfd] overflow-hidden relative">
            <!-- Top Header -->
            <header class="h-20 flex items-center justify-between px-8 border-b border-gray-100 z-40 bg-white/80 backdrop-blur-xl">
                <div class="flex items-center space-x-4">
                    <div class="p-2.5 bg-gray-50 rounded-xl border border-gray-100 text-[#F53003] shadow-sm">
                        @yield('page_icon')
                    </div>
                    <div>
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-0.5">Administration</p>
                        <h1 class="text-xl font-black text-gray-900 tracking-tight">@yield('page_title', "Console Admin")</h1>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-0.5">Session Active</p>
                        <p class="text-xs font-black text-gray-900 leading-tight capitalize">{{ auth()->user()->name }}</p>
                    </div>
                    <div style="background-color: #F53003 !important;" class="h-10 w-10 rounded-xl text-white flex items-center justify-center font-black shadow-lg shadow-[#F53003]/20 text-lg border-2 border-white">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>
            
            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto p-10 bg-gray-50/20">
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 p-6 mb-8 rounded-[1.5rem] flex items-center animate-fade-in-up shadow-sm" role="alert">
                        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="font-black text-[10px] uppercase tracking-widest">{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-50 border border-red-100 text-red-600 p-6 mb-8 rounded-[1.5rem] flex items-center animate-fade-in-up shadow-sm" role="alert">
                        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="font-black text-[10px] uppercase tracking-widest">{{ session('error') }}</span>
                    </div>
                @endif
                
                <div class="animate-fade-in-up">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>
