## Showcase: https://diode.zone/w/ubagxKp9GmJCgduqk8LeU3

## Github:
* Bot: https://github.com/Fntoomen/motey-bot
* Strona: https://github.com/Fntoomen/motey-website
## Codeberg:
* Bot: https://codeberg.org/mikolajlubiak/emotebot
* Strona: https://codeberg.org/mikolajlubiak/emoteupld

# Pomoc
* Praca z Gitem:
* Jeśli używacie kluczy SSH:
```sh
git clone "git@codeberg.org:mikolajlubiak/emotebot.git" # Sklonowanie
git remote set-url --add --push origin "git@codeberg.org:mikolajlubiak/emotebot.git" # Pushowanie do Codeberga
git remote set-url --add --push origin "git@github.com:Fntoomen/motey-bot.git" # Pushowanie do Githuba
git add <plik> # Dodanie nowego pliku
git pull # Jak ktoś coś zmieni, to żeby mieć najnowszą wersję
git commit -am '<opis co zmieniłeś/aś>' # Dodanie swoich zmian
git push # Wysłanie swoich zmian
```
* Jeśli używacie hasła:
```sh
git clone "https://codeberg.org/mikolajlubiak/emotebot.git" # Sklonowanie
git remote set-url --add --push origin "https://codeberg.org/mikolajlubiak/emotebot.git" # Pushowanie do Codeberga
git remote set-url --add --push origin "https://github.com/Fntoomen/motey-bot.git" # Pushowanie do Githuba
git add <plik> # Dodanie nowego pliku
git pull # Jak ktoś coś zmieni, to żeby mieć najnowszą wersję
git commit -am '<opis co zmieniłeś/aś>' # Dodanie swoich zmian
git push # Wysłanie swoich zmian
```
* `emotes` to jest tabela w bazie danych `emote`
* Jak odpalić strone lub bota:
```sh
/usr/bin/pkill -f "/usr/bin/php -S 0.0.0.0:20357 -t /root/emoteupld/" >/dev/null 2>&1 # Zabij PHP
/usr/bin/pkill -f "/usr/bin/python3 /root/emotebot/main.py" >/dev/null 2>&1 # Zabij Python
nohup /usr/bin/php -S 0.0.0.0:20357 -t /root/emoteupld/ & # Uruchom PHP
nohup /usr/bin/python3 /root/emotebot/main.py & # Uruchom Python
```
* Zapytanie SQL żeby stworzyć tabele:
* Użytkownicy:
```SQL
CREATE TABLE users (
    user_id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    discord_id BIGINT UNSIGNED NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```
* Emotki:
```SQL
CREATE TABLE emotes (
    id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(12) NOT NULL UNIQUE,
    location VARCHAR(50) NOT NULL UNIQUE,
    times_used BIGINT UNSIGNED NOT NULL DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_id BIGINT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
```
