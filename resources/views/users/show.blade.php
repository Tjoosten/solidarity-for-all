@extends ('layouts.app', ['title' => ucfirst($user->name)])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Gebruikersbeheer</h1>
            <div class="page-subtitle">Algemene informatie omtrent {{ ucfirst($user->name) }}</div>

            <div class="page-options d-flex">
                <a href="{{ route('users.index') }}" class="btn shadow-sm btn-orange">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidebar --}}
                @include ('users._partials.sidenav', ['user' => $user])
            </div> {{-- /// ENd sidebar Sidebar --}}

            <div class="col-9"> {{-- Content --}}
                <form action="{{ route('users.update', $user) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-info mr-1 text-secondary"></i> Algemene information omtrent {{ ucfirst($user->name) }}
                    </h6>

                    @csrf                           {{-- Form field protection --}}
                    @method('PATCH')                {{-- HTTP method spoofing --}}
                    @form($user)                    {{-- Bind data to the form --}}
                    @include ('flash::message')     {{-- Flash session view partial --}}

                    @if ($user->isBanned())
                        <div class="alert alert-danger border-0 alert-important" role="alert">
                            <i class="fe fe-alert-triangle mr-1"></i> Deze gebruiker is tijdelijk gedeactiveerd!
                        </div>
                    @endif

                    <fieldset @cannot('update', $user) disabled @endcan>
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
                                    @foreach ($roles as $role) {{-- Loop trough the roles --}}
                                        <option value="{{ $role->name }}" @if ($user->hasRole($role->name)) selected @endif>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach {{-- /// END role loop --}}
                                </select>

                                @error('role') {{-- flash session view partial. --}}
                            </div>
                        </div>
                    </fieldset>

                    @can ('update', $user) {{-- The user is an webmaster so he is permitted to change the account information --}}
                        <hr class="mt-0">

                        <div class="form-row">
                            <div class="form-group col-12 mb-0">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fe fe-save mr-1"></i> opslaan
                                </button>

                                <button type="reset" class="btn btn-light">
                                    <i class="fe fe-rotate-ccw text-danger mr-1"></i> annuleren
                                </button>
                            </div>
                        </div>
                    @endcan {{-- /// END authorization check --}}
                </form>
            </div> {{-- /// END content --}}
        </div>
    </div>
@endsection
