@extends('admin.layouts.modal')

@section('content')

<ul class="nav nav-tabs">
	<li class="active">
		<a href="#tab-general" data-toggle="tab">{{trans("admin/modal.general") }}</a>
	</li>
</ul>
<form id="deleteForm" class="form-horizontal" method="post"
	action="{{ URL::to('admin/establishments/' . $establishments . '/delete') }}"
	autocomplete="off">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<input type="hidden" name="id" value="{{ $establishments }}" />
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



<!-- <div id="modal_delete" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Confirmação</h4>
			</div>
			<div class="modal-body">
				<p>Do you want to save changes you made to document before closing?</p>
                <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
		</div>
	</div>
</div> -->

<!-- <div id="modal_delete" class="modal fade"> -->
<!--     <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmar Exclusão?</h4>
            </div>
            <div class="modal-body">
                <p>Você realmente quer excluir este estabelecimento?</p>
                <p class="text-warning"><small>Em caso de exclusão o estabelcimento não pode ser recuperado.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger">Excluir</button>
            </div>
        </div>
    </div> -->
<!-- </div> -->
<!-- </form> -->
@stop