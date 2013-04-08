<?php
	/*
		Disclaimer:
		This file was created in early 2008 using procedural code by Rey Ortega at Valencia College.
		I'm currently working at refactoring this to an object oriented version with a lot less, cleaner
		code.
		
		This is really difficult to read and wouldn't recommend using most of this.
	*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Link Generator</title>
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript">
function gourl() {
	thisurl = window.location.href;
	spliturl = thisurl.split("?");
	window.location.href = spliturl[0];
}

</script>
<script type="text/javascript" src="vidPreview.js"></script>
</head>
<body>
<div id="mast"><h1>Link Generator</h1></div>
<div id="content">
<div id="formElement">
 <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
    <table>
        <tr>
            <td>Application:</td><td><select name="appl">
			<?php if(!$ap = @$_GET['appl']) {?>
            <option value=""></option><?php  
				$odir = opendir('Main Directory Here');
				if(!$odir) {
					echo "Not a Valid Directory!";
				}else{
				while(($file = readdir($odir)) !== false){
					if ($file != "." && $file != ".." && $file != "index.php" && $file != "Thumbnails" && !strstr($file, "._") && !strstr($file, ".DS_Store")){
						?>
                    	<option value = "<?php echo $file;?>"><?php echo $file; ?> </option>
                <?php }
					}
				}
			} else { 
				$handle = @opendir('Main Directory Here' . $_GET['appl']);
				if(!$handle) {?>
					<option value = "" selected="selected">Not a Valid Directory!</option> <?php
				}else{?>
                		<option value = "<?php echo $_GET['appl'];?>" selected="selected"><?php echo $_GET['appl']; ?> </option> 
            <?php } 
			}?></select></td>
        </tr>
       <?php 
       if(!@$_GET['appl']) {
		   
	   }else{
		   ?>
		   
        <tr>
            <td>Instance:</td>
            <td><select name="inst"><?php
			$idir = @opendir('Main Directory Here' . $_GET['appl'] . 'Required standard directory here');
			if(!$idir) {
				echo "Not a Valid Directory!";
			}else {
			while(($ifile = readdir($idir)) !== false){
				if ($ifile != "." && $ifile != ".." && $ifile != "index.php" && $ifile != "Thumbnails" && !strstr($ifile, "._") && !strstr($ifile, ".DS_Store")){
					if ($ifile != @$_GET['inst']) {
						?> <option value = "<?php echo $ifile;?>"><?php  echo $ifile; ?></option> <?php
					} else {?>
                    	<option value = "<?php echo $ifile;?>" selected><?php echo $ifile;?></option> 	
                <?php 
					}
				}
				}
			}?></select></td>
        </tr>
        <?php } ?>
        <tr><td colspan="2" align="right"><input type="submit" value="Submit" /><input type="button" onclick = "gourl();" value="Clear" /></td></tr>
    </table>
    </form>

</div></div>
<div id="searchreturn"></div>
<div id="results">
<?php
if($_SERVER['REQUEST_METHOD'] == "GET") {
	$appl = @$_GET['appl'];
	$inst = @$_GET['inst'];
	$url = $_SERVER['HTTP_HOST'];
	if(!$appl || !$inst) {
		//echo "Error... Please fill out form Correctly!";	
	}else{
		$dir = 'Main Directory Here' . $appl . 'Required standard directory here' . $inst . '/';
		showdir($dir, $appl, $inst, $url);
	}
}
?>
<?php
function search($r) {
	if($r == false) {
		?><script> var l = document.getElementById('searchreturn'); l.innerHTML='<div class = "return"><?php echo "No Files Found.  Return to ";?><b><a href="File URL Location Here" style="text-decoration: none;" target = "_self">Search</a></b><?php echo ".";?> </div>';</script><?php
		
	}else if($r == true) {
		?><script> var l = document.getElementById('searchreturn'); l.innerHTML='<div class ="return"><?php	echo "Return to ";?><b><a href="File URL Location Here" style="text-decoration: none; padding-top: 20px;" target = "_self">Search</a></b><?php echo ".";?> </div>';</script> <?php
	}
}
	function showdir($dir, $appl, $inst, $url) {
		if ($handle = @opendir($dir)) {
			$mp4_array = array();
			$flv_array = array();
			$other_array= array();
			$mp3_array = array();
			while (false !== @($file = readdir($handle))) {

		// strips files extensions      
			$crap   = array(".jpg", ".jpeg", ".JPG", ".JPEG", ".png", ".PNG", ".gif", ".GIF", ".bmp", ".BMP", ".mp4", ".flv", ".mp3", ".mov");
			$newstring = str_replace($crap, "", $file );
			
//asort($file, SORT_NUMERIC); - doesnt work :(

// hides folders, writes out ul of images and thumbnails from two folders
/*
	This could have been done with a lot less code.  I was still learning PHP when I wrote this and took
	an approach that was much more difficult.
*/			
    				if ($file != "." && $file != ".." && $file != "index.php" && $file != "Thumbnails" && !strstr($file, "._") && !strstr($file, ".DS_Store") && !strstr($file, ".flv") && !strstr($file, ".mov") && !strstr($file, ".mp3")) {
   					$mp4_array[] = "<li><a href=\"http://{$url}/videoPlayer.html?appl={$appl}&inst={$inst}&vid=mp4:{$newstring}\">http://{$url}/videoPlayer.html?appl={$appl}&inst={$inst}&vid=mp4:{$newstring}</a></li>\n";
				 }else if ($file != "." && $file != ".." && $file != "index.php" && $file != "Thumbnails" && !strstr($file, "._") && !strstr($file, ".DS_Store") && !strstr($file, ".mp4") && !strstr($file, ".mov") && !strstr($file, ".mp3")) {
   					$flv_array[] = "<li><a href=\"http://{$url}/videoPlayer.html?appl={$appl}&inst={$inst}&vid={$newstring}\">http://{$url}/videoPlayer.html?appl={$appl}&inst={$inst}&vid={$newstring}</a></li>\n";
				 }else if ($file != "." && $file != ".." && $file != "index.php" && $file != "Thumbnails" && !strstr($file, "._") && !strstr($file, ".DS_Store") && !strstr($file, ".flv") && !strstr($file, ".mp4") && !strstr($file, ".mp3")) {
   					$other_array[] = "<li><a href=\"http://{$url}/videoPlayer.html?appl={$appl}&inst={$inst}&vid=mp4:{$newstring}.mov\">http://{$url}/videoPlayer.html?appl={$appl}&inst={$inst}&vid=mp4:{$newstring}.mov</a></li>\n";
				}else if ($file != "." && $file != ".." && $file != "index.php" && $file != "Thumbnails" && !strstr($file, "._") && !strstr($file, ".DS_Store") && !strstr($file, ".mp4") && !strstr($file, ".mov") && !strstr($file, ".flv")) {
   					$mp3_array[] = "<li><a href=\"http://{$url}/videoPlayer.html?appl={$appl}&inst={$inst}&vid=mp3:{$newstring}\">http://{$url}/videoPlayer.html?appl={$appl}&inst={$inst}&vid=mp3:{$newstring}</a></li>\n";
				 }else{
				}
			}
			
			if($mp4_array) {?>
            <div class = "mp4"><h3>MP4 Files</h3><?php
				foreach($mp4_array as $a) {
					echo $a;
				}?>
            </div><?php
			}
			if($flv_array) {?>
            <div class ="flv"><h3>FLV Files</h3><?php
				foreach($flv_array as $b) {
					echo $b;
				}?>
            </div><?php
			}
			if($mp3_array) {?>
            <div class = "mp3"><h3>MP3 Files</h3><?php
				foreach($mp3_array as $a) {
					echo $a;
				}?>
            </div><?php
			}
			if($other_array) {?>
            <div class = "other"><h3>Other Files</h3><?php
				foreach($other_array as $c) {
					echo $c;
				}?>
            </div><?php	
			}
			
			if(!$mp4_array && !$flv_array && !$other_array && !$mp3_array) {
				search(false);
			}else {
				search(true);
			}
		}	
		if($handle) {
			closedir($handle);
		}else{
			echo "No Directory Exists!";
		}
	}
?>
</div>

<script language="javascript" type="text/javascript">

var totalLinks = document.getElementsByTagName("a");
var newElement, frameNode;
if(totalLinks) {
		
}

function displayPreview(disLink) {
	var appl, inst, vid;
	attr = disLink.toString().split('?');
	detattr = attr[1].split('&');
	for(i=0;i<detattr.length;i++){
		myAttr=detattr[i].split('=');
		switch(myAttr[0]) {
			case "appl":
				appl=myAttr[1];
				break;
			case "inst":
				inst=myAttr[1];
				break;
			case "vid":
				vid=myAttr[1];
				break;
		}
	}
	showtrail(appl, inst, vid);
}

function removePreview(disLink) {
	hidetrail();	
}

for(i=0; i<totalLinks.length; i++) {
	totalLinks[i].onmouseover = function() {
		displayPreview(this);
	}
	totalLinks[i].onmouseout = function() {
		removePreview(this);	
	}
}
</script>
</body>
</html>