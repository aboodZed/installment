@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <h2 class="text-center mb-3">{{ __('text.restrictions') }}</h2>
            </div>
            <div class="col-md-4">
                <form action="{{ route('restriction.index') }}" method="get">
                    <div class="row">
                        <div class="col-10">
                            <input class="form-control" type="date" name="date" id="date"
                                value="{{ $date }}" required>
                        </div>
                        <div class="col-2">
                            <button class="btn" type="submit">
                                <img src="{{ asset('icon/search.svg') }}" alt="" width="20px" height="20px">
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="bg-primary text-white">#</th>
                    <th class="bg-primary text-white">{{ __('text.customer') }}</th>
                    <th class="bg-primary text-white">{{ __('text.duedate') }}</th>
                    <th class="bg-primary text-white">{{ __('text.amount') }}</th>
                    <th class="bg-primary text-white">{{ __('text.paid') }}</th>
                    <th class="bg-primary text-white">{{ __('text.description') }}</th>
                    <th class="bg-primary text-white"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($res as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>
                            <a href="{{ route('customer.show', $item->installment->customer_id) }}">
                                {{ $item->installment->user->user->name }}
                            </a>
                        </td>
                        <td>{{ $item->pay_date->format('d/m/Y') }}</td>
                        <td>{{ $item->is_credit ? -1 * $item->price->value : $item->price->value }}
                            {{ $item->price->currency->symbol }}</td>
                        <td><input class="form-check-input" type="checkbox" name="paid" id="paid{{ $i }}"
                                {{ $item->paid ? 'checked' : '' }} disabled></td>
                        <td><a
                                href="{{ route('installment.show', $item->installment->id) }}">{{ $item->installment->desc }}</a>
                        </td>
                        <td>
                            <a href="{{ route('restriction.show', $item->price_id) }}">
                                <img src="{{ asset('icon/news.svg') }}" alt="" width="20px" height="20px">
                            </a>
                        </td>
                    </tr>
                    @php
                        ++$i;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    @php
        $products = $res;
    @endphp

    @include('layouts.pagination')
@endsection
