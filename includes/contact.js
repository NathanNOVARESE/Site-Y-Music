let map;

async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");

  map = new Map(document.getElementById("map"), {
    center: { lat: 43.615171970344804, lng: 7.05530506998268},
    zoom: 18,
  });
}

initMap();