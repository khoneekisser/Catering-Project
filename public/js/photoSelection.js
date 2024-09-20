//for logo
function updateFileNames(input) {
    const fileNamesContainer = document.getElementById('fileNamesContainer');
    fileNamesContainer.innerHTML = ''; // Clear previous file names

    const files = input.files;
    for (let i = 0; i < files.length; i++) {
        const fileName = files[i].name;
        const fileNameSpan = document.createElement('span');
        fileNameSpan.textContent = fileName;
        fileNamesContainer.appendChild(fileNameSpan); // Append the span element to the container
    }
}

//for pan no
function updatePanNoFileNames(input) {
    const fileNamesContainer = document.getElementById('PanNoFileNamesContainer');
    fileNamesContainer.innerHTML = ''; // Clear previous file names

    const files = input.files;
    for (let i = 0; i < files.length; i++) {
        const fileName = files[i].name;
        const fileNameSpan = document.createElement('span');
        fileNameSpan.textContent = fileName;
        fileNamesContainer.appendChild(fileNameSpan); // Append the span element to the container
    }
}

//for reg no
function updateRegNoFileNames(input) {
    const fileNamesContainer = document.getElementById('RegNoFileNamesContainer');
    fileNamesContainer.innerHTML = ''; // Clear previous file names

    const files = input.files;
    for (let i = 0; i < files.length; i++) {
        const fileName = files[i].name;
        const fileNameSpan = document.createElement('span');
        fileNameSpan.textContent = fileName;
        fileNamesContainer.appendChild(fileNameSpan); // Append the span element to the container
    }
}