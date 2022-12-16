@include('layouts.main')


<section>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email">
        <x-error name="email"/>
        <label>Password</label>
        <input type="password" name="password">
        <x-error name="password"/>
        <input type="submit" name="submit" value="Login">
    </form>
</section>