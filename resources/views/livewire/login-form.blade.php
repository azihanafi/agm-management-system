<div class="min-h-screen flex items-center justify-center bg-[#0a0a0c] p-6">
    <div class="w-full max-w-md bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-2xl">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white tracking-tight">Welcome Back</h2>
            <p class="text-gray-400 mt-2">Sign in to your AGM account</p>
        </div>

        <form wire:submit="login" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Staff ID</label>
                <input wire:model="staff_id" type="text" 
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 transition-all outline-none"
                    placeholder="e.g. STF101">
                @error('staff_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input wire:model="password" type="password" 
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 transition-all outline-none"
                    placeholder="••••••••">
                @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-indigo-500/20 transition-all transform hover:-translate-y-1">
                Sign In
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-400 text-sm">Don't have an account? 
                <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-medium">Register here</a>
            </p>
        </div>
    </div>
</div>
