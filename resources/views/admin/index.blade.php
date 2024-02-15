@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-4">
                <a href="{{ route('admin.create') }}">
                    <button type="button" class="btn btn-primary">
                        {{ __('text.createuser') }}
                    </button></a>
            </div>
            <div class="col-4">
                <h2 class="text-center mb-3">{{ __('text.users') }}</h2>
            </div>
            <div class="col-md-4">
                <form action="{{ route('admin.index') }}" method="get">
                    <div class="row">
                        <div class="col-10">
                            <input class="form-control" type="text" name="name" id="name"
                                placeholder="{{ __('text.name') }}, {{ __('text.phone') }}, {{ __('text.idnumber') }}"
                                required>
                        </div>
                        <div class="col-2">
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
                    <th class="bg-primary text-white">{{ __('text.date') }}</th>
                    <th class="bg-primary text-white"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($users as $item)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->id_number }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td><a href="{{ route('admin.show', $item->id) }}">
                                <img src="{{ asset('icon/news.svg') }}" alt="" width="20px" height="20px">
                            </a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @php
        $products = $users;
    @endphp
    </div>
    @include('layouts.pagination')
@endsection
