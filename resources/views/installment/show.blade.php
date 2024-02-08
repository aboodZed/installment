@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="justify-content-center">
            <h3 class="text-center"><b>{{ $installment->desc }}</b></h3>
            <br>
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
                        $products = $installment->restrictions()->paginate(30);
                        $i = 1;
                    @endphp
                    @foreach ($products as $item)
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
                            <td>{{ $item->installment->desc }}</td>
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
    </div>
    @include('layouts.pagination')
@endsection
