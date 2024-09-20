<!-- Add Menu Popup -->
<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="add_menu" style="display: none; width: 800px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;" ></h2>
    @isset($branch)
    <form action="{{ route('addMenu',$branch->o_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="items">Item Name</label>
            <input type="text" id="item_name" name="item_name" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <div class="select-wrapper">
                <select name="category" id="category">
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Dinner</option>
                    <option value="snack">Snack</option>
                    <option value="soft_drink">Soft drink</option>
                    <option value="hard_drink">Hard drink</option>
                </select>
            </div>        
        </div>
        <div class="form-group">
            <label for="picture">Picture</label>
            <input type="file" id="picture" name="picture" accept="image/*" required>
        </div> 
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="description">Desrciption</label>
            <input type="text" id="description" name="description" required>
        </div>
        <div class="form-group">
            <label for="availability">Available</label>
            <div class="select-wrapper">
                <select name="available" id="available">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <button type="submit" style="width: 100%;">Submit</button>
    </form>
    @endisset
    <button onclick="closePopup3('add_menu')" style="width: 100%;" class="close-btn">Close</button>
</div>