<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Property GIS</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   <style>
       #mapid { height: 580px; }
   </style>
</head>
<body>
    <div id="mapid"></div>
</body>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
   crossorigin=""></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.js"></script>
   <script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>
   <script>
    var output_dto = <?php echo json_encode($data); ?>;

    console.log(output_dto);

    var mymap = L.map('mapid').setView([-7.6040067, 110.2724633], 12);
    var accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token='+accessToken, {
	    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	    maxZoom: 18,
	    id: 'mapbox.streets',
	    accessToken: 'your.mapbox.access.token'
    }).addTo(mymap);
    for(var i=0;i<output_dto.length;i++){

        var marker = L.marker([output_dto[i].latitude, output_dto[i].longitude]).addTo(mymap).bindPopup("<p><b>"+output_dto[i].name+"</b></p><p>Type: "+output_dto[i].travel_type+"</p><p>Address:<br>"+output_dto[i].address+"</p><p>Price: IDR "+output_dto[i].price_from+" - IDR "+output_dto[i].price_to+"</p>").openPopup();

    }
    

   </script>
</html>