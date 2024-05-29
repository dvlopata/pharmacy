<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.main.index')}}" class="brand-link">
        <img src="{{ asset('dist/img/pharmacy.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Pharmacy Health</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{$user = Auth::user()->name}} {{$user = Auth::user()->surname}}</a>
            </div>
        </div>
        <!-- /.sidebar -->
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-item">
                <a href="{{route('admin.order.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-folder-open"></i>
                    <p>
                         Замовлення
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.product.index')}}" class="nav-link">
                    <i class="fas fa-store mr-2 ml-1"></i>
                    <p>
                        Товари
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.user.index')}}" class="nav-link">
                    <i class="fas fa-users mr-2 ml-1"></i>
                    <p>
                        Користувачі
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.manufacturer.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>
                        Виробники
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.category.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>
                        Категорії
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.subCategory.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>
                        Підкатегорії
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.pharmacy.index')}}" class="nav-link">
                    <i class="fas fa-users mr-2 ml-1"></i>
                    <p>
                        Аптеки
                    </p>
                </a>
            </li>
        </ul>
    </div>
</aside>
