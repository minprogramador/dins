<?php

$tokenok = 'demonio';

//seguranca.
if($_REQUEST['token'] != $tokenok){ die(':('); }
