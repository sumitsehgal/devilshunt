$(document).ready(function(){
	var token  = $('meta[name="csrf-token"]').attr('content');
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});



	var r = new Resumable({
	  target: '/upload',
	  query : {'_token':token},
	  uploadMethod : 'POST',
	  testChunks: true
	});

	if( $('#browseButton').length > 0 ) {
		r.assignBrowse(document.getElementById('browseButton'));

		r.on('fileSuccess', function(file, message){
		    var obj = JSON.parse(message);
		    if(obj.path) {
		    	alert('File has been Uploaded Successfully.');
		    	var uploadedFile = obj.path+obj.name;
		    	$('#media-hidden').val(uploadedFile);
		    	$('#media-type-hidden').val(obj.media_type);
		    }
		    $('#media-submit-btn').removeClass('disabled');
		    console.debug('fileSuccess',file);
		  });
		r.on('fileProgress', function(file){
			var percentage = parseInt(r.progress(true) * 100);
			$('#myBar').css('width',percentage+'%');
			$('#media-submit-btn').addClass('disabled');
		    console.debug('fileProgress', file);
		  });
		r.on('fileAdded', function(file, event){
		    r.upload();
		    console.log('fileAdded');
		    console.debug('fileAdded', event);
		  });
		r.on('filesAdded', function(array){
		    r.upload();
		    console.log('filesAdded');
		    console.debug('filesAdded', array);
		  });
		r.on('fileRetry', function(file){
			console.log('fileRetry');
		    console.debug('fileRetry', file);
		  });
		r.on('fileError', function(file, message){
			console.log('fileError');
		    console.debug('fileError', file, message);
		  });
		r.on('uploadStart', function(){
		    $('#progress p').show();
			console.log('uploadStart');
		    console.debug('uploadStart');
		  });
		r.on('complete', function(){
			console.log('complete');
		    console.debug('complete');
		  });
		r.on('progress', function(){
			console.log('progress');
		    console.debug('progress');
		  });
		r.on('error', function(message, file){
			console.log('error');
			alert('Error : '+message);
		    console.debug('error', message, file);
		  });
		r.on('pause', function(){
			console.log('pause');
		    console.debug('pause');
		  });
		r.on('cancel', function(){
			console.log('cancel');
		    console.debug('cancel');
		  });

	}

	function postLikeDislike(media_id, type='like',elem) {
		var jqxhr = $.post( "/like", {id:media_id, type:type} ,function(response) {
			console.log(response);
		  	alert( "success" );
		  	$('.point-fire').removeClass('active');
		  	elem.addClass('active');
		  if(response.points) {
		  	$('#point-score').html(response.points);
		  }

		}).done(function() {
		    alert( "second success" );
		  }).fail(function() {
		    alert( "error" );
		  }).always(function() {
		    alert( "finished" );
		  });
		 
		// Perform other work here ...
		 
		// Set another completion function for the request above
		jqxhr.always(function() {
		  alert( "second finished" );
		});

	}

	function InvalidRequestReload() {
		alert("Invalid Request. Please Try Again.");
		location.reload();
	}

	if($('.point-fire').length > 0) {
		$('.point-fire').on('click',function(){

			var btn = $(this);
			var mediaid = btn.data('mediaid');
			if(mediaid == "") {
				InvalidRequestReload();
			}

			var type = 'like';
			if(btn.hasClass('like-btn')) {
				type = 'like';
			}else if(btn.hasClass('dislike-btn')) {
				type = 'dislike';
			}else {
				InvalidRequestReload();
			}

			postLikeDislike(mediaid, type, $(this));
			return false;

		});
	}


	
})