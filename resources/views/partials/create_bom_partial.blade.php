<div id="notifications"></div>

<form name="createNewProjectForm" method="post" action="{{ route('postCreateProject') }}">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="project_name">Project Name</label>
            <input type="text" class="form-control" name="project_name" value="{{ $project->name or '' }}">
        </div>
    </div>
    {{-- Dropzone --}}
    <div class="row">
        <div id="dropzone" class="dropzone col-md-8"></div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="bom_name">BOM Name</label>
            <input type="text" class="form-control" name="bom_name">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="bom_name">BOM Description</label>
            <textarea class="form-control" rows="5" name="bom_description"></textarea>
        </div>
    </div>
    {{-- Suppliers --}}
    <div class="row">
        <div class="form-group col-md-4">
            <label>Invite suppliers to your BOM</label>
            <input type="text" class="form-control" name="supplier[1][name]" placeholder="Supplier Name">
        </div>
        <div class="form-group col-md-4">
            <label>&nbsp;</label>
            <input type="text" class="form-control" name="supplier[1][email]" placeholder="Supplier Email">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="supplier[2][name]" placeholder="Supplier Name">
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="supplier[2][email]" placeholder="Supplier Email">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="supplier[3][name]" placeholder="Supplier Name">
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="supplier[3][email]" placeholder="Supplier Email">
        </div>
    </div>
    {!! csrf_field() !!}
    <input type="hidden" name="filename">
    <div class="row">
        <div class="form-group col-md-3">
            <button type="submit" class="btn btn-primary btn-block">Create</button>
        </div>
    </div>
</form>