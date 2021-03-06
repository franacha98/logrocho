<html>

<head>
    <title>Logrocho - Mapa</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../estilos/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../estilos/css/estilos-administracion.css" />
    <link rel="stylesheet" href="../estilos/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css">
    <style>
        .map {
            height: 400px;
            width: 100%;
        }

        #popup {
            background-color: red;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.12.0/build/ol.js"></script>
</head>

<body>
    <?php
    include "menu-publico.php";
    ?>

    <div class="page-content p-5" id="content">
        <select id="bares" hidden>
            <?php  
                for($i = 0; $i < $num_bares; $i++){
                    echo "<option id='".$bares[$i]->getCod_bar()."' value='".$bares[$i]->getLatitud()."'>".$bares[$i]->getLongitud()."</option>";
                }
            ?>
        </select>
        <input type="hidden" value="<?php echo $rutaMarkers; ?>" id="ruta" />
        <input type="hidden" value="<?php echo $num_bares; ?>" id="numbares" />
        <div id="map">
            <div id="popup"></div>
        </div>

    </div>
    <?php
    include "footer.php";
    ?>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.1.1/build/ol.js"></script>
    <script>
        let numbares = parseInt($("#numbares").val());
        let markers = [];

        let select = document.getElementById("bares");  
        for (let i = 0; i < select.children.length; i++) {
            let opt = select.children[i];
            let mark = new ol.Feature({
                geometry: new ol.geom.Point(ol.proj.fromLonLat([opt.text, opt.value])),
                name: opt.id,
            });
            markers.push(mark);
        }
        const map = new ol.Map({
            target: 'map',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM(),
                }),
                new ol.layer.Vector({
                    source: new ol.source.Vector({
                        features: markers //[iconFeature, m2]
                    }),
                    style: new ol.style.Style({
                        image: new ol.style.Icon({
                            anchor: [0.5, 46],
                            anchorXUnits: 'fraction',
                            anchorYUnits: 'pixels',
                            src: 'https://openlayers.org/en/latest/examples/data/icon.png'
                        })
                    })
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([-2.4479341134196537, 42.46566052532229]),
                zoom: 18
            })
        });

        map.on('click', function(evt) {
            var feature = map.forEachFeatureAtPixel(evt.pixel, function(feat, layer) {
                return feat;
            });
            if (feature != undefined) {
                let rutaMarkers = $("#ruta").val();
                let barID = feature.get('name');
                window.location.href = rutaMarkers + barID;
            }


        });
    </script>
</body>

</html>