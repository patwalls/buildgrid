@extends('layouts.admin')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-2">

                @include('admin.navigation')

            </div>

            <div class="col-md-10">

                <h2>Boms</h2>

                <table class='table table-condensed table-hover table-striped'
                       data-datatables-enabled
                       data-ajax = '{{ route('admin.boms.index') }}'
                       data-show-url = '{{ route('admin.boms.index') }}'
                       data-token = '{{ csrf_token() }}'
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

