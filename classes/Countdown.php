<?php

// {{meintag::Hallo das ist mein Tag}}

class Countdown extends Frontend {

	protected function ersetze_meintag($string) {

		$value = explode('::', $string);
		if ($value[0] == 'meintag' || $value[0] == 'cache_meintag') {

			$content = '<h1>'.$value[1].'</h1>';
			return $content;

		}
		elseif  ($value[0] == 'countdown' || $value[0] == 'cache_countdown') {
			
			// Splitte in Teilelemente auf (Trennzeichen ist ein Bindestrich)
			$countdown = explode('-', $value[1]);
			
			//Gib den Endzeitpunkt an
			//$endTime = mktime(0, 0, 0, 12, 18, 2014); //Stunde, Minute, Sekunde, Monat, Tag, Jahr; 
			
			$endTime = mktime($countdown[0], $countdown[1], $countdown[2], $countdown[3], $countdown[4], $countdown[5]); //Stunde, Minute, Sekunde, Monat, Tag, Jahr; 
			
			//Gib die aktuelle Zeit des Microtimestamps von PHP5 aus
			$timeNow = microtime(true); 
			
			//Berechne die Differenz von der Endzeit bis zum jetzigen Zeitpunkt 
			$diffTime = $endTime - $timeNow; 
			
			//Berechne die Tage, Stunden, Minuten und Sekunden
			$day = floor($diffTime / (24*3600)); 
			$diffTime = $diffTime % (24*3600); 
			$hour = floor($diffTime / (60*60)); 
			$diffTime = $diffTime % (60*60); 
			$min = floor($diffTime / 60); 
			$sec = $diffTime % 60; 
			
			//Formatiere die Einheiten
			
			// Tage
			if ($day == 1 || $day == -1) {
					$day = "$day Tag";
			}
			else {
				$day = "$day Tage";
			}
			
			// Stunden
			if ($hour == 1 || $hour == -1 ) {
					$hour = " $hour Stunde";
			}
			else {
				$hour = " $hour Stunden";
			}
			
			// Minuten
			if ($min == 1 || $min == -1) {
					$min = " $min Minute";
			}
			else {
				$min = " $min Minuten";
			}		
			
			// Sekunden
			if ($sec == 1 || $sec == -1) {
					$sec = " $sec Sekunde";
			}
			else {
				$sec = " $sec Sekunden";
			}
			
			//  Verberge die Tage, wenn sie abgelaufen sind
			if ($day <= 0) {
				$day = "";
			}
			
			// verberge die Stunden, wenn sie abgelaufen sind
			if ($day <= 0 && $hour <= 0) {
				$hour = "";
			}
			
			// verberge die Minuten, wenn sie abgelaufen sind
			if ($day <= 0 && $hour <= 0 && $min <= 0) {
				$min = "";
			}
			
			// verberge die Sekunden, wenn sie abgelaufen sind und gib eine Meldung aus
			if ($day <= 0 && $hour <= 0 && $min <= 0 && $sec <= 0) {
				$sec = "(oh - der Termin ist abgelaufen)";
			}

			// zeige Std. Min. Sek. nur am letzten Tag
			if ($day > 1) {
				$hour = "";
				$min = "";
				$sec = "";
			}
			
			//Gib die Einheiten aus: $day (Tage), $hour (Stunden), $sec (Sekunden)
			$content  = $day; 
			$content .= $hour; 
			$content .= $min;
			//$content .= $sec;
			
			return $content;

		}
		else return false; // Nicht unser Tag
	}

}

	
