// JavaScript Document


$(".flyout").on();

$( ".cart" )
.mouseenter(function() {
$( ".cart .flyout" ).html("Your Cart");

$( ".cart .flyout" ).animate({
padding:"32px 0 0 0",
height: "53%"
}, 200, function() {
// Animation complete.
});
	

})
.mouseleave(function() {

$( ".cart .flyout" ).html("");

$(".cart .flyout").css( "padding", "0px" );


$( ".cart .flyout" ).animate({
height: "0%"
}, 500, function() {
// Animation complete.
});	
	
	

});





  var animin;
  var val = 1;
  var flysp = 1000;
  var animing = false;
  
  $(".ltarrow").css("opacity", 0);
  $(".rtarrow").css("opacity", 0);

  var imglen = $(".imgsrc");
  imglen = imglen.length;
 
  $(".imgsrc:nth-child("+val+")").css("left", "0px");  
    
  var adjval = 0;
  
  createinterval();
   
  
  
  function createinterval()
  {
 
      animin =  setInterval(function() {
	  
	  if(val == imglen)
	  {
		  val = 1;
		  //clearInterval(animin);
	  }
	  else
	  {
		 val = val + 1;  
	  }
	  
	  $(".imgsrc:nth-child("+val+")").css("opacity",1);
	  $(".imgsrc:nth-child("+val+")").animate({left:'0px'}, flysp, "swing");  
	  
	  var lastelem;
	  
	  if(val - 1 == 0)
	  {
		  lastelem = imglen;
	  }
	  else
	  {
		  lastelem = val - 1;
	  }
	  
	  $(".imgsrc:nth-child("+lastelem+")").animate({left:'-700px'}, flysp, "swing", function() {
		 $(".imgsrc:nth-child("+lastelem+")").css("opacity",0);	
		 $(".imgsrc:nth-child("+lastelem+")").css("left", "701px");  
	  });  
	 
	  
	  
	  if(adjval != 0)
	  {
		  $(".imgsrc:nth-child("+adjval+")").css("left", "701px");
		  adjval = 0;
	  }
	
  }, (flysp + 1000));
  
  }
  
window.onmousemove = function(event)
{
	if(event.target.className == "imgsrc" || event.target.className == "ltarrow" || event.target.className == "rtarrow")
	{
	   	$(".ltarrow").animate({"opacity":1}, 500, "swing"); 
	   	$(".rtarrow").animate({"opacity":1}, 500, "swing"); 
	}
	else
	{
	    $(".ltarrow").animate({"opacity":0}, 500, "swing"); 
	   	$(".rtarrow").animate({"opacity":0}, 500, "swing"); 
	}
}