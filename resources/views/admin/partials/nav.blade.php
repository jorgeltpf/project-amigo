{{-- TODO: --}}
{{--<div class="input-group">--}}
{{--<input type="text" class="form-control" placeholder="Search...">--}}
{{--<span class="input-group-btn">--}}
{{--<button class="btn btn-default" type="button">--}}
{{--<i class="fa fa-search"></i>--}}
{{--</button>--}}
{{--</span>--}}
{{--</div>--}}

<div class="metismenu">
<ul class="nav nav-pills nav-stacked">
    <li class="{{set_active('admin/dashboard')}}">
        <a href="{{url('admin/dashboard')}}">
            <i class="fa fa-dashboard fa-fw"></i>
            <span class="hidden-sm text"> Dashboard</span>
        </a>
    </li>
    <li class="{{set_active('admin/people*')}}">
        <a href="{{url('admin/people')}}">
            <i class="glyphicon glyphicon-user"></i>
            <span class="hidden-sm text"> Meus Dados</span>
        </a>
    </li>
    @if (Entrust::hasRole(['admin', 'establishment']))
        <li class="{{set_active('admin/users*')}}">
            <a href="{{url('admin/users')}}">
                <i class="glyphicon glyphicon-user"></i>
                <span class="hidden-sm text"> {{ trans("admin/admin.users") }}</span>
            </a>
        </li>
        <li class="{{set_active('admin/establishments*')}}">
            <a href="{{url('admin/establishments')}}">
                <i class="glyphicon glyphicon-home"></i>
                <span class="hidden-sm text"> Estabelecimento</span>
            </a>
        </li>
    @endif
     <li class="{{set_active('admin/products')}}">
        <a href="{{url('admin/products')}}">
            <i class="glyphicon glyphicon-menu-hamburger"></i> Produtos
            <span class="hidden-sm text"> </span>
        </a>
    </li>
    <li class="{{set_active('admin/promotions*')}}">
        <a href="{{url('admin/promotions')}}">
            <i class="glyphicon glyphicon-tag"></i>
            <span class="hidden-sm text"> Promoções</span>
        </a>
    </li>
    <li class="{{set_active('admin/particulars')}}">
        <a href="{{url('admin/particulars')}}">
            <i class="glyphicon glyphicon-tag"></i>
            <span class="hidden-sm text"> Características</span>
        </a>
    </li>
</ul>
</div>