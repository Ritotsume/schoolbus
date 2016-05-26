<?php

define('HOME', 'http://localhost/schoolbus/');

// AUTOLOAD DE CLASSES ######################
function __autoload($Class) {
    $cDir = ['conn', 'models', 'helpers'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . "/{$dirName}/{$Class}.class.php") && !is_dir(__DIR__ . "/{$dirName}/{$Class}.class.php")):
            include_once(__DIR__ . "/{$dirName}/{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.class.php!", E_USER_ERROR);
        die;
    endif;
}

//ERROS PERSONALIZADOS PARA ESTA APLICAÇÃO
define('CRAZY_ACCEPT', 'accept');
define('CRAZY_INFOR', 'infor');
define('CRAZY_ALERT', 'alert');
define('CRAZY_ERROR', 'error');

/**
 *
 * @param type $errorMsg
 * @param type $errorNum
 * @param type $die
 */
function ADSError($errorMsg, $errorNum, $die = null) {
    $css = ($errorNum == E_USER_NOTICE ? CRAZY_INFOR :
                    ($errorNum == E_USER_WARNING ? CRAZY_ALERT :
                            ($errorNum == E_USER_ERROR ? CRAZY_ERROR : $errorNum)));

    $icon = ($css == CRAZY_INFOR ? '<i class="fa fa-info-circle"></i>' :
                    ($css == CRAZY_ALERT ? '<i class="fa fa-exclamation-circle"></i>' :
                            ($css == CRAZY_ERROR ? '<i class="fa fa-times-circle"></i>' : '<i class="fa fa-check-circle"></i>')));

    echo "<div class=\"trigger_error {$css}\"  onshow=\"esconder(this)\">{$icon} {$errorMsg}</div>";
    if ($die != null):
        die;
    endif;
}

function PHPError($errorNum, $errorMsg, $errorFile, $errorLine) {
    $css = ($errorNum == E_USER_NOTICE ? CRAZY_INFOR :
                    ($errorNum == E_USER_WARNING ? CRAZY_ALERT :
                            ($errorNum == E_USER_ERROR ? CRAZY_ERROR : $errorNum)));
    $icon = ($css == CRAZY_INFOR ? '<i class="fa fa-info-circle"></i>' :
                    ($css == CRAZY_ALERT ? '<i class="fa fa-exclamation-circle"></i>' :
                            ($css == CRAZY_ERROR ? '<i class="fa fa-times-circle"></i>' : '<i class="fa fa-check-circle"></i>')));
    echo "<div class=\"trigger_error phperror {$css}\">{$icon} "
    . "<b>Erro na linha </b>{$errorLine} :: {$errorMsg} <br />"
    . "<small>{$errorFile}</small>"
    . "</div>";
    if ($errorNum == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPError');
