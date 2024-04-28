
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

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
        {{-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> --}}
        <link href="css/main.css" rel="stylesheet" />

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
            @if (Auth::user()->sell == 'yes')
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
                
            @endif


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

            <li class="nav-item">
                <a class="nav-link" href="{{route('user', Auth::user()->id)}}">
                    <i class="fas fa-fw fa-comment"></i>
                    <span>Chats</span></a>
            </li>

            
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
                <a class="nav-link" href="{{route('liked')}}" >
                    <i class="fas fa-fw fa-heart"></i>
                    <span>Liked</span></a>
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
                    <span id="page-top"></span>
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
                <div class="container-fluid" style="display:flex; overflow:scroll; height:100%;">

                    
                        
                        
                    @foreach (DB::table('products')->whereIn('id', DB::table('likes')->where('user_id', Auth::user()->id)->pluck('likeable_id'))->get() as $pro)
                    <div class="col mb-5" >
                        <div class="card h-10" style="background-color: #ffffff; width:300px; height:300px;">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="{{asset('imgs/'.$pro->img)}}" />
                            {{-- <img class="card-img-top" src="{{ $url }}" alt="..." /> --}}
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$pro->name}}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                      @if(DB::table('likes')->where('likeable_id', $pro->id)->count() == 0)
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        @elseif (DB::table('likes')->where('likeable_id', $pro->id)->count() == 1)
                                            <div class="bi-star-fill"></div>
                                          <div class="bi-star-fill"></div>
                                          <div class="bi-star-fill"></div>
                                        @else
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                      @endif

                                      
                                    </div>
                                    <!-- Product price-->

                                    
                                    {{$pro->price}} DH

                                    {{-- <br><br> --}}
                                    {{-- <img src="../image/time.png" alt="" style="width: 25px; height:25px; margin-right:5px"> --}}
                                    {{-- {{ $pro->created_at->diffForHumans() }} --}}

                                    <br><br>
                                    <img src="../image/loc.webp" alt="" style="width: 25px; height:25px; margin-right:5px">
                                    {{ $pro->origin}}
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                {{-- <a class="btn btn-outline-dark mt-auto" href="{{route('product.show', ['product'=>$pro['id']])}}">Consulter</a> --}}
                                <div class="text-center">
                                    <form action="{{route('product.show', $pro->id)}}" method="GET" style="position: relative;top: 150px;">
                                        @method('POST')
                                        <input type="hidden" name="product_id" value="{{$pro->img}}">
                                        <input type="hidden" name="des" value="{{$pro->desc}}">
                                        <input type="hidden" name="pri" value="{{$pro->price}}">
                                        <input type="hidden" name="name" value="{{$pro->name}}">
                                        <input type="hidden" name="pri" value="{{$pro->price}}">
                                        <input type="hidden" name="pro" value="{{$pro->id}}">
                                        <input type="hidden" name="vendeur" value="{{\App\Models\User::find($pro->user_id)->name }}">
                                        
                                        <input class="btn btn-outline-dark mt-auto" type="submit" value="Consulter">
                                    </form>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                       

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            {{-- so for the normal user which is the client we are not going to use the dashboard --}}
            {{-- we will only use the other things , the dropdown , but can we know that the use easy  --}}

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

    


