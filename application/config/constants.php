<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


define('ADMIN', '1');
define('CAREGIVER', '2');
define('ELDERLY', '3');

define('ACCOUNT_CREATED', 'Account is successfully Created');
define('USERNAME_EXISTED', 'Username existed, Please choose another username');
define('WRONG_DEPENDING_USER_CREDENTIAL', 'Wrong combination of elderly\'username and password');
define('WRONG_USER_CREDENTIAL', 'Wrong combination of username and password');
define('DEPENDING_USER_IS_LINKED', 'Elderly is already linked to a caregiver account');

define('GET_RESULT_SQL', 'SELECT question.id as \'question_id\', question.question_id as \'question_order\',
  question.question as \'question\', question.vraag as \'vraag\',
  answer.selected_choice as \'en_selected_choice\',
  answer.nl_selected_choice as \'nl_selected_choice\',
  answer.selected_value as \'selected_value\'
  FROM question
  LEFT JOIN answer
  ON question.id = answer.question_id
  WHERE answer.user_id = %user_id%
  AND DATE(answer.created_date) = "%created_date%"
  ORDER BY question.question_id ASC');

define('GET_ANSWER_SUMMARY_BETWEEN_DATES',
    'SELECT
      answer.selected_choice as en_selected_choice,
      answer.nl_selected_choice as nl_selected_choice,
      COUNT(*) as frequency
    FROM
      answer
    WHERE
      answer.question_id = %question_id%
      AND (answer.created_date BETWEEN Date("%start_date%") AND DATE("%end_date%"))
      AND answer.user_id = %user_id%
    GROUP BY
      answer.selected_choice, answer.nl_selected_choice
');
define('GET_ANSWER_DATE_BY_ANSWER', '
SELECT
  answer.created_date
FROM
  answer
WHERE
  answer.question_id = %question_id%
  AND (answer.created_date BETWEEN Date("%start_date%") AND DATE("%end_date%"))
  AND answer.user_id = %user_id%
  AND (answer.selected_choice = "%answer%" or answer.nl_selected_choice = "%answer%")
');

define('GET_RELIABILITY_SCORE', '
SELECT COUNT(c.score) as score FROM a17_webapps07.answer a INNER JOIN a17_webapps07.choice c
ON a.question_id=c.question_id AND a.selected_value = c.value
WHERE a.user_id=%user_id% AND a.selected_value IN(8, 88)
GROUP BY a.user_id
HAVING MAX(a.created_date) ;
');


define('GET_RELIANCE_SCORE', '
SELECT SUM(c.score)+74 as score FROM a17_webapps07.answer a INNER JOIN a17_webapps07.choice c
ON a.question_id=c.question_id AND a.selected_value = c.value
WHERE a.user_id=%user_id% AND a.selected_value IN(8, 88)
GROUP BY a.user_id
HAVING MAX(a.created_date) ;
');