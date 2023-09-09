@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('customer.create') }}">
                    <button type="button" class="btn btn-primary">
                        {{ __('text.createcustomer') }}
                    </button></a>
            </div>
            <div class="col-4">
                <h2 class="text-center mb-3">{{ __('text.customers') }}</h2>
            </div>
            <div class="col-4">
                <form action="{{ route('customer.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="name" id="name"
                                placeholder="{{ __('text.name') }}, {{ __('text.phone') }}, {{ __('text.idnumber') }}" required>
                        </div>
                        <div class="col-md-4">
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
                    <th class="bg-primary text-white">{{ __('text.name') }}</th>
                    <th class="bg-primary text-white">{{ __('text.email') }}</th>
                    <th class="bg-primary text-white">{{ __('text.phone') }}</th>
                    <th class="bg-primary text-white">{{ __('text.idnumber') }}</th>
                    <th class="bg-primary text-white">{{ __('text.address') }}</th>
                    <th class="bg-primary text-white">{{ __('text.account') }}</th>
                    <th class="bg-primary text-white"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($customers as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>{{ $item->user->phone }}</td>
                        <td>{{ $item->user->id_number }}</td>
                        <td>{{ $item->address }}</td>
                        @php
                            ++$i;
                            $t = 0;
                            foreach ($item->restrictions as $value) {
                                if (!$value->paid) {
                                    if ($value->is_credit) {
                                        $t -= $value->price->value;
                                    } else {
                                        $t += $value->price->value;
                                    }
                                }
                            }
                        @endphp
                        <td>{{ $t }} {{ $item->currency->symbol }}</td>
                        <td><a href="{{ route('customer.show', $item->user_id) }}">
                                <img src="{{ asset('icon/news.svg') }}" alt="" width="20px" height="20px">
                            </a>
                            <a class="" href="{{ route('restriction.create', $item->user_id) }}">
                                <img src="{{ asset('icon/invoice.svg') }}" alt="" width="20px" height="20px">
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @php
        $products = $customers;
    @endphp

    @include('layouts.pagination')
@endsection
