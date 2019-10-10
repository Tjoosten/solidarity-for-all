@extends ('layouts.app', ['title' => 'Item categorieen'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Categorieen</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="d-flex page-options">
                <a href="" class="btn btn-orange shadow-sm">
                    <i class="fe fe-plus"></i>
                </a>

                <form method="GET" action="" class="border-0 shadow-sm form-search form-inline ml-2">
                    <div class="form-group has-search">
                        <label for="search" class="sr-only">Zoek Gebruiker</label>
                        <span class="fe fe-search form-control-feedback"></span>
                        <input id="search" type="text" name="term" value="{{ request()->get('term') }}" placeholder="Zoek categorie" class="form-search border-0 form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card card-body shadow-sm border-0">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-tag mr-1 text-secondary"></i> Overzicht categorieen
            </h6>

            <div class="table-responsive">
                <table class="table-sm table-hover table mb-0">
                    <thead>
                        <tr>
                            <th class="border-top-0" scope="col">Ingevoegd door</th>
                            <th class="border-top-0" scope="col">Naam</th>
                            <th class="border-top-0" scope="col">Aantal items</th>
                            <th colspan="2" class="border-top-0" scope="col">Ingevoegd op</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category) {{-- Loop trough the categories --}}
                            <tr>
                                <td class="font-weight-bold text-secondary">{{ ucfirst($category->creator->name ?? config('app.name')) }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->items_count }} items</td>
                                <td>{{  }}</td>
                            </tr>
                        @empty {{-- There are currently no categories found --}}
                            <tr>
                                <td colspan="5" class="text-muted">
                                    <i class="fe fe-info mr-1"></i> Er zijn momenteel geen categorieen gevonden.
                                </td>
                            </tr>
                        @endforelse {{-- End category loop --}}
                    </tbody>
                </table>
            </div>

            {{ $categories->links() }}
        </div>
    </div>
@endsection
