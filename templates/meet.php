
<?php
session_start();
include ('../config/config.php');
if(!isset($_SESSION['username'])){
  header("Location: ../index.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>WordFlow</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
 <meta name="google-signin-client_id" id="gauth"/>
  <script type="text/javascript">
    var authKey = <?php echo json_encode($authKey);?>;
    $("#gauth").attr("content", authKey);
  </script>
  <script>
var app_id = <?php echo json_encode($app_id);?>;
var app_code = <?php echo json_encode($app_code);?>;
    function openEditor(){
    window.location.href="./blogEditor.php";
  }
    /*logout of both Google and normal session*/
    function logout() {
      var r = confirm("Do you wish to logout?");
      if (r == true) {
       var auth2 = gapi.auth2.getAuthInstance();
       auth2.signOut().then(() => {
        document.location.href = '../db/logout.php';
      });
       auth2.disconnect();
       document.location.href = '../db/logout.php';
     }
   }
   var GoogleAuth;
   function onLoad() {
    gapi.load('auth2', () => {
      GoogleAuth = gapi.auth2.init();
    });
   }
  function liked(heart) {
   console.log('liked');
   source=heart.src;  
   if (source.slice(-8,-4) == "like") 
   {
    heart.src = "../images/liked.svg";
  }
  else 
  {
    heart.src = "../images/like.svg";
  }
}

</script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../styles/dashboard.css"/>
</head>
<body>

  <nav class="navbar navbar-default  navbar-expand-lg fixed-top " >
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><span class="brand">WordFlow</span></a>
      </div>
      <div class="nav navbar-nav navbar-form">
        <form action="" method="GET" class="form-inline"> 
          <div class="row">
            <div class="col-md-40">
              <div class="input-group">
                <div class="input-group-btn">
                  <button class="btn searchbtn" type="submit">
                    <span class="glyphicon glyphicon-search invert"></span>
                  </button>
                </div>
                <input type="text" class="form-control" placeholder="Search WordFlow" id="searchbox"/>
              </div>
            </div>
          </div>
        </form>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./dashboard.php" class="nav-item nav-link" title="Home"><img src="../images/home.svg" class="icons invert"></a></li>
        <li><a href="./messages.php" class="nav-item nav-link" title="Message"><img src="../images/msg.svg" class="icons invert"></a></li>

        <li><a href="./displaySavedBlogs.php" class="nav-item nav-link" title="Saved Posts"><img src="../images/save2.svg" class="icons invert"></a></li>
        <li><a href="./meet.php" class="nav-item nav-link" title="Meet a friend"><img src="../images/map.svg" class="icons highlight-icon"></a></li>
        <!-- <li><a href="#" class="nav-item nav-link" title="Liked Posts"><img src="../images/heart.svg" class="icons invert"></a></li> -->


        <li><a href="#" class="nav-item nav-link " data-toggle="dropdown" data-target=".userdrop" title="Your Profile"><img src="../images/user.svg" class="icons invert"></a>
          <div class="dropdown userdrop">
            <ul class="dropdown-menu">
              <li class="dropdown-header">Account</li>
              <li><a href="#" onclick="logout()">Log Out</a></li>
              <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
              <li><a href="./settings.php">Settings</a></li>
              <li><a href="#">Help</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">WordFlow</li>
              <li><a href="#">Posts</a></li>
              <li><a href="#">Likes</a></li>
              <li><a href="#">Edit appearance</a></li>
            </ul>

          </div></li>
          <button class="btn navbar-btn item writebtn3" title="Create" onclick="openEditor()"> &nbsp;<img src="../images/pencil.svg" class="icons">&nbsp;</button>

          <!-- edit and edit2-->
          <!-- <li><a href="#" class="nav-item nav-link"><span class="glyphicon glyphicon-user"></span></a></li> --> 
        </ul>
      </div>
    </nav>
    <!------------------------------------------------------------------------------------------------------------------------------------------------>


  <datalist id="userLocations">
    <?php
    $sql="SELECT username,city,`state` from user";
    $res=$conn->query($sql);
    while($r=$res->fetch_assoc()):
      ?>
      <option data-value=<?= $r["city"].",".$r["state"] ?>><?php echo $r["username"] ?></option>
    <?php endwhile; ?>

  </datalist>


  <div id="wrapperCurrentLocation" style="margin-top: 50px;">
    <div id="currentMap">   
      <div class="mapouter" id = "currentLocMap">
        <div class="gmap_canvas">
          <iframe width="900" height="630" id="currLoc" src="#"frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        </div>    
      </div>
    </div>
    <div id = "userDetails">

      <div class="flex-container">
        <div class="content-container">
          <div class="form-container">
            <div class="xc">
              <h2 >Meet in Middle</h2>
              <hr >
              <p><i>Connect with people across the globe, meet in the middle.</i></p>


              <div class="col-md-9 col-lg-offset-1"><br>                      
                <h4>Your favourable location</h4><br>
                <input type="text" class="col-md-12 text" id="user1" style="font-size: 20px;" >
              </div>
              <div class="col-md-9 col-lg-offset-1"><br>                      
                <h4>I wanna meet</h4><br>
                <input type="text" class="col-md-12 text" style="font-size: 20px;" id="user2" >
              </div>
              <br><br>
              <a onclick="route()"  href="#wrapperRoute" class="btn greenify " style=" font-size: 1.5em; width: 40%; margin-top: 20px;">Explore Route</a>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>

  <div id="wrapperRoute">
    <div id="routeMap">
      <img id="pic" src="#"/>
    </div>
    <div id="routeInfo">
      <div class="flex-container">
        <div class="content-container">
          <div class="form-container">
            <div class="xc" style="width: 100%;">
              <h2 >Here's your Route!</h2>
              <hr >
              <h4 id = "src">Source : </h4>
              <h4 id = "dest">Destination : </h4>
              <br>
              <a class="btn greenify" onclick="findMidPoint()" href="#wrapperMidway" style=" font-size: 1.5em; width: 40%; margin-top: 20px;">Find Halfway</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 


  <div id="wrapperMidway">

    <div id="midwayMap">
      <div class="mapouter1">
        <div class="gmap_canvas1">
          <iframe width="900" height="630" id="gmap_canvas" src="#"frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        </div>    
      </div>
    </div> 
    <div id="midwayInfo">
      <div class="flex-container">
        <div class="content-container">
          <div class="form-container">
            <div class="xc" style="width: 100%;">
              <div id="midpointData">

              </div>
              <br>
              <button class="btn greenify" style=" font-size: 1.5em; width: 40%; margin-top: 20px;" onclick="sendInviteMail()">Invite To Meet</button>
            </div>
          </div>
        </div>
      </div>       
    </div>
  </div> 





</body>
<script>

  var latSrc="",latDest="",lngSrc="",lngDest="",src="",dest="";
      var meetUpDetails;
  var HttpClient = function() {
    this.get = function(aUrl, aCallback) {
      var anHttpRequest = new XMLHttpRequest();
      anHttpRequest.onreadystatechange = function() { 
        if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
          aCallback(anHttpRequest.responseText);
      }

      anHttpRequest.open( "GET", aUrl, true );            
      anHttpRequest.send( null );
    }
  }



  function getSrc(src){
    var geocoderAPISrc = new HttpClient();
    geocoderAPISrc.get('https://geocoder.api.here.com/6.2/geocode.json?app_id='+app_id+'&app_code='+app_code+'&searchtext='+src, function(response) {
        // do something with response
        let result = JSON.parse(response);
        var locations = result.Response.View[0].Result;
        // Add a marker for each location found
        for (i = 0;  i < locations.length; i++) {

          latSrc= locations[i].Location.DisplayPosition.Latitude;
          lngSrc= locations[i].Location.DisplayPosition.Longitude;

        }

        getDest(dest);

      });

  }

  function getDest(dest){

    var geocoderAPIDest = new HttpClient();
    var pos = geocoderAPIDest.get('https://geocoder.api.here.com/6.2/geocode.json?app_id='+app_id+'&app_code='+app_code+'&searchtext='+dest, function(response) {
        // do something with response
        let result = JSON.parse(response);
        var locations = result.Response.View[0].Result;
    // Add a marker for each location found
    for (i = 0;  i < locations.length; i++) {

      latDest= locations[i].Location.DisplayPosition.Latitude;
      lngDest= locations[i].Location.DisplayPosition.Longitude;

    }
    showMap();

  });

  }



  function midPoint(lat1,lon1,lat2,lon2){

    dLon = Math.PI/180*(lon2 - lon1);

    //convert to radians
    lat1 = Math.PI/180*(lat1);
    lat2 = Math.PI/180*(lat2);
    lon1 = Math.PI/180*(lon1);

    Bx = Math.cos(lat2) * Math.cos(dLon);
    By = Math.cos(lat2) * Math.sin(dLon);
    lat3 = Math.atan2(Math.sin(lat1) + Math.sin(lat2), Math.sqrt((Math.cos(lat1) + Bx) * (Math.cos(lat1) + Bx) + By * By));
    lon3 = lon1 + Math.atan2(By, Math.cos(lat1) + Bx);

    //print out in degrees
    console.log((180*(lat3) / Math.PI)+ " " +(180*(lon3) / Math.PI));
    var newLat = (180*(lat3) / Math.PI);
    var newLon = (180*(lon3) / Math.PI);

    var radius = 150;
    var reverseGeocoderAPISrc = new HttpClient();
    reverseGeocoderAPISrc.get('https://reverse.geocoder.api.here.com/6.2/reversegeocode.json?app_id='+app_id+'&app_code='+app_code+'&prox='+newLat+','+newLon+','+radius+'&mode=retrieveAddresses&maxresults=1', function(response) {
            // do something with response
            let result = JSON.parse(response);
            var location = result.Response.View[0].Result[0];
            var content = location.Location.Address.Label;
            meetUpDetails = content;
            var country = location.Location.Address.Country;
            var state = location.Location.Address.State;
            var county = location.Location.Address.county;
            var city = location.Location.Address.City;
            var postalCode = location.Location.Address.PostalCode;            
            console.log(response);
            var gmapContent = content.replace(" ","%20");
            document.getElementById("gmap_canvas").src="https://maps.google.com/maps?q="+gmapContent+"&t=&z=15&ie=UTF8&iwloc=&output=embed";
            var data = "<h3>You can meet Halfway at<br>  "+content+"</b>"+"<br><br>City: "+city+"<br>"+"State: "+state+"<br>Country: "+country+"<br>Postal Code: "+postalCode+"</h3>"; 
            document.getElementById("wrapperMidway").style.display="block";
            document.getElementById("midpointData").innerHTML=data;
          });
  }

  function showMap(){
    var src= "http://image.maps.cit.api.here.com/mia/1.6/routing?app_id="+app_id+"&app_code="+app_code+"&waypoint0="+latSrc+","+lngSrc+"&waypoint1="+latDest+","+lngDest+"&lc=1652B4&lw=6&t=0&ppi=320&w=900&h=630";
    document.getElementById("pic").src=src;

    
  }

  function showPosition() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(findCurrentLocation);
    } else { 
      x.innerHTML = "Geolocation is not supported by this browser.";

    }

  }

  function findCurrentLocation(position){


    var lat = position.coords.latitude;
    var lon =  position.coords.longitude;
    var radius = 0;



    var reverseGeocoderAPISrc = new HttpClient();
    reverseGeocoderAPISrc.get('https://reverse.geocoder.api.here.com/6.2/reversegeocode.json?app_id='+app_id+'&app_code='+app_code+'&prox='+lat+','+lon+','+radius+'&mode=retrieveAddresses&maxresults=1', function(response) {
        // do something with response
        let result = JSON.parse(response);
        var location = result.Response.View[0].Result[0];
        var content = location.Location.Address.Label;
        var country = location.Location.Address.Country;
        var state = location.Location.Address.State;
        var county = location.Location.Address.county;
        var city = location.Location.Address.City;
        var postalCode = location.Location.Address.PostalCode;            
        console.log(response);
        var gmapContent = content.replace(" ","%20");
        document.getElementById("currLoc").src="https://maps.google.com/maps?q="+gmapContent+"&t=&z=15&ie=UTF8&iwloc=&output=embed";

        

      });


  }



//getSrc(src);
function route(){
  src = document.getElementById("user1").value;
  destTemp = document.getElementById("user2").value;
  var  options = document.querySelectorAll('#userLocations option');
  var flag = 0;
  for(var i = 0; i < options.length; i++) {
    var option = options[i];

    if(option.innerText === destTemp) {
      dest = option.getAttribute('data-value');
      flag=1;
      break;
    }
  }
  if(flag==0){
    alert('Invalid username.');
    return;
  }
  alert(src+" "+dest);
  getSrc(src);
  document.getElementById("wrapperRoute").style.display="block";
  document.getElementById("src").innerHTML = "Source : "+src;
  document.getElementById("dest").innerHTML = "Destination : "+dest;
}

function findMidPoint(){
  midPoint(latSrc,lngSrc,latDest,lngDest);

}
showPosition();
function sendInviteMail () {
  var str = `<?php
    $name = $_SESSION["name"];
    $username = $_SESSION["username"];
    $email=$_SESSION["email"];
    echo $name."\n".$username."\n".$email;
  ?>`;

  var name = str.split ('\n')[0];
  var user1 = str.split ('\n')[1];
  var email1 = str.split("\n")[2] 
  var user2 = document.getElementById ('user2').value;
  var xhr = new XMLHttpRequest ();
  var url = '../db/sendMail.php';
  var response;
  var params = 'name='+name.toString () + '&user1='+user1.toString () + '&email1=' + email1.toString() + '&user2='+user2.toString () + '&details='+meetUpDetails;
  var sendData = url + '?'+params;
  xhr.open ('GET', sendData, true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      response = xhr.responseText;
      alert(response);
    }
  };
  xhr.send ();
}

</script>
</html>