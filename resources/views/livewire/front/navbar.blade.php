<div>
    <a href="{{ route('cart') }}" class="header-tools__item header-tools__cart">
        <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <use href="#icon_cart" />
        </svg>
        <span class="cart-amount d-block position-absolute js-cart-items-count">{{ $total_count }}</span>
      </a>
</div>
