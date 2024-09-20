<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="notificationCustomer" style="display: none; width: 450px; min-height:100px; max-height: 500px; margin-left: 500px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;" ></h2>

    <div class="notification-feedback">
        @foreach($activeBookingInfo as $aBI)
            @if($aBI->completed == 1)
                <div class="notification-item">
                    <label>Your order has been completed of:
                        @foreach($caterings as $catering)
                            @if($catering->o_id === $aBI->o_id)
                                {{ $catering->Catering_Name }}
                            @endif
                        @endforeach
                    </label>
                    <label for="order_number">Order No:
                        {{ $aBI->order_number }}
                    </label>
                    <a href="#" style="width: 100%;" onclick="openPopupFeedBack('feedBackCustomer',
                     'Feedback', {{$aBI->o_id}}, {{ $aBI->order_number }}); 
                     closePopup3('notificationCustomer')" class="feedback-link">
                        Give Feedback
                    </a>
                </div>
            @endif
        @endforeach
    </div>

<button onclick="closePopup3('notificationCustomer')" style="width: 100%;" class="close-btn">Close</button>
</div>


<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="feedBackCustomer" style="display: none; width: 450px; height: 500px; margin-left: 500px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;" ></h2>

     <form  class="feedback-form" action="{{ route('customerFeedback') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name='customer_id' value="{{$data->id}}" hidden>
        <input type="text" name='order_number' id="order_number" hidden>
        <input type="text" id="onIdStorage" name="owner_id" hidden>

        <label for="feed back">Give Your Feedback:</label>
        <textarea name="feedback" id="feedback"></textarea>

        <button type="submit" style="width: 100%;">Submit</button>
     </form>

    <button style="width: 100%;" onclick="closePopupFeedBack('feedBackCustomer'); 
    openPopup3('notificationCustomer', 'Notification')" class="close-btn">Close</button>
</div>





<script>
    function openPopupFeedBack(popupID, title, ownerId, orderNumber) {
        var popupOverlay = document.getElementById('popupOverlay');
        var popupWindow = document.getElementById(popupID);
        var popupTitle = popupWindow.querySelector('h2');
        var tableBody = document.getElementById('venueTableBody');

        var ownerIdStorage = document.getElementById('onIdStorage');
        ownerIdStorage.value = ownerId;

        var order_number = document.getElementById('order_number');
        order_number.value = orderNumber;

        console.log('owner id', ownerId);

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