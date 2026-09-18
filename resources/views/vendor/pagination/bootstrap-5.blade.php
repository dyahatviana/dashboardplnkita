@if ($paginator->hasPages())
    <nav class="d-flex flex-column align-items-center justify-content-center w-100 gap-2 my-2" aria-label="Navigasi Halaman">
        <ul class="pagination pagination-custom mb-0 justify-content-center align-items-center flex-wrap">
            {{-- Tombol Sebelumnya (Previous) --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">
                        <i class="bi bi-chevron-left me-1"></i>
                        <span>Previous</span>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                        <i class="bi bi-chevron-left me-1"></i>
                        <span>Previous</span>
                    </a>
                </li>
            @endif

            {{-- Nomor Halaman (Pagination Elements) --}}
            @foreach ($elements as $element)
                {{-- Pemisah Tiga Titik (...) --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Link Halaman --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Selanjutnya (Next) --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                        <span>Next</span>
                        <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">
                        <span>Next</span>
                        <i class="bi bi-chevron-right ms-1"></i>
                    </span>
                </li>
            @endif
        </ul>

        {{-- Info Rangkuman Data --}}
        <div class="text-muted small text-center mt-1">
            Menampilkan <span class="fw-semibold text-dark">{{ $paginator->firstItem() }}</span> sampai <span class="fw-semibold text-dark">{{ $paginator->lastItem() }}</span> dari <span class="fw-semibold text-dark">{{ $paginator->total() }}</span> tugas
        </div>
    </nav>
@endif
