<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/signup.css">

</head>
<body>
    <form action="{{ route('customerDataSubmit') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        @if(Session::has('success'))
        <div class='alert alert-success'>{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
            <div class='alert alert-danger'>{{Session::get('fail')}}</div>
        @endif 
 
        @csrf

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
        
       

        <label for="user_name">User Name:</label>
        <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}" required>
        

        <label for="password">Password:</label>
        <div style="position: relative;">
            <input type="password" id="password" name="password" required>
            <button type="button" id="togglePassword" style="position: absolute; right: 30px; top: 40%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #fff;">
                <i class="fas fa-eye-slash"></i>
            </button>
        </div>

        <label for="password">Confirm Password:</label>
        <div style="position: relative;">
            <input type="password" id="c_password" name="c_password" required>
            <button type="button" id="c_togglePassword" style="position: absolute; right: 30px; top: 40%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #fff;">
                <i class="fas fa-eye-slash"></i>
            </button>
        </div>

        <label for="address">Address</label>
        <input type="text" id="address" name="address" value="{{ old('address') }}" required>
       

        <label for="mobile">Mobile:</label>
        <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" maxlength="10" value="{{ old('mobile') }}" required>
        

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email')}}" required>
        
        <label class="custom-file-upload">
            <input type="file" id="customer_photo" name="customer_photo" accept="image/*"  onchange="updateFileNames(this)">
            Select a Profile Picture
        </label>
        <div id="fileNamesContainer"></div>
        

        <input type="submit" value="Submit">
    </form>

    <a href="{{ route('loginPage') }}" class="styled-button">Login Page</a>

<script src="js/mobile.js"></script>
<script src="js/password.js"></script>
<script src="js/photoSelection.js"></script>
<script src="js/formValidation.js"></script>

<style>
    body {
    position: relative; /* Ensure the body is a positioned ancestor */
}

.styled-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #000; /* Blue background color */
    color: rgb(238, 12, 216); /* White text color */
    text-decoration: none; /* Remove underline */
    border-radius: 5px; /* Rounded corners */
    font-weight: bold; /* Bold text */
    text-align: center; /* Center text */
    position: absolute; /* Absolute positioning */
    top: 10px; /* Distance from the top */
    right: 10px; /* Distance from the right */
}

.styled-button:hover {
    background-color: #e3103a;
    color: rgb(255, 255, 255) /* Darker blue on hover */
}


</style>

</body>
</html>
