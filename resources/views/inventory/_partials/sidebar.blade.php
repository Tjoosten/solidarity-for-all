<div class="list-group list-group-transparent">
    <a href="{{ route('inventory.show', $item) }}" class="{{ active('inventory.show') }} list-group-item list-group-item-action">
        <i class="fe fe-info text-muted mr-2"></i> Algemene informatie
    </a>
    <a href="{{ route('inventory.checkin', $item) }}" class="{{ active('inventory.checkin') }} list-group-item list-group-item-action">
        <i class="fe fe-plus-square mr-2 text-muted"></i> Aantallen inboeken
    </a>
</div>
