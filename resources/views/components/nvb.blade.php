<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid px-4">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="200" height="50" class="d-inline-block align-text-top">
        </a>

        <!-- Toggler for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-success me-4" href="{{ route('index') }}" style="transition: color 0.3s ease;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-success me-4" href="#" style="transition: color 0.3s ease;">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-success me-4" href="#" style="transition: color 0.3s ease;">Events</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-success me-4 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="transition: color 0.3s ease;">
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Contact</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <!-- Log Out Form -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>