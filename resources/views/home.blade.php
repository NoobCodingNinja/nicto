@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="content">
                        <div class="content-header">
                            <a class="btn btn-primary float-end" href="{{route('product.create')}}">Create product</a>
                        </div>
                        <hr>
                        <br>
                        <div class="content-body">
                            <table class="table table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>NAME </th>
                                    <th>Image</th>
                                    <th>PRICE</th>
                                    <th>UPS</th>
                                    <th>STATUS</th>
                                    <th>action</th>
                                    <th ><button class="btn btn-danger multidelete">Delete Selected</button></th>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->name}}</td>
                                            <td> <img class="img-fluid"  width="50px" src="{{asset('storage/'.$product->image)}}" alt=""> </td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->upc}}</td>
                                            <td>{{$product->status}}</td>
                                            <td><a href="{{route('product.edit', $product->id)}}" class="btn btn-warning">Edit</a> <a href="{{route('product.delete', $product->id)}}" class="btn btn-danger">Delete</a></td>

                                            <td><div class="form-check">
                                                <input class="form-check-input multicheck" type="checkbox" on-click="selectProduct()" value="{{$product->id}}" >
                                              </div></td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let productIds = [];
    document.querySelectorAll('.multicheck').forEach(function(check) {
        
    check.addEventListener('click', function () {
            if (event.target.checked) {
                productIds.push(event.target.value)

                if (! document.querySelector('.multidelete').hasAttribute('style')) {
                    document.querySelector('.multidelete').setAttribute('style', ['display:block'])
                }
            }
         })
    })

    document.querySelector('.multidelete').addEventListener('click', function() {
        
        axios.post("{{route('product.multidelete')}}", {
           productIds
        })
        .then(function (response) {
            // handle success
           if(response.status == 200) {
               window.location.reload()
           }
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });
    })

</script>
@endsection
