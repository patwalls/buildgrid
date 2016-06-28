@extends('layouts.admin')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-2">

                @include('admin.navigation')

            </div>

            <div class="col-md-10">


                    <div class="col-md-6">
                        <h3>{{ $user->full_name }}</h3>

                    <div class="row">
                        <div class="col-md-4">
                            <img src="/images/sample_profile.png" alt="" style="width:100%"/>
                        </div>

                        <div class="col-md-5 col-md-offset-1">
                            <p>
                                <strong>Email: </strong><br>
                                {{$user->email}}
                            </p>
                            <p>
                                <strong>Company:</strong> <br>
                                {{$user->company_name }}
                            </p>
                            <p>
                                <strong>Phone:</strong> <br>
                                {{$user->phone }}
                            </p>
                            <p>
                                <strong>Position:</strong> <br>
                                {{$user->position_title }}
                            </p>
                            <p>
                                <strong>Status:</strong> <br>
                                {{$user->user_status}}

                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                                @if(!$user->trashed())
                                    <button  id="button-action-delete" data-action-delete="{{ route('admin.users.destroy', [$user->id]) }}" class="btn btn-sm btn-danger">Delete User</button>
                                @else
                                    <button id="button-action-active" data-action-active="{{route('admin.users.update', $user->id)}}" class="btn btn-sm standard-blue-button">Active User</button>
                                @endif
                            </p>

                        </div>

                    </div>
                        <span class="edit-user" title="Edit User" data-toggle="modal" data-target="#edit-form-modal"><i class="ion-edit"></i>  Edit</span>

                        <div class="modal fade" id="edit-form-modal" tabindex="-1" role="dialog" aria-labelledby="edit-form">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="form-title">Edit User</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div id="errors"></div>
                                                    @include('forms.edit_user')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>


                <div class="col-md-6">

                    <h3>Activity</h3>


                    <div class="col-md-6">

                        <div class="panel panel-default">
                            <div class="panel-heading">Total Projects</div>
                            <div class="panel-body">
                                {{ $user->projects->count() }}
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Total Boms</div>
                            <div class="panel-body">
                                {{ $user->boms->count() }}
                            </div>
                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="panel panel-default">
                            <div class="panel-heading">Invited Suppliers</div>
                            <div class="panel-body">
                                {{ $user->invited_suppliers_count }}
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Open Boms</div>
                            <div class="panel-body">
                                {{ $user->active_boms_count }}
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Last login</div>
                            <div class="panel-body">
                                {{ $user->last_login  }}
                                <small class="pull-right"> ({{ $user->last_login->diffForHumans()  }})</small>
                            </div>
                        </div>
                    </div>

                </div>

                <h3>Boms</h3>

                <table class='table table-condensed table-hover table-striped'
                       data-datatables-enabled
                       data-ajax = '{{ route('admin.users.show', [$user->id]) }}'
                       data-show-url = '{{ route('admin.boms.index') }}'
                       data-columns = '[
                                {"data": "id"},
                                {"data": "bom_purchaser" },
                                {"data": "project_name" },
                                {"data": "name" },
                                {"data": "bg_responded_yes_no" },
                                {"data": "invited_suppliers_count" },
                                {"data": "created_at"},
                                {"data": "updated_at"},
                                {"data": "status"},
                                {"defaultContent": "<button data-action-show class=\"btn btn-default btn-xs\"><i class=\"fa fa-eye\"></i></button> <button data-action-delete class=\"btn btn-danger btn-xs\"><i class=\"fa fa-times\"></i></button>"}
                            ]'
                       data-column-defs = '[
                                { "visible": false, "targets": 0 }
                       ]'

                >

                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Purchaser</th>
                        <th>Project</th>
                        <th>Name</th>
                        <th>BG Responded</th>
                        <th>Invited Suppliers</th>
                        <th>Created At</th>
                        <th>Last Updated</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                </table>


            </div>

            </div>

    </div>
@endsection
