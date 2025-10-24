@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <div class="text-center py-5">
    <h1 class="display-5 fw-bold text-primary">Benvenuto su The Aulab Post 📰</h1>
    <p class="lead text-muted">Il portale dove gli articoli diventano storie.</p>
    <a href="{{ route('articoli.index') }}" class="btn btn-outline-primary btn-lg mt-3">Scopri gli articoli</a>
  </div>
@endsection
