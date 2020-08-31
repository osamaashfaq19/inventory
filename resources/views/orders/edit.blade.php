<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Orders</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  
    @include('includes/header')
    @include('includes/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= url('')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= url('orders')?>">Orders</a></li>
              <li class="breadcrumb-item active">Edit Orders</li>
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" style='font-size:22px;'>Edit Orders</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method='post' action='{{ url("orders/update/<?= $order->order_id?>") }}' id="store_form">
               {{ @csrf_field() }}
                <div class="card-body">
                  
                  <div class='container'>
                  <div class='row'>
                    
                   <div class='col-lg-4'>
                        <div class="form-group">
                            <label for="date">Date*</label>
                            <input type='date' value='<?= $order->order_date?>' name='date' class='form-control' readonly />
                        </div>
                    </div>

                    <div class='col-lg-8'>
                        <div class="form-group">
                            <label for="store_id">Store*</label>
                            <select class='form-control select2' id='store_id' name='store_id'>
                                <option value=''>Select Store</option>
                                <?php
                                                foreach($stores as $store){
                                            ?>
                                                <option <?= ($order->store_id == $store->store_id ? 'selected' : '')?>  value='<?= $store->store_id?>'><?= $store->store_name?></option>
                                            <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class='col-lg-12'>
                        <table class='table table-bordered order-list'>
                            <thead>
                                <tr>
                                    <th> Product </th>
                                    <th> Quantity </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                               $counter = 0;
                                foreach($order_details as $detail){
                            ?>
                                <tr>
                                    <td> 
                                        <select class='form-control select2' id='product_id_<?=$counter ?>' name='product_id[]'>
                                            <option value=''>Select Product</option>
                                            <?php
                                             
                                                foreach($products as $product){
                                               
                                            ?>
                                                
                                                <option <?= ($detail->product_id == $product->product_id ? 'selected' : '')?> value='<?= $product->product_id ?>'><?= $product->product_name?></option>
                                            <?php } ?>
                                        </select> 
                                    </td> 

                                    <td> 
                                        <input type='text' id="quantity_<?=$counter ?>" placeholder='Enter Quantity' value='<?=$detail->quantity ?>' name='quantity[]' class='form-control'  />
                                    </td> 
                                    <td>
                                        <button type='button' data-id='<?=$counter ?>' class='append_button btn btn-primary btn-sm'><i class='fa fa-plus'></i> </button>
                                        <button type='button' data-id='<?=$counter ?>'  class='ibtnDel btn btn-danger btn-sm'><i class='fa fa-trash'></i> </button>
                                    </td>
                                </tr>
                                <?php  $counter++;  } ?>
                            </tbody>
                        </table>
                    </div> 
    
                    <div class='col-lg-12'>
                        <button type="submit" style='float:right' class="btn btn-primary pull-right">Save Store</button>
                    </div>

                    </div>
                  </div>
                  
                </div>
               
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @include('includes/footer')
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function (form) {
        form.submit();
    }
  });
  $('#store_form').validate({
    rules: {
      store_id: {
        required: true
      },
      "product_id[]": {
        required: true
      },
      "quantity[]": {
          required: true,
          number:true
      },
    },
   
  });
});

$(document).ready(function (){
    var counter = 1; 
    var cols="";
    

    $(document).on('click',".append_button", function(){
        var newRow = $("<tr>");
        counter++;
        cols+="<td> <select class='form-control select2' id='product_id_"+counter+"' name='product_id[]'>";
        cols+="<option value=''>Select Product</option>";
        <?php
              foreach($products as $product){?>
            cols+="<option value='<?= $product->product_id?>'><?= $product->product_name?></option>";
        <?php } ?>
        cols+="</select> </td>";
        cols+="<td> <input type='text' value='' placeholder='Enter Quantity' name='quantity[]' id='quantity_"+counter+"' class='form-control'  /></td>";
        cols+="<td>";
        cols+="<button type='button' data-id='"+counter+"' class='append_button btn btn-primary btn-sm'><i class='fa fa-plus'></i> </button> &nbsp;";
        cols+="<button type='button' data-id='"+counter+"' class='ibtnDel btn btn-danger btn-sm'><i class='fa fa-trash'></i> </button> ";
        cols+="</td>";
        cols+="</tr>";
        newRow.append(cols);
        
        $("table.order-list").append(newRow);
    });
    
	$("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});

</script>
</body>
</html>
