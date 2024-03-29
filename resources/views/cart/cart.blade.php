<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Cart')}}
        </h2>
        <section class="h-100 h-custom" style="background-color: #d2c9ff;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                  <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                                    <strong>{{$message}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                    <div class="card-body p-0">
                      <div class="row g-0">
                        <div class="col-lg-8">
                          <div class="p-5">
                            <div class="d-flex justify-content-between align-items-center mb-5">
                              <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                              <h6 class="mb-0 text-muted">n item(s)</h6>
                            </div>
                            <hr class="my-4">

                            @foreach (Cart::content() as $product)
                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                  <img
                                    src="{{asset($product->options->image)}}"
                                    class="img-fluid rounded-3" alt="Cotton T-shirt">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                  <h6 class="text-muted mb-2 mt-2">{{$product->name}}</h6>
                                  <h6 class="text-black mb-2">Cotton T-shirt</h6>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                  {{-- <button class="btn btn-link px-2"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                    <i class="fas fa-minus"></i>
                                  </button> --}}

                                  <a href="{{route('qty-decrement', $product->rowId)}}" class="btn btn-primary me-2">
                                    &#8722;
                                  </a>

                                  <div class="form-outline">
                                    <input id="form1" min="0" name="quantity" value="{{$product->qty}}" type="number"
                                    class="form-control form-control-sm" />

                                  </div>
                                    <a href="{{route('qty-incremet', $product->rowId)}}" class="btn btn-primary ms-2">
                                        &#43;
                                    </a>
                                  {{-- <button class="btn btn-link px-2"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                    <i class="fas fa-plus"></i>
                                  </button> --}}
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1 mt-2">
                                  <h6 class="mb-0">XAF{{$product->price}}</h6>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                  <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <a href="{{route('remove-product', $product->rowId)}}" class="btn btn-danger">Remove</a>
                                </div>
                              </div>
                              <hr class="my-4">
                            @endforeach

                            <form action="{{route('paypal.payment')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$product->price}}" name="price">
                                <button type="submit" class="btn btn-primary bg-black"
                                >Buy Now With Paypal</button>
                            </form>
                            <form action="{{route('flutterwave.pay')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$product->price}}" name="product_price">
                                <button type="submit" class="btn btn-primary bg-black mt-2"
                                >Buy Now With Mobile Money</button>
                            </form>

                          </div>
                        </div>
                        <div class="col-lg-4 bg-grey">
                          {{-- <div class="p-5">
                            <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                            <hr class="my-4">

                            <div class="d-flex justify-content-between mb-4">
                              <h5 class="text-uppercase">items 3</h5>
                              <h5>€ 132.00</h5>
                            </div>

                            <h5 class="text-uppercase mb-3">Shipping</h5>

                            <div class="mb-4 pb-2">
                              <select class="select">
                                <option value="1">Standard-Delivery- €5.00</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                <option value="4">Four</option>
                              </select>
                            </div>

                            <h5 class="text-uppercase mb-3">Give code</h5>

                            <div class="mb-5">
                              <div class="form-outline">
                                <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                                <label class="form-label" for="form3Examplea2">Enter your code</label>
                              </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between mb-5">
                              <h5 class="text-uppercase">Total price</h5>
                              <h5>€ 137.00</h5>
                            </div> --}}

                            {{-- <button type="button" class="btn btn-primary bg-black"
                            >Buy Now</button> --}}

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </x-slot>
</x-app-layout>
