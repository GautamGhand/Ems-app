<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="app.css">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
<div>
    @include('layouts.flash-message')
</div>

<div class="main-body">
    <div class="side-bar">
         <ul>
            @auth
            @if (!Auth::user()->is_employee)
            <a href="{{ route('employee.leave.index')  }}" class="btn btn-primary"><li>Leaves</li></a>

            <a href="{{ route('users.create') }}" class="btn btn-primary"><li>Invite User</li></a>
            @else
            <a href="{{ route('employee.leave.create') }}" class="btn btn-secondary"><li>Take Leave</li></a>

            <a href="{{ route('employee.attendance.index') }}" class="btn btn-secondary"><li>My Attendance</li></a>

            <li>
                <form method="POST" action="{{ route('employee.attendance.store', Auth::user()) }}">
                    @csrf
                    <input type="submit" name="submit" value="Attendance" class="btn btn-primary attendance">
                </form>
            </li>
            @endif
            @endauth 
              
         </ul>
    </div>
    <div class="rest-body">
