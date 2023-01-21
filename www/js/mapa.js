function inicjalizacjaMapy(x,y,x1,y2,x2,y2,div)
{
	map = L.map(div).setView([x, y], 18); //inicjalizacja mapy (współrzędne)
	
	L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
	}).addTo(map); //Utworzenie mapy
	
	var marker = L.marker([x1, y1]).addTo(map); //Dodanie znacznika do mapy
	var marker = L.marker([x2, y2]).addTo(map);
}

WI1=document.getElementById('mapWI1');
WI2=document.getElementById('mapWI2');
WI1_X=53.447024		//współrzędna geograficzna X budynku WI1
WI1_Y=14.492384		//współrzędna geograficzna Y budynku WI1
WI2_X=53.448702		//współrzędna geograficzna X budynku WI2
WI2_Y=14.491027		//współrzędna geograficzna Y budynku WI2

srodek_x = Math.abs(WI2_X+((WI1_X-WI2_X)/2));
srodek_y = Math.abs(WI2_Y+((WI1_Y-WI2_Y)/2));

inicjalizacjaMapy(srodek_x,srodek_y,WI1_X,WI1_Y,WI2_X, WI2_Y, WI1) // utworzenie mapy dla budynku WI1

function planWI1(){
	window.open("plan_wi1.html", "_self");
}
function planWI2(){
	window.open("plan_wi2.html", "_self");
}