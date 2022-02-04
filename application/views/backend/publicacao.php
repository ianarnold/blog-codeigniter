<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo 'Administrar '.$subtitulo ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo 'Adicionar nova '.$subtitulo ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                echo validation_errors('<div class="alert alert-danger">', '</div>');
                                echo form_open('admin/publicacao/inserir');
                            ?>
                            <div class="form-group">
                            <label id="select-categoria">Categoria</label>
                            <select id="select-categoria" name="select-categoria" class="form-control">
                                <?php  
                                    foreach($categorias as $categoria):
                                ?>
                                <option value="<?php echo $categoria->id ?>"><?php echo $categoria->titulo ?></option>
                                <?php 
                                    endforeach;
                                ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control" 
                                placeholder="Digite o titulo da publicação"
                                id="txt-titulo" name="txt-titulo" value="<?php echo set_value('txt-titulo') ?>">
                            </div>
                            <div class="form-group">
                                <label>Subtítulo</label>
                                <input type="text" class="form-control" 
                                placeholder="Digite o subtitulo da publicação"
                                id="txt-subtitulo" name="txt-subtitulo" value="<?php echo set_value('txt-subtitulo') ?>">
                            </div>
                            <div class="form-group">
                                <label id="txt-historico">Conteúdo</label>
<textarea name="txt-conteudo" id="txt-conteudo" class="form-control" style="resize: vertical;"><?php echo set_value('txt-conteudo') ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Data</label>
                                <input type="datetime-local" class="form-control" 
                                placeholder="Digite a data da publicação"
                                id="txt-data" name="txt-data" value="<?php echo set_value('txt-data') ?>">
                            </div>
                            <input type="hidden" name="txt-usuario" id="txt-usuario"
                                   value="<?php echo $this->session->userdata('userLogado')->id; ?>">

                            <button type="submit" class="btn btn-default">Cadastrar</button>
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

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo 'Alterar '.$subtitulo. ' existente' ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <style>
                                img {
                                    width: 80px;
                                }
                            </style>
                            <?php 
                                $this->table->set_heading("Foto", "Título", "Data", "Alterar", "Excluir");
                                foreach($publicacoes as $publicacao) {
                                $titulo = $publicacao->titulo;

                                if($publicacao->img == 1) {
                                    $fotoPub = img("assets/frontend/img/publicacao/".md5($publicacao->id).".jpg");
                                } else {
                                    $fotoPub = img("assets/frontend/img/semFoto.png");
                                }
                                $data = postadoem($publicacao->data);
                                $alterar= anchor(base_url('admin/publicacao/alterar/'.md5($publicacao->id)), 
                                    '<i class="fa fa-refresh fa-fw"></i> Alterar');
                                $excluir= '<button type="button" class="btn btn-link" data-toggle="modal" data-target=".excluir-modal-'.$publicacao->id.'"><i class="fa fa-remove fa-fw"></i> Excluir</button>';

echo $modal= ' <div class="modal fade excluir-modal-'.$publicacao->id.'" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel2">Exclusão de publicacao</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Deseja Excluir a publicacao '.$publicacao->titulo.'?</h4>
                                                <p>Após Excluida a publicacao <b>'.$publicacao->titulo.'</b> não ficara mais disponível no Sistema.</p>
                                                <p>Todos os itens relacionados a publicacao <b>'.$publicacao->titulo.'</b> serão afetados e não aparecerão no site até que sejam editados.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <a type="button" class="btn btn-primary" href="'.base_url("admin/publicacao/excluir/".md5($publicacao->id)).'">Excluir</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>';

                                $this->table->add_row($fotoPub, $titulo, $data, $alterar, $excluir);
                            }
                            $this->table->set_template(array(
                                'table_open' => '<table class="table table-striped">'
                            ));
                                echo $this->table->generate();
                                echo "<div class='pagination'>".$links_pagination."</div>";
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
<!-- /#wrapper -->


<!-- 
<form role="form">
    <div class="form-group">
        <label>Titulo</label>
        <input class="form-control" placeholder="Entre com o texto">
    </div>
    <div class="form-group">
        <label>Foto Destaque</label>
        <input type="file">
    </div>
    <div class="form-group">
        <label>Conteúdo</label>
        <textarea class="form-control" rows="3" style="resize: vertical;"></textarea>
    </div>

    <div class="form-group">
        <label>Selects</label>
        <select class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Cadastrar</button>
    <button type="reset" class="btn btn-default">Limpar</button>
</form>
 -->