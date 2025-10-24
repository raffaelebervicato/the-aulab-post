@extends('layouts.app')
@section('title','Accedi')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body p-4 p-lg-5">
        <h1 class="h4 mb-3 text-center">Accedi</h1>
        <p class="text-muted text-center mb-4">Entra per pubblicare e gestire i tuoi articoli.</p>

        {{-- Messaggi flash --}}
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div>   @endif

        <form method="POST" action="{{ route('login.perform') }}" novalidate autocomplete="on">
          @csrf

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="nome@dominio.it"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   autocomplete="email">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label d-flex justify-content-between">
              <span>Password</span>
              <a href="#" class="small text-decoration-none disabled" aria-disabled="true" tabindex="-1">Password dimenticata?</a>
            </label>
            <div class="input-group">
              <input id="password"
                     type="password"
                     name="password"
                     class="form-control @error('password') is-invalid @enderror"
                     placeholder="••••••••"
                     required
                     autocomplete="current-password">
              <button class="btn btn-outline-secondary" type="button" onclick="togglePwd('password', this)">Mostra</button>
              @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Ricordami</label>
          </div>

          <button class="btn btn-primary w-100">Accedi</button>
        </form>

        <p class="text-center mt-4 mb-0">
          Non hai un account?
          <a href="{{ route('register') }}">Registrati</a>
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
