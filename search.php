<?php
require_once('templates/header.php');
require_once('dao/ToughtsDAO.php');
require_once('conexao.php');
$toughtsDao = new ToughtsDAO($conn,$URL);
// $toughts = $toughtsDao->showAll();
//  var_dump($_GET);
 $termo = strip_tags(filter_input(INPUT_GET,'p',FILTER_DEFAULT));
 $toughts = $toughtsDao->search($termo);
//  var_dump($toughts);
?>
<section id="toughts">
       <div class="toughts-container">
        <h1>Este são os resultados para a busca: <span><?=$termo?></span></h1>
            <a class="clear" href="<?=$URL?>tought.php">Limpar</a>
        <div class="toughts-box-container">
            <?php if(!empty($toughts)):?>
            <?php foreach($toughts as $tought):?>
            <figure>
                <blockquote><?=$tought->title?></blockquote>
                <figcaption>por <span><?=$tought->name?></span></figcaption>
            </figure>
            <?php endforeach;?>
            <?php else: ?>
                <div class="empty-box">
                <p>Nenum resultado foi encontrado para a sua busca <span>&#128549;</span></p>
                </div>
            <?php endif ;?>
        </div>
       </div>
    </section>
<?php
require_once('templates/footer.php');
?>