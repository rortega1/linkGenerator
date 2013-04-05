/* FLOATING IMAGE */

/*
Simple Image Trail script- By JavaScriptKit.com
Visit http://www.javascriptkit.com for this script and more
This notice must stay intact
*/
/*
Modified for Valencia College use by Rey Ortega
*/
if (document.getElementById || document.all){
document.write('<div id="trailimageid">');
document.write('</div>');
}

var offsetfrommouse=[10,10];
var dom = window.location.hostname;

function gettrailobj(){
if (document.getElementById && document.getElementById("trailimageid"))
return document.getElementById("trailimageid").style
else if (document.all)
return document.all.trailimagid.style
}

function gettrailobjnostyle(){
if (document.getElementById && document.getElementById("trailimageid"))
return document.getElementById("trailimageid")
else if (document.all)
return document.all.trailimagid
}

function truebody(){
return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}
function mouseX(evt) {
	if (!evt){
		evt = window.event; 
	}
	if (evt.pageX){
		return evt.pageX;
	}else if (evt.clientX){
		return evt.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;			
	}else if(evt.offsetX){
		return evt.offsetX;	
	}else if(evt.screenX) {
		return evt.screenX;	
	}else if(evt.x) {
		return evt.x;
	}else if(evt.layerX) {
		return evt.layerX;
	}else {
		return 0;
	}
}
function mouseY(evt) {
	if (!evt) {
		evt = window.event; 
	}
	if (evt.pageY){ 
		return evt.pageY; 
	}else if (evt.clientY){
		return evt.clientY + document.body.scrollTop+ document.documentElement.scrollTop;
	}else if (evt.offsetY) {
		return evt.offsetY;	
	}else if (evt.screenY) {
		return evt.screenY;	
	}else if (evt.y) {
		return evt.y;
	}else if(evt.layerY) {
		return evt.layerY;
	}else {
        return 0;
	}
    
}

function followmouse(evt) {
	if (document.getElementById) {
	var obj = document.getElementById("flashdiv").style; 
	obj.visibility = 'visible';
	obj.left = (parseInt(mouseX(evt))+offsetfrommouse[0]) + 'px';
	obj.top = (parseInt(mouseY(evt))+offsetfrommouse[1]) + 'px';
	}
}

function showtrail(appl, inst, vid){
	
	document.onmousemove=followmouse;
	var width = 490;
	var height = 290;
	var dom = window.location.hostname;	
	var browser=navigator.appName;
	var b_version=navigator.appVersion;
	var version=parseFloat(b_version);
	if ((browser=="Microsoft Internet Explorer") && (version>=4)){
		extra1 = "";
		extra2 = "";
	}else{
		extra1 = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="'+width+'" height="'+height+'">';
		extra2 = '</object>';
	}
	//alert(appl+inst+vid);
		
	temp = 	'<div style="border:solid 5px #fff;width:'+width+'px;height:'+height+'px;">'+extra1+'<embed src="http://websflash.valenciacollege.edu/videoPlayer.swf?appl='+appl+'&inst='+inst+'&vid='+vid+'&dom='+dom+'" width="'+width+'" height="'+height+'" allowscriptaccess="sameDomain" allowfullscreen="false"'+extra2+'</div>';
		newHTML = '<div id="flashdiv" align="center" style="position: absolute; z-index:99;border:solid 1px #000">';
		newHTML = newHTML += temp;
		newHTML = newHTML + '</div>';
	
	gettrailobjnostyle().innerHTML = newHTML;

	gettrailobj().visibility="visible";

}

function hidetrail(){
	gettrailobj().visibility="hidden";
	gettrailobjnostyle().innerHTML="";
	document.onmousemove="";
	gettrailobj().left="-999px";
}

