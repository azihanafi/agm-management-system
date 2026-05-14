<div class="max-w-4xl mx-auto p-6" wire:poll.5s>
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-4xl font-black text-white tracking-tighter">CAST YOUR VOTE</h1>
            <p class="text-gray-400 mt-1 uppercase tracking-widest text-xs">AGM 2026 Active Election Session</p>
        </div>
        
        <div class="flex items-center gap-3 bg-white/5 border border-white/10 px-4 py-2 rounded-full">
            <div class="w-2 h-2 <?php echo e($isVotingOpen ? 'bg-green-500 animate-pulse' : 'bg-red-500'); ?> rounded-full"></div>
            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">
                <?php echo e($isVotingOpen ? 'LIVE SESSION' : 'VOTING CLOSED'); ?>

            </span>
        </div>
    </header>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
        <div class="mb-8 p-4 bg-green-500/20 border border-green-500/30 rounded-2xl text-green-400 text-sm font-medium flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <?php echo e(session('message')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('error')): ?>
        <div class="mb-8 p-4 bg-red-500/20 border border-red-500/30 rounded-2xl text-red-400 text-sm font-medium flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isVotingOpen): ?>
        <div class="bg-white/5 border border-white/10 rounded-3xl p-16 text-center">
            <div class="w-20 h-20 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-2">Voting is Currently Closed</h2>
            <p class="text-gray-400">The administrator has not opened the voting module yet. Please wait for the announcement.</p>
        </div>
    <?php elseif(!$activePosition): ?>
        <div class="bg-white/5 border border-white/10 rounded-3xl p-16 text-center">
            <div class="w-20 h-20 bg-indigo-600/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-2">Waiting for Next Position</h2>
            <p class="text-gray-400">The current position has been closed. Please wait for the administrator to select the next role.</p>
        </div>
    <?php elseif($hasVoted): ?>
        <div class="bg-white/5 border border-white/10 rounded-3xl p-16 text-center">
            <div class="w-20 h-20 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-2">Vote Recorded</h2>
            <p class="text-gray-400">You have successfully cast your vote for the position of <strong><?php echo e($activePosition->title); ?></strong>.</p>
            <p class="text-xs text-gray-500 mt-6 uppercase tracking-widest">Awaiting next position...</p>
        </div>
    <?php else: ?>
        <!-- Active Voting Form -->
        <div class="bg-white/5 border border-white/10 rounded-3xl p-8 backdrop-blur-xl shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-2 h-full bg-indigo-600"></div>
            
            <div class="mb-10">
                <span class="bg-indigo-600/20 text-indigo-400 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-indigo-600/30">CURRENT ROLE</span>
                <h2 class="text-4xl font-black text-white mt-4 uppercase tracking-tighter"><?php echo e($activePosition->title); ?></h2>
            </div>

            <div class="space-y-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $activePosition->nominations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nomination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                        $isEligible = $nomination->isEligible();
                    ?>
                    <div class="group relative flex items-center justify-between p-6 rounded-2xl border transition-all duration-300 <?php echo e($isEligible ? 'bg-white/5 border-white/10 hover:border-indigo-500/50 hover:bg-white/[0.08]' : 'bg-black/20 border-white/5 opacity-50'); ?>">
                        <div class="flex items-center gap-6">
                            <div class="w-14 h-14 bg-white/5 rounded-xl flex items-center justify-center font-black text-xl text-gray-400 border border-white/10">
                                <?php echo e(substr($nomination->nominee->name, 0, 1)); ?>

                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white"><?php echo e($nomination->nominee->name); ?></h3>
                                <p class="text-gray-500 text-sm"><?php echo e($nomination->nominee->workplace); ?></p>
                            </div>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isEligible): ?>
                            <button wire:click="castVote(<?php echo e($activePosition->id); ?>, <?php echo e($nomination->nominee->id); ?>)" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-black text-sm transition-all transform hover:-translate-y-1 active:scale-95 shadow-lg shadow-indigo-500/20">
                                VOTE
                            </button>
                        <?php else: ?>
                            <span class="text-[10px] font-black uppercase tracking-widest text-red-500/60 bg-red-500/10 px-4 py-2 rounded-lg border border-red-500/20">
                                DISQUALIFIED (ABSENT)
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\Users\aziha\.gemini\antigravity\scratch\agm-voting-system\resources\views/livewire/voting-module.blade.php ENDPATH**/ ?>