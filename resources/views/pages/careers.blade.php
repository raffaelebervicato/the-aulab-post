@extends('layouts.app')
@section('title','Lavora con noi')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body p-4 p-lg-5">
          <h1 class="h4 mb-3">Lavora con noi</h1>
          <p class="text-muted">Richiedi l’abilitazione al ruolo desiderato. Un amministratore approverà la tua richiesta.</p>

          @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

          <form action="{{ route('careers.submit') }}" method="POST" class="mt-3">@csrf
            <div class="mb-3">
              <label class="form-label">Ruolo richiesto</label>
              <select name="role" class="form-select" required>
                <option value="">— Seleziona —</option>
                <option value="writer">Writer (creazione articoli)</option>
                <option value="revisor">Revisor (revisione articoli)</option>
                <option value="admin">Admin (gestione utenti e contenuti)</option>
              </select>
              @error('role') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Messaggio (opzionale)</label>
              <textarea name="message" rows="4" class="form-control" placeholder="Presentati brevemente...">{{ old('message') }}</textarea>
              @error('message') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <button class="btn btn-primary">Invia richiesta</button>
          </form>

          <hr class="my-4">
          <p class="small text-muted">
            Stato attuale:
            @php $u=auth()->user(); @endphp
            @if($u->is_writer===true)    <span class="badge text-bg-primary">Writer ✔</span>
            @elseif(is_null($u->is_writer)) <span class="badge text-bg-warning">Writer in revisione</span> @endif

            @if($u->is_revisor===true)    <span class="badge text-bg-secondary ms-2">Revisor ✔</span>
            @elseif(is_null($u->is_revisor)) <span class="badge text-bg-warning ms-2">Revisor in revisione</span> @endif

            @if($u->is_admin===true)      <span class="badge text-bg-dark ms-2">Admin ✔</span>
            @elseif(is_null($u->is_admin)) <span class="badge text-bg-warning ms-2">Admin in revisione</span> @endif
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection
