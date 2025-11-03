// === GLOBAL VARIABEL ===
window.panX = 0;
window.panY = 0;
window.zoom = 1;

// --- UPDATE TRANSFORM ---
window.updateTransform = function () {
  const svg = paper.svg;
  svg.style.transformOrigin = "0 0";
  svg.style.transform = `translate(${panX}px, ${panY}px) scale(${zoom})`;
};

// --- PANNING ---
let isPanning = false;
let posisiX, posisiY;

paper.on("blank:pointerdown", (evt) => {
  isPanning = true;
  posisiX = evt.clientX;
  posisiY = evt.clientY;
  paper.svg.style.cursor = "grabbing";
});

document.addEventListener("pointerup", () => {
  isPanning = false;
  paper.svg.style.cursor = "grab";
});

document.addEventListener("pointermove", (evt) => {
  if (!isPanning) return;
  panX += evt.clientX - posisiX;
  panY += evt.clientY - posisiY;
  posisiX = evt.clientX;
  posisiY = evt.clientY;
  updateTransform();
});

document.addEventListener("wheel", function (evt) {
  if (!evt.ctrlKey) return; // aktifkan zoom hanya saat Ctrl ditekan
  evt.preventDefault();
  const delta = evt.deltaY < 0 ? 1 : -1;
  const newScale = Math.min(
    maxZoom,
    Math.max(minZoom, currentScale + delta * zoomStep)
  );

  // Titik zoom di tengah viewport
  const rect = container.getBoundingClientRect();
  const offsetX = evt.clientX - rect.left + container.scrollLeft;
  const offsetY = evt.clientY - rect.top + container.scrollTop;

  const ratio = newScale / currentScale;
  container.scrollLeft = offsetX * ratio - evt.clientX + rect.left;
  container.scrollTop = offsetY * ratio - evt.clientY + rect.top;

  currentScale = newScale;
  paper.scale(currentScale);
});
