$(document).ready(function () {
    $(".popup").fancybox({
        autoDimensions:false,
        width:980,
        height:"100%",
        transitionIn:'zoomIn',
        transitionOut:'zoomOut',
        type:'iframe',
        padding:0,
        fitToView:false,
        autoSize:false,
        helpers   : {
            overlay : {closeClick: false}
        }
    });

    $(".popup-medium").fancybox({
        autoDimensions:false,
        width:980,
        height:"500px",
        transitionIn:'zoomIn',
        transitionOut:'zoomOut',
        type:'iframe',
        padding:0,
        fitToView:false,
        autoSize:false,
        helpers   : {
            overlay : {closeClick: false}
        }
    });


    $(".popup-autosize").fancybox({
        autoDimensions: false,
        fitToView: false,
        autoSize: true,
        'width':980,
        'height':"100%",
        'transitionIn':'zoomIn',
        'transitionOut':'zoomOut',
        'type':'iframe',
        helpers   : {
            overlay : {closeClick: false}
        }
    });

	$(".popup-calendar").fancybox({
		autoDimensions: false,
        fitToView: false,
        autoSize: true,						  	
        'width':'98%',
        'height':"100%",
        'transitionIn':'fade',
        'transitionOut':'fade',
        'type':'iframe',
        helpers   : {
            overlay : {closeClick: false}
        }
		
    }); 
 	
	$(".popup-calendar-admin").fancybox({
		autoDimensions: false,
        fitToView: false,
        autoSize: true,						  	
        'width':'50%',
        'height':"100%",
        'transitionIn':'fade',
        'transitionOut':'fade',
        'type':'iframe',
        helpers   : {
            overlay : {closeClick: false}
        }
		
    }); 
	
    $(".popup-small").fancybox({
        autoDimensions: false,
        fitToView: false,
        autoSize: false,
        'width':980,
        'height':"380px",
        'transitionIn':'zoomIn',
        'transitionOut':'zoomOut',
        'type':'iframe',
        helpers   : {
            overlay : {closeClick: false}
        }
    });

    $(".popup-refresh-small").fancybox({
        autoDimensions: false,
        fitToView: false,
        autoSize: false,
        'width':980,
        'height':"380px",
        'transitionIn':'zoomIn',
        'transitionOut':'zoomOut',
        'type':'iframe',
        'beforeClose': function() {
            parent.location.reload();
        },
        helpers   : {
            overlay : {closeClick: false}
        }
    });



    $(".popup-refresh").fancybox({
        autoDimensions: false,
        fitToView: false,
        autoSize: false,
        'width':980,
        'height':"100%",
        'transitionIn':'zoomIn',
        'transitionOut':'zoomOut',
        'type':'iframe',
        'beforeClose': function() {
            parent.location.reload();
        },
        helpers   : {
            overlay : {closeClick: false}
        }
    });

    $(".popup-refresh-autosize").fancybox({
        autoDimensions: false,
        fitToView: false,
        autoSize: true,
        'width':980,
        'height':"100%",
        'transitionIn':'zoomIn',
        'transitionOut':'zoomOut',
        'type':'iframe',
        'beforeClose': function() {
            parent.location.reload();
        },
        helpers   : {
            overlay : {closeClick: false}
        }
    });
	
	$(".popup-iframe-autosize").fancybox({
        maxWidth	: 1000,
		minWidth	: 500,
		minHeight	: 200,
		fitToView	: false,
		width		: 1000,
		height		: 350,
		autoSize	: true,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		'type':'iframe',
        helpers   : {
            overlay : {closeClick: false}
        },
		onUpdate: function(){
		   this.width = $('.fancybox-iframe').contents().find('html').width();
		   if($('.fancybox-iframe').contents().find('#project_addresstype').val() == 'address')
		   {
				this.height = 337;
		   }
		   else
		   {
				this.height = $('.fancybox-iframe').contents().find('html').height();   
			}
		  }
	});


    $("#AjaxTabAssignedStock").fancybox({
        autoDimensions: false,
        fitToView: false,
        autoSize: true,
        'width':980,
        'height':"100%",
        'transitionIn':'zoomIn',
        'transitionOut':'zoomOut',
        'type':'iframe',
        helpers   : {
            overlay : {closeClick: false}
        },
        'beforeClose': function() {
            AjaxTabAssignedStock();
        }

    });

    $("#AjaxTabPurchaseOrders").fancybox({
        autoDimensions: false,
        fitToView: false,
        autoSize: true,
        'width':980,
        'height':"100%",
        'transitionIn':'zoomIn',
        'transitionOut':'zoomOut',
        'type':'iframe',
        helpers   : {
            overlay : {closeClick: false}
        },
        'beforeClose': function() {
            AjaxTabPurchaseOrders();
        }

    });




});