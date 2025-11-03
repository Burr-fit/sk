<!-- Start Sidebar Area -->
<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('SK1.png') }}" alt="logo-icon" width="45" class="me-2">
            <span class="textlogo text-secondary fw-semibold fs-5" style="margin-top: 15px">
                Silsilah Keluarga
            </span>
        </a>
        <button
            class="sidebar-burger-menu-close bg-transparent py-3 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
            id="sidebar-burger-menu-close">
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #475569; height: 1px; width: 25px; transform: rotate(45deg);"></span>
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #475569; height: 1px; width: 25px; transform: rotate(-45deg);"></span>
        </button>
        <button class="sidebar-burger-menu bg-transparent p-0 border-0" id="sidebar-burger-menu">
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #475569; height: 1px; width: 25px; margin: 6px 0;"></span>
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #475569; height: 1px; width: 25px;"></span>
        </button>
    </div>

    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">
            <li class="menu-item">
                <a href="" class="menu-link" data-page="Dashboard">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Fitur</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="Fitur">
                            <span class="title">Fitur</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="FiturUnlock">
                            <span class="title">Fitur Unlock</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">person</span>
                    <span class="title">Akun</span>
                </a>
                <ul class="menu-sub">


                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="KatagoriAkun">
                            <span class="title">Katagori Akun</span>
                        </a>
                    </li>


                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="Akun">
                            <span class="title">Akun</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="KodeReferal">
                            <span class="title">Kode Referal</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="PenggunaanReferal">
                            <span class="title">Penggunaan Referal</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">groups</span>
                    <span class="title">Keluarga</span>
                </a>
                <ul class="menu-sub">

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="Keluarga">
                            <span class="title">Nama Keluarga</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="Anggota">
                            <span class="title">Anggota</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="AnggotaKeluarga">
                            <span class="title">Anggota Keluarga</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="AnggotaMenikah">
                            <span class="title">Anggota Menikah</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="AnggotaAnak">
                            <span class="title">Anggota Anak</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="SilsilahKeluarga">
                            <span class="title">Buat Silsilah</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="">
                            <span class="title">Lokasi Silaturahmi</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="">
                            <span class="title">Lokasi Pemakaman</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="KenanganKeluarga">
                            <span class="title">Kenangan Keluarga</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Premium</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="Promo">
                            <span class="title">Promo</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="Paket">
                            <span class="title">Paket</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="" class="menu-link" data-page="Langganan">
                            <span class="title">Langganan</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </aside>
</div>
<!-- End Sidebar Area -->


<style>
    [sidebar-data-theme=sidebar-hide] .sidebar-area .textlogo {
        display: none;
        transition: all ease 0.3s;
    }

    [sidebar-data-theme=sidebar-hide] .sidebar-area:hover {
        width: 250px;
        transition: all ease 0.5s;
    }

    [sidebar-data-theme=sidebar-hide] .sidebar-area:hover .textlogo {
        display: inline;
        opacity: 1;
        transition: opacity 0.3s ease;
    }
</style>
