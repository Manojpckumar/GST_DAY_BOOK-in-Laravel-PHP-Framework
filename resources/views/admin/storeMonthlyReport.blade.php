<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>View DayBook</title>
  <!-- plugins:css -->
  @include('common.style')
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    @include('common.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->


      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
      @include('common.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <div class="form-inline">
                    <h4 class="card-title">Store Monthly Report</h4>
                  </div>

                  @if(Session::get('success'))

                  <div class="alert alert-success">
                    {{Session::get('success')}}
                  </div>

                  @endif
                  <!-- head -->

                  <strong> <label>{{ $storeName[0] }} </label> </strong>

                  @foreach($monthlyReport as $report)

                    <div class="row">
                      <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Total Sale Amount</h4>
                            <div class="media">
                            <i class="ti-world icon-md text-info d-flex align-self-center mr-3"></i>
                              <div class="media-body">
                                <h4>₹ {{ $report->sale_amnt }} /-</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Total Purchase Amount</h4>
                            <div class="media">
                              <i class="ti-world icon-md text-info d-flex align-self-center mr-3"></i>
                              <div class="media-body">
                              <h4>₹ {{ $report->pur_amnt }} /-</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Total Expense Amount</h4>
                            <div class="media">
                              <i class="ti-world icon-md text-info d-flex align-self-end mr-3"></i>
                              <div class="media-body">
                              <h4>₹ {{ $report->exp_amnt }} /-</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Total Sale GST</h4>
                            <div class="media">
                              <i class="ti-world icon-md text-info d-flex align-self-start mr-3"></i>
                              <div class="media-body">
                              <h4>₹ {{ $report->sale_gstsum }} /-</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Total Purchase GST</h4>
                            <div class="media">
                              <i class="ti-world icon-md text-info d-flex align-self-center mr-3"></i>
                              <div class="media-body">
                              <h4>₹ {{ $report->pur_gstsum }} /-</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  
                    </div>
                  
                    @endforeach



                  <!-- head close -->


                  <!-- table -->
                  <div class="table-responsive">
                    <br>

                    <table id="example" class="table table-hover">

                    <thead>
                      <tr>

                        <th>#</th>
                        <th>Bill Date</th>
                        <th>Invoice No</th>
                        <th>Narration</th>
                        <th>Amount</th>
                        <th>Bill Type</th>

                      </tr>
                    </thead>
                      <tbody>
                        <?php $number = 1; ?>

                        <!-- sale -->

                        @foreach ($alltrans as $trans)

                        <tr>
                          <td>{{ $number }}</td>
                          <td>{{ $trans->bill_date }}</td>
                          <td>{{ $trans->inv_num }}</td>
                          <td>{{ $trans->bill_naration }}</td>
                          
                          @if($trans->bill_type == 'S')
                          <td>{{ $trans->sbill_amnt }}</td>
                          <td><label class="badge badge-success">Sale</label></td>
                          @elseif($trans->bill_type == 'P')
                          <td>{{ $trans->pbill_amnt }}</td>
                          <td><label class="badge badge-warning">Purchase</label></td>
                          @elseif($trans->bill_type == 'E')
                          <td>{{ $trans->ebill_amnt }}</td>
                          <td><label class="badge badge-danger">Purchase</label></td>
                          @endif

                        </tr>

                        <?php $number++; ?>
                        @endforeach

                      </tbody>


                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  @include('common.script')

  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>