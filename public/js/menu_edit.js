
    function openPopupEdit(title, id, item_name, category, price, description) {
        // Populate the form fields in the popup with the provided data
        closePopup3('show_menu');

        document.getElementById('menu-id').value = id;
        document.getElementById('edit_item_name').value = item_name;
        document.getElementById('edit_category').value = category;
        document.getElementById('edit_price').value = price;
        document.getElementById('edit_description').value = description;


        var popupOverlay = document.getElementById('popupOverlay');
        var popupWindow = document.getElementById('edit_menu');
        var popupTitle = document.getElementById('popupTitle3');

        popupTitle.textContent = title;
        popupOverlay.style.display = 'block';
        popupWindow.style.display = 'block';    
    }

    function closePopupEdit() {
        var popupOverlay = document.getElementById('popupOverlay');
        var popupWindow = document.getElementById('edit_menu');

        popupOverlay.style.display = 'none';
        popupWindow.style.display = 'none';

        openPopup3('show_menu', 'Menu');
}
