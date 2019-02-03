<?php

declare(strict_types=1);

$tokenok = 'demonio';

//seguranca.
if($_REQUEST['token'] != $tokenok){ die(':('); }
