<div class="space-y-6" wire:key="bulk-upload-wrapper">

    {{-- ── Header ────────────────────────────────────────────────────────────── --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-white tracking-tight">Bulk Member Management</h2>
            <p class="text-gray-500 text-xs uppercase tracking-widest font-bold mt-1">Import Data & Sync Directory</p>
        </div>
        <button wire:click="downloadTemplate" type="button"
            class="inline-flex items-center gap-2 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/20 px-4 py-2.5 rounded-xl text-xs font-bold text-gray-400 hover:text-white transition-all shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Download Template
        </button>
    </div>

    {{-- ── Step 1 · Drop zone (no file selected yet) ─────────────────────────── --}}
    @if (!$csvFile && !$result)

        <div class="relative border-2 border-dashed border-white/10 hover:border-indigo-500/40 rounded-2xl transition-all duration-200 group"
            x-data="{ dragging: false }"
            @dragover.prevent="dragging = true"
            @dragleave.prevent="dragging = false"
            @drop.prevent="dragging = false"
            :class="dragging ? 'border-indigo-500 bg-indigo-500/5' : ''">

            <input type="file" wire:model="csvFile"
                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                accept=".csv,.txt">

            {{-- Idle --}}
            <div class="py-20 flex flex-col items-center text-center px-6"
                wire:loading.remove wire:target="csvFile">
                <div class="w-14 h-14 rounded-2xl bg-white/5 group-hover:bg-indigo-600/10 flex items-center justify-center mb-5 transition-all">
                    <svg class="w-7 h-7 text-gray-500 group-hover:text-indigo-400 transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                </div>
                <p class="text-white font-bold mb-1.5">Drop your CSV here, or click to browse</p>
                <p class="text-gray-500 text-xs leading-relaxed">
                    CSV files only &nbsp;·&nbsp; Max 2 MB<br>
                    Required columns: <span class="text-gray-400 font-mono">Name, Staff ID, Workplace</span>
                </p>
            </div>

            {{-- Reading --}}
            <div class="py-20 flex flex-col items-center" wire:loading wire:target="csvFile">
                <div class="w-10 h-10 border-4 border-indigo-500/20 border-t-indigo-500 rounded-full animate-spin mb-4"></div>
                <p class="text-indigo-400 text-sm font-bold animate-pulse">Reading file…</p>
            </div>
        </div>

        @error('csvFile')
            <div class="flex items-start gap-3 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                <svg class="w-4 h-4 text-red-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-red-400 text-xs font-medium leading-relaxed">{{ $message }}</p>
            </div>
        @enderror

    @endif

    {{-- ── Step 2 · Preview & confirm ─────────────────────────────────────────── --}}
    @if ($csvFile && !$result)

        {{-- File bar --}}
        <div class="flex items-center justify-between gap-4 p-4 bg-indigo-600/10 border border-indigo-600/20 rounded-2xl">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 shrink-0 bg-indigo-600/20 rounded-lg flex items-center justify-center text-indigo-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ $csvFile->getClientOriginalName() }}</p>
                    <p class="text-xs text-indigo-400 font-mono">
                        {{ $totalRows }} member{{ $totalRows !== 1 ? 's' : '' }} ready to import
                    </p>
                </div>
            </div>
            <button wire:click="clearFile" type="button"
                class="shrink-0 p-2 rounded-lg text-gray-500 hover:text-red-400 hover:bg-red-500/10 transition-all"
                title="Remove file">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Preview table --}}
        @if ($previewRows)
            <div class="rounded-2xl overflow-hidden border border-white/5 bg-black/20">
                <div class="px-5 py-3 bg-white/5 border-b border-white/5 flex items-center justify-between">
                    <span class="text-[11px] font-black text-indigo-400 uppercase tracking-widest">
                        Data Preview
                    </span>
                    <span class="text-[10px] text-gray-600">
                        Showing {{ count($previewRows) }} of {{ $totalRows }} rows
                    </span>
                </div>
                <table class="w-full text-xs">
                    <thead>
                        <tr class="bg-white/[0.03]">
                            <th class="px-5 py-3 text-left text-[10px] font-black text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-5 py-3 text-left text-[10px] font-black text-gray-500 uppercase tracking-wider">Staff ID</th>
                            <th class="px-5 py-3 text-left text-[10px] font-black text-gray-500 uppercase tracking-wider">Workplace</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.04]">
                        @foreach ($previewRows as $row)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-5 py-3 text-white font-medium">{{ $row['name'] }}</td>
                                <td class="px-5 py-3 text-indigo-400 font-mono">{{ $row['staff_id'] }}</td>
                                <td class="px-5 py-3 text-gray-400">{{ $row['workplace'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Import button --}}
        <button wire:click="import" wire:loading.attr="disabled" type="button"
            class="w-full flex items-center justify-center gap-3 py-4 bg-indigo-600 hover:bg-indigo-500 disabled:opacity-60 disabled:cursor-wait rounded-2xl text-white font-black text-sm uppercase tracking-widest transition-all active:scale-[0.99] shadow-lg shadow-indigo-500/20">

            <span wire:loading.remove wire:target="import" class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Import {{ $totalRows }} Member{{ $totalRows !== 1 ? 's' : '' }}
            </span>

            <span wire:loading wire:target="import" class="flex items-center gap-2">
                <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                </svg>
                Importing…
            </span>
        </button>

    @endif

    {{-- ── Step 3 · Results ────────────────────────────────────────────────────── --}}
    @if ($result)
        @php $fatal = isset($result['error']); @endphp

        <div class="rounded-3xl border p-8 {{ $fatal ? 'bg-red-500/5 border-red-500/20' : 'bg-emerald-500/5 border-emerald-500/20' }}">

            {{-- Title row --}}
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0
                    {{ $fatal ? 'bg-red-500/20 text-red-400' : 'bg-emerald-500/20 text-emerald-400' }}">
                    @if ($fatal)
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    @endif
                </div>
                <div>
                    <h3 class="text-xl font-black {{ $fatal ? 'text-red-400' : 'text-emerald-400' }}">
                        {{ $fatal ? 'Import Failed' : 'Import Complete' }}
                    </h3>
                    <p class="text-gray-500 text-xs mt-0.5">{{ now()->format('d M Y, H:i:s') }}</p>
                </div>
            </div>

            {{-- Fatal error message --}}
            @if ($fatal)
                <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-xl mb-8">
                    <p class="text-red-300 text-xs font-mono leading-relaxed">{{ $result['error'] }}</p>
                </div>
            @else
                {{-- Stats grid --}}
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="bg-black/30 border border-white/5 rounded-2xl p-5 text-center">
                        <p class="text-[10px] text-gray-500 uppercase font-black tracking-wider mb-2">Added</p>
                        <p class="text-3xl font-black text-emerald-400">{{ $result['added'] }}</p>
                    </div>
                    <div class="bg-black/30 border border-white/5 rounded-2xl p-5 text-center">
                        <p class="text-[10px] text-gray-500 uppercase font-black tracking-wider mb-2">Duplicates</p>
                        <p class="text-3xl font-black text-yellow-400">{{ $result['duplicates'] }}</p>
                    </div>
                    <div class="bg-black/30 border border-white/5 rounded-2xl p-5 text-center">
                        <p class="text-[10px] text-gray-500 uppercase font-black tracking-wider mb-2">Failed</p>
                        <p class="text-3xl font-black text-red-400">{{ $result['failed'] }}</p>
                    </div>
                </div>
            @endif

            {{-- Execution log --}}
            @if ($logs)
                <div class="mb-8">
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Execution Log</p>
                    <div class="bg-black/50 border border-white/5 rounded-xl p-4 max-h-60 overflow-y-auto space-y-1.5 font-mono">
                        @foreach ($logs as $entry)
                            <div class="text-[11px] flex items-start gap-2.5">
                                @if ($entry['type'] === 'ok')
                                    <span class="text-emerald-500 shrink-0 mt-px">✓</span>
                                    <span class="text-gray-300">{{ $entry['msg'] }}</span>
                                @elseif ($entry['type'] === 'duplicate')
                                    <span class="text-yellow-500 shrink-0 mt-px">⊘</span>
                                    <span class="text-yellow-400/70">{{ $entry['msg'] }}</span>
                                @else
                                    <span class="text-red-500 shrink-0 mt-px">✗</span>
                                    <span class="text-red-400">{{ $entry['msg'] }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Action buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-white/10">
                <button wire:click="resetAll" type="button"
                    class="text-xs font-bold text-gray-500 hover:text-white uppercase tracking-wider transition-colors">
                    ← Import Another File
                </button>
                <button wire:click="$parent.setTab('members_list')" type="button"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-indigo-500/20">
                    View Member List
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </button>
            </div>
        </div>

    @endif

</div>
