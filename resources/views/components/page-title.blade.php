<div {{ $attributes->merge(['class' => 'd-flex flex-column flex-md-row gap-4 justify-content-between align-items-start mb-4']) }}>
    <h1 class="m-0 lh-1">{{ $title }}</h1>
    {{ $rightAligned ?? '' }}
</div>
