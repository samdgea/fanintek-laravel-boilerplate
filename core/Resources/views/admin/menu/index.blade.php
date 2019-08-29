@extends('layouts.app', ['title' => 'Menu Management', 'breadcrumbs' => [
    [
        'title' => 'Home', 
        'icon' => 'fa fa-dashboard',
        'route' => 'home'
    ], [
        'title' => 'Administrative Menu',
        'icon' => 'fa fa-cogs',
    ], [
        'title' => 'Menu Management',
        'icon' => 'fa fa-compass',
        'route' => 'manage.menu.index',
        'active' => true
    ]
]])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('js')
    <!-- DataTables -->
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <!-- DataTables Bootstrap -->
    <script src="{{ asset('assets/vendor/datatables-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            let t = $('#menuTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("manage.menu.json.allMenu") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'parent_menu', name: 'parent_menu'},
                    { data: 'menu_label', name: 'menu_label' },
                    { data: 'menu_data', name: 'menu_data' },
                    { data: 'menu_icon', name: 'menu_icon' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action',orderable: false, searchable: false}
                ],
                columnDefs: [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                order: [[ 1, 'asc' ]]
            });

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            $('#editModal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var id = button.data('userid');

                window.location.href= "/{{ request()->path() }}/edit/" + id;
            });

            $('#viewModal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var id = button.data('userid');

                window.location.href= "/{{ request()->path() }}/view/" + id;
            });

            $('#deleteModal').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('userid');
                $('#deleteForm').children('input#rID').val(id);
            })
        });
    </script>
@endpush

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Menu Management</h3>    
        <a href="{{ route('manage.menu.create') }}" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> New Menu</a>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered" id="menuTable" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Parent Menu</th>
                    <th>Menu Name</th>
                    <th>Link Type</th>
                    <th>Route Name</th>
                    <th>Creation Date</th>
                    <th class="table-action">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!-- /.box -->

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="viewModalLabel">View Menu</h4>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-refresh fa-spin fa-5x fa-fw"></i>
                <p class="modal-message">Redirecting</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editModalLabel">Edit Menu</h4>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-refresh fa-spin fa-5x fa-fw"></i>
                <p class="modal-message">Redirecting</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-danger" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteModalLabel">Delete Menu</h4>
            </div>
            <div class="modal-body text-center" id="formDelete">
                <i class="fa fa-exclamation-triangle fa-4x"></i>
                <p class="modal-message">Are you sure to delete this menu ? Your action can not be undone!</p>
            </div>
            <div class="modal-footer">
                <form method="POST" id="deleteForm" action="{{ route('manage.menu.json.deleteMenu') }}">
                    @csrf
                    <input type="hidden" name="id" id="rID" value="0">

                    <a class="btn btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-danger okay">Yes, delete it</button>    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection