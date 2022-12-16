@include('layouts.main')


<section>
    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
        <x-error name="email"/>
        <label class="form-label">Password</label>
        <input type="password" name="password"  class="form-control mb-3">
        <x-error name="password"/>
        <input type="submit" name="submit" value="Login" class="btn btn-primary">
    </form>
</section>