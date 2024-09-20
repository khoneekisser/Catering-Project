<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="changeQr" style="display: none; width: 450px; height: 100%;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;" ></h2>

    <div class="label-container" >

        <label for="QR">Current QR:</label>
        <div class="profile-data" id="logo">
            <img src="{{ asset('storage/' . $branch->qr_photo) }}" alt="Logo" style="max-width: 100%;">
        </div>

        <form action="{{ route('addQR', $branch->o_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="change-qr">Change QR:</label>
            <input type="file" id="qr_photo" name="qr_photo"  accept="image/*" required >

            <button type="submit"  style="width: 100%;">Submit</button>
        </form>
    </div>

<button onclick="closePopup3('changeQr')" style="width: 100%;" class="close-btn">Close</button>
</div>