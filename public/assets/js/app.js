
// TABLE OF CONTENTS
"use strict";

jQuery(function ($) {
    ("use strict");
    //preloader with sidebar active class
    $(window).ready(function () {
        //preloader
        $("#preloader").delay(100).fadeOut(1200);
    });

    if ($("#sidebar").length) {
        displayLogo(getCookie("isSideBarCollapsed") ?? "");
        $("#sidebar").hover(
            function () {
                if ($("aside.tt-sidebar.collapse").length) {
                    displayLogo("");
                }
            },
            function () {
                if ($("aside.tt-sidebar.collapse").length) {
                    displayLogo("collapse");
                }
            }
        );
        // side navbar
        document
            .querySelector(".tt-toggle-sidebar")
            .addEventListener("click", function () {
                //store the id of the collapsible element
                setCookie(
                    "isSideBarCollapsed",
                    $("aside.tt-sidebar.collapse").length ? "" : "collapse"
                );
                document.getElementById("sidebar").classList.toggle("collapse");
                displayLogo(
                    $("aside.tt-sidebar.collapse").length ? "collapse" : ""
                );
            });
    }

    if ($(".tt-side-nav").length) {
        let navCollapse = $(".tt-side-nav li .collapse");
        let navToggle = $(".tt-side-nav li [data-bs-toggle='collapse']");
        navToggle.on("click", function (e) {
            return false;
        });


        // activate the menu in left side bar (Vertical Menu) based on url
        $(".tt-side-nav a").each(function () {
            let pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("tt-menu-item-active");
                $(this).parent().parent().parent().addClass("show");
                $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .addClass("tt-menu-item-active"); // add active to li of the current link

                let firstLevelParent = $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent();
                if (firstLevelParent.attr("id") !== "sidebar-menu")
                    firstLevelParent.addClass("show");
                $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .addClass("tt-menu-item-active");
                let secondLevelParent = $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent();
                if (secondLevelParent.attr("id") !== "wrapper")
                    secondLevelParent.addClass("show");
                let upperLevelParent = $(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent();
                if (!upperLevelParent.is("body"))
                    upperLevelParent.addClass("tt-menu-item-active");
            }
        });
    }

 

    // toastr js
    // Set the options that I want
    toastr.options = {
        closeButton: true,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toast-top-center",
        preventDuplicates: false,
        onclick: null,
        showDuration: "3000",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };


    //    select2 js
    $(".select2").each(function () {
        $(this).select2({
            dropdownParent: $(this).parent(),
        });
    });



    //    summernote
    $("#makeMeSummernote").summernote({
        placeholder: "Type your product description",
        toolbar: [
            ["style", ["bold"]],
            ["fontsize", ["fontsize"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
        ],
        height: window.innerHeight - 430,
        lang: "en-US",
        imageAttributes: {
            icon: '<i class="note-icon-pencil"/>',
            figureClass: "figureClass",
            figcaptionClass: "captionClass",
            captionText: "Caption Goes Here.",
            manageAspectRatio: true, // true = Lock the Image Width/Height, Default to true
        },
        popover: {
            image: [
                [
                    "image",
                    ["resizeFull", "resizeHalf", "resizeQuarter", "resizeNone"],
                ],
                ,
                ["float", ["floatLeft", "floatRight", "floatNone"]],
                ["remove", ["removeMedia"]],
                ["custom", ["imageAttributes"]],
            ],
        },
    });
    
    // tooltip
    $("body").tooltip({ selector: '[data-bs-toggle="tooltip"]' });


    // password check
    $(".tt-check-password").each(function () {
        let eyeIcon = $(this).find(".eye-icon");
        eyeIcon.on("click", function () {
            $(this).hide();
            $(this).next().show();
            $(this).siblings("input[type='password']").attr("type", "text");
        });
        let eyeSlash = $(this).find(".eye-icon-off");
        eyeSlash.on("click", function () {
            $(this).hide();
            $(this).prev().show();
            $(this).siblings("input[type='text']").attr("type", "password");
        });
    });
});

// ajaxcall

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function ajaxCall(
    callParams,
    successCallback,
    errorCallback,
    timeout = 200000,
    quietMillis = 100
) {
    let ajaxOption = {
        url: callParams.url,
        timeout: timeout,
        type: callParams.type || "POST", // "POST" OR "GET
        dataType: callParams.dataType || "JSON",
        data: callParams.data || {},
        cache: callParams.cache || false,
        processData: callParams.processData || false,
        contentType: callParams.contentType || false,
        complete: callParams.complete || function () {},
        success: successCallback,
        error: errorCallback,
    };

    if (!callParams.hasOwnProperty("processData")) {
        delete ajaxOption.processData;
    }
    if (!callParams.hasOwnProperty("contentType")) {
        delete ajaxOption.contentType;
    }

    if (!callParams.hasOwnProperty("cache")) {
        delete ajaxOption.cache;
    }

    if (!callParams.hasOwnProperty("complete")) {
        delete ajaxOption.complete;
    }

    $.ajax(ajaxOption);
}

function loading(selector, text = "Loading...") {
    $(selector)
        .html(
            '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' +
                text
        )
        .prop("disabled", true);
}

function loadingInContent(selector, text = "", bg = "") {
    $(selector)
        .html(
            `
            <div class="d-flex justify-content-center align-items-center py-10 gap-1 mx-auto">
                    <div class="tt-loader">
                    <span class="tt-loader-bar-1 ${bg}"></span>
                    <span class="tt-loader-bar-2 ${bg}"></span>
                    <span class="tt-loader-bar-3 ${bg}"></span>
                    <span class="tt-loader-bar-4 ${bg}"></span>
                    <span class="tt-loader-bar-5 ${bg}"></span>
                </div> ${text}
            </div>
            `
        )
        .prop("disabled", true);
}

function loadingInTable(selector, options = {}) {
    let defaultOptions = {
        isLoading: options.isLoading || true,
        loadingText: options.type || "Loading...", // "POST" OR "GET
        colSpan: options.colSpan || 8,
        tdClass: options.tdClass || "",
        bg: options.bg || "",
        prop: options.prop || true,
        icon: options.icon || true,
    };

    let innerContent = "";
    if (defaultOptions.isLoading) {
        innerContent = "Loading...";
    } else {
        innerContent =
            '<span class="material-symbols-rounded fs-48 margin-bottom-5 lh-1">info</span>' +
            "<h5>No Data Found</h5>" +
            "<p>There is no data available.</p>";
    }

    let innerHtml = "";
    if (defaultOptions.icon) {
        innerHtml = `
            <tr>
                <td colspan="${defaultOptions.colSpan}" class="null-td ${defaultOptions.tdClass}">
                    <span class="bt-content">
                        <div class="text-center section-space-y"> 
                            <div class="d-flex justify-content-center align-items-center py-10 gap-1 mx-auto">
                                <div class="tt-loader">
                                <span class="tt-loader-bar-1 ${defaultOptions.bg}"></span>
                                <span class="tt-loader-bar-2 ${defaultOptions.bg}"></span>
                                <span class="tt-loader-bar-3 ${defaultOptions.bg}"></span>
                                <span class="tt-loader-bar-4 ${defaultOptions.bg}"></span>
                                <span class="tt-loader-bar-5 ${defaultOptions.bg}"></span>
                            </div> ${innerContent}
                        </div>
                        </div>
                    </span>
                </td>
            </tr>
            `;
    } else {
        innerHtml = `
            <tr>
                <td colspan="${defaultOptions.colSpan}" class="null-td ${defaultOptions.tdClass}">
                    <span class="bt-content">
                        <div class="text-center section-space-y"> 
                            ${innerContent}
                        </div>
                    </span>
                </td>
            </tr>
            `;
    }

    $(selector).html(innerHtml).prop("disabled", defaultOptions.prop);
}

function loadingInBtn(selector, text = "Loading...", bg = "bg-light") {
    $(selector)
        .html(
            `
            <div class="d-flex justify-content-center align-items-center">
                <div class="tt-loader tt-loader-sm">
                    <span class="tt-loader-bar-1 ${bg}"></span>
                    <span class="tt-loader-bar-2 ${bg}"></span>
                    <span class="tt-loader-bar-3 ${bg}"></span>
                    <span class="tt-loader-bar-4 ${bg}"></span>
                    <span class="tt-loader-bar-5 ${bg}"></span>
                </div>
            </div> ${text}
            `
        )
        .prop("disabled", true);
}

function resetLoading(selector, text) {
    $(selector).prop("disabled", false).html(text);
}

function hideElement(selector) {
    if (!$(selector).hasClass("d-none")) {
        $(selector).addClass("d-none");
    }
}

function removeElement(selector) {
    if ($(selector).length > 0) {
        $(selector).remove();
    }
}

function showElement(selector) {
    if ($(selector).hasClass("d-none")) {
        $(selector).removeClass("d-none");
    }
}

function showSuccess(message) {
    showElement(".message-wrapper");
    hideElement(".message-wrapper .alert.alert-danger");
    $(".message-wrapper .alert.alert-success").html(message);
}

function showError(message) {
    showElement(".message-wrapper");
    hideElement(".message-wrapper .alert.alert-success");
    $(".message-wrapper .alert.alert-danger").html(message);
}

function resetFormErrors(frmSelector) {
    hideElement(".message-wrapper");
    removeElement(frmSelector + " .invalid-feedback");
    $(frmSelector).each(function () {
        $(this).find(":input").removeClass("is-invalid");
    });
}

function showFormError(responseData, formSelector = "") {
    responseData = JSON.parse(responseData?.responseText ?? []);
    showError(responseData?.message);

    $.each(responseData?.errors ?? [], function (fieldName, errorMessage) {
        let fieldHtml = `<span class="invalid-feedback" role="alert">${errorMessage[0]}</span>`;
        $(formSelector + " #" + fieldName + "")
            .addClass("is-invalid")
            .after(fieldHtml);
    });
}

function resetForm(formSelector) {
    $(formSelector)
        .find("input:text, input:password, input:file, select, textarea")
        .val("");
    $("#editor").summernote("code", "");
}

function changeText(txtSelector, text) {
    $(txtSelector).html(text);
}

var gFilterObj = {};
$("body").on("click", ".page-item a", function (event) {
    event.preventDefault();
    let page = parseInt($(this).attr("href").split("page=")[1]);
    gFilterObj.page = isNaN(page) ? 0 : page;
    getDataList();
});

$("body").on("change", "#per_page", function (event) {
    event.preventDefault();
    let perPage = parseInt($("#per_page").val());
    gFilterObj.perPage = isNaN(perPage) ? 20 : perPage;
    if (gFilterObj.hasOwnProperty("page")) {
        delete gFilterObj.page;
    }
    getDataList();
});

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timerProgressBar: true,
    timer: 10000,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    },
});

// status = warning, error, success, info, and question
function toast(msg, status = "success", position = "top-end") {
    Toast.fire({
        icon: status,
        title: `<span class="toast-msg">${msg}</span>`,
        showCloseButton: true,
        position,
        customClass: {
            closeButton: "tt-sw-close-button",
            icon: "tt-sw-icon",
        },
    });
}

function centerToast(
    msg,
    status = "success",
    confirmBTNClass = "",
    closeBTNClass = ""
) {
    Swal.fire({
        title:
            String(status) === "success"
                ? "Success!"
                : "<strong>Oops! Something went wrong.</strong>",
        icon: status,
        text: msg,
        showCloseButton: true,
        confirmButtonText: "Close",
        confirmButtonAriaLabel: "Close",
        customClass: {
            closeButton: closeBTNClass,
            confirmButton: confirmBTNClass,
        },
    });
}

var alertOptions = {
    showCloseButton: true,
    customClass: {
        title: "tt-sw-title",
        icon: "your-icon-class",
    },
    willOpen: function (ele) {
        $(ele)
            .find("button.swal2-confirm")
            .removeClass("swal2-confirm swal2-styled")
            .addClass("btn btn-sm btn-primary me-2");
        $(ele)
            .find("button.swal2-deny")
            .removeClass("swal2-deny swal2-styled")
            .addClass("btn btn-sm btn-secondary");
    },
};
function swAlert(opts) {
    Swal.fire(Object.assign({}, alertOptions, opts));
}
function swConfirm(opts, callback) {
    Swal.fire(Object.assign({}, alertOptions, opts)).then(callback);
}


// resizeTableColumn();

var globalHTMLContent = "";

function saveSettings(options) {
    let entity = options.entity;

    $("#loadingModal").modal("show");

    let callParams = {};
    callParams.type = "POST";
    callParams.url = options.url;
    callParams._token = options._token;

    callParams.data = {
        type: "checkbox",
        value: options.value,
        entity: options.entity,
        _token: options._token,
    };

    ajaxCall(
        callParams,
        function (result) {
            $("#loadingModal").modal("hide");
            toast(result.message);
        },
        function (err, type, httpStatus) {
            $("#loadingModal").modal("hide");
            toast(err.responseJSON.message, "error");
        }
    );
}
