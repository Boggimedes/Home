	selectFeature = function(f) {
		$(".features").addClass("off");
		$("#feature"+f).removeClass("off");
		$("#featurelist ul li").removeClass("selected");
		$("#option"+f).addClass("selected");
	}

	function modalMap(){
			console.log("Test");
		$(".img-modal").on("click", function() {
			$('#imagepreview').attr('src', $(this).attr('src')); 
			$('#imagemodal').modal('show'); 
		});

	    $('img[usemap]').rwdImageMaps();
	}

    function loadCode(){
        $('#audioController').load('code/audioController.html');
        $('#audioFactory').load('code/audioFactory.html');
        $('#worldCode').load('code/worldCode.html');
        $('#mapDatasource').load('code/mapDatasource.html');
        $('#mapServices').load('code/mapServices.html');
        $('#imageResizer').load('code/imageResizer.html');
        $('#serviceAPI').load('code/serviceAPI.html');
        $('#oauth').load('code/oauth.html');
        $('#pricingController').load('code/pricingController.html');
        $('#pricingServices').load('wcode/pricingServices.html');
    }
