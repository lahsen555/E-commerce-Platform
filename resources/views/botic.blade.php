<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vendor</title>
    <link rel="stylesheet" href="{{asset('css/spro.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <script defer src="js/mm.js"></script>
    {{-- <script defer src="js/mm.js"></script> --}}
    {{-- <link href="{{asset('css/user.css')}}" rel="stylesheet" /> --}}
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">
                <a class="navbar-brand" href="#!">
                    <img src="../image/logog.jpg" alt="" style="width:110px; height:55px;">
                  </a>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        @if (Route::has('login'))
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">{{Auth::user()->name }}</a></li>
        @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Log in</a></li>
                   
                @endauth
        @endif
                <li class="nav-item"><a class="nav-link" href="{{ url()->previous() }}">Back</a></li>
            </ul>
        </div>
        </div>
    </nav>
    <div style="background-color: #D9D9D9">

        <div style="margin-top: 20px; background-color: #D9D9D9; text-align: center;">
            <h3 style="text-transform: uppercase;">{{\App\Models\User::find($id)->name}}</h3>
            {{-- <h3>{{\App\Models\User::find($id)->name}}</h3> --}}
        </div>
      
        <section class="py-5" style="background-color: #D9D9D9">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($products as $pro)
                    <div class="col mb-5">
                        <div class="card h-100" style="background-color: #e7f0f7">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="{{asset('imgs/'.$pro->img)}}" />
                            {{-- <img class="card-img-top" src="{{ $url }}" alt="..." /> --}}
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$pro['name']}}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    
                                    {{$pro['price']}} DH
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                {{-- <a class="btn btn-outline-dark mt-auto" href="{{route('product.show', ['product'=>$pro['id']])}}">Consulter</a> --}}
                                <div class="text-center">
                                    <form action="{{route('product.show', $pro->id)}}" method="GET">
                                        @method('POST')
                                        <input type="hidden" name="product_id" value="{{$pro->img}}">
                                        <input type="hidden" name="des" value="{{$pro->desc}}">
                                        <input type="hidden" name="pri" value="{{$pro->price}}">
                                        <input type="hidden" name="name" value="{{$pro->name}}">
                                        <input type="hidden" name="pri" value="{{$pro->price}}">
                                        <input type="hidden" name="pro" value="{{$pro}}">
                                        <input type="hidden" name="vendeur" value="{{\App\Models\User::find($pro->user_id)->name }}">
                                        
                                        <input class="btn btn-outline-dark mt-auto" type="submit" value="Consulter">
                                    </form>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="buttons d-flex flex-row mt-5 gap-3"> <a href="{{route('user', $pro->user_id)}}"><button class="btn btn-outline-dark">Contact </button></a>
                    
                        
                    
                        <a href="{{route('signale.create', ['id' => $pro->user_id])}}"><button class="btn btn-outline-dark">Signaler</button></a>
                        
                        
                    
                    
                </div>
            </div>
        </section>
        <footer style="background-color: rgb(13, 55, 94); height:25px;">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

{{-- we gotta a problem which is the product page we do not know how  --}}

{{-- now we gonna move  --}}
