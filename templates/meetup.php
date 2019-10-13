<?php
    session_start();
    include ('../config/db_connect.php');
?>




<html>
<head>
    <link rel="stylesheet" type="text/css" href="../styles/meetup.css"> 
</head>
<body>


<datalist id="userLocations">
    <?php
    $sql="SELECT firstname,city,`state` from user";
    $res=$conn->query($sql);
    while($r=$res->fetch_assoc()):
        ?>
        <option data-value=<?= $r["city"].",".$r["state"] ?>><?php echo $r["firstname"]." - ".$r['city'].",".$r["state"] ?></option>
    <?php endwhile; ?>

</datalist>


<div id="wrapperCurrentLocation">
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
            <div>
                <h1>Meet Midway!</h1>
                <br><br>
                <span class="subtitle">My Favourable Location:</span>
                <br><br>
                <input type="text"  value="" id="user1">
                <br><br>
                <span class="subtitle">I wanna meet:</span>
                <br><br>
                <input type="text" list="userLocations" value="" id="user2">
                <br><br>
                <a class="submit-btn" onclick="route()" href="#wrapperRoute">Explore Route</a>
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
                    <div style="margin:20px;">
                        <h1>Here's your route!</h1>
                        <hr>
                        <br>
                        <h2 id = "src">Source : </h2>
                        <h2 id = "dest">Destination : </h2>
                        <br>
                        <a class="submit-btn" onclick="findMidPoint()" href="#wrapperMidway">Find Halfway</a>
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
                    <div style="margin:20px;">
                        <div id="midpointData">

                        </div>
                        <br>
                        <button class="submit-btn" onclick="#">Invite To Meet</button>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div> 


</body>
<script>

var latSrc="",latDest="",lngSrc="",lngDest="",src="",dest="";

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
    geocoderAPISrc.get('https://geocoder.api.here.com/6.2/geocode.json?app_id=zeI2BlhgRBZQiOrhtS1i&app_code=tS_8ziIKRg9jQkw_4lmezw&searchtext='+src, function(response) {
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
    var pos = geocoderAPIDest.get('https://geocoder.api.here.com/6.2/geocode.json?app_id=zeI2BlhgRBZQiOrhtS1i&app_code=tS_8ziIKRg9jQkw_4lmezw&searchtext='+dest, function(response) {
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
        reverseGeocoderAPISrc.get('https://reverse.geocoder.api.here.com/6.2/reversegeocode.json?app_id=zeI2BlhgRBZQiOrhtS1i&app_code=tS_8ziIKRg9jQkw_4lmezw&prox='+newLat+','+newLon+','+radius+'&mode=retrieveAddresses&maxresults=1', function(response) {
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
            document.getElementById("gmap_canvas").src="https://maps.google.com/maps?q="+gmapContent+"&t=&z=15&ie=UTF8&iwloc=&output=embed";
            var data = "<h2>You can meet Halfway at<br> <b style='color:#57d3386e;'> "+content+"</b>"+"<br><br>Address: <br>City: <b style='color:#57d3386e;'>"+city+"</b><br>"+"State: <b style='color:#57d3386e;'>"+state+"</b><br>Country: <b style='color:#57d3386e;'>"+country+"</b><br>Postal Code: <b style='color:#57d3386e;'>"+postalCode+"</b></h2>"; 
            document.getElementById("wrapperMidway").style.display="block";
            document.getElementById("midpointData").innerHTML=data;

        

        });
        

}
   
function showMap(){
    var src= "http://image.maps.cit.api.here.com/mia/1.6/routing?app_id=zeI2BlhgRBZQiOrhtS1i&app_code=tS_8ziIKRg9jQkw_4lmezw&waypoint0="+latSrc+","+lngSrc+"&waypoint1="+latDest+","+lngDest+"&lc=1652B4&lw=6&t=0&ppi=320&w=900&h=630";
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
    reverseGeocoderAPISrc.get('https://reverse.geocoder.api.here.com/6.2/reversegeocode.json?app_id=zeI2BlhgRBZQiOrhtS1i&app_code=tS_8ziIKRg9jQkw_4lmezw&prox='+lat+','+lon+','+radius+'&mode=retrieveAddresses&maxresults=1', function(response) {
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
  	for(var i = 0; i < options.length; i++) {
  		var option = options[i];

  		if(option.innerText === destTemp) {
  			dest = option.getAttribute('data-value');
  			break;
  		}
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
</script>
</html>

