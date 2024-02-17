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
                            <td>{{ $i++ }}</td>
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
                    @endforeach
                </tbody>
            </table>
            @include('layouts.pagination')

            @if (Auth::user()->admin)
                <div class="row mb-0">
                    <div class="col-md-2 mt-5">
                        <form action="{{ route('installment.delete', $installment->id) }}" method="post">
                            @csrf
                            <input type="checkbox" class="form-check-input" name="allow" id="allow">
                            <label for="allow" class="mb-2">
                                {{ __('text.allowdelete') }}
                            </label>
                            <button id="delete" type="submit" disabled class="btn btn-danger w-100 btn-block">
                                {{ __('text.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endif
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
