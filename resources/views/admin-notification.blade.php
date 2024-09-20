<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="adminNotification" style="display: none; width: 450px; height: auto; margin-left: 500px;">
    <h2 id="popupTitle" style="background-color: #2aeef7; border-radius: 10px; text-align: center; padding: 10px; margin: 0 auto; width: auto;"></h2>

    <div class="notification-feedback">
        @foreach($report as $aBI)
            <div class="notification-item">
                <label>Your have got feedback from:
                    @foreach($loggedId as $ID)
                        @if($ID->id == $aBI->user_id)
                            {{$ID->user_name}} {{$ID->role}}
                        @endif
                    @endforeach
                </label>
                <div class="feedback-details" style="display: none;">
                    <textarea class="feedback-text" readonly>{{ $aBI->report }}</textarea>
                </div>
                <a href="#" onclick="toggleFeedbackDetails(this)" class="feedback-link">
                    See Details
                </a>
            </div>
        @endforeach
    </div>
    <button onclick="closePopup3('adminNotification')" style="width: 100%;" class="close-btn">Close</button>

</div>

<script>
    function toggleFeedbackDetails(link) {
        var detailsDiv = link.parentElement.querySelector('.feedback-details');
        var textArea = detailsDiv.querySelector('.feedback-text');
        var buttonText = link.textContent;

        if (detailsDiv.style.display === 'none') {
            detailsDiv.style.display = 'block';
            textArea.style.display = 'block'; // Adjust textarea display if necessary
            link.textContent = 'Hide Details';
        } else {
            detailsDiv.style.display = 'none';
            link.textContent = 'See Details';
        }
    }

    function closePopup(popupID) {
        var popupOverlay = document.getElementById('popupOverlay');
        var popupWindow = document.getElementById(popupID);

        popupOverlay.style.display = 'none';
        popupWindow.style.display = 'none';
    }
</script>

<style>
    .notification-item {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 10px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .notification-item label {
        display: block;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .notification-item .feedback-link {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .notification-item .feedback-link:hover {
        background-color: #0056b3;
    }

    .feedback-details {
        margin-top: 10px;
    }

    .feedback-text {
        width: 100%;
        height: 150px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: vertical;
        font-size: 16px;
        font-family: Arial, sans-serif;
        display: none; /* Initially hidden */
    }

    .close-btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #dc3545; /* Red background color */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
    }

    .close-btn:hover {
        background-color: #c82333; /* Darker red on hover */
    }

    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        display: none;
    }

    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1001;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }


</style>
