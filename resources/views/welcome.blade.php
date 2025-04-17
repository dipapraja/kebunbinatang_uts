@extends('layouts.template')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card bg-gradient-primary">
            <div class="card-header">
                <h3 class="card-title text-white">
                    <i class="fas fa-smile-beam"></i> Selamat Datang di Aplikasi Zoo - Dipa Praja 🐾
                </h3>
            </div>
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col-md-8">
                        <p class="lead">
                            Hai guys, gimana kabarnya? 🎉<br>
                    <strong>Welcome to dashboard utama aplikasi Zoo - Dipa Praja 🐾</strong><br>
                            Di sini lo bisa manage data hewan sama kandang dengan gampang.<br>
                            Langsung aja explore menu di sebelah kiri, tinggal klik-klik, beres deh!
                        </p>
                    <hr>
                        <ul class="list-unstyled mt-3">
                        <li><i class="fas fa-paw text-success me-2"></i> <strong>Data Kandang</strong> teratur dan mudah diakses 🦓</li>
                        <li><i class="fas fa-paw text-success me-2"></i> <strong>Info Hewan</strong> jelas dan lengkap 🦁</li>
                        <li><i class="fas fa-paw text-success me-2"></i> Tampilan responsif, simpel, dan modern! 🌟</li>
                    </ul>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('adminlte/dist/img/dipa_anime.png') }}" class="img-fluid rounded" style="max-width: 220px; border-radius: 12px;" alt="Dipa Anime">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection