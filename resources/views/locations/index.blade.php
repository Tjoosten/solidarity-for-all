@extends ('layouts.app', ['title' => 'Inzamelpunten'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inzamelpunten</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                <a href="{{ route('locations.create') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-plus"></i>
                </a>

                <form method="GET" action="" class="border-0 shadow-sm form-search form-inline ml-2">
                    <div class="form-group has-search">
                        <label for="search" class="sr-only">Zoek inzamelpunt</label>
                        <span class="fe fe-search form-control-feedback"></span>
                        <input id="search" type="text" name="term" value="{{ request()->get('term') }}" placeholder="Zoeken" class="form-search border-0 form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        @include ('flash::message') {{-- Flash session view partial --}}

        <div class="card card-body shadow-sm border-0">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-map-pin mr-1 text-secondary"></i> Overzicht van inzamelpunten
            </h6>

            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="border-top-0" scope="col">Coordinator</th>
                            <th class="border-top-0" scope="col">Naam</th>
                            <th class="border-top-0" scope="col">Adres</th>
                            <th class="border-top-0" scope="col" colspan="2">Aantal items</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($locations as $location) {{-- Loop trough the locations --}}
                            <tr>
                                <td class="text-secondary font-weight-bold">{{ $location->coordinator->name ?? config('app.name') }}</td>
                                <td>{{ $location->name }}</td>
                                <td>{{ $location->full_address }}</td>
                                <td>{{ $location->items_count }} items</td>

                                <td> {{-- Options --}}
                                    <span class="float-right">
                                        <a href="{{ route('locations.show', $location) }}" class="text-secondary text-decoration-none">
                                            <i class="fe fe-eye"></i>
                                        </a>

                                        <a href="{{ route('locations.destroy', $location) }}" class="text-danger text-decoration-none ml-1">
                                            <i class="fe fe-trash-2"></i>
                                        </a>
                                    </span>
                                </td> {{-- /// end options --}}
                            </tr>
                        @empty {{-- There ar no locations currently in the application. --}}
                            <tr>
                                <td class="text-muted" colspan="4">
                                    <i class="fe fe-info mr-1"></i> Momenteel zijn er nog geen inzamelpunten geregistreerd in de applicatie.
                                </td>
                            </tr>
                        @endforelse {{-- /// END loop --}}
                    </tbody>
                </table>
            </div>

            {{ $locations->links() }} {{-- Pagination view instance --}}
        </div>
    </div>
@endsection
