@extends ('layouts.app', ['title' => 'Nieuwe gebruiker'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Gebruikersbeheer</h1>
            <div class="page-subtitle">Nieuwe gebruiker toevoegen</div>

            <div class="page-options d-flex">
                <a href="{{ route('users.index') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <form method="POST" action="{{ route('users.store') }}" class="card card-body border-0 shadow-sm">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-user-plus mr-1 text-secondary"></i> Nieuwe gebruiker toevoegen
            </h6>

            @csrf {{-- Form field protection --}}

            <div class="form-row">
                <div class="form-group col-6">
                    <label for="name">Naam <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name', 'is-invalid')" placeholder="Naam" id="name" @input('name')>
                    @error('name')
                </div>

                <div class="form-group col-6">
                    <label for="phone_number">Tel. nummer</label>
                    <input type="text" id="phone_number" class="form-control" placeholder="Tel. number" id="phone_number" @input('phone_number')>
                </div>

                <div class="form-group col-5">
                    <label for="email">Email adres <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email', 'is-invalid')" placeholder="E-mail adres" @input('email')' id="email">
                    @error('email')
                </div>

                <div class="form-group col-7">
                    <label for="function">Gebruikers functie <span class="text-danger">*</span></label>

                    <select id="function" class="custom-select @error('role', 'is-invalid')" @input('role')>
                        @options($roles, 'roles', old('roles'))
                    </select>

                    @error('role') {{-- flash session view partial. --}}
                </div>
            </div>

            <hr class="mt-0">

            <div class="form-row">
                <div class="form-group col-12 mb-0">
                    <button type="submit" class="btn btn-success">
                        <i class="fe fe-save mr-1"></i> Toevoegen
                    </button>

                    <button type="reset" class="btn btn-light">
                        <i class="fe fe-rotate-ccw text-danger"></i> reset
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
