$(document).ready(function(){
	
	//console.log("valami");


	
/*
 **************** TERMÉKEK ***********************************************
 */ 
	
	var jsonData;
	
	$.get('http://butorstudiogalgaheviz.hu/tartalom', function(data, status){
		//console.log(data);
		
		if(status=="success")jsonData = JSON.parse(data);
		else console.log(status);
		
		/*$.each(jsonData, function(key, value){
			console.log(key + ": ");
			console.log();
			console.log(value);
			console.log();
			console.log();
			console.log();
		})*/
	})
	
	
	var  prevNext = function(obj/*, isNext*/){
		var matches = /\/([^\/]*)$/g.exec(obj.attr('href'));
		
		
		if(obj[0].className=='next_button'){
			
			if($(".prev_button").length)$(".prev_button").show();
			else $(".next_button").before('<a class="prev_button"><button class="btn btn-default"><span class="glyphicon glyphicon-step-backward"></span></button></a> ');
		}
		else{
			if($(".next_button").length)$(".next_button").show();
			else $(".prev_button").after(' <a class="next_button"><button class="btn btn-default"><span class="glyphicon glyphicon-step-forward"></span></button></a> ');
		}
		
		
		$.each(jsonData, function(key, value){
			if(value.id==matches[1]){
				
				if(value.PrImg)$('#productIMG').attr('src', 'http://butorstudiogalgaheviz.hu/content/images/' + value.PrImg); //console.log(value.PrImg);
				else $('#productIMG').attr('src', 'http://butorstudiogalgaheviz.hu/content/images/' + value.smallPrImg.replace('sm', 'lg')); //console.log(value.smallPrImg.replace('sm', 'lg'));
				
				if(value.title)$("#productTitle").text(value.title);
				else $("#productTitle").text("");
				
				$("#PrText+p").remove();
				$("#PrText").html(value.PrText);
				
			//	if(jsonData[key].isPV)alert("p v");
				
				var currentHref = location.href.replace(/[^\/]*\/[^\/]*$/, '') + jsonData[key].name + '/' + jsonData[key].id;
				
				$("#version-thumbs").html("");		
				
				if(jsonData[key].isPV){
					currentHref = currentHref.replace('\/termek\/', '\/termek-valtozatok\/');
					console.log('bent');
					
					
					$.get(currentHref + '/1/1', function(data, status){
						console.log(data);
						
						//if(status=="success"){
							var versionsJSON = JSON.parse(data);
							console.log(versionsJSON);
							
							if(!$("#version-thumbs").length)$("#productIMG-holder").after('<div class="row" id="version-thumbs"></div>');
							
							var segments = location.pathname.split('/');
							console.log(segments);
							
							$.each(versionsJSON, function(key2, value2){
								//console.log(value);
								
								var thumb = '<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4"><div class="thumbnail product-versions">';
								thumb += '<a class="thumb-href" href="http://butorstudiogalgaheviz.hu/' + segments[1] + '/'  + segments[2] + '/'  + segments[3] + '/' + value2.Pname + '/' + value2.Pid + '/' + (key2+1) + '">';
								thumb += '<img src="http://butorstudiogalgaheviz.hu/content/images/' + value2.img + '"></a>';
								if(value2.subcategoryTitle)thumb += '<p class="text-center"><a href="http://butorstudiogalgaheviz.hu/' + segments[1] + '/'  + segments[2] + '/'  + segments[3] + '/' + value2.Pname + '/' + value2.Pid + '/' + (key2+1) + '">' + value2.subcategoryTitle + '</a></p>';
								thumb += '</div></div>';
								
								$("#version-thumbs").append(thumb);
							})
						//}
						//else console.log(status);
					})
					
				}
				else currentHref = currentHref.replace( '\/termek-valtozatok\/', "\/termek\/");
				
				history.pushState({}, 'Valami', currentHref);

				var prevKey = parseInt(key);
				var nextKey = parseInt(key);
				
				
				prevKey--;
				nextKey++;
				
				
				
				
				if(jsonData[prevKey]){
					var prevHref = location.href.replace(/[^\/]*\/[^\/]*$/, '') + jsonData[prevKey].name + '/' + jsonData[prevKey].id;
					
					if(jsonData[prevKey].isPV)prevHref = prevHref.replace('\/termek\/', '\/termek-valtozatok\/');
					else prevHref = prevHref.replace( '\/termek-valtozatok\/', "\/termek\/");
					
					$(".prev_button").attr('href', prevHref);
				}
				else{
					$(".prev_button").hide();
				}
				
				
				if(jsonData[nextKey]){
					var nextHref = location.href.replace(/[^\/]*\/[^\/]*$/, '') + jsonData[nextKey].name + '/' + jsonData[nextKey].id;
					
					if(jsonData[nextKey].isPV)nextHref = nextHref.replace('\/termek\/', '\/termek-valtozatok\/');
					else nextHref = nextHref.replace( '\/termek-valtozatok\/', "\/termek\/");
					
					$(".next_button").attr('href', nextHref);
				}
				else{
					$(".next_button").hide();
				}
			}
		})
	}
	
	
	
	$("body").on("click", ".prev_button", function(e){
		e.preventDefault();
		
		$("#loading").css({'display':'block'});
		
		prevNext($(this));
	})
	
	
	
	
	$("body").on("click", ".next_button", function(e){
		e.preventDefault();
		
		$("#loading").css({'display':'block'});
		
		prevNext($(this));
	})
	
	
	$("body").on("click", '.thumb-href', function(e){
		e.preventDefault();
		console.log("prevent");
		$("#loading").css({'display':'block'});
		
		console.log($(this).find("img").attr('src'));
		
		var src = $(this).find("img").attr('src').replace('sm', 'lg');
		src = src.replace('md', 'lg');
		
		$('#productIMG').attr('src', src);
	})
	
	
	$("body").on("click", '.thumb-text-href', function(e){
		e.preventDefault();
		//console.log("prevent");
		$("#loading").css({'display':'block'});
		
		//console.log($(this).find("img").attr('src'));
		
		var src = $(this).parent().prev().find("img").attr('src').replace('sm', 'lg');
		src = src.replace('md', 'lg');
		
		$('#productIMG').attr('src', src);
	})
	
	
	$('#productIMG').load(function(){$("#loading").css({'display':'none'});});
	
	
/*
 **************** TERMÉKEK VÉGE ***********************************************
 */ 
 
 
 
 
/*
 **************** BOX MAGASSÁG ***********************************************
 */ 
 
	var highest = 0;
	
	$.each($(".thumbnail"), function(key, value){
		//console.log($(value).height());
		if($(value).height() > highest)highest = $(value).height();
	});
	
	console.log(highest);
	$(".thumbnail").height(highest);
/*
 **************** BOX MAGASSÁG VÉGE ***********************************************
 */ 	
 
 
 /*
 **************** FELIRATKOZÁS ***********************************************
 */
 
	$(".submit-button").click(function(e){
		
		console.log($(this).parent());
		
		if(!$("#subscribe-name").val() || !$("#subscribe-email").val())alert("A név és az e-mail mező kitöltése kötelező")
		else{
			
			//if($("#subscribe-email").val().indexOf('@') < 0 || $("#subscribe-email").val().indexOf('.') < 0)alert("Nem megfelelő az e-mail cím");
		//	if(!/[\w\.]+@[\w]+\.[\w]+/.test($("#subscribe-email").val()))alert("Nem megfelelő az e-mail cím");
			if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test($("#subscribe-email").val()))alert("Nem megfelelő az e-mail cím");

			else{
				$("#loading2").css({'display':'block'});
				$.post('http://butorstudiogalgaheviz.hu/lista/uj/butor_mail', 
					{name: $("#subscribe-name").val(),
					email: $("#subscribe-email").val()},
					function(data, status){
						if(status=="success"){
							console.log(status);
							$("#subscribe-name").val('');
							$("#subscribe-email").val('');
							$("#loading2").css({'display':'none'});
							alert("Adatok sikeresen elmentve");
						}
						else alert("Probléma adódott az adatok mentésekor");
					}
				)
			}
		}
	});
	
	
 /*
 **************** FELIRATKOZÁS VÉGE ***********************************************
 */	


/*
 * CAROUSEL CAPTION *****************
 *
 * Kis eszköznél feljebb toljuk a carousel captiont
 */

var setCaouselCap = function(){
		if($(window).width()<368)$('.carousel-caption').css({'top': '85%'});
		else $('.carousel-caption').css({'top': '97%'});
	}
	
setCaouselCap();

$(window).resize(function(){
	setCaouselCap();
})
	

/*
 * CAROUSEL CAPTION  VEGE *****************
 */


})