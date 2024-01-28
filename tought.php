<?php
require_once('templates/header.php');
require_once('dao/ToughtsDAO.php');
require_once('conexao.php');
$toughtsDao = new ToughtsDAO($conn, $URL);
$order = $_GET['order'] ?? "desc";
$page = $_GET['page'] ?? 1;
// var_dump($order);
$toughts = $toughtsDao->showAll($page, $order);
// var_dump($toughts);
$limitPage = 10;
$registros = $toughtsDao->countToughts();
// var_dump($registros);
// die();
$totalPage = ceil($registros[0] / $limitPage);
// var_dump($totalPage);
$maxLinks = 5;
?>

<section id="toughts">
    <div class="toughts-container">
        <h1>Conheça alguns dos nossos pensamentos</h1>
        <div class="toughts-search">
            <form action="<?= $URL ?>search.php" method="get">
                <!-- <input type="hidden" name="type" value="search"> -->

                <input type="text" name="p" placeholder="Digite a sua busca">
                <button type="submit">Buscar</button>
            </form>
        </div>
        <div class="order-container">
            <span>Ordenar por </span>
            <form action="<?= $URL ?>toughts_process.php" method="POST">
                <input type="hidden" name="pagina" value="<?= $page ?>">
                <input type="hidden" name="type" value="order">
                <input type="hidden" name="order" value="new">
                <button type="submit"><i class="fa-solid fa-arrow-up"></i></button>
            </form>
            <form action="<?= $URL ?>toughts_process.php" method="POST">
                <input type="hidden" name="pagina" value="<?= $page ?>">
                <input type="hidden" name="type" value="order">
                <input type="hidden" name="order" value="old">
                <button type="submit"><i class="fa-solid fa-arrow-down"></i></button>
            </form>
            <a href="<?= $URL ?>tought.php">Limpar</a>
        </div>
        <div class="toughts-box-container">
            <?php foreach ($toughts as $tought) :
                // extract($toughts); 
            ?>
                <figure>
                    <blockquote><?= $tought['title'] ?></blockquote>
                    <figcaption>por <span><?= $tought['name'] ?></span></figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
    
</section>

<?php
    $pagina = "<ul class='paginacao'>";
     $pagina .= "<li><a href='tought.php?page=1'>Primeria</a></li>";
    for($beforePage = $page - $maxLinks;$beforePage <= $page - 1;$beforePage++){
        if($beforePage >= 1){
            $pagina .= "<li><a href='tought.php?page={$beforePage}'>{$beforePage}</a></li>";
        }
    }
     $pagina .= "<li><a class='selected' href='tought.php?page={$page}'>$page</a></li>";
    for($afterPage = $page + 1; $afterPage <=$page + $maxLinks; $afterPage++){
        if($afterPage <= $totalPage){
            $pagina .="<li><a href='tought.php?page={$afterPage}'>$afterPage</a></li>";
        }
    }
    $pagina .= "<li><a href='tought.php?page={$totalPage}'>Última</a></li>";
    $pagina .= "</ul>";
    echo $pagina;
?>

 <?php
require_once('templates/footer.php');
?>