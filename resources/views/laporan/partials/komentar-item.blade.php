{{-- Recursive comment item partial --}}
{{-- Variables: $komentar, $laporan, $depth (nesting level) --}}
@php $depth = $depth ?? 0; @endphp

<div style="display:flex; gap:{{ $depth === 0 ? '12' : '10' }}px; margin-top:{{ $depth > 0 ? '12' : '0' }}px; {{ $depth > 0 ? 'padding-left:20px; border-left:2px solid rgba(212,98,26,' . max(0.08, 0.2 - ($depth * 0.05)) . ');' : '' }}" id="komentar-{{ $komentar->id }}">
    <div style="width:{{ $depth === 0 ? '32' : '24' }}px; height:{{ $depth === 0 ? '32' : '24' }}px; border-radius:50%; background:{{ $depth === 0 ? '#7C9EB2' : '#D4621A' }}; display:flex; align-items:center; justify-content:center; font-size:{{ $depth === 0 ? '11' : '9' }}px; font-weight:700; color:#fff; flex-shrink:0;">
        {{ strtoupper(substr($komentar->user->name, 0, 2)) }}
    </div>
    <div style="flex:1; min-width:0;">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:{{ $depth === 0 ? '6' : '4' }}px;">
            <span style="font-size:{{ $depth === 0 ? '13' : '12' }}px; font-weight:600; color:#1A1A18;">{{ $komentar->user->name }}</span>
            <span style="font-size:11px; color:#8A8A7A;">{{ $komentar->created_at->format('d M Y, H:i') }}</span>
        </div>

        <div style="font-size:13px; color:#4A4A42; line-height:1.5; margin-bottom:8px;">{{ $komentar->isi }}</div>

        <button onclick="window.toggleReply({{ $komentar->id }})"
            class="inline-flex items-center gap-1 text-xs text-stone-400 hover:text-orange-600 bg-transparent border-none cursor-pointer font-medium transition-colors px-0">
            ↩ Balas
        </button>

        {{-- Reply Form --}}
        <div id="reply-form-{{ $komentar->id }}" style="display:none; margin-top:12px; padding-left:20px; border-left:2px solid #F0EDE8;">
            <form action="{{ route('komentar.store', $laporan->id) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
                <textarea name="isi" rows="2" required placeholder="Tulis balasan untuk {{ $komentar->user->name }}..."
                    style="width:100%; padding:9px 12px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; background:#FAFAF8; outline:none; resize:none; box-sizing:border-box;"></textarea>
                <div style="display:flex; gap:8px; margin-top:8px;">
                    <button type="submit" style="padding:6px 16px; background:#D4621A; color:#fff; border:none; border-radius:6px; font-family:'DM Sans',sans-serif; font-size:12px; font-weight:600; cursor:pointer;">Kirim</button>
                    <button type="button" onclick="window.toggleReply({{ $komentar->id }})" style="padding:6px 16px; border:1.5px solid #D8D4CC; background:transparent; color:#4A4A42; border-radius:6px; font-family:'DM Sans',sans-serif; font-size:12px; cursor:pointer;">Batal</button>
                </div>
            </form>
        </div>

        {{-- Recursive Replies --}}
        @if($komentar->replies && $komentar->replies->count() > 0)
            @foreach($komentar->replies as $childReply)
                @include('laporan.partials.komentar-item', ['komentar' => $childReply, 'laporan' => $laporan, 'depth' => $depth + 1])
            @endforeach
        @endif
    </div>
</div>
