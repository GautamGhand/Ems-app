@include('layouts.main')

<span class="logout"><a href="{{ route('logout') }}" class="btn btn-primary" id="logout">Logout</a></span>

<table class="table table-striped">
    <th>Id</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Edit</th>
    <th>Delete</th>
    <th>Status</th>
@foreach($users as $user)
    @if($user->is_admin)
        @continue
    @endif
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->first_name }}</td>
        <td>{{ $user->last_name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit</a>
        </td>
        <td>
            <form method="POST" action="{{ route('users.delete', $user) }}">
                @csrf
            <input type="submit" name="submit" value="Delete" class="btn btn-danger">
            </form>
        </td>
        <td>
                <form action="{{ route('users.active', $user) }}" method="POST">
                    @csrf
                    <i class="bi bi-radioactive"></i>
                    @if ($user->status == true)
                        <input type="submit" value="DEACTIVATE" name="submit" class="delete">
                    @else
                         <input type="submit" value="ACTIVATE" name="submit" class="delete">
                    @endif
                </form>
        </td>
    </tr>
@endforeach
</table>
</div>
</div>
</body>
</html>