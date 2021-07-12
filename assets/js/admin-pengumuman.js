    $('.shownewscheckbox').change(function(){
        var idp = $(this).closest(".top-checkbox").eq(0).find(".id-placeholder").val();
        var cb = this;
        if (this.checked) {
            $.post("admin/Pengumuman/ajaxRequest_tampilkan", { id: idp, value: "1" })
                 .done(function( data ) {
                    if(data=="success"){
                        cb.checked = true;
                    }else{
                        cb.checked = false;
                    }
               });
        }else{
            $.post("admin/Pengumuman/ajaxRequest_tampilkan", { id: idp, value: "0" })
                 .done(function( data ) {
                    if(data=="success"){
                        cb.checked = false;
                    }else{
                        cb.checked = true;
                    }
               });
        }
    });