@extends('layouts.app')

@section('content')
<div class="container">

    <div id="notifications"></div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="clearfix"></div>

            <form name="createNewProjectForm" method="post" action="{{ route('postCreateProject') }}">

                <div class="form-group col-md-6">
                    <label for="project_name">Project Name</label>
                    <input type="text" class="form-control" name="project_name">
                </div>

                {{-- Dropzone --}}
                <div id="dropzone" class="dropzone col-md-12"></div>

                <div class="form-group col-md-6">
                    <label for="bom_name">BOM Name</label>
                    <input type="text" class="form-control" name="bom_name" >
                </div>

                <div class="clearfix"></div>

                {{-- Suppliers --}}

                <div class="form-group col-md-4">
                    <label>Invite suppliers to your BOM</label>
                    <input type="text" class="form-control" name="supplier[1][name]" placeholder="Supplier Name">
                </div>

                <div class="form-group col-md-4">
                    <label>&nbsp;</label>
                    <input type="text" class="form-control" name="supplier[1][email]" placeholder="Supplier Email">
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="supplier[2][name]" placeholder="Supplier Name">
                </div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="supplier[2][email]" placeholder="Supplier Email">
                </div>


                {!! csrf_field() !!}

                <input type="hidden" name="filename">

                <div class="clearfix"></div>

                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </div>

            </form>

        </div>
    </div>
</div>


@endsection
