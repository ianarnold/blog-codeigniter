<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                <?php echo $titulo; ?>
                <small>> 
                    <?php 
                        if($subtitulo != '') {
                            echo $subtitulo;
                        } else {
                            foreach($subtitulodb as $dbtitulo) {
                                echo $dbtitulo->titulo;
                            }
                        }
                    ?>
                 </small>
            </h1>

            <!-- Blog Posts -->

            <?php foreach($postagem as $destaque) : ?>

                <h2>
                    <a href="<?php echo base_url('postagem/'. $destaque->id .'/'.limpar($destaque->titulo)) ?>"><?php echo $destaque->titulo ?></a>
                </h2>
                <p class="lead">
                    por <a href="<?php echo base_url('autor/'. $destaque->idautor . '/' . limpar($destaque->nome)); ?>"><?php echo $destaque->nome ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span>  <?php echo postadoem($destaque->data) ?></p>
                <hr>
                <?php 
                    if($destaque ->img == 1):
                        $fotoPub = base_url("assets/frontend/img/publicacao/".md5($destaque->id).".jpg");
                ?>
                <img class="img-responsive" src="<?php echo $fotoPub ?>" alt="">
                <hr>
                <?php
                    endif;
                ?>
                <p><?php echo $destaque->subtitulo ?></p>
                <a class="btn btn-primary" href=""<?php echo base_url('postagem/'. $destaque->id .'/'.limpar($destaque->titulo)) ?>>Leia mais <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php endforeach;
                echo "<div class='pagination'>".$links_pagination."</div>";
             ?>

        </div>