"use strict";

$('[name="kir_null"]').on("change", function () {
    if ($(this).is(":checked")) {
        $('[name="kir"]').prop("readonly", true);
    } else {
        $('[name="kir"]').prop("readonly", false);
    }
});
