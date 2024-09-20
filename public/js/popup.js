// document.addEventListener('DOMContentLoaded', function() {
//     const showClientsLink = document.getElementById('showClients');
//     const popupWrapper = document.getElementById('popupWrapper');
//     const closePopupButton = document.getElementById('closePopup');
//     const popup = popupWrapper.querySelector('.popup');

//     let openDetailsCount = 0;

   
//     // Event listener for "show clients" link
//     showClientsLink.addEventListener('click', function(event) {
//         event.preventDefault();
//         // Show the popup window
//         popupWrapper.style.display = 'block';
//         // Populate the table with client data
//         populateClientsTable();
//     });

//     // Event listener for close popup button
//     closePopupButton.addEventListener('click', function() {
//         // Hide the popup window
//         popupWrapper.style.display = 'none';
//         popup.style.width = '40%';  // Reset the width when the popup is closed
//     });

//     // Function to populate the clients table
//     function populateClientsTable() {
//         const tbody = document.querySelector('#clientsTable tbody');

//         // Clear previous table rows
//         tbody.innerHTML = '';

//         // Populate table with client data from owners
//         owners.forEach(function(client) {
//             const row = document.createElement('tr');
//             row.innerHTML = `
//                 <td>${client.id}</td>
//                 <td>${client.user_name}</td>
//                 <td>${client.role}</td>
//                 <td>
//                     <a href="#" class="view-client" data-id="${client.id}"
//                     style="color: white; background-color: #FFA500; padding: 5px 10px;
//                     text-decoration: none; border-radius: 5px;"
//                     onmouseover="this.style.backgroundColor='#FF8C00';"
//                     onmouseout="this.style.backgroundColor='#FFA500';"
//                     >View</a>
//                 </td>
//                 <td class="is-active">${client.Is_Active ? 'Yes' : 'No'}</td>
//                 <td><button class="toggle-active" data-id="${client.id}" data-active="${client.Is_Active}">Switch</button></td>
//         </tr>
//             `;
//             tbody.appendChild(row);
//         });


//         // Add event listeners to the "View" links
//         document.querySelectorAll('.view-client').forEach(function(link) {
//             link.addEventListener('click', function(event) {
//                 event.preventDefault();
//                 const clientId = this.getAttribute('data-id');

//                 // Check if the details row already exists, if so, remove it
//                 const detailsRow = document.querySelector(`#clientDetails-${clientId}`);
//                 if (detailsRow) {
//                     detailsRow.remove();
//                     openDetailsCount--;

//                     if (openDetailsCount === 0) {
//                         popup.style.width = '40%'; // Reset width when all details are closed
//                     }
//                 } else {
//                     // Create new row for client details
//                     const detailsRow = document.createElement('tr');
//                     detailsRow.id = `clientDetails-${clientId}`;

//                     // Initialize a variable to hold the HTML for details rows
//                     let detailsHtml = '';

//                     // Loop through ownerDetails[clientId] and generate table rows
//                     ownerDetails[clientId].forEach(function(details) {
//                         const imageUrl = `/storage/${details.Logo}`;
//                         const panUrl = `/storage/${details.Pan_no_photo}`;
//                         const regUrl = `/storage/${details.Reg_no_photo}`;

//                         // Extract just the date part of created_at
//                         const createdAt = new Date(details.created_at);
//                         const formattedDate = createdAt.toISOString().split('T')[0];
                        
//                         detailsHtml += `
//                             <tr>
//                                 <td>${details.Catering_Name}</td>
//                                 <td><img src="${imageUrl}" style="max-width: 100px; max-height: 100px;" alt="Logo"></td>
//                                 <td>${details.Location}</td>
//                                 <td>${details.Provience	}</td>
//                                 <td>${details.District}</td>
//                                 <td>${details.L_Muncipality}</td>
//                                 <td>${details.Ward}</td>
//                                 <td>${details.Pan_no}</td>
//                                 <td><img src="${panUrl}" style="max-width: 100px; max-height: 100px;" alt="Pan no"></td>
//                                 <td>${details.Reg_no}</td>
//                                 <td><img src="${regUrl}" style="max-width: 100px; max-height: 100px;" alt="Reg no"></td>
//                                 <td>${details.Mobile}</td>
//                                 <td>${details.Email}</td>
//                                 <td>${details.Remark}</td>
//                                 <td>${formattedDate}</td>
//                             </tr>
//                         `;
//                     });


//                     detailsRow.innerHTML = `
//                         <td colspan="14">
//                             <div class="hidden-table" style="display: block;">
//                                 <table class="inner-table">
//                                     <thead>
//                                         <tr>
//                                             <th>Catering Name</th>
//                                             <th>Logo</th>
//                                             <th>Location</th>
//                                             <th>Provience</th>
//                                             <th>District</th>
//                                             <th>Muncipality</th>
//                                             <th>Ward No:</th>
//                                             <th>Pan No.</th>
//                                             <th>Pan No. Photo</th>
//                                             <th>Reg No.</th>
//                                             <th>Reg No. Photo</th>
//                                             <th>Mobile No.</th>
//                                             <th>E-mail</th>
//                                             <th>Remark</th>
//                                             <th>Created At</th>
//                                         </tr>
//                                     </thead>
//                                     <tbody>
//                                          ${detailsHtml}
//                                     </tbody>
//                                 </table>
//                             </div>
//                         </td>
//                     `;

//                     // Insert details row after the current row
//                     const currentRow = this.closest('tr');
//                     currentRow.parentNode.insertBefore(detailsRow, currentRow.nextSibling);

//                     openDetailsCount++;

//                     // Adjust popup width only when opening details
//                     if (openDetailsCount === 1) {
//                         popup.style.width = '90%';
//                     }


//                     // Add event listeners to the images to open them in a new window
//                     detailsRow.querySelectorAll('img').forEach(function(img) {
//                         img.addEventListener('click', function() {
//                             const newWindow = window.open('', '_blank');
//                             newWindow.document.write(`
//                                 <html>
//                                     <head>
//                                         <title>Image Preview</title>
//                                     </head>
//                                     <body style="margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #000;">
//                                         <img src="${this.src}" style="max-width: 100%; max-height: 100%;">
//                                     </body>
//                                 </html>
//                             `);
//                         });
//                     });
//                 }
//             });
//         });


//         // Add event listeners to the toggle buttons
//         document.querySelectorAll('.toggle-active').forEach(function(button) {
//             button.addEventListener('click', function() {
//                 const clientId = this.getAttribute('data-id');
//                 const currentStatus = this.getAttribute('data-active') === '1';
//                 const newStatus = !currentStatus;

//                 // Make AJAX request to update the status
//                 fetch(`/toggle-active/${clientId}`, {
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/json',
//                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                     },
//                     body: JSON.stringify({ Is_Active: newStatus })
//                 })
//                 .then(response => response.json())
//                 .then(data => {
//                     if (data.success) {
//                         // Update the status in the UI
//                         this.setAttribute('data-active', newStatus ? '1' : '0');
//                         this.parentElement.previousElementSibling.textContent = newStatus ? 'Yes' : 'No';
//                     } else {
//                         alert('Failed to update status.');
//                     }
//                 });
//             });
//         });
//     }
// });
document.addEventListener('DOMContentLoaded', function() {
    const showClientsLink = document.getElementById('showClients');
    const popupWrapper = document.getElementById('popupWrapper');
    const closePopupButton = document.getElementById('closePopup');
    const popup = popupWrapper.querySelector('.popup');
    const searchInput = document.getElementById('searchInput');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const pageInfo = document.getElementById('pageInfo');

    let openDetailsCount = 0;
    let currentPage = 1;
    const itemsPerPage = 50;
    let filteredOwners = [];

    // Event listener for "show clients" link
    showClientsLink.addEventListener('click', function(event) {
        event.preventDefault();
        // Show the popup window
        popupWrapper.style.display = 'block';
        // Populate the table with client data
        populateClientsTable();
    });

    // Event listener for close popup button
    closePopupButton.addEventListener('click', function() {
        // Hide the popup window
        popupWrapper.style.display = 'none';
        popup.style.width = '40%';  // Reset the width when the popup is closed
    });

    // Event listener for search input
    searchInput.addEventListener('input', function() {
        currentPage = 1; // Reset to first page when searching
        filterOwners();
    });

    // Event listener for pagination buttons
    prevButton.addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            populateClientsTable();
        }
    });

    nextButton.addEventListener('click', function() {
        const totalPages = Math.ceil(filteredOwners.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            populateClientsTable();
        }
    });

    // Function to filter owners based on search input
    function filterOwners() {
        const searchTerm = searchInput.value.toLowerCase();
        filteredOwners = owners.filter(client => client.user_name.toLowerCase().includes(searchTerm));
        populateClientsTable();
    }

    // Function to populate the clients table
    function populateClientsTable() {
        const tbody = document.querySelector('#clientsTable tbody');
        const totalPages = Math.ceil(filteredOwners.length / itemsPerPage);

        // Clear previous table rows
        tbody.innerHTML = '';

        // Calculate the start and end index for the current page
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        // Get the data for the current page
        const pageData = filteredOwners.slice(startIndex, endIndex);

        // Populate table with client data from pageData
        pageData.forEach(function(client) {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${client.id}</td>
                <td>${client.user_name}</td>
                <td>${client.role}</td>
                <td>
                    <a href="#" class="view-client" data-id="${client.id}"
                    style="color: white; background-color: #FFA500; padding: 5px 10px;
                    text-decoration: none; border-radius: 5px;"
                    onmouseover="this.style.backgroundColor='#FF8C00';"
                    onmouseout="this.style.backgroundColor='#FFA500';"
                    >View</a>
                </td>
                <td class="is-active">${client.Is_Active ? 'Yes' : 'No'}</td>
                <td><button class="toggle-active" data-id="${client.id}" data-active="${client.Is_Active}">Switch</button></td>
            `;
            tbody.appendChild(row);
        });

        // Update page info
        pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;

        // Add event listeners to the "View" links
        document.querySelectorAll('.view-client').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const clientId = this.getAttribute('data-id');

                // Check if the details row already exists, if so, remove it
                const detailsRow = document.querySelector(`#clientDetails-${clientId}`);
                if (detailsRow) {
                    detailsRow.remove();
                    openDetailsCount--;

                    if (openDetailsCount === 0) {
                        popup.style.width = '40%'; // Reset width when all details are closed
                    }
                } else {
                    // Create new row for client details
                    const detailsRow = document.createElement('tr');
                    detailsRow.id = `clientDetails-${clientId}`;

                    // Initialize a variable to hold the HTML for details rows
                    let detailsHtml = '';

                    // Loop through ownerDetails[clientId] and generate table rows
                    ownerDetails[clientId].forEach(function(details) {
                        const imageUrl = `/storage/${details.Logo}`;
                        const panUrl = `/storage/${details.Pan_no_photo}`;
                        const regUrl = `/storage/${details.Reg_no_photo}`;

                        // Extract just the date part of created_at
                        const createdAt = new Date(details.created_at);
                        const formattedDate = createdAt.toISOString().split('T')[0];
                        
                        detailsHtml += `
                            <tr>
                                <td>${details.Catering_Name}</td>
                                <td><img src="${imageUrl}" style="max-width: 100px; max-height: 100px;" alt="Logo"></td>
                                <td>${details.Location}</td>
                                <td>${details.Provience}</td>
                                <td>${details.District}</td>
                                <td>${details.L_Muncipality}</td>
                                <td>${details.Ward}</td>
                                <td>${details.Pan_no}</td>
                                <td><img src="${panUrl}" style="max-width: 100px; max-height: 100px;" alt="Pan no"></td>
                                <td>${details.Reg_no}</td>
                                <td><img src="${regUrl}" style="max-width: 100px; max-height: 100px;" alt="Reg no"></td>
                                <td>${details.Mobile}</td>
                                <td>${details.Email}</td>
                                <td>${details.Remark}</td>
                                <td>${formattedDate}</td>
                            </tr>
                        `;
                    });

                    detailsRow.innerHTML = `
                        <td colspan="14">
                            <div class="hidden-table" style="display: block;">
                                <table class="inner-table">
                                    <thead>
                                        <tr>
                                            <th>Catering Name</th>
                                            <th>Logo</th>
                                            <th>Location</th>
                                            <th>Provience</th>
                                            <th>District</th>
                                            <th>Muncipality</th>
                                            <th>Ward No:</th>
                                            <th>Pan No.</th>
                                            <th>Pan No. Photo</th>
                                            <th>Reg No.</th>
                                            <th>Reg No. Photo</th>
                                            <th>Mobile No.</th>
                                            <th>E-mail</th>
                                            <th>Remark</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         ${detailsHtml}
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    `;

                    // Insert details row after the current row
                    const currentRow = this.closest('tr');
                    currentRow.parentNode.insertBefore(detailsRow, currentRow.nextSibling);

                    openDetailsCount++;

                    // Adjust popup width only when opening details
                    if (openDetailsCount === 1) {
                        popup.style.width = '90%';
                    }

                    // Add event listeners to the images to open them in a new window
                    detailsRow.querySelectorAll('img').forEach(function(img) {
                        img.addEventListener('click', function() {
                            const newWindow = window.open('', '_blank');
                            newWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Image Preview</title>
                                    </head>
                                    <body style="margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #000;">
                                        <img src="${this.src}" style="max-width: 100%; max-height: 100%;">
                                    </body>
                                </html>
                            `);
                        });
                    });
                }
            });
        });

        // Add event listeners to the toggle buttons
        document.querySelectorAll('.toggle-active').forEach(function(button) {
            button.addEventListener('click', function() {
                const clientId = this.getAttribute('data-id');
                const currentStatus = this.getAttribute('data-active') === '1';
                const newStatus = !currentStatus;

                // Make AJAX request to update the status
                fetch(`/toggle-active/${clientId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ Is_Active: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the status in the UI
                        this.setAttribute('data-active', newStatus ? '1' : '0');
                        this.parentElement.previousElementSibling.textContent = newStatus ? 'Yes' : 'No';
                    } else {
                        alert('Failed to update status.');
                    }
                });
            });
        });
    }

    // Initial filter and populate
    filteredOwners = owners;
    populateClientsTable();
});
