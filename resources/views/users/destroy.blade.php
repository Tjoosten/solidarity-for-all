@extends ('layouts.app', ['title' => 'Gebruiker verwijderen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Gebruikersbeheer</h1>
            <div class="page-subtitle">{{ ucfirst($user->name) }} verwijderen als gebruiker</div>

            <div class="page-options d-flex">
                <a href="{{ route('users.index') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidebar --}}
                @include ('users._partials.sidenav', ['user' => $user])
            </div> {{-- /// Sidebar --}}

            <div class="col-9"> {{-- content --}}
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="card card-body border-0 shadow-sm">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-trash-2 mr-1 text-danger"></i> {{ ucfirst($user->name) }} verwijderen als gebruiker
                    </h6>

                    @csrf               {{-- Form field protection --}}
                    @method ('DELETE')  {{-- HTTP method spoofing --}}

                    <p class="card-text text-danger">
                        <i class="fe fe-alert-triangle mr-1"></i> U staat op het punt om een gebruiker te verwijderen in de applicatie.
                    </p>

                    <p class="card-text">
                        Indien u deze gebruiker verwijderd zal hij geen toegang meer hebben tot in de applicatie.
                        en zal zijn inzamelpunt waarvan hij coordinator is ook geen coordinator meer hebben. Plus ook wordt
                        alle data met betrekking tot deze gebruiker worden verwijderd of geanonimiseerd.
                    </p>

                    <p class="card-text">
                        Dus wees zeker of u de gebruiker wil verwijderen want de handeling kan niet meer ongedaan worden gemaakt.
                    </p>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-danger">
                                <i class="fe fe-trash-2 mr-1"></i> verwijderen
                            </button>

                            <a href="{{ url()->previous() }}" class="btn btn-light">
                                <i class="fe fe-rotate-ccw text-danger mr-1"></i> annuleren
                            </a>
                        </div>
                    </div>

                </form>
            </div> {{-- /// content --}}
        </div>
    </div>
@endsection
