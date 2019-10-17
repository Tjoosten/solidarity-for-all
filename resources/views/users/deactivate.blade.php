@extends ('layouts.app', ['title' => ucfirst($user->name)])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Gebruikersbeheer</h1>
            <div class="page-subtitle">{{ ucfirst($user->name) }} deactiveren in de applicatie</div>

            <div class="page-options d-flex">
                <a href="{{ route('users.index') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-3"> {{-- Sidebar --}}
                @include ('users._partials.sidenav', ['user' => $user])
            </div> {{-- /// END sidebar --}}

            <div class="col-9"> {{-- Sidebar --}}
                <form action="{{ route('users.deactivate', $user) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-lock mr-1 text-secondary"></i> {{ ucfirst($user->name) }} deactiveren in de applicatie
                    </h6>

                    @csrf {{-- Form field protected --}}

                    <p class="card-text text-danger">
                        <i class="fe mr-1 fe-alert-triangle"></i>
                        Bij het deactiveren van de login zorg je ervoor dat {{ ucfirst($user->name) }} zich nog kan inloggen op de applicatie.
                    </p>

                    <p class="card-text">
                        Vandaar dat we je vragen om twee keer na te denken voor u overgaat tot de blokkering van de login. <br>
                        Indien u wilt verder gaan met de activatie vragen wij je je wachtwoord en een redevoering in het onderstaande formulier
                        in te vullen ter controle en informatie. De rede zal ook meegedeeld aan {{ ucfirst($user->name) }}.
                    </p>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12">
                            <textarea placeholder="Beschrijving van de rede voor de deactivatie" class="form-control @error('reden', 'is-invalid')" @input('reden') rows="5">{{ old('reden') }}</textarea>
                            @error('reden') {{-- Validation error view partial --}}
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-secondary">
                                <i class="fe fe-lock mr-1"></i> deactiveer
                            </button>

                            <a href="{{ route('users.index') }}" class="btn btn-light">
                                <i class="fe fe-rotate-ccw text-danger mt-1"></i> annuleren
                            </a>
                        </div>
                    </div>
                </form>
            </div> {{-- /// SIDEBAR --}}
        </div>
    </div>
@endsection
