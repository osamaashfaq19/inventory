<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Products</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
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
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

            <?php
                      if(Session::has('success')){
                    ?>
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                      <?php } ?>

                      
                  <?php
                      if(Session::has('error')){
                    ?>
                    <div class="alert alert-info" role="alert">
                        {{ session('error') }}
                    </div>
                      <?php } ?>

                    <div class="card-header">
                        <div class='container'>
                            <div class='row'>
                                <div class='col-lg-6'>
                                    <h3 class="card-title" style='font-size:22px;'>All Products</h3>
                                </div>
                                <div class='col-lg-6'>
                                    <a href="<?= url('products/add')?>" class="btn btn-primary btn-sm float-right"><i class='fa fa-plus'></i> Add Products</a>
                                </div>
                                </div>
                        </div>
                   
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>S.no</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>TP</th>
                    <th>Trade Dis</th>
                    <th>Scheme Dis</th>
                    <th>Net Price</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                 <tbody>
                    <?php
                        $sno=1;
                        foreach($products as $product){?>
                        <tr>
                            <td><?=  $sno?></td>
                            <td><?=  $product->product_name?></td>
                            <td><?=  $product->price?></td>
                            <td><?=  $product->trade_price?></td>
                            <td><?=  $product->trade_discount?></td>
                            <td><?=  $product->scheme_discount?></td>
                            <td><?=  $product->total_product_price?></td>
                            <td>
                                <a href='javascript:void(0)' onclick='delete_store(<?= $product->product_id?>)' class='btn btn-danger btn-sm' >Delete</a>
                                <a href='<?= url('products/edit/'.$product->product_id)?>' class='btn btn-primary btn-sm'>Edit</a>
                            </td> 
                        </tr>
                    <?php $sno++;  } ?>
                 </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @include('includes/footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- page script -->
<script>

    function delete_store(id){
        if(confirm('Are you sure you want to delete?')){
            window.location.href='<?= url('products/delete')?>/'+id;
        }
    }

  $(function () {
    $("#example1").DataTable({
        "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>
</body>
</html>
