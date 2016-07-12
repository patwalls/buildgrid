@extends('layouts.admin')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-2">

                @include('admin.navigation')

            </div>

            <div class="col-md-10">

                <h2>Users</h2>

                    <table class='table table-condensed table-hover table-striped'
                        data-datatables-enabled
                        data-ajax = '{{ route('admin.users.index') }}'
                        data-show-url = '{{ route('admin.users.index') }}'
                        data-token = '{{ csrf_token() }}'
                        data-columns =  '[
                            {"data": "id"},
                            {"data": "full_name" },
                            {"data": "email" },
                            {"data": "last_login" },
                            {"data": "created_at" },
                            {"data": "total_boms" },
                            {"data": "active_boms_count"},
                            {"data": "user_status"},
                            {"defaultContent": "<button id=\"button-show\" data-action-show class=\"btn btn-default btn-xs\"><i class=\"fa fa-eye\"></i></button> <button id=\"button-edit\" data-action-delete class=\"btn btn-danger btn-xs\"><i class=\"fa fa-times\"></i></button>"}
                            ]'
                        data-column-defs = '[
                            { "visible": false, "targets": 0 }
                        ]'
                    >

                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Last Login</th>
                                <th>Registered On</th>
                                <th>Open Boms</th>
                                <th>Total Boms</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                    </table>

            </div>

        </div>


    </div>

@endsection

