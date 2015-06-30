@extends('layouts.default')
@section('css')
{{HTML::style('css/vid.player.min.css')}}
{{HTML::style('css/update-video.css')}}
@stop
@section('some_script')
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/user/edit.js')}}
{{HTML::script('js/video-player/media.player.min.js')}}

<script type="text/javascript">
	var annotation = document.getElementById('annotation'), CSSstyle = '',checkbox, count=0, annot = 'annotation', h=0, m=0,s=0, filename = document.getElementById('filename').value,types,content,start,end,link,
	hms = document.getElementById('hms').value, min=50, max=5000, limitChar = document.getElementById('description').value.length;
	$('#char-limit').html(limitChar);
	document.getElementById("submit-save-changes").disabled = true;
	if(limitChar>=50){
		document.getElementById("submit-save-changes").disabled = false;
	}
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
		                  var videoPlayer = document.getElementById('media-video');
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
		$('#annotation-label').on('click',function(e){
			e.preventDefault();
			createAnnotation('Label:','label');     
		});

		function createAnnotation(title,id){
			count += 1; 
			var annotationTypeTag = document.createElement('span');
			if(id=='note'){annotationTypeTag.className = 'glyphicon glyphicon-file';}
			else if(id=='title'){annotationTypeTag.className = 'glyphicon glyphicon-font';}
			else if(id=='spotlight'){annotationTypeTag.className = 'glyphicon glyphicon-link';}
			else if(id=='label'){annotationTypeTag.className = 'glyphicon glyphicon-comment';}
			var annotationTypeCaption = document.createTextNode(title);
			var types = document.createTextNode(title);
			var createDiv = document.createElement('div');
			var close = document.createElement('span');
			//close.id = 'close-annotation-' + id + '-' + count;
			close.title = 'Delete';
			close.className = 'glyphicon glyphicon-trash';
			var save = document.createElement('span');
			save.className = 'glyphicon glyphicon-floppy-save';
			save.title = 'Save-' + id;
			content = document.createElement('textarea'); 
			checkbox = document.createElement('input');
			checkbox.type = 'checkbox';  
			checkbox.name = 'checkbox' + '-url-' + annot +'-' + id + '-' + count;
			checkbox.id = 'checkbox' + '-url-' + annot +'-' + id + '-' + count;
			var label = document.createElement('label');
			var labelText = document.createTextNode('link');
			var closeText = document.createTextNode(''); 
			var saveText = document.createTextNode('');  
			createDiv.appendChild(annotationTypeTag);
			annotationTypeTag.appendChild(annotationTypeCaption);
			close.appendChild(closeText);
			save.appendChild(saveText); 
			label.appendChild(labelText);
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
			annotation.appendChild(createDiv); 
			createDiv.appendChild(close);
			createDiv.appendChild(save);
			createDiv.appendChild(content); 
			
			 
			var startTagLabel = document.createElement('label');
			var startTagCaption = document.createTextNode('Start:');
				startTagLabel.appendChild(startTagCaption);
				createDiv.appendChild(startTagLabel);
			var startTime = document.createElement('input'); 
				startTime.type = 'text';
				startTime.id = 'start' + '-time-' + annot + '-' + id + '-' + count;
				startTime.name = 'start' + '-time-annotation-' + id + '-' + count;
				startTime.value = h+'0:'+m+'0:'+s+'0';
				createDiv.appendChild(startTime);
				
			var endTagLabel = document.createElement('label');
			var endTagCaption = document.createTextNode('End:');
				endTagLabel.appendChild(endTagCaption);
				createDiv.appendChild(endTagLabel);
			var endTime = document.createElement('input');  
				endTime.type = 'text';
				endTime.id = 'end' + '-time-annotation-' + id + '-' + count;
				endTime.name = 'end' + '-time-annotation-' + id + '-' +count;
				endTime.value = hms;
				createDiv.appendChild(endTime);
				createDiv.appendChild(checkbox); 
				createDiv.appendChild(label);
			var url = document.createElement('input');
					url.type = 'text';
					url.id = 'url' + '-annotation-' + id + '-' + count;
					url.name = 'url' + '-annotation-' + id + '-' + count;
					url.setAttribute('placeholder', 'Enter url e.g: www.tefltv.com');
					url.setAttribute('style', 'display:none');
					createDiv.appendChild(url);
			/*
			* Create div of Annotation at video 
			*/
			var annotWrapper = document.createElement('div');
			var annotDiv = document.createElement('div');
			var annotClose = document.createElement('span');
			if(id=="note"){
				annotDiv.setAttribute('style','padding:3px;color:#fff;min-width:200px;min-height:25px;position:absolute;top:0;left:0;right:auto;bottom:auto;background:rgba(42,42,42,0.6);');
			}
			else if(id=="title"){
				annotDiv.setAttribute('style','padding:3px;color:#fff;min-width:200px;min-height:25px;position:absolute;top:0;right:0;left:auto;bottom:auto;background:rgba(42,42,42,0.6);');
			}
			else if(id=='spotlight'){
				annotDiv.setAttribute('style','padding:3px;color:#fff;min-width:200px;min-height:25px;position:absolute;bottom:0;left:0;top:auto;right:auto;background:rgba(42,42,42,0.6);');
			}
			else if(id=='label'){
				annotDiv.setAttribute('style','padding:3px;color:#fff;min-width:200px;min-height:25px;position:absolute;bottom:0;right:0;left:auto;top:auto;background:rgba(42,42,42,0.6);');
			}
			annotDiv.setAttribute('id','div-annotation-' + id + '-' + count);
			annotClose.setAttribute('style','padding:2px;color:#fff;border-radius:0px 0px 0px 5px;position:absolute;top:0;right:0;bottom:auto;left:auto;background:rgba(42,42,42,0.8);cursor:pointer;');
			annotClose.setAttribute('id', 'close-annotation-' + id + '-' + count);
			document.getElementById("custom-annotation").appendChild(annotDiv);
			//var wrap = document.getElementById("custom-annotation");
			//wrap.insertBefore(annotDiv, wrap.firstChild);
			annotDiv.appendChild(annotClose);
			var annotContent = document.createTextNode(''); 
			var x = document.createTextNode('x');
			annotDiv.appendChild(annotContent);
			annotClose.appendChild(x);
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
				$('.'+getid).css({'border-bottom':'1px solid red'});
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
				 var elements = document.getElementById(css),
				     style = window.getComputedStyle(elements),
				     padding = style.getPropertyValue('padding'),
				     color = style.getPropertyValue('color'),
				     minWidth = style.getPropertyValue('min-width'),
				     minHeight = style.getPropertyValue('min-height'),
				     position = style.getPropertyValue('position'),
				     top = style.getPropertyValue('top'),
				     right = style.getPropertyValue('right'),
				     left = style.getPropertyValue('left'),
				     bottom = style.getPropertyValue('bottom'),
				     background = style.getPropertyValue('background');
				     CSSstyle = 'padding:'+padding+';' + 'color:' + color+';' + 'min-width:' + minWidth+';' + 'min-height:' + minHeight+';' + 'position:' + position+';' +
				     'top:' + top+';' + 'right:' + right+';' + 'bottom:' + bottom+';' + 'background:' + background+';'+'display:none;';
					 var rm = getid.replace('save-','');
					 $('#'+rm).remove();
					 annotations.loader();
					 annotations.add(filename,types,content,totalStartTimeSec,totalEndTimeSec,link,CSSstyle);
					 //annotations.response('New annotation has been added.', 'glyphicon glyphicon-saved');
					 // var videoElement = document.getElementById('media-video'),
					 // vidStyle = window.getComputedStyle(videoElement),
					 // vidWidth =  vidStyle.getPropertyValue('width'),
					 // vidHeight =  vidStyle.getPropertyValue('height');
					 // vidHeight = vidHeight.replace('px','');
					 // minHeight = minHeight.replace('px','');
					 // top = top.replace('px','');
					 // bottom = vidHeight - minHeight - top;
			}
			save.onmouseover = function(){
				var getid = this.id;
				$('#'+getid).css({'border-bottom':'2px solid #0f85e0'});
			}
			save.onmouseleave = function(){
				var getid = this.id;
				$('#'+getid).css({'border-bottom':'1px solid red'});
			}
			annotClose.onclick = function(){
				var getid = this.id;
				var removeDiv = getid.replace('close-','');
				$('#'+removeDiv).remove();
				$('#div-'+removeDiv).remove();
			}
			content.onkeyup = function(){
				var getid = this.id;
				var getCurrentId = getid.replace('content','div');
				var contents = content.value;
				$('#'+getCurrentId).html(contents);
			}
			startTime.onkeyup = function(){
				var getid = this.id;
				var len = selector(getid).value.length;
				if(len>8){selector(getid).value='00:00:00';}
			}
			endTime.onkeyup = function(){
				var getid = this.id;
				var len = selector(getid).value.length;
				if(len>8){selector(getid).value=hms;}
			}
			annotDiv.onmousedown = function(e){
				 mov(e);
			} 
			annotDiv.onmouseup = function(){
				
			} 
			function mouseUp(){
				document.removeEventListener('mousemove',function(e){
					mov(e);
				},false);
			}
			function mouseDown(){
				document.addEventListener('mousemove',function(e){
					mov(e);
				},true);
			}
			function mov(e){
			  var div = selector('div-annotation-note-1');
			  div.style.top = e.pageY - (e.pageY - div.offsetTop) + "px";
			  div.style.left = e.pageX - (e.pageX - div.offsetLeft) + "px";
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
									data: {filename:filename, types:types,content:content,start:start,end:end,link:link,css:CSSstyle},
									success: function(e){
										console.log(e.msg);
										$('#loader-wrapper').fadeOut();
										$('#loader-wrapper').remove();
										close.className = 'glyphicon glyphicon-trash ' + e.id;
										annotations.response('New annotation has been added.', 'glyphicon glyphicon-saved');
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
										annotations.response('Annotation has been removed.', 'glyphicon glyphicon-trash');
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
											var prevAnnotation = document.getElementById('preview-annotation');
											prevAnnotation.setAttribute('style',e.css);
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
						 update: function(id,content,start,end,link){
						 	$.ajax({
									type: 'POST',
									url:'/annotationupdate/'+id,
									data: {content:content,start:start,end:end,link:link},
									success: function(e){
										$('#loader-wrapper').fadeOut();
										$('#loader-wrapper').remove();
										console.log(e.msg);
										annotations.response('Changes has been saved.','glyphicon glyphicon-check');
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
						 		notifier.setAttribute('style','text-align:center;width:400px;height:45px;padding:10px;position:fixed;margin:auto;top:0;bottom:0;right:0;left:0;background:rgb(184, 202, 239);color:#063782;text-shadow: 0 0 2px #000;box-shadow: 5px 5px 5px #888888;');
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
						 	var	loaderTxt = document.createTextNode('Please wait...'); 
						 		loader.setAttribute('class','annotation-loader');
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
						 lists: function(filename){
						 	$('#annotation-lists').load('/annotationlists/'+filename,function(responseTxt,statusTxt){

						 	});
						 }

					}
			}();
function addedTmpAnnotation(id,types,contents){
	contents = contents.substring(0,15);
	var newannotation = document.createElement('li'),
	 href = document.createElement('a'),
	 txt = document.createTextNode(types+'-'+contents+'...');
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
				curSec = Math.floor(duration - (curMin * 60));
				if(curHrs < 10)curHrm = "0"+curHrs;
				if(curMin < 10)curMin = "0"+curMin;
				if(curSec < 10)curSec = "0"+curSec;
				return curHrm + ':' + curMin + ':' +curSec;
		   }
	}
}();
$('.option-annot').bind('click', function(e){
	e.preventDefault();
	var id = this.id;
	annotations.loader();
	annotations.retrieve(id);
	$('#editor-annotation').fadeIn();
});
$('.rm-annot').bind('click', function(e){
	e.preventDefault();
	var id = this.id;
	var yes = confirm("Are you sure you want to delete this annotation?");
	if(yes){
		annotations.loader();
		annotations.remove(id);
		$('#editor-annotation').fadeOut();
		$('#forever-remove-annot-'+id).remove();
	}
});
$('.sv-annot').bind('click', function(e){
	e.preventDefault();
	annotations.loader();
	var id = this.id;
	var content = document.querySelector('input[name="content"]').value;
	var start = document.querySelector('input[name="start"]').value;
	var end = document.querySelector('input[name="end"]').value;
	var getTime = time.validate(start,end);
	if(getTime[0]=='error'){ $('#loader-wrapper').fadeOut();$('#loader-wrapper').remove(); return alert('Please check your start and end time.');}
	if(document.getElementById('chk-link').checked == true) var link = document.querySelector('input[name="link"]').value;
	else var link = '';
	annotations.update(id,content,getTime[0],getTime[1],link);
	$('#editor-annotation').fadeOut();
});
var time = function(){
	return{
		validate: function(start,end){
				   var totalTimeEndStart = new Array(),
					  getStartTime = start.split(':'),
					  getEndTime = end.split(':'),
					  start1 = getStartTime[0] * 3600, start2 = getStartTime[1] * 60,start3 = getStartTime[2] * 1,
					  //endTimeVal = getid.replace('save-', 'end-time-'),
					  end1 = getEndTime[0] * 3600,end2 = getEndTime[1] * 60, end3 = getEndTime[2] * 1;
					 if(getStartTime[0]>60 || getStartTime[1]>60 || getStartTime[2]>60 || getEndTime[0]>60 || getEndTime[1]>60 || getEndTime[2]>60) totalTimeEndStart.push('error'); return totalTimeEndStart;
					  totalTimeEndStart.push(start1+start2+start3);
					  totalTimeEndStart.push(end1+end2+end3);
					 return totalTimeEndStart;
						}
	}
}();
function validateTime(getid,startId,endId){
 
}
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
	$('.caption-' + selector).html('Set as thumbnail').css({'color':'#0b8ddd','line-height':'90px', 'cursor':'pointer', 'background':'rgba(42,42,42,0.5)', 'text-align':'center', 'width':'100%','height':'100%', 'margin':'auto','position':'absolute','top':'0','left':'0','right':'0','bottom':'0'});
	$('#'+selector).css({'outline':'3px solid #0b8ddd','background':'rgba(42,42,42,0.5)'});
}
function removeThumbnailCaption(selector){
	$('.caption-' + selector).html('').css({'background':'transparent', 'margin':'auto','position':'absolute','top':'0','left':'0','right':'0','bottom':'0'});
	$('#'+selector).css({'outline':'0px solid #0b8ddd','background':'transparent'});
}
function getId(id){
 	return document.getElementById(id);
}
$('textarea#description').keyup(function(e){
	var getLength = document.getElementById('description').value.length;
   checkLimit(getLength);
});
$('textarea#description').mousemove(function(e){
	var getLength = document.getElementById('description').value.length;
   checkLimit(getLength);
});
function checkLimit(limit){
   $('#char-limit').html(limit);
   if(limit<=min){$('#char-limit').html(limit).css({'color':'#ff0000'});$('#max-limit').html('/5000');}
   if(limit>=min && limit < max){$('#char-limit').html(limit).css({'color':'#0b58dd'});document.getElementById("submit-save-changes").disabled = false;$('#max-limit').html('/5000');}
   else{document.getElementById("submit-save-changes").disabled = true;}
   if(limit>=max){
   	var charLen = document.getElementById('description').value.length;
   	$('#char-limit').html(limit);$('#max-limit').html('/5000 &nbsp;' + "<small style='font-style:italic;color:red'>Oops you reach the limit.</small>");
   	}
   	
}
$('#upload-cancel').on('click',function(){
        $('#cancel-upload-vid').modal('show');
    });

</script>
@stop
@section('content')
{{-- */$tagID = 1;/* --}}
{{-- */$explodeID = 0;/* --}}
{{-- */$tagDelete = 1;/* --}}
{{-- */$explodeRemove = 0;/* --}}




<div class="row">
	<div class="container page">
		<br/>
		<div class="row same-H White">
			@include('elements/users/profileTop')
			<div class="Div-channel-border">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation">{{link_to_route('users.channel', 'Home')}}</li>
						<li role="presentation" class="active">{{link_to_route('users.myvideos', 'My Videos')}}</li>
						<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
						<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
						<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
						<!--<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>-->
						<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>

					</ul>
				</div><!--tabpanel-->
				<br/>

				<div id="videosContainer" class='container'>
					<div class="col-md-12">
						<!--upload update Video modal-->
						{{Form::model($video, array('route' => array('video.post.edit',$video->file_name), 'files'=>true))}}

						<div class="col-md-8">
							<br/>

							<div id="vid-controls" class="p-relative">
								<div class="embed-responsive embed-responsive-16by9" id='custom-annotation'>
									<div id='preview-annotation' style='z-index:300000;width:100px;height:100px;background:green;'>
									 	
									 </div>
									@if(file_exists(public_path('/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'.jpg')))
											<video id="media-video" preload="auto" width="100%" poster="/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}_600x338.jpg" class="embed-responsive-item">
												<source id='mp4' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.mp4' type='video/mp4'>
												<source id='webm' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.webm' type='video/webm'>
											</video>
									@else
											<video id="media-video" preload="auto" width="100%" poster="/img/thumbnails/video.png" class="embed-responsive-item">
												<source id='mp4' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.mp4' type='video/mp4'>
												<source id='webm' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.webm' type='video/webm'>
											</video>
									@endif
													
												</div><!--embed-responsive-->
												@include('elements/videoPlayer')

											</div><!--vid-controls-->
											<br/>
											
											

										</div><!--/.col-md-8-->
										<div class="col-md-4 text-center">
											
											@if(file_exists($thumbnail))
											<h3 class="text-center">Available thumbnails:</h3>
												<div class="col-md-6 col-md-offset-3">
												<div id='t-1' style='position:relative;display:block' class="center-block">
												<img src="{{'/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'_thumb1.png'}}" id='thumb-1' class='img-thumbnail thumbnail-2' width="150" height="100" >
												<label class='caption-t-1'></label>
												</div>
												<div id='t-2' style='position:relative;display:block' class="center-block">
													<img src="{{'/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'_thumb2.png'}}" id='thumb-2' class='img-thumbnail thumbnail-2' width="150" height="100" >
													<label class='caption-t-2'></label>
												</div>
												<div id='t-3' style='position:relative;display:block' class="center-block">
													<img src="{{'/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'_thumb3.png'}}" id='thumb-3' class='img-thumbnail thumbnail-2' width="150" height="100" >
													<label class='caption-t-3'></label>
												</div>
												</div>
											@else
											<h3 class="text-center">No available thumbnail:</h3>
												<div id='t-1' style='position:relative;display:block' class="center-block">
													<img src="/img/thumbnails/125x125.jpg" id='thumb-1' class='img-thumbnail thumbnail-2' width="150" height="100" >
													<label class='caption-t-1'></label>
												</div>
												<br/>
												<div id='t-2' style='position:relative;display:block' class="center-block">
													<img src="/img/thumbnails/125x125.jpg" id='thumb-2' class='img-thumbnail thumbnail-2' width="150" height="100" >
													<label class='caption-t-2'></label>
												</div>
												<br/>
												<div id='t-3' style='position:relative;display:block' class="center-block">
													<img src="/img/thumbnails/125x125.jpg" id='thumb-3' class='img-thumbnail thumbnail-2' width="150" height="100" >
													<label class='caption-t-3'></label>
												</div>
											@endif
											<span class="file-upload mg-t-10">
												<span class="btn btn-primary"><i class="fa fa-arrow-up"></i> Upload Video Cover</span>
												<input type="file" name="poster" id="poster" accept="image/*"/>
												<input type="hidden" value="{{$video->file_name}}" name="filename" id="filename"/>
											</span>
											
											
										</div>

										<div class="col-md-12 content-padding">
											
											@if($errors->has('publish'))
											<span class="inputError">
												{{$errors->first('publish')}}
											</span>
											@endif
											
											{{ Form::select('publish', ['1'=>'Publish','0'=>'Unpublish'], $video->publish,array('class'=>"form-control",'style'=>"width:auto;margin-top:10px;margin-bottom:10px"))}}

											<span class="dropdown">
												<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"> <span class='glyphicon glyphicon-comment'></span> Add Annotation
													<span class="caret"></span></button>
													<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														<li role="presentation"> <a id='annotation-note' role="menuitem" tabindex="-1" href="#"> <span class='glyphicon glyphicon-file'></span> Note</a></li>
														<li role="presentation"><a id='annotation-title' role="menuitem" tabindex="-2" href="#"><span class='glyphicon glyphicon-font'></span> Title</a></li>
														<li role="presentation"><a id='annotation-spotlight' role="menuitem" tabindex="-3" href="#"><span class='glyphicon glyphicon-link'></span> Spotlight</a></li>
														<li role="presentation"><a id='annotation-label' role="menuitem" tabindex="-4" href="#"><span class='glyphicon glyphicon-comment'></span> Label</a></li>
													</ul>
											</span>
											<span class="dropdown">
												<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"> <span class='glyphicon glyphicon-pencil'></span> Edit Existing Annotation
													<span class="caret"></span></button>
													<ul class="dropdown-menu" role="menu" aria-labelledby="menu1" id='annotation-lists'>
														@if($countAnnotation > 0)
															@foreach($annotations as $annotation)
																<li id='forever-remove-annot-{{$annotation->id}}' role="presentation"><a id='{{$annotation->id}}'role="menuitem" class='option-annot' tabindex="-1" href="#">{{$annotation->types}}-{{str_limit($annotation->content,15)}}</a></li>
															@endforeach
														@else
																<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Empty</a></li>
														@endif                                                                                                                                                                                                     
													</ul>
											</span>
											
													<br>
													<ul id='editor-annotation'>
														<li><span id='edit-types'> </span> <div><span id='sv-annot' class="sv-annot glyphicon glyphicon-floppy-saved" title='Save changes'></span> <span id='rm-annot' title='Remove' class="rm-annot glyphicon glyphicon-remove"></span></div></li>
														<li>Content:{{Form::text('content',null)}}</li>
														<li>Start:{{Form::text('start',null)}}</li>
														<li>End:{{Form::text('end',null)}}</li>
														<li>Link: {{Form::checkbox('chk-link','grald',false,['id'=>'chk-link'])}}</li>
														<li>{{Form::text('link',null,['style'=>'display:none;','id'=>'annot-link'])}}</li>
													</ul>
													<div class="" id="annotation">
														<!--ANNOTATION AREA-->
													</div>
													<br/>
													<div class="well">
														{{ Form::label('Title:')}}
														@if($errors->has('title'))
														<span class="inputError">
															{{$errors->first('title')}}
														</span>
														@endif
														{{ Form::text('title', null, array('class'=>'form-control','required'=>true)) }}
													</div>
													<div class="well">
														{{ Form::label('Description:')}}
														@if($errors->has('description'))
														<span class="inputError">
															{{$errors->first('description')}}
														</span>
														@endif
														{{ Form::textarea('description', null, array('class'=>'form-control','id'=>'description', 'style'=>"height:150px!important;",'required'=>true, 'maxlength'=>5000)) }}
														<small id='char-limit'>0</small><small id='max-limit'>/5000</small><br/>
														<small>Note: Minimum characters should be atleast 50 and max 5000.</small>
														
													</div>
													<div class="well">
														{{ Form::label('Tags:')}}&nbsp;<span class="notes">( *Use comma(,) to separate each tags. e.g. Education,Blog )<br/></span>
														{{ Form::text('new_tags', null, array('class'=>'form-control','placeholder'=>'Add new tags...')) }}<br/><br/>
														{{ Form::hidden('text1',Crypt::encrypt($video->id), array('class'=>'form-control','id'=>'text1')) }}
														{{ Form::hidden('selected-thumbnail',0,['id'=>'selected-thumbnail'])}}
														{{ Form::hidden('hms',$hms,['id'=>'hms'])}}
														<p class="notes">*Double click the existing tag to edit.</p>
														<div id="wrapper">
															@if($tags == null)
															No tags available.
															@else
															@foreach($tags as $key=>$tag)
															<div class="span-tags" id="tagID{{$tagID++}}" data-encrypt="{{Crypt::encrypt($explodeID++)}}">{{$tag}} <span class="glyphicon glyphicon-remove-circle"  data-encrypt="{{Crypt::encrypt($explodeRemove++)}}" id="tagDelete{{$tagDelete++}}" style="cursor: pointer"></span>
															</div>
															@endforeach
															@endif
														</div>
														
													</div>
													<div class="well">
															{{Form::label('Category:')}}<br/>
															<span class="v-category">
												{{Form::checkbox('cat[]','Advice',$videoCategory[0],['id'=>'advice'])}}
												<label for='advice'>Advice</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Animated Music Video',$videoCategory[1],['id'=>'anim-music-vid'])}}
												<label for='anim-music-vid'>Animated Music Video</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Animated Video',$videoCategory[2],['id'=>'anim-vid'])}}
												<label for='anim-vid'>Animated Video</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Documentaries',$videoCategory[3],['id'=>'documentaries'])}}
												<label for='documentaries'>Documentaries</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','For Students',$videoCategory[4],['id'=>'for-students'])}}
												<label for='for-students'>For Students</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','For Teachers',$videoCategory[5],['id'=>'for-teachers'])}}
												<label for='for-teachers'>For Teachers</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Interviews',$videoCategory[6],['id'=>'interviews'])}}
												<label for='interviews'>Interviews</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Job AD',$videoCategory[7],['id'=>'job-ad'])}}
												<label for='job-ad'>Job AD</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Miscellaneous',$videoCategory[8],['id'=>'miscellaneous'])}}
												<label for='miscellaneous'>Miscellaneous</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Music',$videoCategory[9],['id'=>'music'])}}
												<label for='music'>Music</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Podcast',$videoCategory[10],['id'=>'podcast'])}}
												<label for='podcast'>Podcast</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','qa',$videoCategory[11],['id'=>'qa'])}}
												<label for='qa'>Question and Answer</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Video Blog',$videoCategory[12],['id'=>'vid-blog'])}}
												<label for='vid-blog'>Video Blog</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Video CV',$videoCategory[13],['id'=>'vid-cv'])}}
												<label for='vid-cv'>Video CV</label>
											</span>
														</div>	
													<br/>
													<div class="text-right mg-b-10"> 
														{{Form::submit('Save Changes', array('id'=>'submit-save-changes', 'class' => 'btn btn-info'))}}
													</div>
												</div><!--/.col-md-7-->
												{{Form::close()}}
											</div><!--/.col-md-12-->
										</div><!--/.videos-container-->
									</div><!--/.Div-channel-border-->
								</div><!--/.row same-H-->
								<br/>
							</div><!--/.containerpage row-->
						</div><!--/.row-->
@stop




