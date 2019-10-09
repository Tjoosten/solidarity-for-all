@extends('layouts.app', ['title' => 'Account beveiliging'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">{{ ucfirst($currentUser->name) }}</h1>
            <div class="page-subtitle">Account beveiliging</div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidenav --}}
                @include ('profile._partials.sidenav')
            </div> {{-- /// End sidenav --}}

            <div class="col-9"> {{-- content --}}
                <form action="{{ route('profile.settings.security') }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-shield mr-1 text-secondary"></i> Account beveiliging
                    </h6>

                    @csrf                       {{-- Form field protection --}}
                    @method ('PATCH')           {{-- HTTP method spoofing --}}
                    @include ('flash::message') {{-- Flash session view partial --}}

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="current">Huidig wachtwoord <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('old_password', 'is-invalid')" placeholder="Uw huidig wachtwoord" @input('old_password')>
                            @error('old_password')
                        </div>

                        <div class="form-group col-6">
                            <label for="new">Nieuw wachtwoord <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password', 'is-invalid')" placeholder="Nieuw wachtwoord" @input('password')>
                            @error('password')
                        </div>

                        <div class="form-group col-6">
                            <label for="confirmation">Herhaal nieuw wachtwoord <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="Herhaal nieuw wachtwoord" @input('password_confirmation')>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-secondary">
                                <i class="fe fe-save mr-2"></i> Aanpassen
                            </button>

                            <button type="reset" class="btn btn-light">
                                <i class="fe fe-rotate-ccw text-danger"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div> {{-- /// content --}}
        </div>
    </div>
@endsection
