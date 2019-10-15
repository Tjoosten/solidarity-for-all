@extends ('layouts.app', ['title' => 'Gebruikersoverzicht'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Gebruikersbeheer</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="page-options d-flex">
                <a href="{{ route('users.create') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-user-plus"></i>
                </a>

                <form method="GET" action="" class="border-0 shadow-sm form-search form-inline ml-2">
                    <div class="form-group has-search">
                        <label for="search" class="sr-only">Zoek Gebruiker</label>
                        <span class="fe fe-search form-control-feedback"></span>
                        <input id="search" type="text" name="term" value="{{ request()->get('term') }}" placeholder="Zoeken" class="form-search border-0 form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card card-body shadow-sm border-0">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-users mr-1 text-secondary"></i> Gebruikers overzicht
            </h6>

            @include ('flash::message') {{-- Flash message view partial --}}

            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="border-top-0" scope="col">Naam</th>
                            <th class="border-top-0" scope="col">Status</th>
                            <th class="border-top-0" scope="col">E-mail</th>
                            <th class="border-top-0" scope="col">Tel. nummer</th>
                            <th class="border-top-0" scope="col">Inzamelpunt</th>
                            <th class="border-top-0" scope="col">&nbsp;</th> {{-- Method for defining the function shortcuts --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user) {{-- Loop trough the users --}}
                            <tr>
                                <td class="font-weight-bold text-muted">{{ ucfirst($user->name) }}</td>

                                <td> {{-- Status indicator --}}
                                    @if ($user->isOnline())
                                        <span class="badge badge-online">Online</span>
                                    @else {{-- The user is offline --}}
                                        <span class="badge badge-offline">Offline</span>
                                    @endif
                                </td> {{-- /// Status indicator --}}

                                <td><a class="text-decoration-none" href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>

                                <td>
                                    @if ($user->phone_number)
                                        {{ $user->phone_number }}
                                    @else
                                        <span class="text-muted font-italic">Niet opgegeven</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($user->hasAnyRole(['admin', 'webmaster']))
                                        <span class="font-italic text-secondary">N.V.T</span>
                                    @endif
                                </td>

                                <td> {{-- Options  --}}
                                    <span class="float-right">
                                        <a href="" class="text-decoration-none text-secondary mr-1">
                                            <i class="fe fe-eye"></i>
                                        </a>

                                        <a href="" class="text-decoration-none text-danger">
                                            <i class="fe fe-trash-2"></i>
                                        </a>
                                    </span>
                                </td> {{-- /// Options --}}
                            </tr>
                        @empty {{-- There are no users found in the application --}}
                            <tr>
                                <td class="text-muted" colspan="6">
                                    <i class="fe fe-info mr-1"></i> Momenteel zijn er geen gevonden gebruikers met de matchende criteria.
                                </td>
                            </tr>
                        @endforelse {{-- /// END user loop --}}
                    </tbody>
                </table>
            </div>

            {{ $users->links() }}
        </div>
    </div>
@endsection
