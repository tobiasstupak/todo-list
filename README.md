# Todo List (PHP + MySQL)

Jednoduchá webová aplikácia na správu úloh (todo list).  
Môžeš si v nej pridávať, upravovať a mazať úlohy – ideálne na precvičenie práce s PHP a databázou.

## Čo aplikácia dokáže

- Registrácia nového užívateľa
- Prihlásenie sa do aplikácie
- Pridať novú úlohu s názvom a popisom
- Zobraziť všetky svoje úlohy
- Upraviť existujúcu úlohu
- Vymazať úlohu
- Označiť úlohu za hotovú
- Odhlásiť sa z aplikácie

## Funkcie

- **Autentifikácia** - Každý užívateľ má svoj účet
- **Bezpečnosť** - Vidí len svoje úlohy
- **CRUD operácie** - Vytvárať, čítať, upravovať, mazať úlohy
- **Stavy úloh** - Úlohy môžu byť "nova" alebo "hotova"
- **Responzívny dizajn** - Pracuje na mobiloch aj počítačoch

## Ako funguje

Aplikácia komunikuje s databázou MySQL, kde sa ukladajú všetky údaje.  
Používajú sa klasické HTML formuláre a dáta sa spracúvajú pomocou PHP.  
Každý užívateľ má vlastný účet a vidí len svoje úlohy.

## Technológie

- **Backend:** PHP
- **Databáza:** MySQL
- **Frontend:** HTML5, Bootstrap 5 CSS
- **Server:** MAMP

## Súbory
- `index.php` - Úvodná stránka
- `login.php` - Prihlásenie
- `registracia.php` - Registrácia
- `todo.php` - Správa úloh
- `db.php` - Databáza
- `database.sql` - Skript SQL
