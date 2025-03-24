<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{auth()->user()->image ?display_file(auth()->user()->image) : asset('no-image.jpg')}}"
        alt="{{ auth()->user()->name}}">
        <div>
            <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ Auth::user()->email }}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user()->phone}}</p>
        </div>
    </div>
    <ul class="app-menu">
            <li>
            <a class="app-menu__item {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                <i class="app-menu__icon fa fa-home"></i>
                <span class="app-menu__label">الواجهه</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{ route('admin.home') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">الرئيسية</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ request()->is('*roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">الصلاحيات</span>
            </a>
        </li>
        @if (auth()->user()->hasPermission('read_settings'))
            <li>
                <a class="app-menu__item {{ request()->is('*settings*') ? 'active' : '' }}" href="{{ route('settings') }}">
                    <i class="app-menu__icon fa fa-cogs"></i>
                    <span class="app-menu__label">@lang('settings.settings')</span>
                </a>
            </li>
        @endif
        @if (auth()->user()->hasPermission('read_users'))
            <li>
                <a class="app-menu__item {{ Route::is('users') ? 'active' : '' }}" href="{{ route('users') }}">
                    <i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">المستخدمين</span>

                    <span class="app-menu__label badge badge-pill badge-success">{{ \App\Models\User::where('type', 'user')->count() }}</span>
                </a>
            </li>
        @endif
        @if (auth()->user()->hasPermission('read_admins'))
            <li>
                <a class="app-menu__item {{ Route::is('admins') ? 'active' : '' }}" href="{{ route('admins') }}">
                    <i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">المشرفين</span>

                    <span class="app-menu__label badge badge-pill badge-success">{{ \App\Models\User::where('type', 'admin')->count() }}</span>
                </a>
            </li>
        @endif
        <li>
            <a class="app-menu__item {{ request()->is('*brands*') ? 'active' : '' }}" href="{{ route('brands') }}">
                <i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">البرندات</span>
                <span class="app-menu__label badge badge-pill badge-success">{{ \App\Models\Brand::count() }}</span>
            </a>
            </li>
            <li>
            <a class="app-menu__item {{ request()->is('*categories*') ? 'active' : '' }}" href="{{ route('categories') }}">
             <i class="app-menu__icon fa fa-list"></i>
             <span class="app-menu__label">الأقسام</span>
             <span class="app-menu__label badge badge-pill badge-success">{{ \App\Models\Category::count() }}</span>
          </a>
          </li>

          <li>
            <a class="app-menu__item {{ request()->is('*colors*') ? 'active' : '' }}" href="{{ route('colors') }}">
             <i class="app-menu__icon fa fa-list"></i>
             <span class="app-menu__label">الالوان</span>
             <span class="app-menu__label badge badge-pill badge-success">{{ \App\Models\Color::count() }}</span>
          </a>
          </li>
          <li>
            <a class="app-menu__item {{ request()->is('*sizes*') ? 'active' : '' }}" href="{{ route('sizes') }}">
             <i class="app-menu__icon fa fa-list"></i>
             <span class="app-menu__label">المقاسات</span>
             <span class="app-menu__label badge badge-pill badge-success">{{ \App\Models\Size::count() }}</span>
          </a>
          </li>

          <li>
            <a class="app-menu__item {{ Route::is('products') ? 'active' : '' }}" href="{{ route('products.index') }}">
                <i class="app-menu__icon fa fa-list"></i>
                <span class="app-menu__label">المنتجات</span>

                <span class="app-menu__label badge badge-pill badge-success">{{ \App\Models\Product::count() }}</span>
            </a>
         </li>
         <div class="app-sidebar__user">
            <div>
                <p class="app-sidebar__user-name">تجارب</p>
            </div>
        </div>
          <li>
            <a class="app-menu__item {{ Route::is('products2') ? 'active' : '' }}" href="{{ route('products2') }}">
                <i class="app-menu__icon fa fa-list"></i>
                <span class="app-menu__label">المنتجات livewire test</span>

                <span class="app-menu__label badge badge-pill badge-success">{{ \App\Models\Product::count() }}</span>
            </a>
         </li>
         <li>
            <a class="app-menu__item {{ Route::is('products2') ? 'active' : '' }}" href="{{ route('products3') }}">
                <i class="app-menu__icon fa fa-list"></i>
                <span class="app-menu__label">المنتجات livewire test</span>

                <span class="app-menu__label badge badge-pill badge-success">{{ \App\Models\Product::count() }}</span>
            </a>
         </li>
        {{-- <li>
            <a class="app-menu__item {{ request()->is('*units*') ? 'active' : '' }}" href="{{ route('units') }}">
                <i class="app-menu__icon fa fa-shopping-bag"></i>
                <span class="app-menu__label">@lang('units.units')</span>
                <span class="app-menu__label badge badge-pill badge-success">{{ \App\Models\Unit::count() }}</span>
            </a>
        </li> --}}
        <hr>
        {{-- <li>
            <a class="app-menu__item {{ request()->is('*/company*') ? 'active' : '' }}" href="{{ route('company.settings') }}">
                <i class="app-menu__icon fa fa-shopping-bag"></i>
                <span class="app-menu__label">الظبط العام</span>
            </a>
        </li> --}}
        {{-- <li>
            <a class="app-menu__item {{ request()->is('*/finance_calender*') ? 'active' : '' }}" href="{{ route('finance_calender.index') }}">
                <i class="app-menu__icon fa fa-calendar"></i>
                <span class="app-menu__label">السنوات الماليه</span>
            </a>
        </li> --}}
        {{-- <li>
            <a class="app-menu__item {{ request()->is('*/branches*') ? 'active' : '' }}" href="{{ route('branches.index') }}">
                <i class="app-menu__icon fa fa-files-o"></i>
                <span class="app-menu__label">الفروع</span>
            </a>
        </li> --}}
        {{-- <li>
            <a class="app-menu__item {{ request()->is('*/shiftes*') ? 'active' : '' }}" href="{{ route('shiftes.index') }}">
                <i class="app-menu__icon fa fa-key"></i>
                <span class="app-menu__label">الشفتات</span>
            </a>
        </li> --}}
        {{-- <br>
        <div class="app-sidebar__user">
            <div>
                <p class="app-sidebar__user-name">Dr Clinic</p>
            </div> --}}
        </div>
        {{-- <li>
            <a class="app-menu__item {{ request()->is('*/departments*') ? 'active' : '' }}" href="{{ route('departments.index') }}">
                <i class="app-menu__icon fa fa-columns"></i>
                <span class="app-menu__label">الاقســـــــــــام</span>
            </a>
        </li> --}}
        {{-- <li>
            <a class="app-menu__item {{ request()->is('*/products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                <i class="app-menu__icon fa fa-product-hunt"></i>
                <span class="app-menu__label">المنتجـــــات</span>
            </a>
        </li> --}}
        {{-- <li>
            <a class="app-menu__item {{ request()->is('*car/list*') ? 'active' : '' }}"
                href="{{ route('admin.car.list') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">cars</span>
            </a>
        </li> --}}
        {{-- <li>
            <a class="app-menu__item {{ request()->is('*buses*') ? 'active' : '' }}" href="{{ route('admin.bus') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">bus</span>
            </a>
        </li> --}}
        {{-- <li><a class="app-menu__item " href="dashboard.html"><i class="app-menu__icon fa fa-dashboard"></i><span
            class="app-menu__label">Users</span></a></li> --}}


        {{-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">UI Elements</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon fa fa-circle-o"></i> Bootstrap Elements</a></li>
          <li><a class="treeview-item" href="https://fontawesome.com/v4.7.0/icons/" target="_blank" rel="noopener"><i class="icon fa fa-circle-o"></i> Font Icons</a></li>
          <li><a class="treeview-item" href="ui-cards.html"><i class="icon fa fa-circle-o"></i> Cards</a></li>
          <li><a class="treeview-item" href="widgets.html"><i class="icon fa fa-circle-o"></i> Widgets</a></li>
        </ul>
      </li> --}}
        {{-- <li><a class="app-menu__item" href="charts.html"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Charts</span></a></li> --}}
        {{-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Forms</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="form-components.html"><i class="icon fa fa-circle-o"></i> Form Components</a></li>
          <li><a class="treeview-item" href="form-custom.html"><i class="icon fa fa-circle-o"></i> Custom Components</a></li>
          <li><a class="treeview-item" href="form-samples.html"><i class="icon fa fa-circle-o"></i> Form Samples</a></li>
          <li><a class="treeview-item" href="form-notifications.html"><i class="icon fa fa-circle-o"></i> Form Notifications</a></li>
        </ul>
      </li> --}}
        {{-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Tables</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="table-basic.html"><i class="icon fa fa-circle-o"></i> Basic Tables</a></li>
          <li><a class="treeview-item" href="table-data-table.html"><i class="icon fa fa-circle-o"></i> Data Tables</a></li>
        </ul>
      </li> --}}
        {{-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Pages</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="blank-page.html"><i class="icon fa fa-circle-o"></i> Blank Page</a></li>
          <li><a class="treeview-item" href="page-login.html"><i class="icon fa fa-circle-o"></i> Login Page</a></li>
          <li><a class="treeview-item" href="page-lockscreen.html"><i class="icon fa fa-circle-o"></i> Lockscreen Page</a></li>
          <li><a class="treeview-item" href="page-user.html"><i class="icon fa fa-circle-o"></i> User Page</a></li>
          <li><a class="treeview-item" href="page-invoice.html"><i class="icon fa fa-circle-o"></i> Invoice Page</a></li>
          <li><a class="treeview-item" href="page-calendar.html"><i class="icon fa fa-circle-o"></i> Calendar Page</a></li>
          <li><a class="treeview-item" href="page-mailbox.html"><i class="icon fa fa-circle-o"></i> Mailbox</a></li>
          <li><a class="treeview-item" href="page-error.html"><i class="icon fa fa-circle-o"></i> Error Page</a></li>
        </ul>
      </li> --}}
        {{-- <li><a class="app-menu__item" href="docs.html"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Docs</span></a></li> --}}
    </ul>
</aside>
