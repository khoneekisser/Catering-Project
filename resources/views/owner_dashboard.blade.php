
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Party Stop</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- for the right and wrong tick mark --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="{{asset('css/popup-form.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/popup-data.css') }}" />
    <link rel="stylesheet" href="{{asset('css/table.css')}}"/>
    

    {{-- css for the search box --}}
    <link rel="stylesheet" href="css/search-box.css" />


    {{-- google map api --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBecVmH1Y3ZVu6YjtOsBOW-mPYQrSOq_Gc&callback=initMap" async defer></script>

  
  </head>
  <body>
    
    

    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        {{$branch->Catering_Name}}
      </div>

      

      <div class="navbar_content">
        <i class="bi bi-grid"></i>
        <i class='bx bx-sun' id="darkLight"></i>
        <a href="#" onclick="openPopup3('notificationCustomer', 'Notification')">
          <i class='bx bx-bell' ></i>
        </a>
        
      </div>
    </nav>


    {{-- Main section Block --}}
    {{-- <div class="central-block">
      <h1>Pravesh Shrestha</h1>
    </div> --}}


    <!-- sidebar -->
    <nav class="sidebar">
      <div class="menu_content">
        <ul class="menu_items">
          <div class="menu_title menu_dahsboard"></div>
          <!-- duplicate or remove this li tag if you want to add or remove navlink with submenu -->
          <!-- start -->
          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-home-alt"></i>
              </span>
              <span class="navlink">Home</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="#" class="nav_link sublink" style="padding: 0px 0px 0px 52px;"
              onclick="openPopup3('profileViewOwner', 'Profile'); initMap()">
                <span class="navlink_icon">
                  <i class="bx bx-user"></i>
                </span>Profile
              </a>
              {{-- <a href="#" class="nav_link sublink" onclick="openPopup3('add_branches', 'Add Branch')">Add Branch</a> --}}
              {{-- <a href="#" class="nav_link sublink" onclick="openPopup3('view_branches', 'View Branches')">View Branches</a> --}}
            </ul>
          </li>
          <!-- end -->

          <!-- duplicate this li tag if you want to add or remove  navlink with submenu -->
          <!-- start -->




          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-grid-alt"></i>
              </span>
              <span class="navlink">Booking</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="#" class="nav_link sublink" 
              onclick="openPopup3('showOrders', 'Active Order Information')">View Orders</a>
              <a href="#" class="nav_link sublink" 
              onclick="openPopup3('viewOrderHistory', 'Search Orders')">Search Order</a>
              <a href="#" class="nav_link sublink"
              onclick="openPopup3('seeOrderHistory', 'Orders History')">See History</a>
              
            </ul>
          </li>



          <!-- end -->
        </ul>

        <ul class="menu_items">
          <div class="menu_title menu_editor"></div>
          <!-- duplicate these li tag if you want to add or remove navlink only -->
          <!-- Start -->
          <li class="item">
            <a href="#" class="nav_link" id="menu-data" onclick="openPopup3('show_menu', 'Menu')">
              <span class="navlink_icon">
                <i class="bx bxs-pizza"></i>
              </span>
              <span class="navlink">View Menu</span>
            </a>
          </li>
          <!-- End -->

          <li class="item">
            <a href="#" class="nav_link" onclick="openPopup3('add_menu', 'Add Menu')">
              <span class="navlink_icon">
                <i class="bx bx-loader-circle"></i>
              </span>
              <span class="navlink">Add Menu</span>
            </a>
          </li>


          <li class="item">
            <a href="#" class="nav_link" onclick="openPopup3('generateReportOwner', 'Report')">
              <span class="navlink_icon">
                <i class="bx bx-filter"></i>
              </span>
              <span class="navlink">Generate Report</span>
            </a>
          </li>


          {{-- <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-cloud-upload"></i>
              </span>
              <span class="navlink">Upload new</span>
            </a>
          </li> --}}
        </ul>
        
        <ul class="menu_items">
          <div class="menu_title menu_setting"></div>

          
          <li class="item">
            <a href="#" class="nav_link" onclick="openPopup3('customerReport', 'Report')">
              <span class="navlink_icon">
                <i class="fas fa-file-alt"></i>
              </span>
              <span class="navlink">Report</span>
            </a>
          </li>
          <li class="item">
            <a href="#" class="nav_link" onclick="openPopup3('changeQr', 'QR')">
              <span class="navlink_icon">
                <i class="bx bx-qr"></i>
              </span>
              <span class="navlink">Change QR</span>
            </a>
          </li>
          <li class="item">
            <a href="#" class="nav_link" onclick="openPopup3('settingOwner', 'Change Password')">
              <span class="navlink_icon">
                <i class="bx bx-cog"></i>
              </span>
              <span class="navlink">Change Password</span>
            </a>
          </li>


          
          <li class="item">
            <form id="logout-form">
            <a href=" {{route('logout-admin')}}"  class="nav_link">
                <span class="navlink_icon">
                    <i class='bx bx-log-out'></i>
                </span>
                <span class="navlink">
                  Logout
                </span>
            </a>
            </form>
        </li>
        </ul>

        <!-- Sidebar Open / Close -->
        <div class="bottom_content">
          <div class="bottom expand_sidebar">
            <span> Expand</span>
            <i class='bx bx-log-in' ></i>
          </div>
          <div class="bottom collapse_sidebar">
            <span> Collapse</span>
            <i class='bx bx-log-out'></i>
          </div>
        </div>
      </div>
    </nav>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
    


    @include('catering_popup')
    @include('catering_branches_view')
    @include('add_menu')
    @include('Ow_View_Menu')
    @include('menu_edit')
    @include('view_order')
    @include('owner-order-history')
    @include('owner-order-record')
    @include('owner-report')
    @include('profile')
    @include('owner-setting')
    @include('owner-qr')
    @include('notification-owner')
    @include('customer-report-admin')

    <!-- JavaScript -->
    <script src="js/script.js"></script>
    <script src="js/popup-catering-input.js"></script>
    <script>
      flatpickr("#day_off_catering", {
          mode: "multiple",
          dateFormat: "Y-m-d"
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/image_popup.js"></script>
    <script src="js/menu_edit.js"></script>
    
  
    <script>
      const userName = @json($userName);
      const customerDetails = @json($customerDetails);
      const order = @json($order);
      const orderDetails = @json($orderDetails);
    </script>
  </body>
</html>


