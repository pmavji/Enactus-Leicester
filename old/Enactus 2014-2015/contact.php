<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/favicon.ico">
<link href="stylesheet.css" rel="stylesheet" type="text/css">

<title>Enactus Leicester - Welcome</title>
</head>
<body>
	<div id="all">
    <div id="header">
    <img src="enactus_logo_mission2.png" width="1000" height="246"style="float:left"> </div></div>
    <div id="allmenu">
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
		<!--<li><a href="ethiopia.html">Inspire Ethiopia</a></li>-->
		<li><a href="pt.html">PatchTogether</a></li>
		<li><a href="body.html">Project BODY</a></li>
        <li><a href="farmers.html">Farmers' Market</a></li>
        <li><a href="ewaste.html">Electronic Waste</a></li>
        <li><a href="bamboo.html">Water Filtration Project</a></li>
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
      <div class="mencol">
        <ul id="navbar">
		<li><a href="http://leicesterunion.com/groups/enactus--3" target="new"><h4> Become a Member </h4></a><ul>
		</li>
		</ul>
        </div>
  </div>
</div>
</div>
    <center>
    <div style="width:1000px;height:100%">
    
    <h2 style="color:#515356">Contact</h2>
    <div style="width:600px">
    <p style="color:#515356">For information on how to join one of our projects and become a member or for any other enquiries regarding Enactus Leicester, there are a number of ways to get in touch. Simply fill out the form below:
<br><br></p>
<?php 
$action=$_REQUEST['action']; 
if ($action=="")    /* display the contact form */ 
    { 
    ?> 
    <form  action="" method="POST" enctype="multipart/form-data"> 
    <input type="hidden" name="action" value="submit"> 
    <span style="color:#515356">Your name:</span><br> 
    <input name="name" type="text" value="" size="30"/><br> 
    <span style="color:#515356">Your email:</span><br> 
    <input name="email" type="text" value="" size="30"/><br> 
    <span style="color:#515356">Your message:</span><br> 
    <textarea name="message" rows="7" cols="30"></textarea><br> 
    <input type="submit" value="Send email"/> 
    </form> 
    <?php 
    }  
else                /* send the submitted data */ 
    { 
    $name=$_REQUEST['name']; 
    $email=$_REQUEST['email']; 
    $message=$_REQUEST['message']; 
    if (($name=="")||($email=="")||($message=="")) 
        { 
        echo "All fields are required, please fill the form again."; 
        } 
    else{         
        $from="From: $name<$email>\r\nReturn-path: $email"; 
        $subject="Enactus Leceister Online Form Enquiry"; 
        mail("su-enactus@le.ac.uk", $subject, $message, $from); 
        echo "<h3>Thank you for your message, we'll get back to you shortly.</h3>"; 
        } 
    }   
	?> 
    <p style="color:#515356">
<br><br>
Alternatively, drop us an email at:
<br><br>
<a href="mailto:su-enactus@le.ac.uk" >su-enactus@le.ac.uk</a>
<br><br>
Like us on Facebook:
<br><br>
<a href="http://www.facebook.com/enactusleicester" target="new">Enactus Leicester</a>
<br><br>
Follow us on twitter:
<br><br>
<a href="http://www.twitter.com/enactusleiceste" target="new">@enactusleiceste</a>
<br><br>
or come and check us out for yourself at one of our campus events.
<br><br>
Website hosted by <a href="http://www.exclusivewebsystems.com">ExclusiveWebSystems.com</a>
</p>

    </div>
    
    </div>
    </center>
    <div id="allfoot">
	<div id="footer">
    	<div class="footcold">
        <p style="font-size:13px;color:#CCC;position:absolute;margin-top:-0px">
        <img src="enactus_logo_new_white.png" width="140" height="80" style="margin-left:-25px"><br>
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
        </div></div>
	</div>
</body>
</html>
