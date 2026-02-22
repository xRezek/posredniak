# Pośredniak.pl

## Wprowadzenie

Pośredniak.pl to portal z ofertami pracy przygotowany jako odpowiedź na zadanie rekrutacyjne.

## Funkcjonalności

Aplikacja posiada następujące funkcjonalności:
- Dodawanie ofert
- Edycja ofert
- Usuwanie ofert
- Paginacja wyników
- Walidacja formularzy
- Relacje między ofertą, kategorią i lokalizacją
- Filtrowanie po kategorii
- Filtrowanie po lokalizacji
- Wyszukiwanie po tytule i treści
- Publiczna strona przeglądania ofert


## Stos technologiczny
- PHP 8.2
- Laravel 12
- Eloquent ORM
- Livewire components
- MySQL
- Tailwind CSS

## Instrukcja uruchomienia

### Sklonuj repozytorium
```
git clone https://github.com/xRezek/posredniak
cd posredniak
```
### Pobierz zależności
```
composer install
```
### Zainstaluj zależności frontendowe
```
npm install
```
### Zbuduj assety
```
npm run build
```
### Skonfiguruj środowisko w pliku .env
```
cp .env.example .env
```
### Wygeneruj klucz do szyfrowania aplikacji
```
php artisan key:generate
```
### Uruchom migrację bazy danych
```
php artisan migrate --seed
```
### Uruchom aplikację
```
php artisan serve
```


