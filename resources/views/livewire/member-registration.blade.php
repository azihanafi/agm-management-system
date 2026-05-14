<div class="max-w-md mx-auto space-y-8">
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-2">New Member Registration</h1>
        <p class="text-slate-400">Join the Sports Club AGM 2026</p>
    </div>

    <div class="glass rounded-3xl p-8 glow">
        @if($registrationMessage)
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl text-red-400 text-xs text-center font-bold">
                {{ $registrationMessage }}
            </div>
        @endif
        <form wire:submit.prevent="register" class="space-y-6">
            <div>
                <label class="block text-sm font-medium mb-2 text-slate-300">Full Name</label>
                <input wire:model.live="name" type="text" 
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 outline-none transition-all uppercase"
                    placeholder="ENTER YOUR FULL NAME">
                @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2 text-slate-300">Staff ID</label>
                <input wire:model="staff_id" type="text" 
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 outline-none transition-all"
                    placeholder="Enter your Staff ID">
                @error('staff_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2 text-slate-300">Terminal / Workplace</label>
                <select wire:model="workplace" 
                    class="w-full bg-[#1a1a1c] border border-white/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 outline-none transition-all text-white">
                    <option value="">Select your workplace...</option>
                    <option value="FJB - T1, T2, T3">FJB - T1, T2, T3</option>
                    <option value="FGVGT">FGVGT</option>
                    <option value="FGV Terminal 4">FGV Terminal 4</option>
                    <option value="LBSB">LBSB</option>
                </select>
                @error('workplace') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2 text-slate-300">Password</label>
                <input wire:model="password" type="password" 
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 outline-none transition-all"
                    placeholder="Minimum 8 characters">
                @error('password') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" 
                class="w-full accent-gradient py-4 rounded-xl font-bold text-white hover:opacity-90 transition-all shadow-lg">
                Register & Proceed
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-slate-500">Already a member? <a href="/login" class="text-red-500 hover:underline">Login here</a></p>
        </div>
    </div>
</div>
