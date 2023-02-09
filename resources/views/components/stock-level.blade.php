<div class="mb-4">
    @if($level === StockLevel::HIGH)
        <span class="badge bg-success fs-6 fw-normal">{{ StockLevel::HIGH }}</span>
    @elseif($level === StockLevel::LOW)
        <span class="badge bg-warning fs-6 fw-normal">{{ StockLevel::LOW }}</span>
    @else
        <span class="badge bg-danger fs-6 fw-normal">{{ StockLevel::NONE }}</span>
    @endif
</div>
