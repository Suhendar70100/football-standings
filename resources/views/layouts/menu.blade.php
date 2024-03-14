<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
        <p>
            Home
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('club') }}" class="nav-link {{ Request::is('club') ? 'active' : '' }}">
        <p>
            Club
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa-solid fa-arrow-right-from-bracket nav-icon text-danger"></i>
        <p>
            Keluar
        </p>
    </a>
</li>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
