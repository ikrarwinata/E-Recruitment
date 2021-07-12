    var objm = $("#timer-countdown-m"), objs = $("#timer-countdown-s");
    var m = parseInt(objm.text()), s = parseInt(objs.text());
    
    var x = setInterval(function(){
        if (m<=0&&s<=0) {showButton();};
        if (s<=0) {
            m--;
            s=59;
        }else{
            s--;
        }
        objm.text(m);
        objs.text(s);
    }, 1000);

    function showButton(){
        x = null;
        $("#prep-countdown").remove();
        $("#prep-ready").removeClass("d-none");
        openURL();
    };

    function openURL(){
        var params  = 'width='+screen.width;
         params += ', height='+screen.height;
         params += ', top=0, left=0'
         params += ', fullscreen=yes';
         params += ', directories=no';
         params += ', location=no';
         params += ', menubar=no';
         params += ', resizable=no';
         params += ', scrollbars=yes';
         params += ', status=no';
         params += ', toolbar=no';
         params += ', titlebar=no';
        var popup = window.open("pelamar/Ujian/next/0", '_blank', params);
        if (popup == null)
           alert('Popup diblokir oleh AdBlock, Silahkan buka halaman secara manual');
        else  {
          popup.moveTo(0, 0);
          popup.resizeTo(screen.width, screen.height);
          popup.focus();
        }
    }