<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="generateReportOwner" style="display: none; width: 90%;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>

    <div class="profile-container">
        <div class="search-container">
            <label for="searchByIntervalReport">Select interval:</label>
            <select id="searchByIntervalReport">
                <option value="day">1 Day</option>
                <option value="week">1 Week</option>
                <option value="month">1 Month</option>
                <option value="year">1 Year</option>
            </select>
            <button type="button" onclick="searchByIntervalReport()">Search</button>
        </div>
        
        <div class="search-container">
            <label for="forSelection">Please select the type:</label>
                <select id="selectionSpecific">
                    <option value="">All</option>
                    <option value="1">Completed</option>
                    <option value="0">In Complete</option>
                </select>
        </div>
    </div>

    <div class="profile-container">
        <div class="search-container">
            <label for="dateSpecific">Custom date: </label>
            <input type="date" id="searchForReport">

            <button type="submit" id="searchForReportButton" onclick="searchForReport()">Search</button>
        </div>

        <div class="search-container">
            <label for="dateFromReport">From:</label>
            <input type="date" id="dateFromReport">
        
            <label for="dateToReport">To:</label>
            <input type="date" id="dateToReport">
        
            <button type="button" id="searchByRangeButton" onclick="searchReportDateRange()">Search</button>
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
        <tbody id="ReportHistoryBody"></tbody>
        <tfoot id="ReportHistoryFooter"></tfoot>
    </table>

    <button onclick="closePopup3('generateReportOwner')" style="width: 100%;" class="close-btn">Close</button>    
</div>

<div id="imagePopup" style="display:none;">
    <img id="popupImage" src="" alt="Payment Image">
</div>

<script>
    // Function to search by order date using created_at date
    function searchForReport() {
        const searchForReport = document.getElementById('searchForReport').value.trim();
        const selectionSpecific = document.getElementById('selectionSpecific').value.trim();

        console.log('Search Date:', searchForReport); // Debug log

        if (searchForReport !== '') {
            let foundOrder = false;
            const tableBody = document.getElementById('ReportHistoryBody');
            const tableFooter = document.getElementById('ReportHistoryFooter');
            tableBody.innerHTML = ''; // Clear existing rows
            tableFooter.innerHTML = ''; // Clear existing footer

            let totalSales = 0;
            let totalAdvancePayment = 0;

            let serialNumber = 1;

            order.forEach(function(item) {
                const createdAtDate = item.created_at.split('T')[0]; // Extract date part from created_at
                if (createdAtDate === searchForReport &&( item.completed == selectionSpecific || 
                    selectionSpecific == '')) {
                    const row = document.createElement('tr');
                    row.setAttribute('data-item-id', item.id);
                    row.innerHTML = `
                        <td>${serialNumber}</td>
                        <td>${item.order_number}</td>
                        <td>${item.grand_total}</td>
                        <td>${item.paidAmnt}</td>
                        <td>
                            <img src="/storage/${item.pay_pic}" alt="Photo" class="thumbnail" 
                            onclick="showImagePopupReport('${item.pay_pic}')">
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
                    totalSales += parseFloat(item.grand_total);
                    totalAdvancePayment += parseFloat(item.paidAmnt);
                    serialNumber++;
                    foundOrder = true;
                }
            });
            const footerRow = document.createElement('tr');
            footerRow.innerHTML = `
                <td colspan="2"><strong>Total Sales</strong></td>
                <td><strong>${totalSales.toFixed(2)}</strong></td>
                <td><strong>${totalAdvancePayment.toFixed(2)}</strong></td>
                <td colspan="9"></td>
            `;
            tableFooter.appendChild(footerRow);

            if (!foundOrder) {
                alert(`No orders found for the date: ${searchForReport}`);
            }
        } else {
            alert('Please select a date to search.');
        }
    }



    // Function to search by date range
    function searchReportDateRange() {
        const dateFromReport = document.getElementById('dateFromReport').value.trim();
        const dateToReport = document.getElementById('dateToReport').value.trim();
        const selectionSpecific = document.getElementById('selectionSpecific').value.trim();


        if (dateFromReport === '' || dateToReport === '') {
            alert('Please select both From and To dates.');
            return;
        }

        console.log('From Date:', dateFromReport);
        console.log('To Date:', dateToReport);

        let foundOrder = false;
        const tableBody = document.getElementById('ReportHistoryBody');
        const tableFooter = document.getElementById('ReportHistoryFooter');
        tableBody.innerHTML = ''; // Clear existing rows
        tableFooter.innerHTML = ''; // Clear existing footer

        let totalSales = 0;
        let totalAdvancePayment = 0;
        let serialNumber = 1;

        order.forEach(function(item) {
            const createdAtDate = item.created_at.split('T')[0]; // Extract date part from created_at
            if (createdAtDate >= dateFromReport && createdAtDate <= dateToReport && 
            (item.completed == selectionSpecific || selectionSpecific == '')) {
                const row = document.createElement('tr');
                row.setAttribute('data-item-id', item.id);
                row.innerHTML = `
                    <td>${serialNumber}</td>
                    <td>${item.order_number}</td>
                    <td>${item.grand_total}</td>
                    <td>${item.paidAmnt}</td>
                    <td>
                        <img src="/storage/${item.pay_pic}" alt="Photo" class="thumbnail" 
                        onclick="showImagePopupReport('${item.pay_pic}')">
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
                totalSales += parseFloat(item.grand_total);
                totalAdvancePayment += parseFloat(item.paidAmnt);
                serialNumber++;
                foundOrder = true;
            }
        });
        const footerRow = document.createElement('tr');
            footerRow.innerHTML = `
                <td colspan="2"><strong>Total Sales</strong></td>
                <td><strong>${totalSales.toFixed(2)}</strong></td>
                <td><strong>${totalAdvancePayment.toFixed(2)}</strong></td>
                <td colspan="9"></td>
            `;
            tableFooter.appendChild(footerRow);

        if (!foundOrder) {
            alert(`No orders found between ${dateFromReport} and ${dateToReport}`);
        }
    }



// Function to search by interval (1 day, 1 week, 1 month, 1 year)
function searchByIntervalReport() {
        const interval = document.getElementById('searchByIntervalReport').value;
        const selectionSpecific = document.getElementById('selectionSpecific').value;
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
        const tableBody = document.getElementById('ReportHistoryBody');
        const tableFooter = document.getElementById('ReportHistoryFooter');
        tableBody.innerHTML = ''; // Clear existing rows
        tableFooter.innerHTML = ''; // Clear existing footer

        let totalSales = 0;
        let totalAdvancePayment = 0;
        let serialNumber = 1;

        order.forEach(function(item) {
            const createdAtDate = item.created_at.split('T')[0]; // Extract date part from created_at
            if (createdAtDate >= fromDateFormatted && createdAtDate <= toDateFormatted && 
           ( item.completed == selectionSpecific || selectionSpecific == '')) {
                const row = createOrderRow(item, serialNumber);
                tableBody.appendChild(row);
                totalSales += parseFloat(item.grand_total);
                totalAdvancePayment += parseFloat(item.paidAmnt);
                serialNumber++;
                foundOrder = true;
            }
        });
        const footerRow = document.createElement('tr');
            footerRow.innerHTML = `
                <td colspan="2"><strong>Total Sales</strong></td>
                <td><strong>${totalSales.toFixed(2)}</strong></td>
                <td><strong>${totalAdvancePayment.toFixed(2)}</strong></td>
                <td colspan="9"></td>
            `;
            tableFooter.appendChild(footerRow);

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
                onclick="showImagePopupReport('${item.pay_pic}')">
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
            let serailNumber = 1;
            orderDetails.forEach(detail => {
                if (detail.order_id == itemId) {
                    detailsHtml += `
                        <input type="text" id="orderDetailsId_${detail.id}" value="${detail.order_id}" hidden disabled>
                        <tr>
                            <td>${serailNumber}</td>
                            <td>${detail.item_name}</td>
                            <td>${detail.category}</td>
                            <td>${detail.rate}</td>
                            <td>${detail.quantity}</td>
                            <td>${detail.total}</td>
                        </tr>
                    `;
                }
            });
            serailNumber++;
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

    function showImagePopupReport(imageSrc) {
        const newWindow = window.open('', '_blank');
        newWindow.document.write(`<html><body style="margin: 0; display: flex; justify-content: center; align-items: center;">
                                  <img src="/storage/${imageSrc}" style="max-width: 100%; max-height: 100%;" onclick="window.close();">
                                  </body></html>`);
        newWindow.document.title = 'Payment Image';
    }

    
</script>
