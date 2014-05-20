<html>
  <head>
    <title>HACK4MED</title>
     <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
     <meta charset="utf-8">
     
<style>	  
	html, body, #map-canvas
	{
		height:100%;
		background:#a6cb53;
		margin: 0px;
		padding: 0px
	}
	#infobox 
	{
		color:#FFF;
		font-family:Arial, Helvetica, sans-serif;
		font-size:12px;
		padding: .5em 1em;
		text-align:center;
	}
	@font-face 
	{
        font-family: "Hangyaboly";
        src: url('Fonts/541625977-Hangyaboly.eot');
        src: url('Fonts/541625977-Hangyaboly.eot?#iefix') format('embedded-opentype'),
        url('Fonts/541625977-Hangyaboly.svg#Hangyaboly') format('svg'),
        url('Fonts/541625977-Hangyaboly.woff') format('woff'),
        url('Fonts/541625977-Hangyaboly.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }
.mapBtn
{
	 right:0%; 
	 width:15%;
	 height:6%;
	 background:#a6cb53;
	 font-family:'Hangyaboly'; 
	 font-weight:bold;
	 color:#FFF;
	 font-size:16px;
	 cursor: pointer;
	 text-align:center;
	 position:absolute; 
}

</style>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>
</head>

<body>
    <div id="map-canvas" style="position:absolute; left:0%; width:100%; height: 80%; top:20%;"></div>
    <img style="position:absolute; left:89%; width:10%; top:2%;" src="immagini/Logo.png" alt="" />
    <div style="position:absolute; height:80%; top:20%; background:#558836; right:0%; width:17%; opacity:0.8;" ></div>
    <div style=" font-family:'Hangyaboly'; font-weight:bold; position:absolute; left:65%; width:30%; height:10%; top:6%; color:#558836; font-size:60px;">Km0Farms</div>
    <div style="position:absolute; left:0%; width:100%; height:2%; top:18%; background:#558836;"></div>
    <p style="font-family:'Hangyaboly'; font-weight:bold; position:absolute; font-size:30px; left:2.5%; top:5%; width:48%; height:5%; color:#558836;">Highest number of districts: <input type="number" id="Number" style="font-family:'Hangyaboly'; font-weight:bold; color:#558836; font-size:25px; position:absolute; left:75%; width:25%; height:100%; top:0%;" min="0" max="540" value="5"/></p>

<div style="top:20%;" id="btn0" class="mapBtn">farms</div>
<div style="top:28%;" id="btn1" class="mapBtn">biological farms</div>
<div style="top:36%;" id="btn2" class="mapBtn">ranch farms</div>
<div style="top:44%;" id="btn3" class="mapBtn">district surface</div>
<div style="top:52%;" id="btn4" class="mapBtn">seeded surface</div>
<div style="top:60%;" id="btn5" class="mapBtn">grapevine farming surface</div>
<div style="top:68%;" id="btn6" class="mapBtn">wood farming surface</div>
<div style="top:76%;" id="btn7" class="mapBtn">vegetable gardens surface</div>
<div style="top:84%;" id="btn8" class="mapBtn">grazing lands</div>
<div style="top:92%;" id="btn9" class="mapBtn">forests</div>
<script>
	var Agrimap = new Array();
	var MaxDimension=5;
	
	
	var styles = [
		{
			"featureType": "water",
			"stylers": [
				{
					"visibility": "on"
				},
				{
					"color": "#acbcc9"
				}
			]
		},
		{
			"featureType": "landscape",
			"stylers": [
				{
					"color": "#f2e5d4"
				}
			]
		},
		{
			"featureType": "road.highway",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#c5c6c6"
				}
			]
		},
		{
			"featureType": "road.arterial",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#e4d7c6"
				}
			]
		},
		{
			"featureType": "road.local",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#fbfaf7"
				}
			]
		},
		{
			"featureType": "poi.park",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#c5dac6"
				}
			]
		},
		{
			"featureType": "administrative",
			"stylers": [
				{
					"visibility": "on"
				},
				{
					"lightness": 33
				}
			]
		},
		{
			"featureType": "road"
		},
		{
			"featureType": "poi.park",
			"elementType": "labels",
			"stylers": [
				{
					"visibility": "on"
				},
				{
					"lightness": 20
				}
			]
		},
		{},
		{
			"featureType": "road",
			"stylers": [
				{
					"lightness": 20
				}
			]
		}
	];
	
	
	function DrawPlaces()
	{
		for(var i=0; i < Agrimap.length; i++)
		{
			if(i==0)
			{
				MaxDimension=(Agrimap[i].population/60)+5;
			}
			var scale=((Agrimap[i].population/60)+5)*30/MaxDimension;
			if(scale<MaxDimension/10)
			{
				scale=MaxDimension/10;
			}
			
			var Circle = 
			{
				path: google.maps.SymbolPath.CIRCLE,
				strokeColor: '#558836',
				strokeWeight: 1,
				fillColor: '#558836',
				fillOpacity: 0.4,
				scale: scale
			};
						
			AgriCircle[i] = new google.maps.Marker(
			{
				position: Agrimap[i].center,
				icon:Circle,
				map: map
			});
						
			//!!!!!!!!!!!!!//
			var ac = AgriCircle[i];
			var am = Agrimap[i];
			attachEvents(ac,am);
			
		}
	}
	
	var attachEvents = function(ac, am) {
		google.maps.event.addListener(ac, 'mouseover', function() {
			
			if (infowindow)
			{
				infowindow.close();
			}
			CircleInfo(ac, am);
		});
	};
	
	var AgriCircle=new Array();
	var map;
	var infowindow;
	var QueryType="btn0";
	
	function initialize() 
	{
		var myOptions = 
		{
			zoom: 8,
			center: new google.maps.LatLng(45.765683, 11.728782),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles: styles, 
			disableDoubleClickZoom: true,
			disableDefaultUI: true
		};
		
		map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);
		
		$.get("Search.php",{Type:'btn0'}, function(data)
		{
			
			for (var i = 0; i < data.length; i++) 
			{
				var d = data[i];
				
				Agrimap.push({
			  	center: new google.maps.LatLng(d.lat,d.lng),
			  	population: d.population,
			  	name: d.comune
				});
			}
			
			DrawPlaces();
			
		}, 'json');
			
		google.maps.event.addListener(map, 'click', function() 
		{
			infowindow.close();
		});
	}
	
	function CircleInfo(marker,pass)
	{
		var boxText = document.createElement("div");
		boxText.innerHTML = "<div id='infobox' style='width:140px; height:140px;'><img src='immagini/Box.png' style='position:absolute; left:0%; top:0%; width:140px; height:140px;' alt='' /><span style='position:absolute; left:10%; width:80%; top:10%; height:80%;'><h1 style='font-size:20px; font-weight:bold; font-family:Hangyaboly;'>"+pass.name+"</h1>"+pass.population+" matches</span></div>";
			
	  	infowindow = new InfoBox(
		{
			content: boxText,
			pixelOffset: new google.maps.Size(-70, -70),
			boxStyle: 
			{
				opacity: 1,
				width: "140px"
			},
			closeBoxURL: "",
			infoBoxClearance: new google.maps.Size(1, 1)
		});
	  	infowindow.open(map,marker);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
	
	$("#Search").click( function()
	{
		$.get("Search.php",{Type:this.id}, function(data)
		{
			var myOptions = 
			{
				zoom: 8,
				center: new google.maps.LatLng(45.765683, 11.728782),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				styles: styles, 
				disableDoubleClickZoom: true,
				disableDefaultUI: true
			};
			
			map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);
			
			Agrimap=new Array();
			for (var i = 0; i < data.length; i++) 
			{
				var d = data[i];
				
				Agrimap.push({
			  	center: new google.maps.LatLng(d.lat,d.lng),
			  	population: d.population,
			  	name: d.comune
				});
			}
			
			DrawPlaces();
			
		}, 'json');
	});
		
	$(".mapBtn").click( function()
	{
		$.get("Search.php",{Type:this.id}, function(data)
		{
			var myOptions = 
			{
				zoom: 8,
				center: new google.maps.LatLng(45.765683, 11.728782),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				styles: styles, 
				disableDoubleClickZoom: true,
				disableDefaultUI: true
			};
			
			map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);
			
			Agrimap=new Array();
			for (var i = 0; i < data.length; i++) 
			{
				var d = data[i];
				
				Agrimap.push({
			  	center: new google.maps.LatLng(d.lat,d.lng),
			  	population: d.population,
			  	name: d.comune
				});
			}
			
			DrawPlaces();
			
		}, 'json');
	});


</script>
</body>
</html>


