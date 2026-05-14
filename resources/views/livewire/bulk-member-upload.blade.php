<div class="max-w-4xl mx-auto p-8 bg-white/5 border border-white/10 rounded-3xl shadow-2xl backdrop-blur-xl" wire:key="bulk-upload-wrapper">
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-black text-white tracking-tight">Bulk Member Management</h2>
        <p class="text-gray-400 mt-2 text-sm uppercase tracking-widest font-bold">Import Data & Sync Directory</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Step 1: Template -->
        <div class="bg-indigo-600/10 border border-indigo-600/20 p-8 rounded-2xl flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-indigo-600/20 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            </div>
            <h3 class="font-bold text-white mb-2">1. Get Template</h3>
            <p class="text-xs text-gray-400 mb-6 px-4">Ensure your data matches the system requirements.</p>
            <button type="button" wire:click="downloadTemplate" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                Download CSV
            </button>
        </div>

        <!-- Step 2: Upload -->
        <div class="space-y-6">
            <h3 class="font-bold text-white mb-2">2. Upload & Confirm</h3>
            
            <div class="space-y-6">
                @if(!$csvFile)
                    <div 
                        class="relative border-2 border-dashed border-white/10 hover:border-indigo-500/50 rounded-2xl p-10 transition-all group"
                        x-data="{ isDragging: false }"
                        @dragover.prevent="isDragging = true"
                        @dragleave.prevent="isDragging = false"
                        @drop.prevent="isDragging = false"
                        :class="{ 'bg-indigo-600/5 border-indigo-500': isDragging }"
                    >
                        <input type="file" wire:model="csvFile" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        
                        <div class="text-center" wire:loading.remove wire:target="csvFile">
                            <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-indigo-600/10 transition-all">
                                <svg class="w-6 h-6 text-gray-400 group-hover:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            </div>
                            <p class="text-sm font-bold text-gray-300">Click or Drag CSV here</p>
                            <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-widest font-bold">Only CSV files supported</p>
                        </div>

                        <div wire:loading wire:target="csvFile" class="text-center py-4">
                            <div class="w-10 h-10 border-4 border-indigo-500/20 border-t-indigo-500 rounded-full animate-spin mx-auto mb-2"></div>
                            <p class="text-xs text-indigo-400 font-bold animate-pulse">READING FILE...</p>
                        </div>
                    </div>
                @else
                    <div class="p-5 bg-indigo-600/10 border border-indigo-600/20 rounded-2xl flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-600/20 rounded-lg flex items-center justify-center text-indigo-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-white truncate max-w-[150px]">{{ $csvFile->getClientOriginalName() }}</p>
                                <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-widest">{{ $totalRows }} rows detected</p>
                            </div>
                        </div>
                        <button type="button" wire:click="clearFile" class="bg-red-500/10 hover:bg-red-500/20 p-2 rounded-lg text-red-400 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                @endif

                @error('csvFile') 
                    <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400 text-xs font-bold animate-bounce">
                        {{ $message }}
                    </div>
                @enderror

                @if ($previewData)
                    <div class="bg-black/20 border border-white/5 rounded-2xl overflow-hidden shadow-inner">
                        <div class="px-4 py-2 bg-white/5 border-b border-white/5 flex justify-between items-center">
                            <h4 class="text-[10px] font-black text-indigo-400 uppercase tracking-widest">Data Preview</h4>
                        </div>
                        <table class="w-full text-left text-[10px]">
                            <thead>
                                <tr class="bg-white/5">
                                    <th class="px-4 py-2 text-[10px] font-black text-gray-500 uppercase tracking-widest text-left">Name</th>
                                    <th class="px-4 py-2 text-[10px] font-black text-gray-500 uppercase tracking-widest text-left">Staff ID</th>
                                    <th class="px-4 py-2 text-[10px] font-black text-gray-500 uppercase tracking-widest text-left">Workplace</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach ($previewData as $row)
                                    <tr>
                                        <td class="px-4 py-2 text-white font-medium truncate max-w-[100px]">{{ $row[0] }}</td>
                                        <td class="px-4 py-2 text-indigo-400 font-mono">{{ $row[1] }}</td>
                                        <td class="px-4 py-2 text-gray-500 truncate max-w-[80px]">{{ $row[2] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <button 
                    type="button" 
                    wire:click="upload" 
                    wire:loading.attr="disabled"
                    @if(!$csvFile || $totalRows <= 0 || $isProcessing) disabled @endif
                    class="w-full bg-green-600 hover:bg-green-700 disabled:opacity-50 disabled:bg-gray-800 disabled:cursor-not-allowed text-white font-black py-4 rounded-2xl shadow-xl shadow-green-500/20 transition-all flex items-center justify-center gap-3 active:scale-95"
                >
                    <span wire:loading.remove wire:target="upload">
                        @if($csvFile)
                            Confirm & Sync {{ $totalRows }} Members
                        @else
                            Waiting for File...
                        @endif
                    </span>
                    <span wire:loading wire:target="upload" class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        IMPORTING DATA...
                    </span>
                    <svg wire:loading.remove wire:target="upload" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Success/Error Summary -->
    @if ($importSummary)
        <div class="mt-10 p-8 rounded-3xl animate-in zoom-in-95 duration-500 {{ $importSummary['success'] ? 'bg-green-500/10 border border-green-500/20' : 'bg-red-500/10 border border-red-500/20' }}">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center {{ $importSummary['success'] ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                    @if($importSummary['success'])
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    @else
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    @endif
                </div>
                <div>
                    <h4 class="text-2xl font-black {{ $importSummary['success'] ? 'text-green-400' : 'text-red-400' }}">
                        {{ $importSummary['message'] }}
                    </h4>
                    <p class="text-gray-500 text-xs uppercase tracking-widest font-black mt-1">Status Report: {{ now()->format('H:i:s') }}</p>
                </div>
            </div>

            @if($importSummary['success'])
                <div class="grid grid-cols-3 gap-6 mb-8">
                    <div class="bg-black/40 p-5 rounded-2xl text-center border border-white/5">
                        <div class="text-[10px] text-gray-500 uppercase font-black mb-2">New Members</div>
                        <div class="text-3xl font-black text-green-400">{{ $importSummary['count'] }}</div>
                    </div>
                    <div class="bg-black/40 p-5 rounded-2xl text-center border border-white/5">
                        <div class="text-[10px] text-gray-500 uppercase font-black mb-2">Duplicates</div>
                        <div class="text-3xl font-black text-yellow-400">{{ $importSummary['skipped'] }}</div>
                    </div>
                    <div class="bg-black/40 p-5 rounded-2xl text-center border border-white/5">
                        <div class="text-[10px] text-gray-500 uppercase font-black mb-2">Failures</div>
                        <div class="text-3xl font-black text-red-400">{{ $importSummary['errors'] }}</div>
                    </div>
                </div>
            @endif
            
            @if ($logs)
                <h5 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4 px-1">Detailed Execution Logs:</h5>
                <div class="bg-black/60 rounded-2xl p-6 max-h-64 overflow-y-auto space-y-2 border border-white/10 font-mono">
                    @foreach ($logs as $log)
                        <div class="text-[10px] flex items-start gap-4">
                            <span class="text-gray-700 font-bold shrink-0">{{ now()->format('H:i') }}</span>
                            <span class="{{ str_contains($log, 'CRITICAL') ? 'text-red-400' : (str_contains($log, 'Duplicate') ? 'text-yellow-400/60' : 'text-gray-300') }}">
                                {{ $log }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-10 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-6">
                <button wire:click="$set('importSummary', null)" class="text-gray-500 hover:text-white text-[10px] font-black uppercase tracking-widest transition-all">
                    Reset & Upload Another
                </button>
                <button wire:click="$parent.setTab('members_list')" class="bg-indigo-600 hover:bg-indigo-700 px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-2xl shadow-indigo-500/40 group flex items-center gap-3">
                    Go to Member List 
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>
            </div>
        </div>
    @endif
</div>
