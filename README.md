## Heise Academy

# PHP-Kurs: php-blogsystem

Der Hier eingestellte Code gehört zu dem PHP Kurs: "PHP - Datenbanken steuern mit PDO".
Im letzten Kapitel ist ein Usecase gezeigt, für das Auslesen, Einfügen und Anpassen von Daten in einer MySQL Datenbank.
Das hier ist der zugehörige Source-Code zum Usecase.

## Konfiguration

Bitte nicht vergessen, für diesen Source-Code wird eine MySQL Datenbank benötigt mit einer zugehörigen Tabelle.
Die Zugangsdaten für die Datenbank müssen in der **config.php** hinterlegt werden:

```php
//DATABASE CONNECTION CREDENTIALS:
DEFINE("DB_HOST", "localhost");
DEFINE("DB_NAME", "blogsystem");
DEFINE("DB_USERNAME", "software");
DEFINE("DB_PASSWORD", "passwort");
```

Nachdem die Zugangsdaten eingepflegt wurden, und eine gültige SQL-Tabelle erzeugt wurde, kann das Blogsystem getestet werden.
