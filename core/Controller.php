<?php

    namespace App\core;

    use App\src\DAO\ImportDAO;

    abstract class Controller
    {
        protected View $view;
        protected ImportDAO $importDAO;

        public function __construct()
        {
            $this->view = new View();
            $this->importDAO = new ImportDAO();
    }
    }