@extends('inventory.layout')
@section('title', 'Add Product')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-headphones bg-blue"></i>
                        <div class="d-inline">
                            <h5>Add Product</h5>
                            <span>Add new product in inventory</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('product/store') }}">Add Product</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <form enctype="multipart/form-data" class="forms-sample" method="POST" action="{{ route('product.store') }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="title">Product Name<span class="text-red">*</span></label>
                                        <input id="title" type="text" class="form-control" name="name"
                                            placeholder="Enter product title" required="">

                                        @error('name')
                                            <div class="help-block with-errors">
                                                <span class="text-red">{{ $message }}</span>
                                            </div>
                                        @enderror



                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control h-205" rows="10"></textarea>
                                        @error('description')
                                            <div class="help-block with-errors">
                                                <span class="text-red">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Product Images</label>
        
                                        <input type="file" name="image">
                                          
                                        @error('image')
                                            <div class="help-block with-errors">
                                                <span class="text-red">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-sm-3">


                                    <div class="form-group">
                                        <label for="price">Selling Price<span class="text-red">*</span></label>
                                        <input id="price" type="text" class="form-control" name="sellingPrice"
                                            placeholder="Enter product selling price" required="">
                                        @error('sellingPrice')
                                            <div class="help-block with-errors">
                                                <span class="text-red">{{ $message }}</span>
                                            </div>
                                        @enderror


                                    </div>
                                    <div class="form-group">
                                        <label for="purchase_price">Purchase Price<span class="text-red">*</span></label>
                                        <input id="purchase_price" type="text" class="form-control" name="purchasePrice"
                                            placeholder="Enter product purchase price">
                                        @error('purchasePrice')
                                            <div class="help-block with-errors">
                                                <span class="text-red">{{ $message }}</span>
                                            </div>
                                        @enderror


                                    </div>
                                    <div class="form-group">
                                        <label for="taxPercentage">Tax Percentage</label>
                                        <input id="offer_price" type="text" class="form-control" name="taxPercentage"
                                            placeholder="Enter tax Percentage" required="">
                                        @error('taxPercentage')
                                            <div class="help-block with-errors">
                                                <span class="text-red">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">Quantity<span class="text-red">*</span></label>
                                        <input id="qty" type="text" class="form-control" name="quantity"
                                            placeholder="Enter Product Qty" required="">
                                        @error('quantity')
                                            <div class="help-block with-errors">
                                                <span class="text-red">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="stock_alert">Stock Alert<span class="text-red">*</span></label>
                                        <input id="stock_alert" type="text" class="form-control" name="stockAlert"
                                            placeholder="Enter Stock Alert" required="">
                                        @error('stockAlert')
                                            <div class="help-block with-errors">
                                                <span class="text-red">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>


                                </div>
                                <div class="col-sm-3">

                                    <div class="form-group">

                                        <label>Select Categories</label>
                                        
                                            
                                        @foreach ($categories as $category)
                                        <div class="border-checkbox-section ml-3">
                                           
                                            <div class="border-checkbox-group border-checkbox-group-success d-block">
                                            
                                                <input name="categoryId[]" class="border-checkbox" type="checkbox" id="checkbox{{$category->id}}"
                                                    value="{{$category->id}}">
                                                <label class="border-checkbox-label" for="checkbox{{$category->id}}">{{$category->name}}</label>
                                               
                                            </div>
                                           
                                        </div>
                                        @endforeach
                                        @error('categoryId')
                                        <div class="help-block with-errors">
                                            <span class="text-red">{{ $message }}</span>
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tax_type">Tax Type<span class="text-red">*</span></label>
                                        <select name="taxType" class="form-control">
                                            <option>Select</option>
                                            <option value="Inclusive">Inclusive</option>
                                            <option value="Exclusive">Exclusive</option>
                                        </select>
                                        @error('taxType')
                                        <div class="help-block with-errors">
                                            <span class="text-red">{{ $message }}</span>
                                        </div>
                                    @enderror
                                        
                                    </div>


                                    <div class="form-group text-right">
                                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
