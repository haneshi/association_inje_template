"use strict";

document.addEventListener("DOMContentLoaded", () => {
    window.addEventListener("scroll", apps.layouts.toggleScrollButton);
});

const apps = {
    options: {
        sound: true,
    },
    func: {
        resetClassName: (element, ...className) => {
            element.className = "";
            element.classList.add(...className);
        },
    },
    layouts: {
        loadingMask: function (type, delay = null) {
            const loadingMask = document.querySelector(".loading-mask");
            switch (type) {
                case "delay":
                    delay = delay ?? 2000;
                    delay += 1000;
                    loadingMask.style.display = "flex";
                    setTimeout(function () {
                        loadingMask.style.display = "none";
                    }, delay);
                    break;
                case "play":
                case "start":
                case "go":
                    loadingMask.style.display = "flex";
                    break;
                case "stop":
                case "end":
                case "finish":
                    loadingMask.style.display = "none";
                    break;
            }
        },
        toggleScrollButton: () => {
            const btnGotoTop = document.getElementById("btnGotoTop");
            if (btnGotoTop) {
                if (
                    document.body.scrollTop > 50 ||
                    document.documentElement.scrollTop > 50
                ) {
                    btnGotoTop.style.display = "block";
                } else {
                    btnGotoTop.style.display = "none";
                }
            }
        },
        scrollToTop: () => {
            document.body.scrollTop = 0; // Safari 용
            document.documentElement.scrollTop = 0; // Chrome, Firefox, IE 및 Opera 용
        },
        sound: {
            play: function (soundName) {
                if (apps.options.sound) {
                    switch (soundName) {
                        case "success":
                            this.setSound("success");
                            break;
                        case "danger":
                        case "error":
                            this.setSound("error");
                            break;
                        case "info":
                        case "bell":
                            this.setSound("bell");
                            break;
                        case "warning":
                            this.setSound("warning");
                            break;
                    }
                }
            },
            setSound: function (sound = "error") {
                if (apps.options.sound) {
                    const path = "/assets/plugins/apps/sound";
                    const audioElement = document.createElement("audio");
                    if (!navigator.userAgent.match("Firefox/")) {
                        audioElement.setAttribute(
                            "src",
                            path + "/" + sound + ".mp3"
                        );
                    } else {
                        audioElement.setAttribute(
                            "src",
                            path + "/" + sound + ".ogg"
                        );
                    }

                    audioElement.play().catch(function (error) {
                        console.warn("사운드 재생 실패:", error);
                    });
                }
            },
        },
        showModalTemplate: function (
            data = {},
            templateSelector = ".modal-alert"
        ) {
            // init
            const option = {};

            option.type = data.type ?? "error";
            option.color = data.color ?? false;

            option.size = data.size ?? "";
            option.icon = data.icon ?? true;
            option.title = data.title ?? "";
            option.content = data.content ?? "";
            option.footer =
                data.footer ??
                `<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>`;

            const templateEl = document.getElementById("template");
            const templateElChild =
                templateEl.content.querySelector(templateSelector);
            const templateDiv = document.importNode(templateElChild, true);

            const modal = new bootstrap.Modal(templateDiv);

            const dialog = templateDiv.querySelector(".modal-dialog");
            const status = templateDiv.querySelector(".modal-status");
            const title = templateDiv.querySelector(".modal-title");
            const icon = templateDiv.querySelector(".modal-body-icon");
            const content = templateDiv.querySelector(".modal-body-content");
            const footer = templateDiv.querySelector(".modal-footer");

            // process
            icon.innerHTML = "";
            apps.func.resetClassName(status, "modal-status");

            let iconTextColor = "text-primary";
            if (!option.color) {
                switch (option.type) {
                    case "warning":
                    case "success":
                    case "info":
                        status.classList.add(`bg-${option.type}`);
                        iconTextColor = `text-${option.type}`;
                        break;
                    case "error":
                    default:
                        status.classList.add("bg-danger");
                        iconTextColor = `text-danger`;
                        break;
                }
            } else {
                status.classList.add(`bg-${option.color}`);
                iconTextColor = `text-${option.color}`;
            }

            switch (option.type) {
                case "success":
                    if (option.icon) {
                        icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon mb-3 ${iconTextColor} icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>`;
                    }
                    break;
                case "warning":
                    if (option.icon) {
                        icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon mb-3 ${iconTextColor} icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z"/><path d="M12 9v4" /><path d="M12 17h.01" /></svg>`;
                    }
                    break;
                case "error":
                    if (option.icon) {
                        icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="icon  mb-3 ${iconTextColor} icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1 -19.995 .324l-.005 -.324l.004 -.28c.148 -5.393 4.566 -9.72 9.996 -9.72zm.01 13l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -8a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor"></path></svg>`;
                    }
                    break;
            }
            this.sound.play(option.type);
            apps.func.resetClassName(
                dialog,
                "modal-dialog",
                "modal-dialog-scrollable",
                "modal-dialog-centered"
            );

            switch (
                option.size // 500px
            ) {
                case "sm": // 300px
                    dialog.classList.add("modal-sm");
                    break;
                case "lg": // 800px
                    dialog.classList.add("modal-lg");
                    break;
                case "xl": // 1140px
                    dialog.classList.add("modal-xl");
                    break;
                case "full":
                    dialog.classList.add("modal-full-width");
                    break;
            }

            title.innerHTML = option.title;
            content.innerHTML = option.content;
            footer.innerHTML = option.footer;

            const templateArea = document.getElementById("template-area");
            templateArea.appendChild(templateDiv);

            modal.show();

            if (data.event) {
                templateDiv.addEventListener("hidden.bs.modal", function () {
                    switch (data.event.type) {
                        case "focus":
                            document.querySelector(data.event.selector).focus();
                            break;
                        case "replace":
                            window.location.replace(data.event.url);
                            break;
                        case "reload":
                            window.location.reload();
                            break;
                        case "back":
                            window.history.back();
                            break;
                    }
                });
            }
        },
        showToastTemplate: function (
            data = {},
            templateSelector = ".toast-alert",
            toastAlertAreaId = "toast-alert-area"
        ) {
            // option
            const option = {};
            option.type = data.type ?? "error";
            option.bgClass = data.bgClass ?? false;
            option.delay = data.delay ?? 2000;
            option.autohide = data.autohide ?? true;

            option.title = data.title ?? "";
            option.content = data.content ?? "";

            const templateEl = document.getElementById("template");
            const templateElChild =
                templateEl.content.querySelector(templateSelector);
            const templateDiv = document.importNode(templateElChild, true);

            const toast = new bootstrap.Toast(templateDiv, {
                autohide: option.autohide,
                delay: option.delay,
                animation: true,
            });

            const titleArea = templateDiv.querySelector(".toast-header");
            const title = templateDiv.querySelector(".toast-title");
            const content = templateDiv.querySelector(".toast-body");

            apps.func.resetClassName(titleArea, "toast-header", "text-white");

            let bgEl = titleArea;
            apps.func.resetClassName(content, "toast-body");

            if (option.title === "") {
                content.classList.add("text-white");
                bgEl = content;
            }

            if (!option.bgClass) {
                switch (option.type) {
                    case "warning":
                    case "success":
                    case "info":
                        option.bgClass = `bg-${option.type}`;
                        break;
                    case "error":
                    default:
                        option.bgClass = `bg-danger`;
                        break;
                }
            }

            bgEl.classList.add(option.bgClass);
            this.sound.play(option.type);

            if (option.title) {
                titleArea.style.display = "flex";
                title.innerHTML = option.title;
            } else {
                titleArea.style.display = "none";
            }

            if (option.content) {
                content.style.display = "block";
                content.innerHTML = option.content;
            } else {
                content.style.display = "none";
            }

            if (data.delayMask) {
                this.loadingMask("delay", option.delay);
            }

            const templateArea = document.getElementById(toastAlertAreaId);
            templateArea.appendChild(templateDiv);

            toast.show();

            if (data.event) {
                templateDiv.addEventListener("hidden.bs.toast", function () {
                    switch (data.event.type) {
                        case "focus":
                            apps.layouts.loadingMask("stop");
                            document.querySelector(data.event.selector).focus();
                            break;
                        case "replace":
                            window.location.replace(data.event.url);
                            break;
                        case "reload":
                            window.location.reload();
                            break;
                        case "back":
                            history.back();
                            break;
                    }
                });
            }
        },
        setToastAlertPosition: function (
            pos_name,
            toastEl = "toast-alert-area"
        ) {
            const toastAlertEl = document.getElementById(toastEl);
            toastAlertEl.classList.remove(
                "top-0",
                "start-0",
                "top-50",
                "start-50",
                "end-0",
                "bottom-0",
                "translate-middle-x",
                "translate-middle-y"
            );
            switch (pos_name) {
                case "top-left":
                    toastAlertEl.classList.add("top-0");
                    toastAlertEl.classList.add("start-0");
                    break;
                case "top-middle":
                    toastAlertEl.classList.add("top-0");
                    toastAlertEl.classList.add("start-50");
                    toastAlertEl.classList.add("translate-middle-x");
                    break;
                case "middle-left":
                    toastAlertEl.classList.add("top-50");
                    toastAlertEl.classList.add("start-0");
                    toastAlertEl.classList.add("translate-middle-y");
                    break;
                case "middle-middle":
                    toastAlertEl.classList.add("top-50");
                    toastAlertEl.classList.add("start-50");
                    toastAlertEl.classList.add("translate-middle");
                    break;
                case "middle-right":
                    toastAlertEl.classList.add("top-50");
                    toastAlertEl.classList.add("end-0");
                    toastAlertEl.classList.add("translate-middle-y");
                    break;
                case "bottom-left":
                    toastAlertEl.classList.add("bottom-0");
                    toastAlertEl.classList.add("tart-0");
                    break;
                case "bottom-middle":
                    toastAlertEl.classList.add("bottom-0");
                    toastAlertEl.classList.add("start-50");
                    toastAlertEl.classList.add("translate-middle-x");
                    break;
                case "bottom-right":
                    toastAlertEl.classList.add("bottom-0");
                    toastAlertEl.classList.add("end-0");
                    break;
                case "top-right":
                default:
                    toastAlertEl.classList.add("top-0");
                    toastAlertEl.classList.add("end-0");
                    break;
            }
        },
        textToCopy: function (id) {
            const el = document.getElementById(id);
            navigator.clipboard
                .writeText(el.textContent)
                .then(function () {
                    this.showToastTemplate({
                        type: "success",
                        title: "텍스트가 복사되었습니다.",
                    });
                })
                .catch(function (err) {
                    console.error("텍스트 복사 실패:", err);
                });
        },
        htmlToCopy: function (id) {
            const el = document.getElementById(id);
            navigator.clipboard
                .writeText(el.innerHTML)
                .then(function () {
                    this.showToastTemplate({
                        type: "success",
                        title: "HTML 내용이 복사되었습니다.",
                    });
                })
                .catch(function (err) {
                    console.error("HTML 내용 복사 실패:", err);
                });
        },
    },
    plugins: {
        JustValidate: {
            basic: (option) => {
                return {
                    errorFieldCssClass: ["is-invalid"],
                    errorLabelCssClass: ["invalid-feedback"],
                    ...option,
                };
            },
            tooltip: (option) => {
                return {
                    tooltip: {
                        position: "top",
                    },
                    ...option,
                };
            },
        },
    },
};
