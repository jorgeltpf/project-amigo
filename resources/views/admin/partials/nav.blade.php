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
    <li class="{{set_active('admin/users*')}}">
        <a href="{{url('admin/users')}}">
            <i class="glyphicon glyphicon-user"></i>
            <span class="hidden-sm text"> {{ trans("admin/admin.users") }}</span>
        </a>
    </li>
    @if (Entrust::hasRole('admin'))
    <li class="{{set_active('admin/establishments*')}}">
        <a href="{{url('admin/establishments')}}">
            <i class="glyphicon glyphicon-home"></i>
            <span class="hidden-sm text"> Estabelecimento</span>
        </a>
    </li>
    @endif
     <li class="{{set_active('admin/products*')}}">
        <a href="#">
            <i class="glyphicon glyphicon-menu-hamburger"></i> Produtos
            <span class="fa arrow"> </span>
        </a>
        <ul class="nav collapse">
            <li class="{{set_active('admin/products')}}">
                <a href="{{url('admin/products')}}">
                    <i class="glyphicon glyphicon-glass"></i>
                    <span class="hidden-sm text"> Produtos</span>
                </a>
            </li>
            <li class="{{set_active('admin/producttypes')}}">
                <a href="{{url('admin/producttypes')}}">
                    <i class="glyphicon glyphicon-filter"></i>
                    <span class="hidden-sm text"> Tipo de Produtos</span>
                </a>
            </li>
            <li class="{{set_active('admin/productclasses')}}">
                <a href="{{url('admin/productclasses')}}">
                    <i class="glyphicon glyphicon-paperclip"></i>
                    <span class="hidden-sm text"> Classe de Produtos</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="{{set_active('admin/promotions*')}}">
        <a href="{{url('admin/promotions')}}">
            <i class="glyphicon glyphicon-tag"></i>
            <span class="hidden-sm text"> Promoções</span>
        </a>
    </li>

    @if (Entrust::hasRole('admin'))
        <li class="{{set_active('admin/language*')}}">
            <a href="{{url('admin/language')}}">
                <i class="fa fa-language"></i>
                <span class="hidden-sm text"> Language</span>
            </a>
        </li>
    @endif
   
</ul>
</div>