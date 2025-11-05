const baseURL = window.location.origin + "/share/";
const editorLink = baseURL + "editor-123abc";
const viewerLink = baseURL + "viewer-456xyz";

function showSharePopup(role, link) {
    const color = role === "Editor" ? "#28a745" : "#0d6efd";
    const icon = role === "Editor" ? "fa-user-gear" : "fa-eye";

    Swal.fire({
        title: `<i class="fa-solid ${icon}" style="color:${color}"></i> Share as ${role}`,
        html: `
                <p class="mb-2">Bagikan link berikut kepada anggota keluarga sebagai <b>${role}</b>:</p>
                <div class="input-group mb-3">
                    <input type="text" id="shareLink" class="form-control text-center" readonly value="${link}">
                    <button class="btn btn-outline-secondary" id="copyBtn">
                        <i class="fa-solid fa-copy"></i> Copy
                    </button>
                </div>
                <small class="text-muted">
                    ${
                        role === "Editor"
                            ? "Editor dapat menambahkan dan mengedit anggota keluarga."
                            : "Viewer hanya dapat melihat silsilah tanpa bisa mengubah data."
                    }
                </small>
            `,
        showConfirmButton: false,
        width: 600,
        didOpen: () => {
            const copyBtn = Swal.getHtmlContainer().querySelector("#copyBtn");
            const input = Swal.getHtmlContainer().querySelector("#shareLink");
            copyBtn.addEventListener("click", () => {
                navigator.clipboard
                    .writeText(input.value)
                    .then(() => {
                        copyBtn.innerHTML =
                            '<i class="fa-solid fa-check text-success"></i> Copied!';
                        setTimeout(() => {
                            copyBtn.innerHTML =
                                '<i class="fa-solid fa-copy"></i> Copy';
                        }, 2000);
                    })
                    .catch((err) => console.error("Copy failed:", err));
            });
        },
    });
}

// Listener tombol dropdown
document.getElementById("shareEditor").addEventListener("click", function (e) {
    e.preventDefault();
    showSharePopup("Editor", editorLink);
});

document.getElementById("shareViewer").addEventListener("click", function (e) {
    e.preventDefault();
    showSharePopup("Viewer", viewerLink);
});

const inputNamaKeluarga = document.querySelector("#nama_keluarga");
const inputNamaKelModal = document.querySelector("#namakel");

if (inputNamaKeluarga && inputNamaKelModal) {
    // sinkronisasi realtime
    inputNamaKeluarga.addEventListener("input", () => {
        inputNamaKelModal.value = inputNamaKeluarga.value;
    });

    // kalau user ubah dari modal juga, update balik ke atas
    inputNamaKelModal.addEventListener("input", () => {
        inputNamaKeluarga.value = inputNamaKelModal.value;
    });
} else {
    console.warn("Input #nama_keluarga atau #namakel tidak ditemukan di DOM.");
}

// INTRODUCTION
const inputNama = document.querySelector("#inputnamakeluarga");
const shareBtn = document.querySelector(".btn-group .btn-outline-success");
const exportSVG = document.querySelector("#btnSVG");
const exportPDF = document.querySelector("#btnPDF");
const paperArea = document.querySelector("#paper");

const tour = introJs().setOptions({
    steps: [
        {
            intro: "👋 Selamat datang di halaman <b>Silsilah Keluarga</b>!",
        },
        {
            element: inputNama,
            intro: "Isi di sini untuk membuat nama keluarga baru yang ingin kamu buat.",
        },
        {
            element: shareBtn,
            intro: "Gunakan tombol ini untuk membagikan silsilah kepada anggota lain (Editor atau Viewer).",
        },
        {
            element: exportSVG,
            intro: "Klik untuk mengekspor pohon keluarga ke format <b>SVG</b> (gambar vektor).",
        },
        {
            element: exportPDF,
            intro: "Klik untuk mengekspor ke format <b>PDF</b>.",
        },
        {
            element: paperArea,
            intro: "Inilah area pohon keluarga. Kamu bisa menambah, mengedit, atau menghapus anggota di sini.",
        },
    ],
    nextLabel: "Lanjut →",
    prevLabel: "← Sebelumnya",
    doneLabel: "Selesai",
    tooltipClass: "customIntroTooltip",
    highlightClass: "customIntroHighlight",
    showProgress: true,
    showBullets: true,
    exitOnOverlayClick: false,
});

// mulai hanya jika belum pernah ditampilkan
if (!localStorage.getItem("intro_silsilah_done")) {
    tour.start();
    tour.oncomplete(() => localStorage.setItem("intro_silsilah_done", "true"));
    tour.onexit(() => localStorage.setItem("intro_silsilah_done", "true"));
}
