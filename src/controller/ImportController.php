<?php

    namespace App\src\controller;

    use App\core\Controller;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Reader\Exception;

    class ImportController extends Controller
    {
        /**
         * @throws Exception
         */
        public function file()
        {
            if ($_FILES["import_excel"]["name"] != '') {
                $allowed_extension = ['xls', 'csv', 'xlsx'];
                $file_array = explode(".", $_FILES["import_excel"]["name"]);
                $file_extension = end($file_array);

                if (in_array($file_extension, $allowed_extension)) {
                    $file_name = time() . '.' . $file_extension;
                    move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
                    $file_type = IOFactory::identify($file_name);
                    $reader = IOFactory::createReader($file_type);

                    $spreadsheet = $reader->load($file_name);

                    unlink($file_name);

                    $data = $spreadsheet->getActiveSheet()->toArray();


                    foreach ($data as $row) {
                        if (!in_array('Nom du groupe', $row)) {
                            $datas = [
                                ':group_name' => $row[0],
                                ':origin' => $row[1],
                                ':city' => $row[2],
                                ':starting_year' => $row[3],
                                ':separation_year' => $row[4],
                                ':founder_name' => $row[5],
                                ':member_nb' => $row[6],
                                ':style' => $row[7],
                                ':summary' => $row[8],
                            ];
                            if (empty($this->importDAO->checkDuplicate($datas[':group_name']))) {
                                $this->importDAO->importData($datas);
                                $message = '<div class="alert alert-success">Données correctement importées</div>';
                            } else {
                                $message = '<div class="alert alert-danger">Attention votre fichier comprend un ou plusieurs groupes déjà sauvegardés dans la base !</div>';
                            }
                        }
                    }

                } else {
                    $message = '<div class="alert alert-danger">Erreur, seuls les fichiers .xls .csv ou .xlsx sont autorisés</div>';
                }
            } else {
                $message = '<div class="alert alert-danger">Sélectionnez un fichier</div>';
            }

            echo $message;
        }
    }