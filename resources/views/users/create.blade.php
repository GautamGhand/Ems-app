@include('layouts.main')

<section>
    <form action="{{ route('users.store') }}" method="POST" class="loginForm addUser create">
        @csrf
        <h1>Create User</h1>
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control" required value="{{old('first_name')}}">

        <x-error name="first_name"/>

        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control" required value="{{old('last_name')}}">

        <x-error name="last_name"/>

        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required value="{{old('email')}}">

        <x-error name="email"/>

        <label for="role_id" class="form-label">Role</label>
        <select name="role_id">
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        </select>
       
        <x-error name="role_id"/>

        <div class="buttons">
            <input type="submit" value="Invite User" name="submit" class="btn btn-secondary">
            <a href="{{ route('users.index') }}"  class="btn btn-secondary">CANCEL</a>
        </div>
    </form>
</section>
</body>
</html>