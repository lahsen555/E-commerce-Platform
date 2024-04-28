


<html>

<head>
    <style>
        .switch {
          position: relative;
          display: inline-block;
          width: 60px;
          height: 34px;
        }
        
        .switch input { 
          opacity: 0;
          width: 0;
          height: 0;
        }
        
        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }
        
        .slider:before {
          position: absolute;
          content: "";
          height: 26px;
          width: 26px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }
        
        input:checked + .slider {
          background-color: #2196F3;
        }
        
        input:focus + .slider {
          box-shadow: 0 0 1px #2196F3;
        }
        
        input:checked + .slider:before {
          -webkit-transform: translateX(26px);
          -ms-transform: translateX(26px);
          transform: translateX(26px);
        }
        
        /* Rounded sliders */
        .slider.round {
          border-radius: 34px;
        }
        
        .slider.round:before {
          border-radius: 50%;
        }
        </style>
<link rel="stylesheet" href="../css/stylesheet.css">

    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.4/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>
    
    <div id="wrapper">

        

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">
                    @if (Auth::user()->sell == 'yes')
                        Vendor
                    @else
                        Client
                    @endif
                    <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            
            <!-- Nav Item - Tables -->

            @if (Auth::user()->sell == 'yes')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Products</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Products : </h6>
                        <a class="collapse-item" href="{{route('product.create')}}">Add Product</a>
                        <a class="collapse-item" href="{{route('product.index')}}">Show Products</a>
                    </div>
                </div>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="{{route('profile.edit')}}">
                    <i class="fas fa-fw  fa-user"></i>
                    <span>Profile</span></a>
            </li>
            

            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('my-form').submit();">
                    <i class="fas fa-fw fa-outdent"></i>
                    <span>Logout</span></a>
            </li>

            

            <form id="my-form" action="{{route('logout')}}" method="POST" style="display: none;">
                @csrf
            </form>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            
                        </li>


                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                                
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('profile.edit')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('my-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Products</h1>
                    <p class="mb-4">This is a table for managing your products </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Products Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>City</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Start date</th>
                                            <th>Description</th>
                                            <th colspan="2">Action</th>
                                            <th>Selled</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>City</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Start date</th>
                                            <th>Description</th>
                                            <th colspan="2">Action</th>
                                            <th>Selled</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        

                                        @foreach ($products as $pro)
                                                    <tr>
                                                        <td >{{$pro['name']}}</td>
                                                        <td >{{$pro['origin']}}</td>
                                                        <td >{{$pro['price']}}</td>
                                                        <td >{{$pro['category']}}</td>
                                                        <td >{{$pro->created_at}}</td>
                                                        <td >{{$pro['desc']}}</td>
                                                        <td ><a href="{{ route('product.edit', $pro->id) }}">
                                                            <button type="submit" style="font-family: monospace;
                                                                border: none;
                                                                background-color: rgb(125, 240, 72);
                                                                font-size: 17px;
                                                                padding: 5px;">Update</button>
                                                        </a></td>
                                                        <td >
                                                            <form action="{{ route('product.destroy', $pro->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" style="font-family: monospace;
                                                                border: none;
                                                                background-color: coral;
                                                                font-size: 17px;
                                                                padding: 5px;">Delete</button>
                                                                
                                                                
                                                            </form>            
                                                        </td>
                                                        <td>
                                                            <a href="{{route('product.index', $pro->id)}}">
                                                            <label class="switch"> 
                                                                <input type="checkbox" name="vend" id="toggleFormCheckbox">
                                                                <span class="slider round"></span>
                                                              </label>
                                                              </a>

                                                              {{-- <form id="myForm" action="{{route('statistic', $pro->id)}}" method="GET" style="display: none;">
                                                                <!-- Your form inputs here -->
                                                                <button type="submit">Submit</button>
                                                              </form> --}}
                                                            <script>
                                                                $(document).ready(function() {
                                                                    $('#toggleFormCheckbox').change(function() {
                                                                        if ($(this).is(':checked')) {
                                                                            $('#myForm').submit();
                                                                        } 
                                                                    });
                                                                    });

                                                                // Retrieve the checkbox element
                                                                var checkbox = document.getElementById('toggleFormCheckbox');

                                                                // Check if a cookie exists
                                                                var isChecked = getCookie('checkboxChecked');

                                                                // Set the checkbox state based on the cookie value
                                                                if (isChecked === 'true') {
                                                                checkbox.checked = true;
                                                                }

                                                                // Add an event listener to the checkbox
                                                                checkbox.addEventListener('change', function() {
                                                                // Set the cookie value based on the checkbox state
                                                                setCookie('checkboxChecked', this.checked);
                                                                });

                                                                // Function to set a cookie
                                                                function setCookie(name, value) {
                                                                document.cookie = name + '=' + value + '; path=/;';
                                                                }

                                                                // Function to retrieve a cookie value
                                                                function getCookie(name) {
                                                                var cookies = document.cookie.split(';');
                                                                for (var i = 0; i < cookies.length; i++) {
                                                                    var cookie = cookies[i].trim();
                                                                    if (cookie.startsWith(name + '=')) {
                                                                    return cookie.substring(name.length + 1);
                                                                    }
                                                                }
                                                                return '';
                                                                }
                                                            </script>
                                                        </td>
                                                    </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    

   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="js/sb-admin-2.min.js"></script>

   <!-- Page level plugins -->
   <script src="vendor/datatables/jquery.dataTables.min.js"></script>
   <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="js/demo/datatables-demo.js"></script>

</body>
</html>





