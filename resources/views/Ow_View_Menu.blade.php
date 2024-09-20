<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="show_menu" style="display: none;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    @isset($menu)
      <table> 
        <thead>
          <tr>
            <th rowspan="2" style="width: 50px;">S/No.</th>
            <th rowspan="2">Item Name</th>
            <th rowspan="2">Category</th>
            <th rowspan="2">Photo</th>
            <th rowspan="2">Price</th>
            <th rowspan="2">Description</th>
            <th rowspan="2" style="width: 100px;">Availability</th>
            <th colspan="2" rowspan="2">Action</th>
          </tr>
        </thead>
        <tbody id="venueTableBody">
          @foreach($menu as $menuData)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $menuData->item_name }}</td>
            <td>{{ $menuData->category }}</td>
            <td>
              <div class="thumbnail-container" style="margin-bottom: 10px;">
                @php
                  $photoPath = asset('storage/' . $menuData->picture);
                @endphp
                <img class="thumbnail" src="{{ $photoPath }}" alt="No Photo" width="100" data-large="{{ $photoPath }}">
              </div>
            </td>
            <td>{{ $menuData->price }}</td>
            <td>{{ $menuData->description }}</td>
            <td>{{ $menuData->available ? 'Yes' : 'No' }}</td>
            <td>
              <!-- Edit Button -->
              
              <a class="action-button" onclick="openPopupEdit('Edit Menu', '{{ $menuData->id }}'
                , '{{ $menuData->item_name }}', '{{ $menuData->category }}', '{{ $menuData->price }}'
                , '{{ $menuData->description }}')">Edit</a>

            </td>
            <td>
              {{-- for delete button --}}
              <a href="#" class="btn btn-link" onclick="confirmDelete('{{ url('delete/'.$menuData->id) }}')"> 
                <i class="fas fa-trash-alt"></i>
              </a>     
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endisset
    <button onclick="closePopup3('show_menu')" style="width: 100%;" class="close-btn">Close</button>
</div>

<!-- Popup for enlarged image -->
<div id="imagePopup" style="display:none; position:absolute; z-index:1000;">
    <img id="popupImage" src="" alt="Enlarged Image" style="max-width:150px; max-height:150px;">
</div>

<script>
  function confirmDelete(url) {
      if (confirm("Are you sure you want to delete this item?")) {
          window.location.href = url;
      }
  }
</script>

<style>
    .thumbnail-container {
        position: relative;
        display: inline-block;
        
    }
    .thumbnail {
        cursor: pointer;
        transition: opacity 0.3s ease;
    }
</style>
