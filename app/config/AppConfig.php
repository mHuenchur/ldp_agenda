<?php

define("APP_URL","http://localhost/ldp_agenda/");
define("APP_URI",$_SERVER["DOCUMENT_ROOT"]."/ldp_agenda/app/");

define("APP_TEMPLATE", APP_URI . "resources/template/");
define("APP_VIEWS", APP_URI . "resources/views/");

define("APP_MODELS", APP_URI . "core/model/");
define("APP_SERVICES", APP_URI . "core/service/");

CONST APP_TOKEN = "SECRET_KEY";

define("APP_DEFAULT_ACTION", "index");

?>