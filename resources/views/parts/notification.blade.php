
<div class="bg-white rounded" style="width: 380px;">
    <span class="d-flex p-2 border-bottom border-4">
        <span class="fs-5 fw-semibold">Notification</span>
    </span>

    <div class="list-group border-bottom" style="max-height: 28rem; overflow-y: scroll;">

        @foreach ($notifications as $notification)
            <a href="{{ route('notification.read_one', $notification) }}" class="notif list-group-item py-3 ">
                <div class="d-flex align-items-center justify-content-between">
                    <strong class="mb-1">{{ $notification->title }}</strong>
                    <small>{{ $notification->created_at->format('j-M  H:i')}}</small>
                </div>
                <div class="col-10 mb-1 small text-truncate">{{ $notification->message }}</div>
                @if ($notification->is_read)
                    <div class="d-flex justify-content-end"><i class="bi bi-check-circle"></i></div>
                @else
                    <div class="d-flex justify-content-end"><i class="bi bi-check-circle-fill"></i></div>
                @endif
            </a>
        @endforeach

    </div>
    <div class="bg-white p-2 border-top border-1 border-dark">
        <form action="{{ route('notification.read_all') }}" method="post" id="read_notifications">
            @csrf

            <a class="text-decoration-none" role="button"
            onclick="document.getElementById('read_notifications').submit();"
            >
                <i class="bi bi-check-circle px-3"></i>make all as read
            </a>
        </form>

    </div>
</div>
