<div class="max-w-md mx-auto mt-10 p-8 bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2.5rem] shadow-2xl">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl mb-4 shadow-lg shadow-indigo-500/20">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </div>
        <h2 class="text-2xl font-black tracking-tight">NOMINATE CANDIDATE</h2>
        <p class="text-gray-400 text-sm mt-2">Submit your choice for the 2026 Committee</p>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($message): ?>
        <div class="mb-6 p-4 bg-green-500/20 border border-green-500/30 rounded-2xl text-green-400 text-sm font-medium animate-bounce text-center">
            <?php echo e($message); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <form wire:submit="submitNomination" class="space-y-6">
        <div class="space-y-2">
            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-2">Target Position</label>
            <select wire:model="selectedPosition" class="w-full bg-black/40 border border-white/10 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-500 transition-all text-white font-bold appearance-none">
                <option value="">Select a Position...</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($pos->id); ?>"><?php echo e($pos->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
        </div>

        <div class="space-y-2 relative">
            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-2">Choose Nominee</label>
            <input wire:model.live.debounce.300ms="search" 
                   type="text" 
                   placeholder="Type Name or Staff ID..."
                   class="w-full bg-black/40 border border-white/10 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-indigo-500 transition-all text-white font-bold">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($members) > 0 && $selectedMember == null): ?>
                <div class="absolute z-50 w-full mt-2 bg-[#1a1a1e] border border-white/10 rounded-2xl shadow-2xl overflow-hidden backdrop-blur-xl">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" 
                                wire:click="selectMember(<?php echo e($m->id); ?>, '<?php echo e($m->name); ?>')"
                                class="w-full px-5 py-4 text-left hover:bg-indigo-600 transition-all border-b border-white/5 last:border-0 group">
                            <div class="font-bold text-white group-hover:text-white"><?php echo e($m->name); ?></div>
                            <div class="text-xs text-gray-400 group-hover:text-indigo-200"><?php echo e($m->staff_id); ?> • <?php echo e($m->workplace); ?></div>
                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            
            <input type="hidden" wire:model="selectedMember">
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-50 py-4 rounded-2xl font-black text-sm uppercase tracking-widest transition-all shadow-xl shadow-indigo-500/20 hover:text-indigo-600 group">
            <span class="flex items-center justify-center gap-2">
                SUBMIT NOMINATION
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </span>
        </button>

        <div class="text-center">
            <a href="<?php echo e(route('attendance.scan')); ?>" class="text-[10px] font-black text-gray-500 uppercase tracking-widest hover:text-white transition-colors">
                Back to Dashboard
            </a>
        </div>
    </form>
</div>
<?php /**PATH C:\Users\aziha\.gemini\antigravity\scratch\agm-voting-system\resources\views/livewire/member-nomination.blade.php ENDPATH**/ ?>