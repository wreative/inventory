"use strict";

$('[name="kir_null"]').on("change", function () {
    if ($(this).is(":checked")) {
        $('[name="kir"]').prop("readonly", true);
    } else {
        $('[name="kir"]').prop("readonly", false);
    }
});

$('[name="tax_null"]').on("change", function () {
    if ($(this).is(":checked")) {
        $('[name="tax"]').prop("readonly", true);
    } else {
        $('[name="tax"]').prop("readonly", false);
    }
});

$('[name="stnk_null"]').on("change", function () {
    if ($(this).is(":checked")) {
        $('[name="stnk"]').prop("readonly", true);
    } else {
        $('[name="stnk"]').prop("readonly", false);
    }
});
