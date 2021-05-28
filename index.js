$("#signupform").submit(function(event){
	event.preventDefault();
	var datatopost = $(this).serializeArray();
	console.log(datatopost);
	$.ajax({
		url:"signup.php",
		type:"POST",
		data: datatopost,
		success: function(data){
			if(data){
				$(".fetched").html(data);
			}
		},
		error: function(data){
			if(data){
				$(".fetched").html(data);
			}
		}
	});
});
$("#loginform").submit(function(event){
	event.preventDefault();
	var datatopost = $(this).serializeArray();
	console.log(datatopost);
	$.ajax({
		url:"login.php",
		type:"POST",
		data: datatopost,
		success: function(data){
			if(data){
				$(".fetched2").html(data);
			}
		},
		error: function(data){
			if(data){
				$(".fetched2").html(data);
			}
		}
	});
});

