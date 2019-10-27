@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Dashboard</h1>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row"> {{-- Dashboard counters --}}
            <div class="col-3">
                <div class="card border-0 shadow-sm mb-4 p-2">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md shadow-sm stamp-bg-brand mr-3">
                            <i class="fe fe-users"></i>
                        </span>

                        <div>
                            <h5 class="m-0">{{ $users->total }} <small>gebruikers</small></h5>
                            <small class="text-muted">waarvan {{ $users->deactivated_count }} gedeactiveerd</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card border-0 shadow-sm mb-4 p-2">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md shadow-sm stamp-bg-brand mr-3">
                            <i class="fe fe-list"></i>
                        </span>

                        <div>
                            <h5 class="m-0">{{ $items->total }} <small>Items</small></h5>
                            <small class="text-muted">Totaal goederen opgeteld: {{ $items->quantity_count }} stuks </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card border-0 shadow-sm mb-4 p-2">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md shadow-sm stamp-bg-brand mr-3">
                            <i class="fe fe-tag"></i>
                        </span>

                        <div>
                            <h5 class="m-0">{{ $categories->total }} <small>Categorieen</small></h5>
                            <small class="text-muted">{{ $categories->today_count }} toegevoegd vandaag </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card border-0 shadow-sm mb-4 p-2">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md shadow-sm stamp-bg-brand mr-3">
                            <i class="fe fe-map-pin"></i>
                        </span>

                        <div>
                            <h5 class="m-0">{{ $locations['total'] }} <small>Locaties</small></h5>
                            <small class="text-muted">{{ $locations['today_count'] }} toegevoegd vandaag </small>
                        </div>
                    </div>
                </div>
            </div>
        </div> {{-- /// END dashboard counters --}}

        <div class="row"> {{-- Inventery changes --}}
            <div class="col-12 pb-4">
                <div class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-list mr-1 text-secondary"></i> Recente interacties met de inventaris
                    </h6>

                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0" scope="col">Uitgevoerd door</th>
                                <th class="border-top-0" scope="col">Item</th>
                                <th class="border-top-0" scope="col">Mededeling</th>
                                <th class="border-top-0" scope="col">Datum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($interactions as $interaction)
                                <tr>
                                    <td>
                                        <a href="{{ route('users.show', $interaction->causer->id) }}" class="text-dark text-decoration-none">
                                            {{ ucfirst($interaction->causer->name ?? 'onbekende gebruiker')  }}
                                        </a>
                                    </td>
                                    <td>#{{ $interaction->subject->item_code }} {{ ucfirst($interaction->subject->name) }}</td>
                                    <td>{{ $interaction->description }}</td>
                                    <td>{{ $interaction->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty {{-- There are currently no interaction logs --}}
                                <tr>
                                    <td class="text-muted" colspan="4">
                                        <i class="fe fe-info mr-1"></i> Er is momenteel geen transactie historiek omtrent de inventaris items.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div> {{-- /// END inventory chanegs --}}

        <div class="row">
            <div class="col-12">
                <div class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-list mr-1 text-secondary"></i> Recent toegevoegde items in de inventaris.

                        <a href="{{ route('inventory.admin.index') }}" class="text-muted float-right small text-decoration-none">
                            volledige inventaris
                        </a>
                    </h6>

                    <table class="table table-sm table mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0" scope="col">Item code</th>
                                <th class="border-top-0" scope="col">Inzamelpunt</th>
                                <th class="border-top-0" scope="col">Categorie</th>
                                <th class="border-top-0" scope="col">Naam</th>
                                <th class="border-top-0" scope="col">Aantal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $item)
                                <tr>
                                    <td class="font-weight-bold text-muted">#{{ $item->item_code }}</td>
                                    <td>{{ $item->location->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity }} stuks</td>
                                </tr>
                            @empty {{-- There are no items found in the inventory --}}
                                <tr>
                                    <td class="text-muted" colspan="5">
                                        <i class="fe fe-info mr-1"></i> Er zijn momenteel geen items in de inventaris.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
