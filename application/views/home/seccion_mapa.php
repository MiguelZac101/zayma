<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDJiixD2CSzLDTLAT8UCIFngjFc86vK-ZE&sensor=false&extension=.js'></script> 
 
<script> 
    google.maps.event.addDomListener(window, 'load', init);
    var map;
    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(-12.090847,-76.987514),
            zoom: 15,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT,
            },
            disableDoubleClickZoom: true,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            },
            scaleControl: true,
            scrollwheel: true,
            panControl: true,
            streetViewControl: true,
            draggable : true,
            overviewMapControl: true,
            overviewMapControlOptions: {
                opened: false,
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: 
                    [
    {
        "stylers": [//terreno
            { "hue": "#ecebe0" },
            { "saturation": 50 }
        ]
    },
    {// Estos incluyen carreteras, parques, cuerpos de agua, y más, así como de sus etiquetas.
        "featureType": "all",
        "elementType": "geometry",
        "stylers": [
            { "hue": "#c2bc9f" },
            { "saturation": -70 },
//            { "lightness": -20},
            { "invert_lightness": false}
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels",
        "stylers": [
            { "hue": "#c2bc9f" },
            { "saturation": -70 },
            { "invert_lightness": false}
        ]
    }
]
//            [ 
//                { "stylers": 
//                    [ 
//                        { "saturation": -100 }, 
//                        { "gamma": 0.8 }, 
//                        { "lightness": 4 }, 
//                        { "visibility": "on" },
//                        { "hue": "#2c3e50"}
////                        ,
////                        { "color": "#ecebe0" }
//                    ] 
//                }
//                ,
//                { "featureType": 
//                    "landscape.natural", 
//                    "stylers": 
//                        [ 
//                            { "visibility": "on" }, 
//                            { "color": "#FFFFFF" }, 
//                            { "gamma": 4.97 }, 
//                            { "lightness": -5 }, 
//                            { "saturation": 100 } 
//                        ] 
//                } 
//            ]
            ,
        }
        var mapElement = document.getElementById('mapa_zayma');
        var map = new google.maps.Map(mapElement, mapOptions);
        var locations = [
['titulo', 'venta de calzado cuero', 'telefono', 'email', 'www.zayma.pe', -12.085718,  -76.976249, 'http://zayma.pe/images/marca_mapa.png'],['title', 'zayma', '123456678', 'email', 'http:zay,a.pe', -12.0972833, -76.99510409999999, 'http://zayma.pe/images/marca_mapa.png']
        ];
        for (i = 0; i < locations.length; i++) {
			if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
			if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
			if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
           if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
           if (locations[i][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
            marker = new google.maps.Marker({
                icon: markericon,
                position: new google.maps.LatLng(locations[i][5], locations[i][6]),
                map: map,
                title: locations[i][0],
                desc: description,
                tel: telephone,
                email: email,
                web: web
            });
link = '';     }

}
</script>
<style>
    #mapa_zayma {
        height:450px;
        width:1600px;
        /*width: 100%;*/
    }
    .gm-style-iw * {
        display: block;
        width: 100%;
    }
    .gm-style-iw h4, .gm-style-iw p {
        margin: 0;
        padding: 0;
    }
    .gm-style-iw a {
        color: #4272db;
    }
</style>

<div id='mapa_zayma'></div>