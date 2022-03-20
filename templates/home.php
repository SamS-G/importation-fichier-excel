<section class="container">
    <br />
    <h3 class="text-center">Import de données musicales</h3>
    <br />
    <div class="panel panel-default">
        <div class="text-center my-3"><em>Votre fichier sera sauvegardé dans une base de données</em></div>
        <div class="panel-body">
            <div class="table-responsive">
                <span id="message"></span>
                <form method="post" id="import_excel_form" enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <td class="w25 text-center" align="right">Sélectionnez votre fichier</td>
                            <td class="w50"><input type="file" name="import_excel" /></td>
                            <td class="w25"><input type="submit" name="import" id="import" class="btn btn-primary" value="Importer" /></td>
                        </tr>
                    </table>
                </form>
                <br />
            </div>
        </div>
    </div>
</section>
