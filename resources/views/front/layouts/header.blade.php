<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

<header id="header" class="header header-fullwidth header-transparent-bg">
    <div class="container">
      <div class="header-desk header-desk_type_1">
        <div class="logo">
          <a href="index.html">
            <img src="{{ asset('assets') }}/images/logo.png" alt="Uomo" class="logo__image d-block" />
          </a>
        </div>

        <nav class="navigation">
          <ul class="navigation__list list-unstyled d-flex">
            <li class="navigation__item">
              <a href="{{ route('home') }}" class="navigation__link">Home</a>
            </li>
            <li  class="navigation__item">
              <a href="{{ route('shop') }}" class="navigation__link">Shop</a>
            </li>
            <li class="navigation__item">
              <a href="{{ route('cart') }}" class="navigation__link">Cart</a>
            </li>
            <li class="navigation__item">
              <a href="{{ route('about') }}" class="navigation__link">About</a>
            </li>
            <li class="navigation__item">
              <a href="{{ route('contact') }}" class="navigation__link">Contact</a>
            </li>
          </ul>
        </nav>

        <div class="header-tools d-flex align-items-center">
          <div class="header-tools__item hover-container">
            <div class="js-hover__open position-relative">
              <a class="js-search-popup search-field__actor" href="#">
                <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_search" />
                </svg>
                <i class="btn-icon btn-close-lg"></i>
              </a>
            </div>

            <div class="search-popup js-hidden-content">
              <form action="#" method="GET" class="search-field container">
                <p class="text-uppercase text-secondary fw-medium mb-4">What are you looking for?</p>
                <div class="position-relative">
                  <input class="search-field__input search-popup__input w-100 fw-medium" type="text"
                    name="search-keyword" placeholder="Search products" />
                  <button class="btn-icon search-popup__submit" type="submit">
                    <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_search" />
                    </svg>
                  </button>
                  <button class="btn-icon btn-close-lg search-popup__reset" type="reset"></button>
                </div>

                <div class="search-popup__results">
                  <div class="sub-menu search-suggestion">
                    <h6 class="sub-menu__title fs-base">Quicklinks</h6>
                    <ul class="sub-menu__list list-unstyled">
                      <li class="sub-menu__item"><a href="shop2.html" class="menu-link menu-link_us-s">New Arrivals</a>
                      </li>
                      <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Dresses</a></li>
                      <li class="sub-menu__item"><a href="shop3.html" class="menu-link menu-link_us-s">Accessories</a>
                      </li>
                      <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Footwear</a></li>
                      <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Sweatshirt</a></li>
                    </ul>
                  </div>
                  <div class="search-result row row-cols-5"></div>
                </div>
              </form>
            </div>
            </div>
            @auth
              <!-- If the user is authenticated (logged in) -->
              <div class="dropdown">
                <a href="#" class="header-tools__item dropdown-toggle" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-person-circle" style="font-size: 20px;"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><a class="dropdown-item" href="#">Orders</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Logout
                    </a>
                  </li>
                </ul>
              </div>
              <!-- Logout Form -->
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            @else
            <div class="dropdown">
            <a href="#" class="header-tools__item dropdown-toggle" id="guestMenu" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person" style="font-size: 20px;"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestMenu">
              <li><a class="dropdown-item" href="{{ route('login_user') }}">Login</a></li>
              <li><a class="dropdown-item" href="{{ route('register_user') }}">Register</a></li>
            </ul>
          </div>           
          @endauth
          </div>
           <a href="wishlist.html" class="header-tools__item">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_heart" />
            </svg>
          </a>
          <livewire:front.navbar />

        </div>
      </div>
    </div>
  </header>
