@extends('inventory.layout')
@section('title', 'Import Products')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-upload-cloud bg-blue"></i>
                    <div class="d-inline">
                        <h5>Import Products</h5>
                        <span>Bulk upload products from CSV</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('product.index') }}">Products</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Import</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Upload CSV</h3></div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <p>Please download the sample CSV file to understand the required format.</p>
                        <a href="{{ route('product.downloadSample') }}" class="btn btn-primary">
                            <i class="ik ik-download"></i> Download Sample CSV
                        </a>
                    </div>

                    <form action="{{ route('product.storeImport') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Choose CSV File</label>
                            <input type="file" class="form-control" name="file" id="file" required accept=".csv,.txt">
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="ik ik-upload"></i> Import Products
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
