@extends ('layouts.app', ['title' => "#{$item->item_code} {$item->name} uitboeken"])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inventaris</h1>
            <div class="page-subtitle"><span class="font-weight-bold">#{{ $item->item_code }} {{ ucfirst($item->name) }}:</span> Items uitboeken</div>

            <div class="d-flex page-options">
                <a href="{{ route('inventory.admin.index') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
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
                <form action="{{ route('inventory.checkout', $item) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-minus-square mr-1 text-danger"></i> Items uitboeken
                    </h6>

                    @csrf {{-- Form field protection --}}
                    @include ('flash::message') {{-- Flash message view partial --}}

                    <div class="form-row">
                        <div class="col-8 form-group">
                            <label for="item">Item naam</label>
                            <input type="text" id="item" class="form-control" value="{{ $item->name }}" disabled>
                        </div>

                        <div class="col-4 form-group">
                            <label for="amount">Aantal <span class="text-danger">*</span></label>
                            <input type="text" id="amount" class="form-control @error('quantity', 'is-invalid')" placeholder="Aantal items uit te boeken" @input('quantity')>
                            @error('quantity')
                        </div>

                        <div class="col-12 form-group">
                            <label for="note">Opmerking</label>
                            <textarea id="note" rows="4" class="form-control" placeholder="Opmerking die verschijnt in de logs voor de administrators" @input('note') >{{ old('note') }}</textarea>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                            <button type="submit" class="btn btn-danger">
                                <i class="fe fe-minus-square mr-1"></i> uitboeken
                            </button>

                            <a href="{{ url()->previous() }}" class="btn btn-light" role="button">
                                <i class="fe fe-rotate-ccw mr-1 text-danger"></i> annuleren
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
