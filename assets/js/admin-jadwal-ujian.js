    var skipper = 0;
    $.each($(".jabatan-row"), function(){
        var id = $(this).attr("data-holder");
        if (skipper<=0) {
            skipper = $(".c-" + id).length-1;
            $(".c-" + id).eq(0).attr("rowspan",$(".c-" + id).length);
        }else{
            skipper--;
            $(this).remove();
            return true;
        }
    });