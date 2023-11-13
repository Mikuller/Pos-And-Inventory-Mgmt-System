@extends('inventory.layout')
@section('title', 'Categories')
@section('content')

    @php
        $categories = [
            ['name' => 'Computer', 'parent_category' => 'Electronics', 'image' => '/img/portfolio-3.jpg', 'items' => 120],
            ['name' => 'Smartphone', 'parent_category' => 'Electronics', 'image' => '/img/portfolio-1.jpg', 'items' => 75],
            ['name' => 'Headphones', 'parent_category' => 'Electronics', 'image' => '/img/portfolio-2.jpg', 'items' => 40],
            ['name' => 'Television', 'parent_category' => 'Electronics', 'image' => '/img/portfolio-4.jpg', 'items' => 60],
            ['name' => 'Camera', 'parent_category' => 'Electronics', 'image' => '/img/portfolio-5.jpg', 'items' => 30],
            ['name' => 'Gaming', 'parent_category' => 'Electronics', 'image' => '/img/portfolio-6.jpg', 'items' => 50],
            ['name' => 'Furniture', 'parent_category' => null, 'image' => '/img/portfolio-7.jpg', 'items' => 200],
            ['name' => 'Home Decor', 'parent_category' => null, 'image' => '/img/portfolio-8.jpg', 'items' => 150],
            ['name' => 'Cookware', 'parent_category' => 'Kitchen', 'image' => '/img/portfolio-9.jpg', 'items' => 80],
            ['name' => 'Appliances', 'parent_category' => 'Kitchen', 'image' => '/img/portfolio-10.jpg', 'items' => 110],
            ['name' => 'Bedding', 'parent_category' => 'Bedroom', 'image' => '/img/portfolio-11.jpg', 'items' => 90],
            ['name' => 'Lighting', 'parent_category' => 'Home Decor', 'image' => '/img/portfolio-12.jpg', 'items' => 70],
        ];
    @endphp
    <!-- push external head elements to head -->
    
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="ik ik-headphones bg-green"></i>
                                <div class="d-inline">
                                    <h5>Categories</h5>
                                    <span>View, delete and update product categories</span>
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
                                        <a href="#">Categories</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col col-sm-2">
                                    
                                        <button class="btn btn-primary" href="#categoryAdd" data-toggle="modal" data-target="#categoryAdd">
                                            Add Category
                                        </button>
                                    
                                </div>
                                <div class="col col-sm-1">
                                    <div class="card-options d-inline-block">
                                        <div class="dropdown d-inline-block">
                                            <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="moreDropdown">
                                                <a class="dropdown-item" href="#">Delete</a>
                                                <a class="dropdown-item" href="#">More Action</a>
                                            </div>
                                        </div>
                                    </div>
            
                                </div>
                                <div class="col col-sm-6">
                                    <div class="card-search with-adv-search dropdown">
                                        <form action="">
                                            <input type="text" class="form-control global_filter" id="global_filter" placeholder="Search.." required="">
                                            <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                            <button type="button" id="adv_wrap_toggler_1" class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                            <div class="adv-search-wrap dropdown-menu dropdown-menu-right" aria-labelledby="adv_wrap_toggler_1">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col0_filter" placeholder="Title" data-column="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col1_filter" placeholder="Price" data-column="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col2_filter" placeholder="SKU" data-column="2">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col3_filter" placeholder="Qty" data-column="3">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col4_filter" placeholder="Category" data-column="4">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control column_filter" id="col5_filter" placeholder="Tag" data-column="5">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-theme">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    <div class="card-options text-right">
                                        <span class="mr-5" id="top">1 - 50 of 2,500</span>
                                        <a href="#"><i class="ik ik-chevron-left"></i></a>
                                        <a href="#"><i class="ik ik-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="advanced_table" class="table">
                                    <thead>
                                        <tr>
                                            <th class="nosort" width="10">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" id="selectall" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </th>
                                            <th class="nosort">Image</th>
                                            <th>Title</th>
                                            <th>SKU</th>
                                            <th>Categories</th>
                                            <th>Price</th>
                                            <th>Purchase Price</th>
                                            <th>In Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td>
                                                <img src="/img/products/headphone.webp" class="table-user-thumb" alt="">
                                            </td>
                                            <td>HeadPhone</td>
                                            <td>EH1234</td>
                                            <td>
                                                Electronics,
                                                Computers,
                                            </td>
                                            <td>100</td>
                                            <td>90</td>
                                            <td>50</td>
                                            <td>
                                                <a href="#productView" data-toggle="modal" data-target="#productView"><i class="ik ik-eye f-16 mr-15"></i></a>
                                                <a href="#"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td>
                                                <img src="/img/products/ipone-6.jpg" class="table-user-thumb" alt="">
                                            </td>
                                            <td>Iphone 6</td>
                                            <td>EH1234</td>
                                            <td>
                                                Electronics,
                                                Others,
                                            </td>
                                            <td>5000</td>
                                            <td>4850</td>
                                            <td>1</td>
                                            <td>
                                                <a href="#productView" data-toggle="modal" data-target="#productView"><i class="ik ik-eye f-16 mr-15"></i></a>
                                                <a href="/products/2/edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td>
                                                <img src="/img/products/bag.webp" class="table-user-thumb" alt="">
                                            </td>
                                            <td>Leather Bag</td>
                                            <td>EH1234</td>
                                            <td>
                                                Fashion,
                                            </td>
                                            <td>500</td>
                                            <td>450</td>
                                            <td>100</td>
                                            <td>
                                                <a href="#productView" data-toggle="modal" data-target="#productView"><i class="ik ik-eye f-16 mr-15"></i></a>
                                                <a href="/products/3/edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td>
                                                <img src="/img/products/camera.webp" class="table-user-thumb" alt="">
                                            </td>
                                            <td>Camera</td>
                                            <td>EH1234</td>
                                            <td>
                                                Electronics,
                                                Computers,
                                            </td>
                                            <td>100</td>
                                            <td>90</td>
                                            <td>50</td>
                                            <td>
                                                <a href="#productView" data-toggle="modal" data-target="#productView"><i class="ik ik-eye f-16 mr-15"></i></a>
                                                <a href="/products/4/edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td>
                                                <img src="/img/products/joystick.webp" class="table-user-thumb" alt="">
                                            </td>
                                            <td>Joystick</td>
                                            <td>EH1234</td>
                                            <td>
                                                Electronics,
                                                Computers,
                                            </td>
                                            <td>5000</td>
                                            <td>4850</td>
                                            <td>10</td>
                                            <td>
                                                <a href="#productView" data-toggle="modal" data-target="#productView"><i class="ik ik-eye f-16 mr-15"></i></a>
                                                <a href="/products/5/edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td>
                                                <img src="/img/products/jacket.webp" class="table-user-thumb" alt="">
                                            </td>
                                            <td>Jacket</td>
                                            <td>EH1234</td>
                                            <td>
                                                Fashion,
                                            </td>
                                            <td>500</td>
                                            <td>450</td>
                                            <td>100</td>
                                            <td>
                                                <a href="#productView" data-toggle="modal" data-target="#productView"><i class="ik ik-eye f-16 mr-15"></i></a>
                                                <a href="/products/6/edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td>
                                                <img src="/img/products/watch.webp" class="table-user-thumb" alt="">
                                            </td>
                                            <td>Smart Watch</td>
                                            <td>EH1234</td>
                                            <td>
                                                Electronics,
                                                Computers,
                                            </td>
                                            <td>100</td>
                                            <td>90</td>
                                            <td>50</td>
                                            <td>
                                                <a href="#productView" data-toggle="modal" data-target="#productView"><i class="ik ik-eye f-16 mr-15"></i></a>
                                                <a href="/products/7/edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td>
                                                <img src="/img/products/tshirt.jpg" class="table-user-thumb" alt="">
                                            </td>
                                            <td>T-shirt</td>
                                            <td>EH1234</td>
                                            <td>
                                                Electronics,
                                                Computers,
                                            </td>
                                            <td>5500</td>
                                            <td>4850</td>
                                            <td>10</td>
                                            <td>
                                                <a href="#productView" data-toggle="modal" data-target="#productView"><i class="ik ik-eye f-16 mr-15"></i></a>
                                                <a href="/products/8/edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child" id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td>
                                                <img src="/img/products/helmet.jpg" class="table-user-thumb" alt="">
                                            </td>
                                            <td>Helmet</td>
                                            <td>EH1234</td>
                                            <td>
                                                Fashion,
                                            </td>
                                            <td>500</td>
                                            <td>450</td>
                                            <td>100</td>
                                            <td>
                                                <a href="#productView" data-toggle="modal" data-target="#productView"><i class="ik ik-eye f-16 mr-15"></i></a>
                                                <a href="/products/9/edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </td>
                                        </tr>
            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- category add modal-->
        <div class="modal fade edit-layout-modal pr-0 " id="categoryAdd" tabindex="-1" role="dialog"
            aria-labelledby="categoryAddLabel" aria-hidden="true">
            <div class="modal-dialog w-300" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryAddLabel">{{ __('Add Category') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form enctype="multipart/form-data" method="POST" action="{{ route('category.store') }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="d-block">Category Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="d-block">Category Name</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Enter Category name">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="Save" value="Save">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- category edit modal -->
        <div class="modal fade edit-layout-modal pr-0 " id="categoryView" tabindex="-1" role="dialog"
            aria-labelledby="categoryViewLabel" aria-hidden="true">
            <div class="modal-dialog w-300" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryViewLabel">{{ __('Edit Category') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="d-block">Category Image</label>
                            <input type="file" name="category_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Category Title</label>
                            <input type="text" name="category_title" class="form-control"
                                placeholder="Enter Category Title" value="Computer">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Category Code</label>
                            <input type="text" name="category_code" class="form-control"
                                placeholder="Enter Category Code" value="CAT12">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Parent Category</label>
                            <select class="form-control select2 ">
                                <option selected="selected" value="" data-select2-id="3">Select Category</option>
                                <option value="1">Electronics</option>
                                <option value="3">Smart Home</option>
                                <option value="4">Arts &amp; Crafts</option>
                                <option value="5">Fashion</option>
                                <option value="6">Baby</option>
                                <option value="7">Health &amp; Care</option>
                                <option value="8">Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="Update" value="Update">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
