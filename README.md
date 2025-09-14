# Content-Slider - erweitertes Element  
Erweitert das Core Slider Element um weiter Eingabemöglichkeiten  
## Zusatzmöglichkeiten  
### Autoplay bei Hover pausieren  
Ist Autoplay aktiv, pausiert der Slider bei Mouse-Over.
### Zusätzliche Swiper-Klasse  
Es kann eine oder mehrere beliebige CSS Klassen gesetzt werden.  
### Navigation ausblenden  
Ist diese Option aktiv, werden die Vor- und Zurück-Buttons nicht mit ausgegeben.  
### Pagination ausblenden  
Ist diese Option aktiv, wird die Pagnation nicht mit ausgegeben  
### Breakpoints  
Es kann die Swiper-eigene Breakpoint-Option genutzt werden.  
Beispiel:  
```
{
  "480":  { "slidesPerView": 1, "spaceBetween": 8  },
  "768":  { "slidesPerView": 2, "spaceBetween": 16 },
  "1024": { "slidesPerView": 3, "spaceBetween": 24 }
}
```
### Zusätzliche Parameter  
Es können beliebig viele valide Swiper-Optionen eingefügt werden.  
Beispiel:  
```
spaceBetween: 24,
effect: 'cube',
cubeEffect: {
  shadow: true,
  slideShadows: true,
  shadowOffset: 20,
  shadowScale: 0.94,
},
grabCursor: true,
```
## Template  
### Template-Einstellungen
Die Erweiterung bringt das angepasste Twig-Template `content_element/swiper/slider_extended` mit. Es wird beim Erstellen des Inhaltselementes mit Elementtyp `Content-Slider` vorausgewählt.  
### Problematik und Lösung  
Das Core-Element `Content-Slider` hat den Nachteil, dass bei Verwendung mehrerer Slider-Elementen (mit eigenen Anpassungen) pro Seite, die Initialisierung nicht mehr korrekt abläuft und die Slider nicht mehr korrekt funktionieren.  
Im Template `slider_extended.html.twig` wurde dies berücksichtigt, sodass auch zwei oder mehr dieser Content-Slider Elemente, mit Anpassungen, pro Seite verwendet werden können.  
### Beispiele  
![contentslider-extended-01](https://github.com/user-attachments/assets/e4859ee3-321d-45a2-b352-42b97cd9dae0)
![contentslider-extended-02](https://github.com/user-attachments/assets/d937b556-bb4c-4d4b-b716-de5b8c29fe84)
