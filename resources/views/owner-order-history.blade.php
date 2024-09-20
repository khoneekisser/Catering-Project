<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="viewOrderHistory" style="display: none; width: 90%;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    <div class="profile-container">
       
        <div class="search-container">
            <input type="text" name="search" id="searchOrderByName" placeholder="Search order by user name">
            <button type="submit" id="searchOrderByNameButton" onclick="searchByNamer()">Search</button>        
        </div>
        <div class="search-container">
            <input type="text" name="search" id="searchOrderById" placeholder="Search order by order id">
            <button type="submit" id="searchOrderByIdButton" onclick="searchUserOrder()">Search</button>        
        </div>
    </div>

    <div class="form-group">
        <label for="cateringName">Customer Name:</label>
        <input type="text" id="cateringNameOrderShow" disabled>
    </div>
    
    <table> 
        <thead>
            <tr>
                <th rowspan="2">S/No.</th>
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
                <th>Deleted ?</th>
                <th>Cancelled?</th>
                <th>Completed?</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody id="venueTableBodyOrder"></tbody>
    </table>
    
    <button onclick="closePopup3('viewOrderHistory')" style="width: 100%;" class="close-btn">Close</button>    
</div>

<script>
    // this function will search the user by user name
    function searchByNamer() {
        const searchOrderByName = document.getElementById('searchOrderByName').value.trim();
        const cateringNameOrderShow = document.getElementById('cateringNameOrderShow');
        console.log('Search Input:', searchOrderByName); // Debug log

        if (searchOrderByName !== '') {
            let foundClient = false;

            userName.forEach(function(client) {
                if (client.user_name === searchOrderByName) {
                    console.log('Found Client:', client); // Debug log
                    var clientId = client.id;
                    // Assuming customerDetails is an array of Customer model instances
                    customerDetails.forEach(function(customer) {
                        if (customer.c_id === clientId) {
                            // Access properties of the Customer instance
                            cateringNameOrderShow.value = customer.full_name;
                            
                            var customerId = customer.c_id; // Assuming `id` is the correct identifier
                            populateTableOrder(customerId);
                            console.log('Customer Details:', customer); // Debug log
                        } else {
                            console.log('Not going anywhere.');
                        }
                    });

                    alert(`Client with username ${searchOrderByName} found.`);
                    foundClient = true;
                }
            });

            if (!foundClient) {
                alert(`No client with username ${searchOrderByName} found.`);
            }
        } else {
            alert('Please enter a name to search.');
        }
    }

    // this function will search the order by order number
    function searchUserOrder() {
        const searchOrderById = document.getElementById('searchOrderById').value.trim();
        const cateringNameOrderShow = document.getElementById('cateringNameOrderShow');
        console.log('Search Input:', searchOrderById); // Debug log

        if (searchOrderById !== '') {
            let foundClient = false;

            order.forEach(function(client) {
                console.log(client);
                if (client.order_number === searchOrderById) {
                    console.log('Found Client:', client); // Debug log
                    var clientId = client.cus_id;
                    // Assuming customerDetails is an array of Customer model instances
                    customerDetails.forEach(function(customer) {
                        if (customer.c_id === clientId) {
                            // Access properties of the Customer instance
                            cateringNameOrderShow.value = customer.full_name;
                            
                            var orderId = searchOrderById; // Assuming `id` is the correct identifier
                            populateTableOrderById(orderId);
                            console.log('Customer Details:', customer); // Debug log
                        } else {
                            console.log('Not going anywhere.');
                        }
                    });

                    alert(`Client with order number:${searchOrderById} found.`);
                    foundClient = true;
                }
            });

            if (!foundClient) {
                alert(`No client with ordernumber:${searchOrderById} found.`);
            }
        } else {
            alert('Please enter a order number to search.');
        }
    }


    // funtion to show the data by the search of user name

    function populateTableOrder(customerId) {
        console.log('Hello  world');
        const tableBody = document.getElementById('venueTableBodyOrder');
        tableBody.innerHTML = ''; // Clear existing rows

        let serialNumber = 1;
        order.forEach((item, index) => {
            if (item.cus_id === customerId) { // Correct reference to customer
           
                const row = document.createElement('tr');
                row.setAttribute('data-item-id', item.id);
                row.innerHTML = `
                    <td>${serialNumber}</td>
                    <td>${item.grand_total}</td>
                    <td>${item.paidAmnt}</td>
                    <td>
                        <img src="/storage/${item.pay_pic}" alt="Photo" class="thumbnail" 
                        onclick="showImagePopupHistory('${item.pay_pic}')">
                    </td>        
                    <td>${item.b_date}</td>
                    <td>${item.time_from}</td>
                    <td>${item.time_to}</td>
                    <td>${item.cus_req}</td>
                    <td>${item.Is_Active ? 'No' : 'Yes'}</td>
                    <td>${item.status ? 'No' : 'Yes'}</td>
                    <td>${item.completed ? 'Yes' : 'No'}</td>
                    <td><button onclick="showDetailsOrderHistory('${item.id}', this)">Show</button></td>
                `;
                serialNumber++;
                tableBody.appendChild(row);
            }
        });
    }

    function showDetailsOrderHistory(itemId, button) {
        console.log("Item ID:", itemId);
        const parentRow = button.closest('tr');
        
        let serialNumbers = 1;
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
                                <th style="width: 50px;">S/no.</th>
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
                            <td>${serialNumbers}</td>
                            <td>${detail.item_name}</td>
                            <td>${detail.category}</td>
                            <td>${detail.rate}</td>
                            <td>${detail.quantity}</td>
                            <td>${detail.total}</td>
                        </tr>
                    `;
                    serialNumbers++;
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

    // function to show data by the search of id
    function populateTableOrderById(orderId) {
        console.log('Hello  world');
        const tableBody = document.getElementById('venueTableBodyOrder');
        tableBody.innerHTML = ''; // Clear existing rows
        let serialNumber = 1;
        order.forEach((item, index) => {
            if (item.order_number === orderId) { // Correct reference to customer
           
                const row = document.createElement('tr');
                row.setAttribute('data-item-id', item.id);
                row.innerHTML = `
                    <td>${serialNumber}</td>
                    <td>${item.grand_total}</td>
                    <td>${item.paidAmnt}</td>
                    <td>
                        <img src="/storage/${item.pay_pic}" alt="Photo" class="thumbnail" 
                        onclick="showImagePopupHistory('${item.pay_pic}')">
                    </td>        
                    <td>${item.b_date}</td>
                    <td>${item.time_from}</td>
                    <td>${item.time_to}</td>
                    <td>${item.cus_req}</td>
                    <td>${item.Is_Active ? 'No' : 'Yes'}</td>
                    <td>${item.status ? 'No' : 'Yes'}</td>
                    <td>${item.completed ? 'Yes' : 'No'}</td>
                    <td><button onclick="showDetailsOrderHistory('${item.id}', this)">Show</button></td>
                `;
                
                tableBody.appendChild(row);
                serialNumber++;
            }
        });
    }

    function showImagePopupHistory(src) {
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
