<?php
require_once('templates/header.php');
require_once("dao/ToughtsDAO.php");
require_once("globals.php");
require_once("conexao.php");
require_once('function/FormatData.php');
require_once('function/VerifyLogin.php');
//verificar login
$verify = VerifyLogin::verifyLogin();

$toughtDao = new ToughtsDAO($conn, $URL);
//trazer os pensamentos do usuário
$toughts = $toughtDao->findById($_SESSION['user_id']);
// var_dump($toughts);
?>
    <section id="dashboard">
        <div class="dashboard-container">
            <h1>Pensamentos by <span><?=$_SESSION['user_name']?></span></h1>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Pensamento</th>
                        <th>Criado em</th>
                        <th>Modificado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($toughts as $tought):
                        extract($toughts);
                        ?>
                    <tr>
                        <td><?=$tought->id?></td>
                        <td><?=$tought->title?></td>
                        <td><?=FormatData::formatarData($tought->createdAt)?></td>
                        <td><?=FormatData::formatarData($tought->updatedAt)?></td>
                        <td class="actions">
                            <a href="<?=$URL?>editTought.php?id=<?=$tought->id?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form id="form-delete" action="<?=$URL?>toughts_process.php" method="POST">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id" value="<?=$tought->id?>">
                                <!-- <button id="delete" onclick="delToughts()" type="submit" class="fa-solid fa-circle-xmark"></button> -->
                                <button id="delete" type="submit" class="fa-solid fa-circle-xmark"></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </section>


<?php
require_once('templates/footer.php')
?>
