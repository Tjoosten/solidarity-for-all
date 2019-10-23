@extends ('layouts.app', ['title' => 'Inzamelpunt verwijderen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
             <h1 class="page-title">Inzamelpunten</h1>
            <div class="page-subtitle">
                <span class="font-weight-bold">{{ ucfirst($location->name) }}</span> verwijderen als inzamelpunt.
            </div>

            <div class="page-options d-flex">
                <a href="{{ route('locations.index') }}" class="shadow-sm btn btn-orange">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidebar --}}
                @include ('locations._partials.sidenav', ['location' => $location])
            </div> {{-- /// END sidebar --}}

            <div class="col-9"> {{-- Content --}}
                <form action="{{ route('locations.destroy', $location) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-trash-2 mr-1 text-danger"></i> {{ ucfirst($location->name) }} verwijderen als inzamelpunt.
                    </h6>

                    @csrf               {{-- Form field protection --}}
                    @method ('DELETE')  {{-- HTTP method spoofing --}}

                    <p class="text-danger card-text">
                        <i class="fe fe-alert-triangle mr-1"></i>
                        U staat om een inzamelpunt te verwijderen in de applicatie.
                    </p>

                    <p class="card-text">
                        Bij het verwijderen van het inzamelpunt met de naam {{ ucfirst($location->name) }}. Zal alle bijhorende
                        data worden verwijderen inclusief de invenataris en transacties. En zal alsook de coordinator niet meer kunnen inloggen
                        aangezien hij geen nieuw inzamelpunt heeft toegewezen.
                    </p>

                    <p class="card-text">
                        Vandaar vragen wij u om zeker te zijn of u dit inzamelpunt wilt verwijderen. Deze actie kan niet meer ongedaan worden gemaakt
                    </p>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button class="btn btn-danger" type="submit">
                                <i class="fe fe-trash-2 mr-1"></i> verwijder
                            </button>

                            <a href="{{ route('locations.index') }}" role="button" class="btn btn-light">
                                <i class="fe fe-rotate-ccw mr-1 text-danger"></i> annuleren
                            </a>
                        </div>
                    </div>
                </form>
            </div> {{-- /// CONTENT --}}
        </div>
    </div>
@endsection
