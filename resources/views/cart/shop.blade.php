<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Shop')}}
        </h2>

    </x-slot>

    <div class="container-fluid">

        <div class="row">
            @if ($message = Session::get('success'))
                <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                    <strong>{{$message}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
          @foreach ($products as $product)
          <div class="col-md-3 col-10 mt-5">
            <div class="card product-item">
              <img class="card-img-top img-thumbnail mx-auto" src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img5.webp" alt="Yail wrist watch">
              <div class="card-body">
                <h5 class="card-title font-weight-bold">{{$product->name}}</h5>
                <p class="card-text">{{$product->price}} XAF</p>
                <p class="card-text">{{$product->description}} XAF</p>
                <a href="{{route('add-to-cart', $product->id)}}" class="btn btn-success btn-cart px-auto mt-2">Add to cart</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
</x-app-layout>
