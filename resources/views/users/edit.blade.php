@include('layouts.main')

<section>
    <form action="{{ route('users.update', $user) }}" method="POST" class="loginForm addUser edit">
        @csrf
        <h1>EDIT User</h1>
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
        <x-error name="first_name"/>
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
        <x-error name="last_name"/>
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
        <x-error name="email"/>
        <div>
            <label for="role_id" class="form-label">Role</label>
        </div>
            <select name="role_id">
                    <option value="{{ $role->id }}" @if($user->role_id==$role->id) Selected @endif>{{ $role->name }}</option>
            </select>
        <x-error name="role_id"/>
        <div class="buttons">
            <input type="submit" value="Update Profile" name="addUser" class="btn btn-secondary">
            <a href="{{ route('users.index') }}"  class="btn btn-secondary">CANCEL</a>
        </div>
    </form>
</section>