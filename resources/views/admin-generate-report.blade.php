<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="generateReport" style="display: none;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    <div class="profile-container">   
        <div class="search-container">
            <button type="submit" style="margin-left: 500px;" id="searchButtonOrderEdit" onclick="populateTableReport()">Generate All</button>        
        </div>

        <div class="search-container">
            <label for="forSelection">Please select the type:</label>
                <select id="selectionSpecificReport">
                    <option value="">All</option>
                    <option value="1">Completed</option>
                    <option value="0">In Complete</option>
                </select>

            <label for="generateReportByInterval" style="margin-left: 430px;">Select interval:</label>
            <select id="generateReportByInterval">
                <option value="day">1 Day</option>
                <option value="week">1 Week</option>
                <option value="month">1 Month</option>
                <option value="year">1 Year</option>
            </select>
            <button type="button" onclick="generateReportByInterval()">Search</button>
        </div>

        <div class="search-container">
            <label for="dateSpecific">Custom date: </label>
            <input type="date" id="generateReportByDate">
            <button type="submit" id="searchOrderByDateButton" onclick="generateReportByDate()">Search</button>
       
            <label for="dateFromReport" style="margin-left: 130px;">From:</label>
            <input type="date" id="dateFromReport">
        
            <label for="dateToReport">To:</label>
            <input type="date" id="dateToReport">
        
            <button type="submit" id="searchByRangeButton" onclick="generateReportByRange()">Search</button>
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
                <th>Cancel?</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody id="TableBodyReportGenerator"></tbody>
        <tfoot id="TableFooterReportGenerator"></tfoot>
    </table>
    
    <button onclick="closePopup3('generateReport')" style="width: 100%;" class="close-btn">Close</button>
</div>

<!-- Popup for enlarged image -->
<div id="imagePopup" style="display:none; position:absolute; z-index:1000;">
    <img id="popupImage" src="" alt="Enlarged Image" style="max-width:150px; max-height:150px;">
</div>

<script>

    // generating records using the only user name
  function populateTableReport() {
        const tableBody = document.getElementById('TableBodyReportGenerator');
        const tableFooter = document.getElementById('TableFooterReportGenerator');
        const selectionSpecificReport = document.getElementById('selectionSpecificReport').value;
        tableBody.innerHTML = ''; // Clear existing rows
        tableFooter.innerHTML = ''; // Clear existing footer

        let totalSales = 0;
        let totalAdvancePayment = 0;
        let serialNumber = 1;
        orders.forEach((item, index) => {
            customers.forEach((cn) => {
                if (item.completed == selectionSpecificReport || selectionSpecificReport == '') {
                    if (cn.id === item.cus_id) {
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
                                onclick="showImageReportGenerate('${item.pay_pic}')">
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
                                ${item.Is_Active ? "No" : "Yes"}                  
                            </td>
                            <td>
                                ${item.is_available ? "No" : "Yes"}               
                            </td>
                            <td>
                                ${item.status ? "No" : "Yes"}
                            </td>
                            <td><button onclick="showReportDetails('${item.id}', this)">Show</button></td>
                        `;
                        
                        tableBody.appendChild(row);
                        serialNumber++;
                        totalSales += parseFloat(item.grand_total);
                        totalAdvancePayment += parseFloat(item.paidAmnt);
                    }
               }
            });      
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
    function generateReportByDate() {
        const generateReportByDate = document.getElementById('generateReportByDate').value.trim();
  
        const selectionSpecificReport = document.getElementById('selectionSpecificReport').value;

        const tableBody = document.getElementById('TableBodyReportGenerator');
        const tableFooter = document.getElementById('TableFooterReportGenerator');
        tableBody.innerHTML = ''; // Clear existing rows
        tableFooter.innerHTML = ''; // Clear existing footer

        let totalSales = 0;
        let totalAdvancePayment = 0;
        let serialNumber = 1;

        if (generateReportByDate !== '') {
            orders.forEach((item, index) => {
                const createdAtDate = item.created_at.split('T')[0]; 
                if (createdAtDate == generateReportByDate && (item.completed == selectionSpecificReport ||
                selectionSpecificReport == '')) { // Correct reference to ownerId
                
                    customers.forEach((cn) => {
                        if (cn.id === item.cus_id) {
                            const row = document.createElement('tr');
                            row.setAttribute('data-item-id', item.id);
                            row.innerHTML = `
                                <input type="text" id="orderId_${item.id}" value="${item.id}" hidden disabled>
                                <td>${ serialNumber }</td>
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
                                    onclick="showImageReportGenerate('${item.pay_pic}')">
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
                                    ${item.Is_Active ? "No" : "Yes"}                  
                                </td>
                                <td>
                                    ${item.is_available ? "No" : "Yes"}               
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
    function generateReportByRange() {
        const dateFromReport = document.getElementById('dateFromReport').value.trim();
        const dateToReport = document.getElementById('dateToReport').value.trim();
        const selectionSpecificReport = document.getElementById('selectionSpecificReport').value;

        if (dateFromReport === '' || dateToReport === '') {
            alert('Please select both From and To dates.');
            return;
        }

        const tableBody = document.getElementById('TableBodyReportGenerator');
        const tableFooter = document.getElementById('TableFooterReportGenerator');
        tableBody.innerHTML = ''; // Clear existing rows
        tableFooter.innerHTML = ''; // Clear existing footer

        let totalSales = 0;
        let totalAdvancePayment = 0;
        let serialNumber = 1;

        if (generateReportByDate !== '') {
            orders.forEach((item, index) => {
                const createdAtDate = item.created_at.split('T')[0]; // Extract date part from created_at
                if (createdAtDate >= dateFromReport && createdAtDate <= dateToReport && 
                (item.completed == selectionSpecificReport || selectionSpecificReport == '')) { // Correct reference to ownerId
                
                    customers.forEach((cn) => {
                        if (cn.id === item.cus_id) {
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
                                    onclick="showImageReportGenerate('${item.pay_pic}')">
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
                                    ${item.Is_Active ? "No" : "Yes"}                  
                                </td>
                                <td>
                                    ${item.is_available ? "No" : "Yes"}               
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
    function generateReportByInterval() {
        const interval = document.getElementById('generateReportByInterval').value;
        const selectionSpecificReport = document.getElementById('selectionSpecificReport').value;

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

        const tableBody = document.getElementById('TableBodyReportGenerator');
        const tableFooter = document.getElementById('TableFooterReportGenerator');
        tableBody.innerHTML = ''; // Clear existing rows
        tableFooter.innerHTML = ''; // Clear existing footer

        let totalSales = 0;
        let totalAdvancePayment = 0;
        let serialNumber = 1;

    
        orders.forEach((item, index) => {
            const createdAtDate = item.created_at.split('T')[0]; // Extract date part from created_at
            if (createdAtDate >= fromDateFormatted && createdAtDate <= toDateFormatted && 
            (item.completed == selectionSpecificReport || selectionSpecificReport == '')) { // Correct reference to ownerId
            
                customers.forEach((cn) => {
                    if (cn.id === item.cus_id) {
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
                                onclick="showImageReportGenerate('${item.pay_pic}')">
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
                                ${item.Is_Active ? "No" : "Yes"}                  
                            </td>
                            <td>
                                ${item.is_available ? "No" : "Yes"}               
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
            serialNumber++;
            detailsRow.innerHTML = detailsHtml;
            parentRow.after(detailsRow);
        }
    }

    

    
function showImageReportGenerate(src) {
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
