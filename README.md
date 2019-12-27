# Legendary-Quest-Grounds-of-Undead

## instrukcja instalacji


### Frontend
> Wymagany npm w najnowszej wersji

* Po pobraniu należy uruchomić terminal i wejść do katalogu w którym mamy pobrany projekt
* wpisujemy polecenie ```npm install```

> Aby uruchomić należy użyć polecenia ```npm run start```

### Baza Danych

> Wymagana Baza: PostgreSql - najnowsza wersja
> W projekcie używana to 11.5

* uruchomić bazę danych
  * linux - ```sudo systemctl enable postgresql.service``` i ```sudo systemctl start postgresql.service```
* zalogować się jako postgres ```sudo su postgres```
* tworzymy nowego użytkownika bazy danych ```createuser --interactive --pwprompt```
  * **User:** legend / legend z uprawnieniami superusera *optymalny użytkownik - nie trzeba później konfigurować plików konfiguracyjnych*
* uruchamiamy polecenie ```psql```
* Tworzymy nową bazę danych ```CREATE DATABASE legend;``` *Optymalna baza danych - nie trzeba później nic konfigurować* 
* To wszystko

### Backend
> Optymalny system do uruchomienia *Linux*
> Wymagany Symfony
> Wymagany pakiet php-pgsql

* wchodzimy do katalogu projektu
* przechodzimy do katalogu server
* wpisujemy polecenie ```composer install```
* **Jeśli skonfigurowaliśmy bazę danych** używamy polecenia ```bin/console do:mi:mi -n```

