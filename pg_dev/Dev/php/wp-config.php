<?php
/**
 * Podstawowa konfiguracja WordPressa.
 *
 * Ten plik zawiera konfiguracje: ustawień MySQL-a, prefiksu tabel
 * w bazie danych, tajnych kluczy, używanej lokalizacji WordPressa
 * i ABSPATH. Więćej informacji znajduje się na stronie
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Kodeksu. Ustawienia MySQL-a możesz zdobyć
 * od administratora Twojego serwera.
 *
 * Ten plik jest używany przez skrypt automatycznie tworzący plik
 * wp-config.php podczas instalacji. Nie musisz korzystać z tego
 * skryptu, możesz po prostu skopiować ten plik, nazwać go
 * "wp-config.php" i wprowadzić do niego odpowiednie wartości.
 *
 * @package WordPress
 */

// ** Ustawienia MySQL-a - możesz uzyskać je od administratora Twojego serwera ** //
/** Nazwa bazy danych, której używać ma WordPress */
//define('DB_NAME', 'grafdb');
define('DB_NAME', 'pg');

/** Nazwa użytkownika bazy danych MySQL */
//define('DB_USER', 'grafu');
define('DB_USER', 'root');

/** Hasło użytkownika bazy danych MySQL */
//define('DB_PASSWORD', 'wokoraku');
define('DB_PASSWORD', '');

/** Nazwa hosta serwera MySQL */
//define('DB_HOST', '193.201.164.66');
define('DB_HOST', 'localhost');

/** Kodowanie bazy danych używane do stworzenia tabel w bazie danych. */
define('DB_CHARSET', 'utf8');

/** Typ porównań w bazie danych. Nie zmieniaj tego ustawienia, jeśli masz jakieś wątpliwości. */
define('DB_COLLATE', '');

/**#@+
 * Unikatowe klucze uwierzytelniania i sole.
 *
 * Zmień każdy klucz tak, aby był inną, unikatową frazą!
 * Możesz wygenerować klucze przy pomocy {@link https://api.wordpress.org/secret-key/1.1/salt/ serwisu generującego tajne klucze witryny WordPress.org}
 * Klucze te mogą zostać zmienione w dowolnej chwili, aby uczynić nieważnymi wszelkie istniejące ciasteczka. Uczynienie tego zmusi wszystkich użytkowników do ponownego zalogowania się.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '<(K0lAy^stiq2V`$Nvrx-{9Ej9PTf;~O}y52w&~-~DCa) E>e]*jc1SX`-WWaVfp');
define('SECURE_AUTH_KEY',  't*mMv=vCg,a>v1z0$9[Kue DKqAOm]8U7-//n/v^B<ZF{>UIt?vGDe6MDQ[k-z]K');
define('LOGGED_IN_KEY',    ',aRA+(v@$%K6D+Ug3Kjy}(95F=^a:x>EeTJ)KO|E^@**uZ&Q?RU|39QT+|A^?#mA');
define('NONCE_KEY',        'LDMd+/(~c8m&o3d/n;BANa;4;d]dD}(.27,`>18M.u)@?O@6*~Z2rT@ZynDlu<Bv');
define('AUTH_SALT',        '*<_xr8DR95<0vzLBWSlTqO;Bk&k`7bp$PAAW*@i:b;bcg=S&Zal3?i2fbgC.QFJ>');
define('SECURE_AUTH_SALT', 'kGVaI3grm$kTwz3$~6O?|94eU67P;6@Glc3y/=^g/yQ9ajH!g]MKJjyX-B)y}1GR');
define('LOGGED_IN_SALT',   'c +~^@$B}j*z6-wnmN.zfVITKi9y7+RSOu*m,KHY#BQ;2O[&ae-/5eQ&C7bbRSt7');
define('NONCE_SALT',       'w@8[ul6-n 9s,AU$JI&SX,i|XmnW6Q6RMr5e/pU&@]/O&e}zU?37CyI-{TK0y[vZ');

/**#@-*/

/**
 * Prefiks tabel WordPressa w bazie danych.
 *
 * Możesz posiadać kilka instalacji WordPressa w jednej bazie danych,
 * jeżeli nadasz każdej z nich unikalny prefiks.
 * Tylko cyfry, litery i znaki podkreślenia, proszę!
 */
$table_prefix  = 'pg_';

/**
 * Kod lokalizacji WordPressa, domyślnie: angielska.
 *
 * Zmień to ustawienie, aby włączyć tłumaczenie WordPressa.
 * Odpowiedni plik MO z tłumaczeniem na wybrany język musi
 * zostać zainstalowany do katalogu wp-content/languages.
 * Na przykład: zainstaluj plik de_DE.mo do katalogu
 * wp-content/languages i ustaw WPLANG na 'de_DE', aby aktywować
 * obsługę języka niemieckiego.
 */
define('WPLANG', 'pl_PL');

/**
 * Dla programistów: tryb debugowania WordPressa.
 *
 * Zmień wartość tej stałej na true, aby włączyć wyświetlanie ostrzeżeń
 * podczas modyfikowania kodu WordPressa.
 * Wielce zalecane jest, aby twórcy wtyczek oraz motywów używali
 * WP_DEBUG w miejscach pracy nad nimi.
 */
define('WP_DEBUG', false);

/**
* Disable all automatic updates.
*/
define('AUTOMATIC_UPDATER_DISABLED', true);

/* To wszystko, zakończ edycję w tym miejscu! Miłego blogowania! */

/** Absolutna ścieżka do katalogu WordPressa. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Ustawia zmienne WordPressa i dołączane pliki. */
require_once(ABSPATH . 'wp-settings.php');
