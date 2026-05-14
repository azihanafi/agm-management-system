<div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-2xl rounded-lg overflow-hidden border border-gray-200">
        <!-- Document Header Branding -->
        <div class="bg-slate-900 py-6 px-10 text-white flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">FJB GROUP SPORT CLUB</h1>
                <p class="text-slate-400 text-sm">Paperwork Digitalization System</p>
            </div>
            <div class="text-right">
                <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase {{ $status === 'approved' ? 'bg-green-500 text-white' : ($status === 'rejected' ? 'bg-red-500 text-white' : 'bg-yellow-500 text-black') }}">
                    Status: {{ str_replace('_', ' ', $status) }}
                </span>
            </div>
        </div>

        <div class="p-10 space-y-12 text-gray-800">
            <!-- Header Section -->
            <section class="grid grid-cols-1 md:grid-cols-2 gap-8 border-b pb-10 border-gray-100">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Kepada</label>
                        <input type="text" wire:model="kepada" placeholder="Nama Penerima" class="w-full border-gray-200 rounded-md focus:ring-slate-500 focus:border-slate-500 text-lg font-semibold">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">s.k. (Carbon Copy)</label>
                        <input type="text" wire:model="sk" placeholder="Pihak Terlibat" class="w-full border-gray-200 rounded-md focus:ring-slate-500 focus:border-slate-500 text-sm">
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Daripada</label>
                        <input type="text" wire:model="daripada" placeholder="Nama Pengirim" class="w-full border-gray-200 rounded-md focus:ring-slate-500 focus:border-slate-500 text-lg font-semibold">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Tarikh</label>
                        <input type="date" wire:model="tarikh" class="w-full border-gray-200 rounded-md focus:ring-slate-500 focus:border-slate-500 text-sm">
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Perkara</label>
                    <input type="text" wire:model="perkara" placeholder="Tajuk Kertas Kerja" class="w-full border-gray-200 rounded-md focus:ring-slate-500 focus:border-slate-500 text-xl font-bold">
                </div>
            </section>

            <!-- Objective Section -->
            <section class="space-y-6">
                <div class="flex items-center space-x-4 border-l-4 border-slate-900 pl-4">
                    <h2 class="text-xl font-bold uppercase tracking-tight">1. OBJEKTIF</h2>
                </div>
                <div class="bg-slate-50 p-6 rounded-lg border border-slate-100 space-y-4">
                    <p class="text-gray-600 text-sm italic mb-4">Sila lengkapkan butiran program di bawah untuk menjana blok objektif:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Program</label>
                            <input type="text" wire:model="program_title" class="w-full border-gray-200 rounded-md text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Tarikh Program</label>
                            <input type="date" wire:model="program_date" class="w-full border-gray-200 rounded-md text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Hari</label>
                            <input type="text" wire:model="program_day" placeholder="Contoh: Sabtu" class="w-full border-gray-200 rounded-md text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Masa</label>
                            <input type="text" wire:model="program_time" placeholder="Contoh: 8:00 AM - 5:00 PM" class="w-full border-gray-200 rounded-md text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Lokasi</label>
                            <input type="text" wire:model="program_location" class="w-full border-gray-200 rounded-md text-sm">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Requirement Modules -->
            <section class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-4">
                    <div class="flex items-center space-x-4 border-l-4 border-slate-900 pl-4">
                        <h2 class="text-lg font-bold uppercase tracking-tight">2. SYARAT PENYERTAAN</h2>
                    </div>
                    <textarea wire:model="syarat_penyertaan" rows="5" class="w-full border-gray-200 rounded-md text-sm placeholder-gray-400" placeholder="Masukkan syarat penyertaan..."></textarea>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4 border-l-4 border-slate-900 pl-4">
                        <h2 class="text-lg font-bold uppercase tracking-tight">3. CADANGAN SYARAT PERTANDINGAN</h2>
                    </div>
                    <textarea wire:model="cadangan_syarat" rows="5" class="w-full border-gray-200 rounded-md text-sm placeholder-gray-400" placeholder="Masukkan cadangan syarat pertandingan..."></textarea>
                </div>
            </section>

            <!-- Itinerary Section -->
            <section class="space-y-6">
                <div class="flex items-center space-x-4 border-l-4 border-slate-900 pl-4">
                    <h2 class="text-xl font-bold uppercase tracking-tight">4. ATURCARA KEJOHANAN</h2>
                </div>
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Masa</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Aktiviti / Perkara</th>
                                <th class="px-6 py-3 text-right"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($itineraryItems as $index => $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="text" wire:model="itineraryItems.{{ $index }}.time" placeholder="08:00 AM" class="border-none focus:ring-0 w-32 text-sm">
                                </td>
                                <td class="px-6 py-4">
                                    <input type="text" wire:model="itineraryItems.{{ $index }}.activity" placeholder="Pendaftaran Peserta" class="border-none focus:ring-0 w-full text-sm">
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button wire:click="removeItineraryItem({{ $index }})" class="text-red-400 hover:text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button wire:click="addItineraryItem" class="flex items-center space-x-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    <span>Tambah Baris Aturcara</span>
                </button>
            </section>

            <!-- Budget Section -->
            <section class="space-y-6">
                <div class="flex items-center space-x-4 border-l-4 border-slate-900 pl-4">
                    <h2 class="text-xl font-bold uppercase tracking-tight">5. BAJET KEJOHANAN</h2>
                </div>
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest w-12">No</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Maklumat</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-widest w-24">Harga (RM)</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-widest w-20">Kuantiti</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-widest w-20">Unit</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-widest w-28">Jumlah (RM)</th>
                                <th class="px-4 py-3 text-right"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($budgetItems as $index => $item)
                            <tr>
                                <td class="px-4 py-4 text-sm text-gray-400">{{ $index + 1 }}</td>
                                <td class="px-4 py-4">
                                    <input type="text" wire:model.blur="budgetItems.{{ $index }}.description" placeholder="Item perbelanjaan" class="border-none focus:ring-0 w-full text-sm">
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <input type="number" step="0.01" wire:model.live="budgetItems.{{ $index }}.price" class="border-none focus:ring-0 w-full text-right text-sm">
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <input type="number" wire:model.live="budgetItems.{{ $index }}.quantity" class="border-none focus:ring-0 w-full text-right text-sm">
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <input type="text" wire:model.blur="budgetItems.{{ $index }}.unit" class="border-none focus:ring-0 w-full text-center text-sm">
                                </td>
                                <td class="px-4 py-4 text-right font-semibold text-sm">
                                    {{ number_format($item['total_price'], 2) }}
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <button wire:click="removeBudgetItem({{ $index }})" class="text-red-400 hover:text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-slate-900 text-white">
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-right font-bold uppercase tracking-widest text-sm">JUMLAH HARGA KESELURUHAN</td>
                                <td class="px-6 py-4 text-right text-lg font-black">RM {{ number_format($total_budget, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button wire:click="addBudgetItem" class="flex items-center space-x-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    <span>Tambah Baris Bajet</span>
                </button>
            </section>
        </div>

        <!-- Document Footer / Actions -->
        <div class="bg-slate-50 p-8 border-t border-gray-100 flex justify-between items-center">
            <div class="flex space-x-4">
                <button wire:click="save(false)" class="px-6 py-2 bg-white border border-gray-300 rounded-md text-sm font-semibold text-gray-700 hover:bg-gray-50 transition shadow-sm">
                    Simpan Draf
                </button>
                <button wire:click="save(true)" class="px-6 py-2 bg-slate-900 text-white rounded-md text-sm font-semibold hover:bg-slate-800 transition shadow-md">
                    Hantar Kertas Kerja
                </button>
            </div>
            
            @if($status !== 'draft')
            <div class="flex space-x-4">
                @if($current_level == 2)
                    <button wire:click="approve(2)" class="px-6 py-2 bg-blue-600 text-white rounded-md text-sm font-semibold hover:bg-blue-700 transition">
                        Bersetuju (Penyelaras)
                    </button>
                @elseif($current_level == 3)
                    <button wire:click="approve(3)" class="px-6 py-2 bg-purple-600 text-white rounded-md text-sm font-semibold hover:bg-purple-700 transition">
                        Sokong (Bendahari)
                    </button>
                @elseif($current_level == 4)
                    <button wire:click="approve(4)" class="px-6 py-2 bg-green-600 text-white rounded-md text-sm font-semibold hover:bg-green-700 transition">
                        Lulus (Yang Di-Pertua)
                    </button>
                @endif
                
                @if(in_array($current_level, [2,3,4]))
                    <button wire:click="reject({{ $current_level }})" class="px-6 py-2 bg-red-600 text-white rounded-md text-sm font-semibold hover:bg-red-700 transition">
                        Tolak
                    </button>
                @endif
            </div>
            @endif
        </div>
    </div>

    @if(session()->has('message'))
    <div class="mt-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md text-center font-semibold animate-pulse">
        {{ session('message') }}
    </div>
    @endif
</div>
