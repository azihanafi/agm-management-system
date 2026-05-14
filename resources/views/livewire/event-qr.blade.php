<div class="max-w-4xl mx-auto text-center space-y-12 py-12">
    <div class="space-y-4">
        <h1 class="text-5xl font-black tracking-tight text-white">AGM 2026 <span class="text-red-500">REGISTRATION</span></h1>
        <p class="text-xl text-slate-400">Scan the QR code below to verify your attendance and unlock voting.</p>
    </div>

    <div class="glass inline-block p-12 rounded-[3rem] glow border-red-500/10">
        <!-- In a real Laravel app, we use {!! QrCode::size(300)->generate(route('attendance.scan')) !!} -->
        <!-- For demo purposes, I'll use a placeholder image that looks like a QR code -->
        <div class="bg-white p-4 rounded-3xl inline-block shadow-2xl">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode(route('attendance.scan')) }}" 
                 alt="AGM QR Code" class="w-64 h-64">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
        <div class="glass p-6 rounded-2xl border-white/5">
            <div class="text-red-500 font-bold mb-2">Step 1</div>
            <p class="text-sm text-slate-400">Scan the QR code with your mobile device camera.</p>
        </div>
        <div class="glass p-6 rounded-2xl border-white/5">
            <div class="text-red-500 font-bold mb-2">Step 2</div>
            <p class="text-sm text-slate-400">Enter your Staff ID and confirm your identity.</p>
        </div>
        <div class="glass p-6 rounded-2xl border-white/5">
            <div class="text-red-500 font-bold mb-2">Step 3</div>
            <p class="text-sm text-slate-400">Get your Meeting TAC and proceed to vote.</p>
        </div>
    </div>

    <div class="pt-12 text-slate-500 text-sm">
        Authorized Access Only. All logins are logged with IP and Device ID.
    </div>
</div>
