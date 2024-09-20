<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="settingOwner" style="display: none; width: 450px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: auto;"></h2>

    <div class="change-password-container">
        <form action="{{ route('updateOwnerPassword') }}" onsubmit="return changePassword()" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="current_password">Current Password:</label>
            <div class="password-container">
                <input type="password" id="current_password" name="current_password">
                <span class="toggle-password" onclick="togglePasswordVisibility('current_password')">&#128065;</span>
            </div>
            
            <label for="new_password">New Password:</label>
            <div class="password-container">
                <input type="password" id="new_password" name="new_password">
                <span class="toggle-password" onclick="togglePasswordVisibility('new_password')">&#128065;</span>
            </div>
            
            <label for="confirm_password">Confirm New Password:</label>
            <div class="password-container">
                <input type="password" id="confirm_password" name="confirm_password">
                <span class="toggle-password" onclick="togglePasswordVisibility('confirm_password')">&#128065;</span>
            </div>
            
            <button class="submit-btn">Change Password</button>
        </form>
    </div>

    <button onclick="closePopup3('settingOwner')" style="width: 100%;" class="close-btn">Close</button>
</div>

<script>
    function changePassword() {
        var currentPassword = document.getElementById('current_password').value;
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

        if (newPassword !== confirmPassword) {
            alert('New passwords do not match.');
            return false;
        }
        if (newPassword.length < 8) {
            alert('Password length should be greater than 8.');
            return false;
        }

        // Add your password change logic here
        console.log('Current Password:', currentPassword);
        console.log('New Password:', newPassword);

        return true;
    }

    function togglePasswordVisibility(inputId) {
        var input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>

<style>
    .change-password-container {
        margin-top: 20px;
    }

    .change-password-container label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    .password-container {
        position: relative;
        width: calc(100% - 22px); /* 100% width minus padding and border */
        margin-bottom: 15px;
    }

    .password-container input[type="password"],
    .password-container input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }

    .submit-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #2aeef7;
        border: none;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        cursor: pointer;
        text-align: center;
        width: 100%;
    }

    .submit-btn:hover {
        background-color: #1fb9c6;
    }
</style>
