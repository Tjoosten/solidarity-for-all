@extends ('layouts.app', ['title' => ucfirst($user->name)])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Gebruikersbeheer</h1>
            <div class="page-subtitle">Algemene informatie omtrent {{ ucfirst($user->name) }}</div>

            <div class="page-options d-flex">
                <a href="{{ route('users.index') }}" class="btn btn-shadow btn-orange">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sidebar --}}
            </div> {{-- /// ENd sidebar Sidebar --}}

            <div class="col-9"> {{-- Content --}}
                <form action="" method="POST" class="card card-body shadow-sm border-0">

                    @can ('update', $user) {{-- The user is an webmaster so he is permitted to change the account information --}}
                    @endcan {{-- /// END authorization check --}}
                </form>
            </div> {{-- /// END content --}}
        </div>
    </div>
@endsection
