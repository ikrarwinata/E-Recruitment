    function openwindow(obj){
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
        var popup = window.open($(obj).attr("href"), '_blank', params);
        if (popup == null)
           alert('Popup diblokir oleh AdBlock !');
        else  {
          popup.moveTo(0, 0);
          popup.resizeTo(screen.width, screen.height);
          popup.focus();
        };
        return false;
    }