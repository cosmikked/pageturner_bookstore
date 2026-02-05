<div
    class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary"
    style="width: 280px"
>
    <a
        href="{{ route('home') }}"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
    >
        <span class="fs-4">Page Turner</span>
    </a>
    <hr />
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active" aria-current="page">
                <svg
                    class="bi pe-none me-2"
                    width="16"
                    height="16"
                    aria-hidden="true"
                >
                    <use xlink:href="#home"></use>
                </svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.books.index') }}" class="nav-link link-body-emphasis">
                <svg
                    class="bi pe-none me-2"
                    width="16"
                    height="16"
                    aria-hidden="true"
                >
                    <use xlink:href="#speedometer2"></use>
                </svg>
                Books
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}" class="nav-link link-body-emphasis">
                <svg
                    class="bi pe-none me-2"
                    width="16"
                    height="16"
                    aria-hidden="true"
                >
                    <use xlink:href="#table"></use>
                </svg>
                Categories
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-body-emphasis">
                <svg
                    class="bi pe-none me-2"
                    width="16"
                    height="16"
                    aria-hidden="true"
                >
                    <use xlink:href="#grid"></use>
                </svg>
                Orders
            </a>
        </li>
        <li>
            <a href="{{ route('home') }}" class="nav-link link-body-emphasis">
                <svg
                    class="bi pe-none me-2"
                    width="16"
                    height="16"
                    aria-hidden="true"
                >
                    <use xlink:href="#people-circle"></use>
                </svg>
                View Store
            </a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link link-body-emphasis">
                    Log Out
                </button>
            </form>
        </li>
    </ul>
    <hr />
</div>
