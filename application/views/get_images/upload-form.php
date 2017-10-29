<html>
<head>
<title>Upload Form</title>

<script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-tinymce/0.0.18/tinymce.min.js"></script>

<script src="<?php echo base_url();?>js/butor-angular.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ul.css"></link>
</head>
<body>

<?php echo $error;?>

<div class="ul-content" ng-app="butorModule" ng-controller="butorController">

<?php echo form_open_multipart('upload/do_upload', array('name'=>'itemform'));?>

<input type="file" name="userfile" size="20" multiple=""/>
<input type="hidden" ng-value="pathString" name="path">

<br /><br />

<input type="submit" value="upload" id="submitButton" />

</form>

{{data}}
{{pathString}}

<div class="imgBox" ng-click="clickBox(undefined)" ng-show="path[0]"><p>vissza a fő könyvtárba</p></div>
<div class="imgBox" ng-click="clickBox(undefined,-1)" ng-show="path[0]"><p>vissza egyet</p></div>
<div class="imgBox" ng-click="" ><p>Új könyvtár</p><input name="newDir" id="newDir" ng-model="newDir"><button id="newDirButton" ng-click="makeDir()">létrehoz</button></div>
<div class="imgBox" ng-repeat="(key, img) in currentImages" ng-click="clickBox(img, key)"><input type="number" ng-show="isFile(img, key)" ng-model="items[nameFromImg(img)][fieldNames.order]" ng-change="inputChange(key)" ng-click="inputChange(key)"><br><br><img ng-show="isFile(img, key)" src="<?php echo base_url().'content/images/'; ?>{{imgWithPath(img)}}"><p ng-show="isFile(img, key)">{{img}}</p><p ng-show="!isFile(img, key)">{{key}}</p></div>

<div id="loading" ng-show="showLoading"></div>

</div>

</body>
</html>
