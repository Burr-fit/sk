<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="{{ asset('assets/css/sidebar-menu.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/prism.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/quill.snow.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/jsvectormap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const spaContent = document.getElementById('spa-content');
                const links = document.querySelectorAll('[data-page]');

                function setActiveMenu(page) {
                    links.forEach(link => {
                        if (link.dataset.page === page) {
                            link.classList.add('active');
                            link.closest('.menu-item')?.classList.add('active');
                        } else {
                            link.classList.remove('active');
                            link.closest('.menu-item')?.classList.remove('active');
                        }
                    });
                }

                async function loadPage(page, push = true) {
                    // Tambah kelas untuk efek fade-out
                    spaContent.classList.add('fade-out');

                    try {
                        const res = await fetch(`/Admin/ajax/${page}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        if (!res.ok) throw new Error('Halaman tidak ditemukan');
                        const html = await res.text();

                        setTimeout(() => {
                            spaContent.innerHTML = html;
                            spaContent.classList.remove('fade-out');
                            spaContent.classList.add('fade-in');

                            if (page === 'SilsilahKeluarga' || page === 'Silsilah') {
                                initPaper();
                            }
                        }, 150);

                        setActiveMenu(page);
                        if (push) window.history.pushState({
                            page
                        }, '', `/Admin/${page}`);
                    } catch (err) {
                        spaContent.innerHTML = `<div class="p-4"><p>${err.message}</p></div>`;
                    }
                }

                // Klik menu sidebar
                links.forEach(link => {
                    link.addEventListener('click', e => {
                        e.preventDefault();
                        const page = link.dataset.page;
                        loadPage(page);
                    });
                });

                // Tombol back/forward browser
                window.addEventListener('popstate', e => {
                    if (e.state?.page) loadPage(e.state.page, false);
                });

                // Saat refresh, ambil halaman dari URL
                const current = location.pathname.replace('/Admin/', '');
                setActiveMenu(current);
                loadPage(current, false);
            });
        </script>
    </head>

    <body>
        <!-- Start Preloader Area -->
        <div class="preloader" id="preloader">
            <div class="preloader">
                <div class="waviy position-relative">
                    <span class="d-inline-block">S</span>
                    <span class="d-inline-block">I</span>
                    <span class="d-inline-block">L</span>
                    <span class="d-inline-block">S</span>
                    <span class="d-inline-block">I</span>
                    <span class="d-inline-block">L</span>
                    <span class="d-inline-block">A</span>
                    <span class="d-inline-block">H</span>
                    <span class="d-inline-block"></span>
                    <span class="d-inline-block">K</span>
                    <span class="d-inline-block">I</span>
                    <span class="d-inline-block">T</span>
                    <span class="d-inline-block">A</span>
                </div>
            </div>
        </div>
        <!-- End Preloader Area -->

        {{-- Sidebar --}}
        @include('Admin.Layout.sidebar')

        {{-- Content --}}
        <div class="container-fluid">
            <div class="main-content d-flex flex-column">
                {{-- Navbar --}}
                @include('Admin.Layout.navbar')

                <div class="main-content-container overflow-hidden" id="spa-content">
                    {{-- Isi Content --}}
                </div>

                <div class="flex-grow-1"></div>

                {{-- Footer --}}
                @include('Admin.Layout.footer')
            </div>
        </div>

        {{-- Setting Thema --}}
        @include('Admin.Layout.settingthema')

        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
        <script src="{{ asset('assets/js/quill.min.js') }}"></script>
        <script src="{{ asset('assets/js/data-table.js') }}"></script>
        <script src="{{ asset('assets/js/prism.js') }}"></script>
        <script src="{{ asset('assets/js/clipboard.min.js') }}"></script>
        <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/js/echarts.min.js') }}"></script>
        <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/fullcalendar.main.js') }}"></script>
        <script src="{{ asset('assets/js/jsvectormap.min.js') }}"></script>
        <script src="{{ asset('assets/js/world-merc.js') }}"></script>

        <!-- Custom Scripts -->
        <script src="{{ asset('assets/js/custom/maps.js') }}"></script>
        <script src="{{ asset('assets/js/custom/custom.js') }}"></script>
    </body>

</html>
