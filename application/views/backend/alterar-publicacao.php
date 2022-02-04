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
                    <?php echo 'Adicionar novo '.$subtitulo ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                echo validation_errors('<div class="alert alert-danger">', '</div>');
                                foreach($publicacoes as $publicacao):
                                echo form_open('admin/publicacao/salvar_alteracoes/'.md5($publicacao->id));
                            ?>
                            <div class="form-group">
                                <label id="select-categoria">Categoria</label>
                                <select id="select-categoria" name="select-categoria" class="form-control">
                                    <?php  
                                        foreach($categorias as $categoria):
                                    ?>
                                        <option value="<?php echo $categoria->id ?>" 
                                            <?php if($categoria->id == $publicacao->categoria){echo "selected";} ?>>
                                            <?php echo $categoria->titulo ?></option>
                                    <?php 
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control" 
                                placeholder="Digite o titulo da publicação"
                                id="txt-titulo" name="txt-titulo" value="<?php echo $publicacao->titulo; ?>">
                            </div>
                            <div class="form-group">
                                <label>Subtítulo</label>
                                <input type="text" class="form-control" 
                                placeholder="Digite o subtitulo da publicação"
                                id="txt-subtitulo" name="txt-subtitulo" value="<?php echo $publicacao->subtitulo; ?>">
                            </div>
                            <div class="form-group">
                                <label id="txt-historico">Conteúdo</label>
<textarea name="txt-conteudo" id="txt-conteudo" class="form-control" style="resize: vertical;"><?php echo $publicacao->conteudo; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Data</label>
                                <input type="datetime-local" class="form-control" 
                                placeholder="Digite a data da publicação"
                                id="txt-data" name="txt-data" 
                                value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($publicacao->data)); ?>">
                            </div>

                            <input type="hidden" name="txt-id" value="<?php echo $publicacao->id ?>">

                            <button type="submit" class="btn btn-default">Alterar</button>
                            <?php
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

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo 'Imagem de destaque do '.$subtitulo ?>
                </div>
                <style>
                    img {
                        width: 400px !important;
                        margin-left: -70px;
                    }
                </style>
                <div class="panel-body">
                    <div class="row" style="padding-bottom: 10px;">
                        <div class="col-lg-8 col-lg-offset-4">
                            <style>
                                img {
                                    width: 200px;
                                }
                            </style>
                            <?php 
                            if($publicacao->img == 1) {
                                echo img("assets/frontend/img/publicacao/".md5($publicacao->id).".jpg");
                            } else {
                                echo img("assets/frontend/img/semFoto.png");
                            }
                            ?>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                $divopen = '<div class="form-group">';
                                $divclose = '</div>';
                                echo form_open_multipart('admin/publicacao/nova_foto');
                                echo form_hidden('id', md5($publicacao->id));
                                echo $divopen;
                                $imagem = array('name' => 'userfile', 'id' => 'usefile', 'class' => 'form-control');
                                echo form_upload($imagem);
                                echo $divclose;
                                echo $divopen;
                                $botao = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'class' => 'btn btn-default',
                                    'value' => 'Adicionar nova imagem' );
                                echo form_submit($botao);
                                echo $divclose;
                                echo form_close();
                                endforeach;
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
    </div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->
</div>
