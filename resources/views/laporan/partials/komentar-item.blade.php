{{-- Discord-style comment item --}}
{{-- Semua komentar rata kiri, reply menampilkan quoted message di atas --}}
@php $depth = $depth ?? 0; @endphp

<div class="group flex gap-3 px-2 py-1 hover:bg-stone-50 rounded-lg transition-colors" id="komentar-{{ $komentar->id }}">

    {{-- Avatar --}}
    <div class="flex-shrink-0 mt-0.5">
        <div style="width:36px; height:36px; border-radius:50%; background:{{ $komentar->parent_id ? '#D4621A' : '#7C9EB2' }}; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:#fff;">
            {{ strtoupper(substr($komentar->user->name, 0, 2)) }}
        </div>
    </div>

    {{-- Konten --}}
    <div class="flex-1 min-w-0">

        {{-- Quoted reply (jika ini adalah balasan) --}}
        @if($komentar->parent)
            <div class="flex items-start gap-1.5 mb-1 text-xs text-stone-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 flex-shrink-0 mt-0.5 text-stone-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 14 4 9 9 4"/><path d="M20 20v-7a4 4 0 0 0-4-4H4"/>
                </svg>
                <div class="flex items-center gap-1.5 min-w-0 cursor-pointer hover:text-stone-600 transition-colors" onclick="document.getElementById('komentar-{{ $komentar->parent->id }}')?.scrollIntoView({behavior:'smooth', block:'center'})">
                    {{-- Mini avatar --}}
                    <div style="width:14px; height:14px; border-radius:50%; background:#D4621A; display:flex; align-items:center; justify-content:center; font-size:7px; font-weight:700; color:#fff; flex-shrink:0;">
                        {{ strtoupper(substr($komentar->parent->user->name, 0, 2)) }}
                    </div>
                    <span class="font-semibold text-stone-500">{{ $komentar->parent->user->name }}</span>
                    <span class="truncate text-stone-400">{{ Str::limit($komentar->parent->isi, 60) }}</span>
                </div>
            </div>
        @endif

        {{-- Header: nama + waktu --}}
        <div class="flex items-baseline gap-2 mb-0.5">
            <span class="text-sm font-semibold text-stone-800">{{ $komentar->user->name }}</span>
            <span class="text-xs text-stone-400">{{ $komentar->created_at->format('d M Y') }} pukul {{ $komentar->created_at->format('H:i') }}</span>
        </div>

        {{-- Isi pesan --}}
        <div class="text-sm text-stone-700 leading-relaxed">{{ $komentar->isi }}</div>

        {{-- Tombol balas (muncul saat hover) --}}
        <div class="mt-1 opacity-0 group-hover:opacity-100 transition-opacity">
            <button onclick="window.toggleReply({{ $komentar->id }})"
                class="inline-flex items-center gap-1 text-xs text-stone-400 hover:text-orange-600 bg-transparent border-none cursor-pointer font-medium transition-colors px-0 py-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 14 4 9 9 4"/><path d="M20 20v-7a4 4 0 0 0-4-4H4"/>
                </svg>
                Balas
            </button>
        </div>

        {{-- Reply Form --}}
        <div id="reply-form-{{ $komentar->id }}" style="display:none;" class="mt-3">
            <form action="{{ route('komentar.store', $laporan->id) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
                <div class="flex gap-2 items-start bg-stone-100 rounded-xl px-3 py-2">
                    {{-- Preview siapa yang dibalas --}}
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-stone-400 mb-1.5 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 14 4 9 9 4"/><path d="M20 20v-7a4 4 0 0 0-4-4H4"/>
                            </svg>
                            Membalas <span class="font-semibold text-stone-500">{{ $komentar->user->name }}</span>
                        </div>
                        <textarea name="isi" rows="1" required
                            placeholder="Tulis balasan..."
                            class="w-full bg-transparent border-none outline-none resize-none text-sm text-stone-900 placeholder-stone-400 leading-relaxed py-0.5 font-sans"
                            oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px'"></textarea>
                    </div>
                    <div class="flex gap-1.5 flex-shrink-0 self-end">
                        <button type="button" onclick="window.toggleReply({{ $komentar->id }})"
                            class="px-2.5 py-1.5 text-xs text-stone-500 hover:text-stone-700 bg-transparent border border-stone-300 rounded-lg cursor-pointer transition-colors font-medium">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-3 py-1.5 bg-orange-600 hover:bg-orange-700 text-white rounded-lg text-xs font-semibold cursor-pointer transition-colors">
                            Kirim
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
