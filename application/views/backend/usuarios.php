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
                                echo form_open('admin/usuarios/inserir');
                            ?>

                            <div class="form-group">
                                <label>Nome do Usuário</label>
                                <input type="text" class="form-control" 
                                placeholder="Digite o nome do usuário"
                                id="txt-nome" name="txt-nome" value="<?php echo set_value('txt-nome') ?>">
                            </div>
                            <div class="form-group">
                                <label>Email do Usuário</label>
                                <input type="email" class="form-control" 
                                placeholder="Digite o email do usuário"
                                id="txt-email" name="txt-email" value="<?php echo set_value('txt-email') ?>">
                            </div>
                            <div class="form-group">
                                <label id="txt-historico">Histórico do Usuário</label>
                                <textarea name="txt-historico" id="txt-historico" class="form-control" style="resize: vertical;">
                                    <?php echo set_value('txt-historico') ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>User do Usuário</label>
                                <input type="text" class="form-control" 
                                placeholder="Digite o user do usuário"
                                id="txt-user" name="txt-user" value="<?php echo set_value('txt-user') ?>">
                            </div>
                            <div class="form-group">
                                <label>Senha do Usuário</label>
                                <input type="password" class="form-control" 
                                    id="txt-senha" name="txt-senha">
                            </div>
                            <div class="form-group">
                                <label>Confirmar senha</label>
                                <input type="password" class="form-control" 
                                    id="txt-confir-senha" name="txt-confir-senha">
                            </div>

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

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo 'Alterar '.$subtitulo. ' existente' ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php 
                            $this->table->set_heading("Foto", "Nome do Usuário", "Alterar", "Excluir");
                            foreach($usuarios as $usuario) {
                                $nomeUser= $usuario->nome;
                                $fotoUser = "Foto";
                                $alterar= anchor(base_url('admin/usuarios/alterar/'.md5($usuario->id)), 
                                    '<i class="fa fa-refresh fa-fw"></i> Alterar');
                                $excluir= anchor(base_url('admin/usuarios/excluir/'.md5($usuario->id)), 
                                    '<i class="fa fa-remove fa-fw"></i> Excluir');

                                $this->table->add_row($fotoUser, $nomeUser, $alterar, $excluir);
                            }
                            $this->table->set_template(array(
                                'table_open' => '<table class="table table-striped">'
                            ));
                            echo $this->table->generate();
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