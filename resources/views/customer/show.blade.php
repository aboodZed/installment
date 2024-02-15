@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <form method="POST" action="{{ route('admin.edit', $customer->user->id) }}">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white text-center" colspan="2">{{ __('text.customer') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{ __('text.name') }}</th>
                                <td>
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ $customer->user->name }}" required autofocus>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('text.phone') }}</th>
                                <td><input id="phone" type="number" class="form-control" name="phone"
                                        value="{{ $customer->user->phone }}" required></td>
                            </tr>
                            <tr>
                                <th>{{ __('text.idnumber') }}</th>
                                <td>
                                    <input id="id_number" type="number" class="form-control" name="id_number"
                                        value="{{ $customer->user->id_number }}" required>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('text.email') }}</th>
                                <td>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ $customer->user->email }}" required>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('text.address') }}</th>
                                <td>
                                    <input id="address" type="text" class="form-control" name="address"
                                        value="{{ $customer->address }}">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-small btn-primary w-100 btn-block">
                                        {{ __('text.update') }}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="bg-primary text-white text-center">
                                {{ __('text.search') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <form class="row" action="{{ route('customer.filter', $customer->user_id) }}"
                                    method="get">
                                    <div class="col-md-8">
                                        <input class="form-control" type="date" name="date" id="date" required>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn" type="submit">
                                            <img src="{{ asset('icon/search.svg') }}" alt="" width="20px"
                                                height="20px">
                                        </button>
                                    </div>
                                </form>
                            </td>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th class="bg-danger text-white text-center" colspan="2"> {{ __('text.delete') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input" name="allow" id="allow">
                                <label for="allow" class="mb-2"> {{ __('text.allowdelete') }} </label>
                            </td>
                            <td>
                                @if (Auth::user()->admin)
                                    <form action="{{ route('customer.delete', $customer->user->id) }}" method="post">
                                        @csrf
                                        <button id="delete" type="submit" disabled
                                            class="btn btn-danger w-100 btn-block">
                                            {{ __('text.delete') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-8">
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

@section('script')
    <script>
        $(function() {
            $('#allow').change(function(e) {
                if (this.checked) {
                    $('#delete').attr("disabled", false);
                } else {
                    $('#delete').attr("disabled", true);
                }
            })
        });
    </script>
@endsection
