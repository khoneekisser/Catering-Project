<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popup" id="showOrders" style="display: none; width: 90%;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: auto;"></h2>
    
    @isset($order, $orderDetails, $userName)
      <table>
        <thead>
        <tr>
            <th rowspan="2">S/No.</th>
            <th rowspan="2">Customer Name</th>
            <th rowspan="2">Grand Total</th>
            <th rowspan="2">Payed Amount</th>
            <th rowspan="2">Payment Picture</th>
            <th rowspan="2">Booked Date </th>
            <th colspan="2">Time</th>
            <th rowspan="2">Custom Request</th>
            <th colspan="6">Status</th> <!-- New column for action buttons -->  
        </tr>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Details</th>
            <th>Delete</th>
            <th colspan="2">Active ?</th>
            <th colspan="2">Completed ?</th>
            
        </tr>
        </thead>
      <tbody>
        <?php 
        $serial = 1; 
        ?>
        @foreach($order as $aBI)
            @if($aBI->completed == 0)
            <tr style="background-color: {{ $loop->index % 2 == 1 ? '#f2f2f2' : '#ffffff' }};">
                <td>{{ $serial }}</td>
                <td>
                    @foreach($customerDetails as $uN)
                        @if ($uN->c_id == $aBI->cus_id)
                            {{ $uN->full_name }}
                        @endif
                    @endforeach
                </td>
                <td>{{ $aBI->grand_total }}</td>
                <td>{{ $aBI->paidAmnt }}</td>
                <td>
                    @php
                        $photoPath = asset('storage/' . $aBI->pay_pic);
                    @endphp
                    <img class="thumbnail" src="{{ $photoPath }}" alt="No Photo" width="100" onclick="openImageInNewWindow('{{ $photoPath }}')">
                </td>
                <td>{{ $aBI->b_date }}</td>
                <td>{{ $aBI->time_from }}</td>
                <td>{{ $aBI->time_to }}</td>
                <td>{{ $aBI->cus_req }}</td>
                <td style="text-align: center;">
                    <button class="toggle" data-target="details{{ $loop->index }}">View</button>
                </td>
                <td style="text-align: center;">
                {{-- for delete button --}}
                    <a href="#" class="btn btn-link" onclick="deleteOrder('{{ url('deleteOrder/'.$aBI->id) }}')"> 
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
                <td style="text-align: center;"> 
                    <a style="text-align: center; color: rgb(219, 219, 28); text-decoration: none;">
                        @if($aBI->status == 0)
                            No
                        @else
                            Yes
                        @endif
                    </a>           
                </td>
                <td style="text-align: center;">
                    <a href="javascript:void(0);" class="btn btn-danger"

                    @if($aBI->status != 0)
                        onclick="calcelOrder('{{ url('cancelOrder/'.$aBI->id) }}')"
                    @endif
                    >
                        <i class="fas fa-times"></i> 
                    </a>
                </td>
                <td style="text-align: center;"> 
                    <a style="text-align: center; color: rgb(219, 219, 28); text-decoration: none;">
                        @if($aBI->completed == 0)
                            No
                        @else
                            Yes
                        @endif
                    </a>           
                </td>
                <td style="text-align: center;">
                    <a href="javascript:void(0);" class="btn btn-success"

                    @if($aBI->completed == 0)
                        onclick="completeOrder('{{ url('orderComplete/'.$aBI->id) }}')"
                    @endif
                    >
                        <i class="fas fa-check"></i> 
                    </a>
                </td>
                
            </tr>
            {{-- for the order details --}}
            <tr id="details{{ $loop->index }}" class="details-table" style="display: none;">
                <td colspan="15">
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
                            $sno = 1; // Initialize sno for this details table
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
            <?php $serial++; ?>
            @endif
        @endforeach
      </tbody>
      </table>
    @endisset
    <button onclick="closePopup3('showOrders')" style="width: 100%;" class="close-btn">Close</button>
</div>

<!-- Popup for enlarged image -->
<div id="imagePopup" style="display:none; position:absolute; z-index:1000;">
    <img id="popupImage" src="" alt="Enlarged Image" style="max-width:150px; max-height:150px;">
</div>

<script>
  function calcelOrder(url) {
      if (confirm("Are you sure you want to cancel this order?")) {
          window.location.href = url;
      }
  }
  function deleteOrder(url) {
      if (confirm("Are you sure you want to delete this order?")) {
          window.location.href = url;
      }
  }
  function completeOrder(url) {
      if (confirm("Order Completed?")) {
          window.location.href = url;
      }
  }

  function openImageInNewWindow(imageSrc) {
      window.open(imageSrc, '_blank');
  }

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
    });
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

