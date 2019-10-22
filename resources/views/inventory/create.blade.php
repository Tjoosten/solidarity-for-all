@extends ('layouts.app', ['title' => 'Item toevoegen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inventaris</h1>
            <div class="page-subtitle">Item toevoegen in de inventaris</div>

            <div class="page-options d-flex">
                <a href="{{ route('inventory.admin.index') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <form action="{{ route('inventory.admin.store') }}" method="POST" class="card card-body shadow-sm border-0">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-plus mr-1 text-secondary"></i> Item toevoegen in de inventaris
            </h6>

            @csrf {{-- Form field protection --}}

            <div class="row mr-1">
                <div class="col-3">
                    <h5>Algemene informatie</h5>
                </div>

                <div class="offset-1 col-8">
                    <div class="form-row">
                        <div class="form-group col-8">
                            <label for="name" class="name">Item naam <span class="text-danger">*</span></label>
                            <input type="text" id="name" class="form-control @error('name', 'is-invalid')" placeholder="Item naam" @input('name')>
                            @error('name')
                        </div>

                        <div class="form-group col-4">
                            <label for="amount">Aantal <span class="text-danger">*</span></label>
                            <input type="text" id="quantity" class="form-control" @error('quantity', 'is-invalid') placeholder="Aantal" @input('quantity')>
                            @error('quantity')
                        </div>

                        <div class="form-group col-6">
                            <label for="location">Inzamelpunt <span class="text-danger">*</span></label>

                            <select id="location" class="custom-select @error('location', 'is-invalid')" @input('location')>
                                <option value="">-- selecteer inzamelpunt --</option>
                                @options($locations, 'locations', old('location'))
                            </select>

                            @error('location') {{-- Validation error view partial --}}
                        </div>

                        <div class="form-group col-6">
                            <label for="category">Categorie <span class="text-danger">*</span></label>

                            <select id="category" class="custom-select @error('category', 'is-invalid')" @input('category')>
                                <option value="">-- selecteer categorie --</option>
                                @options($categories, 'category', old('category'))
                            </select>

                            @error('category') {{-- Validation error view partial --}}
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mt-0">

            <div class="row">
                <div class="col-3">
                    <h5>Extra informatie</h5>
                    <p class="card-title text-mutes small">
                        <i class="fe fe-info mr-1"></i> Zoals bv. de kledings maat, schoenmaat, enz.
                    </p>
                </div>

                <div class="offset-1 col-8">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label class="sr-only" for="info">Extra informatie</label>
                            <textarea id="info" rows="3" class="form-control" placeholder="Extra informatie" @input('extra_information')>{{ old('extra_information') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mt-0">

            <div class="form-row">
                <div class="form-group col-12 mb-0">
                    <span class="float-right">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fe fe-plus mr-1"></i> Toevoegen
                        </button>

                        <a href="{{ url()->previous() }}" role="button" class="btn btn-light">
                            <i class="fe fe-rotate-ccw text-danger mr-1"></i> annuleren
                        </a>
                    </span>
                </div>
            </div>
        </form>
    </div>
@endsection
