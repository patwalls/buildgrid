@extends('layouts.admin')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-3">

                @include('admin.navigation')

            </div>

            <div class="col-md-9">

                <h2>Users</h2>

                <div class='well'>
                    <table class='table table-condensed table-hover table-striped'
                            data-datatable-enabled
                            data-columns = '[
                                {"data": "full_name", "name": "full_name"},
                                {"data": "email", "name": "email"},
                                {"data": "last_login", "name": "last_login"},
                                {"data": "created_at", "name": "created_at"},
                                {"data": "total_boms", "name": "total_boms"},
                                {"data": "active_boms_count", "name": "active_boms_count"}
                            ]'
                    >

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Last Login</th>
                                <th>Registered On</th>
                                <th>Open Boms</th>
                                <th>Total Boms</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>

            </div>

        </div>


    </div>

@endsection

