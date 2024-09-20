<!-- Add Menu Popup -->
<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="profileViewOwner" style="display: none; width: 450px; height: 100%;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;" ></h2>

<div class="label-container" >
    <label for="user_name">Catering Name:</label>
    <div class="profile-data" id="catering_name">{{$branch->Catering_Name}}</div>

    <label for="user_name">User Name:</label>
    <div class="profile-data" id="user_name">{{$data->user_name}}</div>

    <label for="logo">Logo:</label>
    <div class="profile-data" id="logo">
        <img src="{{ asset('storage/' . $branch->Logo) }}" alt="Logo" style="max-width: 100%;">
    </div>

    <label for="location">Location:</label>
    <input type="text" id='latitude' value="{{$branch->latitude}}" hidden>
    <input type="text" id='longitude' value="{{$branch->longitude}}" hidden>
    <div id="map"></div>

    <label for="provience">Province:</label>
    <div class="profile-data" id="provience">{{$branch->Provience}}</div>
    
    <label for="address_district">District:</label>
    <div class="profile-data" id="address_district">{{$branch->District}}</div>

    <label for="address_municipality">Municipality:</label>
    <div class="profile-data" id="address_municipality">{{$branch->L_Muncipality}}</div>

    <label for="ward_no">Ward No:</label>
    <div class="profile-data" id="ward_no">{{$branch->Ward}}</div>

    <label for="pan_no">Pan No:</label>
    <div class="profile-data" id="pan_no">{{$branch->Pan_no}}</div>
    <div class="profile-data" id="logo">
        <img src="{{ asset('storage/' . $branch->Pan_no_photo) }}" alt="Logo" style="max-width: 100%;">
    </div>


    <label for="reg_no">Registration No:</label>
    <div class="profile-data" id="reg_no">{{$branch->Reg_no}}</div>
    <div class="profile-data" id="logo">
        <img src="{{ asset('storage/' . $branch->Reg_no_photo) }}" alt="Logo" style="max-width: 100%;">
    </div>

    <label for="contact_person">Contact Person:</label>
    <div class="profile-data" id="contact_person">{{$branch->Contact}}</div>

    <label for="mobile">Mobile:</label>
    <div class="profile-data" id="mobile">{{$branch->Mobile}}</div>

    <label for="email">Email:</label>
    <div class="profile-data" id="email">{{$branch->Email}}</div>

    <label for="remarks">Remarks:</label>
    <div class="profile-data" id="remarks">{{$branch->Remark}}</div>
</div>
   
    <button onclick="closePopup3('profileViewOwner')" style="width: 100%;" class="close-btn">Close</button>
</div>


<script>
     function initMap() {
        var lat = document.getElementById('latitude').value;
        var lng = document.getElementById('longitude').value;
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
    }
</script>