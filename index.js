$(document).ready(function(){
	function offCanvas(){
		 let offcanvasElement = $('#offcanvasTop')[0];
     let bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasElement); // Get or create instance
     bsOffcanvas.toggle(); // Toggle the offcanvas
	}offCanvas()
	function reloader(){
		stopBusting(0,"none");
	}reloader()
	let parameter;
	$("#extDes").change(function(){
		if($("#extDes").is(":checked")){
			$("#extension").css("display","block");
		}else{
			$("#extension").css("display","none");
		}
	});
	$("#blast").click(function(){
		$("#link-tbody").html("<th colspan='4' class='text-center'>Please Wait....</th>");
		$("#stop-btn").css("display","block");
		var data = $("#input-url").val();
		var list = $("#wordlist").val();
		var ext = $("#extension").val();
		if(ext != ""){
			parameter = {url : data, list : list, ext : ext};
		}else{
			parameter = {url : data, list : list};
		}

		$.ajax({
			url: "run.php",
			type: "POST",
			data : parameter,
			success : function(data){
				if(data == 1){
					alert("Fill The Form Carefully");
				}else if(data == 2){ 
					alert("File is not correct");
				}else if(data == 3){
					$("#link-tbody").append("<th colspan='4' class='text-center'>Busting Stopped!!!!</th>");
				}
			},
			xhrFields: {
              onprogress: function(e) {
                var chunk = e.target.responseText;
                $('#link-tbody').html(chunk);
              }
            },
			error : function(){
				$("#link-tbody").html("<th colspan='4' class='text-center'>Error Occurs 😢😢</th>");
			}
		})
	});
	function stopBusting(val,dis){
		$.ajax({
			url : "stop.php",
			type : "POST",
			data : {stop : val},
			success : function(data){
				if(data == 2){
					alert("Woops!! Busting Already Stoped!!")
				}else{
					if(dis == "none"){
					  $("#alert").css("display",dis).slideUp(5000);
				  }else{
					  $("#alert").css("display",dis).slideDown(5000);
				  }
				  $("#stop-btn").css("display",dis);
				  $("#restore-btn").css("display",dis);
				}
			}
		});
	}

	$("#stop-btn").click(function(){
		stopBusting(1,"block");
	});
	$("#restore-btn").click(function(){
		stopBusting(0,"none");
	})
});