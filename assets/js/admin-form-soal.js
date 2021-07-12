  
  $("#add-soal").on("click",function(){
  	var counter = parseInt($(".group-soal").eq($(".group-soal").length-1).find(".soal-counter").text());
  	counter++;
  	var soal = $(".group-soal").eq($(".group-soal").length-1).clone();
  	soal.find(".soal-counter").text(counter);
    soal.find("input[type=radio]").attr("name", "jawaban" + counter);
  	soal.find("input[type=file]").attr("name", "file" + counter);
    soal.find("textarea").text("");
  	soal.find("img").attr("src", "");
	soal.find("input[type=text]").each(function(){
		$(this).val("");
	});
  	$("#soal-container").append(soal);
  })

  function subsoal(obj){
  	$(obj).closest(".group-soal").remove();
  	reSetCount();
  }

  function reSetCount(){
  	var counter = 0;
  	$.each($(".group-soal"),function(){
  		$(this).find(".soal-counter").text(++counter);
  	})
  }

  $(".upload-clicker").on("click",function(){
    $(this).closest(".row").find("input[type=file]").click();
  });
  $("input[type=file]").on("change",function(){
    var img = $(this).closest(".row").find("img");
    if (img) {
        img.attr("src", URL.createObjectURL(event.target.files[0]));
        if (parseInt(img.css("height"))>=300) {img.css("height", "300");};
    };
    var lbl = $(this).closest(".row").find(".doc-placeholder");
    if (lbl) {
        var sp = $(this).val().split("\\");
        lbl.text(sp.pop());
    };
  })

  function openfilediaolog(obj){
    $(obj).closest(".row").find("input[type=file]").click();
  }
  function uploadeChanged(obj){
    var img = $(obj).closest(".row").find("img");
    if (img) {
        img.attr("src", URL.createObjectURL(event.target.files[0]));
        if (parseInt(img.css("height"))>=300) {img.css("height", "300");};
    };
    var lbl = $(obj).closest(".row").find(".doc-placeholder");
    if (lbl) {
        var sp = $(obj).val().split("\\");
        lbl.text(sp.pop());
    };
  }

