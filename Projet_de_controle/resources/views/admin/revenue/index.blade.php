@extends('layouts.admin')

@section('page_title', 'Chiffre d\'Affaires')
@section('page_icon')
<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
    <!-- Revenue Card -->
    <div class="bg-white rounded-2xl border border-gray-100 p-8 relative overflow-hidden group shadow-sm hover:shadow-xl hover:shadow-[#F53003]/5 transition-all border-t-4 border-t-[#F53003]">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#F53003]/5 rounded-full blur-3xl group-hover:bg-[#F53003]/10 transition-colors"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
                <div style="background-color: #F53003 !important;" class="p-3 rounded-xl text-white shadow-lg shadow-[#F53003]/20">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                </div>
                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Global</span>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Chiffre d'Affaires</p>
            <h2 class="text-4xl font-black text-gray-900 tracking-tighter leading-none">{{ number_format($totalRevenue, 2) }} <span class="text-xs text-gray-400 ml-1">DHS</span></h2>
        </div>
    </div>

    <!-- Balance Card -->
    <div class="bg-white rounded-2xl border border-gray-100 p-8 relative overflow-hidden group shadow-sm hover:shadow-xl hover:shadow-emerald-500/5 transition-all border-t-4 border-t-emerald-500">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-50 rounded-full blur-3xl group-hover:bg-emerald-100 transition-colors"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
                <div style="background-color: #10b981 !important;" class="p-3 rounded-xl text-white shadow-lg shadow-emerald-500/20">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <span class="text-[9px] font-black text-emerald-500 bg-emerald-50 px-2 py-1 rounded-md uppercase tracking-widest">Disponible</span>
            </div>
            <h2 class="text-4xl font-black text-gray-900 tracking-tighter leading-none mb-6">{{ number_format($balance, 2) }} <span class="text-xs text-gray-400 ml-1">DHS</span></h2>
            <button onclick="document.getElementById('withdraw-modal').classList.remove('hidden')" 
                    style="background-color: #F53003 !important;"
                    class="w-full text-white px-6 py-4 rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-black transition-all transform hover:scale-[1.02] active:scale-95 shadow-lg shadow-[#F53003]/10">
                Demander un retrait
            </button>
        </div>
    </div>

    <!-- Total Withdrawals -->
    <div class="bg-white rounded-2xl border border-gray-100 p-8 relative overflow-hidden group shadow-sm hover:shadow-xl hover:shadow-amber-500/5 transition-all border-t-4 border-t-amber-500">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-50 rounded-full blur-3xl group-hover:bg-amber-100 transition-colors"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-6">
                <div style="background-color: #f59e0b !important;" class="p-3 rounded-xl text-white shadow-lg shadow-amber-500/20">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Total Retiré</span>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Paiements Sortants</p>
            <h2 class="text-4xl font-black text-gray-900 tracking-tighter leading-none">{{ number_format($totalWithdrawn, 2) }} <span class="text-xs text-gray-400 ml-1">DHS</span></h2>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Transactions -->
    <div class="bg-white rounded-[2.5rem] border border-gray-100 p-10 shadow-sm">
        <h3 class="text-xl font-black text-gray-900 mb-8 tracking-tight uppercase border-l-4 border-[#F53003] pl-4">Transactions Récentes</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] border-b border-gray-50">
                        <th class="pb-6">Client</th>
                        <th class="pb-6">Montant</th>
                        <th class="pb-6 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50 transition-colors cursor-pointer group" onclick="window.location='{{ route('admin.orders.show', $order) }}'">
                            <td class="py-6">
                                <div class="text-base font-black text-gray-900 group-hover:text-[#F53003] transition-colors leading-tight capitalize">{{ $order->first_name }} {{ $order->last_name }}</div>
                                <div class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-1">{{ $order->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="py-6">
                                <div class="text-lg font-black text-gray-900 tracking-tighter">{{ number_format($order->total, 2) }} <span class="text-[10px] text-gray-400">DHS</span></div>
                            </td>
                            <td class="py-6 text-right">
                                <svg class="w-5 h-5 ml-auto text-gray-300 group-hover:text-[#F53003] group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-12 text-center text-gray-400 text-xs font-black uppercase tracking-widest italic">Aucune transaction enregistrée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Monthly Summary -->
    <div class="bg-white rounded-[2.5rem] border border-gray-100 p-10 shadow-sm">
        <h3 class="text-xl font-black text-gray-900 mb-8 tracking-tight uppercase border-l-4 border-[#F53003] pl-4">Historique Mensuel</h3>
        <div class="space-y-8">
            @foreach($monthlyRevenue as $item)
                <div class="flex items-center justify-between group">
                    <div class="flex items-center">
                        <div class="w-1.5 h-12 bg-[#F53003] rounded-full mr-6 group-hover:h-14 transition-all duration-500"></div>
                        <div>
                            <p class="font-black text-gray-900 uppercase text-sm tracking-widest">{{ $item->month }}</p>
                            <p class="text-[10px] text-gray-500 font-black uppercase mt-1 tracking-widest">Volume de ventes</p>
                        </div>
                    </div>
                    <span class="text-2xl font-black text-gray-900 tracking-tighter">{{ number_format($item->total, 2) }} <span class="text-xs text-gray-400 ml-1 font-bold">DHS</span></span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="mt-8 bg-white rounded-[2.5rem] border border-gray-100 p-10 shadow-sm overflow-hidden relative">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#F53003]/10 to-transparent"></div>
    <h3 class="text-xl font-black text-gray-900 mb-8 tracking-tight uppercase border-l-4 border-[#F53003] pl-4">Historique des Retraits</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] border-b border-gray-50">
                    <th class="pb-6">Montant</th>
                    <th class="pb-6">Méthode</th>
                    <th class="pb-6">État</th>
                    <th class="pb-6 text-right">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($withdrawals as $withdrawal)
                    <tr class="group hover:bg-gray-50 transition-colors">
                        <td class="py-6 font-black text-gray-900 text-2xl tracking-tighter">{{ number_format($withdrawal->amount, 2) }} <span class="text-xs text-gray-400 ml-1 font-bold">DHS</span></td>
                        <td class="py-6">
                            <span class="px-4 py-1.5 text-[10px] font-black bg-gray-50 text-gray-500 border border-gray-100 rounded-md uppercase tracking-widest">{{ $withdrawal->method }}</span>
                        </td>
                        <td class="py-6">
                            @if($withdrawal->status == 'en attente')
                                <span class="flex items-center text-amber-600 text-[10px] font-black uppercase tracking-widest">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 mr-2"></span> En attente
                                </span>
                            @elseif($withdrawal->status == 'complété')
                                <span class="flex items-center text-emerald-600 text-[10px] font-black uppercase tracking-widest">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2"></span> Payé
                                </span>
                            @else
                                <span class="flex items-center text-red-600 text-[10px] font-black uppercase tracking-widest">
                                    <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span> Refusé
                                </span>
                            @endif
                        </td>
                        <td class="py-6 text-right text-[10px] font-black text-gray-500 uppercase tracking-widest">{{ $withdrawal->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-gray-300 text-[10px] font-black uppercase tracking-widest italic">Aucun retrait enregistré</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Withdraw Modal -->
<div id="withdraw-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg relative overflow-hidden animate-in fade-in zoom-in duration-300">
        <!-- Accent Glow -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-[#F53003]/5 rounded-full blur-3xl"></div>
        
        <div class="p-8 relative z-10">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-black text-gray-900 tracking-tighter">Demander un <span class="text-[#F53003]">Retrait</span></h3>
                <button onclick="document.getElementById('withdraw-modal').classList.add('hidden')" class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:text-[#F53003] hover:bg-[#F53003]/10 transition-all">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <form action="{{ route('admin.revenue.withdraw') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Amount -->
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Montant (DHS)</label>
                    <div class="relative">
                        <input type="number" name="amount" step="0.01" min="100" max="{{ $balance }}" required 
                               class="w-full bg-gray-50 border border-gray-100 rounded-xl py-4 px-6 text-xl font-black text-gray-900 focus:ring-2 focus:ring-[#F53003] focus:border-transparent transition-all outline-none"
                               placeholder="0.00">
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400 uppercase">DHS</div>
                    </div>
                    <p class="text-[9px] text-gray-400 font-black uppercase mt-2 tracking-widest">Disponible: <span class="text-gray-900">{{ number_format($balance, 2) }} DHS</span></p>
                </div>

                <!-- Method -->
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Méthode de Paiement</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative flex flex-col items-center p-4 cursor-pointer rounded-xl border border-gray-100 bg-gray-50/50 hover:border-[#F53003]/30 transition-all group">
                            <input type="radio" name="method" value="paypal" checked class="sr-only peer">
                            <div class="w-full h-full absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-[#F53003] transition-all"></div>
                            <svg class="w-6 h-6 mb-2 text-gray-400 peer-checked:text-[#F53003] relative z-10 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                            <span class="font-black text-[9px] uppercase tracking-widest text-gray-500 peer-checked:text-[#F53003] relative z-10 transition-colors">PayPal</span>
                        </label>
                        <label class="relative flex flex-col items-center p-4 cursor-pointer rounded-xl border border-gray-100 bg-gray-50/50 hover:border-[#F53003]/30 transition-all group">
                            <input type="radio" name="method" value="card" class="sr-only peer">
                            <div class="w-full h-full absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-[#F53003] transition-all"></div>
                            <svg class="w-6 h-6 mb-2 text-gray-400 peer-checked:text-[#F53003] relative z-10 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            <span class="font-black text-[9px] uppercase tracking-widest text-gray-500 peer-checked:text-[#F53003] relative z-10 transition-colors">Virement</span>
                        </label>
                    </div>
                </div>

                <!-- Details -->
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Coordonnées</label>
                    <textarea name="account_details" required rows="2" 
                              class="w-full bg-gray-50 border border-gray-100 rounded-xl py-4 px-6 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-[#F53003] focus:border-transparent transition-all outline-none placeholder-gray-300 resize-none"
                              placeholder="Email PayPal ou RIB complet..."></textarea>
                </div>

                <!-- Submit -->
                <button type="submit" style="background-color: #F53003 !important;" 
                        class="w-full py-5 rounded-xl text-white font-black text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-[#F53003]/20 hover:scale-[1.02] active:scale-95 transition-all">
                    Confirmer le Retrait
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
