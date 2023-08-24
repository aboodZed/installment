<!--pagination-->

<head>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
</head>
<div class="row mt-5">
    @if ($products->lastPage() > 1)
        <div class="col-lg-2 text-center">
            <h6>Showing {{ ($products->currentPage() - 1) * $products->count() }} to
                {{ $products->currentPage() * $products->count() }} Of {{ $products->total() }}
            </h6>
        </div>
        <div class="col-lg-8">
            <ul class="pagination">
                <li class="page-item {{ $products->currentPage() == 1 ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $products->url($products->currentPage() - 1) }}">
                        < </a>
                </li>
                <li class="page-item {{ $products->currentPage() == 1 ? ' active' : '' }}">
                    <a class="page-link" href="{{ $products->url(1) }}">{{ 1 }}</a>
                </li>
                @php
                    $form = $products->currentPage() - 2;
                    if ($form < 2) {
                        $form = 2;
                    }
                    $to = $products->currentPage() + 2;
                    if ($to > $products->lastPage() - 1) {
                        $to = $products->lastPage() - 1;
                    }
                @endphp
                @if ($form > 2)
                    <li class="page-item disabled">
                        <a class="page-link">...</a>
                    </li>
                @endif
                @for ($i = $form; $i <= $to; $i++)
                    <li class="page-item {{ $products->currentPage() == $i ? ' active' : '' }}">
                        <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                @if ($to < $products->lastPage() - 1)
                    <li class="page-item disabled">
                        <a class="page-link">...</a>
                    </li>
                @endif
                <li class="page-item {{ $products->currentPage() == $products->lastPage() ? ' active' : '' }}">
                    <a class="page-link"
                        href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a>
                </li>
                <li class="page-item {{ $products->currentPage() == $products->lastPage() ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $products->url($products->currentPage() + 1) }}">></a>
                </li>
            </ul>
        </div>
    @endif
</div>
