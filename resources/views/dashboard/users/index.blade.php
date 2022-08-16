@extends('layout.main')

@section('content')
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            {{ $dataTable->table(['class' => 'table table-striped gy-7 gs-7']) }}
        </div>
    </div>
    
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush