@extends('layouts.app')

@section('content')
    <style>
        .footer-container {
            max-width: 100%;
            box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.3);
            margin: 0 auto;
            padding: 12px;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: auto;
            text-align: center;
            background-color: white
        }
    </style>
    <div class="container">
        <form action="{{ route('restriction.store') }}" method="post">
            @csrf
            <table class="table">
                @php
                    $customer = App\Models\Customer::find($id);
                @endphp
                <thead>
                    <tr>
                        <th class="bg-primary text-white text-center">{{ __('text.idnumber') }}</th>
                        <td><input class="form-control" type="number" name="customer" id="customer" value="{{ $id }}"
                                readonly></td>
                        <th class="bg-primary text-white text-center">{{ __('text.name') }}</th>
                        <td><input class="form-control" type="text" value="{{ $customer->user->name }}" readonly></td>
                        <th class="bg-primary text-white text-center">{{ __('text.date') }}</th>
                        <td><input class="form-control" type="date" value="{{ now()->format('Y-m-d') }}" readonly></td>
                        <th class="bg-primary text-white text-center">{{ __('text.time') }}</th>
                        <td><input class="form-control" type="time" value="{{ now()->format('H:i') }}"></td>
                    </tr>
                    <tr>
                        <th class="bg-primary text-white text-center">{{ __('text.amount') }}</th>
                        <td><input class="form-control" type="number" step="0.01" name="total" id="total"
                                placeholder="{{ $customer->currency->symbol }}" autofocus></td>
                        <th class="bg-primary text-white text-center">{{ __('text.period') }}</th>
                        <td><select class="form-control" name="period" id="period">
                                <option value="days">{{ __('text.daily') }}</option>
                                <option value="weeks">{{ __('text.weekly') }}</option>
                                <option value="months">{{ __('text.monthly') }}</option>
                                <option value="years">{{ __('text.yearly') }}</option>
                            </select></td>
                        <th class="bg-primary text-white text-center">{{ __('text.start') }}</th>
                        <td><input class="form-control" type="date" value="{{ now()->format('Y-m-d') }}" name="start"
                                id="start">
                        </td>
                        <th class="bg-primary text-white text-center">{{ __('text.number') }}</th>
                        <td><input class="form-control" type="number" value="1" name="num" id="num"
                                placeholder="number of period"></td>
                    </tr>
            </table>
            <table class="table table-hover mb-5">
                <thead>
                    <tr class="text-center">
                        <th class="bg-primary text-white">#</th>
                        <th class="bg-primary text-white">{{ __('text.description') }}</th>
                        <th class="bg-primary text-white">{{ __('text.amount') }}</th>
                        <th class="bg-primary text-white">{{ __('text.duedate') }}</th>
                    </tr>
                </thead>
                <tbody id="body">
                </tbody>
            </table>
            <footer>
                <div class="footer-container">
                    <button type="submit" class="btn btn-primary">{{ __('text.save') }}</button>
                </div>
            </footer>
        </form>
    </div>
@endsection


@section('script')
    <script>
        $(function() {
            var i = 0;

            let total = $('#total');
            let period = $('#period');
            let num = $('#num');
            let start = $('#start');
            let body = $('#body');
            let add = $('#add');

            total.keyup(function(e) {
                create();
            });

            start.change(function(e) {
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

            function create() {
                var n = parseInt(num.val());
                body.empty();
                i = 0;
                for (let index = 0; index < n; index++) {
                    addRow();
                }
            }

            function addRow() {
                var d = moment(new Date(start.val()))
                    .add(i, period.val()).format('YYYY-MM-DD');
                ++i;

                var t = (parseFloat(total.val()) / parseInt(num.val())).toFixed(2);

                body.append(
                    '<tr>' +
                    '<td class="text-center">' + i + '</td>' +
                    '<td><input class="form-control" type="text"name="res[' + i + '][desc]" id="desc"' +
                    'placeholder="description"></td>' +
                    '<td><input class="form-control" type="number" name="res[' + i +
                    '][amount]" id="amount' + i + '" value="' + t + '" step="0.01" required></td>' +
                    '<td><input class="form-control" type="date" name="res[' + i +
                    '][date]" id="date" value="' + d + '" required></td>' +
                    '</tr>')

                $('#amount' + i).keyup(function(e) {
                    getTotal();
                })
            }

            function getTotal() {
                t = 0;
                $('#body tr td:nth-child(3) input').each(function() {
                    t += parseInt($(this).val());
                });
                total.val(t);
            }
        });
    </script>
@endsection
