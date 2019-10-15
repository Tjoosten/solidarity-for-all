<div class="list-group list-group-transparent">
    <a href="{{ route('tags.show', $category) }}" class="list-group-item {{ active('tags.show') }} list-group-item-action">
        <i class="fe fe-info text-muted mr-2"></i> Algemene informatie
    </a>

    <a href="{{ route('tags.delete', $category) }}" class="list-group-item {{ active('tags.delete') }} list-group-item-action">
        <i class="fe fe-trash-2 text-danger mr-2"></i> Categorie verwijderen
    </a>
</div>
