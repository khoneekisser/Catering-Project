<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="adminShowOrderOwner" style="display: none;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    <div class="profile-container">
        <div class="profile-header">
            <h2>Search here....</h2>
            <i class="fas fa-edit edit-icon" id="editOrder"></i>
        </div>
        
        <div class="search-container">
            <input type="text" name="search" id="searchInputOrderEdit" placeholder="Search user by name">
            <button type="submit" id="searchButtonOrderEdit" onclick="searchUserOrder()">Search</button>        
        </div>
    </div>

    <input type="hidden" id="idContainOrderShow" name="b_id">
    <div class="form-group">
        <label for="cateringName">Catering Name:</label>
        <input type="text" id="cateringNameOrderShow" disabled>
    </div>
    
    <table> 
        <thead>
            <tr>
                <th rowspan="2">S/No.</th>
                <th rowspan="2">Customer Name</th>
                <th rowspan="2">Order Number</th>
                <th rowspan="2">Grand Total</th>
                <th rowspan="2">Payed Amount</th>
                <th rowspan="2">Payment Picture</th>
                <th rowspan="2">Booked Date </th>
                <th colspan="2">Time</th>
                <th rowspan="2">Custom Request</th>
                <th colspan="5">Status</th>
            </tr>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Owner Delete?</th>
                <th>Customer Delete?</th>
                <th>Cancelled?</th>
                <th>Details</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody id="venueTableBodyOrder"></tbody>
    </table>
    
    <button onclick="closePopup3('adminShowOrderOwner')" style="width: 100%;"  class="close-btn">Close</button>
   
    {{-- for the update of menu --}}
    <form id="hiddenOrderForm"  method="POST"  action="{{ route('adminUpdateOrders') }}" style="display: none;">
        @csrf
        {{-- for the order information part --}}
        <input type="hidden" id="formOrderId" name="id">
        {{-- <input type="hidden" id="formCustomerId" name="cus_id">
        <input type="hidden" id="formOwnerId" name="o_id">
        <input type="hidden" id="formGrandTotal" name="grand_total">
        <input type="hidden" id="formPaidAmount" name="paidAmnt">
        <input type="hidden" id="formPaymentPic" name="pay_pic">
        <input type="hidden" id="formBookingDate" name="b_date">
        <input type="hidden" id="formTimeFrom" name="time_from">
        <input type="hidden" id="formTimeTo" name="time_to">
        <input type="hidden" id="formCustomRequest" name="cus_req"> --}}
        <input type="hidden" id="formActive" name="Is_Active">
        <input type="hidden" id="formAvailable" name="is_available">
        <input type="hidden" id="formStatus" name="status">

        {{-- for the order ddetails --}}
        
        {{-- <input type="hidden" id="formOrderDetailsId" name="order_id">
        <input type="hidden" id="formItemName" name="item_name">
        <input type="hidden" id="formCategory" name="category">
        <input type="hidden" id="formRate" name="rate">
        <input type="hidden" id="formQuantity" name="quantity">
        <input type="hidden" id="formTotal" name="total"> --}}
    </form>


    
</div>

<!-- Popup for enlarged image -->
<div id="imagePopup" style="display:none; position:absolute; z-index:1000;">
    <img id="popupImage" src="" alt="Enlarged Image" style="max-width:150px; max-height:150px;">
</div>

<script>
  let editEnabledOrder = false; // Variable to track edit mode

  function confirmDelete(url) {
      if (confirm("Are you sure you want to delete this item?")) {
          window.location.href = url;
      }
  }

  function searchUserOrder() {
        const searchInputOrderEdit = document.getElementById('searchInputOrderEdit').value.trim();
        const idContainOrderShow = document.getElementById('idContainOrderShow');
        const cateringNameOrderShow = document.getElementById('cateringNameOrderShow');
        console.log('Search Input:', searchInputOrderEdit); // Debug log

        if (searchInputOrderEdit !== '') {
            let foundClient = false;

            owners.forEach(function(client) {
                if (client.user_name === searchInputOrderEdit) {
                    console.log('Found Client:', client); // Debug log
                    var clientId = client.id;

                    ownerDetails[clientId].forEach(function(details) {
                        idContainOrderShow.value = details.o_id;
                        cateringNameOrderShow.value = details.Catering_Name;

                        var ownerId = details.o_id;
                        populateTableOrder(ownerId);
                        console.log('Client Details:', details); // Debug log
                    });

                    alert(`Client with username ${searchInputOrderEdit} found.`);
                    foundClient = true;
                }
            });

            if (!foundClient) {
                alert(`No client with username ${searchInputOrderEdit} found.`);
            }
        } else {
            alert('Please enter a name to search.');
        }
    }

  function populateTableOrder(ownerId) {
        const tableBody = document.getElementById('venueTableBodyOrder');
        tableBody.innerHTML = ''; // Clear existing rows

        orders.forEach((item, index) => {
            if (item.o_id === ownerId) { // Correct reference to ownerId

                const ownerDelete = item.Is_Active ? 'Yes' : 'No';
                const statusValue = item.status ? 'No' : 'Yes';
                const customerDelete = item.is_available ? 'Yes' : 'No';
                
                customers.forEach((cn) => {
                    if (cn.id === item.cus_id) {
                          

                        if (customerDetails[cn.id]) {
                        customerDetails[cn.id].forEach((customer) => {
                            if (customer.c_id === cn.id) {
                                const fullName = customer.full_name;
                            
                   
                const row = document.createElement('tr');
                row.setAttribute('data-item-id', item.id);
                row.innerHTML = `
                    <input type="text" id="orderId_${item.id}" value="${item.id}" hidden disabled>
                    <td>${index + 1}</td>
                    <td style="width: 200px;">
                      
                        ${fullName}
                    </td>
                    <td>
                        ${item.order_number}
                    </td>
                    <td>          
                        ${item.grand_total}  
                    </td>
                    <td>
                        ${item.paidAmnt}
                    </td>
                    <td>
                        <img src="/storage/${item.pay_pic}" alt="Photo" class="thumbnail" 
                        onclick="showImagePopup('${item.pay_pic}')">
                    </td>        
                    <td>
                        ${item.b_date}
                    </td>
                    <td>
                        ${item.time_from}
                    </td>
                    <td>
                        ${item.time_to}
                    </td>
                    <td>
                        ${item.cus_req}
                    </td>
                    <td>
                        <select id="active_${item.id}" disabled style="background-color: transparent; border: none; height: 100%;">
                            <option value="1" ${ownerDelete === 'Yes' ? 'selected' : ''}>No</option>
                            <option value="0" ${ownerDelete === 'No' ? 'selected' : ''}>Yes</option>
                        </select>                    
                    </td>
                    <td>
                        <select id="available_${item.id}" disabled style="background-color: transparent; border: none;  height: 100%;">
                            <option value="1" ${customerDelete === 'Yes' ? 'selected' : ''}>No</option>
                            <option value="0" ${customerDelete === 'No' ? 'selected' : ''}>Yes</option>
                        </select>                    
                    </td>
                    <td>
                        <select id="orderStatus_${item.id}" disabled style="background-color: transparent; border: none; width: 100%; height: 100%;">
                            <option value="1" ${statusValue === 'No' ? 'selected' : ''}>No</option>
                            <option value="0" ${statusValue === 'Yes' ? 'selected' : ''}>Yes</option>
                        </select>
                    </td>
                    <td><button onclick="showDetails('${item.id}', this)">Show</button></td>
                    <td><button onclick="updateOrder('${item.id}')">Update</button></td>

                `;
                
                tableBody.appendChild(row);
                             }
                         });
                        }            
                }
            });
            }
        });

       
    }


    function showDetails(itemId, button) {
    console.log("Item ID:", itemId);
    const parentRow = button.closest('tr');
    
    // Check if the next sibling row is the details row
    const nextRow = parentRow.nextElementSibling;
    if (nextRow && nextRow.classList.contains('details-row')) {
        // If it is, remove it (hide the details)
        nextRow.remove();
    } else {
        // Otherwise, create and insert the details row
        const detailsRow = document.createElement('tr');
        detailsRow.classList.add('details-row');
        
        let detailsHtml = `
            <td colspan="13">
                <table>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Rate</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        orderDetails.forEach(detail => {
            if (detail.order_id == itemId) {
                detailsHtml += `
                    <input type="text" id="orderDetailsId_${detail.id}" value="${detail.order_id}" hidden disabled>
                    <tr>
                        <td>
                            ${detail.item_name}
                        </td>
                        <td>
                           ${detail.category}
                        </td>
                        <td>
                            ${detail.rate}
                        </td>
                        <td>
                            ${detail.quantity}
                        </td>
                        <td>
                            ${detail.total}
                        </td>
                    </tr>
                `;
            }
        });
        
        detailsHtml += `
                    </tbody>
                </table>
            </td>
        `;
        
        detailsRow.innerHTML = detailsHtml;
        parentRow.after(detailsRow);
    }
}


    // foor updating the order
  function updateOrder(itemId) {
    var orderId_ = document.getElementById('orderId_' + itemId).value;
    // var customerID_ = document.getElementById('customerID_'+ itemId).value;
    // var branchID_ = document.getElementById('branchID_'+ itemId).value;
    // var grand_total_ = document.getElementById('grand_total_' + itemId).value;
    // var paidAmnt_ = document.getElementById('paidAmnt_' + itemId).value;
    // var paidImage_ = document.getElementById('paidImage_' + itemId).value;
    // var b_date_ = document.getElementById('b_date_' + itemId).value;
    // var time_from_ = document.getElementById('time_from_' + itemId).value;
    // var time_to_ = document.getElementById('time_to_' + itemId).value;
    // let cus_req_ = document.getElementById('cus_req_' + itemId).value;
    var active_ = document.getElementById('active_' + itemId).value;
    var available_ = document.getElementById('available_' + itemId).value;
    var orderStatus_ = document.getElementById('orderStatus_' + itemId).value;

    // var orderDetailsId_ = document.getElementById('orderDetailsId_' + itemId).value;
    // var item_Name_ = document.getElementById('item_Name_' + itemId).value;
    // var category_ = document.getElementById('category_' + itemId).value;
    // var rate_ = document.getElementById('rate_' + itemId).value;
    // var quantity_ = document.getElementById('quantity_' + itemId).value;
    // var total_ = document.getElementById('total_' + itemId).value;


   
    console.log('itemID:', itemId);
    var formOrderId = document.getElementById('formOrderId');
    // var formCustomerId = document.getElementById('formCustomerId');
    // var formOwnerId = document.getElementById('formOwnerId');
    // var formGrandTotal = document.getElementById('formGrandTotal');
    // var formPaidAmount = document.getElementById('formPaidAmount');
    // var formPaymentPic = document.getElementById('formPaymentPic');
    // var formBookingDate = document.getElementById('formBookingDate');
    // var formTimeFrom = document.getElementById('formTimeFrom');
    // var formTimeTo = document.getElementById('formTimeTo');
    // var formCustomRequest = document.getElementById('formCustomRequest');
    var formActive = document.getElementById('formActive');
    var formAvailable = document.getElementById('formAvailable');
    var formStatus = document.getElementById('formStatus');

    // var formOrderDetailsId = document.getElementById('formOrderDetailsId');
    // var formItemName = document.getElementById('formItemName');
    // var formCategory = document.getElementById('formCategory');
    // var formRate = document.getElementById('formRate');
    // var formQuantity = document.getElementById('formQuantity');
    // var formTotal = document.getElementById('formTotal');

    formOrderId.value = orderId_;
    // formCustomerId.value = customerID_;
    // formOwnerId.value = branchID_;
    // formGrandTotal.value = grand_total_;
    // formPaidAmount.value = paidAmnt_;
    // formPaymentPic.value = paidImage_;
    // formBookingDate.value = b_date_;
    // formTimeFrom.value = time_from_;
    // formTimeTo.value = time_to_;
    // formCustomRequest.value = cus_req_;
    formActive.value = active_;
    formAvailable.value = available_;
    formStatus.value = orderStatus_;

    // formOrderDetailsId.value = orderDetailsId_;
    // formItemName.value = item_Name_;
    // formCategory.value = category_;
    // formRate.value = rate_;
    // formQuantity.value = quantity_;
    // formTotal.value = total_;

    document.getElementById('hiddenOrderForm').submit();

  }


  document.getElementById('editOrder').addEventListener('click', function() {
        const inputs = document.querySelectorAll('#venueTableBodyOrder input');
        const selects = document.querySelectorAll('#venueTableBodyOrder select');

        if (!editEnabledOrder) {
            inputs.forEach(input => input.disabled = false);
            selects.forEach(select => select.disabled = false); // Enable all select elements
            editEnabledOrder = true;
        } else {
            inputs.forEach(input => input.disabled = true);
            selects.forEach(select => select.disabled = true); // Disable all select elements
            editEnabledOrder = false;
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
