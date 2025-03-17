@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-6">
    <div class="flex gap-1">
        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 border text-gray-400 rounded-md cursor-not-allowed">
                &laquo;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 border text-gray-700 rounded-md hover:bg-gray-100 transition">
                &laquo;
            </a>
        @endif

        {{-- Nomor Halaman --}}
        @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            $start = max(1, $currentPage - 2);
            $end = min($lastPage, $currentPage + 2);
        @endphp

        @foreach ($paginator->getUrlRange($start, $end) as $page => $url)
            @if ($page == $paginator->currentPage())
                <span class="px-4 py-2 border bg-blue-500 text-white rounded-md">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $url }}" class="px-4 py-2 border text-gray-700 rounded-md hover:bg-gray-100 transition">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 border text-gray-700 rounded-md hover:bg-gray-100 transition">
                &raquo;
            </a>
        @else
            <span class="px-4 py-2 border text-gray-400 rounded-md cursor-not-allowed">
                &raquo;
            </span>
        @endif
    </div>
</nav>
@endif