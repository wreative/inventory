"use strict";

$('[name="pln_null"]').on("change", function () {
    if ($(this).is(":checked")) {
        $('[name="pln"]').prop("readonly", true);
        $('[name="due_pln"]').prop("readonly", true);
    } else {
        $('[name="pln"]').prop("readonly", false);
        $('[name="due_pln"]').prop("readonly", false);
    }
});

$('[name="pdam_null"]').on("change", function () {
    if ($(this).is(":checked")) {
        $('[name="pdam"]').prop("readonly", true);
        $('[name="due_pdam"]').prop("readonly", true);
    } else {
        $('[name="pdam"]').prop("readonly", false);
        $('[name="due_pdam"]').prop("readonly", false);
    }
});

$('[name="wifi_null"]').on("change", function () {
    if ($(this).is(":checked")) {
        $('[name="wifi"]').prop("readonly", true);
        $('[name="due_wifi"]').prop("readonly", true);
    } else {
        $('[name="wifi"]').prop("readonly", false);
        $('[name="due_wifi"]').prop("readonly", false);
    }
});
