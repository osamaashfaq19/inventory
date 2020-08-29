
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Products</title>
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
              <li class="breadcrumb-item"><a href="<?= url('products')?>">Products</a></li>
              <li class="breadcrumb-item active">Edit Products</li>
              
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
                <h3 class="card-title" style='font-size:22px;'>Edit Products</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method='post' action='{{ url("products/update") }}/<?= $products->product_id?>' id="store_form">
               {{ @csrf_field() }}
                <div class="card-body">
                  
                  <div class='container'>
                  <div class='row'>
                    <div class='col-lg-6'>
                        <div class="form-group">
                            <label for="store_name">Product name*</label>
                            <input type="text" name="product_name" id='product_name' value="<?= $products->product_name?>" class="form-control" placeholder="Enter Product Name">
                        </div>
                    </div>

                    <div class='col-lg-6'>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" id='price' value="<?= $products->price?>" class="form-control" placeholder="Enter Price">
                        </div>
                    </div>

                    <div class='col-lg-6'>
                        <div class="form-group">
                            <label for="area">Trade Price</label>
                            <input type="text" name="trade_price" id='trade_price' value="<?= $products->trade_price?>" class="form-control" placeholder="Enter Trade Price">
                        </div>
                    </div>

                    <div class='col-lg-6'>
                        <div class="form-group">
                            <label for="phone">T.O</label>
                            <input type="text" name="t_o" id='t_o' class="form-control" value="<?= $products->t_o?>" placeholder="Enter T.O">
                        </div>
                    </div>

                    <div class='col-lg-3'>
                        <div class="form-group">
                            <label for="trade_discount">Trade Discount in Amount</label>
                            <input type="text"  name="trade_discount" id='trade_discount' value="<?= ($products->trade_discount_percent > 0 ? 0 : $products->trade_discount)?>" class="form-control" placeholder="Enter Trade Discount">
                        </div>
                    </div>
                    
                    <div class='col-lg-3'>
                        <div class="form-group">
                            <label for="trade_discount">Trade Discount in (%)</label>
                            <input type="text" name="trade_discount_percent" id='trade_discount_percent' value="<?= $products->trade_discount_percent?>" class="form-control" placeholder="Enter Trade Discount in Percent">
                        </div>
                    </div>

                    
                    <div class='col-lg-6'>
                        <div class="form-group">
                            <label for="scheme_discount">Scheme Discount</label>
                            <input type="text"  name="scheme_discount" id='scheme_discount' class="form-control" value="<?= $products->scheme_discount?>" placeholder="Enter Scheme Discount">
                        </div>
                    </div>

                    <div class='col-lg-12'>
                        <button type="submit" style='float:right' class="btn btn-primary pull-right">Update Product</button>
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
<script type="text/javascript">
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function (form) {
        form.submit();
    }
  });
  $('#store_form').validate({
    rules: {
      product_name: {
        required: true
      },
      price: {
          required:true,
          number:true
      },
      trade_price: {
          required:true,
          number:true
      },
      trade_discount: {
          required:true,
          number:true
      },
      scheme_discount: {
          required:true,
          number:true
      }
      
    },
   
  });
});

$('#trade_discount').keydown(function (){
    $('#trade_discount_percent').val(0);
});

$('#trade_discount_percent').keydown(function (){
    $('#trade_discount').val(0);
});


</script>
</body>
</html>
