<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="adminViewCustomerProfile" style="display: none; width: 800px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    <div class="profile-container">
        <div class="profile-header">
            <h2>Search here....</h2>
            <i class="fas fa-edit edit-icon" id="editProfileCustomer"></i>
        </div>
        
        <div class="search-container">
            <input type="text" name="search" id="searchInputCustomerProfile" placeholder="Search user by name">
            <button type="submit" id="searchButtonCustomerProfile">Search</button>        
        </div>
    </div>

        <form class="profile-form" id="profileFormCustomer" action="{{ route('customerRecordUpdate') }}"
         method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf
            <input type="text" id="idContainCustomer" name="id" hidden>

            <img id="customer_photo" style="max-width: 100px; max-height: 100px;" onclick="openImgCustomerProfile(this)" alt="disable">
            <label for="profile">Update ?</label>
            <input type="file" id="customer_photo_store" name="customer_photo" accept="image/*" required onchange="updateFileNames(this)" disabled>


            <label for="user_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" disabled>

            <label for="customer_photo">Address:</label>
            <input type="text" id="address" name="address" disabled>

            <label for="mobile">Mobile:</label>
            <input type="text" id="mobileNew" name="mobile" disabled>

            <label for="email">Email:</label>
            <input type="text" id="emailNew" name="email" disabled>
        
            
            <button type="button" style="width: 100%;" class="save-btn" id="saveProfileCustomer" onclick="enableFieldsAndSubmitCustomerProfile()">Save</button>
        </form>
    
    <button onclick="closePopup3('adminViewCustomerProfile')" style="width: 100%;"  class="close-btn">Close</button>
</div>



<script>

function openImgCustomerProfile(imgElement) {
    const imgSrc = imgElement.src;
    const newWindow = window.open('', '_blank');
    newWindow.location.href = imgSrc;
}
    function enableFieldsAndSubmitCustomerProfile() {
        // Enable all disabled fields
        document.querySelectorAll('#profileFormCustomer input:disabled, #profileFormCustomer select:disabled, #profileFormCustomer textarea:disabled').forEach(function(field) {
            field.disabled = false;
        });

        // Submit the form
        document.getElementById('profileFormCustomer').submit();
    }



    document.addEventListener('DOMContentLoaded', function() {
        const searchButtonCustomerProfile = document.getElementById('searchButtonCustomerProfile');
        const customer_photo = document.getElementById('customer_photo');

            // Function to check if an image has a valid src and hide if not
            function checkImage(image) {
                if (!image.src || image.src === window.location.href) {
                    image.style.display = 'none';
                } else {
                    image.style.display = 'block';
                }
            }

            // Initial check
            checkImage(customer_photo);   

        // for filling the value to the form
        const idContainCustomer = document.getElementById('idContainCustomer');
        const full_name = document.getElementById('full_name');
        const profilePicture = document.getElementById('customer_photo');
        const address = document.getElementById('address');
        const mobilenumber = document.getElementById('mobileNew');
        const emailaddress = document.getElementById('emailNew');
        
        searchButtonCustomerProfile.addEventListener('click', function() {
            const searchInputCustomerProfile = document.getElementById('searchInputCustomerProfile').value.trim();

            if (searchInputCustomerProfile !== '') {
                let foundClient = false;
                // Assuming owners is your array of client objects
                customers.forEach(function(client) {
                    if (client.user_name === searchInputCustomerProfile) {
                        // Example: Replace alert with actual logic to display or use the found client data
                        
                        

                        var clientId = client.id;

                        // for retriving the data from ownerDetails
                        customerDetails[clientId].forEach(function(details) {
                            const imageUrl = `/storage/${details.customer_photo}`;
                            
                            idContainCustomer.value = details.id;
                            full_name.value = details.full_name;
                            profilePicture.src = imageUrl;        
                            mobilenumber.value = details.mobile;
                            emailaddress.value = details.email;
                            address.value = details.address;

                            console.log('id', details.id);

                            checkImage(customer_photo);
                        });


                        alert(`Client with username ${searchInputCustomerProfile} found.`);
                        foundClient = true;
                        
                    }
                });
                
                if (!foundClient) {
                    alert(`No client with username ${searchInputCustomerProfile} found.`);
                }
            } else {
                alert('Please enter a name to search.');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const editButton = document.getElementById('editProfileCustomer');
        const saveButton = document.getElementById('saveProfileCustomer');
        const formElements = document.querySelectorAll('#profileFormCustomer input, #profileFormCustomer select, #profileFormCustomer textarea');
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