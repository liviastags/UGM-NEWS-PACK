<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="DIVSIG UGM">
    <meta name="description" content="leaflet basic">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css">
    
    <!-- Search CSS Library -->
    <link rel="stylesheet" href="assets/plugins/leaflet-search/leaflet-search.css" />

    <!-- Geolocation CSS Library for Plugin -->
    <link rel="stylesheet" href="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.css" />

    <!-- Leaflet Mouse Position CSS Library -->
    <link rel="stylesheet" href="assets/plugins/leaflet-mouseposition/L.Control.MousePosition.css" />

    <!-- Leaflet Measure CSS Library -->
    <link rel="stylesheet" href="assets/plugins/leaflet-measure/leaflet-measure.css" />

    <!-- EasyPrint CSS Library -->
    <link rel="stylesheet" href="assets/plugins/leaflet-easyprint/easyPrint.css" />

    <!-- Marker Cluster -->
    <link rel="stylesheet" href="assets/plugins/leaflet-markercluster/MarkerCluster.css">
    <link rel="stylesheet" href="assets/plugins/leaflet-markercluster/MarkerCluster.Default.css">

    <!-- Routing -->
    <link rel="stylesheet" href="assets/plugins/leaflet-routing/leaflet-routing-machine.css" />

    <!-- Judul pada tab browser -->
    <title>Persebaran Toko Metro Kampus</title>

    <!-- Tab browser icon -->
    <link rel="icon" type="image/x-icon" href="http://luk.staff.ugm.ac.id/logo/UGM/Resmi/Warna.gif">

    <style>
        /* Tampilan peta fullscreen */
        html,
        body,
        #map {
            height: 100%;
            width: 100%;
            margin: 0px;
        }

        /* Background pada Judul */
    *.info {
    padding: 6px 8px;
    font: 14px/16px Arial, Helvetica, sans-serif;
    background: white;
    background: rgba(255,255,255,0.8);
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 5px;
    text-align: center;
    }
    
    </style>
</head>

<body>
<div class="col-sm-10">

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Search JavaScript Library -->
<script src="assets/plugins/leaflet-search/leaflet-search.js"></script>

<!-- Geolocation Javascript Library -->
<script src="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js"></script>

<!-- Leaflet Mouse Position JavaScript Library -->
<script src="assets/plugins/leaflet-mouseposition/L.Control.MousePosition.js"></script>

<!-- Leaflet Measure JavaScript Library -->
<script src="assets/plugins/leaflet-measure/leaflet-measure.js"></script>

<!-- EasyPrint JavaScript Library -->
<script src="assets/plugins/leaflet-easyprint/leaflet.easyPrint.js"></script>
<div id="map" style="height: 100vh;"></div>

<!-- Marker Cluster -->
<script src="assets/plugins/leaflet-markercluster/leaflet.markercluster.js"></script>
<script src="assets/plugins/leaflet-markercluster/leaflet.markercluster-src.js"></script>

<!-- Routing -->
<script src="assets/plugins/leaflet-routing/leaflet-routing-machine.js"></script>
<script src="assets/plugins/leaflet-routing/leaflet-routing-machine.min.js"></script>
    <div id="map"></div> 

    <script>
        /* Initial Map */
        var map = L.map('map').setView([-7.794760241050732, 110.36718249219427], 13); //lat, long, zoom
        /* Tile Basemap */
        var basemap1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | <a href="DIVSIG UGM" target="_blank">DIVSIG UGM</a>' //menambahkan nama//
        });
        var basemap2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{ z } / { y } / { x }',
            {
                attribution: 'Tiles &copy; Esri | <a href="Latihan WebGIS" target="_blank">DIVSIG UGM</a>'
            });
        var basemap3 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{ z } / { y } / { x }',
            {
                attribution: 'Tiles &copy; Esri | <a href="Lathan WebGIS" target="_blank">DIVSIG UGM</a>'
            });
        var basemap4 = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptile s.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
        });
        basemap1.addTo(map);

         // Title
      var title = new L.Control();
      title.onAdd = function (map) {
        this._div = L.DomUtil.create("div", "info");
        this.update();
        return this._div;
      };
      title.update = function () {
        this._div.innerHTML =
          "<h2>PERSEBARAN TOKO METRO KAMPUS</h2>";
      };
      title.addTo(map);

/* Control Layer */
var baseMaps = {
            "OpenStreetMap": basemap1,
            "Esri World Street": basemap2,
            "Esri Imagery": basemap3,
            "Stadia Dark Mode": basemap4
        };
        var overlayMaps = {
            // "Gedung B DIVSIG UGM": marker1,
            // "RS.Akademik UGM": marker2,
        };
        L.control.layers(baseMaps, overlayMaps, { collapsed: false }).addTo(map);

        /* Scale Bar */
        L.control.scale({
            maxWidth: 150, position: 'bottomright'
        }).addTo(map); 


        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "responsi";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM metro";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $lat = $row["Latitude"];
                $long = $row["Longitude"];
                $info = $row["Nama"];
                echo "L.marker([$lat, $long]).addTo(map).bindPopup('$info');";
            } 
        }
        else {
            echo "0 results";
        }
            $conn->close();
    ?>

    
        // Create a GeoJSON layer for polygon data
        var wfsgeoserver1 = L.geoJson(null, {
        style: function (feature) {
          // Adjust this function to define styles based on your polygon properties
          var value = feature.properties.jumlah; // Change this to your actual property name
          return {
            fillColor: getColor(value),
            weight: 2,
            opacity: 1,
            color: "white",
            dashArray: "3",
            fillOpacity: 0.7,
          };
        },
        onEachFeature: function (feature, layer) {
          // Adjust the popup content based on your polygon properties
          var content =
            "Kecamatan: " +
            feature.properties.kecamatan +
            "<br>" +
            "Jumlah Penduduk: " +
            feature.properties.jumlah_pen +
            "<br>";

          layer.bindPopup(content);
        },
      });

      // Fetch GeoJSON data from geoserver.php
      $.getJSON("wfsgeoserver1.php", function (data) {
        wfsgeoserver1.addData(data);
        wfsgeoserver1.addTo(map);
        map.fitBounds(wfsgeoserver1.getBounds());
      });

      
    /* Image Watermark */
    L.Control.Watermark = L.Control.extend({
    onAdd: function(map) {
    var img = L.DomUtil.create('img');
    img.src = 'assets/img/logo/LOGO_SIG_BLUE.png';
    img.style.width = '200px';
    return img;
    }
    });

    L.control.watermark = function(opts) {
    return new L.Control.Watermark(opts);
    }
    L.control.watermark({ position: 'bottomleft' }).addTo(map);


    /* Image Legend */
    L.Control.Legend = L.Control.extend({
    onAdd: function(map) {
    var img = L.DomUtil.create('img');
    img.src = 'assets/img/legend/metro1.jpg';
    img.style.width = '250px';
    return img;
    }
    });

    L.control.Legend = function(opts) {
    return new L.Control.Legend(opts);
    }

    L.control.Legend({ position: 'bottomleft' }).addTo(map);


    /*Plugin Search */
    var searchControl = new L.Control.Search({
        position: "topleft",
        layer: wfsgeoserver1, //Nama variabel layer
        propertyName: "Kecamatan", //Field untuk pencarian
        marker: false,
        moveToLocation: function (latlng, title, map) {
            var zoom = map.getBoundsZoom(latlng.layer.getBounds());
            map.setView(latlng, zoom);
        },
        });
        searchControl
        .on("search:locationfound", function (e) {
        e.layer.setStyle({
            fillColor: "#ffff00",
            color: "#0000ff",
        });
        })
        .on("search:collapse", function (e) {
        featuresLayer.eachLayer(function (layer) {
        featuresLayer.resetStyle(layer);
        });
        });
        map.addControl(searchControl);

         /*Plugin Geolocation */
        var locateControl = L.control
        .locate({
        position: "topleft",
        drawCircle: true,
        follow: true,
        setView: true,
        keepCurrentZoomLevel: false,
        markerStyle: {
            weight: 1,
            opacity: 0.8,
            fillOpacity: 0.8,
        },
        circleStyle: {
            weight: 1,
            clickable: false,
        },
        icon: "fas fa-crosshairs",
        metric: true,
        strings: {
            title: "Click for Your Location",
            popup: "You're here. Accuracy {distance} {unit}",
            outsideMapBoundsMsg: "Not available",
        },
        locateOptions: {
            maxZoom: 16,
            watch: true,
            enableHighAccuracy: true,
            maximumAge: 10000,
            timeout: 10000,
        },
        })
        .addTo(map);

        /*Plugin Mouse Position Coordinate */
        L.control.mousePosition({ position: "bottomright", separator: ",", prefix: "Point Coodinate: " }).addTo(map);



/*Plugin Measurement Tool */
        var measureControl = new L.Control.Measure({
        position: "topleft",
        primaryLengthUnit: "meters",
        secondaryLengthUnit: "kilometers",
        primaryAreaUnit: "hectares",
        secondaryAreaUnit: "sqmeters",
        activeColor: "#FF0000",
        completedColor: "#00FF00",
        });
        measureControl.addTo(map);

        /*Plugin EasyPrint */
        L.easyPrint({
        title: "Print",
            }).addTo(map);

            map.addLayer(markers);
      //Function to determine the color based on the 'value' attribute
      function getColor(value) {
  return value < 50000
    ? "#74a9cf"    // Warna biru tua untuk nilai di bawah 50000
    : value >= 50000 && value <= 75000
    ? "#74a9cf"  // Warna biru muda untuk nilai antara 50000 dan 75000
    : value > 75000
    ? "#74a9cf" // Warna biru cerah untuk nilai di atas 75000
    : "#74a9cf"; // Warna default jika nilai kurang dari atau sama dengan 10
}


        
    </script>
</body>

</html>