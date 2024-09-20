<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popupCateringData" id="show_catering_names" style="display: none; margin-left: 130px; width: 1300px;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    @isset($caterings)
      <table>
        <thead>
        <tr>
            <th rowspan="2">Catering Name</th>
            <th rowspan="2">Logo</th>
            <th rowspan="2">Contact Person</th>
            <th rowspan="2">Location </th>
            <th rowspan="2">Mobile</th>
            <th rowspan="2">Email</th>
            <th colspan="2">Action</th> <!-- New column for action buttons -->            
        </thead>
      <tbody>
        @foreach($caterings as $cat)
          <tr>
            <td>{{ $cat->Catering_Name}}</td>
            <td>
                @php
                  $photoPath = asset('storage/' . $cat->Logo);
                @endphp
                <img class="thumbnail" src="{{ $photoPath }}" alt="No Photo" width="100">
            </td>
            <td>{{ $cat->Contact }}</td>
            <td>
                <div id="map-{{ $cat->id }}" class="map-container"></div>
            </td>
            <td>{{ $cat->Mobile }}</td>
            <td>{{ $cat->Email }}</td>
            <td>
                <a  class="action-button" style="text-decoration: none;" href="#" onclick="openPopupMenu('show_menu', 'Menu', {{$cat->o_id}})">View</a>
            </td>
          </tr>
        @endforeach
      </tbody>
      </table>
      @endisset
    <button onclick="closePopup3('show_catering_names')" style="width: 100%;" class="close-btn">Close</button>
</div>


<script>
 function initMaps() {
      @foreach($caterings as $cat)
        var location{{ $cat->id }} = { lat: parseFloat('{{ $cat->latitude }}'), lng: parseFloat('{{ $cat->longitude }}') };
        var map{{ $cat->id }} = new google.maps.Map(document.getElementById('map-{{ $cat->id }}'), {
            zoom: 15,
            center: location{{ $cat->id }}
        });
        var marker{{ $cat->id }} = new google.maps.Marker({
            position: location{{ $cat->id }},
            map: map{{ $cat->id }}
        });
      @endforeach
  }
  google.maps.event.addDomListener(window, 'load', initMaps);
</script>

<style>
  .map-container {
      width: 300px;
      height: 200px;
  }
</style>