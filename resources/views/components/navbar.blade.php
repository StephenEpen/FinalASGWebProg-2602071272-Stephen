<div class="py-2 col-12 px-3 z-3 w-100 position-fixed top-0 start-0 bg-secondary-subtle">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <a href="{{ route('homePage') }}" class="fs-6 m-0 text-decoration-none text-dark">
                <h3>Connect Friend</h3>
            </a>
        </div>

        <div class="d-flex align-items-center justify-content-center gap-4">
            <a href="{{ route('homePage') }}" class="text-decoration-none text-dark fw-semibold">@lang('navbar.home')</a>
            <a href="{{ route('buyAvatarPage') }}" class="text-decoration-none text-dark fw-semibold">@lang('navbar.buy_avatar')</a>
            <a href="{{ route('topUpPage') }}" class="text-decoration-none text-dark fw-semibold">@lang('navbar.top_up')</a>
        </div>

        <div class="d-flex align-items-center">
            @include('components.locale.localization')
            <div class="mx-3 text-nowrap">
                @auth
                    <p class="mb-0 fw-semibold">@lang('navbar.welcome_user') {{ Auth::user()->name }}</p>
                @else
                    <p class="mb-0 fw-semibold">@lang('navbar.welcome_guest')</p>
                @endauth
            </div>

            <div class="ms-2 dropdown">
                <button 
                    class="btn position-relative dropdown-toggle" 
                    id="notificationDropdown" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                    </svg>
                    @php
                        $pendingCount = $friendRequests->where('status', 'pending')->count();
                    @endphp
                    @if ($pendingCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                    @forelse ($friendRequests as $request)
                        <li class="dropdown-item">
                            <strong>{{ $request->user->name }}</strong> 
                            @if ($request->status === 'pending')
                                @lang('navbar.send_request')
                                <div class="mt-2">
                                    <form action="{{ route('friends.accept', $request->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success" type="submit">@lang('navbar.acc')</button>
                                    </form>
                                    <form action="{{ route('friends.reject', $request->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-danger" type="submit">@lang('navbar.reject')</button>
                                    </form>
                                </div>
                            @elseif ($request->status === 'accepted')
                                <p class="mb-0 text-success">@lang('navbar.request_acc')</p>
                            @endif
                        </li>
                    @empty
                        <li class="dropdown-item text-center">@lang('navbar.no_notif')</li>
                    @endforelse
                </ul>
            </div>

            <div class="ms-2 dropdown">
                <button 
                    class="btn d-flex align-items-center dropdown-toggle" 
                    id="avatarDropdown" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false">
                    <img src="{{ Auth::user()->profile_picture ?? 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/%E2%80%94Pngtree%E2%80%94default%20avatar_5408430.png?alt=media&token=580f3ac1-4a50-4327-89c4-bc7667d841de' }}" 
                         alt="Avatar" 
                         class="rounded-circle me-2" 
                         style="width: 40px; height: 40px;">
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="avatarDropdown">
                    @auth
                        <li><a class="dropdown-item" href="{{ route('friends.list') }}">@lang('navbar.profile')</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">@lang('navbar.logout')</button>
                            </form>
                        </li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('loginPage') }}">@lang('navbar.login')</a></li>
                        <li><a class="dropdown-item" href="{{ route('registerPage') }}">@lang('navbar.register')</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</div>
