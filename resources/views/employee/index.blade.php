@include('layouts.main')


<a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>

<a href="{{ route('employee.leave.create') }}" class="btn btn-secondary">Take Leave</a>

<a href="{{ route('employee.attendance.index') }}" class="btn btn-secondary">My Attendance</a>

<section>
<form method="POST" action="{{ route('employee.attendance.store', Auth::user()) }}">
    @csrf
    <input type="submit" name="submit" value="Attendance">
</form>
</section>


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


