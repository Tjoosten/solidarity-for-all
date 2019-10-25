@extends ('layouts.app', ['title' => "#{$item->item_code} {$item->name}"])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inventaris</h1>
            <div class="page-subtitle">
                <span class="font-weight-bold">#{{ $item->item_code }} {{ ucfirst($item->name) }}: interactie geschiedenis </span>
            </div>

            <div class="page-options d-flex">
                <a href="{{ route('inventory.admin.index') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-list mr-2"></i> overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3">
                @include ('inventory._partials.sidebar', ['item' => $item])
            </div>

            <div class="col-9">
                <div class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-activity mr-1 text-secondary"></i>
                        <span class="font-weight-bold">#{{ $item->item_code }} {{ ucfirst($item->name) }}:</span> interactie geschiedenis
                    </h6>

                    <div class="table-responsive">
                        <table class="table table-sm mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Uitgevoerd door</th>
                                    <th class="border-top-0" scope="col">Mededeling</th>
                                    <th class="border-top-0" scope="col">Datum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($interactions as $interaction)
                                    <tr>
                                        <td>{{ $interaction->causer->name ?? 'Verwijderde gebruiker'}}</td>
                                        <td>{{ $interaction->description }}</td>
                                    <td>{{ $interaction->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-secondary">
                                            <i class="fe fe-info mr-1"></i> Er is momenteel geen interactie geschiedenis voor dit item.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $interactions->links() }} {{-- Pagination view instance --}}
                </div>
            </div>
        </div>
    </div>
@endsection
