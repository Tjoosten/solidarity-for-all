@extends ('layouts.app', ['title' => 'Locatie inventaris'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inzamelpunten</h1>
            <div class="page-subtitle">Inventaris van {{ ucfirst($location->name) }}</div>

            <div class="d-flex page-options">
                <a href="{{ route('inventory.admin.create') }}" class="shadow-sm btn btn-orange mr-2">
                    <i class="fe fe-plus mr-2"></i> Item toevoegen
                </a>

                <a href="{{ route('locations.index') }}" class="shadow-sm btn btn-orange">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3">
                @include ('locations._partials.sidenav', ['location' => $location])
            </div>

            <div class="col-9">
                <div class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-list mr-1 text-secondary"></i> Locatie inventaris van {{ ucfirst($location->name) }}
                    </h6>

                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0" scope="col">Item code</th>
                                <th class="border-top-0" scope="col">Categorie</th>
                                <th class="border-top-0" scope="col">Naam</th>
                                <th class="border-top-0" scope="col" colspan="2">Aantal</th> {{-- Colspan 2 is needed for the functions --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td class="font-weight-bold text-muted">#{{ $item->item_code }}</td>

                                    <td>
                                        <a href="{{ route('tags.show', $item->category) }}" class="text-white badge badge-info">
                                            {{ $item->category->name }}
                                        </a>
                                    </td
                                    >
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity }} stuks</td>

                                    <td class="td-options"> {{-- Options --}}
                                        <span class="float-right">
                                            @can ('checkout', $item) {{-- User is permitted to checkout items --}}
                                                <a href="{{ route('inventory.checkout', $item) }}" class="text-danger text-decoration-none">
                                                    <i class="fe fe-minus-square"></i>
                                                </a>
                                            @endcan

                                            @can ('checkin', $item) {{-- User is permitted to check-in items --}}
                                                <a href="{{ route('inventory.checkin', $item) }}" class="text-success text-decoration-none ml-1">
                                                    <i class="fe fe-plus-square"></i>
                                                </a>
                                            @endcan

                                            @if ($currentUser->hasAnyRole(['admin', 'webmaster']))
                                                <a href="{{ route('inventory.admin.actions', $item) }}" class="text-decoration-none text-muted ml-3">
                                                    <i class="fe fe-activity"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('inventory.show', $item) }}" class="text-muted text-decoration-none ml-1">
                                                <i class="fe fe-eye"></i>
                                            </a>

                                            <a href="{{ route('inventory.item.destroy', $item) }}" class="text-danger text-decoration-none ml-1">
                                                <i class="fe fe-trash-2"></i>
                                            </a>
                                        </span>
                                    </td> {{-- /// END options --}}
                                </tr>
                            @empty {{-- THere are no items found for the location --}}
                                <tr>
                                    <td colspan="5" class="text-muted">
                                        <i class="fe fe-info mr-1"></i> Er zijn momenteel geen items voor {{ ucfirst($location->name) }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $items->links() }} {{-- Pagination view partial --}}
                </div>
            </div>
        </div>
    </div>
@endsection
