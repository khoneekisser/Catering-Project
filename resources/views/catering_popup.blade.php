
<!-- Add Catering Popup -->
<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="add_branches" style="display: none; width: 450px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    <form action="{{ route('storeData',$data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="contactPerson">Contact Person</label>
            <input type="text" id="contactPerson" name="Contact" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
        </div>
        <div class="form-group">
            <label for="Address">Address</label>
            <input type="text" id="location" name="Address" required>
        </div>
        <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="text" id="mobile" name="Mobile" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="Email" required>
        </div>
        <button type="submit">Submit</button>
    </form>
    <button onclick="closePopup3('add_branches')" style="width: 100%;" class="close-btn">Close</button>
</div>
