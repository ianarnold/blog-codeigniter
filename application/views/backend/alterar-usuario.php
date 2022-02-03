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
                                echo form_open('admin/usuarios/salvar_alteracoes');

                                foreach($usuarios as $usuario):
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

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo 'Imagem de destaque do '.$subtitulo ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            
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
