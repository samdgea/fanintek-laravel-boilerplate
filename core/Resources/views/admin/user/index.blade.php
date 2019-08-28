@extends('layouts.app', ['title' => 'User Management', 'breadcrumbs' => [
    [
        'title' => 'Home', 
        'icon' => 'fa fa-dashboard',
        'route' => 'home'
    ], [
        'title' => 'Administrative Menu',
        'icon' => 'fa fa-cogs',
    ], [
        'title' => 'User Management',
        'icon' => 'fa fa-users',
        'route' => 'manage.user.index',
        'active' => true
    ]
]])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('js')
    <!-- DataTables -->
    <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <!-- DataTables Bootstrap -->
    <script src="{{ asset('assets/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            let t = $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("manage.user.json.allUser") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'full_name', name: 'full_name' },
                    { data: 'email', name: 'email' },
                    { data: 'is_active', name: 'is_active' },
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
                $('#deleteForm').children('input#uID').val(id);
            })
        });
    </script>
@endpush

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">User Management</h3>    
        <a href="{{ route('manage.user.create') }}" class="btn btn-xs btn-success pull-right"><i class="fa fa-user-plus"></i> New User</a>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered" id="userTable" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Account Active</th>
                    <th>Account Creation</th>
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
                <h4 class="modal-title" id="viewModalLabel">View User</h4>
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
                <h4 class="modal-title" id="editModalLabel">Edit User</h4>
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
                <h4 class="modal-title" id="deleteModalLabel">Delete User</h4>
            </div>
            <div class="modal-body text-center" id="formDelete">
                <i class="fa fa-exclamation-triangle fa-4x"></i>
                <p class="modal-message">Are you sure to delete this user ? Your action can not be undone!</p>
            </div>
            <div class="modal-footer">
                <form method="POST" id="deleteForm" action="{{ route('manage.user.json.deleteUser') }}">
                    @csrf
                    <input type="hidden" name="id" id="uID" value="0">

                    <a class="btn btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-danger okay">Yes, delete it</button>    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection