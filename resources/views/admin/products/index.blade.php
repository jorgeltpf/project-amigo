@extends('admin.layouts.default')

@section('title') Produtos :: @parent @stop

@section('main')
    <div class="page-header">
        <h3>
            Produtos
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/products/create') }}}"
                       class="btn btn-sm btn-primary">
                       <span class="glyphicon glyphicon-plus-sign"></span>
                       {{ trans("admin/modal.new") }}
                    </a>
                </div>
            </div>
        </h3>
    </div>

	<table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Preço</th>
            <th>{{ trans("admin/admin.action") }}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
	</table>
@stop

@section('scripts')
	@parent
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#table').DataTable({
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                "sPaginationType": "bootstrap",
                "processing": true,
                "serverSide": true,
                "ajax": "{{ URL::to('admin/products/data') }}",
                "fnDrawCallback": function (oSettings) {
                    $(".iframe").colorbox({
                        iframe: true,
                        width: "80%",
                        height: "80%",
                        onClosed: function () {
                            window.location.reload();
                        }
                    });
                }
            });
		});
	</script>
@stop