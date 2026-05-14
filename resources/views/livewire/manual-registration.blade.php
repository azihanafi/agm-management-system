<div class="max-w-2xl mx-auto p-8 bg-white/5 border border-white/10 rounded-3xl shadow-2xl backdrop-blur-xl">
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-black text-white tracking-tight">Manual Member Key-In</h2>
        <p class="text-gray-400 mt-2 text-sm uppercase tracking-widest font-bold">Registration Form</p>
    </div>

    @if ($successMessage)
        <div class="mb-6 p-4 bg-green-500/20 border border-green-500/30 text-green-400 rounded-xl font-bold flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ $successMessage }}
        </div>
    @endif

    <form wire:submit.prevent="registerMember" class="space-y-6">
        <div>
            <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-2 ml-2">Full Name</label>
            <input type="text" wire:model.live="name" placeholder="Enter member's full name" 
                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all placeholder:text-white/10 font-bold uppercase">
            @error('name') <span class="text-red-400 text-xs mt-2 ml-2 block font-bold">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-2 ml-2">Staff ID</label>
            <input type="text" wire:model="staff_id" placeholder="e.g. 3600894" 
                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all placeholder:text-white/10 font-bold">
            @error('staff_id') <span class="text-red-400 text-xs mt-2 ml-2 block font-bold">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-2 ml-2">Workplace</label>
            <select wire:model="workplace" 
                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all font-bold appearance-none cursor-pointer">
                <option value="" class="bg-gray-900 text-white">Select Workplace</option>
                <option value="FJB - T1, T2, T3" class="bg-gray-900 text-white">FJB - T1, T2, T3</option>
                <option value="FGVGT" class="bg-gray-900 text-white">FGVGT</option>
                <option value="FGV Terminal 4" class="bg-gray-900 text-white">FGV Terminal 4</option>
                <option value="LBSB" class="bg-gray-900 text-white">LBSB</option>
            </select>
            @error('workplace') <span class="text-red-400 text-xs mt-2 ml-2 block font-bold">{{ $message }}</span> @enderror
        </div>

        <button type="submit" 
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl shadow-xl shadow-indigo-500/20 transition-all flex items-center justify-center gap-3">
            Register Member
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        </button>
    </form>
</div>
