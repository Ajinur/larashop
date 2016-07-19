<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Larashop</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {!! Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') !!}

    {!! Html::style('assets/backend/bootstrap/css/bootstrap.min.css') !!}

    {!! Html::style('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') !!}

    {!! Html::style('assets/backend/dist/css/AdminLTE.min.css') !!}

    {!! Html::style('assets/backend/dist/css/skins/_all-skins.min.css') !!}

    {!! Html::style('assets/backend/plugins/datatables/dataTables.bootstrap.css') !!}

    {!! Html::style('assets/backend/plugins/iCheck/flat/blue.css') !!}

    {!! Html::style('assets/backend/plugins/datepicker/datepicker3.css') !!}

    {!! Html::style('assets/backend/plugins/daterangepicker/daterangepicker-bs3.css') !!}

    {!! Html::style('assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}

  </head>

  

  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

      <header class="main-header">

        <a href="{{ url('admin/home') }}" class="logo">

          <span class="logo-mini"><b>L</b>RS</span>

          <span class="logo-lg"><b>Lara</b>SHOP</span>

        </a>

        <nav class="navbar navbar-static-top" role="navigation">

          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

            <span class="sr-only">Toggle navigation</span>

          </a>

          <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

              @include('includes.notification')



              <li class="dropdown user user-menu">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  {!! Html::image('assets/backend/dist/img/user2-160x160.jpg', '', ['class' => 'user-image']) !!}

                  <span class="hidden-xs">{{ Sentinel::getUser()->first_name .' '. Sentinel::getUser()->last_name }}</span>

                </a>

                <ul class="dropdown-menu">

                  <li class="user-header">

                    {!! Html::image('assets/backend/dist/img/user2-160x160.jpg', '', ['class' => 'img-circle']) !!}

                    <p>

                      {{ Sentinel::getUser()->first_name .' '. Sentinel::getUser()->last_name }}

                      <small>Member since Nov. 2012</small>

                    </p>

                  </li>

                  

                  <li class="user-footer">

                    <div class="pull-left">

                      <a href="{{ url('profile') }}" class="btn btn-default btn-flat">Profile</a>

                    </div>

                    <div class="pull-right">

                      <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Sign out</a>

                    </div>

                  </li>

                </ul>

              </li>

            </ul>

          </div>

        </nav>

      </header>

      @include('includes.sidebar')



      <div class="content-wrapper">

        <section class="content">

        @yield('content')  

        </section>

      </div>



      <footer class="main-footer">

        <strong>Copyright &copy; {{ date('Y') }} <a href="#">Larashop</a>.</strong>

      </footer>

      <div class="control-sidebar-bg"></div>

    </div>

    {!! Html::script('assets/backend/plugins/jQuery/jQuery-2.1.4.min.js') !!}

    {!! Html::script('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js') !!}

    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>

    {!! Html::script('assets/backend/bootstrap/js/bootstrap.min.js') !!}

    {!! Html::script('assets/backend/plugins/datatables/jquery.dataTables.min.js') !!}

    {!! Html::script('assets/backend/plugins/datatables/dataTables.bootstrap.min.js') !!}

    {!! Html::script('assets/backend/plugins/daterangepicker/daterangepicker.js') !!}

    {!! Html::script('assets/backend/plugins/datepicker/bootstrap-datepicker.js') !!}

    {!! Html::script('assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}

    {!! Html::script('assets/backend/dist/js/app.min.js') !!}

    {!! Html::script('assets/backend/dist/js/demo.js') !!}

    {!! Html::script('https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js') !!}

    {!! Html::script('assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}

    <script>
      $(function () {
        //$("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    <script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>

  </body>

</html>

