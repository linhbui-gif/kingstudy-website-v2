$(document).ready(function() {
    var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib }),
        map = new L.Map('mapid', { center: new L.LatLng(51.505, -0.04), zoom: 13 }),
        drawnItems = L.featureGroup().addTo(map);
    L.control.layers({
        'osm': osm.addTo(map)
    }).addTo(map);
    map.addControl(new L.Control.Draw({
        edit: {
            featureGroup: drawnItems,
            poly: {
                allowIntersection: false
            }
        },
        draw: {
            polygon: {
                allowIntersection: false,
                showArea: true
            }
        }
    }));

    map.on(L.Draw.Event.CREATED, function (event) {
        var layer = event.layer;

        drawnItems.addLayer(layer);
    });

//add full screen============
    L.control.fullscreen({
        position: 'topleft', // change the position of the button can be topleft, topright, bottomright or bottomleft, defaut topleft
        title: 'Xem toàn màn hình', // change the title of the button, default Full Screen
        titleCancel: 'Thoát xem toàn màn hình', // change the title of the button when fullscreen is on, default Exit Full Screen
        content: null, // change the content of the button, can be HTML, default null
        forceSeparateButton: true, // force seperate button to detach from zoom buttons, default false
        forcePseudoFullscreen: true, // force use of pseudo full screen even if full screen API is available, default false
        fullscreenElement: false // Dom element to render in full screen, false by default, fallback to map._container
    }).addTo(map);

// events are fired when entering or exiting fullscreen.
    map.on('enterFullscreen', function(){
        console.log('entered fullscreen');
    });

    map.on('exitFullscreen', function(){
        console.log('exited fullscreen');
    });

    //tab BDS====
    var osmUrl1 = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        osmAttrib1 = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap1</a> contributors1',
        osm1 = L.tileLayer(osmUrl1, { maxZoom: 18, attribution: osmAttrib1 }),
        map1 = new L.Map('mapBDS', { center: new L.LatLng(51.505, -0.04), zoom: 13 });
    L.control.layers({
        'osm': osm1.addTo(map1)
    }).addTo(map1);

    //add full screen============
    L.control.fullscreen({
        position: 'topleft', // change the position of the button can be topleft, topright, bottomright or bottomleft, defaut topleft
        title: 'Xem toàn màn hình', // change the title of the button, default Full Screen
        titleCancel: 'Thoát xem toàn màn hình', // change the title of the button when fullscreen is on, default Exit Full Screen
        content: null, // change the content of the button, can be HTML, default null
        forceSeparateButton: true, // force seperate button to detach from zoom buttons, default false
        forcePseudoFullscreen: true, // force use of pseudo full screen even if full screen API is available, default false
        fullscreenElement: false // Dom element to render in full screen, false by default, fallback to map._container
    }).addTo(map1);

// events are fired when entering or exiting fullscreen.
    map1.on('enterFullscreen', function(){
        console.log('entered fullscreen');
    });

    map1.on('exitFullscreen', function(){
        console.log('exited fullscreen');
    });



    var marker = L.marker([51.505, -0.04]).addTo(map1);
    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("Vị trí BDS đang xem ")
            .openOn(map1);
    }

    map1.on('click', onMapClick);
});