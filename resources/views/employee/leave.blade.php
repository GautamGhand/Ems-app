@include('layouts.main')

<section>
    <form method="POST" action="{{ route('employee.leave.store') }}">
        @csrf
        <label>Leave Subject</label>
        <input type="text" name="subject" required value="{{ old('subject') }}">
        <x-error name="subject"/>
        <label>Leave Description</label>
        <textarea name="description" required>{{ old('description') }}</textarea>
        <x-error name="description" />
        <label>Leave Date</label>
        <input type="date" name="leave_dates" required>
        <x-error name="leave_dates" />
        <input type="submit" name="submit" value="Take Leave" class="btn btn-primary">
        <a href="{{ route('employee') }}" class="btn btn-primary">Cancel</a>
    </form>
</section>