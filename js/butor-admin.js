
	
		$(document).ready( function(){
				
				$("#title").change(function(){
						$("#name").val(function(){
										return toURL($("#title").val());
								});
				})
				
				
				$("#name").change(function(){
						$("#name").val(function(){
										return toURL($("#name").val());
								});
				})
				
				
				
		/*
		 ************ Az adatbázisban tárolt kép kijelölése ******************
		 */
				//console.log($("#img").val());
				
				if($("#img").val()){
					$(".imgBox img").each(function(item){
						console.log($(this).attr('src'));
						console.log($(this).attr('src').indexOf($("#img").val()));
						if($(this).attr('src').indexOf($("#img").val()) >= 0)$(this).parent().css({backgroundColor: "#ccc"});
					})
				}
				
				
				var toURL = function(msg){
						msg = msg.replace(/[óöőòôõ]/gi, "o");
						msg = msg.replace(/[úüűùû]/gi, "u");
						msg = msg.replace(/[íìî]/gi, "i");
						msg = msg.replace(/[á]/gi, "a");
						msg = msg.replace(/[é]/gi, "e");
						msg = msg.replace(/[\s]/gi, "-");
						msg = msg.toLowerCase();
						msg = msg.replace(/[^a-z0-9-_]/gi, "");
						return msg;
				}
				
				
				//$('body').on('click', '.imgBox', function(e){console.log(e.target);});
				
				
				
				//$(".imgBox").click(function(){
				$("body").on('click', '.imgBox', function(){
						//alert($(this).find("img").attr("src").match(/[^\/]*$/i));

					var obj = $(this);
					//		 var img = $(this).find("img").attr("src").match(/[^\/]*$/i);
						
				//		alert(img);
						
						$("#"+inputID).val(function(){
							//	alert(img);
							//	return img;
							return path + obj.find("img").attr("src").match(/[^\/\\]*$/i);
						})
						
						$(".imgBox").css({backgroundColor: "#fff"});
						$(this).css({backgroundColor: "#ccc"});
				})
				
				
				$("body").on('click', "#no-select", function(){
						$(".imgBox").css({backgroundColor: "#fff"});
						$("#"+inputID).val(null);
				})
				
				
				
				$("body").on('click', ".dirBox", function(){
				
					$('#imgContainer').remove();
					//$('.imgBox').remove();
					//$('.dirBox').remove();
					
					//console.log($(this));
					//console.log($(this)[0].innerText);
					//(parsedData[$(this)[0].innerText]);
					
					if(parsedDataCurrent==undefined)parsedDataCurrent = parsedData[$(this)[0].innerText];
					else parsedDataCurrent = parsedDataCurrent[$(this)[0].innerText];
					//console.log(parsedDataCurrent);
					
					
					buildImgContainer(parsedDataCurrent /*[$(this)[0].innerText]*/, $(this)[0].innerText);
				});
				
				
				$("body").on('click', "#back-root", function(){
					$('#imgContainer').remove();
					path = undefined;
					parsedDataCurrent = undefined;
					
					buildImgContainer(parsedData);
				});
				
				
				
				var parsedData;
				var parsedDataCurrent;
				//var upperDir = [];
				var path;
				var inputID;
				
				
				var buildImgContainer = function(parsedDataArg, pathArg){
					
					if($('#imgContainer').length)return;
					
					$('body').append('<div id="imgContainer"></div>');
					$('#imgContainer').append('<div id="no-select">Kiválasztás megszűntetése<br><br><h1 align="center"><strong>X</strong></h1></div>');
					$('#imgContainer').append('<div id="back-root">vissza a főkönyvtárba</div>');
					
					if(path==undefined)path="";
					if(pathArg==undefined)path+='';
					else path+=pathArg;
					
					//console.log(path);
					//console.log(parsedData);
					
					
					
					$.each(parsedDataArg, function(index, item){
						//console.log(item);
						if(Array.isArray(item) || typeof item == 'object'){
							$('#no-select').after('<div class="dirBox"><p>'+index+'</p></div>')
						}
						else {
							$('#imgContainer').append('<div class="imgBox"><img src="https://butorstudiogalgaheviz.hu/content/images/'+path+item+'"><p>'+item+'</p></div>');
						}
					});
				
					
					if($("#"+inputID).val()){
							$(".imgBox img").each(function(item){
							
							if($(this).attr('src').indexOf($("#"+inputID).val()) >= 0)$(this).parent().css({backgroundColor: "#ccc"});
						})
					}
					
					//console.log($('#imgContainer').length);
					
				}
				
				
				
				$.get('https://butorstudiogalgaheviz.hu/kepek', function(data, status){
					
					//console.log(data);
					
					 parsedData = JSON.parse(data);
					//console.log(parsedData['sdfg\\'][0]);
					
					//buildImgContainer(parsedData);
				})
				
				
				$('[name~="small_img"]').focusin(function(){
					
					//console.log($(this).attr('id'));
					inputID = $(this).attr('id');
					buildImgContainer(parsedData);
					//console.log(inputID);
				})
				
				
				$('[name~="img"]').focusin(function(){
					
					//console.log($(this).attr('id'));
					inputID = $(this).attr('id');
					buildImgContainer(parsedData);
					//console.log(inputID);
				})
				
		})
				

