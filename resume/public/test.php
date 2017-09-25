<?php include_once("header.php") ?>
	<script type="text/javascript" src="js/pageflip5-min.js"></script>
	<script type="text/javascript" src="js/key.js"></script>
	<link type="text/css" rel="stylesheet" href="css/pageflip.css">	
</head>
<body>
	<div id="pageflip">
		<div class="outerpage"><?= file_get_contents(__DIR__.'/../template/portfolio/dan/outerPg1.html') ?></div>

			<div class="cover">
			<div class="" style="margin:auto;width:65%">
				<svg id="word-cloud" class="word-cloud" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 462 693">
					<rect width="462" height="693" style="fill:rgb(248,248,252);"></rect>
				</svg>
			</div>
				</div>

			<div class="page" data-html-file="template/page1.html">
			</div>

			<div class="page" data-html-file="template/page2.html">
			</div>

			<div class="page" data-html-file="template/page3.html">
			</div>

			<div class="page" data-html-file="template/page4.html">
			</div>

			<div class="page" data-html-file="template/page5.html">
			</div>

			<div class="page" data-html-file="template/page6.html">
			</div>

			<div class="cover" data-html-file="template/coverPg2.html">
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
	</body>
<script type="text/javascript">
	var $pageflip = $('#pageflip');
		var wordCloud = [];

	var pageflip = $pageflip.pageflip();
	var CustomPFEventHandler = {
		onLoad: function( PN ) {
			if (PN===1) {
				$.get( "common/wordcloud.json", function( data ) {
					var i = 0;
					var iLen = data.length;
					for (i; i < iLen; i++) {
					var txt = document.createElement("text");
						txt.style = data[i].style;
						$(txt).attr('x', data[i].x);
						$(txt).attr('y', data[i].y);
						txt.title = data[i].value;
						txt.innerHTML = data[i].value;
						document.getElementById("word-cloud").innerHTML += txt.outerHTML;
					}
				});
			}
			if (PN===7) {
				modalMap();
			}
		}
	};
				
	gotoPage = function( p ) {
		pageflip.gotoPage( p, true );
	}
	selectFeature = function( f ) {
		$(".features").addClass("off");
		$("#feature"+f).removeClass("off");
		$("#featurelist ul li").removeClass("selected");
		$("#option"+f).addClass("selected");
	}
	pageflip.setPFEventCallBack( CustomPFEventHandler );
	
	$pageflip.pageflipInit( {
			PageWidth: 950,
			PageHeight: 900,
			FullScreenEnabled: true,
			Transparency: true,
			Margin: 32,
			MarginBottom: 64,
			AutoScale: true,
			FullScale: true,
			AlwaysOpened: false,
			AutoFlipLoop: -1,
			ZoomEnabled: true,
			AutoSinglePageMode: true,
			CenterSinglePage: true,
			DropShadowOpacity: 0.3,
			FlipTopShadowOpacity: 0.2,
			FlipShadowOpacity: 0.2,
			HardFlipOpacity: 0.3,
			EmbossOpacity: 0.2,
			SecondaryDragArea: 32,
			Transparency: true,
			ControlbarFile: "common/controlbar_svg.html",
			GoogleAnalytics: true,
			HashControl: true,
			ShowCopyright: false,
			Copyright: Key.Copyright,
			Key: Key.Key
	}, "meetdanflip" );

	function modalMap(){
		$(".img-modal").on("click", function() {
			console.log("Test");
			$('#imagepreview').attr('src', $(this).attr('src')); 
			$('#imagemodal').modal('show'); 
		});

	    $('img[usemap]').rwdImageMaps();
	}

    function loadit(){
        $('#audioController').load('/code/audioController.html');
        $('#audioFactory').load('/code/audioFactory.html');
        $('#worldCode').load('/code/worldCode.html');
        $('#mapDatasource').load('/code/mapDatasource.html');
        $('#mapServices').load('/code/mapServices.html');
        $('#imageResizer').load('/code/imageResizer.html');
        $('#serviceAPI').load('/code/serviceAPI.html');
        $('#oauth').load('/code/oauth.html');
        $('#pricingController').load('/code/pricingController.html');
        $('#pricingServices').load('/code/pricingServices.html');
    }
</script>
	<script type="text/javascript" src="js/word-cloud.js"></script>

</html>