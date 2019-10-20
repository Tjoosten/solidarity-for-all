@extends ('layouts.app', ['title' => 'Info inzamelpunt'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inzamelpunten</h1>
            <div class="page-subtitle">
                Algemene informatie omtrent inzamelpunt <span class="font-weight-bolder">{{ ucfirst($location->name) }}</span>
            </div>

            <div class="page-options d-flex">
                <a href="{{ route('locations.index') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-md-3"> {{-- Sidebar --}}
                @include ('locations._partials.sidenav', ['location' => $location])
            </div> {{-- /// END sidebar --}}

            <div class="col-md-9"> {{-- content --}}
                <form action="{{ route('locations.update', $location) }}" method="POST" class="card card-body border-0 shadow-sm">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-info mr-1 text-secondary"></i>
                        Algemene information omtrent inzamel punt <span class="font-weight-bold">{{ ucfirst($location->name) }}</span>
                    </h6>

                    @csrf                           {{-- Form field protection --}}
                    @method ('PATCH')               {{-- HTTP method spoofing --}}
                    @include ('flash::message')     {{-- Flash session view partial --}}
                    @form ($location)               {{-- Bind data to the form --}}

                    <div class="row mt-1">
                        <div class="col-md-3">
                            <h5>Algemene informatie</h5>
                        </div>

                        <div class="offset-1 col-8">
                            <div class="form-row">
                                <div class="form-group col-7">
                                    <label for="name">Naam <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name', 'is-invalid')" placeholder="Naam van het inzamelpunt" id="name" @input('name')>
                                    @error('name')
                                </div>

                                <div class="form-group col-5">
                                    <label for="coordinator">Coordinator <span class="text-danger">*</span></label>

                                    <select class="custom-select @error('coordinator', 'is-invalid')" id="coordinator" name="coordinator">
                                        <option value="">-- selecteer de coordinator --</option>
                                        <option selected value="{{ $location->coordinator->id }}">{{ $location->coordinator->name }}</option>
                                        @options($users, 'coordinator', old('coordinator'))
                                    </select>

                                    @error('coordinator') {{-- Validation error view partial     --}}
                                </div>

                                <div class="form-group col-12">
                                    <label for="address">Adres <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('address', 'is-invalid')" placeholder="Straatnaam + huisnummer" id="address" @input('address')>
                                    @error('address')
                                </div>

                                <div class="form-group col-5">
                                    <label for="postal">Postal <span class="text-danger">*</span></label>
                                    <input type="text" id="postal" class="form-control @error('postal', 'is-invalid')" placeholder="Postcode" @input('postal')>
                                    @error('postal')
                                </div>

                                <div class="form-group col-7">
                                    <label for="city">Stad of gemeente <span class="text-danger">*</span></label>
                                    <input type="text" id="city" class="form-control @error('city', 'is-invalid')" placeholder="Stad of gemeente" @input('city')>
                                    @error('city')
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="row">
                        <div class="col-3">
                            <h5>Extra informatie</h5>
                        </div>

                        <div class="offset-1 col-8">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="extra" class="sr-only">Extra informatie</label>
                                    <textarea id="extra" rows="2" class="form-control" placeholder="Extra informatie" @input('extra')>{{ old('extra') ?? $location->extra }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                   <span class="float-right">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fe fe-save mr-1"></i> wijzigen
                        </button>

                        <button type="reset" class="btn btn-light">
                            <i class="fe fe-rotate-ccw text-danger"></i> annuleren
                        </button>
                   </span>
                        </div>
                    </div>
                </form>
            </div> {{-- /// END content --}}
        </div>
    </div>
@endsection
