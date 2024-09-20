<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="customerReport" style="display: none; width: 450px; height: 450px; margin-left: 500px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;" ></h2>

     <form  class="feedback-form" action="{{ route('userReportSubmit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name='user_id' value="{{$data->id}}" hidden>

        <label for="feed back">Write your report here...</label>
        <textarea name="report" id="report" required></textarea>

        <button type="submit" style="width: 100%;">Submit</button>
     </form>

    <button onclick="closePopup3('customerReport')" style="width: 100%;" class="close-btn">Close</button>
</div>