<div class="list-group list-group-transparent">
    <a href="{{ route('users.show', $user) }}" class="list-group-item {{ active('users.show') }} list-group-item-action">
        <i class="fe fe-info text-muted mr-2"></i> Algemene informatie
    </a>

    <a href="mailto:{{ $user->email }}" class="list-group-item list-group-item-action">
        <i class="fe fe-mail text-muted mr-2"></i> Contacteer gebruiker
    </a>
</div>
