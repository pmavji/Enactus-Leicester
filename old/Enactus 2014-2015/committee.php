<?php

$auth_realm = 'My realm';

require_once 'authcomm.php';

echo "You've logged in as {$_SESSION['username']}<br>";
echo '<p><a href="?action=logOut">LogOut</a></p>'

?>
<?php

$includeurl = '.';
$startdir = '/upload/committee';
$showthumbnails = false; 
$memorylimit = false; 
$showdirs = true;
$forcedownloads = false;
$hide = array(
				'dlf',
				'index.php',
				'Thumbs',
				'.htaccess',
				'.htpasswd'
			);
$displayindex = false;
$allowuploads = true;
/*$uploadtypes = array(
						'zip',
						'gif',
						'doc',
						'png'
					);*/
$overwrite = false;
$indexfiles = array (
				'index.html',
				'index.htm',
				'default.htm',
				'default.html'
			);
$filetypes = array (
				'png' => 'jpg.gif',
				'jpeg' => 'jpg.gif',
				'bmp' => 'jpg.gif',
				'jpg' => 'jpg.gif', 
				'gif' => 'gif.gif',
				'zip' => 'archive.png',
				'rar' => 'archive.png',
				'exe' => 'exe.gif',
				'setup' => 'setup.gif',
				'txt' => 'text.png',
				'htm' => 'html.gif',
				'html' => 'html.gif',
				'fla' => 'fla.gif',
				'swf' => 'swf.gif',
				'xls' => 'xls.gif',
				'doc' => 'doc.gif',
				'sig' => 'sig.gif',
				'fh10' => 'fh10.gif',
				'pdf' => 'pdf.gif',
				'psd' => 'psd.gif',
				'rm' => 'real.gif',
				'mpg' => 'video.gif',
				'mpeg' => 'video.gif',
				'mov' => 'video2.gif',
				'avi' => 'video.gif',
				'eps' => 'eps.gif',
				'gz' => 'archive.png',
				'asc' => 'sig.gif',
			);
if($includeurl)
{
	$includeurl = preg_replace("/^\//", "${1}", $includeurl);
	if(substr($includeurl, strrpos($includeurl, '/')) != '/') $includeurl.='/';
}

error_reporting(0);
if(!function_exists('imagecreatetruecolor')) $showthumbnails = false;
if($startdir) $startdir = preg_replace("/^\//", "${1}", $startdir);
$leadon = $startdir;
if($leadon=='.') $leadon = '';
if((substr($leadon, -1, 1)!='/') && $leadon!='') $leadon = $leadon . '/';
$startdir = $leadon;

if($_GET['dir']) {
	//check this is okay.
	
	if(substr($_GET['dir'], -1, 1)!='/') {
		$_GET['dir'] = strip_tags($_GET['dir']) . '/';
	}
	
	$dirok = true;
	$dirnames = split('/', strip_tags($_GET['dir']));
	for($di=0; $di<sizeof($dirnames); $di++) {
		
		if($di<(sizeof($dirnames)-2)) {
			$dotdotdir = $dotdotdir . $dirnames[$di] . '/';
		}
		
		if($dirnames[$di] == '..') {
			$dirok = false;
		}
	}
	
	if(substr($_GET['dir'], 0, 1)=='/') {
		$dirok = false;
	}
	
	if($dirok) {
		 $leadon = $leadon . strip_tags($_GET['dir']);
	}
}

if($_GET['download'] && $forcedownloads) {
	$file = str_replace('/', '', $_GET['download']);
	$file = str_replace('..', '', $file);

	if(file_exists($includeurl . $leadon . $file)) {
		header("Content-type: application/x-download");
		header("Content-Length: ".filesize($includeurl . $leadon . $file)); 
		header('Content-Disposition: attachment; filename="'.$file.'"');
		readfile($includeurl . $leadon . $file);
		die();
	}
	die();
}

if($allowuploads && $_FILES['file']) {
	$upload = true;
	if(!$overwrite) {
		if(file_exists($leadon.$_FILES['file']['name'])) {
			$upload = false;
		}
	}
	
	if($uploadtypes)
	{
		if(!in_array(substr($_FILES['file']['name'], strpos($_FILES['file']['name'], '.')+1, strlen($_FILES['file']['name'])), $uploadtypes))
		{
			$upload = false;
			$uploaderror = "<strong>ERROR: </strong> You may only upload files of type ";
			$i = 1;
			foreach($uploadtypes as $k => $v)
			{
				if($i == sizeof($uploadtypes) && sizeof($uploadtypes) != 1) $uploaderror.= ' and ';
				else if($i != 1) $uploaderror.= ', ';
				
				$uploaderror.= '.'.strtoupper($v);
				
				$i++;
			}
		}
	}
	
	if($upload) {
		move_uploaded_file($_FILES['file']['tmp_name'], $includeurl.$leadon . $_FILES['file']['name']);
	}
}

$opendir = $includeurl.$leadon;
if(!$leadon) $opendir = '.';
if(!file_exists($opendir)) {
	$opendir = '.';
	$leadon = $startdir;
}

clearstatcache();
if ($handle = opendir($opendir)) {
	while (false !== ($file = readdir($handle))) { 
		//first see if this file is required in the listing
		if ($file == "." || $file == "..")  continue;
		$discard = false;
		for($hi=0;$hi<sizeof($hide);$hi++) {
			if(strpos($file, $hide[$hi])!==false) {
				$discard = true;
			}
		}
		
		if($discard) continue;
		if (@filetype($includeurl.$leadon.$file) == "dir") {
			if(!$showdirs) continue;
		
			$n++;
			if($_GET['sort']=="date") {
				$key = @filemtime($includeurl.$leadon.$file) . ".$n";
			}
			else {
				$key = $n;
			}
			$dirs[$key] = $file . "/";
		}
		else {
			$n++;
			if($_GET['sort']=="date") {
				$key = @filemtime($includeurl.$leadon.$file) . ".$n";
			}
			elseif($_GET['sort']=="size") {
				$key = @filesize($includeurl.$leadon.$file) . ".$n";
			}
			else {
				$key = $n;
			}
			
			if($showtypes && !in_array(substr($file, strpos($file, '.')+1, strlen($file)), $showtypes)) unset($file);
			if($file) $files[$key] = $file;
			
			if($displayindex) {
				if(in_array(strtolower($file), $indexfiles)) {
					header("Location: $leadon$file");
					die();
				}
			}
		}
	}
	closedir($handle); 
}

//sort our files
if($_GET['sort']=="date") {
	@ksort($dirs, SORT_NUMERIC);
	@ksort($files, SORT_NUMERIC);
}
elseif($_GET['sort']=="size") {
	@natcasesort($dirs); 
	@ksort($files, SORT_NUMERIC);
}
else {
	@natcasesort($dirs); 
	@natcasesort($files);
}

//order correctly
if($_GET['order']=="desc" && $_GET['sort']!="size") {$dirs = @array_reverse($dirs);}
if($_GET['order']=="desc") {$files = @array_reverse($files);}
$dirs = @array_values($dirs); $files = @array_values($files);


?>
<!DOCTYPE HTML>
<html>
<head>

<link rel="shortcut icon" href="http://www.super4karting.com/enactus/favicon.ico">
<link href="stylesheet.css" rel="stylesheet" type="text/css">

<title>Enactus Leicester - Welcome</title>
</head>
<body style="background:#CCC;">
	
    <div id="header">
    <img src="enactus_logoWEB.png" width="400" height="238"style="float:left"> 
    <img src="banner.jpg" width="600" height="131" style="float:right"> </div>
<div id="menu">
  <div class="mencol">
        <ul id="navbar">
		<li><a href="index.html"><h4> Home </h4></a><ul>
		</li>
		</ul>
        </div>
  <div class="mencol">
        <ul id="navbar">
		<li><a href="#"><h4> About Us </h4></a><ul>
		<li><a href="aboutuk.html">Enactus UK</a></li>
		<li><a href="aboutleicester.html">Enactus Leicester</a></li>
		</ul>
		</li>
		</ul>
        </div>
  <div class="mencol">
        <ul id="navbar">
		<li><a href="#"><h4> Projects </h4></a><ul>
		<li><a href="ethiopia.html">Inspire Ethiopia</a></li>
		<li><a href="choco.html">Choconet</a></li>
		<li><a href="body.html">Body</a></li>
        <li><a href="farmers.html">Farmer's Market</a></li>
        </ul>
		</li>
		</ul>
        </div>
  <div class="mencol">
        <ul id="navbar">
		<li><a href="sponsors.html"><h4> Sponsors </h4></a><ul>
		</li>
		</ul>
        </div>
  <div class="mencol">
        <ul id="navbar" style="z-index:1">
		<li><a href="contact.php"><h4> Contact </h4></a><ul>
		</li>
		</ul>
  </div>
</div>
    <center>
    <div style="width:1000px">
    
    <h2>Committee</h2>
    <iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=sr5jpiteaq158hfj8v2mvk4jlc%40group.calendar.google.com&amp;color=%23B1440E&amp;src=en.uk%23holiday%40group.v.calendar.google.com&amp;color=%235F6B02&amp;ctz=Europe%2FLondon" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
<link rel="stylesheet" type="text/css" href="<?php echo $includeurl; ?>dlf/styles.css" />
<?php
if($showthumbnails) {
?>
<script language="javascript" type="text/javascript">
<!--
function o(n, i) {
	document.images['thumb'+n].src = '<?php echo $includeurl; ?>dlf/i.php?f='+i<?php if($memorylimit!==false) echo "+'&ml=".$memorylimit."'"; ?>;

}

function f(n) {
	document.images['thumb'+n].src = 'dlf/trans.gif';
}
//-->
</script>
<?php
}
?>
</head>
<body>
<div id="container" style="background-color:#CCC">
  <div id="breadcrumbs">  
  <?php
 	 $breadcrumbs = split('/', str_replace($startdir, '', $leadon));
  	if(($bsize = sizeof($breadcrumbs))>0) {
  		$sofar = '';
  		for($bi=0;$bi<($bsize-1);$bi++) {
			$sofar = $sofar . $breadcrumbs[$bi] . '/';
			echo ' &gt; <a href="'.strip_tags($_SERVER['PHP_SELF']).'?dir='.strip_tags($sofar).'">'.$breadcrumbs[$bi].'</a>';
		}
  	}
  
	$baseurl = strip_tags($_SERVER['PHP_SELF']) . '?dir='.strip_tags($_GET['dir']) . '&amp;';
	$fileurl = 'sort=name&amp;order=asc';
	$sizeurl = 'sort=size&amp;order=asc';
	$dateurl = 'sort=date&amp;order=asc';
	
	switch ($_GET['sort']) {
		case 'name':
			if($_GET['order']=='asc') $fileurl = 'sort=name&amp;order=desc';
			break;
		case 'size':
			if($_GET['order']=='asc') $sizeurl = 'sort=size&amp;order=desc';
			break;
			
		case 'date':
			if($_GET['order']=='asc') $dateurl = 'sort=date&amp;order=desc';
			break;  
		default:
			$fileurl = 'sort=name&amp;order=desc';
			break;
	}
  ?>
  </div>
  <div id="listingcontainer">
    <div id="listingheader"> 
	<div id="headerfile"><a href="<?php echo $baseurl . $fileurl;?>">File</a></div>
	<div id="headersize"><a href="<?php echo $baseurl . $sizeurl;?>">Size</a></div>
	<div id="headermodified"><a href="<?php echo $baseurl . $dateurl;?>">Last Modified</a></div>
	</div>
    <div id="listing">
	<?php
	$class = 'b';
	if($dirok) {
	?>
	<div><a href="<?php echo strip_tags($_SERVER['PHP_SELF']).'?dir='.urlencode($dotdotdir);?>" class="<?php echo $class;?>"><img src="<?php echo $includeurl; ?>dlf/dirup.png" alt="Folder" /><strong>..</strong> <em>&nbsp;</em>&nbsp;</a></div>
	<?php
		if($class=='b') $class='w';
		else $class = 'b';
	}
	$arsize = sizeof($dirs);
	for($i=0;$i<$arsize;$i++) {
	?>
	<div><a href="<?php echo strip_tags($_SERVER['PHP_SELF']).'?dir='.urlencode(str_replace($startdir,'',$leadon).$dirs[$i]);?>" class="<?php echo $class;?>"><img src="<?php echo $includeurl; ?>dlf/folder.png" alt="<?php echo $dirs[$i];?>" /><strong><?php echo $dirs[$i];?></strong> <em>-</em> <?php echo date ("M d Y h:i:s A", filemtime($includeurl.$leadon.$dirs[$i]));?></a></div>
	<?php
		if($class=='b') $class='w';
		else $class = 'b';	
	}
	
	$arsize = sizeof($files);
	for($i=0;$i<$arsize;$i++) {
		$icon = 'unknown.png';
		$ext = strtolower(substr($files[$i], strrpos($files[$i], '.')+1));
		$supportedimages = array('gif', 'png', 'jpeg', 'jpg');
		$thumb = '';
		
		if($showthumbnails && in_array($ext, $supportedimages)) {
			$thumb = '<span><img src="dlf/trans.gif" alt="'.$files[$i].'" name="thumb'.$i.'" /></span>';
			$thumb2 = ' onmouseover="o('.$i.', \''.urlencode($leadon . $files[$i]).'\');" onmouseout="f('.$i.');"';
			
		}
		
		if($filetypes[$ext]) {
			$icon = $filetypes[$ext];
		}
		
		$filename = $files[$i];
		if(strlen($filename)>43) {
			$filename = substr($files[$i], 0, 40) . '...';
		}
		
		$fileurl = $includeurl . $leadon . $files[$i];
		if($forcedownloads) {
			$fileurl = $_SESSION['PHP_SELF'] . '?dir=' . urlencode(str_replace($startdir,'',$leadon)) . '&download=' . urlencode($files[$i]);
		}

	?>
	<div><a href="<?php echo $fileurl;?>" class="<?php echo $class;?>"<?php echo $thumb2;?>><img src="<?php echo $includeurl; ?>dlf/<?php echo $icon;?>" alt="<?php echo $files[$i];?>" /><strong><?php echo $filename;?></strong> <em><?php echo round(filesize($includeurl.$leadon.$files[$i])/1024);?>KB</em> <?php echo date ("M d Y h:i:s A", filemtime($includeurl.$leadon.$files[$i]));?><?php echo $thumb;?></a></div>
	<?php
		if($class=='b') $class='w';
		else $class = 'b';	
	}	
	?></div>
	<?php
	if($allowuploads) {
		$phpallowuploads = (bool) ini_get('file_uploads');		
		$phpmaxsize = ini_get('upload_max_filesize');
		$phpmaxsize = trim($phpmaxsize);
		$last = strtolower($phpmaxsize{strlen($phpmaxsize)-1});
		switch($last) {
			case 'g':
				$phpmaxsize *= 1024;
			case 'm':
				$phpmaxsize *= 1024;
		}
	
	?>
	<div id="upload">
		<div id="uploadtitle">
			<strong>File Upload</strong> (Max Filesize: <?php echo $phpmaxsize;?>KB)
			
			<?php if($uploaderror) echo '<div class="upload-error">'.$uploaderror.'</div>'; ?>
		</div>
		<div id="uploadcontent">
			<?php
			if($phpallowuploads) {
			?>
			<form method="post" action="<?php echo strip_tags($_SERVER['PHP_SELF']);?>?dir=<?php echo urlencode(str_replace($startdir,'',$leadon));?>" enctype="multipart/form-data">
			<input type="file" name="file" /> <input type="submit" value="Upload" />
			</form>
			<?php
			}
			else {
			?>
			File uploads are disabled in your php.ini file. Please enable them.
			<?php
			}
			?>
		</div>
		
	</div>
	<?php
	}
	?>
    <div id="copy">Directory Listing Script &copy;2008 Evoluted, <a href="http://www.evoluted.net/">Web Design Sheffield</a>.</div>
  </div>
</div>
    
    </div>
    </center>
	<div id="footer">
    	<div class="footcold">
        <p style="font-size:13px;color:#CCC;position:absolute;margin-top:-0px">
        <img src="foot.jpg" width="150" height="80" style="margin-left:-30px"><br>
<strong><span style="color:#C88A12">En</span><span style="color:white">trepreneurial</span></strong> - having the perspective to see an opportunity and the talent to create value from that opportunity;<br><br>
		<strong><span style="color:#C88A12">Act</span><span style="color:white">ion</span></strong> - the willingness to do something and the commitment to see it through even when the outcome is not guaranteed;<br><br>
		<strong><span style="color:#C88A12">Us</span></strong> - a group of people who see themselves connected in some important way; individuals that are part of a greater whole.
        </p>
      </div>
    	<div class="footcol">
        <p style="color:#CCC;position:absolute;text-align:left;margin-top:40px;font-size:13px">
        "Impossible is just a big word thrown around by small men who find it easier to live in the world they've been given than to explore the power they have to change it. Impossible is not a fact. It's an opinion. Impossible is not a declaration. It's a dare. Impossible is potential. Impossible is temporary. Impossible is nothing." 
<br><br><br>
-- Muhammad Ali

        </p>
        </div>
        <div class="footcol">
        <h3 style="color:#CCC;position:absolute;text-align:left;margin-top:40px"> Get Connected <br><br>
        <a id="facebook" href="http://www.facebook.com/enactus.leicester" target="new"><img src="facebook.png" width="139" height="20" style="border:0px"> </a>
            <br><br>
            <a id="twitter" href="http://www.twitter.com/enactusleiceste" target="new"><img src="twitter.png" width="139" height="20" style="border:0px"> </a>
            
          </h3>
        </div>
        <div class="footcole">
        <p style="color:#CCC;position:absolute;text-align:left;margin-top:40px;font-size:13px">
        <img src="su.jpg" width="180" height="121" style="border-radius:5px">
        <br>
        Percy Gee Building<br>
		University Road<br>
		Leicester<br>
		LE1 7RH<br>
        <br>
        Telephone: 0116 223 1181<br>
        </p>
        </div>
	</div>
</body>
</html>
