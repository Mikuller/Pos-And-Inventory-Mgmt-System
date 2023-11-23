@extends('inventory.layout')
@section('title', 'Categories')
@section('content')


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

                                <button class="btn btn-primary" href="#categoryAdd" data-toggle="modal"
                                    data-target="#categoryAdd">
                                    Add Category
                                </button>

                            </div>
                            <div class="col col-sm-1">
                                <div class="card-options d-inline-block">
                                    <div class="dropdown d-inline-block">
                                        <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="ik ik-more-horizontal"></i></a>
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
                                        <input type="text" class="form-control global_filter" id="global_filter"
                                            placeholder="Search.." required="">
                                        <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                        <button type="button" id="adv_wrap_toggler_1"
                                            class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></button>
                                        <div class="adv-search-wrap dropdown-menu dropdown-menu-right"
                                            aria-labelledby="adv_wrap_toggler_1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control column_filter"
                                                            id="col0_filter" placeholder="Title" data-column="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control column_filter"
                                                            id="col1_filter" placeholder="Price" data-column="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control column_filter"
                                                            id="col2_filter" placeholder="SKU" data-column="2">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control column_filter"
                                                            id="col3_filter" placeholder="Qty" data-column="3">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control column_filter"
                                                            id="col4_filter" placeholder="Category" data-column="4">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control column_filter"
                                                            id="col5_filter" placeholder="Tag" data-column="5">
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
                                                <input type="checkbox" class="custom-control-input" id="selectall"
                                                    name="" value="option2">
                                                <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </th>
                                        <th class="nosort">Image</th>
                                        <th>Category Name</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input select_all_child"
                                                        id="" name="" value="option2">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                            </td>
                                            <td>
                                                <img src="{{ $category->getImageURL() }}" class="table-user-thumb"
                                                    alt="">
                                            </td>
                                            <td>{{ $category->name }}</td>

                                            <td>
                                                <a href="{{ route('category.show', ['category' => $category->id]) }}"><i
                                                        class="ik ik-eye f-16 mr-15"></i></a>
                                                <a href="{{ route('category.edit', ['category' => $category->id]) }}"><i
                                                        class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                <a href="{{ route('category.destroy', ['category' => $category->id]) }}"><i
                                                        class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    @include('inventory.category.create')

    @if (session('editMode') ?? false)
    @include('inventory.category.edit')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#editModal').modal('show');
            });
        </script>
         <?php session(['editMode' => false]); ?>
    @elseif (session('viewMode') ?? false)
    @include('inventory.category.show')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#viewModal').modal('show');
            });
        </script>
        <?php session(['viewMode' => false]); ?>
    @endif



@endsection
