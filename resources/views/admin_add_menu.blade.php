<!-- Add Menu Popup -->
<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="adminAddMenu" style="display: none; width: 800px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    <div class="profile-container">
        <div class="profile-header">
            <h2>Search here....</h2>
        </div>
        
    {{-- for the search box --}}
        <div class="search-container">
            <input type="text" name="search" id="searchInputUser" placeholder="Search user by name">
            <button type="submit" id="searchButtonUser" onclick="searchUser()">Search</button>        
        </div>
            
    </div>

    
    <form class="profile-form" id="profileForm" action="{{ route('adminAddMenu') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" id="idContainMenu" name="b_id" hidden>
        <div class="form-group">
            <label for="cateringName">Catering Name:</label>
            <input type="text" id="cateringNameMenu" disabled>
        </div>
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
        <button type="submit"  style="width: 100%;" class="save-btn" id="saveProfile" onclick="enableFieldsAndSubmit()">Submit</button>
    </form>
    

    <button onclick="closePopup3('adminAddMenu')" style="width: 100%;"  class="close-btn">Close</button>

    <div class="container mt-4">
        <!-- Include the flash messages partial -->
        @include('partials.flash-message')

        <!-- Content of the page -->
        @yield('content')
    </div>
</div>


<script>
    function searchUser() {
        const searchInputUser = document.getElementById('searchInputUser').value.trim();
        const idContainMenu = document.getElementById('idContainMenu');
        const cateringNameMenu = document.getElementById('cateringNameMenu');
        console.log('Search Input:', searchInputUser); // Debug log

        if (searchInputUser !== '') {
            let foundClient = false;

            owners.forEach(function(client) {
                if (client.user_name === searchInputUser) {
                    console.log('Found Client:', client); // Debug log
                    var clientId = client.id;

                    ownerDetails[clientId].forEach(function(details) {
                        idContainMenu.value = details.o_id;
                        cateringNameMenu.value = details.Catering_Name;
                        console.log('Client Details:', details); // Debug log
                    });

                    alert(`Client with username ${searchInputUser} found.`);
                    foundClient = true;
                }
            });

            if (!foundClient) {
                alert(`No client with username ${searchInputUser} found.`);
            }
        } else {
            alert('Please enter a name to search.');
        }
    }
</script>




