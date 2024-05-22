    <div class="bg-white rounded" style="width: 380px;">
        <span class="d-flex p-2 border-bottom border-4">
            <span class="fs-5 fw-semibold">Notification</span>
        </span>

        <div class="list-group border-bottom" style="max-height: 28rem; overflow-y: scroll;">
            <a href="{% url 'redirect_notifi' notification.id %}" class="notif list-group-item py-3 ">
                <div class="d-flex align-items-center justify-content-between">
                    <strong class="mb-1"></strong>
                    <small></small>
                </div>
                <div class="col-10 mb-1 small text-truncate"></div>
                <div class="d-flex justify-content-end"><i class="bi bi-check-circle"></i></div>
                <div class="d-flex justify-content-end"><i class="bi bi-check-circle-fill"></i></div>
            </a>
        </div>
        <div class="bg-white p-2 border-top border-1 border-dark">
            <a href="{% url 'read_all_notifi' %}" class="text-decoration-none">
                <i class="bi bi-check-circle px-3"></i>make all as read
            </a>
        </div>
    </div>
