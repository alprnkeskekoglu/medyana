@extends('layouts.app')
@section('content')
    <main id="main-container">
        <div class="content content-max-width">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">{{ $equipment['name'] }}</h1>
            </div>
        </div>

        <div class="content" id="app">
            <equipment-edit></equipment-edit>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        window.equipment = @json($equipment)
    </script>
@endpush
