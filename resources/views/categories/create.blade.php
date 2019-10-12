@extends ('layouts.app', ['title' => 'Categorie toevoegen'])

@section ('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Categorieen</h1>
            <div class="page-subtitle">Categorie toevoegen</div>

            <div class="page-options d-flex">
                <a href="{{ route('tags.overview') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <form method="POST" action="{{ route('tags.create') }}" class="card card-body shadow-sm border-0 shadow-sm">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-plus mr-1 text-secondary"></i> Nieuwe item categorie toevoegen
            </h6>

            @csrf {{-- Form field protection --}}
            @include('flash::message') {{-- Flash session view partial --}}

            <div class="form-row">
                <div class="form-group col-7">
                    <label for="name">Naam: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name', 'is-invalid')" placeholder="Categorie naam" id="name" @input('name')>
                    @error('name')
                </div>

                <div class="form-group col-12">
                    <label for="other">Extra informatie / Beschrijving</label>
                    <textarea id="other" rows="5" class="form-control" placeholder="Extra informatie en of beschrijving" @input('info_or_description')>{{ old('info_of_description') }}</textarea>
                </div>
            </div>

            <hr class="mt-0">

            <div class="form-row">
                <div class="form-group mb-0 col-12">
                    <button type="submit" class="btn btn-secondary">
                        <i class="fe fe-plus mr-1"></i> Toevoegen
                    </button>

                    <a class="btn btn-light" href="{{ route('tags.overview') }}">
                        <i class="fe fe-rotate-ccw text-danger mr-1"></i> annuleren
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
