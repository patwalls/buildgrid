@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <form name="createProjectForm">

                <div class="form-group col-md-6">
                    <label for="project_name">Project Name</label>
                    <input type="text" require class="form-control" name="project_name" required>
                </div>



                {{-- Dropzone --}}
                <div id="dropzone" class="dropzone col-md-12"></div>

                <div class="form-group col-md-6">
                    <label for="bom_name">BOM Name</label>
                    <input type="text" required class="form-control" name="bom_name" required>
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-md-6">
                    <label for="bom_name">Invite suppliers to your BOM</label>
                </div>

                <div class="clearfix"></div>

                {{-- Suppliers --}}

                <div class="form-group col-md-4">
                    <input type="text" required class="form-control" name="name[1]" placeholder="Supplier Name">
                </div>

                <div class="form-group col-md-4">
                    <input type="text" required class="form-control" name="email[1]" placeholder="Supplier Email">
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="name[2]" placeholder="Supplier Name">
                </div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="email[2]" placeholder="Supplier Email">
                </div>


                {!! csrf_field() !!}

                <div class="clearfix"></div>

                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </div>

            </form>

        </div>
    </div>
</div>


@endsection
