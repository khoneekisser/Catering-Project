<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="adminViewCustomerTransaction" style="display: none;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>

    <div class="profile-container">
        <div class="profile-header">
            <h2>Search here....</h2>
        </div>
        
        <div class="search-container">
            <input type="text" name="search" id="searchInputCustomerTransaction" placeholder="Search user by name">
            <button type="submit" id="searchButtonCustomerTransaction" onclick="searchUserTransaction()">Search</button>        

            <label for="forSelection"  style="margin-left: 500px;">Please select the type:</label>
                <select id="selectionSpecificStatus">
                    <option value="">All</option>
                    <option value="1">Completed</option>
                    <option value="0">In Complete</option>
                </select>
        </div>

        <label for="customer name">Customer Name</label><br>
        <input type="text" id="customerNameTransaction" readonly style="width: 100%; padding: 5px;">
    </div>

   

    <table> 
        <thead>
            <tr>
                <th rowspan="2">S/No.</th>
                <th rowspan="2">Order Number</th>
                <th rowspan="2">Grand Total</th>
                <th rowspan="2">Payed Amount</th>
                <th rowspan="2">Payment Picture</th>
                <th rowspan="2">Booked Date </th>
                <th colspan="2">Time</th>
                <th rowspan="2">Details</th>
            </tr>
            <tr>
                <th>From</th>
                <th>To</th>
            </tr>
        </thead>
        <tbody id="venueTableBodyTransaction"></tbody>
        <tfoot id="venueTableFooterTransaction"></tfoot>
    </table>



    <button onclick="closePopup3('adminViewCustomerTransaction')" style="width: 100%;" class="close-btn">Close</button>
</div>

<script>
    function searchUserTransaction() {
        const searchInputCustomerTransaction = document.getElementById('searchInputCustomerTransaction').value.trim();
        const customerNameTransaction = document.getElementById('customerNameTransaction');
        const selectionSpecificStatus = document.getElementById('selectionSpecificStatus').value;
        console.log('Search Input:', searchInputCustomerTransaction); // Debug log

        if (searchInputCustomerTransaction !== '') {
            let foundClient = false;

            customers.forEach(function(client) {
                if (client.user_name === searchInputCustomerTransaction) {
                    console.log('Found Client:', client); // Debug log
                    var clientId = client.id;

                    customerDetails[clientId].forEach(function(details) {
                        customerNameTransaction.value = details.full_name;

                        var customerId = details.c_id;
                        
                        populateTableTransaction(customerId, selectionSpecificStatus);
                        console.log('Client Details:', details); // Debug log
                    });

                    alert(`Client with username ${searchInputCustomerTransaction} found.`);
                    foundClient = true;
                }
            });

            if (!foundClient) {
                alert(`No client with username ${searchInputCustomerTransaction} found.`);
            }
        } else {
            alert('Please enter a name to search.');
        }
    }

    function populateTableTransaction(customerId, statusComplete) {
        const tableBody = document.getElementById('venueTableBodyTransaction');
        const tableFooter = document.getElementById('venueTableFooterTransaction');
        tableBody.innerHTML = ''; // Clear existing rows
        tableFooter.innerHTML = ''; // Clear existing footer

        let totalSales = 0;
        let totalAdvancePayment = 0;
        let serialNumber = 1;
        orders.forEach((item, index) => {
            if (item.cus_id === customerId && (statusComplete === "" || item.completed == statusComplete)) { // Correct reference to customerId                
                const row = document.createElement('tr');
                row.setAttribute('data-item-id', item.id);
                row.innerHTML = `
                    <input type="text" id="orderId_${item.id}" value="${item.id}" hidden disabled>
                    <td>${serialNumber}</td>
                    <td style="width: 200px;">
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
                        onclick="showTransactionImage('${item.pay_pic}')">
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
                    <td><button onclick="showDetailTransaction('${item.id}', this)">Show</button></td>
                `;
                serialNumber++;
                tableBody.appendChild(row);
                totalSales += parseFloat(item.grand_total);
                totalAdvancePayment += parseFloat(item.paidAmnt);
                }
            });   
            const footerRow = document.createElement('tr');
            footerRow.innerHTML = `
                <td colspan="2"><strong>Total</strong></td>
                <td><strong>${totalSales.toFixed(2)}</strong></td>
                <td><strong>${totalAdvancePayment.toFixed(2)}</strong></td>
                <td colspan="9"></td>
            `;    
            tableFooter.appendChild(footerRow);
    }
    
    function showDetailTransaction(itemId, button) {
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

    function showTransactionImage(src) {
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