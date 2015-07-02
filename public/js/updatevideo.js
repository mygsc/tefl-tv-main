var annotation = document.getElementById('annotation'), CSSstyle = '',checkbox, count=0, annot = 'annotation', h=0, m=0,s=0, filename = document.getElementById('filename').value,types,content,start,end,link,
	hms = document.getElementById('hms').value, min=50, max=5000, limitChar = document.getElementById('description').value.length, videoPlayer = document.getElementById('media-video');
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
			var annotationTypeTag = document.createElement('span');
			if(id=='note'){annotationTypeTag.className = 'glyphicon glyphicon-file';}
			else if(id=='title'){annotationTypeTag.className = 'glyphicon glyphicon-font';}
			else if(id=='spotlight'){annotationTypeTag.className = 'glyphicon glyphicon-link';}
			else if(id=='speech'){annotationTypeTag.className = 'glyphicon glyphicon-comment';}
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
					url.setAttribute('placeholder', 'Enter url e.g: http://www.tefltv.com');
					url.setAttribute('style', 'display:none');
					createDiv.appendChild(url);
			/*
			* Create div of Annotation at video 
			*/
			var annotWrapper = document.createElement('div');
			var annotDiv = document.createElement('div');
			var annotClose = document.createElement('div');
				annotClose.className = 'speech';
			if(id=="note"){
				annotDiv.setAttribute('style','resize:both;overflow:hidden;padding:3px;color:#fff;width:200px;height:25px;position:absolute;top:10px;left:10px;background:rgba(42,42,42,0.6);');
			}
			else if(id=="title"){
				annotDiv.setAttribute('style','resize:both;overflow:hidden;border:1px solid #000;font-style:normal;font-size:30px;padding:3px;color:#fff;width:200px;height:50px;position:absolute;top:20px;left:20px;background:transparent;text-shadow: 0 0 2px #000;');
			}
			else if(id=='spotlight'){
				annotDiv.setAttribute('style','resize:both;overflow:hidden;padding:3px;border:1px solid #f18200;color:#fff;width:200px;height:25px;position:absolute;left:30px;top:30px;background:rgba(42,42,42,0.6);');

			}
			else if(id=='speech'){
				//annotDiv.setAttribute('style','padding:3px;color:#fff;min-width:200px;min-height:25px;position:absolute;left:40px;top:40px;background:rgba(42,42,42,0.6);');
				annotDiv.className = 'speech';
			}
			annotDiv.setAttribute('id','div-annotation-' + id + '-' + count);
			//annotClose.setAttribute('style','padding:2px;color:#fff;border-radius:0px 0px 0px 5px;position:absolute;top:0;right:0;bottom:auto;left:auto;background:rgba(42,42,42,0.8);cursor:pointer;');
			//annotClose.setAttribute('id', 'close-annotation-' + id + '-' + count);
			document.getElementById("custom-annotation").appendChild(annotDiv);
			//var wrap = document.getElementById("custom-annotation");
			//wrap.insertBefore(annotDiv, wrap.firstChild);
			//annotDiv.appendChild(annotClose);
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
				 var getstyle = annotations.css(css);
					 var rm = getid.replace('save-','');
					 $('#'+rm).remove();
					 $('#div-'+rm).remove();
					 annotations.loader();
					 annotations.add(filename,types,content,totalStartTimeSec,totalEndTimeSec,link,getstyle);
			}
			save.onmouseover = function(){
				var getid = this.id;
				$('#'+getid).css({'border-bottom':'2px solid #0f85e0'});
			}
			save.onmouseleave = function(){
				var getid = this.id;
				$('#'+getid).css({'border-bottom':'1px solid red'});
			}
			annotDiv.onmousedown = function(){
				drag.startMoving(this,'media-video',event);
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
										annotations.response('New annotation has been added.', 'glyphicon glyphicon-saved');
										addedTmpAnnotation(e.id,e.types,e.content);
									},
									error: function(){
										console.log('OOps error while adding annotation.');
										$('#loader-wrapper').fadeOut();
										$('#loader-wrapper').remove();
										annotations.response('Oops error occured, please check your connection.','glyphicon glyphicon-remove');
										
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
										annotations.response('Oops error occured, please check your connection.','glyphicon glyphicon-remove');
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
										annotations.response('Oops error occured, please check your connection.','glyphicon glyphicon-remove');
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
										annotations.response('Changes has been saved.','glyphicon glyphicon-check');
										document.getElementById('preview-annotation').style.display = 'none';
									},
									error: function(){
										console.log('OOps error while updating annotation.');
										$('#loader-wrapper').fadeOut();
										$('#loader-wrapper').remove();
										annotations.response('Oops error occured, please check your connection.','glyphicon glyphicon-remove');
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
				curSec = Math.floor(duration - (curMin * 60));
				if(curHrs < 10)curHrm = "0"+curHrs;
				if(curMin < 10)curMin = "0"+curMin;
				if(curSec < 10)curSec = "0"+curSec;
				return curHrm + ':' + curMin + ':' +curSec;
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
			    cssstyle = 'padding:'+padding+';' + 'color:' + color+';' + 'width:' + Width+';' + 'height:' + height+';' + 'position:' + position+';' +
						    'top:' + top+';' +'left:'+ left + ';' + 'background:' + background + ';'+'z-index:2147483647;' +'display:none;';
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
		annotations.remove(id);
		$('#editor-annotation').fadeOut();
		$('#preview-annotation').fadeOut();
		$('#forever-remove-annot-'+id).remove();
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
	if(annotTypes=='Title'){
		var style = css.Title('preview-annotation');
	}
	annotations.update(id,content,getTime[0],getTime[1],link,style);
	if(content.length >= 15) {content = content.substring(0,15); content = content +'...'; }
	document.getElementById(id).innerHTML = content;
	$('#editor-annotation').fadeOut();
});
var time = function(){
	return{
		validate: function(start_,end_){
				   var totalTimeEndStart = new Array(),
					  getStartTime = start_.split(':'),
					  getEndTime = end_.split(':'),
					  start1 = getStartTime[0] * 3600, start2 = getStartTime[1] * 60,start3 = getStartTime[2] * 1,
					  end1 = getEndTime[0] * 3600,end2 = getEndTime[1] * 60, end3 = getEndTime[2] * 1;
					 if(getStartTime[0]>60 || getStartTime[1]>60 || getStartTime[2]>60 || getEndTime[0]>60 || getEndTime[1]>60 || getEndTime[2]>60) {totalTimeEndStart.push('error'); return totalTimeEndStart;}
					  totalTimeEndStart.push(start1+start2+start3);
					  totalTimeEndStart.push(end1+end2+end3);
					 return totalTimeEndStart;
					}
	}
}();
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