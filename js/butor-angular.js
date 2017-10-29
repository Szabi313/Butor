var butorApp = angular.module('butorModule', ['ui.tinymce'])

.controller('butorController', function($scope, $http){
	//$scope.valami = "valami";
	//console.log($scope.valami);
	
	$scope.config = {
		protocol: "http://",
		//domain: "localhost/butor-php/",
		//domain: "butorstudiogalgaheviz.hu/uj_oldal/",
		domain: "butorstudiogalgaheviz.hu/",
		imageDir: './content/images/'
	}
	
	$scope.tinymceOptions = {
    //plugins: 'link image code',
		mode : "specific_textareas",
		plugins:	["link","autolink","image", "searchreplace", "lists", "advlist", "code"],

 //   toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code'
  };
	
	
	$scope.pathString;
	$scope.newDir;
	
	$scope.valami;
	
	$scope.item = {};
	$scope.items = {}; //{"12-raffaelo6":{"product_order":2,"img":"12-raffaelo6.jpg","name":"12-raffaelo6","subcategoryID":"4","categoryID":"22"},"2-mozaik_350_magas":{"product_order":5,"img":"2-mozaik_350_magas.jpg","name":"2-mozaik_350_magas","subcategoryID":"4","categoryID":"22"}}; //{};
	$scope.namedItems = {};
	
	$scope.order = 10;
	
	$scope.images;
	$scope.currentImages;
	
	$scope.path = [];
	
	$scope.currentItem;
	$scope.currentItemName;
	
	$scope.fieldNames = {
		image: ''
	};
	
	//$scope.selects = {};
	
	$scope.categories = {}; //{"categoryID":"22"}; //{}; 
	
	$scope.showLoading = false;
	
	
	$scope.parseForm = function(){
		angular.forEach(itemform, function(obj, key){
			//console.log(obj.name);
			//console.log(obj);
			
			if(obj.name.indexOf('order') > -1)$scope.fieldNames.order = obj.name;
			if(obj.name.indexOf('img') > -1 && $scope.fieldNames.image == '')$scope.fieldNames.image = obj.name;
			if(obj.name.indexOf('name') > -1)$scope.fieldNames.name = obj.name;
			if(obj.name.indexOf('text') > -1)$scope.fieldNames.text = obj.name;
		});
		
	}
	
	
	$scope.setOrder = function(){
		//$scope.item.order = 10;
		//console.log($scope.item.order);
		console.log($scope.order);
	}
	
	
	$scope.queryImages = function(){
		$scope.showLoading = true;
		$http.get($scope.config.protocol + $scope.config.domain + 'kepek')
		//$http.get('http://butorstudiogalgaheviz.hu/uj_oldal/kepek')
		.then(
			function success(response){
			//console.log(response.data);
				$scope.images = response.data;
				$scope.currentImages = $scope.images;
				$scope.showLoading = false;
			},
			function error(response){
				//alert(response.data);
				console.log(response);
				$scope.showLoading = false;
			}
		)
	}
	
	
	
	
	$scope.isFile = function(file, key){
		if(Array.isArray(file) || typeof file == 'object'){
			return false; //'<p ng-click="changeDir(key)">' + key + '</p>';
			//$scope.images = file;
		}else{
			return true; //file;
		}
	}
	
	
	
	$scope.clickBox = function(file, key){
		if(key === undefined){
			$scope.currentImages = $scope.images;
			$scope.path = [];
			return;
		} 
		
		if(key==-1){
			//$scope.currentImages = $scope.currentImages.parent;
			//console.log($scope.currentImages);
			
			
			var tempImages = $scope.images;
			
			for(var i = 0; i < $scope.path.length-1; i++){
				tempImages = tempImages[$scope.path[i]];
			}
			
			$scope.currentImages = tempImages;
			
			$scope.path.pop();
			$scope.pathString = $scope.path.join('');
			
			return;
		}
		
		if(!$scope.isFile(file)){
			$scope.currentImages = $scope.currentImages[key];
			$scope.path.push(key);
			$scope.pathString = $scope.path.join('');
		}
		//else $scope.inputChange(key);
		//console.log($scope.path);
	}
	
	
	$scope.inputChange = function(key){
		//console.log($scope.items);
		
	//	alert(itemform.product_order.value);
		//alert($scope.items[key].product_order);
		
//		angular.forEach(itemform, function(obj/*, key*/){
//			//console.log(obj.name);
//			//if(obj.name.indexOf('order') > -1)$scope.fieldNames.order = obj.name;
//			//if(obj.name.indexOf('img') > -1)$scope.fieldNames.image = obj.name;
//			if(obj.type != "submit" && obj.name.indexOf('category') < 0)obj.value = '';
//			if(obj.name.indexOf('text') > -1 /*&& !obj[$scope.fieldNames.order]*/)obj.value = tinyMCE.activeEditor.setContent('');
//		});
		
		//console.log($scope.fieldNames);
		
		$scope.currentItem = key;
		$scope.currentItemName = this.img.replace(/.[^.]*$/, '');
		
//		itemform[$scope.fieldNames.order].value = $scope.items[this.img.replace(/.[^.]*$/, '')][$scope.fieldNames.order]; 
		
//		itemform[$scope.fieldNames.image].value = this.img; 
		$scope.items[this.img.replace(/.[^.]*$/, '')][$scope.fieldNames.image] = $scope.path.join('') + this.img; 
		
//		itemform.name.value = this.img.replace(/.[^.]*$/, '');
		if(!$scope.items[this.img.replace(/.[^.]*$/, '')][$scope.fieldNames.name])$scope.items[this.img.replace(/.[^.]*$/, '')][$scope.fieldNames.name] = this.img.replace(/.[^.]*$/, '');//$scope.nameFromImg(this.img); //this.img.replace(/.[^.]*$/, '');
		
		//$scope.namedItems[$scope.nameFromImg(this.img)] = $scope.items[key];
		//angular.copy($scope.items[key], $scope.namedItems[$scope.nameFromImg(this.img)]);
		//console.log($scope.namedItems);
		angular.forEach($scope.items, function(bigElem, bigKey){
			angular.forEach($scope.categories, function(elem, key){
				//console.log(elem + ", " + key);
				//$scope.items[$scope.currentItemName][key] = elem;
				/*if(elem)*/bigElem[key] = elem;
				//else delete bigElem[key];
			})
		})
	}
	
	
	$scope.changeCategory = function(table){
		angular.forEach($scope.items, function(bigElem, bigKey){
			angular.forEach($scope.categories, function(elem, key){
				//console.log(elem + ", " + key);
				//$scope.items[$scope.currentItemName][key] = elem;
				/*if(elem)*/bigElem[key] = elem;
				//else delete bigElem[key];
			})
		})
		
		$scope.queryProducts(table);
	}
	
	
	$scope.nameFromImg = function(imgName){
		return String(imgName).replace(/.[^.]*$/, '');
	}
	
	
	$scope.insertItem = function(){
		angular.forEach(itemform, function(obj, key){
			//console.log(obj.value);
			//console.log($scope.currentItemName);
			//console.log($scope.items[$scope.currentItemName]);
			if($scope.currentItemName !== undefined && obj.name !== '' && obj.name !== undefined && obj.name !== '' && obj.name !== null){
				if(obj.name.indexOf('text') <  0)$scope.items[$scope.currentItemName][obj.name] = obj.value;
				else $scope.items[$scope.currentItemName][obj.name] = tinyMCE.activeEditor.getContent();
				//console.log("valami");
			}
		})
		//$scope.items[$scope.currentItemName]['valaami'] = "valmai";
		console.log($scope.items);
	}
	
	
	$scope.imgWithPath = function(img){
		return $scope.path.join('') + img;
	}
	
	
/*	$scope.editText = function(){
		$scope.items[$scope.currentItemName]['text'] = tinyMCE.activeEditor.getContent();
	}*/
	
	/*$scope.setDefaultSelects = function(select){
			$scope.selects[select] = select;
	}*/
	
	
	$scope.save = function(table){
		
		$scope.showLoading = true;
		
		angular.forEach($scope.items, function(itemObj, itemKey){
			
			angular.forEach(itemform, function(formObj, formKey){
			
				if(itemObj[formObj.name] == undefined && formObj.name !== '' && formObj.name.indexOf('category') < 0)itemObj[formObj.name] = ''; //console.log(formObj.name);
			
			})
			
			if(itemObj.name !== undefined)itemObj.name = $scope.toURL(itemObj.name);
			
		})
		
		$http.post($scope.config.protocol + $scope.config.domain + "kepek-mentes/" + table, $scope.items)
		.then(function success(response){
				console.log(response.data);
				$scope.showLoading = false;
			},
			function error(response){
				alert(response.data);
				console.log(response);
				$scope.showLoading = false;
			}
		)
	}
	
	
	
	$scope.queryProducts = function(table){
		$http.post($scope.config.protocol + $scope.config.domain + 'termekek-lekerdezese/' + table, $scope.items)
		.then(function success(response){
				console.log(response.data);
			},
			function error(response){
				
			})
	}

	
	//$scope.queryProducts
	
	
	$scope.newCategoryUpload = function(){
		$scope.items = {};
		$scope.categories = {};
	}
	
	
	$scope.toURL = function(msg){
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
	
	
	$scope.getPath = function(e){
		console.log("prevent");
		e.preventDefault();
		$scope.pathString = $scope.path.join();
	}
	
	$scope.makeDir = function(){
		$scope.showLoading = true;
		$scope.data = $.param({
			newDir: $scope.config.imageDir + $scope.path.join('') + $scope.newDir
		});
		
		var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
					}
		$http.post($scope.config.protocol + $scope.config.domain + 'kvt', $scope.data, config)
		.then(function success(response){
			//alert( $scope.newDir);
			
			$scope.newDir += "/";
			
			if(Array.isArray($scope.currentImages)){
				var tempCurrentImages = {};
				angular.forEach($scope.currentImages, function(obj, index){
					tempCurrentImages[index] = obj;
				});
				tempCurrentImages[$scope.newDir] = {};
				$scope.currentImages = tempCurrentImages;
			}
			else $scope.currentImages[$scope.newDir] = {}; 
			
			
/*		$scope.queryImages(); 
		//$scope.path = [];
		var oldPath = [];
		oldPath = angular.copy( $scope.path);
		$scope.path = [];
		
		var tempImages = $scope.images;
			
			for(var i = 0; i < oldPath.length; i++){
				tempImages = tempImages[oldPath[i]];
			}
			
			$scope.currentImages = tempImages;
			
			
			$scope.newDir = "";*/
			$scope.showLoading = false;
		});
	}

	/*angular.element(document).find("#title").change(function(){
		alert(this);
	});*/
	
	$scope.parseForm();
	
	$scope.queryImages();
})