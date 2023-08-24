@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="text-center mb-3">{{ __('Customer') }}</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="bg-primary text-white">#</th>
                    <th class="bg-primary text-white">Name</th>
                    <th class="bg-primary text-white">E-mail</th>
                    <th class="bg-primary text-white">Phone</th>
                    <th class="bg-primary text-white">ID</th>
                    <th class="bg-primary text-white">Address</th>
                    <th class="bg-primary text-white">Account</th>
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
                                        $t += $value->price->value;
                                    } else {
                                        $t -= $value->price->value;
                                    }
                                }
                            }
                        @endphp
                        <td>{{ $t }}</td>
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
