# Panel Temperatury
## Instrukcja instalacji
#### Apache + PHP
```
sudo apt-get install apache2 sudo apt-get install php libapache2-mod-php -y
```
#### Usuń przykladowa strone z katalogu /var/www/html
```
sudo rm -r -f /var/www/html/*
```
#### Pobierz i skopiuj projekt do katalogu /var/www/html panel podgladu temperatury
```
wget -O temp.zip https://codeload.github.com/SWB-WAT/temperature-panel/zip/master && unzip temp.zip && sudo mv -f temperature-panel-master/* /var/www/html/. && rm temp.zip && rm -R -f temperature-panel-master && sudo chown -R www-data:www-data /var/www/
```
#### Pobierz emulator czujnika temperatury
```
sudo mkdir /home/temp-emulator && cd /home/temp-emulator && sudo wget -O temp.zip https://codeload.github.com/SWB-WAT/sensor-emulator/zip/master && sudo unzip temp.zip && sudo rm -r -f temp.zip && cd sensor-emulator-master
```
#### Zainstaluj interpreter pythona
```
sudo apt-get install python
```
#### Otwórz tablicę crona
```
sudo crontab -e

```
#### Dodaj wpis do tablicy
```
* * * * * /usr/bin/python /home/temp-emulator/sensor-emulator-master/sensor.py
```
## Opis
#### Panel temperatury
Strona internetowa jest zrealizowana w języku PHP, posiada pojedyńczą podstronę która jest odświerzana dynamicznie co 5 sekund przy użyciu technologii Ajax. 
Serwer oczekuje na zapytanie POST protokołu PHP na podstronie "http://adres_serwera/api.php". Po otrzymaniu zapytania wyciąga z zapytania informację o identyfikatorze czujnika, zmierzonej temperaturze, a następnie wyszukuje czy istnieje już czujka o zadanym identyfikatorze jeżeli istnieje to zmienia wartość temperatury jeżeli nie to dodaje nowy wpis do pliku. Dane o czujnikach są przechowywane w formacie JSON który prezentuję się następująco :
````
[
  {
    "last_measure":25.5,
    "last_measure_time":1480797597,
    "sensor_name":"sensor9"
  },
  {
    "last_measure":-15.5,
    "last_measure_time":1480797321,
    "sensor_name":"sensor5"
  }
]
```
#### Emulator czujników temperatury
Emulator czujników temperatury został zrealizowany w języku python. Skrypt wysyła dane o temperaturze do serwera php metodą POST protokołu Http. Liczba czujek jest losowa w zakresie od 1 do 15. Każda czujka generuje oddzielne zapytanie http, tak by odpowiadało to rzeczywistym warunkom (każda czujka w innej lokalizacji). Zapytanie jest genrowane co 5 sekund. 
