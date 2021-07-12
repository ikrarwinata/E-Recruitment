
    $('#pendaftaran_tanggal').daterangepicker({
      timePicker: false,
      locale: {
        format: 'DD/MM/YYYY'
      }
    });
    $('.text-time').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'DD/MM/YYYY HH:mm'
      }
    });

    $("#add-berkas-pekerjaan").on("click",function(){
    	var lastBerkas = $(".berkas-fieldset").eq(0);
    	if (lastBerkas) {$("#berkas-container").append(lastBerkas.clone());};    	
    })
    function subberkas(obj){
    	$(obj).closest(".berkas-fieldset").remove();
    }

    $("#add-jadwal-ujian").on("click",function(){
    	var lastBerkas = $(".ujian-fieldset").eq(0);
    	if (lastBerkas) {$("#ujian-container").append(lastBerkas.clone());};

	    $('.text-time').daterangepicker({
	      timePicker: true,
	      timePickerIncrement: 30,
	      locale: {
        	format: 'DD/MM/YYYY HH:mm'
	      }
	    })
    })
    function subjadwal(obj){
    	$(obj).closest(".ujian-fieldset").remove();
    };

    $('#pendaftaran_tanggal').on("change",function(){
    	var startt = $(this).val().split(" - ")[0],endt = $(this).val().split(" - ")[1];
    	var lt = startt.split("/")[2], lb = startt.split("/")[1], ltg = startt.split("/")[0];
    	var rt = endt.split("/")[2], rb = endt.split("/")[1], rtg = endt.split("/")[0];
    	var datestart = new Date(lt, lb, ltg),dateend = new  Date(rt, rb, rtg);
    	$("#pendaftaran_lama").text(DateDiff.inDays(datestart, dateend) + " Hari")
    })

    var DateDiff = {
	    inDays: function(d1, d2) {
	        var t2 = d2.getTime();
	        var t1 = d1.getTime();

	        return parseInt((t2-t1)/(24*3600*1000));
	    },
	    inWeeks: function(d1, d2) {
	        var t2 = d2.getTime();
	        var t1 = d1.getTime();

	        return parseInt((t2-t1)/(24*3600*1000*7));
	    },
	    inMonths: function(d1, d2) {
	        var d1Y = d1.getFullYear();
	        var d2Y = d2.getFullYear();
	        var d1M = d1.getMonth();
	        var d2M = d2.getMonth();

	        return (d2M+12*d2Y)-(d1M+12*d1Y);
	    },
	    inYears: function(d1, d2) {
	        return d2.getFullYear()-d1.getFullYear();
	    }
	}