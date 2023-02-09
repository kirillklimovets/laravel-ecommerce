<div {{ $attributes->merge([
    'class' =>  $withDivider
        ? 'd-flex flex-column flex-md-row gap-1 justify-content-between align-items-start pt-2 mb-3 border-top'
        : 'd-flex flex-column flex-md-row gap-1 justify-content-between align-items-start pt-2 mb-3'
]) }}>
    <h2 class="fs-{{ $size }} m-0">{{ $title ?? '' }}</h2>
    {{ $rightAligned ?? '' }}
</div>
