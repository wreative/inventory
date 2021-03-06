"use strict";

$("#report").dataTable({
    responsive: true,
});

function getProgress(id) {
    $.ajax({
        url: "/reports/" + id,
        type: "GET",
        success: function (data) {
            console.log(data.progress);
            if (data.status == "error") {
                swal({
                    title: "Error",
                    text: "Diskon persen yang dimasukkan melebihi 100%",
                    icon: "error",
                    button: "Ok",
                });
                $("#price").val(0);
            } else {
                // console.log(data.items);
                const wrapper = document.createElement("div");
                wrapper.innerHTML =
                    "<table class='table table-hover'>" +
                    "<thead><tr><th scope='col'>Nama Progress</th>" +
                    "</tr></thead>" +
                    "<tbody id='progress'>" +
                    "</td></tr>" +
                    "</tbody></table>";
                swal({
                    title:
                        "Progress " +
                        data.reports.relation_user.name +
                        " Tanggal " +
                        moment(data.reports.tgl).format("DD-MM-Y"),
                    content: wrapper,
                    icon: "info",
                    button: "Tutup",
                });
                for (var i = 0; i < data.progress.length; i++) {
                    $("#progress").append(
                        "<tr><th scope='row'>" + data.progress[i] + "</th></tr>"
                    );
                }
            }
        },
    });
}

function accept(id, username) {
    swal({
        title:
            "Yakin untuk menerima pengumpulan laporan dari " + username + "?",
        icon: "warning",
        buttons: true,
    }).then((okay) => {
        if (okay) {
            swal({
                title: "Berhasil",
                text: "Laporan dari " + username + " berhasil diterima",
                icon: "success",
                button: "Ok",
            }).then(() => {
                window.location.href = "/accept/" + id;
            });
        }
    });
}

function decline(id, username) {
    swal({
        title: "Yakin untuk menolak pengumpulan laporan dari " + username + "?",
        icon: "warning",
        buttons: true,
    }).then((okay) => {
        if (okay) {
            swal({
                title: "Ditolak",
                text: "Laporan dari " + username + " ditolak",
                icon: "error",
                button: "Ok",
            }).then(() => {
                window.location.href = "/decline/" + id;
            });
        }
    });
}
