
function initMap() {
    var uluru = {lat: 45.764043, lng: 4.835658999999964};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: uluru
    });

    var coordinate =  document.getElementsByClassName('arrayjson');

    for(var i = 0; i < coordinate.length; i++) {
        (function(index){
            var elements =  JSON.parse(coordinate[i].value);
            var contentString = '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<h1 id="firstHeading" class="firstHeading">' + elements.name + '</h1>' +
                '<div id="bodyContent">' +
                '<p>' + elements.address + '<br>' +
                elements.postal + '<br>' +
                elements.city + '<br>' +
                elements.number + '<br>' +
                elements.mail + '<br>' +
                '</p>' +
                '</div>' +
                '</div>';
            var infoWindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 200
            });
            var localisation = {lat: elements.latitude, lng: elements.longitude}
            var marker = new google.maps.Marker({

                position: localisation,
                map: map,
                title: elements.name
            });
            marker.addListener( 'click', function () {
                infoWindow.open(map, marker);
            });
        })(i);
    }

}