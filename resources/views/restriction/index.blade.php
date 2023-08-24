@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="text-center mb-3">{{ __('Restriction') }}</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="bg-primary text-white">#</th>
                    <th class="bg-primary text-white">Description</th>
                    <th class="bg-primary text-white">Amount</th>
                    <th class="bg-primary text-white">is Paid</th>
                    <th class="bg-primary text-white">Due Date</th>
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
                        <td>{{ $item->desc }}</td>
                        <td>{{ $item->is_credit ? $item->price->value : -1 * $item->price->value }}
                            {{ $item->price->currency->symbol }}</td>
                        <td><input class="form-check-input" type="checkbox" name="paid" id="paid{{ $i }}"
                                {{ $item->paid ? 'checked' : '' }} disabled></td>
                        <td>{{ $item->pay_date->format('d/m/Y') }}</td>
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