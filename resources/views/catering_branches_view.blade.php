
<!-- Add Catering Popup -->
<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="view_branches" style="display: none; width: 800px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    @isset($branch)
      <table>
        <thead>
        <tr>
        <th rowspan="2">Contact Person </th>
        <th rowspan="2">Location </th>
        <th rowspan="2">Mobile</th>
        <th rowspan="2">Email</th>
        <th colspan="2">Action</th> <!-- New column for action buttons -->            
        </thead>
      <tbody id="venueTableBody">
          <tr>
              <td>{{ $branch->Contact }}</td>
              <td>{{ $branch->Location }}</td>
              <td>{{ $branch->Mobile }}</td>
              <td>{{ $branch->Email }}</td>
              <td>
                <a  class="action-button" style="text-decoration: none;" href="#">edit</a>
                  <!-- Edit Button -->
                  {{-- <a class="action-button" onclick="openPopupEdit('Edit Venue','{{ $venue->id }}', '{{ $venue->venue_name }}', '{{ $venue->venue_capacity }}', '{{ $venue->venue_location }}', '{{ $venue->venue_pricing }}',  '{{$venue->venue_photo }}', '{{ $venue->day_off}}')">Edit</a> --}}
              </td>
              
              <td>
                <a class="action-button" style="text-decoration: none;" href="#">Delete</a>
                  <!-- Delete Button -->
                      {{-- <a class="action-button" href="{{url('delete/'.$venue->id)}}" style="text-decoration: none; ">Delete</button> --}}
              </td>
          </tr>
          
      </tbody>
      </table>
      @endisset
    <button onclick="closePopup3('view_branches')" style="width: 100%;" class="close-btn">Close</button>
</div>

 