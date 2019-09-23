<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('users.index') !!}"><i class="nav-icon icon-cursor"></i><span>Users</span></a>
</li>
<li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('roles.index') !!}"><i class="nav-icon icon-cursor"></i><span>Roles</span></a>
</li>
<li class="nav-item {{ Request::is('permissions*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('permissions.index') !!}"><i class="nav-icon icon-cursor"></i><span>Permissions</span></a>
</li>

<li class="nav-item {{ Request::is('roleHasPermissions*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('roleHasPermissions.index') !!}"><i class="nav-icon icon-cursor"></i><span>Role_has_Permissions</span></a>
</li>
