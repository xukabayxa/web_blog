@if ($paginator->hasPages())
    <div class="paginatoin-area">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <ul class="pagination-box">
                    @if (!$paginator->onFirstPage())
                        <li>
                            <a class="Next load-product" href="{{ $paginator->previousPageUrl() }}" ng-click="loadProducts()">Trang trước</a>
                        </li>
                    @endif

                        @foreach ($elements as $element)
                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())

                                        <li class="active"><a href="#">{{ $page }}</a></li>

                                    @else
                                        <li><a class="load-product" href="{{ $url }}" ng-click="loadProducts()">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @if ($paginator->hasMorePages())
                            <li>
                                <a class="Next load-product" href="{{ $paginator->nextPageUrl() }}" ng-click="loadProducts()">Trang sau</a>
                            </li>
                        @endif
                </ul>
            </div>
        </div>
    </div>
@endif
