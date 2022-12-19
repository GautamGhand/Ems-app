@include('layouts.main')


<a href="{{ route('users.index') }}" class="btn btn-primary">Go Back</a>
<section>
<table class="table table-striped">
    <th>Attendance Date</th>
    <th>Status</th>
    @foreach($attendances as $attendance)
        <tr>
        <td>{{ $attendance->attendance_date }}</td>
        <td>{{ $attendance->status }}</td>
        </tr>
    @endforeach
</table>
</section>
