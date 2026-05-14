<div class="min-h-screen bg-[#0a0a0c] text-white flex overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-white/5 backdrop-blur-xl border-r border-white/10 flex flex-col">
        <div class="p-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center font-bold">A</div>
                <h1 class="text-xl font-bold tracking-tight">AGM COMMAND</h1>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-4">
            <button wire:click="setTab('overview')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'overview' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Overview
            </button>
            <button wire:click="setTab('attendance')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'attendance' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Attendance Log
            </button>
            <button wire:click="setTab('positions')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'positions' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Positions
            </button>
            <button wire:click="setTab('candidates')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'candidates' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Candidates
            </button>
            <button wire:click="setTab('results')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'results' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Election Results
            </button>
            <button wire:click="setTab('settings')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'settings' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Meeting Settings
            </button>
            <button wire:click="setTab('paperwork')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'paperwork' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Paperwork System
            </button>
            <button wire:click="setTab('manual_reg')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'manual_reg' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                Manual Key-In
            </button>
            <button wire:click="setTab('members_list')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'members_list' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Member List
            </button>
            <button wire:click="setTab('bulk_upload')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'bulk_upload' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                Bulk Import
            </button>
            <button wire:click="setTab('org_chart')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'org_chart' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Org Chart
            </button>
            <button wire:click="setTab('nomination_leaderboard')" 
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e($activeTab === 'nomination_leaderboard' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-gray-400 hover:bg-white/5'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Top Nominations
            </button>
        </nav>

        <div class="p-6 border-t border-white/10 mt-auto">
            <div class="flex items-center gap-3 text-xs text-gray-400 mb-6">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                Live System 2026
            </div>

            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 transition-all font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-8">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-bold text-white tracking-tight">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'overview'): ?> Dashboard Overview
                    <?php elseif($activeTab === 'attendance'): ?> Live Attendance Log
                    <?php elseif($activeTab === 'positions'): ?> Manage Positions
                    <?php elseif($activeTab === 'candidates'): ?> Candidate Nominations
                    <?php elseif($activeTab === 'results'): ?> Live Election Results
                    <?php elseif($activeTab === 'settings'): ?> Meeting Control Panel
                    <?php elseif($activeTab === 'paperwork'): ?> Paperwork Management
                    <?php elseif($activeTab === 'manual_reg'): ?> Manual Member Registration
                    <?php elseif($activeTab === 'members_list'): ?> Complete Member Directory
                    <?php elseif($activeTab === 'bulk_upload'): ?> Bulk Member Management
                    <?php elseif($activeTab === 'org_chart'): ?> Organization Chart Management
                    <?php elseif($activeTab === 'nomination_leaderboard'): ?> Nomination Leaderboard (Top 30)
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </h2>
                <p class="text-gray-400 mt-1">Manage all AGM data and real-time voting progress</p>
            </div>
            
            <div class="flex gap-6 items-center">
                <div wire:ignore class="text-right hidden md:block border-r border-white/10 pr-6">
                    <div id="live-clock" class="text-2xl font-mono font-black text-indigo-400 tracking-tighter">00:00:00</div>
                    <div id="live-date" class="text-[10px] text-gray-500 uppercase tracking-[0.3em] font-bold">00/00/0000</div>
                </div>
                <div class="flex gap-4">
                    <button wire:click="exportAttendance" class="bg-white/5 hover:bg-white/10 px-4 py-2 rounded-xl border border-white/10 text-sm transition-all font-bold">
                        Export Data
                    </button>
                    <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center font-bold">C</div>
                </div>
            </div>
        </header>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'overview'): ?>
            <!-- Stats Grid -->
            <div wire:poll.5s class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl">
                    <p class="text-gray-400 text-sm font-medium">Total Members</p>
                    <h3 class="text-4xl font-bold mt-2"><?php echo e($stats['total_members']); ?></h3>
                    <div class="mt-4 text-xs text-indigo-400 font-medium">Registered Database</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl relative group overflow-hidden">
                    <p class="text-gray-400 text-sm font-medium">Present Today</p>
                    <h3 class="text-4xl font-bold mt-2 text-green-400"><?php echo e($stats['present_members']); ?></h3>
                    <div class="mt-4 flex justify-between items-center">
                        <div class="text-xs text-green-400 font-medium">QR Scanning Live</div>
                        <button wire:click="toggleQrModal" class="text-[10px] bg-white/5 hover:bg-white/10 px-2 py-1 rounded border border-white/10 transition-all font-bold uppercase tracking-wider">
                            Generate QR
                        </button>
                    </div>
                </div>
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl">
                    <p class="text-gray-400 text-sm font-medium">Votes Cast</p>
                    <h3 class="text-4xl font-bold mt-2 text-indigo-400"><?php echo e($stats['total_votes']); ?></h3>
                    <div class="mt-4 text-xs text-indigo-400 font-medium">Secure Transactions</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl">
                    <p class="text-gray-400 text-sm font-medium">Active Positions</p>
                    <h3 class="text-4xl font-bold mt-2"><?php echo e($stats['total_positions']); ?></h3>
                    <div class="mt-4 text-xs text-gray-400 font-medium">Open for Election</div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'attendance'): ?>
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-4">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Filter by Date:</label>
                    <input type="date" wire:model.live="selectedLogDate" class="bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <button wire:click="exportAttendance" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-2 rounded-xl font-bold text-sm shadow-lg shadow-indigo-500/20 transition-all">
                    Download Full List (.CSV)
                </button>
            </div>

            <div wire:poll.5s class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-white/5 border-b border-white/10 text-gray-400 text-xs uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">Time</th>
                            <th class="px-8 py-5">Member Name</th>
                            <th class="px-8 py-5">Staff ID</th>
                            <th class="px-8 py-5">Workplace</th>
                            <th class="px-8 py-5">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $attendance_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-white/5 transition-all">
                            <td class="px-8 py-5 font-mono text-indigo-400"><?php echo e($log->scanned_at->format('H:i:s')); ?></td>
                            <td class="px-8 py-5 font-bold text-white"><?php echo e($log->user->name); ?></td>
                            <td class="px-8 py-5 text-gray-400"><?php echo e($log->user->staff_id); ?></td>
                            <td class="px-8 py-5 text-gray-400 text-sm"><?php echo e($log->user->workplace); ?></td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-green-500/20 text-green-400 border border-green-500/30 rounded-full text-[10px] font-black uppercase">PRESENT</span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($attendance_log->isEmpty()): ?>
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-gray-500 italic">No attendance records found yet.</td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'positions'): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Add Position -->
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl h-fit">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editingPositionId): ?>
                        <h4 class="text-xl font-bold mb-6">Edit Position</h4>
                        <form wire:submit="updatePosition" class="space-y-4">
                            <div>
                                <label class="text-sm text-gray-400">Position Title</label>
                                <input wire:model="editingPositionTitle" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 mt-2 outline-none focus:ring-2 focus:ring-indigo-500">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editingPositionTitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-[10px]"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="flex-1 bg-indigo-600 py-3 rounded-xl font-bold">Save Changes</button>
                                <button type="button" wire:click="cancelPositionEdit" class="bg-white/5 border border-white/10 px-4 py-3 rounded-xl text-gray-400">Cancel</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <h4 class="text-xl font-bold mb-6">Create New Position</h4>
                        <form wire:submit="addPosition" class="space-y-4">
                            <div>
                                <label class="text-sm text-gray-400">Position Title</label>
                                <input wire:model="newPositionName" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 mt-2 outline-none focus:ring-2 focus:ring-indigo-500">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['newPositionName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-[10px]"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 py-3 rounded-xl font-bold">Add Position</button>
                        </form>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                
                <!-- Position List -->
                <div class="md:col-span-2 bg-white/5 border border-white/10 rounded-2xl overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-white/5 border-b border-white/10">
                            <tr>
                                <th class="px-6 py-4 text-sm font-medium text-gray-400">Position Title</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4 font-medium"><?php echo e($pos->title); ?></td>
                                <td class="px-6 py-4 text-right space-x-3">
                                    <button wire:click="editPosition(<?php echo e($pos->id); ?>)" class="text-indigo-400 hover:text-indigo-300 text-sm">Edit</button>
                                    <button onclick="confirm('Are you sure? This will remove all associated nominations.') || event.stopImmediatePropagation()" 
                                        wire:click="deletePosition(<?php echo e($pos->id); ?>)" 
                                        class="text-red-400 hover:text-red-300 text-sm">Remove</button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'candidates'): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Add Candidate -->
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl h-fit">
                    <h4 class="text-xl font-bold mb-6">Nominate Candidate</h4>
                    <form wire:submit="addCandidate" class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-400">Select Position</label>
                            <select wire:model="selectedPosition" class="w-full bg-[#1a1a1c] border border-white/10 rounded-xl px-4 py-3 mt-2 outline-none">
                                <option value="">Choose Position...</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pos->id); ?>"><?php echo e($pos->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm text-gray-400">Select Member</label>
                            <select wire:model="selectedMember" class="w-full bg-[#1a1a1c] border border-white/10 rounded-xl px-4 py-3 mt-2 outline-none">
                                <option value="">Choose Member...</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($m->id); ?>"><?php echo e($m->name); ?> (<?php echo e($m->staff_id); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 py-3 rounded-xl font-bold">Finalize Nomination</button>
                    </form>
                </div>

                <!-- Nomination List -->
                <div class="md:col-span-2 bg-white/5 border border-white/10 rounded-2xl overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-white/5 border-b border-white/10">
                            <tr>
                                <th class="px-6 py-4 text-sm font-medium text-gray-400">Candidate</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-400">Position</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-400">Eligibility Override</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $nominations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-medium"><?php echo e($nom->nominee->name); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo e($nom->nominee->staff_id); ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-xs font-medium"><?php echo e($nom->position->title); ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <button wire:click="toggleOverride(<?php echo e($nom->id); ?>)" 
                                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all <?php echo e($nom->ceo_override ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-white/5 text-gray-400 border border-white/10'); ?>">
                                        <?php echo e($nom->ceo_override ? 'ACTIVE OVERRIDE' : 'GRANT ELIGIBILITY'); ?>

                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'results'): ?>
            <div class="bg-white/5 border border-white/10 rounded-3xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-black/20 border border-white/10 rounded-2xl p-6">
                            <h4 class="text-indigo-400 font-bold mb-4 uppercase tracking-widest text-xs"><?php echo e($pos->title); ?></h4>
                            <div class="space-y-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $nominations->where('position_id', $pos->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $voteCount = $results->where('position_id', $pos->id)->where('nominee_id', $nom->nominee_id)->first()->count ?? 0; ?>
                                    <?php 
                                        $positionTotal = $results->where('position_id', $pos->id)->sum('count');
                                    ?>
                                    <div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span><?php echo e($nom->nominee->name); ?></span>
                                            <span class="font-bold"><?php echo e($voteCount); ?> Votes</span>
                                        </div>
                                        <div class="w-full bg-white/5 h-2 rounded-full overflow-hidden">
                                            <div class="bg-indigo-600 h-full rounded-full transition-all duration-1000" style="width: <?php echo e($positionTotal > 0 ? ($voteCount / $positionTotal * 100) : 0); ?>%"></div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'settings'): ?>
            <div wire:poll.10s class="max-w-xl bg-white/5 border border-white/10 p-8 rounded-3xl">
                <h4 class="text-xl font-bold mb-6">Global Meeting Controls</h4>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('settings_message')): ?>
                    <div class="mb-6 p-4 bg-green-500/20 border border-green-500/30 rounded-2xl text-green-400 text-sm">
                        <?php echo e(session('settings_message')); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <form wire:submit="updateSettings" class="space-y-8">
                    <div wire:ignore class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-white/5 border border-white/10 rounded-2xl">
                        <div class="md:col-span-3 pb-2 border-b border-white/10">
                            <h5 class="text-sm font-bold text-indigo-400 uppercase tracking-widest">Meeting Session Schedule</h5>
                        </div>
                        <div>
                            <label class="block text-[10px] text-gray-500 uppercase mb-2">Meeting Date</label>
                            <input id="meeting-date" type="text" class="w-full bg-[#1a1a1c] border border-white/10 rounded-xl px-4 py-3 text-sm outline-none text-white font-bold cursor-pointer" placeholder="Select Date" value="<?php echo e($meetingDate ? \Carbon\Carbon::parse($meetingDate)->format('d/m/Y') : ''); ?>">
                        </div>
                        <div>
                            <label class="block text-[10px] text-gray-500 uppercase mb-2">Start Time</label>
                            <input id="start-time" type="text" class="w-full bg-[#1a1a1c] border border-white/10 rounded-xl px-4 py-3 text-sm outline-none text-white font-bold cursor-pointer" placeholder="Select Time" value="<?php echo e($startTime ? \Carbon\Carbon::parse($startTime)->format('H:i') : ''); ?>">
                        </div>
                        <div>
                            <label class="block text-[10px] text-gray-500 uppercase mb-2">End Time</label>
                            <input id="end-time" type="text" class="w-full bg-[#1a1a1c] border border-white/10 rounded-xl px-4 py-3 text-sm outline-none text-white font-bold cursor-pointer" placeholder="Select Time" value="<?php echo e($endTime ? \Carbon\Carbon::parse($endTime)->format('H:i') : ''); ?>">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm text-gray-400">Meeting TAC (6 Digits)</label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tacExpiresAt): ?>
                                <div class="text-[10px] font-black text-indigo-400 uppercase tracking-widest flex items-center gap-2">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span id="tac-countdown" data-expiry="<?php echo e(\Carbon\Carbon::parse($tacExpiresAt)->timestamp); ?>">LOADING...</span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <input wire:model="meetingTac" type="text" maxlength="6" 
                            class="w-full bg-[#1a1a1c] border border-white/10 rounded-xl px-6 py-4 text-3xl font-mono tracking-[0.5em] text-center text-indigo-400 outline-none focus:ring-2 focus:ring-indigo-500">
                        <p class="text-[10px] text-gray-500 mt-2">This code rotates automatically every 5 minutes.</p>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-white/5 rounded-2xl border border-white/10">
                        <div>
                            <p class="font-bold">Voting Module</p>
                            <p class="text-xs text-gray-500">Allow members to cast their votes</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="isVotingOpen" class="sr-only peer">
                            <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>

                    <div class="p-6 bg-indigo-600/10 border border-indigo-600/20 rounded-2xl relative overflow-hidden">
                        <div class="flex justify-between items-start mb-3">
                            <label class="block text-sm font-bold text-indigo-400 uppercase tracking-wider">Active Voting Position</label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activePositionId): ?>
                                <span class="bg-red-500 text-white text-[10px] font-black px-2 py-1 rounded animate-pulse">LIVE NOW</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <select wire:model="activePositionId" class="w-full bg-[#1a1a1c] border border-white/10 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-indigo-500 text-white font-bold">
                            <option value="">-- ALL VOTING CLOSED --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pos->id); ?>"><?php echo e($pos->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                        <p class="text-[10px] text-gray-500 mt-2 italic">Selecting a position will instantly open the voting form for members for that role only.</p>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 py-4 rounded-2xl font-bold shadow-xl shadow-indigo-500/20">
                        Update Live Session
                    </button>
                </form>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'paperwork'): ?>
            <div class="space-y-6">
                <div class="flex justify-between items-center">
                    <h4 class="text-xl font-bold">Manage Club Paperwork</h4>
                    <a href="<?php echo e(route('paperwork.index')); ?>" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-2 rounded-xl font-bold text-sm shadow-lg shadow-indigo-500/20 transition-all">
                        Create New Paperwork
                    </a>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-white/5 border-b border-white/10 text-gray-400 text-xs uppercase tracking-widest">
                            <tr>
                                <th class="px-8 py-5">Date</th>
                                <th class="px-8 py-5">Perkara (Title)</th>
                                <th class="px-8 py-5">Budget</th>
                                <th class="px-8 py-5">Status</th>
                                <th class="px-8 py-5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $all_paperworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-white/5 transition-all">
                                <td class="px-8 py-5 font-mono text-indigo-400 text-sm"><?php echo e(\Carbon\Carbon::parse($pw->tarikh)->format('d/m/Y')); ?></td>
                                <td class="px-8 py-5">
                                    <div class="font-bold text-white"><?php echo e($pw->perkara); ?></div>
                                    <div class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">By: <?php echo e($pw->daripada); ?></div>
                                </td>
                                <td class="px-8 py-5 font-bold text-indigo-400">RM <?php echo e(number_format($pw->budgetItems->sum('total_price'), 2)); ?></td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase <?php echo e($pw->status === 'approved' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30'); ?>">
                                        <?php echo e(str_replace('_', ' ', $pw->status)); ?>

                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right space-x-3">
                                    <a href="<?php echo e(route('paperwork.edit', $pw->id)); ?>" class="text-indigo-400 hover:text-indigo-300 text-sm font-bold">Edit</a>
                                    <a href="<?php echo e(route('paperwork.preview', $pw->id)); ?>" target="_blank" class="text-gray-400 hover:text-white text-sm font-bold">Preview PDF</a>
                                    <a href="<?php echo e(route('paperwork.pdf', $pw->id)); ?>" class="text-green-400 hover:text-green-300 text-sm font-bold">Download</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($all_paperworks->isEmpty()): ?>
                            <tr>
                                <td colspan="5" class="px-8 py-10 text-center text-gray-500 italic">No paperwork documents found.</td>
                            </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'manual_reg'): ?>
            <div class="py-10">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('manual-registration');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1067613182-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'members_list'): ?>
            <div class="space-y-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <h4 class="text-xl font-bold">Member Directory</h4>
                    
                    <div class="relative w-full md:w-96">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input wire:model.live="searchTerm" type="text" placeholder="Search name, staff ID, or workplace..." 
                            class="w-full bg-white/5 border border-white/10 rounded-2xl pl-11 pr-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                    </div>
                    
                    <div class="text-sm text-gray-400">Total Registered: <span class="text-indigo-400 font-bold"><?php echo e($members->count()); ?></span> members</div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('member_message')): ?>
                    <div class="p-4 bg-green-500/20 border border-green-500/30 rounded-2xl text-green-400 text-sm">
                        <?php echo e(session('member_message')); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editingMemberId): ?>
                    <!-- Edit Member Form -->
                    <div class="bg-indigo-600/5 border border-indigo-600/20 p-8 rounded-3xl shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4">
                            <button wire:click="cancelEdit" class="text-gray-500 hover:text-white transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <h4 class="text-xl font-bold mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit Member Information
                        </h4>
                        
                        <form wire:submit.prevent="updateMember" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-[10px] text-gray-500 uppercase mb-2">Full Name</label>
                                <input wire:model="editingName" type="text" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editingName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-[10px]"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div>
                                <label class="block text-[10px] text-gray-500 uppercase mb-2">Staff ID</label>
                                <input wire:model="editingStaffId" type="text" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editingStaffId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-[10px]"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div>
                                <label class="block text-[10px] text-gray-500 uppercase mb-2">Workplace</label>
                                <input wire:model="editingWorkplace" type="text" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editingWorkplace'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-400 text-[10px]"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="md:col-span-3 flex justify-end gap-3">
                                <button type="button" wire:click="cancelEdit" class="px-6 py-3 rounded-xl border border-white/10 hover:bg-white/5 transition-all text-sm">Cancel</button>
                                <button type="submit" class="px-8 py-3 bg-indigo-600 rounded-xl font-bold shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition-all text-sm">Save Changes</button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-white/5 border-b border-white/10 text-gray-400 text-xs uppercase tracking-widest">
                            <tr>
                                <th class="px-8 py-5">#</th>
                                <th class="px-8 py-5">Full Name</th>
                                <th class="px-8 py-5">Staff ID</th>
                                <th class="px-8 py-5">Workplace</th>
                                <th class="px-8 py-5">Role</th>
                                <th class="px-8 py-5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-white/5 transition-all <?php echo e($editingMemberId === $m->id ? 'bg-indigo-600/5' : ''); ?>">
                                <td class="px-8 py-5 text-gray-500 font-mono text-sm"><?php echo e($index + 1); ?></td>
                                <td class="px-8 py-5 font-bold text-white uppercase"><?php echo e($m->name); ?></td>
                                <td class="px-8 py-5 text-indigo-400 font-mono"><?php echo e($m->staff_id); ?></td>
                                <td class="px-8 py-5 text-gray-400 text-sm"><?php echo e($m->workplace); ?></td>
                                <td class="px-8 py-5">
                                    <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase <?php echo e($m->role === 'admin' ? 'bg-red-500/20 text-red-400 border border-red-500/30' : 'bg-blue-500/20 text-blue-400 border border-blue-500/30'); ?>">
                                        <?php echo e($m->role); ?>

                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex justify-end items-center gap-3">
                                        <button wire:click="editMember(<?php echo e($m->id); ?>)" class="p-2 hover:bg-indigo-500/20 rounded-lg text-indigo-400 transition-all" title="Edit Member">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </button>
                                        <button onclick="confirm('Are you sure you want to delete this member?') || event.stopImmediatePropagation()" wire:click="deleteMember(<?php echo e($m->id); ?>)" class="p-2 hover:bg-red-500/20 rounded-lg text-red-400 transition-all" title="Delete Member">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($members->isEmpty()): ?>
                            <tr>
                                <td colspan="6" class="px-8 py-10 text-center text-gray-500 italic">No members registered in the system.</td>
                            </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'bulk_upload'): ?>
            <div class="py-10">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('bulk-member-upload');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1067613182-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'org_chart'): ?>
            <div class="py-10">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('club-organization');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1067613182-2', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'nomination_leaderboard'): ?>
            <div class="space-y-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $top_nominations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $positionId => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $position = $items->first()->position; ?>
                    <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
                        <div class="px-8 py-6 bg-indigo-600/10 border-b border-white/10 flex justify-between items-center">
                            <div>
                                <h3 class="text-xl font-bold text-indigo-400 uppercase tracking-wider"><?php echo e($position->title); ?></h3>
                                <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] mt-1">Top 30 Candidates by Nomination Count</p>
                            </div>
                            <div class="px-4 py-2 bg-indigo-600 rounded-xl text-xs font-black shadow-lg shadow-indigo-500/20">
                                <?php echo e($items->count()); ?> CANDIDATES
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-white/5 text-[10px] uppercase tracking-widest text-gray-500">
                                    <tr>
                                        <th class="px-8 py-4">Rank</th>
                                        <th class="px-8 py-4">Candidate Name</th>
                                        <th class="px-8 py-4 text-center">Nomination Count</th>
                                        <th class="px-8 py-4 text-right">Trend</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="hover:bg-white/5 transition-all group">
                                            <td class="px-8 py-6">
                                                <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm <?php echo e($index < 3 ? 'bg-indigo-600 text-white' : 'bg-white/5 text-gray-400'); ?>">
                                                    #<?php echo e($index + 1); ?>

                                                </div>
                                            </td>
                                            <td class="px-8 py-6">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-10 h-10 rounded-full bg-indigo-600/20 border border-indigo-600/30 flex items-center justify-center font-bold text-indigo-400">
                                                        <?php echo e(strtoupper(substr($item->nominee->name, 0, 1))); ?>

                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-white uppercase text-sm"><?php echo e($item->nominee->name); ?></div>
                                                        <div class="text-[10px] text-gray-500 font-mono"><?php echo e($item->nominee->staff_id); ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-6 text-center">
                                                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10">
                                                    <span class="text-xl font-black text-indigo-400"><?php echo e($item->nomination_count); ?></span>
                                                    <span class="text-[10px] text-gray-500 uppercase font-bold">Nominations</span>
                                                </div>
                                            </td>
                                            <td class="px-8 py-6 text-right">
                                                <div class="h-1.5 w-32 bg-white/5 rounded-full ml-auto overflow-hidden">
                                                    <?php $maxNom = $items->first()->nomination_count; ?>
                                                    <div class="bg-indigo-600 h-full rounded-full" style="width: <?php echo e(($item->nomination_count / $maxNom) * 100); ?>%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($top_nominations->isEmpty()): ?>
                    <div class="bg-white/5 border border-white/10 rounded-3xl p-20 text-center">
                        <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-400">No Nominations Yet</h3>
                        <p class="text-gray-600 mt-2 max-w-xs mx-auto">Leaderboard data will appear once members start nominating candidates.</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </main>

    <!-- Flatpickr Integration -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('livewire:navigated', () => {
            initPickers();
        });

        function initPickers() {
            flatpickr("#meeting-date", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d/m/Y",
                theme: "light",
                onChange: function(selectedDates, dateStr) {
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('meetingDate', dateStr);
                }
            });

            flatpickr("#start-time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                altInput: true,
                altFormat: "H:i",
                time_24hr: true,
                theme: "light",
                onChange: function(selectedDates, dateStr) {
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('startTime', dateStr);
                }
            });

            flatpickr("#end-time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                altInput: true,
                altFormat: "H:i",
                time_24hr: true,
                theme: "light",
                onChange: function(selectedDates, dateStr) {
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('endTime', dateStr);
                }
            });
        }

        // Initial load
        initPickers();

        // Live Clock Script
        function updateClock() {
            const now = new Date();
            
            // Format Time (HH:mm:ss)
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('live-clock').textContent = `${hours}:${minutes}:${seconds}`;
            
            // Format Date (DD/MM/YYYY)
            const day = String(now.getDate()).padStart(2, '0');
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const year = now.getFullYear();
            document.getElementById('live-date').textContent = `${day}/${month}/${year}`;
        }

        // TAC Countdown Script
        function updateTACCountdown() {
            const countdownEl = document.getElementById('tac-countdown');
            if (!countdownEl) return;

            const expiry = parseInt(countdownEl.getAttribute('data-expiry'));
            const now = Math.floor(Date.now() / 1000);
            const remaining = expiry - now;

            if (remaining <= 0) {
                countdownEl.textContent = "TAC ROTATING NOW...";
                return;
            }

            if (remaining < 60) {
                countdownEl.textContent = `EXPIRES IN ${remaining} SECONDS FROM NOW`;
            } else {
                const mins = Math.floor(remaining / 60);
                const secs = remaining % 60;
                countdownEl.textContent = `EXPIRES IN ${mins}M ${secs}S FROM NOW`;
            }
        }

        setInterval(() => {
            updateClock();
            updateTACCountdown();
        }, 1000);
        updateClock();
        updateTACCountdown();
    </script>

    <!-- QR Code Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showQrModal): ?>
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
            <div class="bg-[#1a1a1c] border border-white/10 w-full max-w-sm rounded-3xl p-8 shadow-2xl animate-in zoom-in-95 duration-300">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Attendance QR</h3>
                    <button wire:click="toggleQrModal" class="p-2 hover:bg-white/5 rounded-full transition-all text-gray-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="bg-white p-6 rounded-2xl flex items-center justify-center shadow-inner">
                    <?php echo QrCode::size(250)->generate($attendanceUrl); ?>

                </div>

                <div class="mt-8 text-center space-y-4">
                    <div class="p-4 bg-white/5 border border-white/5 rounded-xl">
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-1">Target URL</p>
                        <p class="text-xs font-mono text-indigo-400 break-all"><?php echo e($attendanceUrl); ?></p>
                    </div>
                    <p class="text-xs text-gray-400">Members can scan this code to quickly access the attendance verification page.</p>
                </div>

                <button onclick="window.print()" class="w-full mt-6 bg-indigo-600 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Print QR Code
                </button>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <style>
        .flatpickr-calendar {
            background: #ffffff !important;
            border: none !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4) !important;
            border-radius: 1rem !important;
            padding: 5px;
        }
        .flatpickr-month {
            color: #333 !important;
            fill: #333 !important;
            padding-bottom: 10px !important;
        }
        .flatpickr-weekday {
            color: #666 !important;
            font-weight: bold !important;
        }
        .flatpickr-day {
            color: #333 !important;
            border-radius: 10px !important;
        }
        .flatpickr-day.selected {
            background: #3b82f6 !important;
            border-color: #3b82f6 !important;
            color: white !important;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.5) !important;
        }
        .flatpickr-day:hover {
            background: #f3f4f6 !important;
        }
        .flatpickr-time {
            border-top: 1px solid #eee !important;
        }
        .flatpickr-time input {
            color: #333 !important;
        }
    </style>
</div>
<?php /**PATH C:\Users\aziha\.gemini\antigravity\scratch\agm-voting-system\resources\views/livewire/ceo-dashboard.blade.php ENDPATH**/ ?>