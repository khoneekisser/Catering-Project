<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popupCateringData" id="showBooking" style="display: none; width: 1250px; margin-left: 8%;">
    <h2 id="popupTitle3" style="background-color: #2aeef7; border-radius: 10px; text-align: center;
     padding: 10px; margin: 0 auto; width: atuo;"></h2>
    @isset($activeBookingInfo, $orderInfo, $caterings)
      <table>
        <thead>
        <tr>
            <th rowspan="2">S/No.</th>
            <th rowspan="2">Catering Name</th>
            <th rowspan="2">Grand Total</th>
            <th rowspan="2">Payed Amount</th>
            <th rowspan="2">Payment Picture</th>
            <th rowspan="2">Booked Date </th>
            <th colspan="2">Time</th>
            <th rowspan="2">Custom Request</th>
            <th colspan="3">Action</th> <!-- New column for action buttons -->  
        </tr>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Details</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
        </thead>
      <tbody>
        @php $counter = 1; @endphp
        @foreach($activeBookingInfo as $aBI)
            @if($aBI->completed == 0)
            <tr style="background-color: {{ $loop->index % 2 == 1 ? '#f2f2f2' : '#ffffff' }};">
                <td>{{ $counter}}</td>
                @php $counter++; @endphp
                <td>
                    @foreach($caterings as $catering)
                        @if($catering->o_id === $aBI->o_id)
                            {{ $catering->Catering_Name }}
                        @endif
                    @endforeach
                </td>
                <td>{{ $aBI->grand_total }}</td>
                <td>{{ $aBI->paidAmnt }}</td>
                <td>
                    @php
                        $photoPath = asset('storage/' . $aBI->pay_pic);
                    @endphp
                    <img class="thumbnail" src="{{ $photoPath }}" alt="No Photo" width="100" onclick="showCustomerBookingImg('{{ $aBI->pay_pic }}')">
                </td>
                <td>{{ $aBI->b_date }}</td>
                <td>{{ $aBI->time_from }}</td>
                <td>{{ $aBI->time_to }}</td>
                <td>{{ $aBI->cus_req }}</td>
                <td style="text-align: center;">
                    <button class="toggle" data-target="details{{ $loop->index }}">View</button>
                </td>
                <td style="text-align: center;">
                    <a  class="action-button-cancel
                        @if($aBI->status == 0)
                            order-cancelled-button
                        @else
                            cancel-order-button
                        @endif
    
                            " style="text-decoration: none;" href="#"
    
                        @if($aBI->status != 0)
                             onclick="calcelOrder('{{ url('cancelOrder/'.$aBI->id) }}')"
                        @endif
                        
                        >
    
                        @if($aBI->status == 0)
                            Cancelled
                        @else
                            Cancel
                        @endif
                    </a>
                </td>
                <td style="text-align: center;">
                    {{-- for delete button --}}
                    <a href="#" class="btn btn-link" onclick="calcelOrder('{{ url('deleteOrder/'.$aBI->id) }}')"> 
                        <i class="fas fa-trash-alt"></i>
                    </a>            
                </td>
              </tr>
              {{-- for the order details --}}
              <tr id="details{{ $loop->index }}" class="details-table" style="display: none;">
                <td colspan="12">
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
                            @foreach($orderInfo as $oF)
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
    
            @endif
          
        @endforeach
      </tbody>
      </table>
      @endisset
      



    <button onclick="closePopup3('showBooking')" style="width: 100%;" class="close-btn">Close</button>
</div>


<script>
    function showCustomerBookingImg(src) {
        const newWindow = window.open('', '_blank');
        newWindow.document.write(`<html><body style="margin: 0; display: flex; justify-content: center; align-items: center;">
                                  <img src="/storage/${src}" style="max-width: 100%; max-height: 100%;" onclick="window.close();">
                                  </body></html>`);
        newWindow.document.title = 'Payment Image';
    }

    window.onclick = function(event) {
        const imagePopup = document.getElementById('imagePopup');
        if (event.target !== imagePopup && event.target !== imagePopup.firstElementChild) {
            imagePopup.style.display = 'none';
        }
    }

    function calcelOrder(url) {
        if (confirm("Are you sure you want to cancel this item?")) {
            window.location.href = url;
        }
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


