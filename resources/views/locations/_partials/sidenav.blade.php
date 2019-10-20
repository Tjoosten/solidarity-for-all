<div class="list-group list-group-transparent">
    <a href="{{ route('locations.show', $location) }}" class="{{ active('locations.show') }} list-group-item list-group-item-action">
        <i class="fe fe-info text-muted mr-2"></i> Algemene informatie
    </a>

    <a href="{{ route('locations.destroy', $location) }}" class="{{ active('locations.destroy') }} list-group-item list-group-item-action">
        <i class="fe text-danger fe-trash-2 mr-2"></i> Verwijder locatie
    </a>
</div>
