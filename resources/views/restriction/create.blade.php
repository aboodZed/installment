@extends('layouts.app')

@section('content')
    <style>
        .footer-container {
            max-width: 100%;
            box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.3);
            margin: 0 auto;
            position: fixed;
            padding: 10px;
            padding-left: 50px;
            padding-right: 50px;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white
        }
    </style>
    <div class="container">
        <form action="{{ route('restriction.store') }}" method="post">
            @csrf
            @php
                $customer = App\Models\Customer::find($id);
            @endphp

            <input class="form-control" type="hidden" name="customer" id="customer" value="{{ $id }}" readonly>
            <div class="row text-end mb-2">
                <div class="col-md-1">{{ __('text.amount') }}</div>
                <div class="col-md-2"><input class="form-control" type="number" step="0.01" name="total"
                        id="total" placeholder="{{ $customer->currency->symbol }}" autofocus></div>
                <div class="col-md-1">{{ __('text.repeat') }}</div>
                <div class="col-md-1"><select class="form-control" name="period" id="period">
                        <option value="days">{{ __('text.daily') }}</option>
                        <option value="weeks">{{ __('text.weekly') }}</option>
                        <option value="months">{{ __('text.monthly') }}</option>
                        <option value="years">{{ __('text.yearly') }}</option>
                    </select></div>

                <div class="col-md-1">{{ __('text.number_repeat') }}</div>
                <div class="col-md-1"><input class="form-control" type="number" value="1" name="num"
                        id="num" placeholder="number of period"></div>
                <div class="col-md-1">{{ __('text.description') }}</div>
                <div class="col-md-4"><input class="form-control" type="text" name="desc" id="desc"
                        placeholder="{{ __('text.description') }}"></div>

            </div>
            <table class="table table-hover" style="margin-bottom: 150px">
                <thead>
                    <tr class="text-center">
                        <th class="bg-primary text-white">{{ __('text.description') }}</th>
                        <th class="bg-primary text-white">{{ __('text.amount') }}</th>
                        <th class="bg-primary text-white">{{ __('text.duedate') }}</th>
                    </tr>
                </thead>
                <tbody id="body">
                </tbody>
            </table>
            <footer>
                <div class="footer-container row">
                    <div class="col-md-2">
                        <h6>{{ __('text.time') }} : {{ now()->format('H:i:s') }}</h6>
                        <h6>{{ __('text.date') }} : {{ now()->format('Y-m-d') }}</h6>
                    </div>
                    <div class="col-md-8">
                        <h5><b>{{ $customer->user->name }}</b></h5>
                        <h6>{{ $customer->user->phone }}, {{ $customer->user->email }}</h6>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">{{ __('text.save') }}</button>
                    </div>
                </div>
            </footer>
        </form>
    </div>
@endsection


@section('script')
    <script>
        $(function() {

            let total = $('#total');
            let period = $('#period');
            let num = $('#num');
            let body = $('#body');

            var start = '{{ now()->format('Y-m-d') }}';
            var desc = '';

            total.keyup(function(e) {
                create();
            });

            total.change(function(e) {
                create();
            });

            period.change(function(e) {
                create();
            });

            num.keyup(function(e) {
                create();
            });

            num.change(function(e) {
                create();
            });

            $('#desc').keyup(function(e) {
                desc = $('#desc').val();
                create();
            });

            function create() {
                var n = parseInt(num.val());
                body.empty();
                for (let index = 0; index < n; index++) {
                    addRow(index);
                    editRow();
                }
            }

            function editRow() {
                $('#date0').change(function(e) {
                    start = $('#date0').val();
                    create();
                });
            }

            function addRow(i) {
                var d = moment(new Date(start))
                    .add(i, period.val()).format('YYYY-MM-DD');

                var t = (parseFloat(total.val()) / parseInt(num.val())).toFixed(2);

                body.append(
                    '<tr>' +
                    '<td><input class="form-control" type="text"name="res[' + i + '][desc]" id="desc' + i +
                    '" placeholder="description" value="' + desc + '"></td>' +
                    '<td><input class="form-control" type="number" name="res[' + i +
                    '][amount]" id="amount' + i + '" value="' + t + '" step="0.01" required></td>' +
                    '<td><input class="form-control" type="date" name="res[' + i +
                    '][date]" id="date' + i + '" value="' + d + '" required></td>' +
                    '</tr>');

                $('#amount' + i).keyup(function(e) {
                    getTotal();
                });
            }

            function getTotal() {
                t = 0;
                $('#body tr td:nth-child(2) input').each(function() {
                    t += parseInt($(this).val());
                });
                total.val(t);
            }
        });
    </script>
@endsection
