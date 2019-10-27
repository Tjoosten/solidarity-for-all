<div class="list-group list-group-transparent">
    <a href="{{ route('inventory.show', $item) }}" class="{{ active('inventory.show') }} list-group-item list-group-item-action">
        <i class="fe fe-info text-muted mr-2"></i> Algemene informatie
    </a>

    <a href="{{ route('inventory.checkin', $item) }}" class="{{ active('inventory.checkin') }} list-group-item list-group-item-action">
        <i class="fe fe-plus-square mr-2 text-muted"></i> Aantallen inboeken
    </a>

    <a href="{{ route('inventory.checkout', $item) }}" class="{{ active('inventory.checkout') }} list-group-item list-group-item-action">
        <i class="fe fe-minus-square mr-2 text-muted"></i> Aantallen uitboeken
    </a>

    @if ($currentUser->hasAnyRole(['admin', 'webmaster']))
        <a href="{{ route('inventory.admin.actions', $item) }}" class="{{ active('inventory.admin.actions') }} list-group-item list-group-item-action">
            <i class="fe fe-activity mr-2 text-muted"></i> Interactie geschiedenis
        </a>
    @endif

    <a href="{{ route('inventory.item.destroy', $item) }}" class="{{ active('inventory.item.destroy') }} list-group-item-action list-group-item">
        <i class="fe fe-trash-2 mr-2 text-muted"></i> Item verwijderen
    </a>
</div>
