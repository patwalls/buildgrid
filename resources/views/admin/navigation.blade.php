<div class="list-group">
    <a href="{{ route('admin.dashboard') }}"   class="list-group-item {{ Request::route()->getName() == 'admin.dashboard'   ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('admin.users.index') }}" class="list-group-item {{ Request::route()->getName() == 'admin.users.index' ? 'active' : '' }}">Users</a>
    <a href="{{ route('admin.boms.index') }}"  class="list-group-item {{ Request::route()->getName() == 'admin.boms.index'  ? 'active' : '' }}">Boms</a>
</div>
