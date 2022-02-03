<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo 'Administrar '.$subtitulo ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo 'Alterar '.$subtitulo ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                echo validation_errors('<div class="alert alert-danger">', '</div>');
                                echo form_open('admin/categoria/salvar_alteracoes');

                                foreach($categorias as $categoria):
                            ?>
                            <div class="form-group">
                                <label>Nome da categoria</label>
                                <input type="hidden" value="<?php echo $categoria->id ?>" name="txt-id" id="txt-id">
                                <input type="text" class="form-control" 
                                    placeholder="Digite o nome da categoria"
                                    value="<?php echo $categoria->titulo ?>"
                                    id="txt-categoria" name="txt-categoria">
                            </div>
                            <button type="submit" class="btn btn-default">Atualizar categoria</button>
                            <?php
                                endforeach;
                                echo form_close();
                            ?>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
