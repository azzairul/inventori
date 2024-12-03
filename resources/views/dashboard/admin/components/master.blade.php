<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('/dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">G-INVENTORY</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

          <!-- Nav Item - Dashboard -->
<li class="nav-item {{ request()->is('admin-dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="/admin-dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ request()->is('admin-dashboard/users') || request()->is('admin-dashboard/kategori') || request()->is('admin-dashboard/barang') || request()->is('admin-dashboard/master-karyawan') ? 'active' : '' }}">
                <a class="nav-link {{ request()->is('admin-dashboard/users') || request()->is('admin-dashboard/kategori') || request()->is('admin-dashboard/barang') || request()->is('admin-dashboard/master-karyawan') ? '' : 'collapsed' }}" 
                    href="#" 
                    data-toggle="collapse" 
                    data-target="#collapseTwo" 
                    aria-expanded="{{ request()->is('admin-dashboard/users') || request()->is('admin-dashboard/kategori') || request()->is('admin-dashboard/barang') || request()->is('admin-dashboard/master-karyawan') ? 'true' : 'false' }}" 
                    aria-controls="collapseTwo">
                    <i class="fas fa-folder-open"></i> <!-- Menggunakan ikon folder terbuka -->
                    <span>Data Master</span>
                </a>
                <div id="collapseTwo" class="collapse {{ request()->is('admin-dashboard/users') || request()->is('admin-dashboard/kategori') || request()->is('admin-dashboard/barang') || request()->is('admin-dashboard/master-karyawan') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data List :</h6>
                        <a class="collapse-item {{ request()->is('admin-dashboard/master-karyawan') ? 'active' : '' }}" href="/admin-dashboard/master-karyawan">
                            <i class="fas fa-users"></i> <!-- Ikon untuk karyawan -->
                            Master Karyawan
                        </a>
                        <a class="collapse-item {{ request()->is('admin-dashboard/kategori') ? 'active' : '' }}" href="/admin-dashboard/kategori">
                            <i class="fas fa-tags"></i> <!-- Ikon untuk kategori -->
                            Kategori
                        </a>
                        <a class="collapse-item {{ request()->is('admin-dashboard/barang') ? 'active' : '' }}" href="/admin-dashboard/barang">
                            <i class="fas fa-box"></i> <!-- Ikon untuk barang -->
                            Barang
                        </a>
                        <a class="collapse-item {{ request()->is('admin-dashboard/users') ? 'active' : '' }}" href="/admin-dashboard/users">
                            <i class="fas fa-user-circle"></i> <!-- Ikon untuk users -->
                            User
                        </a>
                    </div>
                </div>
            </li>

                                <!-- Menu Navigasi - Menu Pengajuan -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProcess"
                            aria-expanded="true" aria-controls="collapseProcess">
                            <i class="fas fa-file-alt"></i> <!-- Ikon dokumen untuk Pengajuan -->
                            <span>Pengajuan</span>
                        </a>
                        <div id="collapseProcess" class="collapse" aria-labelledby="headingProcess"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Custom Pengajuan:</h6>
                                <a class="collapse-item" href="peminjaman.html">
                                    <i class="fas fa-handshake"></i> <!-- Ikon handshake untuk Peminjaman -->
                                    Peminjaman
                                </a>
                                <a class="collapse-item" href="pengembalian.html">
                                    <i class="fas fa-undo-alt"></i> <!-- Ikon undo untuk Pengembalian -->
                                    Pengembalian
                                </a>
                            </div>
                        </div>
                    </li>


                            <!-- Menu Navigasi - Menu Arsip -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArchive"
                            aria-expanded="true" aria-controls="collapseArchive">
                            <i class="fas fa-archive"></i> <!-- Ikon arsip untuk menu utama Arsip -->
                            <span>Arsip</span>
                        </a>
                        <div id="collapseArchive" class="collapse" aria-labelledby="headingArchive"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Custom Arsip:</h6>
                                <a class="collapse-item" href="dokumentasi.html">
                                    <i class="fas fa-camera"></i> <!-- Ikon kamera untuk Dokumentasi -->
                                    Dokumentasi
                                </a>
                                <a class="collapse-item" href="kategori-dokumentasi.html">
                                    <i class="fas fa-folder"></i> <!-- Ikon folder untuk Kategori Dokumentasi -->
                                    Kategori Dokumentasi
                                </a>
                                <a class="collapse-item" href="dokumen.html">
                                    <i class="fas fa-file-alt"></i> <!-- Ikon dokumen untuk Dokumen -->
                                    Dokumen
                                </a>
                                <a class="collapse-item" href="kategori-dokumen.html">
                                    <i class="fas fa-folder-open"></i> <!-- Ikon folder terbuka untuk Kategori Dokumen -->
                                    Kategori Dokumen
                                </a>
                            </div>
                        </div>
                    </li>



                                    <!-- Nav Item - Reports Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports"
                            aria-expanded="true" aria-controls="collapseReports">
                            <i class="fas fa-chart-line"></i> <!-- Ikon grafik garis untuk Laporan -->
                            <span>Laporan</span>
                        </a>
                        <div id="collapseReports" class="collapse" aria-labelledby="headingReports"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Laporan Proses:</h6>
                                <a class="collapse-item" href="laporan-peminjaman.html">
                                    <i class="fas fa-file-contract"></i> <!-- Ikon dokumen kontrak untuk Laporan Peminjaman -->
                                    Laporan Peminjaman
                                </a>
                                <a class="collapse-item" href="laporan-pengembalian.html">
                                    <i class="fas fa-clipboard-check"></i> <!-- Ikon clipboard dengan cek untuk Laporan Pengembalian -->
                                    Laporan Pengembalian
                                </a>
                            </div>
                        </div>
                    </li>

           



           
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                   
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
            
                @yield('content')
            </div>

            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; G-INVENTORY 2024</span>
                    </div>
                </div>
            </footer>

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
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('/dashboard/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript -->
<script src="{{ asset('/dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages -->
<script src="{{ asset('/dashboard/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('/dashboard/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/dashboard/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('/dashboard/js/demo/chart-pie-demo.js') }}"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
       @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
</script>
</body>

</html>