@include('layouts.main')



<span class="logout"><a href="{{ route('logout') }}" class="btn btn-primary">Logout</a></span>



<h1>My Leaves</h1>
<section>
    <table class="table table-striped">
        <th>First Name</th>
        <th>Last Name</th>
        <th>Subject</th>
        <th>Leave Date</th>
        <th>Status</th>
    @foreach($leaves as $leave)
        <tr>
        <td>{{ $leave->user->first_name }}</td>
        <td>{{ $leave->user->last_name }}</td>
        <td>{{ $leave->subject }}</td>
        <td>{{ $leave->leave_dates }}</td>
        <td>{{ $leave->status }}</td>
        </tr>
    @endforeach
    </table>
</section>


