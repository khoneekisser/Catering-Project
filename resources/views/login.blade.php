<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<!-- Include FontAwesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    {{-- @if(Session::has('success'))
        <div class='alert alert-success' style="background-color:rgb(0, 0, 0); color: white;">{{Session::get('success')}}</div>
    @endif --}}
    @if(Session::has('fail'))
        <div class='alert alert-danger' style="color:white;">{{Session::get('fail')}}</div>
    @endif
    <form class="login-form" action="{{ route('login') }}" method="POST">
        
        @csrf
        <input type="text" name="user_name" placeholder="Username" required>
        <div style="position: relative;">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <!-- Replace image with eye icon -->
            <span class="visibility-icon" onclick="togglePasswordVisibility()">
                <i id="eye-icon" class="fas fa-eye-slash"></i>
            </span>
        </div>
        <input type="submit" value="Login">
    </form> 
    <div class="signup-link">
        Sign Up
        <div class="signup-dropdown">
            <div class="signup-dropdown-content">
                <a href="{{ route('customer-sign-up')}}">Customer</a>
                <a href="{{ route('owner-sign-up')}}">Owner</a>
            </div>
        </div>
    </div>
</div>

<script src="js/admin.js"></script>
@if(session('success'))
<script>
    window.onload = function() {
        var successMessage = 'You have registered successfully.';
        alert(successMessage);
    };
</script>
@endif



</body>
</html>
