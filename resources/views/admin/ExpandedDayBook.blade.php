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
                                        <h4 class="card-title">Store DayBook All Transactions</h4>
                                    </div>

                                    @if(Session::get('success'))

                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>

                                    @endif



                                    <div class="table-responsive">
                                        <br>

                                        <table id="example" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Narration</th>
                                                    <th>Voucher No</th>
                                                    <th>Amount</th>
                                                    <th>IGST</th>
                                                    <th>CGST</th>
                                                    <th>SGST</th>
                                                    <th>Bill Type</th>
                                                    <th>Bill Copy</th>
                                                    <th>Bill Info</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $number = 1; ?>

                                                <!-- sale -->

                                                @foreach ($expandedBook as $sa)
                                                <tr id="salelist">
                                                    <td>{{ $number }}</td>
                                                    <td>{{ $sa->bill_date}}</td>
                                                    <td>{{ $sa->bill_naration}}</td>
                                                    <td>{{ $sa->inv_num}}</td>

                                                    <!-- bill amount -->
                                                    @if($sa->bill_type == 'P')
                                                    <td>{{ $sa->pbill_amnt}}</td>
                                                    @elseif($sa->bill_type == 'S')
                                                    <td>{{ $sa->sbill_amnt}}</td>
                                                    @elseif($sa->bill_type == 'E')
                                                    <td>{{ $sa->ebill_amnt}}</td>
                                                    @endif
                                                    <!-- bill amount close -->

                                                    <td>{{ $sa->igst_sum}}</td>
                                                    <td>{{ $sa->cgst_sum}}</td>
                                                    <td>{{ $sa->sgst_sum}}</td>

                                                    <!-- sale or purchase or expense -->
                                                    @if($sa->bill_type == 'P')
                                                    <td><label class="badge badge-warning">Purchase</label></td>
                                                    @elseif($sa->bill_type == 'S')
                                                    <td><label class="badge badge-success">Sale</label></td>
                                                    @elseif($sa->bill_type == 'E')
                                                    <td><label class="badge badge-danger">Expense</label></td>
                                                    @endif
                                                    <!-- sale or purchase or expense close-->
                                                    <td class="py-1">
                                                        <img src="asset('img/ui-danro.jpg')" alt="image" />
                                                    </td>

                                                    <td><a href="{{ route('admin.viewbilldetails',$sa->id) }}" data-toggle="tooltip" title="Info" >
                                                            <i class="mdi mdi-information"></i>
                                                        </a>
                                                    </td>

                                                    <!-- <td><a href="{{ route('admin.viewExpandedDayBook',[$sa->store_code,$sa->bill_date]) }}" class="btn btn-primary btn-sm">btn-sm</a></td> -->


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