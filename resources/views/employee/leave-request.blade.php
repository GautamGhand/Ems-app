@include('layouts.main')


<a href="{{ route('users.index') }}" class="btn btn-primary">Go Back</a>

<table class="table table-striped">
    <th>First Name</th>
    <th>Last Name</th>
    <th>Leave Date</th>
    <th>Approve</th>
    <th>Reject</th>
@foreach($leaves as $leave)
        <tr>
        <td>{{ $leave->user->first_name }}</td>
        <td>{{ $leave->user->last_name }}</td>
        <td>{{ $leave->leave_dates }}</td>
    @if($leave->status == 'pending')
        <td>
            <a href="{{ route('employee.leave.approve', $leave) }}" class="btn btn-primary">Approve</a>
        </td>
        <td>
            <a href="{{ route('employee.leave.reject', $leave) }}" class="btn btn-primary">Reject</a>
        </td>
    @endif
        </tr>
@endforeach