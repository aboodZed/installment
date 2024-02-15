@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="offset-md-2 text-center mb-3 mt-3">{{ __('text.update') }}</h2>
                <hr>
                <form method="POST" action="{{ route('admin.edit', $user->id) }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('text.name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

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
                                name="email" value="{{ $user->email }}" required autocomplete="email">

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
                                name="phone" value="{{ $user->phone }}" required autocomplete="phone">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="id_number"
                            class="col-md-4 col-form-label text-md-end">{{ __('text.idnumber') }}</label>

                        <div class="col-md-6">
                            <input id="id_number" type="number"
                                class="form-control @error('id_number') is-invalid @enderror" name="id_number"
                                value="{{ $user->id_number }}" required autocomplete="id_number">

                            @error('id_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4 mt-2">
                            <button type="submit" class="btn btn-primary w-100 btn-block">
                                {{ __('text.update') }}
                            </button>
                        </div>
                    </div>
                </form>
                @if (Auth::user()->admin)
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4 mt-5">
                            <form action="{{ route('admin.delete', $user->id) }}" method="post">
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
