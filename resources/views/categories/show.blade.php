@extends ('layouts.app', ['title' => $category->name])

@section ('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Categorieen</h1>
            <div class="page-subtitle">
                Informatie omtrent <span class="font-weight-bold">{{ ucfirst($category->name)}}</span>
            </div>

            <div class="page-options d-flex">
                <a href="{{ route('tags.overview') }}" class="btn btn-orange btn-shadow">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidebar --}}
                @include ('categories._partials.sidenav', ['category' => $category])
            </div> {{-- /// END sidebar --}}

            <div class="col-9"> {{-- Content --}}
                <form action="{{ route('tags.update', $category) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-info mr-1 text-secondary"></i>
                        Informatie omtrent de categorie <span class="font-weight-bold">{{ ucfirst($category->name)}}</span>
                    </h6>

                    @csrf                      {{-- Form field protection --}}
                    @method('PATCH')           {{-- HTTP method spoofing --}}
                    @include('flash::message') {{-- Flash session view partial --}}
                    @form($category)           {{-- Bind data to the form. --}}

                    <div class="form-row">
                        <div class="form-group col-7">
                            <label for="name">Naam: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name', 'is-invalid')" placeholder="Categorie naam" id="name" @input('name')>
                            @error('name')
                        </div>

                        <div class="form-group col-12">
                            <label for="other">Extra informatie / Beschrijving</label>
                            <textarea id="other" rows="5" class="form-control" placeholder="Extra informatie en of beschrijving" @input('info_or_description')>{{ old('info_of_description') ?? $category->info_or_description }}</textarea>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group mb-0 col-12">
                            <button type="submit" class="btn btn-secondary">
                                <i class="fe fe-save mr-1"></i> Aanpassen
                            </button>

                            <a class="btn btn-light" href="{{ route('tags.overview') }}">
                                <i class="fe fe-rotate-ccw text-danger mr-1"></i> annuleren
                            </a>
                        </div>
                    </div>
                </form>
            </div> {{-- /// Content --}}
        </div>
    </div>
@endsection
