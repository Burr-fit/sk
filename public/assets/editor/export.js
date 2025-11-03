// 🔧 Fungsi bantu: nonaktifkan sementara grid bawaan JointJS
function disableDotGrid(paper) {
  try {
    // 1️⃣ Hapus pattern grid dari <svg>
    const pattern = paper.svg.querySelector('pattern[id*="grid"]');
    const rect = paper.svg.querySelector('rect[fill*="url"]');
    if (pattern) pattern.style.display = "none";
    if (rect) rect.style.display = "none";
    // 2️⃣ Sembunyikan overlay grid (jika ada)
    const overlay = paper.el.querySelector(".joint-grid");
    if (overlay) overlay.style.display = "none";
  } catch (err) {
    console.warn("Gagal mematikan grid:", err);
  }
}

function enableDotGrid(paper) {
  try {
    const pattern = paper.svg.querySelector('pattern[id*="grid"]');
    const rect = paper.svg.querySelector('rect[fill*="url"]');
    if (pattern) pattern.style.display = "";
    if (rect) rect.style.display = "";
    const overlay = paper.el.querySelector(".joint-grid");
    if (overlay) overlay.style.display = "";
  } catch (err) {
    console.warn("Gagal menyalakan grid:", err);
  }
}

function hideCardButtons() {
  document.querySelectorAll(".card .buttons").forEach((btn) => {
    btn.style.display = "none";
  });
}

function showCardButtons() {
  document.querySelectorAll(".card .buttons").forEach((btn) => {
    btn.style.display = "";
  });
}

// ===========================================================
// 🟩 Tombol Export SVG
// ===========================================================
document.getElementById("btnSVG").onclick = () => {
  const overlay = document.createElement("div");
  overlay.id = "loadingOverlay";
  overlay.innerHTML = `
    <div style="
      position:fixed;top:0;left:0;width:100%;height:100%;
      background:rgba(0,0,0,0.6);display:flex;
      align-items:center;justify-content:center;
      z-index:99999;color:#fff;font-family:Poppins,sans-serif;">
      <div style="text-align:center;">
        <div style="
          width:40px;height:40px;border:4px solid #fff;
          border-top:4px solid transparent;border-radius:50%;
          margin:0 auto 10px;animation:spin 0.8s linear infinite;">
        </div>
        <div>Exporting...</div>
      </div>
      <style>@keyframes spin{100%{transform:rotate(360deg)}}</style>
    </div>`;
  document.body.appendChild(overlay);

  hideCardButtons();
  disableDotGrid(paper);

  setTimeout(() => {
    try {
      const svgElement = paper.svg;
      if (!svgElement) throw new Error("SVG belum siap");

      const serializer = new XMLSerializer();
      const svgString = serializer.serializeToString(svgElement);
      const blob = new Blob([svgString], {
        type: "image/svg+xml;charset=utf-8",
      });
      const url = URL.createObjectURL(blob);

      const a = document.createElement("a");
      a.href = url;
      a.download = "diagram.svg";
      a.click();
      URL.revokeObjectURL(url);

      console.log("✅ Export SVG tanpa dot grid.");
    } catch (err) {
      console.error("Gagal export SVG:", err);
      alert("Gagal membuat file SVG.");
    } finally {
      enableDotGrid(paper);
      showCardButtons();
      overlay.remove();
    }
  }, 300);
};

// ===========================================================
// 🟦 Tombol Export PDF
// ===========================================================
document.getElementById("btnPDF").onclick = async () => {
  const { jsPDF } = window.jspdf;
  const paperElement = document.getElementById("paper");

  disableDotGrid(paper);
  hideCardButtons();

  const loading = document.createElement("div");
  loading.innerText = "Generating PDF...";
  Object.assign(loading.style, {
    position: "fixed",
    top: "10px",
    right: "10px",
    background: "#444",
    color: "#fff",
    padding: "8px 12px",
    borderRadius: "6px",
    zIndex: "9999",
    fontFamily: "Poppins, sans-serif",
  });
  document.body.appendChild(loading);

  try {
    const canvas = await html2canvas(paperElement, {
      scale: 2,
      backgroundColor: "#ffffff",
      useCORS: true,
      logging: false,
    });

    const imgData = canvas.toDataURL("image/png");
    const pdf = new jsPDF({
      orientation: "landscape",
      unit: "pt",
      format: "a4",
    });

    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = pdf.internal.pageSize.getHeight();
    const imgProps = pdf.getImageProperties(imgData);
    const imgRatio = imgProps.width / imgProps.height;

    let renderWidth, renderHeight;
    if (pdfWidth / pdfHeight > imgRatio) {
      renderHeight = pdfHeight;
      renderWidth = imgRatio * renderHeight;
    } else {
      renderWidth = pdfWidth;
      renderHeight = renderWidth / imgRatio;
    }

    const x = (pdfWidth - renderWidth) / 2;
    const y = (pdfHeight - renderHeight) / 2;
    pdf.addImage(imgData, "PNG", x, y, renderWidth, renderHeight);
    pdf.save("diagram.pdf");

    console.log("✅ Export PDF tanpa dot grid.");
  } catch (err) {
    console.error("Gagal export PDF:", err);
    alert("Terjadi kesalahan saat membuat PDF.");
  } finally {
    enableDotGrid(paper);
    showCardButtons();
    loading.remove();
  }
};
