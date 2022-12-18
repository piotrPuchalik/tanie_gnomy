function inicjalizacjaMapy(x,y,div)
{
	map = L.map(div).setView([x, y], 17); //inicjalizacja mapy (współrzędne)
	
	L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
	}).addTo(map); //Utworzenie mapy
	
	var marker = L.marker([x, y]).addTo(map); //Dodanie znacznika do mapy
}

WI1=document.getElementById('mapWI1');
WI2=document.getElementById('mapWI2');
WI1_X=53.447174		//współrzędna geograficzna X budynku WI1
WI1_Y=14.491944		//współrzędna geograficzna Y budynku WI1
WI2_X=53.448602		//współrzędna geograficzna X budynku WI2
WI2_Y=14.491277		//współrzędna geograficzna Y budynku WI2


inicjalizacjaMapy(WI1_X,WI1_Y,WI1) // utworzenie mapy dla budynku WI1
inicjalizacjaMapy(WI2_X,WI2_Y,WI2) // utworzenie mapy dla budynku WI2

function planWI1(){
	alert("do sekcji plan WI1");
}
function planWI2(){
	alert("do sekcji plan WI2");
}