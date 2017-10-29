$(document).ready(function(){

	var pict=$("<img>");
	//var
	pict.attr("src", $("#screen img").first().attr("src") );

	$("#screen").append(pict);
	
	//var winHeight;
	//var height;
	
	var carouselResizer	= function(obj, heightArg, countArg){
		//console.log($("#screen").offset());
		//console.log($(window).height());
		//console.log($("#screen").height());
		
		//var windowHeight = $(window).height();
		
		if(!heightArg)var height = $(window).height() - $("#screen").offset().top - 50;
		else height = heightArg;
		
		var width = $("#screen").width();
		if(!countArg)var count = 0;
		else count = countArg;
		
		console.log(count);
		count++;

		 
		
		
	//	alert($("#screen img").width())

	//alert($("#screen img").first().attr("src"));
		if(height<$(window).height()/3)height=$(window).height();
			
		//console.log('height: ' + height);
		
	//	alert($("#screen img").length);
	
		//console.log
		
		$("#screen img").height(height+'px');
		$("#screen").height(height+'px');
		$("#screen img").width('auto');
		$("#screen img").css({position: 'absolute'});
		$("#screen").css({backgroundColor: "#fff", top: "20px", position: "relative"});
		$("#screen h1").first().css({zIndex: 1001});
		obj.css({zIndex: 1000}).animate({right: (-1*width)+'px', opacity: 0}, 10000, function(){
			obj.css({zIndex: 900, left: '0px', opacity: 1});
			
			//console.log(obj);
			//console.log($("#screen img").last());
			
			if(count < $("#screen img").length){
				obj.css({zIndex: 900, left: '0px', opacity: 1});
				carouselResizer(obj.nextAll("img:first"), height, count);
				
			}
			else carouselResizer($("#screen img").first(), height);
		});
		//$("#screen").height($(document).height()-$("#screen").offset().top); 
	}
	
	
	carouselResizer($("#screen img").first());
	
	$(window).resize(function(){carouselResizer();});
})

