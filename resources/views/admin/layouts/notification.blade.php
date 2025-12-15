<template id="template">
    <div class="toast-alert toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <div class="toast-title"></div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"></div>
    </div>
    <div class="modal-alert modal modal-blur fade" id="modal-notification" tabindex="-1" role="dialog"
        aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification"></h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-status"></div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <div class="modal-body-icon"></div>
                        <div class="modal-body-content"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white">Ok, Got it</button>
                    <button type="button" class="btn btn-link text-white ml-auto"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<div id="template-area"></div>

<div id="toast-alert-area" class="toast-container position-fixed mt-6 top-0 end-0 p-3">
</div>

<div class="loading-mask">
    <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
