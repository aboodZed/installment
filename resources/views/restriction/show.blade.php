@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <h2 class="offset-md-2 text-center mb-3 mt-5">{{ __('text.restriction') }}</h2>

                <form action="{{ route('restriction.edit', $res->price_id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                        <label for="amount" class="col-md-4 col-form-label text-md-end">{{ __('text.amount') }}</label>

                        <div class="col-md-6">
                            <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror"
                                name="amount" value="{{ $res->price->value }}" required autocomplete="amount" autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('text.duedate') }}</label>

                        <div class="col-md-6">
                            <input id="date" type="date" class="form-control @error('date') is-invalid @enderror"
                                name="date" value="{{ $res->pay_date->format('Y-m-d') }}" required autocomplete="date"
                                autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="paid" class="col-md-4 col-form-label text-md-end">{{ __('text.paid') }}</label>

                        <div class="col-md-6">
                            <input id="paid" type="checkbox"
                                class="form-check-input @error('paid') is-invalid @enderror" name="paid"
                                {{ $res->paid ? 'checked' : '' }} autofocus>
                            <label for="paid">{{ __('text.ispaid') }}</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="desc" class="col-md-4 col-form-label text-md-end">{{ __('text.description') }}</label>

                        <div class="col-md-6">
                            <input id="desc" type="text" class="form-control @error('desc') is-invalid @enderror"
                                name="desc" value="{{ $res->desc }}" autocomplete="desc" autofocus>

                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4 mt-2">
                            <button type="submit" class="btn btn-primary w-100 btn-block">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
