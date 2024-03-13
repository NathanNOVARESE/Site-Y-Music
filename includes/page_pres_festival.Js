let map;

async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");

  map = new Map(document.getElementById("map"), {
    center: { lat: 48.85893137547438,  lng: 2.229622078566182},
    zoom: 18,
  });
}

initMap();