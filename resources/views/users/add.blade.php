<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Users</title>
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
              <li class="breadcrumb-item"><a href="<?= url('users')?>">Users</a></li>
              <li class="breadcrumb-item active">Add Users</li>
              
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
                <h3 class="card-title" style='font-size:22px;'>Add Users</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method='post' action='{{ url("users/save") }}' id="store_form">
               {{ @csrf_field() }}
                <div class="card-body">
                  
                  <div class='container'>
                  <div class='row'>
                    <div class='col-lg-4'>
                        <div class="form-group">
                            <label for="store_name">Fullname*</label>
                            <input type="text" name="fullname" id='fullname' class="form-control" placeholder="Enter Fullname">
                        </div>
                    </div>

                    <div class='col-lg-4'>
                        <div class="form-group">
                            <label for="street">Email*</label>
                            <input type="text" name="email" id='email' class="form-control" placeholder="Enter Email">
                        </div>
                    </div>

                    <div class='col-lg-4'>
                        <div class="form-group">
                            <label for="area">Password*</label>
                            <input type="text" name="password" id='password' class="form-control" placeholder="Enter Password">
                        </div>
                    </div>

                    <div class='col-lg-4'>
                        <div class="form-group">
                            <label for="phone">Phone no.</label>
                            <input type="text" name="phone" id='phone' class="form-control" placeholder="Enter Phone">
                        </div>
                    </div>

                    <div class='col-lg-4'>
                        <div class="form-group">
                            <label for="user_type">Usertype</label>
                            <select  name="user_type" id='user_type' class="form-control" placeholder="Enter Usertype">
                                <option>Select Usertype</option>
                                <option value='admin'>Admin</option>
                                <option value='booker'>Booker</option>
                            </select>
                        </div>
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
<script type="text/javascript">
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function (form) {
        form.submit();
    }
  });
  $('#store_form').validate({
    rules: {
      fullname: {
        required: true
      },
      email: {
          required: true
          email:true
      },
      password: {
        required: true
      },
      user_type: {
        required: true
      }
    
    },
   
  });
});
</script>
</body>
</html>
