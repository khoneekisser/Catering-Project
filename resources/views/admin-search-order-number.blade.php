<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="searchOrderNumber" style="display: none;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    <div class="profile-container">
        <div class="profile-header">
            <h2>Search here....</h2>
        </div>
                
        <div class="search-container">
            <input type="text" name="search" id="searchInputItemNumber" placeholder="Search by order number...">
            <button type="submit" id="searchButtonOrderEdit" onclick="searchItemNumber()">Search</button>        
        </div>

    </div>

    <table> 
        <thead>
            <tr>
                <th rowspan="2">S/No.</th>
                <th rowspan="2">Customer Name</th>
                <th rowspan="2">Catering Name</th>
                <th rowspan="2">Contact Person</th>
                <th rowspan="2">Grand Total</th>
                <th rowspan="2">Payed Amount</th>
                <th rowspan="2">Payment Picture</th>
                <th rowspan="2">Booked Date </th>
                <th colspan="2">Time</th>
                <th rowspan="2">Custom Request</th>
                <th colspan="4">Status</th>
            </tr>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Owner Delete?</th>
                <th>Customer Delete?</th>
                <th>Cancelled?</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody id="tableByOrderNumber"></tbody>
        <tfoot id="venueTableFooterReport"></tfoot>
    </table>

        <button onclick="closePopup3('searchOrderNumber')" style="width: 100%;" class="close-btn">Close</button>
</div>


<script>
    
  function searchItemNumber() {
        const searchInputItemNumber = document.getElementById('searchInputItemNumber').value.trim();
        const cateringNameOrderShow = document.getElementById('cateringNameOrderShow');
        console.log('Search Input:', searchInputItemNumber); // Debug log

        if (searchInputItemNumber !== '') {
            let foundClient = false;

            orders.forEach(function(client) {
                if (client.order_number === searchInputItemNumber) {
                    console.log('Found Client:', client); // Debug log
                    var clientId = client.id;


                        populateTableByOrderNumber(searchInputItemNumber);
                       

                    alert(`Order with order no: ${searchInputItemNumber} found.`);
                    foundClient = true;
                }
            });

            if (!foundClient) {
                alert(`No order with order number ${searchInputItemNumber} found.`);
            }
        } else {
            alert('Please enter a order number to search.');
        }
    }


    function populateTableByOrderNumber(orderNumber) {
        const tableBody = document.getElementById('tableByOrderNumber');
        tableBody.innerHTML = ''; // Clear existing rows

        orders.forEach((item, index) => {
            if (item.order_number === orderNumber) { // Correct reference to orderNumber

                const ownerDelete = item.Is_Active ? 'Yes' : 'No';
                const statusValue = item.status ? 'No' : 'Yes';
                const customerDelete = item.is_available ? 'Yes' : 'No';

                var customerId = item.cus_id;
                var ownerId = item.o_id;
                
                customerDetails[customerId].forEach((cn) => {
                    // ownerDetails[clientId].forEach(function(details) {                  
                    if (cn.c_id === item.cus_id) {
                        ownerDetails[ownerId].forEach((od) => {
                            if (od.o_id === item.o_id) {
                                const row = document.createElement('tr');
                                row.setAttribute('data-item-id', item.id);
                                row.innerHTML = `
                                <input type="text" id="orderId_${item.id}" value="${item.id}" hidden disabled>
                                <td>${index + 1}</td>
                                <td style="width: 200px;">
                                    ${cn.full_name}
                                </td>
                                <td>
                                    ${od.Catering_Name}  
                                </td>
                                <td>
                                    ${od.Contact}  
                                </td>
                                <td>          
                                    ${item.grand_total}  
                                </td>
                                <td>
                                    ${item.paidAmnt}
                                </td>
                                <td>
                                    <img src="/storage/${item.pay_pic}" alt="Photo" class="thumbnail" 
                                    onclick="showImageOrderNumber('${item.pay_pic}')">
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
                                <td><button onclick="showDetailsItemNumber('${item.id}', this)">Show</button></td>
                            `;                    
                            tableBody.appendChild(row);                            
                            }                           
                        });
                    }               
            });
            }
        });

       
    }


    function showDetailsItemNumber(itemId, button) {
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


function showImageOrderNumber(src) {
        const newWindow = window.open('', '_blank');
        newWindow.document.write(`<html><body style="margin: 0; display: flex; justify-content: center; align-items: center;">
                                  <img src="/storage/${src}" style="max-width: 100%; max-height: 100%;" onclick="window.close();">
                                  </body></html>`);
        newWindow.document.title = 'Payment Image';
    }

    window.onclick = function(event) {
        const imagePopup = document.getElementById('imagePopup');
        if (event.target !== imagePopup && event.target !== imagePopup.firstElementChild) {
            imagePopup.style.display = 'none';
        }
    }
</script>