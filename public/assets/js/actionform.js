// ========================= PREVIEW FOTO =========================
document.addEventListener("change", function (e) {
    if (e.target && e.target.id === "foto") {
        const inputFoto = e.target;
        const file = inputFoto.files[0];
        const preview = document.getElementById("previewFoto");
        const placeholder = document.getElementById("uploadPlaceholder");

        if (!file) {
            preview.src = "";
            preview.classList.add("d-none");
            placeholder.classList.remove("d-none");
            return;
        }

        const allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/jpg",
            "image/webp",
        ];
        if (!allowedTypes.includes(file.type)) {
            Swal.fire({
                icon: "error",
                title: "Format Tidak Didukung",
                text: "Gunakan file JPG, PNG, atau WEBP.",
            });
            inputFoto.value = "";
            return;
        }

        const reader = new FileReader();
        reader.onload = function (ev) {
            preview.src = ev.target.result;
            preview.classList.remove("d-none");
            placeholder.classList.add("d-none");
        };
        reader.readAsDataURL(file);
    }
});

const form = document.getElementById("formCreateUser");

form.addEventListener("submit", async function (e) {
    e.preventDefault();
    const formData = new FormData(form);
    const csrf = document.querySelector('input[name="_token"]').value;
    try {
        // Tampilkan loading Swal
        Swal.fire({
            title: "Menyimpan...",
            text: "Mohon tunggu sebentar",
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading(),
        });

        const res = await fetch(form.action, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrf,
            },
            body: formData,
        });

        const data = await res.json();

        console.log("Raw response:", data);

        // Tutup loading Swal
        Swal.close();

        if (data.ok) {
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: data.message || "Data orang berhasil disimpan.",
                timer: 2000,
                showConfirmButton: false,
            });

            // Tutup modal setelah delay kecil
            setTimeout(() => {
                const modalEl = document.getElementById("modalCreateUser");
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();

                // Reset form & preview
                form.reset();
                document.getElementById("previewFoto").src = "";
                document.getElementById("previewFoto").classList.add("d-none");
                document
                    .getElementById("uploadPlaceholder")
                    .classList.remove("d-none");
            }, 800);
        } else {
            let errorMsg = data.message || "Terjadi kesalahan.";
            if (data.errors) {
                const allErrors = Object.values(data.errors)
                    .flat()
                    .join("<br>");
                errorMsg = allErrors;
            }

            Swal.fire({
                icon: "error",
                title: "Gagal!",
                html: errorMsg,
            });
        }
    } catch (err) {
        Swal.fire({
            icon: "error",
            title: "Kesalahan Server!",
            text: err.message || "Terjadi kesalahan tak terduga.",
        });
    }
});
