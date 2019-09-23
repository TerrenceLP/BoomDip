<div class="table-responsive-sm">
    <table class="table table-striped" id="permissions-table">
        <thead>
            <th>Name</th>
        <th>Guard Name</th>
            <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($permissions as $permissions)
            <tr>
                <td>{!! $permissions->name !!}</td>
            <td>{!! $permissions->guard_name !!}</td>
                <td>
                    {!! Form::open(['route' => ['permissions.destroy', $permissions->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('permissions.show', [$permissions->id]) !!}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{!! route('permissions.edit', [$permissions->id]) !!}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>