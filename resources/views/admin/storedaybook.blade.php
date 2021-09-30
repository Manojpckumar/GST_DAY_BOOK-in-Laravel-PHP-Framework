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
                                        <h4 class="card-title">Store DayBook By Date</h4>
                                    </div>

                                    @if(Session::get('success'))

                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>

                                    @endif

                                    

                                    <div  class="table-responsive">
                                        <br>

                                        <table id="example" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <!-- <th>Sale Type</th> -->
                                                    <th>Store Name</th>
                                                    <th>Sale Amount</th>
                                                    <th>Purchase Amount</th>
                                                    <th>Expense Amount</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $number = 1; ?>

                                                <!-- sale -->
                                               
                                                    @foreach ($sale as $sa)
                                                    <tr id="salelist">
                                                        <td>{{ $number }}</td>
                                                        <td>{{ $sa->bill_date}}</td>
                                                        <!-- <td>{{ $sa->sale_type }}</td> -->
                                                        <td>{{ $sa->s_name}}</td>
                                                        <td>{{ $sa->sale_amnt}}</td>
                                                        <td>{{ $sa->pur_amnt}}</td>
                                                        <td>{{ $sa->exp_amnt}}</td>
                                                        <td>
                                                            <a href="{{ route('admin.viewStoreExpandedDayBook',[$sa->store_code,$sa->bill_date]) }}" class="btn btn-primary btn-sm">View DayBook</a>
                                                        </td>
                                                        <!-- <td><label class="badge badge-success">Sale</label></td> -->
                                                        
                                                       
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