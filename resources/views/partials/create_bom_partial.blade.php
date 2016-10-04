
@if( empty($project) )
    <h4 class="new-project-header">New Project</h4>
@else
    <h4 class="new-project-header">Add BOM to project</h4>
@endif

<div class="create-project-outer-wrap">
    <div id="notifications"></div>


    <form name="createNewProjectForm" method="post" action="{{  empty($project) ? route('postCreateProject') : route('postAddBomToProject', [$project->id]) }}">

        @if( empty($project) )
        <div class="row">
            <div class="form-group col-md-6">
                <label for="project_name">Project Name</label>
                <input type="text" class="form-control" name="project_name" value="{{ $project->name or '' }}"placeholder="e.g. The Village">
            </div>
        </div>
        @endif

        @if( ! empty($project) )
                <input type="hidden" name="project_name" value="{{$project->name }}">
                <input type="hidden" name="project_id" value="{{$project->id }}">
        @endif

        {{-- Dropzone --}}
        <div class="row">
            <div class="form-group col-md-6">
                <div id="dropzone" class="dropzone"></div>
                <br/>Supported file types: <b>.pdf, .doc, .docx, .xls, .xlsx, .csv </b><br/>Max size: <b>10 MB</b>
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
                <button type="submit" class="btn btn-primary btn-block new-proj-btn">{{ is_null($project) ? 'Create Project' : 'Add BOM' }}</button>
            </div>
        </div>
    </form>
</div>
