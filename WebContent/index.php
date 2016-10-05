<!DOCTYPE html>
<html ng-app="ewPaint">
<head>
	<meta charset="utf-8">
	<title>Canvas Paint</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<link rel="stylesheet" href="/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="/css/style.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
	<script src="/js/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="/js/fabric.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>

	<script src="/js/utils.js"></script>
	<script src="/js/config.js"></script>
	<script src="/js/controller.js"></script>
</head>
<body>
	<!-- navbar start -->
	<div class="navbar navbar-default navbar-fixed-top">

		<!-- navbar container start -->
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="/" class="navbar-brand">HTML5 Canvas Paint v.1 Beta</a>
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="navbar-collapse collapse" id="navbar-main">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="file">File <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="file">
							<li><a href="#">Save As</a></li>
							<li class="divider"></li>
							<li><a href="#">Load From JSON</a></li>
							<li><a href="#">Load From SVG</a></li>
							<li class="divider"></li>
							<li><a href="#">Export to JSON</a></li>
							<li><a href="#">Export to JPG</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="edit">Edit <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="edit">
							<li><a href="#">Remove Selected</a></li>
							<li class="divider"></li>
							<li><a href="#">Send To Back</a></li>
							<li><a href="#">Send Backwards</a></li>
							<li><a href="#">Bring Forwards</a></li>
							<li><a href="#">Bring To Front</a></li>
						</ul>
					</li>
					<li>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="help">Help <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="help">
							<li><a href="#">User Guide</a></li>
						</ul>
					</li>
					<li>
						<a href="http://guhya.net" target="_blank">About</a>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="http://fabricjs.com/" target="_blank">FabricJs Kitchensink</a></li>
					<!--
					<li><a href="https://angularjs.org/" target="_blank">AngularJs</a></li>
					-->
				</ul>
			</div>
		</div>
		<!-- navbar container end -->

	</div>
	<!-- navbar end -->

	<!-- main container start -->
	<div class="container-fluid wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<!--<h3 id="navbar">TheCanvas</h3>-->
				</div>
			</div>
		</div>
		
		<!-- working area start -->
		<div class="row working-area" ng-controller="EwideController">

			<!-- left toolbar start -->
			<div class="col-lg-2 col-md-2 col-xs-12 toolbar left-toolbar">

				<div class="left-button">
					<button data-target="#tools-text" type="button" class="btn btn-default btn-lg btn-primary" id="add-text" ng-click="addText()" onclick="">
						<i class="fa fa-font fa-fw"></i> <span><span>Add </span>Text</span>
					</button>
					
					<div class="btn-shape btn-group">
						<button type="button" class="btn btn-default btn-lg btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="shape">
							<i class="fa fa-pie-chart fa-fw"></i> <span><span>Add </span>Shape</span> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="#" ng-click="addLine()"><i class="fa fa-minus fa-fw"></i> Line</a></li>
							<li><a href="#" ng-click="addRect()"><i class="fa fa-stop fa-fw"></i> Rectangle</a></li>
							<li><a href="#" ng-click="addCircle()"><i class="fa fa-circle fa-fw"></i> Circle</a></li>
							<li><a href="#" ng-click="addTriangle()"><i class="fa fa-play fa-fw"></i> Triangle</a></li>
						</ul>
					</div>
					
					<div data-target="#tools-images" class="btn btn-default btn-lg btn-primary" id="add-image">
						<div class="qq-uploader">
							<div class="qq-upload-drop-area" style="display: none;">
								<i class="fa fa-picture-o fa-fw"></i> <span><span>Upload </span>Image</span>
							</div>
							<div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
								<i class="fa fa-picture-o fa-fw"></i> <span><span>Upload </span>Image</span>
								<input type="file" name="file" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;">
							</div>
							<ul class="qq-upload-list" style="display:none;"></ul>
						</div>
					</div>

					<div class="btn-graphic btn-group">
						<button type="button" class="btn btn-default btn-lg btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="svg">
							<i class="fa fa-folder-open fa-fw"></i> <span><span>Design </span>Library</span> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="svg">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
						</ul>
					</div>
				</div>

				<div class="left-graphic">
					<ul class="list-graphic">
						<li><a href="javascript:void(0);" ng-click="addShape('/img/graphic/0001.svg')"><img src="/img/graphic/0001.png"></a></li>
						<li><a href="javascript:void(0);" ng-click="addShape('/img/graphic/0002.svg')"><img src="/img/graphic/0002.png"></a></li>
						<li><a href="javascript:void(0);" ng-click="addShape('/img/graphic/0003.svg')"><img src="/img/graphic/0003.png"></a></li>
						<li><a href="javascript:void(0);" ng-click="addShape('/img/graphic/0004.svg')"><img src="/img/graphic/0004.png"></a></li>
						<li><a href="javascript:void(0);" ng-click="addImage('/img/android2.jpg', 1, 1)"><img src="/img/android2.jpg"></a></li>
					</ul>
				</div>

				<div id="drawing-mode-wrapper">
					<button id="drawing-mode" class="btn btn-default btn-lg btn-primary" 
						ng-click="setFreeDrawingMode(!getFreeDrawingMode())" 
						ng-class="{'btn-info': getFreeDrawingMode(), 'btn-primary': !getFreeDrawingMode()}">
						 {[ getFreeDrawingMode() ? 'Exit free drawing mode' : 'Enter free drawing mode' ]}
					</button>

					<div id="drawing-mode-options" ng-show="getFreeDrawingMode()" class="ng-hide">
						<div class="form-horizontal">
							<fieldset>
								<div class="form-group">
									<label for="drawing-mode-selector" class="col-sm-4 control-label">Free Draw:</label>
									<div class="col-lg-8">
										<select id="drawing-mode-selector" class="btn-object-action form-control" bind-value-to="drawingMode">
											<option value="Pencil">Pencil</option>
											<option value="Circle">Circle</option>
											<option value="Spray">Spray</option>
											<!--
											<option value="Pattern">Pattern</option>
											-->
											<option value="hline">hline</option>
											<option value="vline">vline</option>
											<option value="square">square</option>
											<option value="diamond">diamond</option>
											<!--
											<option value="texture">texture</option>
											-->
											
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="drawing-line-width" class="col-sm-2 control-label">Line width:</label>
									<div class="col-lg-10" style="padding-top:9px;">
										<input type="range" value="30" min="0" max="150" bind-value-to="drawingLineWidth">
									</div>
								</div>

								<div class="form-group">
									<label for="drawing-color" class="col-sm-2 control-label">Line color:</label>
									<div class="col-lg-10" style="padding-top:9px;">
										<input type="color" value="#005E7A" style="width:40px" bind-value-to="drawingLineColor">
									</div>
								</div>

								<div class="form-group">
									<label for="drawing-shadow-width" class="col-sm-2 control-label">Line shadow width:</label>
									<div class="col-lg-10" style="padding-top:9px;">
										<input type="range" value="0" min="0" max="50" bind-value-to="drawingLineShadowWidth">
									</div>
								</div>
							</fieldset>
						</div>
					</div>
				</div>
			</div>
			<!-- left toolbar end -->

			<!-- canvas area start -->
			<div class="col-lg-8 col-md-8 col-xs-12 canvas">
				<div class="row">
					<div class="col-lg-8">
						<div class="btn-group object-controls">
							<button id="remove-selected" class="btn btn-object-action btn-danger" ng-click="removeSelected()">
								<i class="fa fa-trash"></i> &nbsp;Remove
							</button>
							<button id="send-to-back" class="btn btn-object-action btn-default" ng-click="sendToBack()">
								<i class="fa fa-angle-double-down"></i> &nbsp;Send To Back
							</button>			
							<button id="send-backwards" class="btn btn-object-action btn-default" ng-click="sendBackwards()">
								<i class="fa fa-angle-down"></i> &nbsp;Send Backwards
							</button>
							<button id="bring-forward" class="btn btn-object-action btn-default" ng-click="bringForward()">
								<i class="fa fa-angle-up"></i> &nbsp;Bring Forwards
							</button>
							<button id="bring-to-front" class="btn btn-object-action btn-default" ng-click="bringToFront()">
								<i class="fa fa-angle-double-up"></i> &nbsp;Bring To Front
							</button>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="btn-group object-controls">
							<button id="remove-selected" class="btn btn-object-action btn-success pull-right no-margin-right" data-toggle="modal" data-target="#myModal" ng-click="rasterize()">
								<i class="fa fa-image"></i> &nbsp;Export to PNG
							</button>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="ew-canvas-container">
							<canvas id="c1"></canvas>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<h2>User Library</h2>
					</div>
				</div>
			</div>
			<!-- canvas area end -->

			<!-- right toolbar start -->
			<div class="col-lg-2 col-md-2 col-xs-12 toolbar right-toolbar">
				<h2>Properties</h2>
				<div id="color-opacity-controls" class="form-horizontal">
					<div class="form-group">
						<label for="color" class="col-lg-2 col-sm-2 control-label">Canvas: </label>
						<div class="col-lg-10" style="padding-top:9px;">
							<input type="color" class="" value="#d9534f" style="width:40px" bind-value-to="canvasBgColor">
						</div>
					</div>
				</div>

				<div id="color-opacity-controls" ng-show="canvas.getActiveObject()" class="form-horizontal">
					<fieldset>
						<div class="form-group">
							<label for="opacity" class="col-sm-2 control-label">Opacity: </label>
							<div class="col-lg-10" style="padding-top:9px;">
								<input value="100" type="range" bind-value-to="opacity">
							</div>
						</div>

						<div class="form-group">
							<label for="color" class="col-sm-2 control-label">Color: </label>
							<div class="col-lg-10" style="padding-top:9px;">
								<input type="color" class="" value="#d9534f" style="width:40px" bind-value-to="fill">
							</div>
						</div>
					</fieldset>
				</div>

				<div id="text-wrapper" style="margin-top: 10px" ng-show="getText()" class="form-horizontal">
					<fieldset>
						<div class="form-group">
							<label for="text-bg-color" class="col-sm-12 control-label" style="text-align:left; margin-bottom:5px;">Text :</label>
							<div class="col-lg-12">
								<textarea bind-value-to="text"  class="form-control"></textarea>
							</div>
						</div>


						<div id="text-controls-additional">
							<div class="btn-grooup pull-right">
								<button type="button" class="btn btn-object-action" id="text-cmd-bold" ng-click="toggleBold()" ng-class="{'btn-info': !isBold(), 'btn-primary': isBold()}">
									<i class="fa fa-bold"></i>
								</button>
								<button type="button" class="btn btn-info btn-object-action" id="text-cmd-italic" ng-click="toggleItalic()" ng-class="{'btn-info': !isItalic(), 'btn-primary': isItalic()}">
									<i class="fa fa-italic"></i>
								</button>
								<button type="button" class="btn btn-info btn-object-action" id="text-cmd-underline" ng-click="toggleUnderline()" ng-class="{'btn-info': !isUnderline(), 'btn-primary': isUnderline()}">
									<i class="fa fa-underline"></i>
								</button>
								<button type="button" class="btn btn-info btn-object-action" id="text-cmd-linethrough" ng-click="toggleLinethrough()" ng-class="{'btn-info': !isLinethrough(), 'btn-primary': isLinethrough()}">
									<i class="fa fa-strikethrough"></i>
								</button>
							</div>
						</div>
						<br/>
						
						<div id="text-controls">
							<div class="form-group">
								<label for="font-family" class="col-sm-4 control-label">Font family:</label>
								<div class="col-lg-8">
									<select id="font-family" class="btn-object-action form-control" bind-value-to="fontFamily">
										<option value="arial">Arial</option>
										<option value="helvetica" selected="">Helvetica</option>
										<option value="myriad pro">Myriad Pro</option>
										<option value="delicious">Delicious</option>
										<option value="verdana">Verdana</option>
										<option value="georgia">Georgia</option>
										<option value="courier">Courier</option>
										<option value="comic sans ms">Comic Sans MS</option>
										<option value="impact">Impact</option>
										<option value="monaco">Monaco</option>
										<option value="optima">Optima</option>
										<option value="hoefler text">Hoefler Text</option>
										<option value="plaster">Plaster</option>
										<option value="engagement">Engagement</option>
									</select>
								</div>
							</div>						

							<div class="form-group">
								<label for="text-align" class="col-sm-4 control-label">Text align:</label>
								<div class="col-lg-8">
									<select id="text-align" class="btn-object-action form-control" bind-value-to="textAlign">
										<option value="Left">Left</option>
										<option value="Center">Center</option>
										<option value="Right">Right</option>
										<option value="Justify">Justify</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="text-bg-color" class="col-sm-8 control-label">Background color:</label>
								<div class="col-lg-4" style="padding-top:9px;">
									<input type="color" value="#df691a" id="text-bg-color" style="width:40px" size="10" class="btn-object-action" bind-value-to="bgColor">
								</div>
							</div>
							<div class="form-group">
								<label for="text-lines-bg-color" class="col-sm-8 control-label">Background text color:</label>
								<div class="col-lg-4" style="padding-top:9px;">
									<input type="color" value="#5bc0de" id="text-lines-bg-color" style="width:40px" size="10" class="btn-object-action" bind-value-to="textBgColor">
								</div>
							</div>
							<div class="form-group">
								<label for="text-stroke-color" class="col-sm-8 control-label">Stroke color:</label>
								<div class="col-lg-4" style="padding-top:9px;">
									<input type="color" value="#333333" id="text-stroke-color" style="width:40px" size="10" class="btn-object-action" bind-value-to="strokeColor">
								</div>
							</div>
							<div class="form-group">
								<label for="text-stroke-width" class="col-sm-2 control-label">Stroke width:</label>
								<div class="col-lg-10" style="padding-top:9px;">
									<input type="range" value="1" min="1" max="5" id="text-stroke-width" class="btn-object-action" bind-value-to="strokeWidth">
								</div>
							</div>
							<div class="form-group">
								<label for="text-font-size" class="col-sm-2 control-label">Font size:</label>
								<div class="col-lg-10" style="padding-top:9px;">
									<input type="range" value="" min="1" max="120" step="1" id="text-font-size" class="btn-object-action" bind-value-to="fontSize">
								</div>
							</div>
							<div class="form-group">
								<label for="text-line-height" class="col-sm-2 control-label">Line height:</label>
								<div class="col-lg-10" style="padding-top:9px;">
									<input type="range" value="" min="0" max="10" step="0.1" id="text-line-height" class="btn-object-action" bind-value-to="lineHeight">
								</div>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
			<!-- right toolbar end-->

		</div>
		<!-- working area end -->
		
		<!-- modal start -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Guhya</h4>
					</div>
					<div class="modal-body" style="text-align:center;">
						<img id="exportedImage" src=""/>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>
		<!--- modal end -->

		<!-- footer start -->
		<footer>
			<div class="row">
				<div class="col-lg-12">
					<ul class="list-unstyled">
						<li><a href="" onclick="">Guhya</a></li>
						<li><a href="">GitHub</a></li>
						<li><a href="">Facebook</a></li>
						<li><a href="">LinkedIn</a></li>
						<li><a href="">Contact</a></li>
					</ul>

					<p>Made by <a href="http://guhya.net" rel="nofollow">Guhya</a>. Contact at <a href="guhyawijaya@gmail.com">guhyawijaya@gmail.com</a>.</p>
					<p>Code released under the <a href="https://github.com/">MIT License</a>.</p>
					<p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>
				</div>
			</div>
		</footer>
		<!-- footer end -->

	</div>
	<!-- main container end -->
<script>
	var canvas = new fabric.Canvas('c1');
    canvas.setHeight(450);
    canvas.setWidth(450);
    //canvas.setWidth($(".canvas").width());
	canvas.setBackgroundColor("#fff");
	canvas.setBackgroundImage('/img/s4.png', canvas.renderAll.bind(canvas));
	canvas.setOverlayImage('/img/overlay-s4.png', canvas.renderAll.bind(canvas));
	canvas.renderAll();
	var objId = 0;

</script>

</body>
</html>
