<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wordpress' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'N/E=l)qE25S-+ANZfO$$bv|)!r-~zP[%H.&j5|)+Yz<O,*!,|Cv#zCI7A=+P2S/V');
define('SECURE_AUTH_KEY',  'aIx^KqKBgA*i)8Y9CNe`-1YMo8[%XlUGZAv#lnzj(-mGA*C&dfg0MH;<U$5f3(,J');
define('LOGGED_IN_KEY',    'q|UZo#y& h!E&TR4C#q.NH^Pxbu-).u_h EU+O86gU:(tj2U.Akaa;HVR|sbyr*2');
define('NONCE_KEY',        'z5:Z`tawpLe+F-=$:yX]+?U]lIH+f|Y&qhX!NX$.+J~ @l*9$8?*R&S0Sl;>QHA|');
define('AUTH_SALT',        '{|s txOi>/,k@.6,Ybe1P2zV:*//Ums9yWw9~rtc/i3)I-Z=-un*5Zlr@0fFr9D9');
define('SECURE_AUTH_SALT', '<6}IL7pHqwtSypnODGjx.r5Y|ka0[e&Q3Ib-9^ra!5|o82,=!++Gixi3#AKL<#C[');
define('LOGGED_IN_SALT',   'Z<j>ahDv -0yo_qiNi:u}/=xR$}k./vw^5dr &:qqS7ydA_q2s94B)|$TJ<(;%6N');
define('NONCE_SALT',       'k{R!WaBW8<|:!!FS G:+aP&GYT+}*G_a+=2 jVhv>brvg[SV/9Aa,z-|Ii<9<R;#');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
