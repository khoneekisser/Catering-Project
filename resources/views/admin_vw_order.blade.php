<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="showOrdersAdmin" style="display: none; max-height: 80%; ">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    
    @isset($orders, $orderDetails, $customer, $owner, $ownerDetails)
      <table>
        <thead>
        <tr>
            <th rowspan="2">S/No.</th>
            <th rowspan="2">Customer Name</th>
            <th rowspan="2">Catering Name</th>
            <th rowspan="2">Owner Name</th>
            <th rowspan="2">Grand Total</th>
            <th rowspan="2">Payed Amount</th>
            <th rowspan="2">Payment Picture</th>
            <th rowspan="2">Booked Date </th>
            <th colspan="2">Time</th>
            <th rowspan="2">Custom Request</th>
            <th colspan="4">Status</th> <!-- New column for action buttons -->  
        </tr>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Details</th>
            <th>Availability</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
      <tbody>
        @foreach($orders as $aBI)
          <tr style="background-color: {{ $loop->index % 2 == 1 ? '#f2f2f2' : '#ffffff' }};">
            <td>{{ $loop->iteration }}</td>
            <td>
                {{-- for the customer name --}}
                @foreach($customerDetails as $customerDetail)
                    @foreach($customerDetail as $cd)
                        @if ($cd->c_id == $aBI->cus_id)
                            {{ $cd->full_name }}
                        @endif
                    @endforeach
                @endforeach    
            </td>
            <td>
                {{-- for the catering name --}}
                @foreach($ownerDetails as $ownerDetailsCollection)
                    @foreach($ownerDetailsCollection as $oD)
                        @if ($oD->o_id == $aBI->o_id)
                            {{ $oD->Catering_Name }}
                        @endif
                    @endforeach
                @endforeach    
            </td>
            <td>
                {{-- for the owner name --}}
                @foreach($ownerDetails as $ownerDetail)
                    @foreach($ownerDetail as $od)
                        @if ($od->o_id == $aBI->o_id)
                            {{ $od->Contact }}
                        @endif
                    @endforeach
                @endforeach    
            </td>
            <td>{{ $aBI->grand_total }}</td>
            <td>{{ $aBI->paidAmnt }}</td>
            <td>
                @php
                    $photoPath = asset('storage/' . $aBI->pay_pic);
                @endphp
                <img class="thumbnail" src="{{ $photoPath }}" alt="No Photo" width="100">
            </td>
            <td>{{ $aBI->b_date }}</td>
            <td>{{ $aBI->time_from }}</td>
            <td>{{ $aBI->time_to }}</td>
            <td>{{ $aBI->cus_req }}</td>
            <td style="text-align: center;">
                <button class="toggle" data-target="details{{ $loop->index }}">View</button>
            </td>
            <td style="text-align: center;"> 
                <a style="text-align: center; color: rgb(219, 219, 28); text-decoration: none;">
                    @if($aBI->status == 0)
                        Cancelled
                    @else
                        On Going
                    @endif
                </a>           
            </td>
            <td>{{ $aBI->created_at }}</td>
            <td>{{ $aBI->updated_at }}</td>
          </tr>
          {{-- for the order details --}}
          <tr id="details{{ $loop->index }}" class="details-table" style="display: none;">
            <td colspan="13">
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 50px;">S/No.</th>
                            <th rowspan="2">Item Name</th>
                            <th rowspan="2">Category</th>
                            <th rowspan="2">Rate</th>
                            <th rowspan="2">Quantity</th>
                            <th rowspan="2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $sno = 1;
                        @endphp
                        @foreach($orderDetails as $oF)
                        @if($aBI->id === $oF->order_id)
                        <tr style="background-color: {{ $loop->index % 2 == 1 ? '#f2f2f2' : '#ffffff' }};">
                            <td>{{ $sno++ }}</td>
                            <td>{{ $oF->item_name }}</td>
                            <td>{{ $oF->category }}</td>
                            <td>{{ $oF->rate }}</td>
                            <td>{{ $oF->quantity }}</td>
                            <td>{{ $oF->total }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>

        @endforeach
      </tbody>
      </table>
    @endisset
    <button onclick="closePopup3('showOrdersAdmin')" style="width: 100%;" class="close-btn">Close</button>
</div>

<!-- Popup for enlarged image -->
<div id="imagePopup" style="display:none; position:absolute; z-index:1000;">
    <img id="popupImage" src="" alt="Enlarged Image" style="max-width:150px; max-height:150px;">
</div>

<script>
  function calcelOrder(url) {
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Function to toggle details table visibility
    document.querySelectorAll('.toggle').forEach(function (button) {
        button.addEventListener('click', function () {
            var targetId = this.getAttribute('data-target');
            var detailsTable = document.getElementById(targetId);

            // Toggle visibility
            if (detailsTable.style.display === 'none') {
                detailsTable.style.display = 'table-row'; // Show as table row
            } else {
                detailsTable.style.display = 'none'; // Hide details table
            }
        });
    });

    // Function to open image in a new window
    document.querySelectorAll('.thumbnail').forEach(function (thumbnail) {
        thumbnail.addEventListener('click', function () {
            var imageUrl = this.getAttribute('src');

            // Open a new window
            var newWindow = window.open('', '_blank');
            newWindow.document.write(`
                <html>
                    <head>
                        <title>Image Preview</title>
                    </head>
                    <body style="margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #000;">
                        <img src="${imageUrl}" style="max-width: 100%; max-height: 100%;">
                    </body>
                </html>
            `);
        });
    });
});

</script>