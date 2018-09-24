<div class="card">
    <h3>@icon('file') <a class="no-color" href="{{ baseUrl("/pages/recently-updated") }}">{{ trans('entities.recently_updated_pages') }}</a></h3>
    <div id="recently-updated-pages">
        @include('partials/entity-list', [
        'entities' => $recentlyUpdatedPages,
        'style' => 'compact',
        'emptyText' => trans('entities.no_pages_recently_updated')
        ])
    </div>
</div>