@extends ('layouts.app', ['title' => 'Categorie verwijderen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Categorieen</h1>
            <div class="page-subtitle">{{ ucfirst($category->name) }} verwijderen als categorie</div>

            <div class="page-options d-flex">
                <a href="{{ route('tags.overview') }}" class="btn btn-orange">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidenav --}}
                @include('categories._partials.sidenav', ['category' => $category])
            </div> {{-- /// END siçdenav --}}

            <div class="col-9"> {{-- Content --}}
                <form action="{{ route('tags.delete', $category) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-trash-2 mr-1 text-danger"></i>
                        {{ ucfirst($category->name) }} verwijderen als categorie
                    </h6>

                    @csrf {{-- Form field protection --}}
                    @method('DELETE') {{-- HTTP method spoofing --}}

                    <p class="card-text text-danger">
                        U staat op het punt om <span class="font-weight-bold">{{ ucfirst($category->name) }}</span> als categorie te verwijderen!
                    </p>

                    <p class="card-text">
                        Bij het verwijderen van een categorie zullen ook de items die geattacheerd zijn aan de categorie geen categorie bevatten. <br>
                        Waardoor deze mogelijks verloren geraken in de inventaris. Dus daarom vragen wij u zeker te zijn dat u de handeling wilt uitvoeren. <br>
                        Het verwijderen van een categorie kan niet ngedaan worden gemaakt.
                    </p>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group mb-0 col-12">
                            <button type="submit" class="btn btn-danger">
                                <i class="fe fe-trash-2 mr-1"></i> verwijder
                            </button>

                            <a href="" class="btn btn-light">
                                <i class="fe fe-rotate-ccw mr-1 text-danger"></i>annuleren
                            </a>
                        </div>
                    </div>
                </form>
            </div> {{-- /// END content --}}
        </div>
    </div>
@endsection
