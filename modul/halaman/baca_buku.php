<?php 
include_once '../fungsi/Home.php';
include_once '../fungsi/Peminjaman.php';
include_once '../../lib/koneksi.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $home = new Home(db: $conn);
    $buku = $home->getEbookById($id);
    $pdfPath = '../../assets/ebook/' . basename($buku['file_path']);

    }
?>

<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #2c2c2c;
        color: white;
        font-family: sans-serif;
    }

    canvas {
        max-width: 90%;
        max-height: 80vh;
        margin-top: 20px;
        background: white;
    }

    .controls {
        margin-top: 10px;
        display: flex;
        gap: 10px;
    }

    button {
        padding: 8px 16px;
        border: none;
        background-color: #3490dc;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    button:disabled {
        background-color: gray;
        cursor: not-allowed;
    }
</style>
<?php if (!empty($pdfPath)): ?>
    <canvas id="pdfViewer"></canvas>
    <div class="controls">
        <button id="prevPage">⟨ Sebelumnya</button>
        <span>Halaman <span id="pageNum">1</span> dari <span id="pageCount">?</span></span>
        <button id="nextPage">Berikutnya ⟩</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script>
        
        const url = "<?= $pdfPath; ?>";

        let pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 1.5,
            canvas = document.getElementById('pdfViewer'),
            ctx = canvas.getContext('2d');

        function renderPage(num) {
            pageRendering = true;
            pdfDoc.getPage(num).then(function(page) {
                const viewport = page.getViewport({ scale: scale });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                const renderTask = page.render(renderContext);

                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            document.getElementById('pageNum').textContent = num;
        }

        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        function onPrevPage() {
            if (pageNum <= 1) return;
            pageNum--;
            queueRenderPage(pageNum);
        }

        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) return;
            pageNum++;
            queueRenderPage(pageNum);
        }

        document.getElementById('prevPage').addEventListener('click', onPrevPage);
        document.getElementById('nextPage').addEventListener('click', onNextPage);

        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
    pdfDoc = pdfDoc_;
    document.getElementById('pageCount').textContent = pdfDoc.numPages;
    renderPage(pageNum);
}).catch(function(error) {
    console.error('Gagal load PDF:', error);
});

           
    </script>
<?php else: ?>
    <p>PDF tidak ditemukan.</p>
<?php endif; ?>
