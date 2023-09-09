@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <h2 class="offset-md-2 text-center mb-3 mt-3">{{ __('text.createcustomer') }}</h2>

                <form method="POST" action="{{ route('customer.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('text.name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('text.email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('text.phone') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="id_number" class="col-md-4 col-form-label text-md-end">{{ __('text.idnumber') }}</label>

                        <div class="col-md-6">
                            <input id="id_number" type="number"
                                class="form-control @error('id_number') is-invalid @enderror" name="id_number"
                                value="{{ old('id_number') }}" required autocomplete="id_number">

                            @error('id_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('text.address') }}</label>

                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                name="address" value="{{ old('address') }}" required autocomplete="address">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="currency" class="col-md-4 col-form-label text-md-end">{{ __('text.currency') }}</label>

                        <div class="col-md-6">
                            <select id="currency" class="form-control @error('currency') is-invalid @enderror"
                                name="currency" required autocomplete="currency">
                                @php
                                    $currency = App\Models\Currency::all();
                                @endphp
                                @foreach ($currency as $item)
                                    <option value="{{ $item->code }}">{{ $item->symbol }} - {{ $item->code }}</option>
                                @endforeach
                            </select>

                            @error('currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4 mt-2">
                            <button type="submit" class="btn btn-primary w-100 btn-block">
                                {{ __('text.create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
