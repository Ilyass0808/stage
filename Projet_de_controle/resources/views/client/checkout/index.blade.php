@extends('layouts.client')

@section('content')
<div class="py-12 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-[9px] font-black text-[#F53003] tracking-[0.4em] uppercase mb-3">Finalisation</h2>
            <h1 class="text-4xl font-black text-gray-900 tracking-tight mb-6">Paiement & <span class="text-[#F53003]">Livraison</span></h1>
            <div class="inline-flex items-center gap-3 px-5 py-2.5 bg-gray-50 rounded-full border border-gray-100 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Transaction 100% Sécurisée</span>
            </div>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Info Side -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Shipping Info -->
                    <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-xl relative overflow-hidden">
                        <h2 class="text-xl font-black text-gray-900 mb-8 flex items-center tracking-tight">
                            <span style="background-color: #F53003 !important;" class="text-white w-10 h-10 rounded-xl flex items-center justify-center mr-4 text-xs font-black shadow-lg shadow-[#F53003]/20 flex-shrink-0">1</span>
                            Informations de Livraison
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2 group">
                                <label for="email" class="block text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1 transition-colors group-focus-within:text-[#F53003]">Adresse Email</label>
                                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 px-5 text-gray-900 focus:ring-2 focus:ring-[#F53003]/10 focus:border-[#F53003] transition-all outline-none font-bold text-sm">
                            </div>
                            <div class="group">
                                <label for="first_name" class="block text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1 transition-colors group-focus-within:text-[#F53003]">Prénom</label>
                                <input type="text" name="first_name" id="first_name" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 px-5 text-gray-900 focus:ring-2 focus:ring-[#F53003]/10 focus:border-[#F53003] transition-all outline-none font-bold text-sm">
                            </div>
                            <div class="group">
                                <label for="last_name" class="block text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1 transition-colors group-focus-within:text-[#F53003]">Nom</label>
                                <input type="text" name="last_name" id="last_name" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 px-5 text-gray-900 focus:ring-2 focus:ring-[#F53003]/10 focus:border-[#F53003] transition-all outline-none font-bold text-sm">
                            </div>
                            <div class="md:col-span-2 group">
                                <label for="phone" class="block text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1 transition-colors group-focus-within:text-[#F53003]">Numéro de téléphone</label>
                                <input type="tel" name="phone" id="phone" placeholder="06 XX XX XX XX" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 px-5 text-gray-900 focus:ring-2 focus:ring-[#F53003]/10 focus:border-[#F53003] transition-all outline-none font-bold text-sm">
                            </div>
                            <div class="md:col-span-2 group">
                                <label for="address" class="block text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1 transition-colors group-focus-within:text-[#F53003]">Adresse Complète</label>
                                <textarea name="address" id="address" rows="2" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 px-5 text-gray-900 focus:ring-2 focus:ring-[#F53003]/10 focus:border-[#F53003] transition-all outline-none font-bold text-sm resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-xl">
                        <h2 class="text-xl font-black text-gray-900 mb-8 flex items-center tracking-tight">
                            <span style="background-color: #F53003 !important;" class="text-white w-10 h-10 rounded-xl flex items-center justify-center mr-4 text-xs font-black shadow-lg shadow-[#F53003]/20 flex-shrink-0">2</span>
                            Mode de Paiement
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Option Cash -->
                            <div onclick="selectPayment('especes')" class="relative flex items-center justify-between p-6 cursor-pointer rounded-2xl border-2 transition-all group payment-card" id="card-especes">
                                <input type="radio" name="payment_method" value="especes" checked class="hidden" id="radio-especes">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mr-4 shadow-sm group-hover:bg-[#F53003] group-hover:text-white transition-all flex-shrink-0">
                                        <svg class="w-6 h-6 text-emerald-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                    </div>
                                    <div class="font-black text-gray-900 uppercase tracking-tight text-xs">Espèces</div>
                                </div>
                                <div class="w-6 h-6 rounded-full border-2 border-gray-200 flex items-center justify-center bg-white flex-shrink-0">
                                    <div style="background-color: #F53003 !important;" class="w-3 h-3 rounded-full transition-all opacity-0 check-dot" id="dot-especes"></div>
                                </div>
                            </div>

                            <!-- Option Card -->
                            <div onclick="selectPayment('carte')" class="relative flex items-center justify-between p-6 cursor-pointer rounded-2xl border-2 transition-all group payment-card" id="card-carte">
                                <input type="radio" name="payment_method" value="carte" class="hidden" id="radio-carte">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mr-4 shadow-sm group-hover:bg-[#F53003] group-hover:text-white transition-all flex-shrink-0">
                                        <svg class="w-6 h-6 text-[#F53003] group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                    </div>
                                    <div class="font-black text-gray-900 uppercase tracking-tight text-xs">Carte</div>
                                </div>
                                <div class="w-6 h-6 rounded-full border-2 border-gray-200 flex items-center justify-center bg-white flex-shrink-0">
                                    <div style="background-color: #F53003 !important;" class="w-3 h-3 rounded-full transition-all opacity-0 check-dot" id="dot-carte"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Fields -->
                        <div id="card-info-fields" class="hidden mt-8 space-y-6 animate-fadeIn border-t border-gray-100 pt-8">
                            <div class="group">
                                <label class="block text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Numéro de Carte</label>
                                <div class="relative">
                                    <input type="text" placeholder="0000 0000 0000 0000" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 px-5 text-gray-900 focus:ring-2 focus:ring-[#F53003]/10 focus:border-[#F53003] outline-none transition-all font-bold text-sm">
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 flex items-center gap-2 opacity-50">
                                        <img src="https://img.icons8.com/color/48/visa.png" class="h-4 w-auto">
                                        <img src="https://img.icons8.com/color/48/mastercard.png" class="h-4 w-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="group">
                                    <label class="block text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Expiration</label>
                                    <input type="text" placeholder="MM/YY" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 px-5 text-gray-900 focus:ring-2 focus:ring-[#F53003]/10 focus:border-[#F53003] outline-none font-bold text-sm">
                                </div>
                                <div class="group">
                                    <label class="block text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">CVV</label>
                                    <input type="text" placeholder="123" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 px-5 text-gray-900 focus:ring-2 focus:ring-[#F53003]/10 focus:border-[#F53003] outline-none font-bold text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Side -->
                <div class="lg:col-span-5">
                    <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-xl sticky top-24">
                        <h2 class="text-xl font-black text-gray-900 mb-8 tracking-tight flex items-center gap-2">
                            Récapitulatif <span style="background-color: #F53003 !important;" class="w-1.5 h-1.5 rounded-full"></span>
                        </h2>
                        
                        <div class="divide-y divide-gray-50 mb-8 border-b border-gray-50">
                            @foreach($cart as $id => $item)
                                <div class="py-4 flex items-center justify-between group">
                                    <div class="min-w-0 flex-1 pr-4">
                                        <div class="font-black text-gray-900 group-hover:text-[#F53003] transition-colors leading-tight mb-1 truncate text-sm">{{ $item['name'] }}</div>
                                        <div class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Quantité: {{ $item['quantity'] }}</div>
                                    </div>
                                    <div class="font-black text-gray-900 tracking-tighter text-sm whitespace-nowrap">{{ number_format($item['price'] * $item['quantity'], 2) }} <span class="text-[8px] text-gray-400 font-bold ml-1">DHS</span></div>
                                </div>
                            @endforeach
                        </div>

                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between items-center text-[9px] font-black text-gray-400 uppercase tracking-widest">
                                <span>Sous-total</span>
                                <span class="text-gray-900 text-sm">{{ number_format($total, 2) }} DHS</span>
                            </div>
                            <div class="flex justify-between items-center text-[9px] font-black text-gray-400 uppercase tracking-widest">
                                <span>Livraison</span>
                                <span class="text-emerald-500">Gratuite</span>
                            </div>
                            <div class="flex justify-between items-center pt-6 mt-2 border-t border-gray-50">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">Total</span>
                                <span class="text-3xl font-black text-gray-900 tracking-tighter">{{ number_format($total, 2) }} <span class="text-[10px] text-gray-400 font-bold ml-1">DHS</span></span>
                            </div>
                        </div>

                        <button type="submit" style="background-color: #F53003 !important;" class="w-full text-white font-black py-5 rounded-2xl shadow-xl shadow-[#F53003]/20 hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center text-[10px] uppercase tracking-widest">
                            <span>Confirmer l'Achat</span>
                            <svg class="ml-3 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .payment-card {
        border-color: #f3f4f6; /* gray-100 */
        background-color: rgba(249, 250, 251, 0.5); /* gray-50/50 */
    }
    .payment-card.active {
        border-color: #F53003;
        background-color: rgba(245, 48, 3, 0.05);
    }
    .payment-card.active .check-dot {
        opacity: 1;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
</style>

<script>
    function selectPayment(method) {
        const radio = document.getElementById('radio-' + method);
        if (radio) radio.checked = true;

        document.querySelectorAll('.payment-card').forEach(card => {
            card.classList.remove('active');
        });
        document.getElementById('card-' + method).classList.add('active');

        const cardFields = document.getElementById('card-info-fields');
        if (method === 'carte') {
            cardFields?.classList.remove('hidden');
        } else {
            cardFields?.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const checkedRadio = document.querySelector('input[name="payment_method"]:checked');
        if (checkedRadio) {
            selectPayment(checkedRadio.value);
        }
    });
</script>

@endsection
