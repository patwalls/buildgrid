
@if( isset($project) )
    <h4 class="new-project-header">New BOM</h4>
@else
    <h4 class="new-project-header">New Project</h4>
@endif

<div class="create-project-outer-wrap">
    <div id="notifications"></div>


    <form name="createNewProjectForm" method="post" action="{{ route('postCreateProject') }}">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="project_name">Project Name</label>
                <input type="text" class="form-control" name="project_name" value="{{ $project->name or '' }}"placeholder="e.g. The Village">
            </div>
        </div>
        {{-- Dropzone --}}
        <div class="row">
            <div class="form-group col-md-6">
                <div id="dropzone" class="dropzone"></div>            
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="bom_name">BOM Name</label>
                <input type="text" class="form-control" name="bom_name" placeholder="e.g. Copper Wire">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="bom_name">BOM Description</label>
                <textarea class="form-control" rows="5" name="bom_description" placeholder="A short description of the product and the product needs"></textarea>
            </div>
        </div>
        {{-- Suppliers --}}
        <div class="row">
            <div class="form-group col-md-4">
                <label>Invite suppliers to your BOM</label>
                <input type="text" class="form-control" name="supplier[1][name]" placeholder="Supplier Name"  placeholder="Name">
            </div>
            <div class="form-group col-md-4">
                <label>&nbsp;</label>
                <input type="text" class="form-control" name="supplier[1][email]" placeholder="Supplier Email"  placeholder="Name">
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
                <button type="submit" class="btn btn-primary btn-block new-proj-btn">Create Project</button>
            </div>
        </div>
    </form>
</div>