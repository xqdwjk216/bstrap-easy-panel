<?php

    Loader::core("api");
    Loader::core("dbstmt");
    Loader::core("phptrace");
    Loader::core("config")->init();
    Loader::core("log")->init();
    Loader::core("db")->init();
    Loader::core("input");
    Loader::core("view");