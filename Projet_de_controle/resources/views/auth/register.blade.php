<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-4xl font-extrabold text-white mb-3 tracking-tight">Inscription</h2>
        <p class="text-orange-200/50 text-sm font-medium">Rejoignez VirtualStore dès aujourd'hui</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label class="block text-xs font-bold text-white uppercase tracking-widest mb-2 ml-1">Nom Complet</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-orange-500 group-focus-within:text-white transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Ahmed Alaoui" class="block w-full pl-10 pr-4 py-2 bg-slate-800/50 border border-slate-700/50 rounded-lg text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all outline-none">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label class="block text-xs font-bold text-white uppercase tracking-widest mb-2 ml-1">Adresse Email</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-orange-500 group-focus-within:text-white transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="votre@email.com" class="block w-full pl-10 pr-4 py-2 bg-slate-800/50 border border-slate-700/50 rounded-lg text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all outline-none">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label class="block text-xs font-bold text-white uppercase tracking-widest mb-2 ml-1">Mot de passe</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-orange-500 group-focus-within:text-white transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>
                <input id="password" type="password" name="password" required placeholder="••••••••" class="block w-full pl-10 pr-4 py-2 bg-slate-800/50 border border-slate-700/50 rounded-lg text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all outline-none">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-xs font-bold text-white uppercase tracking-widest mb-2 ml-1">Confirmer</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-orange-500 group-focus-within:text-white transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.040L3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622l-.382-3.016z" /></svg>
                </div>
                <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••" class="block w-full pl-10 pr-4 py-2 bg-slate-800/50 border border-slate-700/50 rounded-lg text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all outline-none">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button class="w-full py-2.5 bg-[#F53003] hover:bg-[#ff4d24] text-white text-xs font-bold rounded-lg shadow-xl shadow-[#F53003]/20 transition-all transform hover:-translate-y-0.5 active:scale-95">
                CRÉER MON COMPTE
            </button>
        </div>

        <div class="text-center">
            <p class="text-orange-200/50 text-sm">
                Déjà inscrit ? 
                <a href="{{ route('login') }}" class="text-white font-bold hover:underline">Connectez-vous</a>
            </p>
        </div>
    </form>
</x-guest-layout>
