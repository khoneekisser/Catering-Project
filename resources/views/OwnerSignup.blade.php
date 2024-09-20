<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <style>
        #map {
            height: 200px;
            width: 100%;
        }
        #selectedLocation {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
    </style>


    <link rel="stylesheet" href="css/signup.css">
</head>
<body onload="initMap()">
    <form action="{{ route('ownerdatasubmit') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        @if(Session::has('success'))
        <div class='alert alert-success'>{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
            <div class='alert alert-danger'>{{Session::get('fail')}}</div>
        @endif 
        @csrf

        <label for="catering_name">Catering Name:</label>
        <input type="text" id="catering_name" name="catering_name" value="{{ old('catering_name')}}" required>
       

        <label for="catering_logo">Catering Logo:</label>
        <label class="custom-file-upload">
            <input type="file" id="catering_logo" name="catering_logo" accept="image/*" required onchange="updateFileNames(this)">
            Choose file
        </label>
        <div id="fileNamesContainer"></div>
        

        <label for="location">Location:</label>
        <input type="text" id="latitude" name="latitude" placeholder="Latitude" readonly required>
        <input type="text" id="longitude" name="longitude" placeholder="Longitude" readonly required>
        <div id="map"></div>

        <label for="address_province">Province:</label>
        <select id="address_province" name="address_province" required onchange="populateDistricts()">
            <option value="Koshi">Koshi</option>
            <option value="Madhesh">Madhesh</option>
            <option value="Bagmati">Bagmati</option>
            <option value="Gandaki">Gandaki</option>
            <option value="Lumbini">Lumbini</option>
            <option value="Karnali">Karnali</option>
            <option value="Sudurpashchim">Sudurpashchim</option>
        </select>
        

        <label for="address_district">District:</label>
        <select id="address_district" name="address_district" required>
            <!-- Options will be populated dynamically -->
        </select>

        <label for="address_municipality">Local Municipality:</label>
        <input type="text" id="address_municipality" name="address_municipality" value="{{ old('address_municipality')}}" required>
        

        <label for="ward_no">Ward No:</label>
        <input type="number" id="ward_no" name="ward_no" value="{{ old('ward_no')}}" required>
        

        <label for="pan_no">PAN No:</label>
        <input type="text" id="pan_no" name="pan_no" value="{{ old('pan_no')}}" required>
        
        
        <label class="custom-file-upload">
            <input type="file" id="pan_no_picture" name="pan_no_picture[]" accept="image/*" multiple required onchange="updatePanNoFileNames(this)">
            Choose photo
        </label>
        <div id="PanNoFileNamesContainer"></div>

        <label for="reg_no">Registration No:</label>
        <input type="text" id="reg_no" name="reg_no" value="{{ old('reg_no')}}" required>
        

        <label class="custom-file-upload">
            <input type="file" id="reg_no_picture" name="reg_no_picture[]" accept="image/*" multiple required onchange="updateRegNoFileNames(this)">
            Choose photo
        </label>
        <div id="RegNoFileNamesContainer"></div>

        <label for="user_name">User Name:</label>
        <input type="text" id="user_name" name="user_name" value="{{ old('user_name')}}" required>
        
    
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


        <label for="contact_person">Contact Person:</label>
        <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person')}}" required>

        <label for="mobile">Mobile:</label>
        <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" maxlength="10" value="{{ old('mobile')}}" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email')}}" required>

        <label for="remarks">Remarks:</label>
        <textarea id="remarks" name="remarks"></textarea>
        

        <input type="submit" value="Submit">
       
    </form>

    <a href="{{ route('loginPage') }}" class="styled-button">Login Page</a>

    

<script src="js/district.js"></script>
<script src="js/mobile.js"></script>
<script src="js/password.js"></script>
<script src="js/photoSelection.js"></script>
<script src="js/formValidation.js"></script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBecVmH1Y3ZVu6YjtOsBOW-mPYQrSOq_Gc&callback=initMap" async defer></script>
<script>
    let map, marker;

        function initMap() {
            const initialLocation = { lat: 28.213829257891994, lng: 83.9733823971926}; // Initial map center

            map = new google.maps.Map(document.getElementById('map'), {
                center: initialLocation,
                zoom: 8
            });

            marker = new google.maps.Marker({
                position: initialLocation,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });

            google.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });
        }
</script>

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
