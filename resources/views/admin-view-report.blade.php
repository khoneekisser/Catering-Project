<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="adminViewReport" style="display: none;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    <div class="profile-container-report">
        <div class="profile-header">
            <h2>Search here....</h2>
        </div>
                
        <div class="search-container">
            <input type="text" name="search" id="searchInputReport" placeholder="Search user by name">
            <button type="submit" id="searchButtonOrderEdit" onclick="searchUserReport()">Search</button> 
            
            
        </div>
        <input type="text" id="ownerIdData" hidden disabled>

        <div class="search-container">
            <label for="dateSpecific">Custom date: </label>
            <input type="date" id="searchOrderByDate">
            <button type="submit" id="searchOrderByDateButton" onclick="searchOrderByDate()">Search</button>

            <label for="searchByIntervalReport" style="margin-left: 350px;">Select interval:</label>
            <select id="searchByIntervalReport"  >
                <option value="day">1 Day</option>
                <option value="week">1 Week</option>
                <option value="month">1 Month</option>
                <option value="year">1 Year</option>
            </select>
            <button type="button" onclick="searchByIntervalReport()">Search</button>
        </div>

        <div class="search-container">
            <label for="dateFrom">From:</label>
            <input type="date" id="dateFrom">
        
            <label for="dateTo">To:</label>
            <input type="date" id="dateTo">
        
            <button type="submit" id="searchByRangeButton" onclick="searchByDateRange()">Search</button>

            <label for="forSelection" style="margin-left: 205px;">Please select the type:</label>
                <select id="selectionSpecific">
                    <option value="">All</option>
                    <option value="1">Completed</option>
                    <option value="0">In Complete</option>
                </select>
        </div>
    </div>

    <input type="hidden" id="idContainOrderShow" name="b_id">
    <div class="form-group">
        <label for="cateringName">Catering Name:</label>
        <input type="text" id="cateringNameReportShow" disabled>
    </div>

    <table> 
        <thead>
            <tr>
                <th rowspan="2">S/No.</th>
                <th rowspan="2">Customer Name</th>
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
        <tbody id="venueTableBodyReport"></tbody>
        <tfoot id="venueTableFooterReport"></tfoot>
    </table>
    
    <button onclick="closePopup3('adminViewReport')" style="width: 100%;"  class="close-btn">Close</button>
</div>

<!-- Popup for enlarged image -->
<div id="imagePopup" style="display:none; position:absolute; z-index:1000;">
    <img id="popupImage" src="" alt="Enlarged Image" style="max-width:150px; max-height:150px;">
</div>

<script>
  function confirmDelete(url) {
      if (confirm("Are you sure you want to delete this item?")) {
          window.location.href = url;
      }
  }

  function searchUserReport() {
        const searchInputReport = document.getElementById('searchInputReport').value.trim();
        const idContainOrderShow = document.getElementById('idContainOrderShow');
        const cateringNameReportShow = document.getElementById('cateringNameReportShow');
        var ownerIdData = document.getElementById('ownerIdData');
        console.log('Search Input:', searchInputReport); // Debug log

        if (searchInputReport !== '') {
            let foundClient = false;

            owners.forEach(function(client) {
                if (client.user_name === searchInputReport) {
                    console.log('Found Client:', client); // Debug log
                    var clientId = client.id;

                    ownerDetails[clientId].forEach(function(details) {
                        cateringNameReportShow.value = details.Catering_Name;
                        var ownerId = details.o_id;
                        ownerIdData.value = ownerId;
                        populateTableReportAdmin(ownerId);
                        console.log('Client Details:', details); // Debug log
                    });

                    alert(`Client with username ${searchInputReport} found.`);
                    foundClient = true;
                }
            });

            if (!foundClient) {
                alert(`No client with username ${searchInputReport} found.`);
            }
        } else {
            alert('Please enter a name to search.');
        }
    }

    // generating records using the only user name
  function populateTableReportAdmin(ownerId) {
        const tableBody = document.getElementById('venueTableBodyReport');
        const tableFooter = document.getElementById('venueTableFooterReport');
        const selectionSpecific = document.getElementById('selectionSpecific').value;
        tableBody.innerHTML = ''; // Clear existing rows
        tableFooter.innerHTML = ''; // Clear existing footer

        let totalSales = 0;
        let totalAdvancePayment = 0;

        orders.forEach((item, index) => {
            if (item.o_id === ownerId && (item.completed == selectionSpecific || selectionSpecific == '')) { // Correct reference to ownerId
               
                customers.forEach((cn) => {
                    if (cn.id === item.cus_id) {
                        const row = document.createElement('tr');
                        row.setAttribute('data-item-id', item.id);
                        row.innerHTML = `
                            <input type="text" id="orderId_${item.id}" value="${item.id}" hidden disabled>
                            <td>${index + 1}</td>
                            <td style="width: 200px;">
                                ${cn.user_name}
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
                                ${item.Is_Active ? "Yes" : "No"}                  
                            </td>
                            <td>
                                ${item.is_available ? "Yes" : "No"}               
                            </td>
                            <td>
                                ${item.status ? "No" : "Yes"}
                            </td>
                            <td><button onclick="showReportDetails('${item.id}', this)">Show</button></td>
                        `;
                        
                        tableBody.appendChild(row);

                        totalSales += parseFloat(item.grand_total);
                        totalAdvancePayment += parseFloat(item.paidAmnt);
                    }
                });
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

    // generating records using custome date
    function searchOrderByDate() {
        var ownerIdDatareceived = document.getElementById('ownerIdData').value;
        const searchOrderByDate = document.getElementById('searchOrderByDate').value.trim();
        console.log('new id',ownerIdDatareceived);
        const selectionSpecific = document.getElementById('selectionSpecific').value;

        const searchInputReport = document.getElementById('searchInputReport').value.trim();
        const tableBody = document.getElementById('venueTableBodyReport');
        const tableFooter = document.getElementById('venueTableFooterReport');
        tableBody.innerHTML = ''; // Clear existing rows
        tableFooter.innerHTML = ''; // Clear existing footer

        let totalSales = 0;
        let totalAdvancePayment = 0;
        let serialNumber = 1;

        if (searchOrderByDate !== '' && searchInputReport !== '') {
            orders.forEach((item, index) => {
                const createdAtDate = item.created_at.split('T')[0]; 
                if (item.o_id == ownerIdDatareceived && createdAtDate == searchOrderByDate
                && (item.completed == selectionSpecific || selectionSpecific == '') ) { // Correct reference to ownerId
                
                    customers.forEach((cn) => {
                        if (cn.id === item.cus_id) {
                            const row = document.createElement('tr');
                            row.setAttribute('data-item-id', item.id);
                            row.innerHTML = `
                                <input type="text" id="orderId_${item.id}" value="${item.id}" hidden disabled>
                                <td>${ serialNumber }</td>
                                <td style="width: 200px;">
                                    ${cn.user_name}
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
                                    ${item.Is_Active ? "Yes" : "No"}                  
                                </td>
                                <td>
                                    ${item.is_available ? "Yes" : "No"}               
                                </td>
                                <td>
                                    ${item.status ? "No" : "Yes"}
                                </td>
                                <td><button onclick="showReportDetails('${item.id}', this)">Show</button></td>
                            `;
                            
                            tableBody.appendChild(row);

                            totalSales += parseFloat(item.grand_total);
                            totalAdvancePayment += parseFloat(item.paidAmnt);
                            serialNumber++;
                        }
                    });
                }
            });
        } else {
            alert('Please select a date and user name to search.');
        }

        const footerRow = document.createElement('tr');
        footerRow.innerHTML = `
            <td colspan="2"><strong>Total</strong></td>
            <td><strong>${totalSales.toFixed(2)}</strong></td>
            <td><strong>${totalAdvancePayment.toFixed(2)}</strong></td>
            <td colspan="9"></td>
        `;
        tableFooter.appendChild(footerRow);
    }



    // generating records using custome date
    function searchByDateRange() {
        var ownerIdDatareceived = document.getElementById('ownerIdData').value;
        const dateFrom = document.getElementById('dateFrom').value.trim();
        const dateTo = document.getElementById('dateTo').value.trim();
        const selectionSpecific = document.getElementById('selectionSpecific').value;

        if (dateFrom === '' || dateTo === '') {
            alert('Please select both From and To dates.');
            return;
        }

        const searchInputReport = document.getElementById('searchInputReport').value.trim();
        const tableBody = document.getElementById('venueTableBodyReport');
        const tableFooter = document.getElementById('venueTableFooterReport');
        tableBody.innerHTML = ''; // Clear existing rows
        tableFooter.innerHTML = ''; // Clear existing footer

        let totalSales = 0;
        let totalAdvancePayment = 0;
        let serialNumber = 1;

        if (searchOrderByDate !== '' && searchInputReport !== '') {
            orders.forEach((item, index) => {
                const createdAtDate = item.created_at.split('T')[0]; // Extract date part from created_at
                if (item.o_id == ownerIdDatareceived && createdAtDate >= dateFrom &&
                 createdAtDate <= dateTo && (item.completed == selectionSpecific || selectionSpecific == '')) { // Correct reference to ownerId
                
                    customers.forEach((cn) => {
                        if (cn.id === item.cus_id) {
                            const row = document.createElement('tr');
                            row.setAttribute('data-item-id', item.id);
                            row.innerHTML = `
                                <input type="text" id="orderId_${item.id}" value="${item.id}" hidden disabled>
                                <td>${serialNumber}</td>
                                <td style="width: 200px;">
                                    ${cn.user_name}
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
                                    ${item.Is_Active ? "Yes" : "No"}                  
                                </td>
                                <td>
                                    ${item.is_available ? "Yes" : "No"}               
                                </td>
                                <td>
                                    ${item.status ? "No" : "Yes"}
                                </td>
                                <td><button onclick="showReportDetails('${item.id}', this)">Show</button></td>
                            `;
                            
                            tableBody.appendChild(row);

                            totalSales += parseFloat(item.grand_total);
                            totalAdvancePayment += parseFloat(item.paidAmnt);
                            serialNumber++;
                        }
                    });
                }
            });
        } else {
            alert('Please select a date and user name to search.');
        }

        const footerRow = document.createElement('tr');
        footerRow.innerHTML = `
            <td colspan="2"><strong>Total</strong></td>
            <td><strong>${totalSales.toFixed(2)}</strong></td>
            <td><strong>${totalAdvancePayment.toFixed(2)}</strong></td>
            <td colspan="9"></td>
        `;
        tableFooter.appendChild(footerRow);
    }



    // generating records using date selection from select box
    function searchByIntervalReport() {
        var ownerIdDatareceived = document.getElementById('ownerIdData').value;
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

        const searchInputReport = document.getElementById('searchInputReport').value.trim();
        const tableBody = document.getElementById('venueTableBodyReport');
        const tableFooter = document.getElementById('venueTableFooterReport');
        tableBody.innerHTML = ''; // Clear existing rows
        tableFooter.innerHTML = ''; // Clear existing footer

        let totalSales = 0;
        let totalAdvancePayment = 0;
        let serialNumber = 1;

        if (searchInputReport !== '') {
            orders.forEach((item, index) => {
                const createdAtDate = item.created_at.split('T')[0]; // Extract date part from created_at
                if (item.o_id == ownerIdDatareceived && createdAtDate >= fromDateFormatted &&
                 createdAtDate <= toDateFormatted && (item.completed == selectionSpecific || selectionSpecific == '')) { // Correct reference to ownerId
                
                    customers.forEach((cn) => {
                        if (cn.id === item.cus_id) {
                            const row = document.createElement('tr');
                            row.setAttribute('data-item-id', item.id);
                            row.innerHTML = `
                                <input type="text" id="orderId_${item.id}" value="${item.id}" hidden disabled>
                                <td>${serialNumber}</td>
                                <td style="width: 200px;">
                                    ${cn.user_name}
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
                                    ${item.Is_Active ? "Yes" : "No"}                  
                                </td>
                                <td>
                                    ${item.is_available ? "Yes" : "No"}               
                                </td>
                                <td>
                                    ${item.status ? "No" : "Yes"}
                                </td>
                                <td><button onclick="showReportDetails('${item.id}', this)">Show</button></td>
                            `;
                            
                            tableBody.appendChild(row);

                            totalSales += parseFloat(item.grand_total);
                            totalAdvancePayment += parseFloat(item.paidAmnt);
                            serialNumber++;
                        }
                    });
                }
            });
        } else {
            alert('Please select a date and user name to search.');
        }

        const footerRow = document.createElement('tr');
        footerRow.innerHTML = `
            <td colspan="2"><strong>Total</strong></td>
            <td><strong>${totalSales.toFixed(2)}</strong></td>
            <td><strong>${totalAdvancePayment.toFixed(2)}</strong></td>
            <td colspan="9"></td>
        `;
        tableFooter.appendChild(footerRow);
    }



    function showReportDetails(itemId, button) {
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


<style>
    /* Container for all search elements */
    .profile-container-report {
        max-width: 100%;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Header styling */
    .profile-header {
        text-align: center;
        margin-bottom: 20px;
    }

    /* Style for each search container */
    .search-container {
        margin-bottom: 15px;
    }

    /* Input and button within a search container */
    .search-container input[type="text"],
    .search-container input[type="date"],
    .search-container select {
        padding: 10px;
        width: 200px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    .search-container button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 14px;
    }

    .search-container button:hover {
        background-color: #0056b3;
    }

    /* Label styling */
    .search-container label {
        margin-right: 10px;
        font-weight: bold;
        font-size: 14px;
    }

    /* Additional styling for select boxes */
    .search-container select {
        width: 150px;
    }

    /* Hidden input styling */
    input[hidden][disabled] {
        display: none;
    }
</style>
