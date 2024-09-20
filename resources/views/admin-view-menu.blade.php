<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="adminEditMenu" style="display: none;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    <div class="profile-container">
        <div class="profile-header">
            <h2>Search here....</h2>
            <i class="fas fa-edit edit-icon" id="editMenu"></i>
        </div>
        
        <div class="search-container">
            <input type="text" name="search" id="searchInputMenuEdit" placeholder="Search user by name">
            <button type="submit" id="searchButtonMenuEdit" onclick="searchUserMenu()">Search</button>        
        </div>
    </div>

    <input type="hidden" id="idContainMenuShow" name="b_id">
    <div class="form-group">
        <label for="cateringName">Catering Name:</label>
        <input type="text" id="cateringNameMenuShow" disabled>
    </div>
    
    <table> 
        <thead>
            <tr>
                <th rowspan="2" style="width: 50px;">S/No.</th>
                <th rowspan="2">Item Name</th>
                <th rowspan="2">Category</th>
                <th rowspan="2">Photo</th>
                <th rowspan="2">Select Image</th>
                <th rowspan="2">Price</th>
                <th rowspan="2">Description</th>               
                <th colspan="2">Status</th>
                <th colspan="2" rowspan="2">Action</th>
            </tr>
            <tr>
                <th>Available ?</th>
                <th>Deleted ?</th>
            </tr>
        </thead>
        <tbody id="venueTableBodyMenu"></tbody>
    </table>
    
    <button onclick="closePopup3('adminEditMenu')" style="width: 100%;"  class="close-btn">Close</button>
   
    {{-- for the update of menu --}}
    <form id="hiddenForm"  method="POST"  action="{{ route('adminEditMenu') }}" style="display: none;">
        @csrf
        <input type="hidden" id="itemIdSubmit" name="id">
        <input type="hidden" id="branchIdSubmit" name="b_id">
        <input type="hidden" id="itemNameSubmit" name="item_name">
        <input type="hidden" id="itemCategorySubmit" name="category">
        <input type="hidden" id="itemImageSubmit" name="picture">
        <input type="hidden" id="itemPriceSubmit" name="price">
        <input type="hidden" id="itemDescriptionSubmit" name="description">
        <input type="hidden" id="itemAvailableSubmit" name="available">
        <input type="hidden" id="itemStatusSubmit" name="status">
    </form>


    
</div>

<!-- Popup for enlarged image -->
<div id="imagePopup" style="display:none; position:absolute; z-index:1000;">
    <img id="popupImage" src="" alt="Enlarged Image" style="max-width:150px; max-height:150px;">
</div>

<script>
  let editEnabled = false; // Variable to track edit mode

  function confirmDelete(url) {
      if (confirm("Are you sure you want to delete this item?")) {
          window.location.href = url;
      }
  }

  function searchUserMenu() {
        const searchInputMenuEdit = document.getElementById('searchInputMenuEdit').value.trim();
        const idContainMenuShow = document.getElementById('idContainMenuShow');
        const cateringNameMenuShow = document.getElementById('cateringNameMenuShow');
        console.log('Search Input:', searchInputMenuEdit); // Debug log

        if (searchInputMenuEdit !== '') {
            let foundClient = false;

            owners.forEach(function(client) {
                if (client.user_name === searchInputMenuEdit) {
                    console.log('Found Client:', client); // Debug log
                    var clientId = client.id;

                    ownerDetails[clientId].forEach(function(details) {
                        idContainMenuShow.value = details.o_id;
                        cateringNameMenuShow.value = details.Catering_Name;

                        var ownerId = details.o_id;
                        populateTable(ownerId);
                        console.log('Client Details:', details); // Debug log
                    });

                    alert(`Client with username ${searchInputMenuEdit} found.`);
                    foundClient = true;
                }
            });

            if (!foundClient) {
                alert(`No client with username ${searchInputMenuEdit} found.`);
            }
        } else {
            alert('Please enter a name to search.');
        }
    }

  function populateTable(ownerId) {
        const tableBody = document.getElementById('venueTableBodyMenu');
        tableBody.innerHTML = ''; // Clear existing rows

        menu.forEach((item, index) => {
            if (item.b_id === ownerId) { // Correct reference to ownerId

                const selectedValue = item.available ? 'Yes' : 'No';
                const deletedValue = item.status ? 'No' : 'Yes';
                
            
                const row = document.createElement('tr');
                row.setAttribute('data-item-id', item.id);
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>                    
                        <input type="text" id="branchID_${item.id}" value="${item.b_id}" disabled hidden>
                        <input type="text" id="itemName_${item.id}" value="${item.item_name}" disabled>
                    </td>
                    <td><input type="text" id="itemCategory_${item.id}" value="${item.category}" disabled></td>
                    <td>
                        <img src="/storage/${item.picture}" alt="Photo" class="thumbnail" onclick="showImagePopup('${item.photo}')">
                    </td>
                    <td>
                        <input type="file" id="itemImage_${item.id}" name="picture" disabled>
                    </td>
                    <td><input type="number" id="itemPrice_${item.id}" value="${item.price}" step="0.01" disabled></td>
                    <td><input type="text" id="itemDescription_${item.id}" value="${item.description}" disabled></td>
                    <td>
                        <select id="itemAvailable_${item.id}" disabled>
                            <option value="1" ${selectedValue === 'Yes' ? 'selected' : ''}>Yes</option>
                            <option value="0" ${selectedValue === 'No' ? 'selected' : ''}>No</option>
                        </select>                    
                    </td>
                    
                    <td>
                        <select id="itemStatus_${item.id}" disabled>
                            <option value="1" ${deletedValue === 'No' ? 'selected' : ''}>No</option>
                            <option value="0" ${deletedValue === 'Yes' ? 'selected' : ''}>Yes</option>
                        </select>
                    </td>
                    <td><button onclick="updateItem('${item.id}')">Update</button></td>

                `;
                tableBody.appendChild(row);
            }
        });

       
    }


    // foor updating the menu
  function updateItem(itemId) {
    var  branchID = document.getElementById('branchID_'+ itemId).value;
    // var  menuID = document.getElementById('menuId_'+ itemId).value;
    var itemName = document.getElementById('itemName_' + itemId).value;
    var itemCategory = document.getElementById('itemCategory_' + itemId).value;
    var itemImage_ = document.getElementById('itemImage_' + itemId).value;
    var itemPrice = document.getElementById('itemPrice_' + itemId).value;
    var itemDescription = document.getElementById('itemDescription_' + itemId).value;
    var itemAvailable = document.getElementById('itemAvailable_' + itemId).value;
    var itemStatus = document.getElementById('itemStatus_' + itemId).value;
   
    console.log('itemID:', itemId);
    var itemIdSubmit = document.getElementById('itemIdSubmit');
    var branchIdSubmit = document.getElementById('branchIdSubmit');
    var itemNameSubmit = document.getElementById('itemNameSubmit');
    var itemCategorySubmit = document.getElementById('itemCategorySubmit');
    var itemImageSubmit = document.getElementById('itemImageSubmit');
    var itemPriceSubmit = document.getElementById('itemPriceSubmit');
    var itemDescriptionSubmit = document.getElementById('itemDescriptionSubmit');
    var itemAvailableSubmit = document.getElementById('itemAvailableSubmit');
    var itemStatusSubmit = document.getElementById('itemStatusSubmit');

   
    itemIdSubmit.value = itemId;
    branchIdSubmit.value = branchID;
    itemNameSubmit.value = itemName;
    itemCategorySubmit.value = itemCategory;
    itemImageSubmit.value = itemImage_;
    itemPriceSubmit.value = itemPrice;
    itemDescriptionSubmit.value = itemDescription;
    itemAvailableSubmit.value = itemAvailable;
    itemStatusSubmit.value = itemStatus;

    document.getElementById('hiddenForm').submit();

  }


  document.getElementById('editMenu').addEventListener('click', function() {
    const inputs = document.querySelectorAll('#venueTableBodyMenu input');
    const selects = document.querySelectorAll('#venueTableBodyMenu select');
    
    if (!editEnabled) {
        inputs.forEach(input => input.disabled = false);
        selects.forEach(select => select.disabled = false); // Enable all select elements
        editEnabled = true;
    } else {
        inputs.forEach(input => input.disabled = true);
        selects.forEach(select => select.disabled = true); // Disable all select elements
        editEnabled = false;
    }
});


  function showImagePopup(src) {
    const imagePopup = document.getElementById('imagePopup');
    const popupImage = document.getElementById('popupImage');
    popupImage.src = src;
    imagePopup.style.display = 'block';
    imagePopup.style.left = `${event.clientX}px`;
    imagePopup.style.top = `${event.clientY}px`;
  }

  window.onclick = function(event) {
    const imagePopup = document.getElementById('imagePopup');
    if (event.target !== imagePopup && event.target !== imagePopup.firstElementChild) {
      imagePopup.style.display = 'none';
    }
  }
</script>

<style>
    .thumbnail-container {
        position: relative;
        display: inline-block;
    }
    .thumbnail {
        cursor: pointer;
        transition: opacity 0.3s ease;
    }
</style>
