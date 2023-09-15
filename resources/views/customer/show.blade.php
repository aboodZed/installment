@extends('layouts.app')

@section('content')
    <div class="container">

        <table class="table">
            <thead>
                <tr>
                    <th class="bg-primary text-white text-center">{{ __('text.name') }}</th>
                    <td>{{ $customer->user->name }}</td>
                    <th class="bg-primary text-white text-center">{{ __('text.phone') }}</th>
                    <td>{{ $customer->user->phone }}</td>
                    <th class="bg-primary text-white text-center">{{ __('text.idnumber') }}</th>
                    <td>{{ $customer->user->id_number }}</td>
                </tr>
                <tr>
                    <th class="bg-primary text-white text-center">{{ __('text.email') }}</th>
                    <td>{{ $customer->user->email }}</td>
                    <th class="bg-primary text-white text-center">{{ __('text.address') }}</th>
                    <td colspan="3">{{ $customer->address }}</td>
                </tr>
        </table>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="bg-primary text-white">#</th>
                    <th class="bg-primary text-white">{{ __('text.description') }}</th>
                    <th class="bg-primary text-white">{{ __('text.amount') }}</th>
                    <th class="bg-primary text-white">{{ __('text.paid') }}</th>
                    <th class="bg-primary text-white">{{ __('text.duedate') }}</th>
                    <th class="bg-primary text-white"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($customer->restrictions as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->desc }}</td>
                        <td>{{ $item->is_credit ?  -1 * $item->price->value : $item->price->value }}
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
@endsection
