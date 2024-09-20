
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

    {{-- from profile view of owner --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Party Stop</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/popup.css" />
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/popup-data.css">
    <link rel="stylesheet" href="css/popup-form.css">


    {{-- google map api --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBecVmH1Y3ZVu6YjtOsBOW-mPYQrSOq_Gc&callback=initMap" async defer></script>

    <style>
      #map {
          height: 200px;
          width: 100%;
      }
      #selectedLocation {
          width: 100%;
          padding: 10px;
          font-size: 16px;
      }
    </style>


    
  </head>
  <body class="dark">
    
    

    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        Welcome Admin 
      </div>

      <div class="navbar_content">
        <i class="bi bi-grid"></i>
        <i class='bx bx-moon' id="darkLight"></i>
        <i class='bx bx-bell' onclick="openPopup3('adminNotification', 'Notification')"></i>
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
              <a href="#" class="nav_link sublink" id="showClients">Show Owners</a>
              <a href="#" class="nav_link sublink" id="showCustomers">Show Customers</a>
            </ul>
          </li>
          <!-- end -->

          <!-- duplicate this li tag if you want to add or remove  navlink with submenu -->
          <!-- start -->
          
          <!-- end -->
          {{-- start --}}



          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-user"></i>
              </span>
              <span class="navlink">Owner Tab</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="#" class="nav_link sublink" 
              onclick="openPopup3('adminViewOwnerProfile', 'Owner Profile View')">Profile</a>
              <a href="#" class="nav_link sublink" 
              onclick="openPopup3('adminAddMenu', 'Add Menu')">Add Menu</a>
              <a href="#" class="nav_link sublink"
              onclick="openPopup3('adminEditMenu', 'View Menu 1')">View Menu</a>
              <a href="#" class="nav_link sublink"
              onclick="openPopup3('adminShowOrderOwner', 'View Order')">Show Orders</a>
              <a href="#" class="nav_link sublink"
              onclick="openPopup3('adminViewReport', 'View Report')">Show Report</a>
              <a href="#" class="nav_link sublink"
              onclick="openPopup3('ownerFeedback', 'Owner Feedback')">Feedbacks</a>
            </ul>
          </li>



          {{-- end --}}
          {{-- start --}}


          
          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-group"></i>
              </span>
              <span class="navlink">Customer Tab</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="#" class="nav_link sublink"
              onclick="openPopup3('adminViewCustomerProfile', 'Customer Profile View')">Profile</a>
              <a href="#" class="nav_link sublink"
              onclick="openPopup3('adminViewCustomerTransaction', 'Customer Transaction Record')">Show Transacion</a>
            </ul>
          </li>
         
        </ul>




        <ul class="menu_items">
          <div class="menu_title menu_editor"></div>
         
          <li class="item">
            <a href="#" class="nav_link" onclick="openPopup3('searchOrderNumber', 'Search through order number.')">
              <span class="navlink_icon">
                <i class="bx bxs-magic-wand"></i>
              </span>
              <span class="navlink">Search Order</span>
            </a>
          </li>
       

          <li class="item">
            <a href="#" class="nav_link" onclick="openPopup3('showOrdersAdmin', 'Order Information')">
              <span class="navlink_icon">
                <i class="bx bx-loader-circle"></i>
              </span>
              <span class="navlink">Show Order</span>
            </a>
          </li>
          <li class="item">
            <a href="#" class="nav_link" onclick="openPopup3('generateReport', 'Full Repoort')">
              <span class="navlink_icon">
                <i class="bx bx-filter"></i>
              </span>
              <span class="navlink">Generate Report</span>
            </a>
          </li>
        </ul>
        <ul class="menu_items">
          <div class="menu_title menu_setting"></div>
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
            <a href="{{route('logout-admin')}}"  class="nav_link">
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

   

    {{-- for Owners data pop up for the activation --}}
    {{-- <div id="popupWrapper" class="popupWrapper">
      <div class="popup" style="max-height: 500px; min-height: 100px; width: 40%;">
          <table id="clientsTable">
              <thead>
                  <tr>
                      <th style="width:50px;">ID</th>
                      <th>User Name</th>
                      <th>Role</th>
                      <th>Details</th>
                      <th colspan="2" style="width: 100px;">Is Active</th>
                  </tr>
              </thead>
              <tbody>
                  <!-- Table content will be added dynamically -->
              </tbody>
          </table>
          <button id="closePopup" style="width: 100%; text-align: center;">Close</button>
      </div>
    </div> --}}
    <div id="popupWrapper" class="popupWrapper">
      <div class="popup" style="max-height: 500px; min-height: 100px; width: 40%;">
        <input type="text" id="searchInputProfileSearch" placeholder="Search by User Name" 
        style="padding: 10px; font-size: 16px; border: 2px solid #ccc; border-radius: 4px; 
        width: 100%; box-sizing: border-box; margin: 8px 0;">
        <table id="clientsTable">
              <thead>
                  <tr>
                      <th style="width:50px;">ID</th>
                      <th>User Name</th>
                      <th>Role</th>
                      <th>Details</th>
                      <th colspan="2" style="width: 100px;">Is Active</th>
                  </tr>
              </thead>
              <tbody>
                  <!-- Table content will be added dynamically -->
              </tbody>
          </table>
          <div id="paginationControls" style="margin-left: 25%;">
            <button id="prevButton" style="color: white; background-color: #007BFF;
             border: none; padding: 10px 20px; text-align: center; text-decoration: none;
             display: inline-block; font-size: 16px; margin: 4px 2px; border-radius: 12px;
             cursor: pointer;">Previous</button>
            <span id="pageInfo"></span>
            <button id="nextButton" style="color: white; background-color: #007BFF;
             border: none; padding: 10px 20px; text-align: center; text-decoration: none; 
             display: inline-block; font-size: 16px; margin: 4px 2px; border-radius: 12px; 
             cursor: pointer;">Next</button>
          </div>
          <button id="closePopup" style="width: 100%; text-align: center;">Close</button>
      </div>
  </div>
  


        {{-- include all the files for the popup --}}
    @include('admin_vw_order')
    @include('admin_vw_profile_owner')
    @include('admin_add_menu')
    @include('admin-view-menu')
    @include('admin-view-order-owner')
    @include('admin-view-report')
    @include('admin-owner-feedback')

    @include('admin-vw-profile-customer')
    @include('admin-vw-customer-transaction')
    @include('admin-search-order-number')

    @include('admin-generate-report')
    @include('admin-notification')
    @include('owner-setting')
    <!-- JavaScript -->
    <script src="js/script.js"></script>

    {{-- <script src="js/popup.js"></script> --}}

    <script src="js/popupClient.js"></script>

    <script src="js/popup-catering-input.js"></script>

    <script>
      // Embed the owner data as a JavaScript variable
      const owners = @json($owner);
      const customers = @json($customer);
      const ownerDetails = @json($ownerDetails);
      const customerDetails = @json($customerDetails);
      const menu = @json($menu);
      const orders = @json($orders);
      const orderDetails = @json($orderDetails);
    </script>

    <script src="js/popup-catering-input.js"></script>


    {{-- for the flash message --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   --}}
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>


