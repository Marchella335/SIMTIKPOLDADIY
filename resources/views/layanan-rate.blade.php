@extends('layouts.public')
@section('title', 'Rating Layanan - SIMTIK POLDA DIY')

@section('content')
<section class="section" style="padding-top:120px; min-height:100vh;">
    <div class="container" style="max-width:600px;">
        <div class="section-header">
            <span class="section-badge">CUSTOMER SATISFACTION</span>
            <h2 style="font-family:'Poppins',sans-serif; font-weight:800;">Beri Penilaian Layanan</h2>
            <p style="color:var(--gray-500);">Penilaian Anda membantu kami meningkatkan kualitas layanan TIK.</p>
        </div>

        @if(session('success'))
            <div style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); padding:15px 20px; border-radius:12px; margin-bottom:25px; color:var(--success); font-weight:600; display:flex; align-items:center; gap:10px;">
                <i class="bi bi-check-circle-fill" style="font-size:1.3rem;"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Ticket Info --}}
        <div style="background:var(--white); border-radius:16px; padding:30px; box-shadow:var(--shadow); border:1px solid var(--gray-200); margin-bottom:20px;">
            <h4 style="margin-bottom:15px; font-weight:700;">Detail Tiket #{{ $layanan->id }}</h4>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                <div style="padding:12px; background:var(--gray-50); border-radius:8px;">
                    <small style="color:var(--gray-500);">Pemohon</small>
                    <p style="font-weight:600;">{{ $layanan->nama_pemohon }}</p>
                </div>
                <div style="padding:12px; background:var(--gray-50); border-radius:8px;">
                    <small style="color:var(--gray-500);">Jenis Layanan</small>
                    <p style="font-weight:600; color:var(--accent);">{{ $layanan->jenis_layanan }}</p>
                </div>
                <div style="padding:12px; background:var(--gray-50); border-radius:8px; grid-column:span 2;">
                    <small style="color:var(--gray-500);">Status</small>
                    <p>
                        @if($layanan->status == 'Pending')
                            <span style="background:var(--warning); color:#000; padding:4px 12px; border-radius:6px; font-size:0.85rem; font-weight:600;">⏳ Pending</span>
                        @elseif($layanan->status == 'In Progress')
                            <span style="background:var(--info); color:#fff; padding:4px 12px; border-radius:6px; font-size:0.85rem; font-weight:600;">🔄 In Progress</span>
                        @else
                            <span style="background:var(--success); color:#fff; padding:4px 12px; border-radius:6px; font-size:0.85rem; font-weight:600;">✅ Completed</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- Rating Form (only if Completed) --}}
        @if($layanan->status == 'Completed')
        <div style="background:var(--white); border-radius:16px; padding:30px; box-shadow:var(--shadow); border:1px solid var(--gray-200);">
            <form action="{{ route('layanan.submit-rate', $layanan->token) }}" method="POST">
                @csrf
                <div style="text-align:center; margin-bottom:25px;">
                    <p style="font-weight:600; margin-bottom:15px;">Seberapa puas Anda dengan layanan kami?</p>
                    <div id="ratingStars" style="display:flex; justify-content:center; gap:12px;">
                        @for($s = 1; $s <= 5; $s++)
                            <label style="cursor:pointer;">
                                <input type="radio" name="rating" value="{{ $s }}" style="display:none;" {{ $layanan->rating == $s ? 'checked' : '' }} required>
                                <i class="bi bi-star-fill rating-star" data-value="{{ $s }}" style="font-size:2.5rem; color:{{ $s <= ($layanan->rating ?? 0) ? '#f59e0b' : 'var(--gray-200)' }}; transition:all 0.2s;"></i>
                            </label>
                        @endfor
                    </div>
                    <p id="ratingText" style="margin-top:10px; color:var(--gray-500); font-size:0.9rem;">Klik bintang untuk memberi rating</p>
                </div>

                <div style="margin-bottom:20px;">
                    <label style="font-weight:600; margin-bottom:8px; display:block;">Feedback (Opsional)</label>
                    <textarea name="feedback" rows="4" placeholder="Bagikan pengalaman Anda..." style="width:100%; padding:12px 16px; border:1px solid var(--gray-200); border-radius:10px; font-size:0.95rem; resize:vertical; outline:none;">{{ $layanan->feedback }}</textarea>
                </div>

                <button type="submit" style="width:100%; background:var(--accent); color:#fff; border:none; padding:14px; border-radius:10px; font-size:1rem; font-weight:700; cursor:pointer; transition:var(--transition);">
                    <i class="bi bi-check-lg"></i> Kirim Penilaian
                </button>
            </form>
        </div>
        @else
        <div style="background:var(--white); border-radius:16px; padding:40px; box-shadow:var(--shadow); border:1px solid var(--gray-200); text-align:center;">
            <i class="bi bi-hourglass-split" style="font-size:3rem; color:var(--warning); margin-bottom:15px; display:block;"></i>
            <h4 style="font-weight:700; margin-bottom:10px;">Layanan Belum Selesai</h4>
            <p style="color:var(--gray-500);">Anda dapat memberikan penilaian setelah layanan selesai dikerjakan oleh tim kami. Silakan cek kembali nanti.</p>
        </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
const labels = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];
document.querySelectorAll('.rating-star').forEach(star => {
    star.addEventListener('click', function() {
        const val = this.dataset.value;
        this.closest('label').querySelector('input').checked = true;
        document.querySelectorAll('.rating-star').forEach(s => {
            s.style.color = s.dataset.value <= val ? '#f59e0b' : 'var(--gray-200)';
        });
        document.getElementById('ratingText').textContent = labels[val];
    });
    star.addEventListener('mouseenter', function() {
        const val = this.dataset.value;
        document.querySelectorAll('.rating-star').forEach(s => {
            s.style.color = s.dataset.value <= val ? '#f59e0b' : 'var(--gray-200)';
            s.style.transform = s.dataset.value <= val ? 'scale(1.2)' : 'scale(1)';
        });
        document.getElementById('ratingText').textContent = labels[val];
    });
});
document.getElementById('ratingStars').addEventListener('mouseleave', function() {
    const checked = document.querySelector('input[name="rating"]:checked');
    const val = checked ? checked.value : 0;
    document.querySelectorAll('.rating-star').forEach(s => {
        s.style.color = s.dataset.value <= val ? '#f59e0b' : 'var(--gray-200)';
        s.style.transform = 'scale(1)';
    });
    document.getElementById('ratingText').textContent = val > 0 ? labels[val] : 'Klik bintang untuk memberi rating';
});
</script>
@endsection
