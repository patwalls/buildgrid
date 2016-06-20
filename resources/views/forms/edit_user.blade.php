<form id="user-edit-form" action="{{ route('update.profile') }}" method="post">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input class="form-control" type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input class="form-control" type="text" id="last_name" name="last_name" value="{{ $user->last_name }}">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}">
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input class="form-control" type="text" id="phone" name="phone" value="{{ $user->phone }}">
    </div>
    <div class="form-group">
        <label for="phone">Company Name</label>
        <input class="form-control" type="text" id="company_name" name="company_name" value="{{ $user->company_name }}">
    </div>
    <div class="form-group">
        <label for="phone">Position</label>
        <input class="form-control" type="text" id="position_title" name="position_title" value="{{ $user->position_title }}">
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="put">
                <input id="user-submit" class="btn btn-block standard-blue-button" type="submit" value="Save">
            </div>
        </div>
    </div>
</form>