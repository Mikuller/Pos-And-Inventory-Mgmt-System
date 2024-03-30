@extends('inventory.layout')
@section('title', 'Categories')
@section('content')


    <!-- push external head elements to head -->

    <div class="row">

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
                                    <a href="{{ route('dashboard')}}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('reload')}}">Categories</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <!-- start message area-->
                    @include('include.message')
                </div>
            </div>
            <livewire:categories/>
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
