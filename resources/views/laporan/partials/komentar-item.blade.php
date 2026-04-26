{{-- Recursive comment item partial --}}
@php $depth = $depth ?? 0; @endphp

<div class="flex gap-2.5 {{ $depth > 0 ? 'mt-3.5 pl-4 border-l-2 border-stone-200' : '' }}" id="komentar-{{ $komentar->id }}">

    {{-- Avatar --}}
    <div class="{{ $depth === 0 ? 'w-8 h-8 text-xs' : 'w-6 h-6 text-[9px]' }} rounded-full {{ $depth === 0 ? 'bg-sky-700' : 'bg-orange-600' }} flex items-center justify-center font-bold text-white flex-shrink-0 tracking-wide">
        {{ strtoupper(substr($komentar->user->name, 0, 2)) }}
    </div>

    <div class="flex-1 min-w-0">

        {{-- Bubble --}}
        <div class="{{ $depth === 0 ? 'bg-stone-50 border-stone-200 rounded-xl' : 'bg-stone-100 border-stone-200 rounded-lg' }} border px-3.5 py-2.5 mb-1.5">
            <div class="flex items-center gap-2 mb-1">
                <span class="{{ $depth === 0 ? 'text-sm' : 'text-xs' }} font-semibold text-stone-900">{{ $komentar->user->name }}</span>
                <span class="text-[11px] text-stone-400">{{ $komentar->created_at->diffForHumans() }}</span>
            </div>
            <p class="text-sm text-stone-700 leading-relaxed m-0">{{ $komentar->isi }}</p>
        </div>

        {{-- Balas Button --}}
        <button onclick="window.toggleReply({{ $komentar->id }})"
            class="inline-flex items-center gap-1 text-xs text-stone-400 hover:text-orange-600 bg-transparent border-none cursor-pointer font-medium transition-colors px-0.5">
            <span>↩</span> Balas
        </button>

        {{-- Reply Form --}}
        <div id="reply-form-{{ $komentar->id }}" class="hidden mt-2.5">
            <form action="{{ route('komentar.store', $laporan->id) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
                <textarea name="isi" rows="2" required placeholder="Balas {{ $komentar->user->name }}..."
                    class="w-full px-3 py-2 border border-stone-200 rounded-lg text-sm bg-stone-50 outline-none resize-none leading-relaxed focus:border-orange-500 transition-colors text-stone-900"></textarea>
                <div class="flex gap-2 mt-2">
                    <button type="submit"
                        class="px-4 py-1.5 bg-orange-600 hover:bg-orange-700 text-white border-none rounded-lg text-xs font-semibold cursor-pointer transition-colors">
                        Kirim
                    </button>
                    <button type="button" onclick="window.toggleReply({{ $komentar->id }})"
                        class="px-4 py-1.5 border border-stone-200 hover:border-stone-300 bg-transparent text-stone-600 rounded-lg text-xs cursor-pointer transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>

        {{-- Recursive Replies --}}
        @if($komentar->allReplies && $komentar->allReplies->count() > 0)
            @foreach($komentar->allReplies as $childReply)
                @include('laporan.partials.komentar-item', [
                    'komentar' => $childReply,
                    'laporan' => $laporan,
                    'depth' => $depth + 1
                ])
            @endforeach
        @endif

    </div>
</div>