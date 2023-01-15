let map

document.addEventListener('DOMContentLoaded', () => {
  const markers = [
    L.marker([53.44815708925936, 14.491341847157033]),
    L.marker([53.44717310016246, 14.4919106403078]),
    L.marker([53.44815708925936, 14.491341847157033]),
    L.marker([53.44717310016246, 14.4919106403078])
  ]

  const ctx = document.querySelector('#map')
  map = L.map(ctx).setView([53.44815708925936, 14.491341847157033], 5)
  map.removeControl(map.zoomControl)
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map)

  function transition(index) {
    // Get the map object

    map.flyTo(markers[index].getLatLng(), 18, {
      duration: 5,
    })

    index = (index + 1) % markers.length

    map.on('moveend', function () {
      transition(index)
    })
  }

  // Start the animation by calling the transition function
  transition(0)
})
