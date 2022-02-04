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
                            foreach($usuarios as $usuario):
                            echo form_open('admin/usuarios/salvar_alteracoes/'. md5($usuario->id).'/'.$usuario->user);
                                ?>

                                <div class="form-group">
                                    <label>Nome do Usuário</label>
                                    <input type="text" class="form-control" 
                                    placeholder="Digite o nome do usuário"
                                    id="txt-nome" name="txt-nome" value="<?php echo $usuario->nome ?>">
                                </div>
                                <div class="form-group">
                                    <label>Email do Usuário</label>
                                    <input type="email" class="form-control" 
                                    placeholder="Digite o email do usuário"
                                    id="txt-email" name="txt-email" value="<?php echo $usuario->email ?>">
                                </div>
                                <div class="form-group">
                                    <label id="txt-historico">Histórico do Usuário</label>
                                    <textarea name="txt-historico" id="txt-historico" class="form-control" style="resize: vertical;">
                                        <?php echo $usuario->historico ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>User do Usuário</label>
                                    <input type="text" class="form-control" 
                                    placeholder="Digite o user do usuário"
                                    id="txt-user" name="txt-user" value="<?php echo $usuario->user ?>">
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

                                <input type="hidden" name="txt-id" id="txt-id" value="<?php echo $usuario->id ?>">

                                <button type="submit" class="btn btn-default">Atualizar usuário</button>
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
                    <div class="panel-body">
                        <div class="row" style="padding-bottom: 10px;">
                            <div class="col-lg-3 col-lg-offset-3">
                                <style>
                                    img {
                                        width: 200px;
                                    }
                                </style>
                                <?php 
                                    if($usuario->img == 1) {
                                        echo img("assets/frontend/img/usuarios/".md5($usuario->id).".jpg");
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
                                    echo form_open_multipart('admin/usuarios/nova_foto');
                                    echo form_hidden('id', md5($usuario->id));
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
