@extends('inventory.layout')
@section('title', 'Sales')
@section('content')
<div class="container-fluid">
	<div class="page-header">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="ik ik-shopping-cart bg-green"></i>
					<div class="d-inline">
						<h5>Sales</h5>
						<span>View, delete and update Sales</span>
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
							<a href="/sales">Sales</a>
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
<livewire:sales/>
</div>

@endsection