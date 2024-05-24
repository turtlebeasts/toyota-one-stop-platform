<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="bi bi-house-door-fill"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/user">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('appointment.index') }}">Appointments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('services.view') }}">Vehicle Servicing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('cart.view') }}">Vehicle Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('pcart.view') }}">Part Orders</a>
                </li>
            </ul>
            <form class="d-flex align-items-end mb-0" role="search" method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="dropdown">
                    <a href="#" class="mb-0 text-dark mt-1 dropdown-toggle" aria-expanded="false"
                        data-bs-toggle="dropdown"><i class="bi bi-bag-fill"></i></a>
                    <ul class="dropdown-menu">
                        @if (auth()->user()->cars)
                            @foreach (auth()->user()->cars as $car)
                                <a href="{{ route('user.car', $car->id) }}" class="dropdown-item">
                                    <img src="/storage/{{ $car->photo }}" alt="{{ $car->name }}"
                                        class="img-fluid"><br>
                                    {{ $car->name }}
                                </a>
                            @endforeach
                        @else
                            No items in the list
                        @endif
                    </ul>
                </div>
                <p class="fs-6 mb-0 px-2">
                    {{ auth()->user()->email }}
                </p>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="bi bi-box-arrow-left"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to logout?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>
