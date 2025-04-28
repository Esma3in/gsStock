<div class='card'>
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Order # {{$order->id}}/</h5>
        <small>{{ $order->created_at->format('M d, Y') }}</small>
    </div>
</div>