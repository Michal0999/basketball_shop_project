function odliczanie() {
	var dzisiaj = new Date();
	var dzien = dzisiaj.getDate();
	var miesiac = dzisiaj.getMonth() + 1;
	switch (miesiac) {
		case 1:
			miesiac = "Styczeń";
			break;
		case 2:
			miesiac = "Luty";
			break;
		case 3:
			miesiac = "Marzec";
			break;
		case 4:
			miesiac = "Kwiecień";
			break;
		case 5:
			miesiac = "Maj";
			break;
		case 6:
			miesiac = "Czerwiec";
			break;
		case 7:
			miesiac = "Lipiec";
			break;
		case 8:
			miesiac = "Sierpień";
			break;
		case 9:
			miesiac = "Wrzesień";
			break;
		case 10:
			miesiac = "Październik";
			break;
		case 11:
			miesiac = "Listopad";
			break;
		case 12:
			miesiac = "Grudzień";
			break;

	}
	var rok = dzisiaj.getFullYear();
	var godzina = dzisiaj.getHours();
	if (godzina < 10) godzina = "0" + godzina;
	var minuta = dzisiaj.getMinutes();
	if (minuta < 10) minuta = "0" + minuta;
	var sekunda = dzisiaj.getSeconds();
	if (sekunda < 10) sekunda = "0" + sekunda;
	document.getElementById("zegar").innerHTML =
		dzien + " " + miesiac + " " + rok + " Godz: " + godzina + ":" + minuta + ":" + sekunda;

	setTimeout("odliczanie()", 1000);
}
