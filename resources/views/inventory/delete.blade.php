@extends ('layouts.app', ['title' => "#{$item->item_code} {$item->name} verwijderen"])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inventaris</h1>
            <div class="page-subtitle">
                <span class="font-weight-bold">#{{ $item->item_code }} {{ ucfirst($item->name) }}:</span> Item verwijderen
            </div>

            <div class="page-options d-flex">
                <a href="{{ route('inventory.admin.index') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3">
                @include ('inventory._partials.sidebar', ['item' => $item])
            </div>

            <div class="col-9">
                <form action="{{ route('inventory.item.destroy', $item) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-trash-2 mr-1 text-danger"></i> Overzicht van hulpgoederen
                    </h6>

                    @csrf {{-- Form field protection --}}
                    @method('DELETE') {{-- HTTP method spoofing --}}

                    <p class="card-text text-danger">
                        <i class="fe fe-alert-triangle mr-1"></i> U staat op het punt om hulpgoederen te verwijderen.
                    </p>

                    <p class="card-text">
                        Bij het verwijderen van <span class="font-weight-bold">#{{ $item->item_code }} {{ ucfirst($item->name) }}</span>
                        zullen ook alle aantallen, transactie logs en gegevens verwijdered worden. Wees zeker of u actueel dit item wilt verwijderen.
                        Dus wees zeker of u item wilt verwijderen want na het verwijderen kan dit niet meer ongedaan gemaakt worden.
                    </p>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-danger">
                                <i class="fe fe-trash-2 mr-1"></i> verwijder
                            </button>

                            <a href="{{ route('inventory.show', $item) }}" class="btn btn-light" role="button">
                                <i class="fe fe-rotate-ccw mr-1 text-danger"></i> annuleren
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
