
<div class="col-md-3 side-menu">
    <p class="lead">{{$menu_name}}</p>
    <div class="list-group">
        @foreach ($categoryItems as $items)
            <a href="{{url('requests')}}" class="list-group-item">{{$items}}</a>
        @endforeach
    </div>
</div>

@section('scripts')

<script type="text/javascript">
    if (!$('.side-menu div > a').hasClass('active'))
        $('.side-menu div > a:first').addClass('active');

	$('.side-menu div > a').on('click', function() {
		$('.side-menu div > a').removeClass('active');
		$(this).addClass('active');
	});
</script>

@stop