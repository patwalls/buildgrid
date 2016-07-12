@extends('layouts.admin')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-2">

                @include('admin.navigation')

            </div>

            <div class="col-md-10">

                <h2>Dashboard</h2>

                <h3>Last 2 weeks stats</h3>

                <div class="col-md-9">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">New Users</div>
                                <div class="panel-body">
                                    {{ $new_users }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">New Boms</div>
                                <div class="panel-body">
                                    {{ $new_boms }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Invited Suppliers</div>
                                <div class="panel-body">
                                    {{ $invited_suppliers }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Supplier Responses</div>
                                <div class="panel-body">
                                    {{ $bom_responses }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Accepted Responses</div>
                                <div class="panel-body">
                                    {{ $accepted_responses }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-3 well">

                    <h4>Quick Links</h4>

                    <ul>
                        <li><a href="/admin/users">Manage Users</a></li>
                        <li><a href="/admin/boms">Manage Boms</a></li>
                        <li><a href="#">BG Responses</a></li>
                    </ul>
                </div>

            </div>

        </div>


    </div>

@endsection
