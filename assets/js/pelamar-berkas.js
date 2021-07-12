    $(".upload-clicker").on("click",function(){
        $(this).closest(".row").find("input[type=file]").click();
    });
    $("input[type=file]").on("change", function(event){
        var img = $(this).closest(".row").find("img");
        if (img) {
            img.attr("src", URL.createObjectURL(event.target.files[0]));
            if (parseInt(img.css("height"))>=250) {img.css("height", "250");};
        };
        var lbl = $(this).closest(".row").find(".doc-placeholder");
        if (lbl) {
            var sp = $(this).val().split("\\");
            lbl.text(sp.pop());
        };
    })