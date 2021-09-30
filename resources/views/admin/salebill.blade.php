<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
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



            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Enter Sale Bill</h4>
                  <form enctype="multipart/form-data" class="form-sample" action="{{ route('admin.addsalebill')}}" method="post">

                    @csrf
                    @if(Session::get('success'))

                    <div class="alert alert-success">
                      {{Session::get('success')}}

                    </div>

                    @endif

                    @if(Session::get('fail'))

                    <div class="alert alert-danger">
                      {{Session::get('fail')}}
                    </div>

                    @endif


                    <!-- 1 -->

                    <!-- B2C or B2B -->
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sale Type</label>
                        <div class="col-sm-4">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input id="b2b" type="radio" class="form-check-input" name="saletype" value="B2B">
                              B2B
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input id="b2c" type="radio" class="form-check-input" name="saletype" value="B2C">
                              B2C
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- B2C or B2B Close -->

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Party Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="partyName" class="form-control" />
                            <span class="text-danger">@error('partyName'){{$message}} @enderror</span>

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">GST Number</label>
                          <div class="col-sm-9">
                            <input type="text" name="gstNumber" class="form-control" />
                            <span class="text-danger">@error('gstNumber'){{$message}} @enderror</span>

                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- 2 -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Invoice Number</label>
                          <div class="col-sm-9">
                            <input type="text" name="invNumber" class="form-control" />
                            <span class="text-danger">@error('invNumber'){{$message}} @enderror</span>

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bill Date</label>
                          <div class="col-sm-9">
                            <input type="date" name="billDate" class="form-control" />
                            <span class="text-danger">@error('billDate'){{$message}} @enderror</span>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bill Amount</label>
                          <div class="col-sm-9">
                            <input type="number" required name="billAmt" class="form-control" />
                            <span class="text-danger">@error('billAmt'){{$message}} @enderror</span>

                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Description</label>
                          <div class="col-sm-9">
                            <input type="text" name="invDes" class="form-control" />
                            <span class="text-danger">@error('invDes'){{$message}} @enderror</span>

                          </div>
                        </div>
                      </div>


                    </div>

                    <!-- 2.5 -->
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">State Of Sale</label>
                        <div class="col-sm-4">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input id="inside" type="radio" class="form-check-input" name="stateSale" value="inside">
                              Inside Kerala
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input id="outside" type="radio" class="form-check-input" name="stateSale" value="outside">
                              Outside Kerala
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>




                    <!-- 2.5 close -->

                    <!-- dynamic -->

                    <table id="wo_amt_table2" class="form" ;>

                      <label>Add or Remove rows </label> &nbsp; &nbsp;
                      <button data-toggle="tooltip" title="Add Row" type="button" value="Add Row" class="btn btn-primary btn-rounded btn-icon" onClick="addRow('wo_amt_table2')"><i class=" mdi mdi-plus "></i></button>
                      &nbsp; &nbsp;
                      <button data-toggle="tooltip" title="Delete Row" type="button" value="Delete Row" class="btn btn-primary btn-rounded btn-icon" onClick="deleteRow('wo_amt_table2')"><i class=" mdi mdi-minus "></i></button>
                      <br>
                      <br>

                      <div class="form-inline">

                        <label class=" mb-2 mr-sm-2 col-md-1">GST Slab</label>
                        <label class=" mb-1 mr-sm-1 col-md-2">Taxable Amount</label>
                        <label class=" mb-2 mr-sm-2 col-md-2">No of Unit</label>
                        <label class=" mb-2 mr-sm-2 col-md-2">CGST</label>
                        <label class=" mb-2 mr-sm-2 col-md-2">SGST</label>
                        <label class=" mb-2 mr-sm-2 col-md-2">IGST</label>

                      </div>

                    

                      <tr>
                        <td>

                          <select class="form-control" name="gst_slabs[]">
                            @foreach($gstslabs as $slab)
                            <option>{{ $slab['gstr'] }}</option>
                            @endforeach
                          </select>


                        </td>

                        <td><input required class="form-control " type="text" class="small" name="tax_amt[]" style="width: 100%" onChange="calc(this.parentElement.parentElement)"></td>

                        <td><input required value="0" class="form-control " type="text" class="small" name="pro_unit[]" style="width: 100%" required style="border:0px"></td>

                        <td><input readonly value="0" class="form-control " type="text" class="small" name="cgst[]" style="width: 100%" required style="border:0px"></td>

                        <td><input readonly value="0" class="form-control " type="text" class="small" name="sgst[]" style="width: 100%" required style="border:0px"></td>

                        <td><input readonly value="0" class="form-control " type="text" class="small" name="igst[]" style="width: 100%" required style="border:0px"></td>
                      </tr>


                    </table>
                    <br>
                    <br>


                    <div class="col-md-3" style="float : right">

                      <!-- cgst total -->
                      <label>CGST GST Total</label>
                      <input id="cgstTotal" name="cgstSum" readonly value="0" class="form-control " type="text" class="small" style="width: 100%" required style="border:0px">

                      <!-- sgst total -->
                      <label>SGST GST Total</label>
                      <input id="sgstTotal" name="sgstSum" readonly value="0" class="form-control " type="text" class="small" style="width: 100%" required style="border:0px">

                      <!-- igst total -->
                      <label>IGST GST Total</label>
                      <input id="igstTotal" name="igstSum" readonly value="0" class="form-control " type="text" class="small" style="width: 100%" required style="border:0px">

                      <!-- total gst paid -->
                      <label>GST Total</label>
                      <input id="gstTotal" name="gstSum" readonly value="0" class="form-control " type="text" class="small" style="width: 100%" required style="border:0px">


                    </div>

                    <br>
                    <br>

                    <!-- dynamic close -->
                    <div class="form-group col-md-6 ">
                      <label>Upload Bill Copy</label>
                      <br>
                      <input type="file" multiple name="img[]">

                    </div>

                    <br>
                    <br>
                    <br>

                    <div class=text-center>
                      <button type="submit" class="btn btn-primary btn-rounded btn-fw">Record Bill</button>
                    </div>


                  </form>
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
  <!-- End custom js for this page-->

  <!-- dynamically adding gst slab rows  -->

  <!-- new add row method -->

  <script type="text/javascript">
    window.calc = function(thisRow) {

      var sum = 0;

      var one = thisRow.getElementsByTagName('select')[0].value;

      var two = thisRow.getElementsByTagName('input')[0].value;

      var gst = two * (one / 100);

      //alert(two);

      if (document.getElementById('inside').checked == true) {

        thisRow.getElementsByTagName('input')[2].value = gst / 2;
        thisRow.getElementsByTagName('input')[3].value = gst / 2;

        // cgst sum
        var getamntc = document.getElementById('cgstTotal').value;
        var totalcc = Number(gst / 2) + Number(getamntc);
        document.getElementById('cgstTotal').value = totalcc;
        document.getElementById('sgstTotal').value = totalcc;


        // gst total
        sum += gst;
        var getamnt = document.getElementById('gstTotal').value;
        var total = Number(gst) + Number(getamnt);
        document.getElementById('gstTotal').value = total;

      } else if (document.getElementById('outside').checked == true) {

        thisRow.getElementsByTagName('input')[4].value = gst.toFixed(2);

        // total gst
        sum += gst;
        var getamnt = document.getElementById('gstTotal').value;
        var total = Number(gst) + Number(getamnt);
        document.getElementById('gstTotal').value = total;
        document.getElementById('igstTotal').value = total;

      } else {
        alert("Select State of sale first");
        thisRow.getElementsByTagName('input')[0].value = "0";
      }






    }

    window.addRow = function(tableID) {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;
      if (rowCount < 70) { // limit the user from creating fields more than your limits
        var row = table.insertRow(rowCount);
        var colCount = table.rows[0].cells.length;
        for (var i = 0; i < colCount; i++) {
          var newcell = row.insertCell(i);
          newcell.innerHTML = table.rows[0].cells[i].innerHTML;

        }
      } else {
        alert("Maximum rows allowed are 70.");

      }
    }

    window.deleteRow = function(tableID) {
      try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        if (rowCount > 1) {
          table.deleteRow(rowCount - 1);
        }

      } catch (e) {
        alert(e);
      }
    }
  </script>

  <!-- new add row method close -->





  <script>
    $(document).ready(function() {

      var count = 1;

      dynamic_field(count);

      function dynamic_field(number) {
        html = '<div id="dynamicField" class="form-inline">';
        html += '<select id="gstslab" class="form-control mb-2 mr-sm-2 col-md-1" > <option value=""></option> <option>5</option> <option>12</option> <option>18</option> <option>28</option> </select>';
        html += '<input id="amount" type="text" class="form-control mb-2 mr-sm-2 col-md-2" id="inlineFormInputName2" >';
        html += '<input id="unit" type="text" class="form-control mb-2 mr-sm-2 col-md-1" id="inlineFormInputName2" >';
        html += '<input id="cgst" type="text" class="form-control mb-2 mr-sm-2 col-md-1" id="inlineFormInputName2" >';
        html += '<input id="sgst" type="text" class="form-control mb-2 mr-sm-2 col-md-1" id="inlineFormInputName2" >';
        html += '<input id="igst" type="text" class="form-control mb-2 mr-sm-2 col-md-1" id="inlineFormInputName2" >';

        if (number > 1) {
          html += '<button type="button" name="remove" id="remove" class="btn btn-danger remove"><i class="mdi mdi-minus"></i></button>';
          html += '</div>';
          $('#dynamic').append(html);
        } else {
          html += '<td><button type="button" name="add" id="add" class="btn btn-success"><i class="mdi mdi-plus"></i></button></td></tr>';
          html += '</div>';
          $('#dynamic').html(html);
        }
      }
      //  add new row
      $(document).on('click', '#add', function() {
        count++;
        dynamic_field(count);
      });
      //  removing a row
      $(document).on('click', '.remove', function() {
        count--;
        $(this).closest("#dynamicField").remove();
      });

      // on text change in taxable amouny
      $(".amount").on("input", function() {
        var e = document.getElementById("gstslab");
        var gstslab = e.value;
        var amount = $(this).val();

        var gst = amount * (gstslab / 100);

        document.getElementById("cgst").value = gst / 2;
        document.getElementById("sgst").value = gst / 2;

        //alert(gstslab);
      });


      // calculate gst on text change
      $('input[type=radio]').click(function(e) {

        //var gender = $(this).val();
        //alert(gender);

      });


      // form submission
      $('#dynamic_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({

          method: 'post',
          data: $(this).serialize(),
          dataType: 'json',
          beforeSend: function() {
            $('#save').attr('disabled', 'disabled');
          },
          success: function(data) {
            if (data.error) {
              var error_html = '';
              for (var count = 0; count < data.error.length; count++) {
                error_html += '<p>' + data.error[count] + '</p>';
              }
              $('#result').html('<div class="alert alert-danger">' + error_html + '</div>');
            } else {
              dynamic_field(1);
              $('#result').html('<div class="alert alert-success">' + data.success + '</div>');
            }
            $('#save').attr('disabled', false);
          }
        })
      });

    });
  </script>

  <!-- dynamically adding gst slab rows close  -->


</body>

</html>