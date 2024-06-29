@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Utente') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Benvenuto nel tuo gestionale!') }}
                    <div class="my-5">
                            <a href="{{ route('admin.rooms.index') }}"
                                class="link-dash text-decoration-none bg-body-secondary p-3 rounded-4 text-dark {{ Route::currentRouteName() == 'admin.rooms.index' ? 'bg-secondary' : '' }}">
                                Elecono delle sale Meeting
                            </a>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('admin.events.index') }}"
                            class="link-dash text-decoration-none bg-body-secondary p-3 rounded-4 text-dark {{ Route::currentRouteName() == 'admin.events.index' ? 'bg-secondary' : '' }}">
                            Eventi in programma
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
