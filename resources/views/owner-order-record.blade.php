<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="seeOrderHistory" style="display: none; width: 90%;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: auto;"></h2>
    <div class="profile-container">
        <div class="search-container">
            <label for="dateSpecific">Custom date: </label>
            <input type="date" id="searchOrderByDate">
            <button type="submit" id="searchOrderByDateButton" onclick="searchOrderByDate()">Search</button>
        </div>

        <div class="search-container">
            <label for="dateFrom">From:</label>
            <input type="date" id="dateFrom">
        
            <label for="dateTo">To:</label>
            <input type="date" id="dateTo">
        
            <button type="button" id="searchByRangeButton" onclick="searchByDateRange()">Search</button>
        </div>
    </div>

    <div class="profile-container">
        <div class="search-container">
            <label for="searchByInterval">Search by Interval:</label>
            <select id="searchByInterval">
                <option value="day">1 Day</option>
                <option value="week">1 Week</option>
                <option value="month">1 Month</option>
                <option value="year">1 Year</option>
            </select>
            <button type="button" onclick="searchByInterval()">Search</button>
        </div>
    </div>

    <table> 
        <thead>
            <tr>
                <th rowspan="2">S/No.</th>
                <th rowspan="2">Order Number</th>
                <th rowspan="2">Grand Total</th>
                <th rowspan="2">Payed Amount</th>
                <th rowspan="2">Payment Picture</th>
                <th rowspan="2">Booked Date</th>
                <th colspan="2">Time</th>
                <th rowspan="2">Custom Request</th>
                <th colspan="5">Status</th>
            </tr>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Deleted?</th>
                <th>Cancelled?</th>
                <th>Completed?</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody id="venueTableBodyOrderHistory"></tbody>
    </table>

    <button onclick="closePopup3('seeOrderHistory')" style="width: 100%;" class="close-btn">Close</button>    
</div>

<script>
    // Function to search by order date using created_at date
    function searchOrderByDate() {
        const searchOrderByDate = document.getElementById('searchOrderByDate').value.trim();
        console.log('Search Date:', searchOrderByDate); // Debug log

        if (searchOrderByDate !== '') {
            let foundOrder = false;
            const tableBody = document.getElementById('venueTableBodyOrderHistory');
            tableBody.innerHTML = ''; // Clear existing rows

            let serialNumber = 1;

            order.forEach(function(item) {
                const createdAtDate = item.created_at.split('T')[0]; // Extract date part from created_at
                if (createdAtDate === searchOrderByDate) {
                    const row = document.createElement('tr');
                    row.setAttribute('data-item-id', item.id);
                    row.innerHTML = `
                        <td>${serialNumber}</td>
                        <td>${item.order_number}</td>
                        <td>${item.grand_total}</td>
                        <td>${item.paidAmnt}</td>
                        <td>
                            <img src="/storage/${item.pay_pic}" alt="Photo" class="thumbnail" 
                            onclick="showImagePopupRecord('${item.pay_pic}')">
                        </td>        
                        <td>${item.b_date}</td>
                        <td>${item.time_from}</td>
                        <td>${item.time_to}</td>
                        <td>${item.cus_req}</td>
                        <td>${item.Is_Active ? 'No' : 'Yes'}</td>
                        <td>${item.status ? 'No' : 'Yes'}</td>
                        <td>${item.completed ? 'Yes' : 'No'}</td>
                        <td><button onclick="showDetails('${item.id}', this)">Show</button></td>
                    `;
                    
                    tableBody.appendChild(row);
                   
                    serialNumber++;
                    foundOrder = true;
                }
            });

            if (!foundOrder) {
                alert(`No orders found for the date: ${searchOrderByDate}`);
            }
        } else {
            alert('Please select a date to search.');
        }
    }

    // Function to search by date range
    function searchByDateRange() {
        const dateFrom = document.getElementById('dateFrom').value.trim();
        const dateTo = document.getElementById('dateTo').value.trim();

        if (dateFrom === '' || dateTo === '') {
            alert('Please select both From and To dates.');
            return;
        }

        console.log('From Date:', dateFrom);
        console.log('To Date:', dateTo);

        let foundOrder = false;
        const tableBody = document.getElementById('venueTableBodyOrderHistory');
        tableBody.innerHTML = ''; // Clear existing rows
        let serialNumber = 1;

        order.forEach(function(item) {
            const createdAtDate = item.created_at.split('T')[0]; // Extract date part from created_at
            if (createdAtDate >= dateFrom && createdAtDate <= dateTo) {
                const row = document.createElement('tr');
                row.setAttribute('data-item-id', item.id);
                row.innerHTML = `
                    <td>${serialNumber}</td>
                    <td>${item.order_number}</td>
                    <td>${item.grand_total}</td>
                    <td>${item.paidAmnt}</td>
                    <td>
                        <img src="/storage/${item.pay_pic}" alt="Photo" class="thumbnail" 
                        onclick="showImagePopupRecord('${item.pay_pic}')">
                    </td>        
                    <td>${item.b_date}</td>
                    <td>${item.time_from}</td>
                    <td>${item.time_to}</td>
                    <td>${item.cus_req}</td>
                    <td>${item.Is_Active ? 'No' : 'Yes'}</td>
                    <td>${item.status ? 'No' : 'Yes'}</td>
                    <td>${item.completed ? 'Yes' : 'No'}</td>
                    <td><button onclick="showDetails('${item.id}', this)">Show</button></td>
                `;
                
                tableBody.appendChild(row);
                serialNumber++;
                foundOrder = true;
            }
        });

        if (!foundOrder) {
            alert(`No orders found between ${dateFrom} and ${dateTo}`);
        }
    }

    // Function to search by interval (1 day, 1 week, 1 month, 1 year)
    function searchByInterval() {
        const interval = document.getElementById('searchByInterval').value;
        let fromDate = new Date(); // Current date
        let toDate = new Date();

        if (interval === 'day') {
            fromDate.setDate(fromDate.getDate() - 1);
        } else if (interval === 'week') {
            fromDate.setDate(fromDate.getDate() - 7);
        } else if (interval === 'month') {
            fromDate.setMonth(fromDate.getMonth() - 1);
        } else if (interval === 'year') {
            fromDate.setFullYear(fromDate.getFullYear() - 1);
        }

        const fromDateFormatted = fromDate.toISOString().split('T')[0];
        const toDateFormatted = toDate.toISOString().split('T')[0];

        console.log(`Searching orders from ${fromDateFormatted} to ${toDateFormatted}`);

        let foundOrder = false;
        const tableBody = document.getElementById('venueTableBodyOrderHistory');
        tableBody.innerHTML = ''; // Clear existing rows
        let serialNumber = 1;

        order.forEach(function(item) {
            const createdAtDate = item.created_at.split('T')[0]; // Extract date part from created_at
            if (createdAtDate >= fromDateFormatted && createdAtDate <= toDateFormatted) {
                const row = createOrderRow(item, serialNumber);
                tableBody.appendChild(row);
                serialNumber++;
                foundOrder = true;
            }
        });

        if (!foundOrder) {
            alert(`No orders found between ${fromDateFormatted} and ${toDateFormatted}`);
        }
    }

    // Function to create a table row for an order item
    function createOrderRow(item, serialNumber) {
        const row = document.createElement('tr');
        row.setAttribute('data-item-id', item.id);
        row.innerHTML = `
            <td>${serialNumber}</td>
            <td>${item.order_number}</td>
            <td>${item.grand_total}</td>
            <td>${item.paidAmnt}</td>
            <td>
                <img src="/storage/${item.pay_pic}" alt="Photo" class="thumbnail" 
                onclick="showImagePopupRecord('${item.pay_pic}')">
            </td>        
            <td>${item.b_date}</td>
            <td>${item.time_from}</td>
            <td>${item.time_to}</td>
            <td>${item.cus_req}</td>
            <td>${item.Is_Active ? 'No' : 'Yes'}</td>
            <td>${item.status ? 'No' : 'Yes'}</td>
            <td>${item.completed ? 'Yes' : 'No'}</td>
            <td><button onclick="showDetails('${item.id}', this)">Show</button></td>
        `;
        return row;
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
            let serialNumber = 1;
            orderDetails.forEach(detail => {
                if (detail.order_id == itemId) {
                    detailsHtml += `
                        <input type="text" id="orderDetailsId_${detail.id}" value="${detail.order_id}" hidden disabled>
                        <tr>
                            <td>${serialNumber}</td>
                            <td>${detail.item_name}</td>
                            <td>${detail.category}</td>
                            <td>${detail.rate}</td>
                            <td>${detail.quantity}</td>
                            <td>${detail.total}</td>
                        </tr>
                    `;
                    serialNumber++;
                }
            });
            detailsHtml += `
                        </tbody>
                    </table>
                </td>
            `;

            detailsRow.innerHTML = detailsHtml;

            // Insert the details row after the parent row
            parentRow.insertAdjacentElement('afterend', detailsRow);
        }
    }

    function closePopup3(popupId) {
        document.getElementById(popupId).style.display = "none";
    }

    function showImagePopupRecord(imageSrc) {
        const newWindow = window.open('', '_blank');
        newWindow.document.write(`<html><body style="margin: 0; display: flex; justify-content: center; align-items: center;">
                                  <img src="/storage/${imageSrc}" style="max-width: 100%; max-height: 100%;" onclick="window.close();">
                                  </body></html>`);
        newWindow.document.title = 'Payment Image';
    }

    // window.onclick = function(event) {
    //     const imagePopup = document.getElementById('imagePopup');
    //     if (event.target !== imagePopup && event.target !== imagePopup.firstElementChild) {
    //         imagePopup.style.display = 'none';
    //     }
    // }
</script>
