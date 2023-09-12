@guest
Bem vindo ao painel do {{ $user->name }} !
@endguest

@auth
@php
if (auth()) {
$userId = auth()->user();
if ($userId->id == $user->id) {
echo "Seu painel!";
} else {
echo "Bem vindo ao painel do ". $user->name. "!";
}
}
@endphp
@endauth
