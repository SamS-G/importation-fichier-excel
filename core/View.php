<?php

    namespace App\core;

    class View
    {
        public function render(string $templateName, array $data = [])
        {
            $file = ROOT . '/templates/' . $templateName . '.php';
            $content = $this->renderFile($file, $data);
            $base = $this->renderFile(ROOT . '/templates/base.php', [
                'content' => $content
            ]);
            echo $base;
        }

        public function renderFile(string $file, array $data)
        {
            if (file_exists($file)) {
                extract($data);
                ob_start();
                require_once $file;
                return ob_get_clean();
            }
            header('Location: home.php?route=notFound');
        }
    }