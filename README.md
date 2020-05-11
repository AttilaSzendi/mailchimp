#### ingredients:
```bash
git clone https://github.com/AttilaSzendi/mailchimp.git
```
```bash
cp .env.example .env
```
```bash
composer install
```
```bash
php artisan key:generate
```
Tölts ki a mailchimp api-ra és az adatbázisra vonatkozó adatokat a **.env** file-ban
```bash
php artisan migrate --seed
```
```bash
npm install
```
Valamilyen környezetben futtasd. Én Homestead-ben fejlesztettem, de ez lehet Laravel Valet (only mac), php artisan serve, esetleg docker.

Ezután közepes lángon, folyamatos keverés mellett készrefőzzük. :)
