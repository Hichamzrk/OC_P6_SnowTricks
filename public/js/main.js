/* --------------------------------------------------------------------------------- */

/*  /* Show trick media in small screen */

/* --------------------------------------------------------------------------------- */

$(function () {
    $("#loadMedia").on("click", function (e) {
        e.preventDefault();
        $("div.load-media").removeClass("d-none");
        $("#loadMedia").addClass("d-none");
        $("#hideMedia").removeClass("d-none");
    });
    $("#hideMedia").on("click", function (e) {
        e.preventDefault();
        $("div.load-media").addClass("d-none");
        $("#loadMedia").removeClass("d-none");
        $("#hideMedia").addClass("d-none");
    });

});

/* ----------------------------------------------------------------------------------- */

/*  /* Show more tricks in the home page */

/* --------------------------------------------------------------------------------- */

$(function () {
    $("div.trick").slice(0, 6).show();
    $("#loadMoreTrick").on("click", function (e) {
        e.preventDefault();
        $("div.trick:hidden").slice(0, 6).slideDown();
        if ($("div.trick:hidden").length === 0) {
            $("#loadMoreTrick").hide("slow");
            $("#loadLessTrick").show("slow");
        }
    });
    $("#loadLessTrick").on("click", function (e) {
        e.preventDefault();
        $("div.trick").slice(6, $("div.trick").length).hide();
        $("#loadLessTrick").hide("slow");
        $("#loadMoreTrick").show("slow");

    });
});

/* --------------------------------------------------------------------------------- */

/*  /* Enlarge image on click */

/* --------------------------------------------------------------------------------- */

$(document).ready(function () {
    $(".enlarge").on("click", function () {
        $(this).toggleClass("clic-image");
    });
});

/* --------------------------------------------------------------------------------- */

/*  /* Upload field */

/* --------------------------------------------------------------------------------- */

$(document).on("change", ".custom-file-input", function () {
    let fileName = $(this).val().replace(/\\/g, "/").replace(/.*\//, "");
    $(this).parent(".custom-file").find(".custom-file-label").text(fileName);
});

/* --------------------------------------------------------------------------------- */

/*  /* Passing href to modal (delete comment) */

/* --------------------------------------------------------------------------------- */

$("#deleteModal").on("show.bs.modal", function (e) {
    $(this).find("#deleteComment").attr("href", $(e.relatedTarget).data("href"));
});

/* --------------------------------------------------------------------------------- */

/*  /* Passing href to modal (delete trick) */

/* --------------------------------------------------------------------------------- */

$("#deleteTrickModal").on("show.bs.modal", function (e) {
    $(this).find("#deleteTrick").attr("href", $(e.relatedTarget).data("href"));
});

/* --------------------------------------------------------------------------------- */

/*  /* Passing href to modal (delete user) */

/* --------------------------------------------------------------------------------- */

$("#deleteUserModal").on("show.bs.modal", function (e) {
    $(this).find("#deleteUser").attr("href", $(e.relatedTarget).data("href"));
});

/* --------------------------------------------------------------------------------- */

/*  /* Get alt and replace placeholder with it */

/* --------------------------------------------------------------------------------- */
var i = 0;
$(".img-trick").each(function () {
    var alt = $(this).attr("alt");
    $("label[for=trick_images_" + i + "_image]").text(alt);
    i++;
});

/* --------------------------------------------------------------------------------- */

/*  /* Trick collection */

/* --------------------------------------------------------------------------------- */

function displayCounter() {
    const countImage = +$("#trick_images div.form-group").length;
    const counterImage = countImage + "/8";
    $(".counter-image").text(counterImage);
    if (countImage >= 8) {
        $("#add-image").hide();
    } else {
        $("#add-image").show();
    }
    const countVideo = +$("#trick_videos div.form-group").length;
    const counterVideo = countVideo + "/8";
    $(".counter-video").text(counterVideo);
    if (countVideo >= 8) {
        $("#add-video").hide();
    } else {
        $("#add-video").show();
    }
}

function updateCounterImage() {
    const count = +$("#trick_images div.form-group").length;
    $("#image-counter").val(count);
}

function updateCounterVideo() {
    const count = +$("#trick_videos div.form-group").length;
    $("#video-counter").val(count);
}

function handleDeleteButtons() {
    $("button[data-action='delete']").click(function () {
        const target = this.dataset.target;
        $(target).remove();
        updateCounterImage();
        updateCounterVideo();
        displayCounter();
    });
}

$("#add-image").click(function () {
    const index = +$("#image-counter").val();
    const tmpl = $("#trick_images").data("prototype").replace(/__name__/g, index);
    $("#trick_images").append(tmpl);
    $("#image-counter").val(index + 1);
    handleDeleteButtons();
    displayCounter();
});


$("#add-video").click(function () {
    const index = +$("#video-counter").val();
    const tmpl = $("#trick_videos").data("prototype").replace(/__name__/g, index);
    $("#trick_videos").append(tmpl);
    $("#video-counter").val(index + 1);
    handleDeleteButtons();
    displayCounter();
});

displayCounter();
updateCounterVideo();
updateCounterImage();
handleDeleteButtons();