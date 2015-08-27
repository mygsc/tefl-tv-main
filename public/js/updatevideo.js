var annotation = document.getElementById('annotation'), CSSstyle = '',checkbox, count=0, annot = 'annotation', hrs=0, min=0,sec=0, filename = document.getElementById('filename').value,types,content,start,end,link,
hms = document.getElementById('hms').value, min=50, max=5000, limitChar = document.getElementById('description').value.length, videoPlayer = document.getElementById('media-video');
$('#char-limit').html(limitChar);
//document.getElementById("submit-save-changes").disabled = true;
// if(limitChar>=50){
// 	document.getElementById("submit-save-changes").disabled = false;
// }
$(document).ready(function() {

	$('#form-add-setting').on('submit', function() {
		        //.....
		        //show some spinner etc to indicate operation in progress
		        //.....
		        $.post(
		        	$(this).prop( 'action' ),{
		        		"_token": $( this ).find( 'input[name=_token]' ).val(),
		        		"setting_name": $( '#setting_name' ).val(),
		        		"setting_value": $( '#setting_value' ).val()
		        	},
		        	function( data ) {
		                //do something with data/response returned by server
		            },'json'
		            );
		        //.....
		        //do anything else you might want to do
		        //.....
		        //
		        //prevent the form from actually submitting in browser
		        return false;
		    } );
	$("#poster").on("change", function(){
		var reader = new FileReader();
		var files = !!this.files ? this.files : [];
		            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

		          if (/^image/.test( files[0].type)){ // only image file
		              reader.readAsDataURL(files[0]); // read the local file

		              reader.onloadend = function(){ // set image data as background of div
		                //var thumb = document.getElementById('thumbnail');//$("#thumbnail-local").css("background-image", "url("+this.result+")");
		                  //thumb.src=this.result;
		                  
		                  videoPlayer.poster=this.result;
		                  videoPlayer.height='100%';
		                  videoPlayer.width='100%';
		              }
		          }
		      });
	$('#annotation-note').on('click',function(e){
		e.preventDefault();
		createAnnotation('Note:','note');    
	});
	$('#annotation-title').on('click',function(e){
		e.preventDefault();
		createAnnotation('Title:','title');     
	});
	$('#annotation-spotlight').on('click',function(e){
		e.preventDefault();
		createAnnotation('Spotlight:','spotlight');     
	});
	$('#annotation-speech').on('click',function(e){
		e.preventDefault();
		createAnnotation('Speech:','speech');     
	});

	function createAnnotation(title,id){
		count += 1; 
		var createDiv = document.createElement('div'),
		ul = document.createElement('ul'),
		liIcon = document.createElement('li'),
		liContent = document.createElement('li'),
		liStartTime = document.createElement('li'),
		liEndTime = document.createElement('li'),
		liLink = document.createElement('li'),
		startPlus = document.createElement('button'),
		startPlusText =  document.createTextNode('+'),
		startMinus = document.createElement('button'),
		startMinusText =  document.createTextNode('-'),

		endPlus = document.createElement('button'),
		endPlusText =  document.createTextNode('+'),
		endMinus = document.createElement('button'),
		endMinusText =  document.createTextNode('-'),
		annotationTypeCaption = document.createTextNode(title),
		types = document.createTextNode(title),
		close = document.createElement('span'),
		save = document.createElement('span'),
		label = document.createElement('label'),
		labelText = document.createTextNode('link'),
		closeText = document.createTextNode(''),
		saveText = document.createTextNode(''),
		startTagLabel = document.createElement('label'),
		startTagCaption = document.createTextNode('Start:'),
		startTime = document.createElement('input'),
		endTagLabel = document.createElement('label'),
		endTagCaption = document.createTextNode('End:'),
		endTime = document.createElement('input'),
		url = document.createElement('input'),
		annotationTypeTag = document.createElement('span');
		content = document.createElement('textarea'); 
		checkbox = document.createElement('input');

		if(id=='note'){annotationTypeTag.className = 'glyphicon glyphicon-file';}
		else if(id=='title'){annotationTypeTag.className = 'glyphicon glyphicon-font';}
		else if(id=='spotlight'){annotationTypeTag.className = 'glyphicon glyphicon-link';}
		else if(id=='speech'){annotationTypeTag.className = 'glyphicon glyphicon-comment';}
			//close.id = 'close-annotation-' + id + '-' + count;
			close.title = 'Delete';
			close.className = 'glyphicon glyphicon-remove';
			save.className = 'glyphicon glyphicon-floppy-save';
			save.title = 'Save-' + id;
			checkbox.type = 'checkbox';  
			checkbox.name = 'checkbox' + '-url-' + annot +'-' + id + '-' + count;
			checkbox.id = 'checkbox' + '-url-' + annot +'-' + id + '-' + count;
			//createDiv.appendChild(annotationTypeTag);
			//annotationTypeTag.appendChild(annotationTypeCaption);
			//close.appendChild(closeText);
			//save.appendChild(saveText);
			// label.appendChild(labelText);
			close.setAttribute('style', 'color:#3f3b3b;cursor:pointer;border-bottom:1px solid red;padding:4px;background:rgba(42,42,42,0.3); text-align:center; float:right;');
			close.setAttribute('id', 'close-annotation-' + id + '-' + count);
			save.setAttribute('style', 'margin-right:2px;color:#3f3b3b;cursor:pointer;border-bottom:1px solid red;padding:4px;background:rgba(42,42,42,0.3); text-align:center; float:right;');
			save.setAttribute('id', 'save-annotation-' + id + '-' + count);
			createDiv.setAttribute('id', 'annotation-' + id + '-' + count);    
			createDiv.setAttribute('style', 'margin-bottom:5px;border-radius:4px;width:100%;height:100%;padding:19px;background:#e8e5e5;');
			content.setAttribute('placeholder', 'Enter text here...');
			content.setAttribute('id', 'content-annotation-'+id+'-'+count);
			content.style.marginTop = '5px';
			content.name = 'content-annotation-'+id+'-'+count;
			label.setAttribute('for', 'checkbox' + '-url-' + annot +'-' + id + '-' + count);
			label.setAttribute('style', 'margin-left:3px;cursor:pointer');
			// annotation.appendChild(createDiv); 
			//createDiv.appendChild(close);
			//createDiv.appendChild(save);
			//createDiv.appendChild(content); 
			//startTagLabel.appendChild(startTagCaption);
			//createDiv.appendChild(startTagLabel);
			startTime.type = 'text';
			startTime.id = 'start' + '-time-' + annot + '-' + id + '-' + count;
			startTime.name = 'start' + '-time-annotation-' + id + '-' + count;
			startTime.value = '00:'+'00:'+'00';
			startTime.setAttribute('maxlength','8');
			//createDiv.appendChild(startTime);
			startPlus.setAttribute('style','border:none;cursor:pointer;outline:1px solid #bab6b6;width:20px;height:16px;text-align:center;background:#e8e5e5;color:#bab6b6;position:relative;top:-34px;float:right;');
			startMinus.setAttribute('style','border:none;cursor:pointer;outline:1px solid #bab6b6;width:20px;height:16px;text-align:center;background:#e8e5e5;color:#bab6b6;position:relative;margin-right:-20px;top:-16px;float:right;');

			endPlus.setAttribute('style','border:none;cursor:pointer;outline:1px solid #bab6b6;width:20px;height:16px;text-align:center;background:#e8e5e5;color:#bab6b6;position:relative;top:-34px;float:right;');
			endMinus.setAttribute('style','border:none;cursor:pointer;outline:1px solid #bab6b6;width:20px;height:16px;text-align:center;background:#e8e5e5;color:#bab6b6;position:relative;margin-right:-20px;top:-16px;float:right;');
			
			//endTagLabel.appendChild(endTagCaption);
			//createDiv.appendChild(endTagLabel);
			endTime.type = 'text';
			endTime.id = 'end' + '-time-annotation-' + id + '-' + count;
			endTime.name = 'end' + '-time-annotation-' + id + '-' + count;
			endTime.value = hms;
			endTime.setAttribute('maxlength','8');
			
			startPlus.type = 'button';
			startPlus.name = 'start-time-inc';
			startMinus.type = 'button';
			startMinus.name = 'start-time-dec';

			endPlus.type = 'button';
			endPlus.name = 'end-time-inc';
			endMinus.type = 'button';
			endMinus.name = 'end-time-dec';



			url.type = 'text';
			url.id = 'url' + '-annotation-' + id + '-' + count;
			url.name = 'url' + '-annotation-' + id + '-' + count;
			url.setAttribute('placeholder', 'Enter url e.g: http://www.tefltv.com');
			url.setAttribute('style', 'display:none');
			// createDiv.appendChild(url);
			ul.setAttribute('style','list-style:none;margin:0px;padding:0px;');

			annotation.appendChild(createDiv); 
			createDiv.appendChild(ul);
			ul.appendChild(liIcon);
			liIcon.appendChild(annotationTypeTag);
			liIcon.appendChild(annotationTypeCaption);
			liIcon.appendChild(close);
			liIcon.appendChild(save);
			close.appendChild(closeText);
			save.appendChild(saveText);

			ul.appendChild(liContent);
			liContent.appendChild(content);

			ul.appendChild(liStartTime);
			liStartTime.appendChild(startTagLabel);
			startTagLabel.appendChild(startTagCaption);
			liStartTime.appendChild(startTime);
			liStartTime.appendChild(startPlus);
			startPlus.appendChild(startPlusText);
			liStartTime.appendChild(startMinus);
			startMinus.appendChild(startMinusText);

			ul.appendChild(liEndTime);
			liEndTime.appendChild(endTagLabel);
			endTagLabel.appendChild(endTagCaption);
			liEndTime.appendChild(endTime);
			liEndTime.appendChild(endPlus);
			endPlus.appendChild(endPlusText);
			liEndTime.appendChild(endMinus);
			endMinus.appendChild(endMinusText);

			ul.appendChild(liLink);
			liLink.appendChild(checkbox);
			liLink.appendChild(label);
			label.appendChild(labelText);
			liLink.appendChild(url);


			/*
			* Create div of Annotation at video 
			*/
			var annotWrapper = document.createElement('div');
			var annotDiv = document.createElement('div');
			var annotClose = document.createElement('div');
			annotClose.className = 'speech';
			if(id=="note")annotDiv.setAttribute('style','resize:both;overflow:hidden;padding:3px;color:#fff;width:200px;height:25px;position:absolute;top:10px;left:10px;background:rgba(42,42,42,0.6);');
			else if(id=="title")annotDiv.setAttribute('style','resize:both;overflow:hidden;border:1px solid #000;font-style:normal;font-size:30px;padding:3px;color:#fff;width:200px;height:50px;position:absolute;top:20px;left:20px;background:transparent;text-shadow: 0 0 2px #000;');
			else if(id=='spotlight')annotDiv.setAttribute('style','resize:both;overflow:hidden;padding:3px;border:1px solid #f18200;color:#fff;width:200px;height:25px;position:absolute;left:30px;top:30px;background:rgba(42,42,42,0.6);');
			else if(id=='speech')annotDiv.className = 'speech';
			annotDiv.setAttribute('id','div-annotation-' + id + '-' + count);
			document.getElementById("custom-annotation").appendChild(annotDiv);
			var annotContent = document.createTextNode(''); 
			annotDiv.appendChild(annotContent);
			
			/*
			* Event listener of annotation builder 
			*/
			checkbox.onclick = function(){
				var getid = this.id;
				console.log(getid);
				var textbox = getid.replace('checkbox-','');
				if(document.getElementById(getid).checked == true) $('#' + textbox).fadeIn('fast');
				else $('#' + textbox).fadeOut('fast');
			};
			close.onclick = function(){
				var getid = this.id;
				var id = this.className; id = id.replace('glyphicon glyphicon-trash','');
				var removeDiv = getid.replace('close-','');
				$('#'+removeDiv).remove();
				$('#div-'+removeDiv).remove();
				//annotations.remove(id);
			}
			close.onmouseover = function(){
				var getid = this.id;
				$('#'+getid).css({'border-bottom':'2px solid #0f85e0'});
			}
			close.onmouseleave = function(){
				var getid = this.id;
				$('#'+getid).css({'border-bottom':'1px solid red'});
			}
			save.onclick = function(){
				var getid = this.id, titles = this.title;
				content = getid.replace('save','content');
				content = selector(content).value;
				types = titles.replace('Save-','');
				start = getid.replace('save','start-time');
				start = selector(start).value;
				end = getid.replace('save','end-time');
				end = selector(end).value;
				link = getid.replace('save','url');
				link = selector(link).value;
				css =  getid.replace('save','div');
				filename = filename;
				start = getid.replace('save','content');
				var startTimeVal = getid.replace('save-', 'start-time-');
				var starttime = selector(startTimeVal).value;
				var getStartTime = starttime.split(":");
				var start1 = getStartTime[0] * 3600;
				var start2 = getStartTime[1] * 60;
				var start3 = getStartTime[2] * 1;
				var endTimeVal = getid.replace('save-', 'end-time-');
				var endtime = selector(endTimeVal).value;
				var getEndTime = endtime.split(":");
				var end1 = getEndTime[0] * 3600;
				var end2 = getEndTime[1] * 60;
				var end3 = getEndTime[2] * 1;
				if(getStartTime[0]>60 || getStartTime[1]>60 || getStartTime[2]>60 || getEndTime[0]>60 || getEndTime[1]>60 || getEndTime[2]>60) return alert('Please check your start and end time.');
				var totalStartTimeSec = start1+start2+start3;
				var totalEndTimeSec = end1+end2+end3;
				var getstyle = annotations.css(css);
				var rm = getid.replace('save-','');
				
				annotations.loader();
				setTimeout(function(){
					annotations.add(filename,types,content,totalStartTimeSec,totalEndTimeSec,link,getstyle);
					$('#'+rm).remove();
					$('#div-'+rm).remove();
				},3000);
			}
			save.onmouseover = function(){
				var getid = this.id;
				$('#'+getid).css({'border-bottom':'2px solid #0f85e0'});
			}
			save.onmouseleave = function(){
				var getid = this.id;
				$('#'+getid).css({'border-bottom':'1px solid red'});
			}
			annotDiv.onmousedown = function(evt){
				drag.startMoving(this,'media-video',evt);
				$(this).css({'cursor':'move'});
			}
			annotDiv.onmouseup = function(){
				drag.done('media-video');
				$(this).css({'cursor':'default'});
			}

			content.onkeyup = function(){
				var getid = this.id;
				var getCurrentId = getid.replace('content','div');
				var contents = content.value;
				$('#'+getCurrentId).html(contents);
			}
			startTime.onkeypress = function(evt){
				evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57)) {
					return false;
				}
				return true;
			}
			endTime.onkeypress = function(evt){
				evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57)) {
					return false;
				}
				return true;
			}
			startPlus.onclick = function(){
				var timeDuration = endTime.value;//document.querySelector('input[name=hms]').value,
				st = startTime.value,
				timeDuration = timeDuration.split(':'),
				startTimeDuration = st.split(':'),
				hrs = startTimeDuration[0],
				min = startTimeDuration[1],
				sec = startTimeDuration[2], 
				startTotalTimeDuration = ((hrs*3600) + (min*60) + (sec*1));

				var timeDurationSec = timeDuration[2]*1,
				timeDurationMin = timeDuration[1]*60,
				timeDurationHrs = timeDuration[0]*3600,
				totalDuration = timeDurationSec + timeDurationMin + timeDurationHrs;
				if(totalDuration >= startTotalTimeDuration){
					sec++;
					if(sec > 59){
						sec = 0; 
						min++;	
					}
					if(min > 59){
						min=0;
						hrs++;
					}
					if(sec<10) sec = '0' + sec * 1; 
					if(min<10) min = '0' + min * 1;
					if(hrs<10) hrs = '0' + hrs * 1; 
					startTime.value = hrs + ':' + min + ':' + sec;
					startTime.focus();
				 }
				 else{
					startTime.value = endTime.value;
				}

			}
			startMinus.onclick = function(){
				var timeDuration = endTime.value;//document.querySelector('input[name=hms]').value,
				timeDuration = timeDuration.split(':'),
				et = startTime.value,
				startTimeDuration = et.split(':'),
				hrs = startTimeDuration[0],
				min = startTimeDuration[1],
				sec = startTimeDuration[2], 
				startTotalTimeDuration = ((hrs*3600) + (min*60) + (sec*1));

				var timeDurationSec = timeDuration[2]*1,
				timeDurationMin = timeDuration[1]*60,
				timeDurationHrs = timeDuration[0]*3600,
				totalDuration = timeDurationSec + timeDurationMin + timeDurationHrs;
				if(startTotalTimeDuration < totalDuration && startTotalTimeDuration !=0){
					
					if(sec==0){
						if(min>0) {sec=59;min--;}		
					}else{
						sec--;
					}
					if(min==0){
						if(hrs>0) {min=59;hrs--;}
					}
					if(sec<10) sec = '0' + sec * 1; 
					if(min<10) min = '0' + min * 1;
					if(hrs<10) hrs = '0' + hrs * 1; 
					startTime.value = hrs + ':' + min + ':' + sec;
					startTime.focus();
				}
				else{
					startTime.value = endTime.value;
				}
				
			}
			endPlus.onclick = function(){
				var timeDuration = document.querySelector('input[name=hms]').value,
				timeDuration = timeDuration.split(':'),
				et = endTime.value,
				startTimeDuration = et.split(':'),
				hrs = startTimeDuration[0],
				min = startTimeDuration[1],
				sec = startTimeDuration[2], 
				startTotalTimeDuration = ((hrs*3600) + (min*60) + (sec*1));

				var timeDurationSec = timeDuration[2]*1,
				timeDurationMin = timeDuration[1]*60,
				timeDurationHrs = timeDuration[0]*3600,
				totalDuration = timeDurationSec + timeDurationMin + timeDurationHrs;
				if(totalDuration > startTotalTimeDuration){
					sec++;
					if(sec > 59){
						sec = 0; 
						min++;	
					}
					if(min > 59){
						min=0;
						hrs++;
					}
					if(sec<10) sec = '0' + sec * 1; 
					if(min<10) min = '0' + min * 1;
					if(hrs<10) hrs = '0' + hrs * 1; 
					endTime.value = hrs + ':' + min + ':' + sec;
					endTime.focus();
				}else{
					endTime.value = endTime.value;
				}

			}
			endMinus.onclick = function(){
				var timeDuration = document.querySelector('input[name=hms]').value,
				timeDuration = timeDuration.split(':'),
				et = endTime.value,
				startTimeDuration = et.split(':'),
				endhrs = startTimeDuration[0],
				endmin = startTimeDuration[1],
				endsec = startTimeDuration[2], 
				startTotalTimeDuration = ((endhrs*3600) + (endmin*60) + (endsec*1)); 
				var timeDurationSec = timeDuration[2]*1,
				timeDurationMin = timeDuration[1]*60,
				timeDurationHrs = timeDuration[0]*3600,
				totalDuration = timeDurationSec + timeDurationMin + timeDurationHrs;
				if(startTotalTimeDuration <= totalDuration){
					if(endsec==0){
						if(endmin>0) {endsec=59;endmin--;}		
					}else{
						endsec--;
					}
					if(endmin==0){
						if(endhrs>0) {endmin=59;endhrs--;}
					}
					if(endsec<10) endsec = '0' + endsec * 1; 
					if(endmin<10) endmin = '0' + endmin * 1;
					if(endhrs<10) endhrs = '0' + endhrs * 1; 
					endTime.value = endhrs + ':' + endmin + ':' + endsec;
					endTime.focus();
				}else{
					endTime.value = endTime.value;
				}
			}
			startTime.onmouseup = function(){
				//timeHighlightSelected();
			}
			
			function getSelectedText() {
				var text = "";
				if (typeof window.getSelection != "undefined") {
					text = window.getSelection().toString();
				} else if (typeof document.selection != "undefined" && document.selection.type == "Text") {
					text = document.selection.createRange().text;
				}
				return text;
			}
			function timeHighlightSelected() {
				var selectedText = getSelectedText();
				if (selectedText) {
					alert("Got selected text " + selectedText);
				}
			}
			function selector(name){
				return document.getElementById(name);
			}
		}

	});

var annotations = function(){
	return	{
		add: function(filename,types,content,start,end,link,css){
			$.ajax({
				type: 'POST',
				url:'/addannotation',
				data: {filename:filename, types:types,content:content,start:start,end:end,link:link,css:css},
				success: function(e){
					console.log(e.msg);
					$('#loader-wrapper').fadeOut();
					$('#loader-wrapper').remove();
					close.className = 'glyphicon glyphicon-trash ' + e.id;
					annotations.response('New annotation has been successfully added.', 'glyphicon glyphicon-saved');
					addedTmpAnnotation(e.id,e.types,e.content);
				},
				error: function(){
					console.log('OOps error while adding annotation.');
					$('#loader-wrapper').fadeOut();
					$('#loader-wrapper').remove();
					annotations.response('Oops error occured.','glyphicon glyphicon-remove');

				}
			});
		},
		remove: function(id){
			$.ajax({
				type: 'POST',
				url:'/deleteannotation/'+id,
				data: {filename:filename},
				success: function(e){
					console.log(e.msg);
					$('#loader-wrapper').fadeOut();
					$('#loader-wrapper').remove();
					annotations.response('Annotation has been successfully removed.', 'glyphicon glyphicon-trash');
				},
				error: function(){
					console.log('OOps error while deleting annotation.');
					$('#loader-wrapper').fadeOut();
					$('#loader-wrapper').remove();
					annotations.response('Oops error occured.','glyphicon glyphicon-remove');
				}
			});
		},
		retrieve: function(id){
			$.ajax({
				type: 'POST',
				url:'/annotation/retrieve/'+id,
				data: {id:id},
				success: function(e){
					$('#loader-wrapper').fadeOut();
					$('#loader-wrapper').remove();
					var sv = document.getElementsByClassName('sv-annot')[0];
					var rm = document.getElementsByClassName('rm-annot')[0];
					sv.setAttribute('id',e.id);
					rm.setAttribute('id',e.id);
					document.getElementById('edit-types').innerHTML = e.types.charAt(0).toUpperCase() + e.types.slice(1);
					var start = video.duration(e.start);
					var end = video.duration(e.end);
					var link = e.link;
					document.querySelector('input[name="content"]').value = e.content;
					document.querySelector('input[name="start"]').value = start;
					document.querySelector('input[name="end"]').value = end;
					if(link.length > 0) {
						document.querySelector('input[name="chk-link"]').checked = true;
						document.querySelector('input[name="link"]').value = e.link;
						document.getElementById('annot-link').style.display = 'block';
					}else {
						document.getElementById('annot-link').style.display = 'none';
						document.querySelector('input[name="link"]').value = e.link;
						document.querySelector('input[name="chk-link"]').checked = false;
					}
					singleAnnotation(e.types,e.css,e.content);	
					console.log(e.msg);
				},
				error: function(){
					console.log('OOps error while retrieving annotation.');
					$('#loader-wrapper').fadeOut();
					$('#loader-wrapper').remove();
					annotations.response('Oops error occured.','glyphicon glyphicon-remove');
				}
			});
},
update: function(id,content,start,end,link,style){
	$.ajax({
		type: 'POST',
		url:'/annotationupdate/'+id,
		data: {content:content,start:start,end:end,link:link,style:style},
		success: function(e){
			$('#loader-wrapper').fadeOut();
			$('#loader-wrapper').remove();
			annotations.response('Changes has been successfully saved.','glyphicon glyphicon-check');
			document.getElementById('preview-annotation').style.display = 'none';
		},
		error: function(){
			console.log('OOps error while updating annotation.');
			$('#loader-wrapper').fadeOut();
			$('#loader-wrapper').remove();
			annotations.response('Oops error occured.','glyphicon glyphicon-remove');
		}
	});
},
response: function(msg, glyphicon){
	var notifier = document.createElement('div');
	var icon = document.createElement('span');
	var txt = document.createTextNode(msg); 
	icon.className = glyphicon;
	notifier.setAttribute('id','notifier');
	icon.setAttribute('style','margin-right:5px;color:#f18200;');
	notifier.setAttribute('style','text-align:center;width:350px;height:45px;padding:10px;position:fixed;margin:auto;top:0;bottom:0;right:0;left:0;background:rgb(184, 202, 239);color:#063782;text-shadow: 0 0 2px #000;box-shadow: 5px 5px 5px #888888;');
	notifier.appendChild(icon);
	notifier.appendChild(txt);
	document.body.appendChild(notifier);
	setTimeout(function(){
		$('#notifier').fadeOut(500);
		$('#notifier').remove();
	},5000);

},
loader: function(){
	var loaderwrapper = document.createElement('div');
	var loader = document.createElement('div');
	var	loaderTxt = document.createTextNode('');//Please wait... 
	loader.setAttribute('class','video-spinner');//annotation-loader
	loaderwrapper.setAttribute('id','loader-wrapper');
	loaderwrapper.setAttribute('style','text-align:center;width:200px;height:10px;padding:10px;position:fixed;margin:auto;top:0;bottom:0;right:0;left:0;background:transparent;color:#063782;text-shadow: 0 0 2px #000;');

	for(var i=1; i<=5; i++){
		var loaderspan = document.createElement('span');
		loader.appendChild(loaderspan);
	}
	loaderwrapper.appendChild(loaderTxt);
	loaderwrapper.appendChild(loader);
	document.body.appendChild(loaderwrapper);
},
css: function(selector){
	var elements = document.getElementById(selector),
	style = window.getComputedStyle(elements),
	padding = style.getPropertyValue('padding'),
	color = style.getPropertyValue('color'),
	minWidth = style.getPropertyValue('width'),
	minHeight = style.getPropertyValue('height'),
	position = style.getPropertyValue('position'),
	top = style.getPropertyValue('top'),
	left = style.getPropertyValue('left'),
	background = style.getPropertyValue('background'),
	CSSstyle = '';
	if(selector.indexOf('title') > 0){
		var fontStyle = style.getPropertyValue('font-style'),
		fontSize = style.getPropertyValue('font-size');
		CSSstyle = 'font-style:'+fontStyle+';' +'font-size:'+fontSize+';'+ 'padding:'+padding+';' + 'color:' + color+';' + 'width:' + minWidth+';' + 'height:' + minHeight+';' + 'position:' + position+';' +
		'top:' + top+';' +'left:'+ left + ';' + 'background:' + background + ';'+'z-index:2147483647;' +'display:none;';
	}else{
		CSSstyle = 'padding:'+padding+';' + 'color:' + color+';' + 'width:' + minWidth+';' + 'height:' + minHeight+';' + 'position:' + position+';' +
		'top:' + top+';' +'left:'+ left + ';' + 'background:' + background + ';'+'z-index:2147483647;' +'display:none;';
	}
	return CSSstyle;
}

}
}();
function addedTmpAnnotation(id,types,contents){
	if(contents.length >= 15) {contents = contents.substring(0,15); contents = contents+'...'; }
	var newannotation = document.createElement('li'),
	href = document.createElement('a'),
	txt = document.createTextNode(types+'-'+contents);
	newannotation.setAttribute('id','forever-remove-annot-' + id);
	newannotation.setAttribute('role','presentation');
	href.setAttribute('id',id);
	href.setAttribute('href','#');
	href.className = 'option-annot';
	href.appendChild(txt);
	newannotation.appendChild(href);
	document.getElementById('annotation-lists').appendChild(newannotation);
	href.onclick = function(e){
		e.preventDefault();
		var id = this.id;
		annotations.loader();
		annotations.retrieve(id);
		$('#editor-annotation').fadeIn();
	}
}
var video = function(){
	return {
		duration: function(duration){
			curHrs = Math.floor(duration / 3600);
			curMin = Math.floor(duration / 60);
			curMinutes = Math.floor(curMin - (curHrs * 60));
			curSec = Math.floor(duration - (curMin * 60));
			if(curHrs < 10)curHrm = "0"+curHrs;
			if(curMin < 10)curMin = "0"+curMin;
			if(curSec < 10)curSec = "0"+curSec;
			return curHrs + ':' + curMinutes + ':' +curSec;
		}
	}
}();
var drag = function(){
	return{
		move: function(id,x,y){
			id.style.left = x + 'px';
			id.style.top = y + 'px';
		},
		startMoving: function(id,container,evt){
			evt = evt || window.event;
			var posX = evt.clientX,
			posY = evt.clientY,
			divTop = id.style.top,
			divLeft = id.style.left,
			eWi = parseInt(id.style.width),
			eHe = parseInt(id.style.height),
			cWi = parseInt($('#media-video').width()),
			cHe = parseInt($('#media-video').height());
			document.getElementById(container).style.cursor='move';
			divTop = divTop.replace('px','');
			divLeft = divLeft.replace('px','');
			var diffX = posX - divLeft,
			diffY = posY - divTop;
			document.onmousemove = function(evt){
				evt = evt || window.event;
				var posX = evt.clientX,
				posY = evt.clientY,
				aX = posX - diffX,
				aY = posY - diffY;
				if (aX < 0) aX = 0;
				if (aY < 0) aY = 0;
				if (aX + eWi > cWi) aX = cWi - eWi;
				if (aY + eHe > cHe) aY = cHe - eHe;
				drag.move(id,aX,aY);
			}
		},
		done: function(container){
			document.getElementById(container).style.cursor = 'default';   
			document.onmousemove = function(){}       
		}
	}
}();
var css = function(){
	return{
		note: function(id){
			var elem = document.getElementById(id),
			style = window.getComputedStyle(elem),
			padding = style.getPropertyValue('padding'),
			color = style.getPropertyValue('color'),
			width = style.getPropertyValue('width'),
			height = style.getPropertyValue('height'),
			position = style.getPropertyValue('position'),
			top = style.getPropertyValue('top'),
			left = style.getPropertyValue('left'),
			background = style.getPropertyValue('background'),
			cssstyle = 'padding:'+padding+';' + 'color:' + color+';' + 'width:' + width+';' + 'height:' + height+';' + 'position:' + position + ';' +
			'top:' + top + ';' +'left:'+ left + ';' + 'background:' + background + ';'+'z-index:2147483647;' +'display:none;';
			return cssstyle;
		},
		Title: function(id){
			var elem = document.getElementById(id),
			style = window.getComputedStyle(elem),
			padding = style.getPropertyValue('padding'),
			color = style.getPropertyValue('color'),
			width = style.getPropertyValue('width'),
			height = style.getPropertyValue('height'),
			position = style.getPropertyValue('position'),
			top = style.getPropertyValue('top'),
			left = style.getPropertyValue('left'),
			background = style.getPropertyValue('background'),
			fontStyle = style.getPropertyValue('font-style'),
			fontSize = style.getPropertyValue('font-size'),
			cssstyle = 'font-style:' + fontStyle + ';' + 'font-size:' + fontSize + ';' + 'padding:'+padding+';' + 'color:' + color + ';' + 'width:' + width + ';' + 'height:' + height + ';' + 'position:' + position + ';' +
			'top:' + top + ';' + 'left:' + left + ';' + 'background:' + background + ';' + 'z-index:2147483647;' +'display:none;';
			return cssstyle;
		},
		spotlight: function(id){
			var elem = document.getElementById(id),
			style = window.getComputedStyle(elem),
			padding = style.getPropertyValue('padding'),
			color = style.getPropertyValue('color'),
			width = style.getPropertyValue('width'),
			height = style.getPropertyValue('height'),
			position = style.getPropertyValue('position'),
			top = style.getPropertyValue('top'),
			left = style.getPropertyValue('left'),
			background = style.getPropertyValue('background'),
			cssstyle = 'padding:' + padding + ';' + 'color:' + color + ';' + 'width:' + width + ';' + 'height:' + height + ';' + 'position:' + position +';' +
			'top:' + top+';' + 'left:' + left + ';' + 'background:' + background + ';' + 'z-index:2147483647;' + 'display:none;';
			return cssstyle;
		},
		speech: function(id){
			var elem = document.getElementById(id),
			style = window.getComputedStyle(elem),
			position = style.getPropertyValue('position'),
			width = style.getPropertyValue('width'),
			height = style.getPropertyValue('height'),
			textAlign = style.getPropertyValue('text-align'),
			background = style.getPropertyValue('background'),
			border = style.getPropertyValue('border'),
			color = style.getPropertyValue('color'),
			top = style.getPropertyValue('top'),
			left = style.getPropertyValue('left'),
			cssstyle = 'position:' + position + ';' + 'width:' + width + ';' + 'height:' + height + ';' + 
			'text-align:' + textAlign + ';' + 'background:' + background + ';' + 'border:' + border + ';' +
			'color:' + color + ';' + 'top:' + top + ';' + 'left:' + left + ';';
			return cssstyle;
		}
	}
}();
var time = function(){
	return{
		validate: function(start_,end_){
			var totalTimeEndStart = new Array(),
			getStartTime = start_.split(':'),
			getEndTime = end_.split(':'),
			start1 = getStartTime[0] * 3600, start2 = getStartTime[1] * 60,start3 = getStartTime[2] * 1,
			end1 = getEndTime[0] * 3600,end2 = getEndTime[1] * 60, end3 = getEndTime[2] * 1;
			if(getStartTime[0]>60 || getStartTime[1]>60 || getStartTime[2]>60 || getEndTime[0]>60 || getEndTime[1]>60 || getEndTime[2]>60) {totalTimeEndStart.push('error'); return totalTimeEndStart;}
			totalTimeEndStart[0] = (start1+start2+start3);
			totalTimeEndStart[1] = (end1+end2+end3);
			return totalTimeEndStart;
		},
		increment: function(st,timeDuration){
			getHMS = new Array();
			var timeDuration = timeDuration.split(':'),
			startTimeDuration = st.split(':'),
			hour = startTimeDuration[0],
			minute = startTimeDuration[1],
			second = startTimeDuration[2], 
			startTotalTimeDuration = ((hour*3600) + (minute*60) + (second*1));

			var timeDurationSec = timeDuration[2]*1,
			timeDurationMin = timeDuration[1]*60,
			timeDurationHrs = timeDuration[0]*3600,
			totalDuration = timeDurationSec + timeDurationMin + timeDurationHrs;
			if(totalDuration > startTotalTimeDuration){
				second++;
				if(second > 59){
					second = 0; 
					minute++;	
				}
				if(minute > 59){
					minute=0;
					hour++;
				}
				if(second<10) second = '0' + second * 1; 
				if(minute<10) minute = '0' + minute * 1;
				if(hour<10) hour = '0' + hour * 1; 
			 }
			 return hour+':'+minute+':'+second;
			 
		},
		decrement: function(st,duration){
			var timeDuration = duration,
				timeDuration = timeDuration.split(':'),
				startTimeDuration = st.split(':'),
				hour = startTimeDuration[0],
				minute = startTimeDuration[1],
				second = startTimeDuration[2], 
				startTotalTimeDuration = ((hour*3600) + (minute*60) + (second*1)); 
				var timeDurationSec = timeDuration[2]*1,
				timeDurationMin = timeDuration[1]*60,
				timeDurationHrs = timeDuration[0]*3600,
				totalDuration = timeDurationSec + timeDurationMin + timeDurationHrs;
				if(startTotalTimeDuration <= totalDuration){
					if(second==0){
						if(minute>0) {second=59;minute--;}		
					}else{
						second--;
					}
					if(minute==0){
						if(hour>0) {minute=59;hour--;}
					}
					if(second<10) second = '0' + second * 1; 
					if(minute<10) minute = '0' + minute * 1;
					if(hour<10) hour = '0' + hour * 1; 
				}
				 return hour+':'+minute+':'+second;
		}
	}
}();
$('.option-annot').bind('click', function(e){
	e.preventDefault();
	var id = this.id;
	annotations.loader();
	annotations.retrieve(id);
});

$('.rm-annot').bind('click', function(e){
	e.preventDefault();
	var id = this.id;
	var yes = confirm("Are you sure you want to delete this annotation?");
	if(yes){
		annotations.loader();
		setTimeout(function(){
			annotations.remove(id);
			$('#editor-annotation').fadeOut();
			$('#preview-annotation').fadeOut();
			$('#forever-remove-annot-'+id).remove();
		},3000);
		
	}
});
$('.sv-annot').bind('click', function(e){
	e.preventDefault();
	annotations.loader();
	var id = this.id,
	content = document.querySelector('input[name="content"]').value,
	start = document.querySelector('input[name="start"]').value,
	end = document.querySelector('input[name="end"]').value,
	getTime = time.validate(start,end),
	annotTypes = document.getElementById('edit-types').innerHTML;
	if(getTime[0]=='error'){ $('#loader-wrapper').fadeOut();$('#loader-wrapper').remove(); return alert('Please check your start and end time.');}
	if(document.getElementById('chk-link').checked == true) var link = document.querySelector('input[name="link"]').value;
	else var link = '';
	if(annotTypes=='Title'){var style = css.Title('preview-annotation');}
	else if(annotTypes=='Note'){var style = css.note('preview-annotation');}
	else if(annotTypes=='Spotlight'){var style = css.spotlight('preview-annotation');}
	else if(annotTypes=='Speech'){var style = css.speech('preview-annotation');}
	setTimeout(function(){
		annotations.update(id,content,getTime[0],getTime[1],link,style);
		if(content.length >= 15) {content = content.substring(0,15); content = content +'...'; }
		document.getElementById(id).innerHTML = content;
		$('#editor-annotation').fadeOut();
	},3000);
	
});
$('#edit-start-inc').click(function(){
	var st = document.querySelector('input[name=start]').value,
	 duration = document.querySelector('input[name=hms]').value,
	 getHMS = time.increment(st,duration);
	 document.querySelector('input[name=start]').value = getHMS;
	 document.querySelector('input[name=start]').focus();
});
$('#edit-start-dec').click(function(){
	var st = document.querySelector('input[name=start]').value,
	 duration = document.querySelector('input[name=hms]').value,
	 getHMS = time.decrement(st,duration);
	 document.querySelector('input[name=start]').value = getHMS;
	 document.querySelector('input[name=start]').focus();
});
$('#edit-end-inc').click(function(){
	var st = document.querySelector('input[name=end]').value,
	 duration = document.querySelector('input[name=hms]').value,
	 getHMS = time.increment(st,duration);
	 document.querySelector('input[name=end]').value = getHMS;
	 document.querySelector('input[name=end]').focus();
});
$('#edit-end-dec').click(function(){
	var st = document.querySelector('input[name=end]').value,
	 duration = document.querySelector('input[name=hms]').value,
	 getHMS = time.decrement(st,duration);
	 document.querySelector('input[name=end]').value = getHMS;
	 document.querySelector('input[name=end]').focus();
});
$('#').keypress(function(evt){
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
});
$('#edit-start-time').keypress(function(evt){
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
});
$('#edit-end-time').keypress(function(evt){
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
});
$('#edit-content').keyup(function(){
	var getContent = document.querySelector('input[name=content]').value;
	document.getElementById('preview-annotation').innerHTML = getContent;
});
$('#chk-link').bind('click', function(){
	if(document.getElementById('chk-link').checked == true) $('#annot-link').fadeIn();
	else $('#annot-link').fadeOut();
});
$('#t-1').bind('mouseover',function(){
	var selector = this.id;
	setAsThumbnail(selector);
});
$('#t-2').bind('mouseover',function(){
	var selector = this.id;
	setAsThumbnail(selector);
});
$('#t-3').bind('mouseover',function(){
	var selector = this.id;
	setAsThumbnail(selector);
});

$('#t-1').bind('mouseleave',function(){
	var selector = this.id;
	removeThumbnailCaption(selector);
});
$('#t-2').bind('mouseleave',function(){
	var selector = this.id;
	removeThumbnailCaption(selector);
});
$('#t-3').bind('mouseleave',function(){
	var selector = this.id;
	removeThumbnailCaption(selector);
});
$('#t-1').bind('click',function(){
	var selector = this.id;
	$(this).css({'border':'3px solid #0b8ddd'});
	$('#t-2').css({'border':'0px solid #0b8ddd'});
	$('#t-3').css({'border':'0px solid #0b8ddd'});
	var thumbSrc = document.getElementById('thumb-1').src;
	getId('selected-thumbnail').value = thumbSrc;
	document.getElementById('media-video').poster = thumbSrc;
});
$('#t-2').bind('click',function(){
	var selector = this.id;
	$(this).css({'border':'3px solid #0b8ddd'});
	$('#t-1').css({'border':'0px solid #0b8ddd'});
	$('#t-3').css({'border':'0px solid #0b8ddd'});
	var thumbSrc = document.getElementById('thumb-2').src;
	getId('selected-thumbnail').value = thumbSrc;
	document.getElementById('media-video').poster = thumbSrc;
});
$('#t-3').bind('click',function(){
	var selector = this.id;
	$(this).css({'border':'3px solid #0b8ddd'});
	$('#t-1').css({'border':'0px solid #0b8ddd'});
	$('#t-2').css({'border':'0px solid #0b8ddd'});
	var thumbSrc = document.getElementById('thumb-3').src;
	getId('selected-thumbnail').value = thumbSrc;
	document.getElementById('media-video').poster = thumbSrc;
});
function setAsThumbnail(selector){
	$('.caption-' + selector).html('Set as thumbnail').css({'color':'#0b8ddd', 'line-height':'500%', 'cursor':'pointer', 'background':'rgba(42,42,42,0.5)', 'text-align':'center', 'width':'100%','height':'100%', 'margin':'auto','position':'absolute','top':'0','left':'0','right':'0','bottom':'0'});
	$('#'+selector).css({'outline':'3px solid #0b8ddd','background':'rgba(42,42,42,0.5)'});
}
function removeThumbnailCaption(selector){
	$('.caption-' + selector).html('').css({'background':'transparent', 'margin':'auto','position':'absolute','top':'0','left':'0','right':'0','bottom':'0'});
	$('#'+selector).css({'outline':'0px solid #0b8ddd','background':'transparent'});
}
function getId(id){
	return document.getElementById(id);
}
// $('textarea#description').keyup(function(e){
// 	var getLength = document.getElementById('description').value.length;
// 	checkLimit(getLength);
// });
// $('textarea#description').mousemove(function(e){
// 	var getLength = document.getElementById('description').value.length;
// 	checkLimit(getLength);
// });
function checkLimit(limit){
	$('#char-limit').html(limit);
	if(limit<=min){$('#char-limit').html(limit).css({'color':'#ff0000'});$('#max-limit').html('/5000');}
	if(limit>=min && limit < max){$('#char-limit').html(limit).css({'color':'#0b58dd'});
	//document.getElementById("submit-save-changes").disabled = false;
	$('#max-limit').html('/5000');}
	else{
		//document.getElementById("submit-save-changes").disabled = true;
	}
	if(limit>=max){
		var charLen = document.getElementById('description').value.length;
		$('#char-limit').html(limit);$('#max-limit').html('/5000 &nbsp;' + "<small style='font-style:italic;color:red'>Oops you reach the limit.</small>");
	}
}
function  singleAnnotation(types,style,content){
	$("#preview-annotation").remove();
	var annotationEditor = document.createElement('div'),
	style = style.replace('display:none;','display:block;');
	annotationEditor.setAttribute('id','preview-annotation');
	if(types=='note'){
		annotationEditor.setAttribute('style',style);
	}else if(types=='title'){
		annotationEditor.setAttribute('style',style+'border:1px solid #f18200;');
	}else if(types=='spotlight'){
		annotationEditor.setAttribute('style',style);
	}else if(types=='speech'){
		annotationEditor.className = 'speech';
		annotationEditor.setAttribute('style',style);
	}
	document.getElementById('custom-annotation').appendChild(annotationEditor);
	annotationEditor.innerHTML = content;
	$('#editor-annotation').fadeIn();
	annotationEditor.onmousedown = function(event){
		drag.startMoving(this,'media-video',event);
		$(this).css({'cursor':'move'});
	}
	annotationEditor.onmouseup = function(){
		drag.done('media-video');
		$(this).css({'cursor':'default'});
	}
}
$('#upload-cancel').on('click',function(){
	$('#cancel-upload-vid').modal('show');
});
$('#save-cover-photo').on('click',function(id){
	var id = document.querySelector('input[name=token-id]').value;
	$.ajax({
		type: 'POST',
		url: '/mychannels/edit/'+id,
		cache: false,
		data: $('form').serialize(),
		success: function(){
			annotations.response('Changes of poster has been saved.', 'glyphicon glyphicon-saved');
		},
		error: function(){
			annotations.response('Error while saving poster.', 'glyphicon glyphicon-saved');
		}
	});
});