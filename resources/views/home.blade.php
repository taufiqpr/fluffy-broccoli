<!-- resources/views/home.blade.php -->
<h1>Selamat datang, {{ Auth::user()->name }}</h1>
<a href="{{ route('logout') }}" 
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
   Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
