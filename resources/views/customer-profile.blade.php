<!-- Add Menu Popup -->
<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="profileViewCustomer" style="display: none; width: 450px; height: 500px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;" ></h2>

<div class="label-container" >

    <div class="profile-data" id="logo">
        <img src="{{ asset('storage/' . $customer->customer_photo) }}" alt="no image" onclick="openImgCustomerProfile(this)" style="max-width: 100%;" >
    </div>

    <label for="user_name">Full Name:</label>
    <div class="profile-data" id="catering_name">{{$customer->full_name}}</div>

    <label for="user_name">User Name:</label>
    <div class="profile-data" id="user_name">{{$data->user_name}}</div>

    <label for="logo">Address:</label>
    <div class="profile-data" id="user_name">{{$customer->address}}</div>

    <label for="mobile">Mobile:</label>
    <div class="profile-data" id="mobile">{{$customer->mobile}}</div>

    <label for="email">Email:</label>
    <div class="profile-data" id="email">{{$customer->email}}</div>

</div>
   
    <button onclick="closePopup3('profileViewCustomer')" style="width: 100%;" class="close-btn">Close</button>
</div>


<script>

function openImgCustomerProfile(imgElement) {
    const imgSrc = imgElement.src;
    const newWindow = window.open('', '_blank');
    newWindow.location.href = imgSrc;
}

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