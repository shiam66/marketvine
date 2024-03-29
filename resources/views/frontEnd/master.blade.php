<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}" />

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('frontEnd/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('frontEnd/assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('frontEnd/assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/assets/vendor/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for our style -->
    <link href="{{asset('frontEnd/assets/custome.css')}}" rel="stylesheet">

    @yield('css')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
@include('frontEnd.includes.menu')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
        @include('frontEnd.includes.topBar')

        <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('mainContent')
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Marketvine Ltd. 2022</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('frontEnd/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('frontEnd/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('frontEnd/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('frontEnd/assets/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('frontEnd/assets/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('frontEnd/assets/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('frontEnd/assets/js/demo/chart-pie-demo.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('frontEnd/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('frontEnd/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('frontEnd/assets/vendor/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('frontEnd/assets/js/demo/datatables-demo.js')}}"></script>

@yield('script')

<script>
    @if(session('message'))
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: "Success",
        text: "{{ session('message') }}",
        showConfirmButton: false,
        timer: "1500",
    });
    @endif

    @if(session('updateMessage'))
    Swal.fire({
        position: 'top-end',
        title: "Updated !",
        text: "{{ session('updateMessage') }}",
        icon: "info",
        timer: "1500",
        showConfirmButton: false,
    });
    @endif

    @if(session('deleteMessage'))
    Swal.fire({
        position: 'top-end',
        title: "Deleted !",
        text: "{{ session('deleteMessage') }}",
        icon: "error",
        timer: "1500",
        showConfirmButton: false,
    });
    @endif

</script>
</body>
</html>
