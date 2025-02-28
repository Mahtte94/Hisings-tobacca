<div class="flex justify-center mt-6">
    <nav role="navigation" aria-label="Pagination" class="flex items-center space-x-2">
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-gray-300 cursor-not-allowed">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg">Previous</a>
        @endif

        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            <a href="{{ $url }}" class="px-4 py-2 {{ $page == $paginator->currentPage() ? 'bg-blue-500 text-white' : 'text-white hover:bg-blue-500' }} rounded-lg">{{ $page }}</a>
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg">Next</a>
        @else
            <span class="px-4 py-2 text-gray-300 cursor-not-allowed">Next</span>
        @endif
    </nav>
</div>
