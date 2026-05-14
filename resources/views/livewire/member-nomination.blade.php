<div class="max-w-md mx-auto mt-10 p-8 bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2.5rem] shadow-2xl">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl mb-4 shadow-lg shadow-indigo-500/20">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </div>
        <h2 class="text-2xl font-black tracking-tight">NOMINATE CANDIDATE</h2>
        <p class="text-gray-400 text-sm mt-2">Submit your choice for the 2026 Committee</p>
    </div>

    @if($nominationStatus === 'closed')
        <div class="mb-6 p-6 bg-red-500/10 border border-red-500/30 rounded-2xl text-center">
            <svg class="w-10 h-10 text-red-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-red-400 font-black text-lg uppercase tracking-widest">Nominations Closed</p>
            @if($nominationDeadline)
                <p class="text-gray-500 text-xs mt-2">The nomination period ended on <span class="text-white font-bold">{{ \Carbon\Carbon::parse($nominationDeadline)->format('d M Y') }}</span>.</p>
            @endif
        </div>
    @elseif($nominationStatus === 'upcoming')
        <div class="mb-6 p-6 bg-yellow-500/10 border border-yellow-500/30 rounded-2xl text-center">
            <svg class="w-10 h-10 text-yellow-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-yellow-400 font-black text-lg uppercase tracking-widest">Not Open Yet</p>
            @if($nominationOpensAt)
                <p class="text-gray-500 text-xs mt-2">Nominations open on <span class="text-white font-bold">{{ \Carbon\Carbon::parse($nominationOpensAt)->format('d M Y') }}</span>.</p>
            @endif
        </div>
    @endif

    @if ($message)
        <div class="mb-6 p-4 {{ str_contains($message, 'closed') || str_contains($message, 'yet') ? 'bg-red-500/20 border-red-500/30 text-red-400' : 'bg-green-500/20 border-green-500/30 text-green-400' }} border rounded-2xl text-sm font-medium text-center">
            {{ $message }}
        </div>
    @endif

    <form wire:submit="submitNomination" class="space-y-6 {{ $nominationStatus !== 'open' ? 'opacity-50 pointer-events-none select-none' : '' }}">
        <div class="space-y-2">
            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-2">Target Position</label>
            <select wire:model="selectedPosition" class="w-full bg-black/40 border border-white/10 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-500 transition-all text-white font-bold appearance-none">
                <option value="">Select a Position...</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos->id }}">{{ $pos->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="space-y-2 relative">
            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-2">Choose Nominee</label>
            <input wire:model.live.debounce.300ms="search" 
                   type="text" 
                   placeholder="Type Name or Staff ID..."
                   class="w-full bg-black/40 border border-white/10 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-500 transition-all text-white font-bold">
            
            @if(count($members) > 0 && $selectedMember == null)
                <div class="absolute z-50 w-full mt-2 bg-[#1a1a1e] border border-white/10 rounded-2xl shadow-2xl overflow-hidden backdrop-blur-xl">
                    @foreach($members as $m)
                        <button type="button" 
                                wire:click="selectMember({{ $m->id }}, '{{ $m->name }}')"
                                class="w-full px-5 py-4 text-left hover:bg-indigo-600 transition-all border-b border-white/5 last:border-0 group">
                            <div class="font-bold text-white group-hover:text-white">{{ $m->name }}</div>
                            <div class="text-xs text-gray-400 group-hover:text-indigo-200">{{ $m->staff_id }} • {{ $m->workplace }}</div>
                        </button>
                    @endforeach
                </div>
            @endif
            
            <input type="hidden" wire:model="selectedMember">
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-50 py-4 rounded-2xl font-black text-sm uppercase tracking-widest transition-all shadow-xl shadow-indigo-500/20 hover:text-indigo-600 group">
            <span class="flex items-center justify-center gap-2">
                SUBMIT NOMINATION
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </span>
        </button>

        <div class="text-center">
            <a href="{{ route('attendance.scan') }}" class="text-[10px] font-black text-gray-500 uppercase tracking-widest hover:text-white transition-colors">
                Back to Dashboard
            </a>
        </div>
    </form>
</div>
