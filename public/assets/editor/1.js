function initPaper() {
    const el = document.getElementById("paper");
    if (!el) {
        console.warn("Elemen #paper belum ditemukan di DOM");
        return;
    }

    const width = el.clientWidth || window.innerWidth;
    const height = el.clientHeight || window.innerHeight;

    const { dia, util, shapes } = joint;
    const graph = new dia.Graph({}, { cellNamespace: shapes });
    const paper = new dia.Paper({
        el,
        width,
        height,
        gridSize: 10,
        drawGrid: {
            name: "dot",
            args: { color: "#999999", thickness: 2 },
        },
        async: true,
        model: graph,
        cellViewNamespace: joint.shapes,
        background: { color: "#fcfcfc" },
        panning: false,
    });

    // === Define custom HTML node
    const HtmlCard = dia.Element.define(
        "custom.HtmlCard",
        {
            attrs: {
                foreignObject: { width: "calc(w)", height: "calc(h)" },
                label: { text: "" },
            },
        },
        {
            markup: util.svg/* xml */ `
                <rect @selector="body"/>
                <foreignObject @selector="foreignObject" overflow="visible">
                  <div xmlns="http://www.w3.org/1999/xhtml">
                    <div class="card" style="
                        background: #07182e;
                        position: relative;
                        display: inline-flex;
                        place-content: center;
                        place-items: center;
                        width: fit-content;
                        overflow: hidden;
                        border-radius: 20px;
                        box-shadow: 0 0 10px #00b7ff44;">
                      <div class="content" style="
                          display: flex;
                          align-items: center;
                          position: relative;
                          z-index: 1;
                          width: 100%;
                          padding: 10px;">
                        <div class="avatar" style="
                            width: 70px;
                            height: 70px;
                            border-radius: 50%;
                            overflow: hidden;
                            flex-shrink: 0;
                            border: 2px solid #00b7ff;">
                          <img src="75.jpg" alt="Profil" style="width:100%;height:100%;object-fit:cover" />
                        </div>
                        <div class="info" style="
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            flex: 1;
                            text-align: left;
                            margin-left: 5px;">
                          <div class="name" style="
                              font-size: 1.1rem;
                              font-weight: 600;
                              margin-bottom: 5px;
                              color: #bbb;">Nama</div>
                          <div class="date" style="font-size:0.9rem;color:#bbb">Tanggal</div>
                          <div class="buttons">
                            <button class="btn primary" data-tooltip="Detail" data-bs-toggle="modal" data-bs-target="#modalCreateUser"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn primary" data-tooltip="Tambah"><i class="fa-solid fa-user-plus"></i></button>
                            <button class="btn primary" data-tooltip="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn danger" data-tooltip="Hapus"><i class="fa-solid fa-trash"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </foreignObject>
            `,
        }
    );

    const Addorang = dia.Element.define(
        "custom.Addorang",
        {
            attrs: {
                foreignObject: { width: "calc(w)", height: "calc(h)" },
                label: { text: "" },
            },
        },
        {
            markup: util.svg/* xml */ `
                <rect @selector="body"/>
                <foreignObject @selector="foreignObject" overflow="visible">
                  <div xmlns="http://www.w3.org/1999/xhtml">
                    <div class="card" style="
                        background: #07182e;
                        position: relative;
                        display: inline-flex;
                        place-content: center;
                        place-items: center;
                        width: fit-content;
                        overflow: hidden;
                        border-radius: 20px;
                        box-shadow: 0 0 10px #00b7ff44;">
                      <div class="content" style="
                          display: flex;
                          align-items: center;
                          position: relative;
                          z-index: 1;
                          width: 100%;
                          padding: 10px;">
                            <button class="btn primary" data-tooltip="Tambah" data-bs-toggle="modal" data-bs-target="#modalCreateUser"><i class="fa-solid fa-user-plus"></i></button>
                        <div class="info" style="
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            flex: 1;
                            text-align: left;
                            margin-left: 5px;">
                            <div class="name">Tambah Orang</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </foreignObject>
            `,
        }
    );

    let familyPayload = {};
    try {
        const attr = el.getAttribute("data-family");
        if (attr) {
            familyPayload = JSON.parse(attr);
        }
    } catch (err) {
        console.error("Gagal parse data-family:", err);
        familyPayload = {};
    }

    const jumlahData = familyPayload?.jumlahData || 0;
    const familyData = Array.isArray(familyPayload?.data)
        ? familyPayload.data
        : [];

    if (jumlahData === 0 || familyData.length === 0) {
        const addNode = new Addorang({
            position: { x: width / 2 - 100, y: height / 2 - 40 },
            size: { width: 240, height: 80 },
        });
        graph.addCell(addNode);
        return; // stop di sini
    }

    // === Helper functions
    function createLink(source, target) {
        return new joint.shapes.standard.Link({
            source: { id: source.id },
            target: { id: target.id },
            router: { name: "manhattan" },
            connector: { name: "rounded" },
            attrs: {
                line: { stroke: "#10b981", strokeWidth: 3 },
            },
        });
    }

    function createFamilyNode(person, posX, posY) {
        return new HtmlCard({
            id: `node${person.id}`,
            position: { x: posX, y: posY },
            size: { width: 320, height: 80 },
        });
    }

    // === Layout setup
    const verticalGap = 200;
    const horizontalGap = 300;
    const startY = 20;
    const startX = window.innerWidth / 2;

    const nodeMap = {};
    const childrenMap = {};
    const nodes = [];

    // mapping parent-child
    for (const p of familyData) {
        nodeMap[p.id] = p;
        if (!childrenMap[p.parent_id]) childrenMap[p.parent_id] = [];
        childrenMap[p.parent_id].push(p);
    }

    let nextX = 0;
    function layoutTree(nodeId, depth) {
        const children = childrenMap[nodeId] || [];
        if (children.length === 0) {
            const x = nextX * horizontalGap;
            nextX++;
            nodeMap[nodeId]._layout = { x, y: startY + depth * verticalGap };
            return x;
        }

        let minX = Infinity,
            maxX = -Infinity;
        for (const child of children) {
            const cx = layoutTree(child.id, depth + 1);
            minX = Math.min(minX, cx);
            maxX = Math.max(maxX, cx);
        }

        const x = (minX + maxX) / 2;
        nodeMap[nodeId]._layout = { x, y: startY + depth * verticalGap };
        return x;
    }

    // layout untuk semua root
    const roots = childrenMap[null] || [];
    nextX = 0;
    for (const root of roots) layoutTree(root.id, 0);

    const allX = Object.values(nodeMap).map((n) => n._layout.x);
    const minX = Math.min(...allX);
    const maxX = Math.max(...allX);
    const totalWidth = maxX - minX;
    const offsetX = startX - totalWidth / 2;

    // render node
    for (const person of familyData) {
        const pos = nodeMap[person.id]._layout;
        const node = createFamilyNode(person, pos.x + offsetX, pos.y);
        graph.addCell(node);
        nodes[person.id] = node;

        // update isi HTML
        paper.once("render:done", () => {
            const view = node.findView(paper);
            if (!view) return;
            const card = view.el.querySelector(".card");
            if (card) {
                card.querySelector(".name").textContent = person.nama;
                card.querySelector(
                    ".date"
                ).textContent = `${person.tanggal_lahir} - ${person.tanggal_wafat}`;
                card.querySelector("img").src = person.foto;
            }
        });
    }

    // render links
    for (const person of familyData) {
        if (person.parent_id) {
            const parentNode = nodes[person.parent_id];
            const childNode = nodes[person.id];
            if (parentNode && childNode) {
                const link = createLink(parentNode, childNode);
                graph.addCell(link);
                link.toBack();
            }
        }
    }

    // auto-zoom center
    setTimeout(() => {
        const bbox = graph.getBBox(graph.getElements());
        const pw = paper.el.clientWidth;
        const ph = paper.el.clientHeight;

        const scaleX = pw / (bbox.width + 200);
        const scaleY = ph / (bbox.height + 200);
        const scale = Math.min(scaleX, scaleY, 1);

        paper.scale(scale);
        const cx = pw / 2 - (bbox.x + bbox.width / 2) * scale;
        const cy = ph / 2 - (bbox.y + bbox.height / 2) * scale;
        paper.translate(cx, cy);
    }, 0);

    // event tools
    paper.on("link:mouseenter", (linkView) => {
        const tools = new joint.dia.ToolsView({
            tools: [new joint.linkTools.Vertices()],
        });
        linkView.addTools(tools);
    });

    paper.on("link:mouseleave", (linkView) => linkView.removeTools());

    // cursor fix
    const style = document.createElement("style");
    style.textContent = `
      #paper, #paper svg, .joint-paper, .joint-paper svg {
        cursor: default !important;
      }
      .joint-paper.joint-theme-default, .joint-paper.joint-theme-default.grabbing {
        cursor: default !important;
      }
    `;
    document.head.appendChild(style);

    window.nodes = nodes;
    console.log("✅ Paper & graph berhasil diinisialisasi");
}

// Jalankan setelah DOM ready
window.initPaper = initPaper;
