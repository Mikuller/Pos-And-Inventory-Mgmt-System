@extends('inventory.layout')
@section('title', 'Manage Staff')
@section('content')
    <livewire:expenses/>

    @if (session('editMode') && session('expense')->exists() ?? false)
        @include('Expenses.edit')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#expenseEdit').modal('show');
            });
        </script>
        <?php session(['editMode' => false]); ?>
    @endif
    @if (session('showMode') && session('expense')->exists() ?? false)
        @include('Expenses.show')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#expenseShow').modal('show');
            });
        </script>
        <?php session(['showMode' => false]); ?>
    @endif

    
    
    

@endsection
