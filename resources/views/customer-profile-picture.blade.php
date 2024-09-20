<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="profilePicture" style="display: none; width: 460px; min-height:400px; max-height: 600px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;" ></h2>

    <div class="label-container" >

        <label for="QR">Current Profile Picture:</label>
        <div class="profile-data" id="logo">
            <img src="{{ asset('storage/' . $customer->customer_photo) }}" alt="No profile picture" style="max-width: 100%;">
        </div>

        <form action="{{ route('addPP', $customer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="change-qr">Change Profile Picture:</label>
            <input type="file" id="customer_photo" name="customer_photo"  accept="image/*" required >

            <button type="submit" style="width: 100%;">Submit</button>
        </form>
    </div>

<button onclick="closePopup3('profilePicture')" style="width: 100%;" class="close-btn">Close</button>
</div>