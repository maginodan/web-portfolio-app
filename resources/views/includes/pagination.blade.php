
@if ($paginator->hasPages())

    <div class="text-center">
        <nav>
            <ul class="pagination">

                {{-- Previous Page --}}
                @if ($paginator->onFirstPage())

                    <li class="page-item disabled"
                        aria-disabled="true"
                        aria-label="Previous">

                        <span class="page-link" aria-hidden="true">‹</span>

                    </li>

                @else

                    <li class="page-item">

                        <a class="page-link"
                           href="{{ $paginator->previousPageUrl() }}"
                           rel="prev"
                           aria-label="Previous">

                            ‹

                        </a>

                    </li>

                @endif

                {{-- Pagination Elements --}}
                @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)

                    @if ($page == $paginator->currentPage())

                        <li class="page-item active"
                            aria-current="page">

                            <span class="page-link">
                                {{ $page }}
                            </span>

                        </li>

                    @else

                        <li class="page-item">

                            <a class="page-link"
                               href="{{ $url }}">

                                {{ $page }}

                            </a>

                        </li>

                    @endif

                @endforeach


                {{-- Next Page --}}
                @if ($paginator->hasMorePages())

                    <li class="page-item">

                        <a class="page-link"
                           href="{{ $paginator->nextPageUrl() }}"
                           rel="next"
                           aria-label="Next">

                            ›

                        </a>

                    </li>

                @else

                    <li class="page-item disabled"
                        aria-disabled="true"
                        aria-label="Next">

                        <span class="page-link" aria-hidden="true">
                            ›
                        </span>

                    </li>

                @endif

            </ul>
        </nav>
    </div>

@endif

