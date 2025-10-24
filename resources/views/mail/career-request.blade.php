<p><strong>Nuova richiesta ruolo</strong></p>
<p>Utente: {{ $user->name }} ({{ $user->email }})</p>
<p>Ruolo richiesto: <strong>{{ ucfirst($role) }}</strong></p>
@if($messageTxt)
<p>Messaggio:</p>
<blockquote style="margin:0;padding-left:10px;border-left:3px solid #ddd;color:#555">
  {{ $messageTxt }}
</blockquote>
@endif
