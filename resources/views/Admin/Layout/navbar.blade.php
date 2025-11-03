<!-- Start Header Area -->
<header class="header-area bg-white mb-4 rounded-3 border border-light shadow-sm py-2" id="header-area">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between flex-wrap">

            <!-- 🔹 Left: Burger -->
            <div class="d-flex align-items-center">
                <button class="header-burger-menu bg-transparent p-2 border-0 d-xl-none" id="header-burger-menu">
                    <span class="d-block" style="border-bottom:1px solid #475569;width:25px;"></span>
                    <span class="d-block my-1" style="border-bottom:1px solid #475569;width:25px;"></span>
                    <span class="d-block" style="border-bottom:1px solid #475569;width:25px;"></span>
                </button>
            </div>

            <!-- 🔹 Right: Menus -->
            <ul class="d-flex align-items-center list-unstyled mb-0 flex-wrap justify-content-end gap-3 pe-2">

                <!-- Dark/Light Mode -->
                <li class="header-right-item">
                    <button
                        class="switch-toggle dark-btn d-flex align-items-center justify-content-center bg-transparent border-0 p-0 pt-2 rounded-circle"
                        id="switch-toggle" style="width:42px;height:42px;border-radius:50%;">
                        <span class="dark"><i class="material-symbols-outlined fs-3">dark_mode</i></span>
                        <span class="light"><i class="material-symbols-outlined fs-3">light_mode</i></span>
                    </button>
                </li>

                <!-- Calendar -->
                <li class="header-right-item">
                    <a href=""
                        class="btn bg-light d-flex align-items-center justify-content-center border-0 p-2 rounded-circle"
                        style="width:42px;height:42px;border-radius:50%;">
                        <span class="material-symbols-outlined fs-3 iconn">calendar_today</span>
                    </a>
                </li>

                <!-- Messages -->
                <li class="dropdown">
                    <button class="btn bg-light border-0 p-2 rounded-circle position-relative"
                        data-bs-toggle="dropdown">
                        <span class="material-symbols-outlined">mail</span>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge bg-primary rounded-pill">5</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow-sm p-0">
                        <div class="p-3 border-bottom fw-semibold">Messages</div>
                        <div style="max-height:250px;overflow-y:auto;">
                            <a href="chat.html" class="dropdown-item d-flex align-items-center py-2">
                                <img src="assets/images/user1.jpg" width="36" height="36"
                                    class="rounded-circle me-2" alt="User">
                                <div>
                                    <div class="fw-medium text-secondary">Jacob Liwiski</div>
                                    <small class="text-muted">35 min ago</small>
                                </div>
                            </a>
                        </div>
                        <a href="chat.html" class="dropdown-item text-center text-primary fw-medium border-top">See
                            All</a>
                    </div>
                </li>

                <!-- Notifications -->
                <li class="dropdown">
                    <button class="btn bg-light border-0 p-2 rounded-circle position-relative"
                        data-bs-toggle="dropdown">
                        <span class="material-symbols-outlined">notifications</span>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill">3</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow-sm p-0">
                        <div class="p-3 border-bottom fw-semibold">Notifications</div>
                        <div style="max-height:250px;overflow-y:auto;">
                            <a href="#" class="dropdown-item d-flex align-items-center py-2">
                                <i class="material-symbols-outlined text-primary me-2">sms</i>
                                <span>You have requested withdrawal</span>
                            </a>
                            <a href="#" class="dropdown-item d-flex align-items-center py-2">
                                <i class="material-symbols-outlined text-success me-2">mark_email_unread</i>
                                <span>New message arrived</span>
                            </a>
                        </div>
                        <a href="notifications.html"
                            class="dropdown-item text-center text-primary fw-medium border-top">View All</a>
                    </div>
                </li>

                <!-- Profile -->
                <li class="dropdown">
                    <button class="btn bg-transparent border-0 p-0" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/images/admin.png') }}" alt="admin" class="rounded-circle"
                            width="42" height="42">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow-sm p-0">
                        <div class="d-flex align-items-center p-3 border-bottom">
                            <img src="{{ asset('assets/images/admin.png') }}" class="rounded-circle me-2" width="40"
                                height="40" alt="admin">
                            <div>
                                <div class="fw-semibold">Mateo Luca</div>
                                <small class="text-muted">Admin</small>
                            </div>
                        </div>
                        <a href="my-profile.html" class="dropdown-item py-2"><i
                                class="material-symbols-outlined me-2">person</i>My Profile</a>
                        <a href="settings.html" class="dropdown-item py-2"><i
                                class="material-symbols-outlined me-2">settings</i>Settings</a>
                        <a href="logout.html" class="dropdown-item py-2 text-danger"><i
                                class="material-symbols-outlined me-2">logout</i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- End Header Area -->


<style>
    [data-bs-theme="dark"] .header-area .btn.bg-light {
        background-color: rgb(44 44 44) !important;
    }
</style>
