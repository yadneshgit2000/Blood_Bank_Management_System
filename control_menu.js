$("#reg_donor").submit(function(event){
	event.preventDefault();
	var datatopost = $(this).serializeArray();
	console.log(datatopost);
	$.ajax({
		url:"donor.php",
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
$("#reg_receiver").submit(function(event){
	event.preventDefault();
	var datatopost = $(this).serializeArray();
	console.log(datatopost);
	$.ajax({
		url:"receiver.php",
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
$("#profile_update").submit(function(event){
	event.preventDefault();
	var datatopost = $(this).serializeArray();
	console.log(datatopost);
	$.ajax({
		url:"process_profile.php",
		type:"POST",
		data: datatopost,
		success: function(data){
			if(data){
				$(".msg").html(data);
			}
		},
		error: function(data){
			if(data){
				$(".msg").html(data);
			}
		}
	});
});