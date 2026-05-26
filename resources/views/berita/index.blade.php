@extends('layouts.public')
@section('title', 'Berita - SIMTIK POLDA DIY')

@section('content')
{{-- HERO CAROUSEL BANNER --}}
@if(!$carouselItems->isEmpty())
<section class="hero-carousel" style="position: relative; height: 65vh; min-height: 520px; overflow: hidden; background: #0b0f17; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid rgba(255,255,255,0.08); padding-top: 80px;">
    
    <!-- Carousel Slides as background -->
    <div class="carousel-slides" style="width: 100%; height: 100%; display: flex; transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1); position: absolute; top: 0; left: 0; z-index: 1;">
        @foreach($carouselItems as $index => $cb)
        <div class="carousel-slide" style="min-width: 100%; height: 100%; position: relative;">
            @if($cb->gambar)
                <img src="{{ asset($cb->gambar) }}" alt="{{ $cb->judul }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1e293b, #0f172a);"></div>
            @endif
            <!-- Premium Gradated Dark Overlay (Lighter at top, darker at bottom) -->
            <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(11, 15, 23, 0.75) 0%, rgba(11, 15, 23, 0.35) 60%, rgba(11, 15, 23, 0.1) 100%); z-index: 1;"></div>

            <!-- Slide Content Overlay -->
            <div class="carousel-content-wrapper">
                <h1>{{ $cb->judul }}</h1>
                @if($cb->deskripsi)
                    <p>{{ $cb->deskripsi }}</p>
                @endif
                @if($cb->link)
                    <a href="{{ $cb->link }}" class="btn btn-primary btn-carousel-link">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>




    <!-- Navigation Arrows -->
    <button onclick="moveCarousel(-1)" class="carousel-arrow" style="position: absolute; left: 30px; top: 55%; transform: translateY(-50%); background: rgba(255, 255, 255, 0.08); color: #fff; border: none; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease; z-index: 10; backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.15);"><i class="fas fa-chevron-left"></i></button>
    <button onclick="moveCarousel(1)" class="carousel-arrow" style="position: absolute; right: 30px; top: 55%; transform: translateY(-50%); background: rgba(255, 255, 255, 0.08); color: #fff; border: none; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease; z-index: 10; backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.15);"><i class="fas fa-chevron-right"></i></button>

    <!-- Indicators -->
    <div style="position: absolute; bottom: 30px; display: flex; gap: 8px; z-index: 10; justify-content: center; width: 100%;">
        @foreach($carouselItems as $index => $cb)
        <span class="carousel-dot {{ $index === 0 ? 'active' : '' }}" onclick="setCarouselSlide({{ $index }})" style="width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.3); cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"></span>
        @endforeach
    </div>
</section>
@endif

<section class="section section-gray">
    <div class="container">
        {{-- MAIN NEWS GRID --}}
        <div style="max-width:1140px; margin:0 auto; padding-top: 10px;">
            <h2 style="font-family:'Poppins', sans-serif; font-size:1.6rem; font-weight:700; margin-bottom:25px; color:var(--primary); display:flex; align-items:center; gap:10px;">
                <span style="width:4px; height:24px; background:var(--accent); border-radius:2px;"></span>
                Kumpulan Berita & Informasi
            </h2>
            <div class="kegiatan-grid">
                @forelse($beritas as $b)
                <div class="kegiatan-card">
                    @if($b->foto)
                        <img src="{{ asset($b->foto) }}" alt="{{ $b->judul }}">
                    @else
                        <div style="width:100%; height:220px; background:var(--gray-200); display:flex; align-items:center; justify-content:center; color:var(--gray-500); border-bottom: 3px solid var(--accent);">
                            <i class="fas fa-newspaper fa-3x"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="card-date"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }} | <i class="fas fa-clock"></i> {{ $b->created_at->format('H:i') }} WIB</div>
                        <h3 style="display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $b->judul }}</h3>
                        <p style="display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;">{{ Str::limit(strip_tags($b->konten), 120) }}</p>
                        <a href="{{ route('berita.show', $b->id) }}" class="btn btn-outline" style="margin-top:20px; width:100%; justify-content:center; border-color:var(--gray-300); color:var(--primary);">Baca Selengkapnya</a>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; text-align:center; padding: 60px 20px; background:var(--white); border-radius:var(--radius); box-shadow:var(--shadow);">
                    <i class="fas fa-newspaper fa-4x" style="color:var(--gray-300); margin-bottom:20px;"></i>
                    <h3 style="color:var(--gray-700); font-family:'Poppins', sans-serif;">Belum ada berita</h3>
                    <p style="color:var(--gray-500);">Berita akan segera ditambahkan.</p>
                </div>
                @endforelse
            </div>

            <div class="pagination-wrapper" style="margin-top: 50px;">
                {{ $beritas->links() }}
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .carousel-content-wrapper {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        text-align: center;
        padding: 0 100px 90px; /* Lowering the content slightly more */
        z-index: 2;
        color: #fff;
    }
    .hero-carousel h1 {
        font-family: 'Poppins', sans-serif;
        font-size: 2.75rem;
        font-weight: 800;
        line-height: 1.25;
        margin-bottom: 15px;
        color: #ffffff !important;
        text-shadow: 0 4px 15px rgba(0,0,0,0.6);
        max-width: 850px;
        animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .hero-carousel p {
        font-family: 'Inter', sans-serif;
        font-size: 1.05rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9) !important;
        margin-bottom: 25px;
        max-width: 680px;
        text-shadow: 0 2px 8px rgba(0,0,0,0.5);
        animation: fadeIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .btn-carousel-link {
        border-radius: 30px !important;
        padding: 12px 30px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3) !important;
        transition: var(--transition) !important;
        animation: fadeIn 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .btn-carousel-link:hover {
        background: var(--accent-light) !important;
        transform: translateY(-2px) scale(1.02) !important;
        box-shadow: 0 6px 20px rgba(220, 38, 38, 0.5) !important;
    }
    .carousel-arrow:hover {
        background: var(--accent) !important;
        transform: translateY(-50%) scale(1.08);
        border-color: transparent !important;
        box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
    }
    @media (max-width: 768px) {
        .hero-carousel {
            height: 55vh !important;
        }
        .carousel-content-wrapper {
            padding: 0 24px 60px !important; /* Keep nice bottom space on mobile too */
        }
        .hero-carousel h1 {
            font-size: 1.5rem !important;
            margin-bottom: 10px;
        }
        .hero-carousel p {
            font-size: 0.85rem !important;
            margin-bottom: 15px;
            display: -webkit-box !important;
            -webkit-line-clamp: 3 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }
        .btn-carousel-link {
            padding: 8px 20px !important;
            font-size: 0.8rem !important;
        }
        .carousel-arrow {
            display: none !important;
        }
    }
</style>

<script>
    let currentSlide = 0;
    const slidesContainer = document.querySelector('.carousel-slides');
    const dots = document.querySelectorAll('.carousel-dot');
    const totalSlides = {{ $carouselItems->count() }};
    let autoPlayInterval;

    function updateCarousel() {
        if (!slidesContainer) return;
        
        // Slide the background
        slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;

        // Toggle dots
        dots.forEach((dot, idx) => {
            if (idx === currentSlide) {
                dot.classList.add('active');
                dot.style.background = 'var(--accent)';
                dot.style.width = '24px';
                dot.style.borderRadius = '4px';
            } else {
                dot.classList.remove('active');
                dot.style.background = 'rgba(255,255,255,0.3)';
                dot.style.width = '8px';
                dot.style.borderRadius = '50%';
            }
        });
    }

    function moveCarousel(direction) {
        currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
        updateCarousel();
        resetAutoPlay();
    }

    function setCarouselSlide(index) {
        currentSlide = index;
        updateCarousel();
        resetAutoPlay();
    }

    function startAutoPlay() {
        autoPlayInterval = setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }, 6000);
    }

    function resetAutoPlay() {
        clearInterval(autoPlayInterval);
        startAutoPlay();
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateCarousel();
        if (totalSlides > 1) {
            startAutoPlay();
        }
    });
</script>
@endsection
