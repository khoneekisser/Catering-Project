<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<!-- Include FontAwesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #000;
    }

    .login-container {
        width: 200px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #1a1a1a;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        transition: box-shadow 0.3s ease;
    }

    .login-container:hover {
        box-shadow: 0 0 20px rgba(38, 216, 229, 0.7);
    }

    .login-container:hover h2 {
        color: #1de4ef; /* Change text color on hover */
    }

    .login-container h2 {
        text-align: center;
        color: #fff;
        margin-bottom: 30px;
        transition: color 0.3s ease; /* Smooth transition for color change */
    }

    .login-form input{
        width: calc(100% - 20px);
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        outline: none;
    }
    .login-form select, .login-form input[type="submit"], .login-form .signup-link {
        width: calc(100%);
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        outline: none;
    }

    /* Adjust styling for dropdown options */
    .login-form select option {
        background-color: #1a1a1a;
        color: #fff;
    }

    .login-form input[type="submit"] {
        cursor: pointer;
        background-color: #1de4ef;
        transition: background-color 0.3s ease;
    }

    .login-form input[type="submit"]:hover {
        background-color: #026160;
    }

    .login-form .visibility-icon {
        position: absolute;
        top: 35%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #fff;
    }
    
   
    
</style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form class="login-form" action="{{ route('adminLogin') }}" method="post">
        @if(Session::has('success'))
            <div class='alert alert-success'>{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
            <div class='alert alert-danger'>{{Session::get('fail')}}</div>
        @endif 
        @csrf
        <input type="text" name="username" placeholder="Username" required>
        <div style="position: relative;">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <!-- Replace image with eye icon -->
            <span class="visibility-icon" onclick="togglePasswordVisibility()">
                <i id="eye-icon" class="fas fa-eye-slash"></i>
            </span>
        </div>
        <input type="submit" value="Login">
    </form>
</div>

<script src="js/admin.js"></script>

</body>
</html>
