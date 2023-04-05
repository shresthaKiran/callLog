$(document).ready(function () {
    $('#add-call-header').on('click', function () {
        window.location.href = "add-call-header";
    });

    $('.delete-call-header').on('click', function () {
        let id = $(this).attr('data-target');
        $.ajax({
            url: "/delete-call-header",
            type: 'POST',
            data: { call_id: id }
        }).done(function (res) {
            if (!alert('Call log successfully deleted')) {
                window.location.reload();
            }
        }).fail(function () {
            alert("Failed to delete Call log");
        })
    });

    $('.view-call-header').on('click', function () {
        let id = $(this).attr('data-target');
        window.location.href = "/view-call-header?id=" + id
    });

    $('#add-call-details').on('click', function () {
        let id = $(this).attr('data-target');
        window.location.href = 'add-call-details?id=' + id;
    });

    $(".delete-call-detail").on('click', function () {
        let id = $(this).attr('data-target');
        $.ajax({
            url: "/delete-call-detail?id=" + id,
            type: 'POST',
            data: { id: id }
        }).done(function (res) {
            if (!alert('Call detail successfully deleted')) {
                window.location.reload();
            }
        }).fail(function () {
            alert("Failed to delete Call detail");
        })
    });
});