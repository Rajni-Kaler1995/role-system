<h2>Dealer Dashboard</h2>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>City</th>
        <th>State</th>
        <th>Zip</th>
    </tr>

    @foreach($dealers as $dealer)
    <tr>
        <td>{{ $dealer->first_name }} {{ $dealer->last_name }}</td>
        <td>{{ $dealer->email }}</td>
        <td>{{ $dealer->dealerProfile->city ?? '' }}</td>
        <td>{{ $dealer->dealerProfile->state ?? '' }}</td>
        <td>{{ $dealer->dealerProfile->zip ?? '' }}</td>
    </tr>
    @endforeach
</table>

{{ $dealers->links() }}