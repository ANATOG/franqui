@if ($paginator->lastPage() > 1)
    <ul class="component__pagination">
        <!-- if actual page is not equals 1, and there is more than 5 pages then I show first page button -->
        @if ($paginator->currentPage() != 1 && $paginator->lastPage() >= 5)
            <!--<li class="pagination__item pagination__arrow">
                <a href="{{ $paginator->url($paginator->url(1)) }}" >
                    <<
                </a>
            </li>-->
        @endif

        <!-- if actual page is not equal to one then I show the forward button-->
        @if($paginator->currentPage() != 1)
            <li class="pagination__item pagination__arrow pagination__arrow--left">
                <a href="{{ $paginator->url($paginator->currentPage()-1) }}" >
                    <svg width="100%" height="100%" viewBox="0 0 50 70">
                        <use xlink:href="#svg-symbol__arrow-2"></use>
                    </svg>
                </a>
            </li>
        @endif

        <!-- I draw the pages... I show 2 pages back and 2 pages forward -->
        @for($i = max($paginator->currentPage()-2, 1); $i <= min(max($paginator->currentPage()-2, 1)+4,$paginator->lastPage()); $i++)
            <li class="pagination__item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- if actual page is not equal last page then I show the forward button-->
        @if ($paginator->currentPage() != $paginator->lastPage())
            <li class="pagination__item pagination__arrow pagination__arrow--right">
                <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >
                    <svg width="100%" height="100%" viewBox="0 0 50 70">
                        <use xlink:href="#svg-symbol__arrow-2"></use>
                    </svg>
                </a>
            </li>
        @endif

        <!-- if actual page is not equal last page, and there is more than 5 pages then I show last page button -->
        @if ($paginator->currentPage() != $paginator->lastPage() && $paginator->lastPage() >= 5)
            <!--<li class="pagination__item pagination__arrow">
                <a href="{{ $paginator->url($paginator->lastPage()) }}" >
                    >>
                </a>
            </li>-->
        @endif
    </ul>
@endif