<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <!-- plugins:css -->
  @include('common.style')
</head>

<body>
  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    <!-- header -->
    @include('common.header')
    <!-- header close -->
    <!-- partial -->

    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->


      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      @include('common.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome {{$LoggedUserInfo['s_name']}}</h3>
                  <h6 class="font-weight-normal mb-0"><span class="text-primary"></span></h6>
                </div>
                <div class="col-12 col-xl-4">
                  <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                      <button class="btn btn-sm btn-light bg-white " type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="mdi mdi-calendar"></i> Today : {{$today}}
                      </button>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



          @if( $LoggedUserInfo['s_usertype'] == 1)

          <div class="row">
            <div class="col-md-6 grid-margin transparent">
              <div class="row">

                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Store Management</p>
                      <p class="fs-30 mb-2">{{$storecount}}</p>
                      <a style="color: white;" href="{{ route('admin.managestore') }}">Manage store <i class=" mdi mdi-arrow-right "></i></a>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">GST Slabs</p>
                      <p class="fs-30 mb-2">{{$gstslabs}}</p>
                      <a style="color: white;" href="{{ route('admin.managegstslabs') }}">Manage GST Slabs <i class=" mdi mdi-arrow-right "></i></a>
                    </div>
                  </div>
                </div>



                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">View DayBooks</p>
                      <p class="fs-30 mb-2">{{$storecount}}</p>
                      <a style="color: white;" href="{{ route('admin.viewDayBook') }}">View DayBook<i class=" mdi mdi-arrow-right "></i></a>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

          @elseif($LoggedUserInfo['s_usertype'] == 0)

          <div class="row">
            <div class="col-md-6 grid-margin transparent">
              <div class="row">

                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Sale Bills</p>
                      <p class="fs-30 mb-2">{{$purchasecount}} Nos</p>
                      <!-- <a style="display: none;" style="color: white;" href="{{ route('admin.viewDayBook') }}">View DayBook<i class=" mdi mdi-arrow-right "></i></a> -->
                    </div>
                  </div>
                </div>
                

                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Purchase Bills</p>
                      <p class="fs-30 mb-2">{{$salescount}} Nos</p>
                      <!-- <a style="color: white;" href="{{ route('admin.managegstslabs') }}">Manage GST Slabs <i class=" mdi mdi-arrow-right "></i></a> -->
                    </div>
                  </div>
                </div>

              

                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Expense Bills</p>
                      <p class="fs-30 mb-2">{{$expensecount}} Nos</p>
                      <!-- <a style="color: white;" href="{{ route('admin.viewDayBook') }}">View DayBook<i class=" mdi mdi-arrow-right "></i></a> -->
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
          @endif

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


  <!-- plugins:js -->
  @include('common.script')
  <!-- End custom js for this page-->
</body>

</html>