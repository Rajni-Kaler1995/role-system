<h2>Employee Dashboard</h2>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role->name }}</td>
    </tr>
    @endforeach
</table>

{{ $users->links() }}