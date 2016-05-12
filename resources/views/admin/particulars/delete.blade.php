@extends('admin.layouts.modal')

@section('content')

<ul class="nav nav-tabs">
	<li class="active">
		<a href="#tab-general" data-toggle="tab">{{trans("admin/modal.general") }}</a>
	</li>
</ul>
<form id="deleteForm" class="form-horizontal" method="post"
	action="{{ URL::to('admin/particulars/' . $particulars . '/delete') }}"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<input type="hidden" name="id" value="{{ $particulars }}" />
	<div class="form-group center-block">
		<div class="controls">
			<h4>{{ trans("admin/modal.delete_message") }}</h4>
			<element class="btn btn-warning btn-sm close_popup">
				<span class="glyphicon glyphicon-ban-circle"></span>
					{{ trans("admin/modal.cancel") }}
			</element>
			<button type="submit" class="btn btn-sm btn-danger">
				<span class="glyphicon glyphicon-trash"></span>
					{{ trans("admin/modal.delete") }}
			</button>
		</div>
	</div>
</form>



@stop