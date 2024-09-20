<div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
<div class="popupCateringData" id="showBookingHistory" style="display: none; width: 1250px; margin-left: 8%;">
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
            <th rowspan="2">Details</th> <!-- New column for action buttons -->  
        </tr>
        <tr>
            <th>From</th>
            <th>To</th>
        </tr>
        </thead>
      <tbody>
        @php $counter = 1; @endphp
        @foreach($activeBookingInfo as $aBI)
            @if($aBI->completed == 1)
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
                    <img class="thumbnail" src="{{ $photoPath }}" alt="No Photo" width="100" onclick="showCustomerHistoryImg('{{ $aBI->pay_pic }}')">
                </td>
                <td>{{ $aBI->b_date }}</td>
                <td>{{ $aBI->time_from }}</td>
                <td>{{ $aBI->time_to }}</td>
                <td>{{ $aBI->cus_req }}</td>
                <td style="text-align: center;">
                    <button class="toggle" data-targets="detail{{ $loop->index }}">View</button>
                </td>
              </tr>
              {{-- for the order detail --}}
              <tr id="detail{{ $loop->index }}" class="detail-table" style="display: none;">
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
                            $sno = 1; // Initialize sno for this detail table
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
      



    <button onclick="closePopup3('showBookingHistory')" style="width: 100%;" class="close-btn">Close</button>
</div>


<script>
    function showCustomerHistoryImg(src) {
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

    document.addEventListener('DOMContentLoaded', function () {
        // Function to toggle detail table visibility
        document.querySelectorAll('.toggle').forEach(function (button) {
            button.addEventListener('click', function () {
                var targetId = this.getAttribute('data-targets');
                var detailTable = document.getElementById(targetId);

                // Toggle visibility
                if (detailTable.style.display === 'none') {
                    detailTable.style.display = 'table-row'; // Show as table row
                } else {
                    detailTable.style.display = 'none'; // Hide detail table
                }
            });
        });
    });
</script>


