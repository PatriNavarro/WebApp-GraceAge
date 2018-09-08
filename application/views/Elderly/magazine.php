<?php
$this->lang->load('magazine', $my_language );
?>

<link rel="stylesheet" href="<?=base_url();?>styles/magazine.css">
<link rel="stylesheet" href="<?=base_url();?>styles/notes.css">
<link rel="stylesheet" href="<?=base_url();?>styles/homescreen.css">


<script src="<?=base_url();?>scripts/pdf.js" type="text/javascript"></script>

<div class="row" id="head-row">
    <div data-step="1" data-intro="<?=$this->lang->line('h_mag_view')?>" data-position='right' id="pdf-canvas" class="col-xs-8 col-md-8 col-sm-8" style="text-align:center; ">
        <canvas id="the-canvas"></canvas>
    </div>
    <div id="column-nav" class="col-xs-4 col-md-4 col-sm-4">
        <div class="row row1">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <a data-step="2" data-intro="<?=$this->lang->line('h_next_pg')?>" data-position='left' href="#" id="next"><?php echo $tile11;?></a>
            </div>
        </div>
        <div class="row row2">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <a data-step="3" data-intro="<?=$this->lang->line('h_prev_pg')?>" data-position='left' href="#" id="prev" ><?php echo $tile21;?></a>
            </div>
        </div>
    </div>
</div>



<script>
    // If absolute URL from the remote server is provided, configure the CORS
    // header on that server.
    var url = "<?=base_url();?>assets/magazine_upload/edRemy.pdf";

    // Disable workers to avoid yet another cross-origin issue (workers need
    // the URL of the script to be loaded, and dynamically loading a cross-origin
    // script does not work).
    //PDFJS.disableWorker = true;

    // The workerSrc property shall be specified.
    PDFJS.workerSrc = "<?=base_url();?>scripts/pdf.worker.js";

    var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 0.6,
        canvas = document.getElementById('the-canvas'),
        ctx = canvas.getContext('2d');


    // Asynchronous download of PDF
    var loadingTask = PDFJS.getDocument(url);
    loadingTask.promise.then(function(pdf) {
        console.log('PDF loaded');
        pdfDoc = pdf;
        // Fetch the first page

        pdf.getPage(pageNum).then(function(page) {
            console.log('Page loaded');

            var viewport = page.getViewport(scale);

            // Prepare canvas using PDF page dimensions
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);
            renderTask.then(function () {
                console.log('Page rendered');
            });
        });
    }, function (reason) {
        // PDF loading error
        console.error(reason);
    });



    /**
     * Get page info from document, resize canvas accordingly, and render page.
     * @param num Page number.
     */
    function renderPage(num) {
        pageRendering = true;
        // Using promise to fetch the page
        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport(scale);
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);

            // Wait for rendering to finish
            renderTask.promise.then(function() {
                pageRendering = false;
                if (pageNumPending !== null) {
                    // New page rendering is pending
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
            });
        });

        // Update page counters
        document.getElementById('page_num').textContent = pageNum;
    }

    /**
     * If another page rendering in progress, waits until the rendering is
     * finised. Otherwise, executes rendering immediately.
     */
    function queueRenderPage(num) {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    }

    /**
     * Displays previous page.
     */
    function onPrevPage() {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        queueRenderPage(pageNum);
    }

    /**
     * Displays next page.
     */
    function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        queueRenderPage(pageNum);
    }

    window.onload=function(){
        document.getElementById('next').addEventListener('click', onNextPage);
        document.getElementById('prev').addEventListener('click', onPrevPage);
    }

</script>

