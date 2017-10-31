function readURL(input) {
	var url = input.value;
	var destinationSelctor = input.dataset.selector;
	var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
	if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
	    var reader = new FileReader();
	    reader.onload = function (e) {
	        $(destinationSelctor).attr('src', e.target.result);
	    }
	    reader.readAsDataURL(input.files[0]);
	}
	else{
	     $(destinationSelctor).attr('src', '/uploads/nopreview.jpg');
	  }
}
$(document).ready(function(){
	$('.delete').on('click',function(){
		if(confirm('Do you want to delete ?')){
			$(this).parent().submit();
		}else{
			return false;
		}
	});

	var token = $('meta[name=csrf-token]').attr('content');

	var r = new Resumable({
	  target: '/upload',
	  query : {'_token':token},
	  uploadMethod : 'POST',
	  testChunks: true
	});

	if( $('#browseButton').length > 0 ) {
	r.assignBrowse(document.getElementById('browseButton'));

	r.on('fileSuccess', function(file){
	    console.log(file);
	    console.log('fileSuccess');
	    console.debug('fileSuccess',file);
	  });
	r.on('fileProgress', function(file){
		console.log(file);
		console.log('fileProgress');
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

	//levels add
	function getLatestIndex() {
		/**/
        var latestIndex = 0;
        var totalrecords = $('#level-section .row').length;
        if(totalrecords > 0) {
        	//latestIndex = totalrecords;
        	//get max
        	$('#level-section .row').each(function(){
        		var CurIndex = $(this).data('index');
        		if(CurIndex > latestIndex) {
        			latestIndex = CurIndex;
        		}
        	});
        	latestIndex++;
        }
        return latestIndex;
	}

	$('#add-level').click(function(){
		//get latest id
		var latestIndex = getLatestIndex();
		//render Html
		var html = '<div class="row level-row" data-index="'+latestIndex+'" id="index-'+latestIndex+'">'+
                        '<div class="col-xs-2">'+
                        	'<input type="text" name="levels['+latestIndex+'][title]" placeholder="Level Title" class="form-control" />'+
                        '</div>'+
                        '<div class="col-xs-2">'+
                        	'<input type="date" name="levels['+latestIndex+'][end_date]" placeholder="Finishing date" class="form-control" />'+
                        '</div>'+
                        '<div class="col-xs-2">'+
                        	'<input type="date" name="levels['+latestIndex+'][end_time]" placeholder="00:00" class="form-control" />'+
                        '</div>'+
                        '<div class="col-xs-2">'+
                        	'<input type="text" name="levels['+latestIndex+'][minimum_candidate]" placeholder="Minimum Candidates" class="form-control" />'+
                        '</div>'+
                        '<div class="col-xs-2">'+
                        	'<input type="text" name="levels['+latestIndex+'][minimum_points]" placeholder="Minimum Points" class="form-control" />'+
                        '</div>'+
                        '<div class="col-xs-2">'+
                        	'<a href="javascript:void(0);" data-index="#index-'+latestIndex+'" class="level-delete" >Delete</a>'+
                        '</div>'+
                    '</div>';
		$('#level-section').append(html);
		return false;
	});

	$('#level-section').on('click','.level-delete',function(){
		var refRow = $(this).data('index');
		$(refRow).remove();
		return false;
	});

})