@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product Create') }}</div>
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="content">
                            <div class="content-header">
                                <button class="btn btn-primary float-end" type="submit" >Save product</button>
                            </div>
                            <hr>
                            <br>
                            <div class="content-body">
                                @csrf
                                    <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-3">
                                    <label for="rpice" class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control  @error('price') is-invalid @enderror" id="rpice">
                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="UPS" class="form-label">UPC</label>
                                        <input type="number" minlength="12" maxlength="12" name="upc" class="form-control @error('upc') is-invalid @enderror" id="UPS">
                                        @error('upc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="UPS" class="form-label">IMAGE</label>
                                        <input type="file" minlength="12" name="image" class="form-control @error('image') is-invalid @enderror" id="UPS">
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" checked>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">STATUS</label>
                                        </div>
                                    </div>
                                    
                            
                            </div>
                        </div>
                    </div>
                </form>
            </div>

           
        </div>
    </div>
</div>
@endsection