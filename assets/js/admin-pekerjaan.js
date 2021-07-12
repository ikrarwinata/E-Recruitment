    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.pekerjaan-states').change(function(){
        var idp = $(this).closest(".top-checkbox").eq(0).find(".id-placeholder").val();
        var cb = this;
        if (this.checked) {
            $.post("admin/Pekerjaan/ajaxRequest_tersedia", { id: idp, value: "1" })
                 .done(function( data ) {
                    if(data=="success"){
                        cb.checked = true;
                    }else{
                        cb.checked = false;
                    }
               });
        }else{
            $.post("admin/Pekerjaan/ajaxRequest_tersedia", { id: idp, value: "0" })
                 .done(function( data ) {
                    if(data=="success"){
                        cb.checked = false;
                    }else{
                        cb.checked = true;
                    }
               });
        }
    });

    var alerttext = $('#placeholder-alert').text();
    var alerttype = $('#placeholder-alert-tipe').text();

    if (alerttext) {
        Toast.fire({
        type: alerttype,
        title: "&nbsp;" + alerttext
      })
    }