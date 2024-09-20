<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="adminViewOwnerProfile" style="display: none; width: 800px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: auto;"></h2>
    <div class="profile-container">
        <div class="profile-header">
            <h2>Search here....</h2>
            <i class="fas fa-edit edit-icon" id="editProfile"></i>
        </div>
        
        <div class="search-container">
            <input type="text" name="search" id="searchInput" placeholder="Search user by name">
            <button type="submit" id="searchButton">Search</button>        
        </div>
    </div>

    <form class="profile-form" id="profileForm" action="{{ route('ownerRecordUpdate') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <input type="text" id="idContain" name="id" hidden>

        <label for="user_name">Catering Name:</label>
        <input type="text" id="cateringName" name="Catering_Name" disabled>

        <label for="password">Logo:</label>
        <img id="logo" style="max-width: 100px; max-height: 100px;" alt="disable" onclick="openImgOwnerProfile(this)">
        <input type="file" id="catering_logo" name="catering_logo" accept="image/*" required onchange="updateFileNames(this)" disabled>

        <label for="location">Location</label>
        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude" disabled>

        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude" disabled>
        <div id="map"></div>

        <label for="password">Province:</label>
        <input type="text" id="provience" disabled>
        <select id="address_province" name="address_province" required onchange="populateDistricts()" disabled>
            <option value="Koshi">Koshi</option>
            <option value="Madhesh">Madhesh</option>
            <option value="Bagmati">Bagmati</option>
            <option value="Gandaki">Gandaki</option>
            <option value="Lumbini">Lumbini</option>
            <option value="Karnali">Karnali</option>
            <option value="Sudurpashchim">Sudurpashchim</option>
        </select>

        <label for="address_district">District:</label>
        <input type="text" id="district" disabled>
        <select id="address_district" name="address_district" required disabled>
        </select>

        <label for="address_municipality">Municipality:</label>
        <input type="text" id="address_municipality" name="address_municipality" value="" required disabled>

        <label for="ward_no">Ward No:</label>
        <input type="number" id="ward_no" name="ward_no" value="" required disabled>

        <label for="pan_no">Pan No:</label>
        <input type="text" id="Pan_no" name="Pan_no" required disabled>

        <img id="pan_pic" style="max-width: 100px; max-height: 100px;" alt="Logo" onclick="openImgOwnerProfile(this)">
        <label class="custom-file-upload">
            <input type="file" id="pan_no_picture" name="pan_no_picture[]" accept="image/*" multiple onchange="updatePanNoFileNames(this)" disabled>
            Choose photo
        </label>

        <label for="reg_no">Registration No:</label>
        <input type="text" id="reg_no" name="reg_no" value="" disabled>

        <img id="reg_pic" style="max-width: 100px; max-height: 100px;" alt="Logo" onclick="openImgOwnerProfile(this)">
        <label class="custom-file-upload">
            <input type="file" id="reg_no_picture" name="reg_no_picture[]" accept="image/*" multiple onchange="updateRegNoFileNames(this)" disabled>
            Choose photo
        </label>

        <label for="contact_person">Contact:</label>
        <input type="text" id="contact_person" name="contact_person" value="" required disabled>

        <label for="mobile">Mobile:</label>
        <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" maxlength="10" value="" required disabled>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="" required disabled>

        <label for="remarks">Remarks:</label>
        <textarea id="remarks" name="remarks" disabled></textarea>
        
        <button type="button" class="save-btn" id="saveProfile" style="width: 100%;" onclick="enableFieldsAndSubmit()">Save</button>
    </form>
    
    <button onclick="closePopup3('adminViewOwnerProfile')" style="width: 100%;" class="close-btn">Close</button>
</div>

<script src="js/district.js"></script>
<script src="js/mobile.js"></script>
<script src="js/password.js"></script>
<script src="js/photoSelection.js"></script>
<script src="js/formValidation.js"></script>

<script>
function openImgOwnerProfile(imgElement) {
    const imgSrc = imgElement.src;
    const newWindow = window.open('', '_blank');
    newWindow.location.href = imgSrc;
}


function enableFieldsAndSubmit() {
    // Enable all disabled fields
    document.querySelectorAll('#profileForm input:disabled, #profileForm select:disabled, #profileForm textarea:disabled').forEach(function(field) {
        field.disabled = false;
    });

    // Submit the form
    document.getElementById('profileForm').submit();
}

document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('searchButton');
    const logo = document.getElementById('logo');
    const panPic = document.getElementById('pan_pic');
    const regPic = document.getElementById('reg_pic');

    // Function to check if an image has a valid src and hide if not
    function checkImage(image) {
        if (!image.src || image.src === window.location.href) {
            image.style.display = 'none';
        } else {
            image.style.display = 'block';
        }
    }

    // Initial check
    checkImage(logo);
    checkImage(panPic);
    checkImage(regPic);    

    // for filling the value to the form
    const idContain = document.getElementById('idContain');
    const cateringName = document.getElementById('cateringName');
    const catering_logo = document.getElementById('logo');
    const catering_latitude = document.getElementById('latitude');
    const catering_longitude = document.getElementById('longitude');
    const address_province = document.getElementById('provience');
    const address_district = document.getElementById('district');
    const address_municipality = document.getElementById('address_municipality');
    const ward_no = document.getElementById('ward_no');
    const Pan_no = document.getElementById('Pan_no');
    const pan_no_picture = document.getElementById('pan_pic');
    const reg_no = document.getElementById('reg_no');
    const reg_no_picture = document.getElementById('reg_pic');
    const contact_person = document.getElementById('contact_person');
    const mobile = document.getElementById('mobile');
    const email = document.getElementById('email');
    const remarks = document.getElementById('remarks');
    
    searchButton.addEventListener('click', function() {
        const searchInput = document.getElementById('searchInput').value.trim();

        if (searchInput !== '') {
            let foundClient = false;
            // Assuming owners is your array of client objects
            owners.forEach(function(client) {
                if (client.user_name === searchInput) {
                    // Example: Replace alert with actual logic to display or use the found client data
                    
                    var clientId = client.id;

                    // for retriving the data from ownerDetails
                    ownerDetails[clientId].forEach(function(details) {
                        const imageUrl = `/storage/${details.Logo}`;
                        const panUrl = `/storage/${details.Pan_no_photo}`;
                        const regUrl = `/storage/${details.Reg_no_photo}`;

                        
                        idContain.value = details.id;
                        cateringName.value = details.Catering_Name;
                        catering_logo.src = imageUrl;
                        address_district.value = details.District;
                        address_province.value = details.Provience;
                        address_municipality.value = details.L_Muncipality;
                        ward_no.value = details.Ward;
                        Pan_no.value = details.Pan_no;
                        pan_no_picture.src = panUrl;
                        reg_no.value = details.Reg_no;
                        reg_no_picture.src = regUrl;
                        contact_person.value = details.Contact;
                        mobile.value = details.Mobile;
                        email.value = details.Email;
                        remarks.value = details.Remark;

                        // Get latitude and longitude from details
                        const latitude = details.latitude;
                        const longitude = details.longitude;

                        catering_latitude.value = details.latitude;
                        catering_longitude.value = details.longitude;

                        // Initialize the map
                        initMap(latitude, longitude);

                        checkImage(logo);
                        checkImage(panPic);
                        checkImage(regPic);
                    });

                    alert(`Client with username ${searchInput} found.`);
                    foundClient = true;
                    
                }
            });
            
            if (!foundClient) {
                alert(`No client with username ${searchInput} found.`);
            }
        } else {
            alert('Please enter a name to search.');
        }
    });
});

function initMap(lat, lng) {
    var location = { lat: parseFloat(lat), lng: parseFloat(lng) };
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: location
    });
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        draggable: true
    });

    // Update latitude and longitude fields on marker drag
    google.maps.event.addListener(marker, 'dragend', function(evt){
        document.getElementById('latitude').value = evt.latLng.lat().toFixed(6);
        document.getElementById('longitude').value = evt.latLng.lng().toFixed(6);
    });

    // Update latitude and longitude fields on map click
    google.maps.event.addListener(map, 'click', function(event) {
        marker.setPosition(event.latLng);
        document.getElementById('latitude').value = event.latLng.lat().toFixed(6);
        document.getElementById('longitude').value = event.latLng.lng().toFixed(6);
    });
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.getElementById('editProfile');
    const saveButton = document.getElementById('saveProfile');
    const formElements = document.querySelectorAll('#profileForm input, #profileForm select, #profileForm textarea');
    let isEditable = false;

    // Toggle form elements for editing
    editButton.addEventListener('click', function() {
        isEditable = !isEditable;
        formElements.forEach(element => element.disabled = !isEditable);
        saveButton.style.display = isEditable ? 'block' : 'none';
    });

    // Save changes and show confirmation
    saveButton.addEventListener('click', function() {
        if (confirm('Are you sure you want to save changes?')) {
            // Perform save operation (e.g., send data to server)

            // Disable form elements after saving
            isEditable = false;
            formElements.forEach(element => element.disabled = true);
            saveButton.style.display = 'none';
        }
    });
});
</script>

<style>
body {
    font-family: Arial, sans-serif;
}
.profile-container {
    max-width: 100%;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
.profile-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.profile-header h2 {
    margin: 0;
}
.profile-header .edit-icon {
    cursor: pointer;
    font-size: 1.5em;
    color: #007bff;
}
.profile-form {
    margin-top: 20px;
}
.profile-form label {
    display: block;
    margin-top: 10px;
}
.profile-form input, .profile-form textarea {
    width: calc(100% - 20px);
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
}
.profile-form img {
    display: block;
    max-width: 150px;
    margin: 10px 0;
    cursor: pointer;
}
.save-btn {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #6dfc41;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.save-btn:hover {
    background-color: rgb(45, 100, 0);
}
</style>
