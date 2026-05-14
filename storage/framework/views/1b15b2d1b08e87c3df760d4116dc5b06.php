<div class="space-y-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Management Panel -->
        <div class="bg-white/5 border border-white/10 p-6 rounded-3xl h-fit">
            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                Management Control
            </h3>

            <form wire:submit.prevent="addOfficial" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Select Member</label>
                    <select wire:model="selectedMemberId" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                        <option value="">Choose a member...</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($member->id); ?>"><?php echo e($member->name); ?> (<?php echo e($member->staff_id); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Designation</label>
                    <select wire:model="selectedDesignation" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                        <option value="">Select position...</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($designation); ?>"><?php echo e($designation); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 py-4 rounded-xl font-bold shadow-lg shadow-indigo-500/20 transition-all">
                    Assign to Chart
                </button>
            </form>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
                <div class="mt-4 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl text-green-400 text-xs">
                    <?php echo e(session('message')); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Chart Preview -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden">
                <div class="px-8 py-5 border-b border-white/10 bg-white/5 flex justify-between items-center">
                    <h4 class="font-bold">Active Organization List</h4>
                    <span class="text-[10px] text-gray-500 uppercase tracking-[0.2em]">Live Preview</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="text-[10px] text-gray-500 uppercase tracking-widest bg-black/20">
                            <tr>
                                <th class="px-8 py-4">Order</th>
                                <th class="px-8 py-4">Designation</th>
                                <th class="px-8 py-4">Official Name</th>
                                <th class="px-8 py-4 text-right">Control</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $officials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $official): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-white/5 transition-all">
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-2">
                                        <button wire:click="moveUp(<?php echo e($official->id); ?>)" class="p-1 hover:bg-white/10 rounded">
                                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                        </button>
                                        <button wire:click="moveDown(<?php echo e($official->id); ?>)" class="p-1 hover:bg-white/10 rounded">
                                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="px-3 py-1 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-full text-[10px] font-black uppercase tracking-tighter">
                                        <?php echo e($official->designation); ?>

                                    </span>
                                </td>
                                <td class="px-8 py-4">
                                    <div class="font-bold text-sm"><?php echo e($official->user->name); ?></div>
                                    <div class="text-[10px] text-gray-500 uppercase"><?php echo e($official->user->staff_id); ?> | <?php echo e($official->user->workplace); ?></div>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <button wire:click="removeOfficial(<?php echo e($official->id); ?>)" class="text-red-400 hover:text-red-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($officials->isEmpty()): ?>
                            <tr>
                                <td colspan="4" class="px-8 py-10 text-center text-gray-500 italic">No officials assigned yet.</td>
                            </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Visual Chart Representation -->
    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-10">
        <h3 class="text-xl md:text-2xl font-bold text-center mb-16 uppercase tracking-[0.3em]">CARTA ORGANISASI KELAB</h3>
        
        <div class="flex flex-col items-center w-full max-w-6xl mx-auto">
            <!-- Level 1: Pengerusi -->
            <div class="w-full flex justify-center">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $officials->where('designation', 'PENGERUSI'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-indigo-600 p-1 rounded-2xl shadow-2xl shadow-indigo-500/20 w-full max-w-sm">
                        <div class="bg-[#0a0a0c] px-6 py-8 rounded-xl border border-white/10 text-center">
                            <div class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-3">PENGERUSI</div>
                            <div class="font-bold text-lg md:text-xl uppercase leading-tight"><?php echo e($p->user->name); ?></div>
                            <div class="text-[10px] text-gray-500 mt-2 uppercase tracking-wider"><?php echo e($p->user->workplace); ?></div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Connector Line 1 -->
            <div class="w-1 bg-gradient-to-b from-indigo-600 to-indigo-400 h-12 shadow-[0_0_15px_rgba(79,70,229,0.5)]"></div>

            <!-- Level 2: Setiausaha & Bendahari -->
            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $officials->whereIn('designation', ['SETIAUSAHA', 'BENDAHARI']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex justify-center">
                        <div class="bg-white/5 border border-white/10 p-1 rounded-2xl w-full max-w-sm relative">
                            <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-indigo-600 px-4 py-1 rounded-full text-[8px] font-black uppercase tracking-widest"><?php echo e($o->designation); ?></div>
                            <div class="bg-black/40 px-6 py-6 rounded-xl text-center">
                                <div class="font-bold text-sm md:text-base uppercase leading-tight mt-2"><?php echo e($o->user->name); ?></div>
                                <div class="text-[9px] text-gray-500 mt-2 uppercase"><?php echo e($o->user->workplace); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Connector Line 2 -->
            <div class="w-1 bg-gradient-to-b from-indigo-400 to-indigo-600 h-12 my-4 shadow-[0_0_15px_rgba(79,70,229,0.5)]"></div>

            <!-- Level 3: Other Roles (Timbalan, Penolong, Amanah, Juruaudit) -->
             <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $officials->filter(fn($o) => !in_array($o->designation, ['PENGERUSI', 'SETIAUSAHA', 'BENDAHARI']) && !str_contains(strtoupper($o->designation), 'AJK')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white/5 border border-white/10 px-6 py-6 rounded-2xl text-center flex flex-col justify-center min-h-[100px] hover:border-indigo-500/50 transition-all">
                        <div class="text-[9px] font-bold text-indigo-400 uppercase tracking-[0.2em] mb-2"><?php echo e($o->designation); ?></div>
                        <div class="font-bold text-xs md:text-sm uppercase leading-tight"><?php echo e($o->user->name); ?></div>
                        <div class="text-[8px] text-gray-600 mt-2 uppercase"><?php echo e($o->user->workplace); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Level 4: AJK & Department Positions -->
            <div class="w-full border-t-2 border-indigo-500/30 pt-12 relative">
                <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-1 h-12 bg-indigo-500/50"></div>
                <div class="text-center mb-10 text-[10px] font-black text-indigo-400 uppercase tracking-[0.5em]">AHLI JAWATANKUASA (AJK) & DEPARTMENT POSITIONS</div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $officials->filter(fn($o) => str_contains(strtoupper($o->designation), 'AJK')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white/5 border border-white/5 p-6 rounded-xl text-center hover:bg-white/10 transition-all flex flex-col justify-center min-h-[100px] relative group overflow-hidden">
                            <div class="absolute top-0 left-0 w-1 h-full bg-indigo-600 opacity-0 group-hover:opacity-100 transition-all"></div>
                            <div class="text-[8px] font-black text-indigo-400 uppercase tracking-widest mb-2"><?php echo e($o->designation); ?></div>
                            <div class="font-bold text-[11px] uppercase leading-snug"><?php echo e($o->user->name); ?></div>
                            <div class="text-[8px] text-gray-500 uppercase mt-2 italic"><?php echo e($o->user->workplace); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\aziha\.gemini\antigravity\scratch\agm-voting-system\resources\views/livewire/club-organization.blade.php ENDPATH**/ ?>