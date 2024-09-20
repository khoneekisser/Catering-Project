function openPopup3(popupID, title) {
    var popupOverlay = document.getElementById('popupOverlay');
    var popupWindow = document.getElementById(popupID);
    var popupTitle = popupWindow.querySelector('h2');

    popupTitle.textContent = title;
    popupOverlay.style.display = 'block';
    popupWindow.style.display = 'block';

     // Disable background interaction
     document.body.style.pointerEvents = 'none';
     popupOverlay.style.pointerEvents = 'auto'; // Allow interaction with the overlay
     popupWindow.style.pointerEvents = 'auto'; // Allow interaction with the popup
}

function closePopup3(popupID) {
    var popupOverlay = document.getElementById('popupOverlay');
    var popupWindow = document.getElementById(popupID);

    popupOverlay.style.display = 'none';
    popupWindow.style.display = 'none';

     // Re-enable background interaction
     document.body.style.pointerEvents = 'auto';
}
