@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="bg-primary text-white text-center" colspan="2">{{ __('text.customer') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{ __('text.name') }}</th>
                            <td>{{ $customer->user->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('text.phone') }}</th>
                            <td>{{ $customer->user->phone }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('text.idnumber') }}</th>
                            <td>{{ $customer->user->id_number }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('text.email') }}</th>
                            <td>{{ $customer->user->email }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('text.address') }}</th>
                            <td>{{ $customer->address }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table">
                    <thead>
                        <tr>
                            <th class="bg-primary text-white text-center" colspan="2">{{ __('text.appname') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{ __('text.total') }}</th>
                            <td>
                                @php
                                    $t = $customer->restrictions->sum(function ($query) {
                                        return $query->price->value;
                                    });
                                @endphp
                                {{ $t }} {{ $customer->currency->symbol }}
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('text.paid') }}</th>
                            <td>
                                @php
                                    $p = $customer->restrictions->sum(function ($query) {
                                        return $query->paid ? $query->price->value : 0;
                                    });
                                @endphp
                                {{ $p }} {{ $customer->currency->symbol }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('text.rest') }}</th>
                            <td>{{ $t - $p }} {{ $customer->currency->symbol }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-8">

                <form class="row" action="{{ route('filter', $customer->user_id) }}" method="get">
                    <div class="col-md-8">
                        <input class="form-control" type="date" name="date" id="date" required>
                    </div>
                    <div class="col-md-4">
                        <button class="btn" type="submit">
                            <img src="{{ asset('icon/search.svg') }}" alt="" width="20px" height="20px">
                        </button>
                    </div>
                </form>
                <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="bg-primary text-white">#</th>
                            <th class="bg-primary text-white">{{ __('text.amount') }}</th>
                            <th class="bg-primary text-white">{{ __('text.duedate') }}</th>
                            <th class="bg-primary text-white">{{ __('text.paid') }}</th>
                            <th class="bg-primary text-white">{{ __('text.description') }}</th>
                            <th class="bg-primary text-white"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $t = 0;
                            $p = 0;
                        @endphp
                        @foreach ($res as $item)
                            @php
                                $t += $item->price->value;
                                $p += $item->paid ? $item->price->value : 0;
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->is_credit ? -1 * $item->price->value : $item->price->value }}
                                    {{ $item->price->currency->symbol }}</td>
                                <td>{{ $item->pay_date->format('d/m/Y') }}</td>
                                <td><input class="form-check-input" type="checkbox" name="paid"
                                        id="paid{{ $i }}" {{ $item->paid ? 'checked' : '' }} disabled></td>
                                <td><a
                                        href="{{ route('installment.show', $item->installment->id) }}">{{ $item->installment->desc }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('restriction.show', $item->price_id) }}">
                                        <img src="{{ asset('icon/news.svg') }}" alt="" width="20px"
                                            height="20px">
                                    </a>
                                </td>
                            </tr>
                            @php
                                ++$i;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="bg-primary text-white">{{ __('text.total') }} :</th>
                            <td>{{ $t }} {{ $customer->currency->symbol }}</td>
                            <th class="bg-primary text-white">{{ __('text.paid') }} :</th>
                            <td>{{ $p }} {{ $customer->currency->symbol }}</td>
                            <th class="bg-primary text-white">{{ __('text.rest') }} :</th>
                            <td>{{ $t - $p }} {{ $customer->currency->symbol }}</td>
                        </tr>
                    </tfoot>
                </table>
                @php
                    $products = $res;
                @endphp

                @include('layouts.pagination')
            </div>
        </div>
    </div>
@endsection
