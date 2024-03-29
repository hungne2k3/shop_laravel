$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// viết chức năng xóa cho bên file Helper
function removeRow(id, url) {
    if (confirm("Bạn có chắc chắn muốn xóa không?")) {
        $.ajax({
            type: "DELETE",
            datatype: "JSON",
            data: { id },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert("xoa loi vui long thu lai");
                }
            },
        });
    }
}
