@extends('inventory.layout') 
@section('title', 'Add Purchase')
@section('content')
	<div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-truck bg-blue"></i>
                        <div class="d-inline">
                            <h5>Add Purchase</h5>
                            <span>Purchase Entry</span>
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
                                <a href="{{route('purchases.index')}}">Purchases</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('purchases.create')}}">Add Purchase</a>
                            </li>
                           
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            <div class="col-md-12">
                @include('include.message')
             </div>            
             <!-- end message area-->
            <livewire:purchases/>

                            
        </div>
    </div>
    

@endsection