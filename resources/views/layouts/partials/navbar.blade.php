<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-secondary">Настройки пользователя</a></li>
            </ul>

            @auth
                <div class="d-flex align-items-center" style="gap: 20px;">
                    {{auth()->user()->name}}
                    <div class="text-end">
                        <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
                    </div>
                </div>
            @endauth

        </div>
    </div>
</header>
