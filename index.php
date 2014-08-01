<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<LINK href="style.css" rel="stylesheet" type="text/css">


</head>
<body>

<?php 
session_start(); 
include('header.html');
?>
<div class = 'headtag'>
<h1> Online Store For Electronic Gadgets </h1>
</div> 

<div class = 'flyouts'>

<div class = 'flyoutcont' id = 'flyoutcont'> 

</div>
<div id = 'flylayer2'> 

</div>

</div>


<div class = 'headtag' id = "headofeffect">
<span class = 'effect' id = "effect">
</span>

<a href = 'buying.php' style="text-decoration : none; color:inherit;"><h1> Enter here </h1></a>
</div> 

<span class = 'flyoutimgs'>
   <img src="productImages/pocket_cutlery.jpg" class = 'imgsrc' id = "img1" data-name = "Baladeo 52G Pocket Cutlery" data-desc = 'If you happen to be someone who loves tinkering around with stuff, and have amassed quite a collection of Swiss Army Knives over the years '>
   
   <img src="productImages/singingsunflower.gif" class = 'imgsrc' id = "img2" data-name = "Electronic Singing Sunflower" data-desc = 'Plants vs Zombies 2 has just been released on the Android platform long after folks with iOS devices have had their fair '>
   
   <img src="productImages/nexus5.jpg" class = 'imgsrc' id = "img3" data-name = "LG Nexus 5" data-desc = 'Well, well, what do we have here? Yet another high end smartphone that has hit the market? This time around, it is the Android flag that is being flown high, thanks to the folks over at Google who have partnered with LG.'>
   
   <img src="productImages/SwitchEasyTanks.jpg" class = 'imgsrc' id = "img4" data-name = "SwitchEasy Tanks Battery" data-desc = 'When we get about three quarters through our day, most of our gadgets are starting to gasp for breath.'>
   
</span>

<div class = 'clear'> </div>
</div>

<div class = 'offerssec'> 
<div class = 'leftsec'>

<div class = 'offerhead' onClick=delegatetooffer(0)> <img src="Images/savedollar.png" class = 'offerimg'> <span class = 'offerheadtext' data-desc = 'We have cool gadgets starting from range of $4. We offer smart and quality buying options. '> Affordable Prices </span> </div>
<div class = 'offerhead' onClick=delegatetooffer(1)><img src="Images/widerange.png" class = 'offerimg'> <span class = 'offerheadtext' data-desc = 'We have a wide of range of gadgets suiting all ranges of age groups and interests. Our range of collection amazes whoever notices them. Be the next one. '> Wide Range </span></div>
<div class = 'offerhead' onClick=delegatetooffer(2)> <img src="Images/discount.png" class = 'offerimg'><span class = 'offerheadtext' data-desc = 'We constantly run checks on our products and for interest of our customers provide attractive discounts. Keep an eye on our catalogue or check the link below. '>  Discounted Offers </span> </div>
<div class = 'offerhead' onClick=delegatetooffer(3)> <img src="Images/exship.png" class='offerimg'><span class = 'offerheadtext' data-desc = 'We provide express shipping at a very affordable price. Try our services to know more. '> Express Shipping </span> </div>
</div>

<div class = 'rightsec'>

</div>
<div class = 'clear'> </div>
</div>


<!-- footer secion -->
<div class = 'footer'>
<span class = 'link'> <a href = ''> Catalogue </a></span> <span class = 'link'> <a href = ''>FAQ's </a></span> <span class = 'link'><a href = ''>  Contact </a></span>
</div>


<script src="../library functions/jquery-2.0.3.min.js"></script>
<script src="script.js"></script>

<script>
var imgdelay = 3000;
var maximgs = $(".imgsrc");
maximgs = maximgs.length;
var currimg = 1;
var previmg = maximgs;
var nextimg = 2;

var currdesc = 0;
var nextdesc = 1;
var maxdesc = document.getElementsByClassName("offerheadtext").length;
var prevdesc = maxdesc;

var timerandoffer;

window.onload = function()
{
	console.log($(".imgsrc:nth-child(1)").attr('src'));
	document.getElementById("flylayer2").style.position = "absolute";
	document.getElementById("flylayer2").style.left = document.getElementById("flyoutcont").offsetLeft + "px";
	document.getElementById("flylayer2").style.top = document.getElementById("flyoutcont").offsetTop + "px";
    getimage(currimg);
	
	// load the current offer text.
    setofferdesc(0);
}

function delegatetooffer(index)
{
	clearTimeout(timerandoffer);
	setofferdesc(index);
}

function setofferdesc(index)
{
   var offerhead = document.getElementsByClassName("offerhead")[index];
   
   //var offername = offerhead.innerHTML;
   var offerheadtext = offerhead.getElementsByClassName('offerheadtext')[0]; 
   var offername = offerheadtext.innerHTML;
   
   var offerdesc = offerheadtext.dataset.desc;
   setclasses(index);
  
   console.log(offername + offerdesc);
   
   offerdesc = "<div class = 'imgdeschead'>" + offername + "</div>" + offerdesc;
   
   
   
   $('.rightsec').fadeOut(10, function()
   {
	   $('.rightsec').html(offerdesc);
	   $('.rightsec').fadeIn(1000, function() 
	   {
		    
	   }
	   );
   }
   );
   
  
}


function setclasses(index)
{
     var maxoffers = document.getElementsByClassName("offerhead").length;
	 for(i=0;i<maxoffers;i++)
	 {
	    document.getElementsByClassName("offerhead")[i].className = "offerhead";  	 
	 }
	 console.log("index "+index);
	 document.getElementsByClassName("offerhead")[index].className = "offerhead offerheadhover";
}

function getimage(index)
{
    var imgsrc = $(".imgsrc:nth-child("+index+")").attr('src');
	var name = $(".imgsrc:nth-child("+index+")").data("name");
	var desc = $(".imgsrc:nth-child("+index+")").data("desc") + "      <a href = '' class = 'butt1'> Read More </a>";
	
	
	desc = "<div class = 'imgdeschead'> Your Gadget </div>" + desc;
	var htmlimg = "<div class = 'imgholder'><img src = "+imgsrc+" class = 'flycontimg'></div><div class = 'nameofimg'>"+name+"</div><div class = 'descofimg'>"+desc+"</div>";
	
	//$(".flyoutcont").fadeOut(2000, function() {  });
	$(".flyoutcont").html(htmlimg);
	//$(".flyoutcont").fadeIn(2000,function() {  });
}

var imganim = setInterval(function()
{
	if(currimg == maximgs)
	{
		currimg = 1;
		previmg = maximgs;
		nextimg = 2;
	}
	else
	{
		currimg = currimg + 1;
		previmg = currimg - 1;
		nextimg = currimg + 1;
		
		if(previmg < 1)
		{
			previmg = maximgs;
		}
		
		if(nextimg > maximgs)
		{
			nextimg = 1;
		}
	}
	
	
	getimage(currimg);
	
	var randoffer = Math.floor(Math.random() * 4);
	timerandoffer = setTimeout(function()
	{ setofferdesc(randoffer) }, 2000);
	
	
	
}, imgdelay);



function previmg()
{
		  
}
  
  
function nextimg()
{
	 
}
  

</script>


</body>
</html>