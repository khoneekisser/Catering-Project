
    function validateForm() {
        var cateringName = document.getElementById('catering_name').value.trim();
        var cateringLogo = document.getElementById('catering_logo').value.trim();
        var addressProvince = document.getElementById('address_province').value.trim();
        var addressDistrict = document.getElementById('address_district').value.trim();
        var addressMunicipality = document.getElementById('address_municipality').value.trim();
        var wardNo = document.getElementById('ward_no').value.trim();
        var panNo = document.getElementById('pan_no').value.trim();
        var panNoPictures = document.getElementById('pan_no_picture').files;
        var regNo = document.getElementById('reg_no').value.trim();
        var regNoPictures = document.getElementById('reg_no_picture').files;
        var userName = document.getElementById('user_name').value.trim();
        var password = document.getElementById('password').value.trim();
        var contactPerson = document.getElementById('contact_person').value.trim();
        var mobile = document.getElementById('mobile').value.trim();
        var email = document.getElementById('email').value.trim();
        
        // Check if required fields are empty
        if (cateringName === '' || cateringLogo === '' || addressProvince === '' || addressDistrict === '' ||
            addressMunicipality === '' || wardNo === '' || panNo === '' || panNoPictures.length === 0 ||
            regNo === '' || regNoPictures.length === 0 || userName === '' || password === '' ||
            contactPerson === '' || mobile === '' || email === '') {
            alert('Please fill out all required fields.');
            return false;
        }

        // Additional validation for email
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }

        // Additional validation for password length
        if (password.length < 8 || password.length > 15) {
            alert('Password must be between 8 to 15 characters.');
            return false;
        }

        // Validate mobile number format (allow only 10 digits)
        var mobileRegex = /^\d{10}$/;
        if (!mobileRegex.test(mobile)) {
            alert('Please enter a valid 10-digit mobile number.');
            return false;
        }

        return true;
    }

