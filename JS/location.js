function initMap() {
    var location = { lat: 37.7749, lng: -122.4194 }; 
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: location
    });

    var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3872.2106946604517!2d121.1619312!3d13.9460568!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd6c9867b59525%3A0x9ac1b5e6cd9cfd2f!2sAngel&#39;s%20BURGER!5e0!3m2!1sen!2sph!4v1701786025066!5m2!1sen!2sph" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade'
    });
}