@extends ('layouts.app', ['title' => "#{$item->item_code} {$item->name}"])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <div class="page-title">Inventaris</div>
            <div class="page-subtitle">Algemene informatie omtrent {{ ucfirst($item->name) }}</div>

            <div class="page-options d-flex">

            </div>
        </div>
    </div>
@endsection
