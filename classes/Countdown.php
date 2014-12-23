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
			$intDay = floor($diffTime / (24*3600)); 
			$intDiffTime = $diffTime % (24*3600); 
			$intHour = floor($diffTime / (60*60)); 
			$intDiffTime = $diffTime % (60*60); 
			$intMin = floor($diffTime / 60); 
			$intSec = $diffTime % 60; 

			// Warnung 'Abgelaufen' leeren, falls es gefüllt ist
			if (!empty($strWarning)) {
				$strWarning = '';
			}

			// Globalisiere die Sprachelemente

			// Tage
			$strLangDays = $GLOBALS['TL_LANG']['MSC']['countdown_simple']['days'];  ;

			//Fallback, falls Sprachvariable nicht gesetzt ist.
			if($strLangDays == ''){ 
			  $strLangDays = 'Days';
			}

			// Tag
			$strLangDay = $GLOBALS['TL_LANG']['MSC']['countdown_simple']['day'];  ;

			//Fallback, falls Sprachvariable nicht gesetzt ist.
			if($strLangDay == ''){ 
			  $strLangDay = 'Day';
			}

			// Stunden
			$strLangHours = $GLOBALS['TL_LANG']['MSC']['countdown_simple']['hours'];  ;

			//Fallback, falls Sprachvariable nicht gesetzt ist.
			if($strLangHours == ''){ 
			  $strLangHours = 'Hours';
			}

			// Stunde
			$strLangHour = $GLOBALS['TL_LANG']['MSC']['countdown_simple']['hour'];  ;

			//Fallback, falls Sprachvariable nicht gesetzt ist.
			if($strLangHour == ''){ 
			  $strLangHour = 'Hour';
			}

			// Minuten
			$strLangMinutes = $GLOBALS['TL_LANG']['MSC']['countdown_simple']['minutes'];  ;

			//Fallback, falls Sprachvariable nicht gesetzt ist.
			if($strLangMinutes == ''){ 
			  $strLangMinutes = 'Minutes';
			}

			// Minute
			$strLangMinute = $GLOBALS['TL_LANG']['MSC']['countdown_simple']['minute'];  ;

			//Fallback, falls Sprachvariable nicht gesetzt ist.
			if($strLangMinute == ''){ 
			  $strLangMinute = 'Minute';
			}

			// Sekunden
			$strLangSeconds = $GLOBALS['TL_LANG']['MSC']['countdown_simple']['seconds'];  ;

			//Fallback, falls Sprachvariable nicht gesetzt ist.
			if($strLangSeconds == ''){ 
			  $strLangSeconds = 'Seconds';
			}

			// Sekunde
			$strLangSecond = $GLOBALS['TL_LANG']['MSC']['countdown_simple']['second'];  ;

			//Fallback, falls Sprachvariable nicht gesetzt ist.
			if($strLangSecond == ''){ 
			  $strLangSecond = 'Second';
			}

			// Warnung 'Abgelaufen'
			$strLangWarningExpired = $GLOBALS['TL_LANG']['MSC']['countdown_simple']['expired'];  ;

			//Fallback, falls Sprachvariable nicht gesetzt ist.
			if($strLangWarningExpired == ''){ 
			  $strLangWarningExpired = '(ups, the date is expired)';
			}

			
			//Formatiere die Einheiten
			
			// Tage
			if ($intDay == 1 || $intDay == -1) {
					$strDay = "$intDay ".$strLangDay;
			}
			else {
				$strDay = "$intDay ".$strLangDays;
			}
			
			// Stunden
			if ($intHour == 1 || $intHour == -1 ) {
					$strHour = " $intHour ".$strLangHour;
			}
			else {
				$strHour = " $intHour ".$strLangHours;
			}
			
			// Minuten
			if ($intMin == 1 || $intMin == -1) {
					$strMin = " $intMin ".$strLangMinute;
			}
			else {
				$strMin = " $intMin ".$strLangMinutes;
			}		
			
			// Sekunden
			if ($intSec == 1 || $intSec == -1) {
					$strSec = " $intSec ".$strLangSecond;
			}
			else {
				$strSec = " $intSec ".$strLangSeconds;
			}
			
			//  Verberge die Tage, wenn sie abgelaufen sind
			if ($intDay <= 0) {
				$strDay = "";
			}
			
			// verberge die Stunden, wenn sie abgelaufen sind
			if ($intDay <= 0 && $intHour <= 0) {
				$strHour = "";
			}
			
			// verberge die Minuten, wenn sie abgelaufen sind
			if ($intDay <= 0 && $intHour <= 0 && $intMin <= 0) {
				$strMin = "";
			}
			
			// verberge die Sekunden, wenn sie abgelaufen sind und gib eine Meldung aus
			if ($intDay <= 0 && $intHour <= 0 && $intMin <= 0 && $intSec <= 0) {
				$strSec = '';
				$strWarning = $strLangWarningExpired;
			}

			// zeige Std. Min. Sek. nur am letzten Tag
			if ($intDay > 1) {
				$strHour = "";
				$strMin = "";
				$strSec = "";
			}
			
			//Gib die Einheiten aus: Tage, Stunden, Minuten, Sekunden
			$content  = $strDay; 
			$content .= $strHour; 
			$content .= $strMin;
			$content .= $strSec;
			$content .= $strWarning;
			
			return $content;

		}
		else return false; // Nicht unser Tag
	}

}

	
