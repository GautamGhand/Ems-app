@include('layouts.main')

<a href="{{ route('employee') }}" class="btn btn-primary">Go Back</a>

<section>
    <table class="table table-striped">
        <th>First Name</th>
        <th>Attendance Date</th>
        <th>Status</th>
        @foreach($attendances as $attendance)
        <tr>
            <td>{{Auth::user()->first_name}}</td>
            <td>{{ $attendance->attendance_date}}</td>
            <td>{{ $attendance->status }}</td>
        </tr>
            @endforeach
    </table>
</section>