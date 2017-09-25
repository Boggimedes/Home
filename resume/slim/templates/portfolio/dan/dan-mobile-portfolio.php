<?php include_once(__DIR__.'/head.php') ?>
	</head>
<body>
	<ul class="nav nav-pills navbar-inverse navbar-fixed-bottom" id="mobileTabs" role="tablist">
	  <li role="presentation" class="active"><a data-toggle="tab" href="#home" aria-controls="home" role="tab">Home</a></li>
	  <li role="presentation"><a data-toggle="tab" href="#resume" aria-controls="resume" role="tab">Resume</a></li>
	  <li role="presentation"><a data-toggle="tab" href="#projects">Projects</a></li>
	  <li role="presentation"><a data-toggle="tab" href="#hobbies">Hobbies</a></li>
	  <li role="presentation"><a data-toggle="tab" href="#family">Family</a></li>
	  <li role="presentation"><a data-toggle="tab" href="#closing">Closing</a></li>
	</ul>

	<div class="tab-content" style="height:100%;">
		<div role="tabpanel" class="tab tab-pane active" id="home">
			<img class="img-responsive" src="/portfolio/daniel/img/word-cloud.jpg" ?>
		</div>
		<div role="tabpanel" class="tab tab-pane" id="resume">
			<div id="resume1">
				<?php include_once(__DIR__.'/page1.html') ?>
			</div>
			<div id="resume2">
				<?php include_once(__DIR__.'/page2.html') ?>
			</div>
		</div>
		<div role="tabpanel" class="tab tab-pane" id="projects">
			<div class="panel-group" role="tablist" id="pgroup">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="collapseListGroupHeading1">
						<h4 class="panel-title">
							<a href="#cList" class="collapsed" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="cList"> Project List</a>
						</h4>
					</div>
					<div class="panel-collapse collapse" role="tabpanel" id="cList" aria-labelledby="collapseListGroupHeading1" aria-expanded="false" style="height: 0px;">
						<ul class="list-group">
							<li class="list-group-item" data-toggle="collapse" data-parent="#pgroup" data-target="#feature1"  onclick="selectFeature(1);">Overview</li>
							<li class="list-group-item" data-toggle="collapse" data-parent="#pgroup" data-target="#feature2" onclick="selectFeature(2);">Tabletop Gaming SaaS</li>
							<li class="list-group-item" data-toggle="collapse" data-parent="#pgroup" data-target="#feature3" onclick="selectFeature(3);">Anbient Noise Player</li>
							<li class="list-group-item" data-toggle="collapse" data-parent="#pgroup" data-target="#feature4" onclick="selectFeature(4);">World Simulator</li>
							<li class="list-group-item" data-toggle="collapse" data-parent="#pgroup" data-target="#feature5" onclick="selectFeature(5);">Map Navigator</li>
							<li class="list-group-item" data-toggle="collapse" data-parent="#pgroup" data-target="#feature6" onclick="selectFeature(6);">Image Resizer</li>
							<li class="list-group-item" data-toggle="collapse" data-parent="#pgroup" data-target="#feature7" onclick="selectFeature(7);">InFocus internal</li>
							<li class="list-group-item" data-toggle="collapse" data-parent="#pgroup" data-target="#feature8" onclick="selectFeature(8);">InFocus Pricing</li>
							<li class="list-group-item" data-toggle="collapse" data-parent="#pgroup" data-target="#feature9" onclick="selectFeature(9);">InFocus.com US and Global Sites</li>
							<li class="list-group-item" data-toggle="collapse" data-parent="#pgroup" data-target="#feature10" onclick="selectFeature(10);">Future Project Ideas</li>
						</ul>
					</div>
				</div>
			</div>
			<?php include_once(__DIR__.'/page4.html') ?>
		</div>
		<div role="tabpanel" class="tab tab-pane" id="hobbies">
			<?php include_once(__DIR__.'/page5.html') ?>
		</div>
		<div role="tabpanel" class="tab tab-pane" id="family">
			<?php include_once(__DIR__.'/page6.html') ?>
		</div>
		<div role="tabpanel" class="tab tab-pane" id="closing">
			<?php include_once(__DIR__.'/coverPg2.html') ?>
		</div>
		</div>
	</div>

	<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				</div>
				<div class="modal-body">
					<img src="" id="imagepreview" class="img-responsive" style="margin:auto;" >
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

<style>
.nav > li > a {
    padding: 10px 8px;
}
.features.off {
	display: none;
	opacity: 0;
}
.page-container {
	width: 98%;
    padding: 2%;
}
.resume .list-bullets {
	margin-left: 0px;
    padding-left: 5px;
}

.resume .col-xs-7 {
	padding:0px;
}
</style>
<script>
    loadCode();
    loadModal();
</script>