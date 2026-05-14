<div class="max-w-md mx-auto space-y-8">
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-2">AGM Attendance</h1>
        <p class="text-slate-400">Please confirm your identity to unlock voting.</p>
    </div>

    <div class="glass rounded-3xl p-8 glow">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step == 1): ?>
            <!-- Step 1: Input Staff ID -->
            <form wire:submit.prevent="verifyStaff" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium mb-2 text-slate-300">Staff ID</label>
                    <input wire:model="staff_id" type="text"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 outline-none transition-all"
                        placeholder="Enter your Staff ID">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['staff_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-xs mt-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <button type="submit"
                    class="w-full accent-gradient py-4 rounded-xl font-bold text-white hover:opacity-90 transition-all shadow-lg">
                    Verify Identity
                </button>
            </form>
        <?php elseif($step == 2): ?>
            <!-- Step 2: Selection Menu -->
            <div class="space-y-8 text-center">
                <div class="space-y-2">
                    <p class="text-xs uppercase tracking-widest text-slate-500">Member Found</p>
                    <h2 class="text-2xl font-bold text-white"><?php echo e($memberInfo->name); ?></h2>
                    <p class="text-slate-400"><?php echo e($memberInfo->workplace); ?></p>
                    <p class="text-sm font-mono text-red-400"><?php echo e($memberInfo->staff_id); ?></p>
                </div>
                
                <div class="grid grid-cols-1 gap-4 pt-4">
                    <a href="<?php echo e(route('nominate.index')); ?>" 
                        class="w-full inline-block bg-white/5 border border-white/10 px-8 py-5 rounded-2xl font-bold text-white hover:bg-white/10 transition-all text-center uppercase tracking-widest text-sm">
                        Nominate Candidate
                    </a>

                    <button wire:click="$set('step', 4)" 
                        class="w-full accent-gradient px-8 py-5 rounded-2xl font-bold text-white hover:opacity-90 transition-all shadow-lg text-center uppercase tracking-widest">
                        Enter AGM
                    </button>
                </div>

                <button wire:click="$set('step', 1)" class="text-sm text-slate-500 hover:text-white transition-all">
                    Not me? Go back
                </button>
            </div>
        <?php elseif($step == 4): ?>
            <!-- Step 4: TAC Entry -->
            <div class="space-y-6 text-center">
                <div class="space-y-2">
                    <h2 class="text-xl font-bold text-white">Meeting Verification</h2>
                    <p class="text-slate-400 text-sm">Please enter the TAC code provided by the organizer.</p>
                </div>
                
                <div class="pt-6 border-t border-white/5 space-y-6">
                    <div>
                        <label class="block text-xs text-slate-500 uppercase tracking-widest mb-3">Enter Meeting TAC</label>
                        <input wire:model="input_tac" type="text" maxlength="6" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-4 text-center text-3xl font-mono tracking-[0.3em] focus:ring-2 focus:ring-red-500 outline-none text-white"
                            placeholder="••••••">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['input_tac'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-xs mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <button wire:click="confirmAttendance" 
                        class="w-full accent-gradient py-4 rounded-xl font-bold text-white hover:opacity-90 transition-all shadow-lg">
                        Confirm Attendance
                    </button>
                    
                    <button wire:click="$set('step', 2)" class="text-sm text-slate-500 hover:text-white transition-all">
                        ← Back to Menu
                    </button>
                </div>
            </div>
        <?php elseif($step == 3): ?>
            <!-- Step 3: Success Menu -->
            <div class="text-center space-y-6">
                <div class="w-16 h-16 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="space-y-1">
                    <h2 class="text-2xl font-bold text-white">Identity Verified</h2>
                    <p class="text-slate-400 text-sm">Welcome back, <?php echo e(explode(' ', $memberInfo->name)[0]); ?></p>
                </div>

                <div class="pt-6 grid grid-cols-1 gap-4">
                    <?php
                        $settings = \App\Models\MeetingControl::first();
                    ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings && $settings->is_voting_open): ?>
                        <a href="<?php echo e(route('voting.index')); ?>"
                            class="w-full inline-block accent-gradient px-8 py-5 rounded-2xl font-bold text-white hover:opacity-90 transition-all shadow-lg text-center relative overflow-hidden group">
                            <span class="relative z-10">PROCEED TO VOTING</span>
                            <div
                                class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            </div>
                        </a>
                    <?php else: ?>
                        <div
                            class="w-full px-8 py-5 rounded-2xl font-bold text-slate-500 bg-white/5 border border-white/10 text-center cursor-not-allowed">
                            VOTING MODULE CLOSED
                            <p class="text-[10px] font-normal mt-1 uppercase tracking-widest text-slate-600 italic">Waiting for
                                CEO to open sessions</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <a href="<?php echo e(route('nominate.index')); ?>"
                        class="w-full inline-block bg-white/5 border border-white/10 px-8 py-5 rounded-2xl font-bold text-white hover:bg-white/10 transition-all text-center uppercase text-sm tracking-widest">
                        NOMINATE CANDIDATE
                    </a>
                </div>

                <p class="text-[10px] text-slate-600 uppercase tracking-widest pt-4">Session Active: AGM 2026</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Security Note -->
    <div class="flex items-start space-x-3 text-xs text-slate-500 bg-white/5 p-4 rounded-xl border border-white/5">
        <svg class="w-4 h-4 mt-0.5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
            </path>
        </svg>
        <p>This TAC is valid for the current AGM session only. Do not share this code. Physical presence is verified via
            GPS/Local Network check (if applicable).</p>
    </div>
</div><?php /**PATH C:\Users\aziha\.gemini\antigravity\scratch\agm-voting-system\resources\views/livewire/attendance-scanner.blade.php ENDPATH**/ ?>