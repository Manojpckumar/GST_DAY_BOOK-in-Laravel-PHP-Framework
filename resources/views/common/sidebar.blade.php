
  <script src="{{'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'}}"></script>

  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">


      @if($LoggedUserInfo['s_usertype'] == 1)

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
          <i class="icon-bar-graph menu-icon"></i>
          <span class="menu-title">GST Slabs</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.addgstrtype') }}">Create Slab</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.managegstslabs') }}">Manage Slab</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="icon-grid-2 menu-icon"></i>
          <span class="menu-title">Store Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.addstore') }}">Create Store</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.managestore') }}">Manage Store</a></li>
          </ul>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.viewDayBook') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">View DayBook</span>
        </a>
      </li>


      <li class="nav-item">
        <a data-toggle="modal" data-target="#exampleModal" class="nav-link" href="#error" aria-expanded="false" aria-controls="error">
          <i class="icon-book menu-icon"></i>
          <span class="menu-title">DayBook Report</span>
          <i class="menu-arrow"></i>
        </a>
      </li>

      <li class="nav-item">
        <a data-toggle="modal" data-target="#monthlyReport" class="nav-link" href="#error" aria-expanded="false" aria-controls="error">
          <i class="icon-book menu-icon"></i>
          <span class="menu-title">DayBook Monthly Report</span>
          <i class="menu-arrow"></i>
        </a>
      </li>

      <!-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Record Bills</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.purchasebillview')}}">Purchase Bill</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.salebillview')}}">Sales Bill</a></li>
          </ul>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.recordexpence')}}" aria-expanded="false" aria-controls="icons">
          <i class="icon-contract menu-icon"></i>
          <span class="menu-title">Record Expenses</span>
          <i class="menu-arrow"></i>
        </a>
      </li> -->



      <li class="nav-item">
        <a class="nav-link" href="{{ route('auth.logout')}}" aria-expanded="false" aria-controls="icons">
          <i class=" mdi mdi-logout  menu-icon"></i>
          <span class="menu-title">Logout</span>
        </a>
      </li>

      @elseif($LoggedUserInfo['s_usertype'] == 0)

      
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Record Bills</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.purchasebillview')}}">Purchase Bill</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.salebillview')}}">Sales Bill</a></li>
          </ul>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.recordexpence')}}" aria-expanded="false" aria-controls="icons">
          <i class="icon-contract menu-icon"></i>
          <span class="menu-title">Record Expenses</span>

        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.viewIndividualDayBook')}}">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">View DayBook</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('auth.logout')}}" aria-expanded="false" aria-controls="icons">
          <i class=" mdi mdi-logout  menu-icon"></i>
          <span class="menu-title">Logout</span>
        </a>
      </li>

      @endif

    </ul>
  </nav>




  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Store Daily Report</h5>
          
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <i class=" mdi mdi-close "></i>
          </button>
        </div>

        <form method="POST" action="{{ route('admin.viewStoreDailyReport') }}">
          @csrf
        <div class="modal-body">
          <select required class="form-control form-control-lg" name="store_Code" id="storeSelect">
            <option value="">-----select store-----</option>
          </select>
          <span class="text-danger">@error('store_Code'){{$message}} @enderror</span>

          <br>
          <input name="selectDate" required class="form-control" type="date"/> 
          <span class="text-danger">@error('selectDate'){{$message}} @enderror</span>

        </div>
       

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">View DayBook</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <!-- monthlyReport -->

  <div class="modal fade" id="monthlyReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Monthly Report</h5>
          
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <i class=" mdi mdi-close "></i>
          </button>
        </div>

        <form method="POST" action="{{ route('admin.viewStoreMonthlyReport') }}">
          @csrf
        <div class="modal-body">
        <label>Store Name</label>
          <select required class="form-control form-control-lg" name="storeCODE" id="storeMonth">
            <option value="">-----select store-----</option>
          </select>
          <br>
          <label>From Date</label>
          <input name="fromDate" required class="form-control" type="date"/>
          <br>
          <label>To Date</label>
          <input name="toDate" required class="form-control" type="date"/> 
        </div>
       

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">View DayBook</button>
        </div>
        </form>
      </div>
    </div>
  </div>




<script>
  $(document).ready(function() {
    $.ajax({
      type: 'GET',
      url: "{{ route('admin.getStores') }}",
      dataType: 'json',

      success: function(response) {

        for (var i = 0; i <= (response).length; i++) {
          $('#storeSelect').append('<option value=' + response[i].store_code + '>' + response[i].s_name + '</option>');
        }

      }
    });


    $.ajax({
      type: 'GET',
      url: "{{ route('admin.getStores') }}",
      dataType: 'json',

      success: function(response) {

        for (var i = 0; i <= (response).length; i++) {
          $('#storeMonth').append('<option value=' + response[i].store_code + '>' + response[i].s_name + '</option>');
        }

      }
    });

  });
</script>
