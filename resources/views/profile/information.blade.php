@extends ('layouts.app', ['title' => 'Account informatie'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">{{ ucfirst($currentUser->name) }}</h1>
            <div class="page-subtitle">Algemene informatie</div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidebar --}}
                @include ('profile._partials.sidenav')
            </div> {{-- /// END sidebar --}}

            <div class="col-9"> {{-- Content --}}
                <form method="POST" action="{{ route('profile.settings.info') }}" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-user mr-1 text-secondary"></i> Uw algemene informatie
                    </h6>

                    @csrf                       {{-- form field protection --}}
                    @form($currentUser)         {{-- Bind the authenticated user to the form. --}}
                    @method('PATCH')            {{-- HTTP method spoofing --}}
                    @include('flash::message')  {{-- Flash message view partial --}}

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="name">Uw naam <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name', 'is-invalid')" id="name" @input('name')>
                            @error('name')
                        </div>

                        <div class="form-group col-6">
                            <label for="number">Uw Tel. nummer </label>
                            <input type="text" class="form-control" id="number" @input('phone_number')>
                        </div>

                        <div class="form-group col-12">
                            <label for="email">Uw E-mail adres <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control @error('email', 'is-invalid')" @input('email')>
                            @error('email')
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-secondary">
                                <i class="fe fe-save mr-2"></i> Opslaan
                            </button>

                            <button type="reset" class="btn btn-light">
                                <i class="fe fe-rotate-ccw text-danger"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div> {{-- /// END Content --}}
        </div>
    </div>
@endsection
