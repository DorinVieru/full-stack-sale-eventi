@extends('layouts.app')
@section('content')

<div class="jumbotron p-3 bg-light rounded-3">
    <div class="container py-5">
        <div class="logo_laravel text-danger text-center fs-1 fw-bold">
            ResEasy
        </div>
        <h1 class="display-6 mb-5 text-center">
            Benvenuto/a nella tua personale Dashboard di ResEasy!
        </h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header bg-dark text-center text-white"> <i class="fas fa-user"></i> Sei un utente registrato?</h5>
                    <div class="card-body text-center">
                        <p class="card-text">Effettua il login.</p>
                        <button class="btn btn-primary"><a class="text-decoration-none text-white" href="http://127.0.0.1:8000/login">Accedi</a></button>
                    </div>
                    <div class="card-footer fst-italic text-center">
                        OPPURE
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text">Puoi registrarti ed entrare a far parte della nostra piattaforma!</p>
                        <button class="btn btn-primary"><a class="text-decoration-none text-white" href="http://127.0.0.1:8000/register">Registrati</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection