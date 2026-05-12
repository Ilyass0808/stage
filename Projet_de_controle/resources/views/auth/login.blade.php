<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-10 text-center">
        <h2 class="text-4xl font-extrabold text-white mb-3 tracking-tight">Bienvenue</h2>
        <p class="text-orange-200/50 text-sm font-medium">Connectez-vous à votre espace client</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label class="block text-xs font-bold text-white uppercase tracking-widest mb-2 ml-1">Adresse Email</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-orange-500 group-focus-within:text-white transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="votre@email.com" class="block w-full pl-10 pr-4 py-2 bg-slate-800/50 border border-slate-700/50 rounded-lg text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all outline-none">
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

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-white/10 bg-white/5 text-orange-600 shadow-sm focus:ring-orange-500 focus:ring-offset-0" name="remember">
                <span class="ms-2 text-sm text-orange-200/70">Se souvenir de moi</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-orange-400 hover:text-white transition-colors" href="{{ route('password.request') }}">
                    Oublié ?
                </a>
            @endif
        </div>

        <div class="pt-1">
            <button class="w-full py-2.5 bg-[#F53003] hover:bg-[#ff4d24] text-white text-xs font-bold rounded-lg shadow-xl shadow-[#F53003]/20 transition-all transform hover:-translate-y-0.5 active:scale-95">
                SE CONNECTER
            </button>
        </div>

        <div class="text-center">
            <p class="text-orange-200/50 text-sm">
                Pas de compte ? 
                <a href="{{ route('register') }}" class="text-white font-bold hover:underline">Inscrivez-vous</a>
            </p>
        </div>
    </form>
</x-guest-layout>
