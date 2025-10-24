<nav class="navbar navbar-expand bg-body-tertiary border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">

      {{-- BRAND --}}
      <a class="navbar-brand fw-bold" href="{{ route('home') }}">The Aulab Post</a>

      {{-- MENU SINISTRA --}}
      <ul class="navbar-nav flex-row me-auto">
        <li class="nav-item me-3">
          <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link {{ request()->routeIs('articoli.index') ? 'active fw-semibold' : '' }}" href="{{ route('articoli.index') }}">Articoli</a>
        </li>
        @auth
          <li class="nav-item me-3">
            <a class="nav-link {{ request()->routeIs('careers.form') ? 'active fw-semibold' : '' }}" href="{{ route('careers.form') }}">Lavora con noi</a>
          </li>
        @endauth
      </ul>

      {{-- MENU DESTRA --}}
      <ul class="navbar-nav flex-row align-items-center">

        {{-- Utente non loggato --}}
        @guest
          <li class="nav-item me-2">
            <a class="nav-link" href="{{ route('login') }}">Accedi</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary" href="{{ route('register') }}">Registrati</a>
          </li>
        @endguest

        {{-- Utente loggato --}}
        @auth
          {{-- Pulsanti ruoli --}}
          @if(auth()->user()->is_admin)
            <li class="nav-item me-2">
              <a class="btn btn-outline-dark" href="{{ route('admin.dashboard') }}">Admin</a>
            </li>
          @endif
          @if(auth()->user()->is_revisor)
            <li class="nav-item me-2">
              <a class="btn btn-outline-secondary" href="{{ route('revisor.dashboard') }}">Revisor</a>
            </li>
          @endif
          @if(auth()->user()->is_writer)
            <li class="nav-item me-2">
              <a class="btn btn-outline-primary" href="{{ route('writer.dashboard') }}">Writer</a>
            </li>
          @endif

          {{--  Logout diretto accanto ai pulsanti --}}
          <li class="nav-item me-2">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-danger">Logout</button>
            </form>
          </li>

          {{-- Dropdown utente opzionale (resta per email info) --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-semibold text-dark" href="#" id="userDropdown"
               role="button" data-bs-toggle="dropdown" aria-expanded="false">
              👤 {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><span class="dropdown-item-text text-muted small">{{ auth()->user()->email }}</span></li>
            </ul>
          </li>
        @endauth

      </ul>
    </div>
  </nav>
