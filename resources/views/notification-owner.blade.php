<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="notificationCustomer" style="display: none; width: 450px; height: 500px; margin-left: 500px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;" ></h2>

    <div class="notification-feedback">
        @foreach($feedback as $aBI)
                <div class="notification-item">
                    <label>Your have got feedback from:                
                        {{ $aBI->order_number }} order number.                   
                    </label>
                    <a href="#" onclick="openPopupFeedBack('feedBackCustomer', 'Feedback', '{{ $aBI->feedback }}'); closePopup3('notificationCustomer')" class="feedback-link">
                        See Details
                    </a>                    
                </div>
        
        @endforeach
    </div>

<button onclick="closePopup3('notificationCustomer')" style="width: 100%;" class="close-btn">Close</button>
</div>


<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="feedBackCustomer" style="display: none; width: 450px; height: auto; margin-left: 500px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;" ></h2>

    <div class="feedback-form">
        <textarea name="feedback" id="feedback" class="feedback-form" readonly></textarea>
    </div>

    <button onclick="closePopupFeedBack('feedBackCustomer'); 
    openPopup3('notificationCustomer', 'Notification')" style="width: 100%;" class="close-btn">Close</button>
</div>





<script>
   
     
    function openPopupFeedBack(popupID, title, feedback) {
        var popupOverlay = document.getElementById('popupOverlay');
        var popupWindow = document.getElementById(popupID);
        var popupTitle = popupWindow.querySelector('h2');
        var feedbackTextarea = popupWindow.querySelector('textarea');

        popupTitle.textContent = title;
        feedbackTextarea.value = feedback; // Set the value of the textarea to the feedback

        popupTitle.textContent = title;

        popupOverlay.style.display = 'block';
        popupWindow.style.display = 'block';
    }


    function closePopupFeedBack(popupID) {
        var popupOverlay = document.getElementById('popupOverlay');
        var popupWindow = document.getElementById(popupID);

        popupOverlay.style.display = 'none';
        popupWindow.style.display = 'none';

    }
</script>


<style>
   .feedback-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .feedback-form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .feedback-form textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            resize: vertical;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        .feedback-form button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .feedback-form button:hover {
            background-color: #0056b3;
        }
  

        .notification-feedback {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.notification-feedback .notification-item {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 10px;
    background-color: #f9f9f9;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.notification-feedback label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.notification-feedback .feedback-link {
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

.notification-feedback .feedback-link:hover {
    background-color: #0056b3;
}

</style>