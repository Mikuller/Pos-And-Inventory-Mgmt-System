@extends('inventory.layout')
@section('title', 'Services')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-spinner bg-green" aria-hidden="true"></i>
                        <div class="d-inline">
                            <h5>Pending services</h5>
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
                                <a href="{{ route('service.index') }}">Pending services</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                @include('include.message')
            </div>
        </div>
        <livewire:pending-services />
    </div>
    @include('service.service_views.create_pending_service')


    @if (session('editMode') && session('service')->exists() ?? false)
    @include('service.service_views.edit')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#serviceEdit').modal('show');
            });
        </script>
        <?php session(['editMode' => false]); ?>
        
    @endif

    @if (session('showMode') && session('service')->exists() ?? false)
        @include('service.service_views.show')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#serviceShow').modal('show');
            });
        </script>
        <?php session(['showMode' => false]); ?>
    @endif

    @if (session('editPaymentMode') ?? false)
        @include('service.service_views.update_payment_info')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#servicePaymentEdit').modal('show');
            });
        </script>
        <?php session(['editPaymentMode' => false]); ?>
        
    @endif
    @push('style')
        <style>
            /* Custom CSS to style the radio buttons */
            .custom-radio-input {
                width: 1.5em;
                height: 1.5em;
                margin-right: 0.5em;
                /* Adjust spacing between label and radio button */
            }
        </style>
    @endpush
    <!-- push external js -->

    @push('script')
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/Cell-edit/dataTables.cellEdit.js') }}"></script>
        <!--get editable datatable script-->
        <script src="{{ asset('js/editable-datatable.js') }}"></script>

        <script>
            // Get the radio button and text input elements
            const eCashRadio = document.getElementById('E-Cash');
            const cashRadio = document.getElementById('cash');

            const eCashRefNumberWrapper = document.getElementById('eCashRefNumberWrapper');


            const refNum = document.getElementById('eCashRefNumber');
            const bankInfo = document.getElementById('bankInfo');
            // Add event listener to the radio button
            eCashRadio.addEventListener('change', function() {
                // If the E-Cash radio button is checked, show the text input
                if (this.checked) {
                    eCashRefNumberWrapper.style.display = 'block';
                    refNum.required = true;
                    bankInfo.required = true;
                } else {
                    // If the E-Cash radio button is unchecked, hide the text input
                    eCashRefNumberWrapper.style.display = 'none';
                    refNum.required = false;
                    refNum.value = null;
                    bankInfo.required = false;
                    bankInfo.value = null;

                }
            });
            cashRadio.addEventListener('change', function() {

                if (this.checked) {
                    eCashRefNumberWrapper.style.display = 'none';
                    refNum.required = false;
                    bankInfo.required = false;
                    bankInfo.value = null;
                    refNum.value = null;
                } else {
                    eCashRefNumberWrapper.style.display = 'block';
                    refNum.required = true;
                    bankInfo.required = true;

                }
            });

            const maintainerNameList = document.getElementById('nameList')
            const customMaintainerName = document.getElementById('customName')

            maintainerNameList.addEventListener('change', function() {
                if (maintainerNameList.value === 'custom') {
                    maintainerNameList.style.display = 'none';
                    maintainerNameList.required = false;
                    customMaintainerName.style.display = 'block';
                    customMaintainerName.required = true;
                } else {
                    maintainerNameList.style.display = 'block';
                    maintainerNameList.required = true;
                    customMaintainerName.style.display = 'none';
                    customMaintainerName.required = false;
                }
            });
        </script>
    @endpush

@endsection
