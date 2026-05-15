<div wire:key="pos-card-{{ $pos->id }}-{{ in_array($pos->id, $nominatedIds) ? 'locked' : 'open' }}" 
     x-data="{ open: @entangle('activePositionId').live === {{ $pos->id }} }"
     @click.away="if({{ $activePositionId == $pos->id }}) $wire.clearSearch({{ $pos->id }})"
     class="relative flex flex-col bg-[#1a1a1e] border border-white/10 rounded-[3rem] p-10 transition-all duration-500 hover:border-indigo-500/50 hover:bg-white/[0.07] group {{ $activePositionId == $pos->id ? 'z-50 ring-4 ring-indigo-500/30 shadow-2xl shadow-indigo-500/20' : 'z-10 shadow-xl shadow-black/20' }} {{ in_array($pos->id, $nominatedIds) ? 'opacity-40 grayscale' : '' }}">
    
    @if(in_array($pos->id, $nominatedIds))
        <div class="absolute inset-0 z-[60] flex flex-col items-center justify-center rounded-[3rem] pointer-events-auto cursor-not-allowed bg-[#0a0a0c]/40 backdrop-blur-[2px]">
            <div class="bg-indigo-600 p-6 rounded-full border-4 border-white/20 shadow-[0_0_50px_rgba(79,70,229,0.5)] animate-in zoom-in duration-300 mb-4">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <div class="bg-green-600 px-8 py-3 rounded-full shadow-[0_15px_40px_rgba(22,163,74,0.4)] border border-white/20 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-150">
                <span class="text-sm font-black text-white uppercase tracking-[0.3em]">COMPLETED</span>
            </div>
        </div>
    @endif
    
    <!-- Card Header -->
    <div class="flex items-start justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h3 class="text-2xl font-black text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors leading-none truncate">{{ $pos->title }}</h3>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mt-3">Position Category</p>
        </div>
        @if(in_array($pos->id, $nominatedIds))
            <div class="shrink-0 px-5 py-2 bg-green-600 border border-white/20 rounded-2xl flex items-center gap-2 shadow-[0_0_20px_rgba(22,163,74,0.5)] animate-in zoom-in duration-500">
                <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                <span class="text-[10px] text-white font-black uppercase tracking-widest">COMPLETED</span>
            </div>
        @else
            <div class="shrink-0 px-4 py-2 bg-white/5 border border-white/10 rounded-2xl">
                <span class="text-[9px] text-gray-500 font-black uppercase tracking-widest">Open</span>
            </div>
        @endif
    </div>

    <!-- Current Choice Section -->
    <div class="mb-10 min-h-[90px]">
        @if(in_array($pos->id, $nominatedIds))
            <div class="p-6 bg-indigo-600/10 rounded-[2rem] border border-indigo-500/20 relative overflow-hidden group/choice">
                <span class="text-[8px] font-black text-indigo-400/60 uppercase tracking-[0.3em] block mb-2">MY NOMINEE</span>
                <div class="text-xl font-black text-white truncate pr-6">{{ $myNominations[(int)$pos->id] ?? 'Selected' }}</div>
                <div class="absolute -right-4 -bottom-4 opacity-10 group-hover/choice:opacity-20 transition-opacity">
                    <svg class="w-20 h-20 text-indigo-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>
                </div>
            </div>
        @else
            <div class="p-6 bg-white/5 rounded-[2rem] border border-dashed border-white/10 flex items-center justify-center h-full">
                <span class="text-[10px] text-gray-600 font-black uppercase tracking-widest italic text-center">Assign a candidate below</span>
            </div>
        @endif
    </div>

    <!-- Search & Action Section -->
    <div class="mt-auto space-y-6">
        <div class="relative">
            <label class="text-[9px] font-black text-gray-500 uppercase tracking-[0.2em] ml-6 block mb-3 leading-none">
                @if(in_array($pos->id, $nominatedIds))
                    CATEGORY LOCKED
                @else
                    Nominee Name / ID
                @endif
            </label>
            <div class="relative group/input">
                <input wire:model.live.debounce.300ms="searchInputs.{{ $pos->id }}" 
                       type="text" 
                       placeholder="{{ in_array($pos->id, $nominatedIds) ? 'Choice is final' : 'Search for candidate...' }}"
                       @if(in_array($pos->id, $nominatedIds)) disabled @endif
                       class="w-full bg-black/40 border-2 border-white/5 rounded-[1.5rem] px-6 py-5 outline-none focus:border-indigo-500 transition-all text-white font-bold placeholder:text-gray-800 text-lg group-hover/input:border-white/10">
                
                @if(isset($searchInputs[$pos->id]) && !empty($searchInputs[$pos->id]) && !in_array($pos->id, $nominatedIds))
                    <button wire:click="clearSearch({{ $pos->id }})" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-red-400 p-2 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                @endif

                @if($activePositionId == $pos->id && count($members) > 0 && $selectedMember == null && !in_array($pos->id, $nominatedIds))
                    <div class="absolute z-[70] w-full mt-4 bg-[#111115] border-2 border-indigo-500 rounded-[2rem] shadow-[0_40px_80px_rgba(0,0,0,0.9)] overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                        <div class="px-6 py-3 bg-white/5 border-b border-white/5 flex justify-between items-center">
                            <span class="text-[8px] font-black text-indigo-400 uppercase tracking-widest">Select Candidate</span>
                            <button wire:click="clearSearch({{ $pos->id }})" class="text-gray-500 hover:text-white">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <div class="max-h-64 overflow-y-auto custom-scrollbar">
                            @foreach($members as $m)
                                <button type="button" 
                                        wire:click="selectMember({{ $m->id }}, '{{ $m->name }}', {{ $pos->id }})"
                                        class="w-full px-6 py-6 text-left hover:bg-indigo-600 transition-all border-b border-white/5 last:border-0 group/item">
                                    <div class="font-black text-white text-xl group-hover/item:text-white leading-tight">{{ $m->name }}</div>
                                    <div class="text-xs text-gray-400 group-hover/item:text-indigo-200 font-bold uppercase tracking-widest mt-1">{{ $m->staff_id }} • {{ $m->workplace }}</div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <button type="button" 
                wire:click="submitNomination({{ $pos->id }})"
                wire:loading.attr="disabled"
                wire:target="submitNomination({{ $pos->id }})"
                @if($activePositionId != $pos->id || !$selectedMember || in_array($pos->id, $nominatedIds)) disabled @endif
                class="w-full {{ in_array($pos->id, $nominatedIds) ? 'bg-white/5 text-gray-500' : 'bg-indigo-600 hover:bg-white text-white hover:text-indigo-600' }} py-6 rounded-[1.5rem] font-black text-sm uppercase tracking-[0.3em] transition-all duration-500 shadow-2xl shadow-indigo-500/20 group/btn active:scale-[0.97] disabled:opacity-20 disabled:grayscale disabled:hover:bg-indigo-600 disabled:hover:text-white disabled:cursor-not-allowed">
            <span class="flex items-center justify-center gap-4">
                @if(in_array($pos->id, $nominatedIds))
                    Nomination Finalized
                @else
                    <span wire:loading.remove wire:target="submitNomination({{ $pos->id }})">Confirm Choice</span>
                    <span wire:loading wire:target="submitNomination({{ $pos->id }})">Processing...</span>
                    <svg wire:loading.remove wire:target="submitNomination({{ $pos->id }})" class="w-5 h-5 transition-transform group-hover/btn:translate-x-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                @endif
            </span>
        </button>
    </div>
</div>
