@extends('inventory.layout')
@section('title', 'Manage Spare Parts')
@section('content')
    <livewire:spare-parts />
    @if (session('showMode') && session('sparePart')->exists() ?? false)
        @include('inventory.spare_parts.show')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#showModal').modal('show');
            });
        </script>
        <?php session(['showMode' => false]); ?>
    @endif
    @if (session('editMode') && session('sparePart')->exists() ?? false)
    @include('inventory.spare_parts.edit')
    <script>
        // Open the modal using JavaScript
        $(document).ready(function() {
            $('#editModal').modal('show');
        });
    </script>
    <?php session(['editMode' => false]); ?>
@endif
@endsection
