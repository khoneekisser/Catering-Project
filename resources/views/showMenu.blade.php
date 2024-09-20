<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popupCateringData" id="show_menu" style="display: none; width: 1100px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>

     <table>
    <table>
        <thead>
        <tr>
            <th rowspan="2">Item Name</th>
            <th rowspan="2">Category</th>
            <th rowspan="2">Picture</th>
            <th rowspan="2">Rate</th>
            <th rowspan="2">Description</th>
            <th rowspan="2">Quantity</th>
            <th rowspan="2">Total</th>     
        </thead>
        <tbody id="venueTableBody">
        
        </tbody>
        <tfoot>
        <tr>
            <td colspan="6" style="text-align: right;">Grand Total:</td>
            <td>
                <input type="text" name="grand_total" id="grand_total" required>
            </td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: right;">Paid Amount:</td>
            <td id="paidAmnt">
                <input type="number" style="border:none;" id="paidAmntInput" name="paidAmnt" oninput="paymentAmt()" required>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="padding-left: 33%;">Payment Picture:</td>
            <td colspan="3">
                <input type="file" id="pay_pic" name="pay_pic" accept="image/*" oninput="payment()" required>
            </td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: right;">               
                <label for="b_date">Booking Date:</label>               
            </td>
            <td>
                <input type="date" style="width:200px; border:none;" id="b_date" name="b_date" oninput="dateInput(); dateInput()" required>                    
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <label>Booking Time</label>
            </td>
            <td>
                <label>From</label>
            </td>
            <td>
                <select id="time_from" name="time_from" oninput="timeFrom()" style="border: none;" required>
                    <option value="06:00">06:00 AM</option>
                    <option value="07:00">07:00 AM</option>
                    <option value="08:00">08:00 AM</option>
                    <option value="09:00">09:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="13:00">1:00 PM</option>
                    <option value="14:00">2:00 PM</option>
                    <option value="15:00">3:00 PM</option>
                    <option value="16:00">4:00 PM</option>
                    <option value="17:00">5:00 PM</option>
                    <option value="18:00">6:00 PM</option>
                    <option value="19:00">7:00 PM</option>
                    <option value="20:00">8:00 PM</option>
                    <option value="21:00">9:00 PM</option>
                    <option value="22:00">10:00 PM</option>
                </select>
            </td>
            <td>
                <label style="padding-left: 85%;">To:</label>
            </td>
            <td>
                <select id="time_to" name="time_to" style="border: none;" oninput="timeTo()" required>
                    <option value="07:00">07:00 AM</option>
                    <option value="08:00">08:00 AM</option>
                    <option value="09:00">09:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="13:00">1:00 PM</option>
                    <option value="14:00">2:00 PM</option>
                    <option value="15:00">3:00 PM</option>
                    <option value="16:00">4:00 PM</option>
                    <option value="17:00">5:00 PM</option>
                    <option value="18:00">6:00 PM</option>
                    <option value="19:00">7:00 PM</option>
                    <option value="20:00">8:00 PM</option>
                    <option value="21:00">9:00 PM</option>
                    <option value="22:00">10:00 PM</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="4">Any Requests:</td>
            <td colspan="3">
                <input type="text" name="cus_req" id="cus_req" oninput="customRequest()" style="width: 100%; height:30px; border: none;" placeholder="Optional">
            </td>
        </tr>
        
        </tfoot>
    </table>
    <label for="showing- qr">Scan here to pay:</label>
    <div id="showQr"></div>

       

    <form action="{{ route('addOrder') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <input type="hidden" name="cus_id" id="hidden_cus_id" value="{{$data->id}}" required>
        <input type="hidden" name="o_id" id="hidden_o_id" required>
        <input type="hidden" name="paidAmnt" id="hiddenPaidAmnt" required>
        <input type="hidden" name="b_date" id="hiddenBDate" required>
        <input type="hidden" name="time_from" id="hiddenTimeFrom" required>
        <input type="hidden" name="time_to" id="hiddenTimeTo" required>
        <input type="hidden" name="cus_req" id="hiddenCusReq">
        <input type="hidden" name="grand_total" id="hidden_grand_total">
        <input type="file" id="hiddenPayPic" name="pay_pic" required style="position: absolute; left: -9999px;">
        <div id="hiddenInputsContainer"></div>

        <button type="submit" style="width: 100%;" class="submit-button">Submit</button>
    </form>

    <button onclick="closePopupMenu('show_menu'); 
    openPopup3('show_catering_names', 'Available Caterings')" class="close-btn"
    style="width: 100%;">Close</button>
</div>



<script>
// for viewing the menu of each catering
function openPopupMenu(popupID, title, menuID) {
    var popupOverlay = document.getElementById('popupOverlay');
    var popupWindow = document.getElementById(popupID);
    var popupTitle = popupWindow.querySelector('h2');
    var tableBody = document.getElementById('venueTableBody');

    cateringID = menuID;
    var valueFromBlade = {!! json_encode($menu) !!};

    showQr(cateringID);
    console.log('id:',cateringID);

    popupTitle.textContent = title;

    // Clear existing table rows
    tableBody.innerHTML = '';

    document.getElementById('hidden_o_id').value = menuID;
    // Filter menuData based on the condition
    var filteredMenuData = valueFromBlade.filter(function(item) {
        return item.b_id === menuID;
    });

    // Iterate over filteredMenuData and create table rows
    filteredMenuData.forEach(function(item) {
        var photoPath = '{{ asset('storage/') }}' + '/' + item.picture;

        var row = '<tr>' +
                '<td><input readonly style="height: 50px; border: none; background-color: transparent; outline: none; width:100px;" id="item_name_'+item.id+'" name="item_name[]" type="text" value="' + item.item_name + '" /></td>' +
                '<td><input readonly style="height: 50px; border: none; background-color: transparent; outline: none; width: 100px;" type="text" id="category_'+item.id+'" value="' + item.category + '" /></td>' +
                '<td><img src="' + photoPath + '" alt="No Photo" width="100"></td>' +
                '<td><input readonly style="height: 50px; border: none; background-color: transparent; outline: none; width: 50px;" type="text" id="rate_'+item.id+'" value="' + item.price + '" /></td>' +
                '<td>'+ item.description + '</td>' +
                '<td><input  style="height: 50px; border: none; background-color: transparent; outline: none; width: 150px;" type="number" id="quantity_' + item.id + '" min="0" value="0" oninput="updateTotal(' + item.id + ', ' + item.price + ')" /></td>' +
                '<td><input readonly style="height: 50px; border: none; background-color: transparent; outline: none; width: 50px;" type="text" id="total_price_' + item.id + '" value="0" /></td>' +
                '</tr>';

        tableBody.innerHTML += row;
    });

    popupOverlay.style.display = 'block';
    popupWindow.style.display = 'block';
    
    closePopup3('show_catering_names');
}


    function showQr(cateringID) {
        caterings.forEach((item) => {
            if (item.o_id === cateringID) {
                var qrPhotoDeliver = document.getElementById('showQr');
                qrPhotoDeliver.innerHTML = ''; // Clear any previous images

                var imgElement = document.createElement('img');
                imgElement.src = `/storage/${item.qr_photo}`;
                imgElement.id = 'qrPhoto';
                imgElement.alt = 'QR Code'; // Optional: Provide alt text for accessibility

                qrPhotoDeliver.appendChild(imgElement);
            }
        });
    }

function paymentAmt(){
    document.getElementById('hiddenPaidAmnt').value = document.getElementById('paidAmntInput').value;
}

function payment(){
    var payPicInput = document.getElementById('pay_pic');
    var hiddenPayPicInput = document.getElementById('hiddenPayPic');

    // Check if a file is selected
    if (payPicInput.files.length > 0) {
        // Assign the file to hiddenPayPicInput
        hiddenPayPicInput.files = payPicInput.files;
    }
}

function dateInput(){
    document.getElementById('hiddenBDate').value = document.getElementById('b_date').value;
}

function customRequest(){
    document.getElementById('hiddenCusReq').value = document.getElementById('cus_req').value;
}

function timeFrom(){
    // Get the selected value from the select element
    var selectedValue = document.getElementById('time_from').value;
    
    // Set the value of the hidden input element
    document.getElementById('hiddenTimeFrom').value = selectedValue;
}

function timeTo(){
// Get the selected value from the select element
    var selectedValue = document.getElementById('time_to').value;
    
    // Set the value of the hidden input element
    document.getElementById('hiddenTimeTo').value = selectedValue;
}

function updateTotal(itemId, price) {
    var quantity = document.getElementById('quantity_' + itemId).value;
    var totalPrice = price * quantity;
    document.getElementById('total_price_' + itemId).value = totalPrice; // corrected to textContent

    // Get hidden inputs container
    var hiddenInputsContainer = document.getElementById('hiddenInputsContainer');
    
    // Remove existing hidden inputs for this item
    var existingInputs = document.querySelectorAll(`input[name="items[${itemId}][name]"], 
                                                   input[name="items[${itemId}][category]"], 
                                                   input[name="items[${itemId}][rate]"],
                                                   input[name="items[${itemId}][total]"], 
                                                   input[name="items[${itemId}][quantity]"]`);
    existingInputs.forEach(function(input) {
        hiddenInputsContainer.removeChild(input);
    });

    // Add new hidden inputs for this item
    if (quantity > 0) {
        // Create hidden input for item name
        var itemNameInput = document.createElement('input');
        itemNameInput.type = 'hidden'; // corrected to hidden
        itemNameInput.name = 'items[' + itemId + '][name]';
        itemNameInput.value = document.getElementById('item_name_' + itemId).value;
        hiddenInputsContainer.appendChild(itemNameInput);

        // Create hidden input for category
        var categoryInput = document.createElement('input');
        categoryInput.type = 'hidden'; // corrected to hidden
        categoryInput.name = 'items[' + itemId + '][category]';
        categoryInput.value = document.getElementById('category_' + itemId).value;
        hiddenInputsContainer.appendChild(categoryInput);

        // Create hidden input for rate
        var rateInput = document.createElement('input');
        rateInput.type = 'hidden'; // corrected to hidden
        rateInput.name = 'items[' + itemId + '][rate]';
        rateInput.value = price;
        hiddenInputsContainer.appendChild(rateInput);

        // Create hidden input for total
        var totalInput = document.createElement('input');
        totalInput.type = 'hidden'; // corrected to hidden
        totalInput.name = 'items[' + itemId + '][total]';
        totalInput.value = totalPrice; // corrected to use totalPrice
        hiddenInputsContainer.appendChild(totalInput);

        // Create hidden input for quantity
        var quantityInput = document.createElement('input');
        quantityInput.type = 'hidden'; // corrected to hidden
        quantityInput.name = 'items[' + itemId + '][quantity]';
        quantityInput.value = quantity;
        hiddenInputsContainer.appendChild(quantityInput);
    }

    updateGrandTotal();
}


//for calculating grand total
function updateGrandTotal() {
    var totalElements = document.querySelectorAll('[id^="total_price_"]');
    var grandTotal = 0;

    totalElements.forEach(function(element) {
        grandTotal += parseFloat(element.value);
    });

    // Set the hidden field value
    document.getElementById('grand_total').value = grandTotal.toFixed(2);

    document.getElementById('hidden_grand_total').value = grandTotal.toFixed(2);
}



function closePopupMenu(popupID) {
    var popupOverlay = document.getElementById('popupOverlay');
    var popupWindow = document.getElementById(popupID);

    popupOverlay.style.display = 'none';
    popupWindow.style.display = 'none';

    openPopup3('show_catering_names');
}
</script>

<script>
    // Get the array of restricted dates from the Blade template
    const restrictedDates = @json($restrictedDates);

    // Get today's date in YYYY-MM-DD format
    const today = new Date().toISOString().split('T')[0];

    document.getElementById('b_date').addEventListener('focus', function() {
        const input = this;
        let alertShown = false; // Flag variable to track if alert has been shown

        input.addEventListener('change', function() {
            const selectedDate = input.value;

            // Check if the selected date is in the restricted dates array and before today's date
            if (restrictedDates.includes(selectedDate) && selectedDate < today) {
                if (!alertShown) {
                    input.value = '';
                    alert('This date is already taken.');
                    alertShown = true;
                }
            } else if (selectedDate < today) {
                // Check if the selected date is before today's date
                if (!alertShown) {
                    input.value = '';
                    alert('You cannot select a date that had passed.');
                    alertShown = true;
                }
            } else if (restrictedDates.includes(selectedDate)) {
                // Check if the selected date is in the restricted dates array
                if (!alertShown) {
                    input.value = '';
                    alert('This date is already taken.');
                    alertShown = true;
                }
            }

            // Reset alertShown flag if the selected date is valid
            if (!restrictedDates.includes(selectedDate) && selectedDate >= today) {
                alertShown = false;
            }
        });
    });
</script>
<style>
    #showQr img {
    max-width: 400px; /* Adjust as needed */
    height: auto;
}
</style>