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
* * * * * /usr/bin/python /home/temp-emulator/sensor-emulator-master/sensor.py
