// làm chức năng load more để hiênr thị thêm sản phẩm

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function loadMore() {
    const page = $("#page").val();

    $.ajax({
        type: "POST",
        dataType: "JSON",
        data: { page },
        url: "/services/load-product",
        success: function (result) {
            if (result !== "") {
                $("#loadProduct").append(result.html);
                // nang page len 1 trang
                $("#page").val(page + 1);
            } else {
                alert("Đã load xong sản phẩm");
                $("#button-loadMore").css("display", "none");
            }
        },
    });
}
