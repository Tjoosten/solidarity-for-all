<div class="list-group list-group-transparent">
    <a href="{{ route('users.show', $user) }}" class="list-group-item {{ active('users.show') }} list-group-item-action">
        <i class="fe fe-info text-muted mr-2"></i> Algemene informatie
    </a>

    @if ($currentUser->can('deactivate', $user)) {{--- Check if the auth user is permitted to deactivate the user --}}
        <a href="{{ route('users.deactivate', $user) }}" class="list-group-item {{ active('users.deactivate') }} list-group-item-action">
            <i class="fe fe-lock text-muted mr-2"></i> Deactiveer gebuiker
        </a>
    @elseif ($currentUser->can('activate', $user))
        <a href="" class="list-group-item {{ active('users.activate') }} list-group-item-action">
            <i class="fe fe-unlock text-muted mr-2"></i> Deactivering opheffen
        </a>
    @endif{{-- /// END authorization check --}}

    <a href="mailto:{{ $user->email }}" class="list-group-item list-group-item-action">
        <i class="fe fe-mail text-muted mr-2"></i> Contacteer gebruiker
    </a>
</div>
