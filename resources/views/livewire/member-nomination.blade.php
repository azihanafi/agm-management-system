<div class="max-w-full mx-auto px-4 md:px-10 lg:px-20 mt-10">
    <div class="text-center mb-16">
        <div class="inline-flex items-center justify-center w-24 h-24 bg-indigo-600 rounded-[2.5rem] mb-6 shadow-[0_20px_50px_rgba(79,70,229,0.4)] border-4 border-white/10">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </div>
        <h2 class="text-5xl font-black tracking-tighter text-white uppercase italic">AGM 2026 NOMINATION</h2>
        <p class="text-gray-400 text-xl mt-4 max-w-3xl mx-auto font-medium leading-relaxed">
            @if($isIdentified)
                Choose your preferred candidates for each position individually below.
            @else
                Please verify your identity to proceed with the nomination process.
            @endif
        </p>
    </div>

    @if(!$isIdentified)
        <!-- Identity Verification Gate -->
        <div class="max-w-md mx-auto bg-[#1a1a1e] border border-white/10 rounded-[3rem] p-10 shadow-2xl animate-in fade-in zoom-in duration-500">
            <div class="text-center mb-10">
                <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-white/10">
                    <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-white uppercase tracking-tight">Verify Identity</h3>
                <p class="text-gray-500 text-sm mt-2">Enter your Staff ID to unlock the nomination ballot</p>
            </div>

            <form wire:submit="verifyId" class="space-y-8">
                <div class="space-y-4">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] ml-6 block">Your Staff ID</label>
                    <input wire:model="verificationId" 
                           type="text" 
                           placeholder="Enter Staff ID..."
                           class="w-full bg-black/40 border-2 border-white/10 rounded-2xl px-8 py-5 text-2xl font-black text-center text-indigo-400 outline-none focus:border-indigo-500 transition-all placeholder:text-gray-800">
                    @error('verificationId') <span class="text-red-500 text-xs font-bold text-center block">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-white py-6 rounded-2xl font-black text-base uppercase tracking-[0.3em] transition-all duration-500 text-white hover:text-indigo-600 shadow-2xl shadow-indigo-500/20 active:scale-[0.98]">
                    Unlock Ballot
                </button>
            </form>

            <div class="mt-10 text-center">
                <a href="{{ route('attendance.scan') }}" class="text-[10px] font-black text-gray-600 uppercase tracking-widest hover:text-white transition-colors">
                    Cancel and Return
                </a>
            </div>
        </div>
    @else
        <!-- Nomination Ballot (The Grid) -->
        @if ($message)
            <div x-data="{ show: true }" 
                 x-init="setTimeout(() => { show = false; $wire.set('message', '') }, 5000)"
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-10"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform translate-y-10"
                 class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[100] w-full max-w-2xl px-6">
                <div class="px-10 py-6 {{ str_contains($message, 'error') || str_contains($message, 'already') ? 'bg-red-600 shadow-red-500/20' : 'bg-green-600 shadow-green-500/20' }} rounded-[2.5rem] shadow-2xl text-white font-black flex items-center justify-between gap-6 border-4 border-white/20">
                    <div class="flex items-center gap-6">
                        @if(str_contains($message, 'error') || str_contains($message, 'already'))
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        @else
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        @endif
                        <span class="text-xl uppercase tracking-wide">{{ str_replace('error: ', '', $message) }}</span>
                    </div>
                    <button @click="show = false; $wire.set('message', '')" class="opacity-50 hover:opacity-100 transition-opacity bg-white/10 p-3 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        @endif

        <div class="space-y-24 {{ $nominationStatus !== 'open' ? 'opacity-40 pointer-events-none' : '' }}">
            <!-- Section 1: Pending Action -->
            <div class="space-y-10">
                <div class="flex items-center justify-between mb-8 px-6">
                    <h3 class="text-3xl font-black text-white uppercase italic tracking-tighter flex items-center gap-6">
                        <span class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center italic text-xl shadow-[0_15px_40px_rgba(79,70,229,0.4)]">01</span>
                        Pending Action
                    </h3>
                    <div class="flex items-center gap-4">
                        <span class="px-6 py-3 bg-white/5 border border-white/10 rounded-2xl text-xs font-black text-gray-500 uppercase tracking-[0.2em]">
                            {{ $openPositions->count() }} Categories Left
                        </span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($openPositions as $pos)
                        @include('livewire.nomination-card', ['pos' => $pos])
                    @endforeach
                    @if($openPositions->isEmpty())
                        <div class="col-span-full p-24 bg-green-500/5 border-2 border-dashed border-green-500/20 rounded-[4rem] text-center">
                            <div class="w-20 h-20 bg-green-500 rounded-[2.5rem] flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-green-500/40">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h4 class="text-3xl font-black text-white uppercase italic">All Choices Finalized</h4>
                            <p class="text-gray-500 font-bold mt-4 text-sm uppercase tracking-[0.3em]">You have successfully completed the nomination process for all categories.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Divider -->
            @if($completedPositions->isNotEmpty())
                <div class="relative py-10">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-white/5"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-10 bg-[#0a0a0c] text-[10px] font-black text-gray-700 uppercase tracking-[1em]">Finalized Section</span>
                    </div>
                </div>
            @endif

            <!-- Section 2: Completed Nominations -->
            @if($completedPositions->isNotEmpty())
                <div class="space-y-10">
                    <div class="flex items-center justify-between mb-8 px-6">
                        <h3 class="text-3xl font-black text-white uppercase italic tracking-tighter flex items-center gap-6">
                            <span class="w-14 h-14 bg-green-600 rounded-2xl flex items-center justify-center italic text-xl shadow-[0_15px_40px_rgba(22,163,74,0.4)]">02</span>
                            Completed
                        </h3>
                        <span class="px-6 py-3 bg-green-500/10 border border-green-500/20 rounded-2xl text-xs font-black text-green-500 uppercase tracking-[0.2em]">
                            {{ $completedPositions->count() }} Nominations Saved
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach($completedPositions as $pos)
                            @include('livewire.nomination-card', ['pos' => $pos])
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
>

        @if($nominationStatus !== 'open')
            <div class="mt-20 p-16 bg-red-500/10 border-2 border-red-500/20 rounded-[4rem] text-center backdrop-blur-2xl">
                <svg class="w-20 h-20 text-red-500 mx-auto mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m11 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h4 class="text-4xl font-black text-white uppercase italic">Nomination Window is {{ $nominationStatus === 'closed' ? 'CLOSED' : 'NOT OPEN' }}</h4>
                <p class="text-gray-500 font-bold mt-4 text-xl uppercase tracking-[0.2em]">The system is currently restricted for maintenance or session timing.</p>
            </div>
        @endif

        <div class="mt-24 pb-20 text-center">
            <a href="{{ route('attendance.scan') }}" class="group inline-flex items-center gap-6 bg-white/5 border border-white/10 px-16 py-8 rounded-[2.5rem] text-base font-black text-gray-500 uppercase tracking-[0.3em] hover:bg-white/10 hover:text-white transition-all shadow-2xl hover:shadow-indigo-500/10">
                <svg class="w-6 h-6 transition-transform group-hover:-translate-x-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path></svg>
                Return to Dashboard
            </a>
        </div>
    @endif
</div>