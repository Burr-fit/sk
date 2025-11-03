<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
    <h3 class="mb-0">Mulai Buat Silsilah Keluarga</h3>
</div>

<div class="row mb-2" style="height:100vh;">
    <div id="paper"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@joint/core/dist/joint.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="{{ asset('assets/editor/1.js') }}"></script>

<script>
    setTimeout(() => {
        if (typeof initPaper === 'function') {
            console.log("🧩 InitPaper dijalankan dari halaman Silsilah");
            initPaper();
        } else {
            console.error("initPaper() belum didefinisikan");
        }
    }, 100);
</script>
