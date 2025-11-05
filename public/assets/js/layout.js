// === Global cache untuk resource per halaman ===
window.pageResources = {};

// === Helper untuk load CSS eksternal hanya untuk page aktif ===
async function loadCSSForPage(page, hrefs = []) {
    // Hapus CSS lama (kecuali global)
    if (window.pageResources[page]?.css) {
        window.pageResources[page].css.forEach((link) => link.remove());
    }

    const loaded = [];
    for (const href of hrefs) {
        const link = document.createElement("link");
        link.rel = "stylesheet";
        link.href = href;
        document.head.appendChild(link);
        await new Promise((res, rej) => {
            link.onload = res;
            link.onerror = rej;
        });
        loaded.push(link);
    }

    // Simpan referensi CSS yang dipakai halaman ini
    if (!window.pageResources[page]) window.pageResources[page] = {};
    window.pageResources[page].css = loaded;
}

// === Helper untuk load JS eksternal hanya untuk page aktif ===
async function loadScriptsForPage(page, srcs = []) {
    // Hapus script lama (kecuali global)
    if (window.pageResources[page]?.scripts) {
        window.pageResources[page].scripts.forEach((script) => script.remove());
    }

    const loaded = [];
    for (const src of srcs) {
        const s = document.createElement("script");
        s.src = src;
        s.async = true;
        document.head.appendChild(s);
        await new Promise((res, rej) => {
            s.onload = res;
            s.onerror = rej;
        });
        loaded.push(s);
    }

    // Simpan referensi script yang dipakai halaman ini
    if (!window.pageResources[page]) window.pageResources[page] = {};
    window.pageResources[page].scripts = loaded;
}

// === Controller utama SPA ===
document.addEventListener("DOMContentLoaded", function () {
    const spaContent = document.getElementById("spa-content");
    const links = document.querySelectorAll("[data-page]");

    // Set active menu di sidebar
    function setActiveMenu(page) {
        links.forEach((link) => {
            const isActive = link.dataset.page === page;
            link.classList.toggle("active", isActive);
            link.closest(".menu-item")?.classList.toggle("active", isActive);
        });
    }

    // Fungsi utama load halaman (AJAX)
    async function loadPage(page, push = true) {
        spaContent.classList.add("fade-out");

        try {
            const res = await fetch(`/Admin/ajax/${page}`, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
            });
            if (!res.ok) throw new Error("Halaman tidak ditemukan");
            const html = await res.text();

            setTimeout(async () => {
                spaContent.innerHTML = html;
                spaContent.classList.remove("fade-out");
                spaContent.classList.add("fade-in");

                switch (page) {
                    case "Dashboard":
                        Object.values(window.pageResources).forEach((res) => {
                            res?.css?.forEach((link) => link.remove());
                            res?.scripts?.forEach((script) => script.remove());
                        });
                        window.pageResources = {};

                        await loadScriptsForPage("Dashboard", [
                            "assets/js/custom/apexcharts.js",
                            "assets/js/custom/echarts.js",
                        ]);
                        break;
                    case "Anggota":
                        break;
                    case "AnggotaAnak":
                        break;
                    case "AnggotaKeluarga":
                        break;
                    case "AnggotaMenikah":
                        break;
                    case "Dashboard":
                        break;
                    case "Fitur":
                        break;
                    case "FiturUnlock":
                        break;
                    case "KatagoriAkun":
                        break;
                    case "Keluarga":
                        break;
                    case "KenanganKeluarga":
                        break;
                    case "SilsilahKeluarga":
                        try {
                            // Bersihkan resource dari page sebelumnya
                            Object.values(window.pageResources).forEach(
                                (res) => {
                                    res?.css?.forEach((link) => link.remove());
                                    res?.scripts?.forEach((script) =>
                                        script.remove()
                                    );
                                }
                            );
                            window.pageResources = {}; // reset

                            // Load CSS & JS khusus halaman ini
                            await loadCSSForPage("SilsilahKeluarga", [
                                "/assets/editor/1.css",
                                "/assets/css/page/silsilah.css",
                                "https://unpkg.com/intro.js/introjs.css",
                                "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css",
                            ]);

                            await loadScriptsForPage("SilsilahKeluarga", [
                                "https://cdn.jsdelivr.net/npm/@joint/core/dist/joint.js",
                                "https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js",
                                "https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js",
                                "https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js",
                                "https://unpkg.com/intro.js/intro.js",
                                "/assets/editor/1.js",
                                "/assets/js/actionform.js",
                                "/assets/js/page/silsilah.js",
                                "https://cdn.jsdelivr.net/npm/sweetalert2@11",
                            ]);

                            // Jalankan inisialisasi
                            requestAnimationFrame(() => {
                                if (typeof initPaper === "function") {
                                    initPaper();
                                } else {
                                    console.warn("initPaper belum terdefinisi");
                                }
                            });
                        } catch (err) {
                            console.error(
                                "Gagal load dependensi Silsilah:",
                                err
                            );
                        }
                        break;
                    case "KodeReferal":
                        break;
                    case "Langganan":
                        break;
                    case "Paket":
                        break;
                    case "PenggunaanReferal":
                        break;
                    case "Promo":
                        break;

                    default:
                        // console.log(`Tidak ada init khusus untuk halaman ${page}`);
                        break;
                }
            }, 150);

            setActiveMenu(page);
            if (push) {
                window.history.pushState({ page }, "", `/Admin/${page}`);
            }
        } catch (err) {
            console.error(err);
            spaContent.innerHTML = `<div class="p-4 text-danger"><p>${err.message}</p></div>`;
        }
    }

    // === Sidebar Navigation Click ===
    links.forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const page = link.dataset.page;
            loadPage(page);
        });
    });

    // === Back/Forward Browser ===
    window.addEventListener("popstate", (e) => {
        if (e.state?.page) loadPage(e.state.page, false);
    });

    // === Load Halaman Saat Refresh ===
    const current = location.pathname.replace("/Admin/", "") || "Dashboard";
    setActiveMenu(current);
    loadPage(current, false);
});
