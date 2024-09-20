
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Party Stop</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/popup.css" />
    <link rel="stylesheet" href="css/table.css"/>
    <link rel="stylesheet" href="css/popup-form.css"/>
    <link rel="stylesheet" href="css/profile.css"/>


    {{-- google map api --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBecVmH1Y3ZVu6YjtOsBOW-mPYQrSOq_Gc&callback=initMap" async defer></script>

  
   
  </head>
  <body>
    
    

    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        Welcome {{$customer->full_name}}
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
              onclick="openPopup3('profileViewCustomer', 'Profile')">
                <span class="navlink_icon">
                    <i class="bx bx-user"></i>
                </span>Profile
              </a>
              {{-- <a href="#" class="nav_link sublink"> {{$data->id}}</a>
              <a href="#" class="nav_link sublink">Null</a> --}}
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
              <a href="#" class="nav_link sublink" style="padding: 0px 0px 0px 52px;"
              onclick="openPopup3('showBooking', 'Booked Catering Information')">
                <span class="navlink_icon">
                  <i class="bx bx-loader-circle"></i>
                </span>View Booking
              </a>
              <a href="#" class="nav_link sublink" style="padding: 0px 0px 0px 52px;"
              onclick="openPopup3('show_catering_names', 'Available Caterings')">
                <span class="navlink_icon">
                  <i class="bx bxs-pizza"></i>
                </span>
                <span class="navlink">Caterings</span>
              </a>
              <a href="#" class="nav_link sublink" style="padding: 0px 0px 0px 52px;"
              onclick="openPopup3('showBookingHistory', 'Booking History')">
                <span class="navlink_icon">
                  <i class="bx bx-history"></i>
                </span>History
              </a>
              {{-- <a href="#" class="nav_link sublink">Nav Sub Link</a>
              <a href="#" class="nav_link sublink">Nav Sub Link</a> --}}
            </ul>
          </li>
          <!-- end -->
        </ul>

       
        <ul class="menu_items">
          <div class="menu_title menu_setting"></div>
          {{-- <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-flag"></i>
              </span>
              <span class="navlink">Notice board</span>
            </a>
          </li>--}}
          <li class="item">
            <a href="#" class="nav_link" onclick="openPopup3('customerReport', 'Report')">
              <span class="navlink_icon">
                <i class="fas fa-file-alt"></i>
              </span>
              <span class="navlink">Report</span>
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
            <a href="#" class="nav_link" onclick="openPopup3('profilePicture', 'Change Profile Picture')">
              <span class="navlink_icon">
                <i class='bx bx-camera'></i>
              </span>
              <span class="navlink">Add Profile Picture</span>         
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
    

   <!-- including all the files -->
    @include('cateringInformation')
    @include('showMenu')
    @include('showBooking')
    @include('customer-profile')
    @include('owner-setting')
    @include('notification-customer')
    @include('customer-booking-history')
    @include('customer-profile-picture')
    @include('customer-report-admin')


    <!-- JavaScript -->
    <script src="js/script.js"></script>
    <script src="js/popup-catering-input.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
      const caterings = @json($caterings);
    </script>
    
 
  </body>
</html>


