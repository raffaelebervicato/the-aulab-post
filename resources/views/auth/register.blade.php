@extends('layouts.app')
@section('title','Registrati')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-7 col-lg-6">
    <div class="card shadow-sm">
      <div class="card-body p-4 p-lg-5">
        <h1 class="h4 mb-3 text-center">Crea il tuo account</h1>
        <p class="text-muted text-center mb-4">Diventa writer e pubblica su <strong>The Aulab Post</strong>.</p>

        {{-- Messaggi flash --}}
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <form method="POST" action="{{ route('register.perform') }}" novalidate autocomplete="on">
          @csrf

          {{-- Nome --}}
          <div class="mb-3">
            <label for="name" class="form-label">Nome e cognome</label>
            <input id="name"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Mario Rossi"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   autocomplete="name">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          {{-- Email --}}
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="nome@dominio.it"
                   value="{{ old('email') }}"
                   required
                   autocomplete="email">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          {{-- Password e Conferma --}}
          <div class="row g-3">
            <div class="col-md-6">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <input id="password"
                       type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Min. 6 caratteri"
                       required
                       autocomplete="new-password">
                <button class="btn btn-outline-secondary" type="button" onclick="togglePwd('password', this)">Mostra</button>
              </div>
              @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
              <label for="password_confirmation" class="form-label">Conferma password</label>
              <input id="password_confirmation"
                     type="password"
                     name="password_confirmation"
                     class="form-control"
                     placeholder="Ripeti password"
                     required
                     autocomplete="new-password">
            </div>
          </div>

          {{-- Termini --}}
          <div class="form-check my-3">
            <input class="form-check-input" type="checkbox" id="terms" required>
            <label class="form-check-label" for="terms">
              Accetto <a href="#" class="text-decoration-none">termini e condizioni</a>
            </label>
          </div>

          {{-- Pulsante --}}
          <button class="btn btn-primary w-100">Crea account</button>
        </form>

        <p class="text-center mt-4 mb-0">
          Hai già un account?
          <a href="{{ route('login') }}">Accedi</a>
        </p>
      </div>
    </div>
  </div>
</div>

{{-- JS piccolo per mostra/nascondi password --}}
<script>
function togglePwd(id, btn){
  const i = document.getElementById(id);
  const isPwd = i.type === 'password';
  i.type = isPwd ? 'text' : 'password';
  btn.textContent = isPwd ? 'Nascondi' : 'Mostra';
}
</script>
@endsection
