<!doctype html>
<html lang='pt-br'>
<head>
    <meta charset='utf-8' />
    <link rel='icon' type='image/png' sizes='96x96' href='assets/img/favicon.png'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
    <title>Sistema de Gestão Acadêmica</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name='viewport' content='width=device-width' />
    <!-- Bootstrap core CSS     -->
    <link href='assets/css/bootstrap.min.css' rel='stylesheet' />
    <!-- Animation library for notifications   -->
    <link href='assets/css/animate.min.css' rel='stylesheet'/>
    <!--  Paper Dashboard core CSS    -->
    <link href='assets/css/paper-dashboard.css' rel='stylesheet'/>
    <!--  Fonts and icons     -->
    <link href='http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href='assets/css/themify-icons.css' rel='stylesheet'>
    <!--Meu estilo-->
    <link href='assets/css/estilo.css' rel='stylesheet'>

    <?php

    session_start();
    if ((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('location:login.php');
    }
    $logado = $_SESSION['login'];

    ?>
</head>
<body>
<div class='wrapper'>
    <div class='sidebar' data-background-color='white' data-active-color='danger'>

        <!--
    Tip 1: you can change the color of the sidebar's background using: data-background-color='white | black'
            Tip 2: you can change the color of the active button using the data-active-color='primary | info | success | warning | danger'
        -->

        <div class='sidebar-wrapper'>
            <div class='logo'>
                <a href='index.php'><img src='assets/img/logo.gif' width='220px'/></a>
            </div>

            <ul class='nav'>
                <li>
                    <a href='dashboard.php'>
                        <i class='ti-dashboard'></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href='instituicoes.php'>
                        <i class='ti-bookmark-alt'></i>
                        <p>Instituições</p>
                    </a>
                </li>
                <li>
                    <a href='cursos.php'>
                        <i class='ti-agenda'></i>
                        <p>Cursos</p>
                    </a>
                </li>
                <li>
                    <a href='professores.php'>
                        <i class='ti-user'></i>
                        <p>Professores</p>
                    </a>
                </li>
                <li>
                    <a href='disciplinas.php'>
                        <i class='ti-book'></i>
                        <p>Disciplinas</p>
                    </a>
                </li>
                <li>
                    <a href='turmas.php'>
                        <i class='ti-folder'></i>
                        <p>Turmas</p>
                    </a>
                </li>
                <li>
                    <a href='alunos.php'>
                        <i class='ti-id-badge'></i>
                        <p>Alunos</p>
                    </a>
                </li>
                <li>
                    <a href='avaliacao.php'>
                        <i class='ti-bar-chart-alt'></i>
                        <p>Avaliação</p>
                    </a>
                </li>
                <li>
                    <a href='usuarios.php'>
                        <i class='ti-user'></i>
                        <p>Usuários</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class='main-panel'>
        <nav class='navbar navbar-default'>
            <div class='container-fluid'>
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle'>
                        <span class='sr-only'>Toggle navigation</span>
                        <span class='icon-bar bar1'></span>
                        <span class='icon-bar bar2'></span>
                        <span class='icon-bar bar3'></span>
                    </button>
                </div>
                <div class='collapse navbar-collapse'>
                    <ul class='nav navbar-nav navbar-right'>
                        <li>
                            <i class='ti-calendar'></i>
                            <p>
                               <?php
                                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                echo strftime('%A, %d de %B de %Y', strtotime('today'));
                                ?>
                            </p>
                        </li>
                        <li>
                            <a href='sair.php'>
                                <i class='ti-'></i>
                                <p>Sair</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

<?php
/**
 * Created by PhpStorm.
 * User: tassio
 * Date: 09/01/2018
 * Time: 13:33
 */

require_once 'db/conexao.php';
require_once "dao/professorDAO.php";
require_once "classes/professor.php";


$professorDAO = new =professorDAO();

$endereco = $_SERVER ['PHP_SELF'];
$result = $daoProfessor->tabelaPaginada($endereco);
$dados = $result[0];
$primeira_pagina = $result[1];
$ultima_pagina  = $result[2];
$pagina_anterior = $result[3];
$proxima_pagina = $result[4];
$range_inicial  = $result[5];
$range_final   = $result[6];
$exibir_botao_inicio = $result[7];
$exibir_botao_final = $result[8];  
$pagina_atual = $result[9];
$linha_inicial  = $result[10];     


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $cargo = (isset($_POST["cargo"]) && $_POST["cargo"] != null) ? $_POST["cargo"] : "";
} else if (!isset($id)) {

    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $cargo = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    $professor = $daoProfessor->selecionarPorId($id);
    $id = $professor->getIdProfessor();
    $nome = $professor->getNome();
    $cargo = $professor->getCargo();
}

?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Professores</h4>
                                <p class='category'>Lista de professores do sistema</p>

                            </div>
                            <div class='content table-responsive'>

                                <form action="?act=save" method="POST" name="form1" >
                                    <hr>
                                    <i class="ti-save"></i>
                                    <input type="hidden" size="5" name="id" value="<?php
                                    // Preenche o id no campo id com um valor "value"
                                    echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                                    ?>" />
                                    Nome:
                                    <input type="text" size="50" name="nome" value="<?php
                                    // Preenche o nome no campo nome com um valor "value"
                                    echo (isset($nome) && ($nome != null || $nome != "")) ? $nome : '';
                                    ?>" />
                                    Cargo:
                                    <select name="cargo">
                                        <option value="PROFESSOR ASSISTENTE I" <?php if(isset($cargo) && $cargo=="PROFESSOR ASSISTENTE I") echo 'selected'?>>PROFESSOR ASSISTENTE I</option>
                                        <option value="PROFESSOR ASSISTENTE II" <?php if(isset($cargo) && $cargo=="PROFESSOR ASSISTENTE II") echo 'selected'?>>PROFESSOR ASSISTENTE II</option>
                                        <option value="PROFESSOR ADJUNTO I" <?php if(isset($cargo) && $cargo=="PROFESSOR ADJUNTO I") echo 'selected'?> >PROFESSOR ADJUNTO I</option>
                                        <option value="PROFESSOR ADJUNTO II" <?php if(isset($cargo) && $cargo=="PROFESSOR ADJUNTO II") echo 'selected'?>>PROFESSOR ADJUNTO II</option>
                                        <option value="PROFESSOR TITUTLAR I" <?php if(isset($cargo) && $cargo=="PROFESSOR TITULAR I") echo 'selected'?>>PROFESSOR TITUTLAR I</option>
                                        <option value="PROFESSOR TITUTLAR II" <?php if(isset($cargo) && $cargo=="PROFESSOR TITULAR II") echo 'selected'?>>PROFESSOR TITUTLAR II</option>
                                        <option value="PROFESSOR TITUTLAR III" <?php if(isset($cargo) && $cargo=="PROFESSOR TITUTLAR III") echo 'selected'?>>PROFESSOR TITUTLAR III</option>
                                    </select>
                                     <input type="submit" VALUE="Cadastrar"/>
                                    <hr>
                                </form>

                                <?php
                                if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
                                    $professor = new Professor($id, $nome, $cargo);
                                    $daoProfessor->salvar($professor);
                                }
                                if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
                                    $daoProfessor->remover($id);
                                }
                                ?>

    <?php if (!empty($dados)): ?>
     <table class='table table-striped table-bordered'>
     <thead>
       <tr class='active'>
        <th>Código</th>
        <th>Nome</th>
        <th>Cargo</th>
        <th colspan="2">Ações</th>
       </tr>
     </thead>
     <tbody>
       <?php foreach($dados as $professor):?>
       <tr>
        <td><?=$professor->idProfessor?></td>
        <td><?=$professor->Nome?></td>
        <td><?=$professor->Cargo?></td>
        <td><a href=<?='?act=upd&id='.$professor->idProfessor?>><i class="ti-reload"></i></a></td>
        <td><a href=<?='?act=del&id='.$professor->idProfessor?>><i class="ti-close"></i></a></td>
       </tr>
       <?php endforeach; ?>
     </tbody>
     </table>

     <div class='box-paginacao'>
       <a class='box-navegacao <?=$exibir_botao_inicio?>' href='<?=$endereco?>?page=<?=$primeira_pagina?>' title='Primeira Página'>Primeira</a>
       <a class='box-navegacao <?=$exibir_botao_inicio?>' href='<?=$endereco?>?page=<?=$pagina_anterior?>' title='Página Anterior'>Anterior</a>

      <?php
      /* Loop para montar a páginação central com os números */
      for ($i=$range_inicial; $i <= $range_final; $i++):
        $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;
        ?>
        <a class='box-numero <?=$destaque?>' href='<?=$endereco?>?page=<?=$i?>'><?=$i?></a>
      <?php endfor; ?>

       <a class='box-navegacao <?=$exibir_botao_final?>' href='<?=$endereco?>?page=<?=$proxima_pagina?>' title='Próxima Página'>Próxima</a>
       <a class='box-navegacao <?=$exibir_botao_final?>' href='<?=$endereco?>?page=<?=$ultima_pagina?>' title='Última Página'>Último</a>
     </div>
    <?php else: ?>
     <p class='bg-danger'>Nenhum registro foi encontrado!</p>
    <?php endif; ?>

   </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
<footer class='footer'>
    <div class='container-fluid'>
        <nav class='pull-left'>
            <ul>
                <li>
                    <a href='http://www.tassio.eti.br'  target='_blank'>Site do Prof. Tassio Sirqueira</a>
                </li>
                <li>
                    <a href='http://www.cesjf.edu.br/' target='_blank'>CES/JF.</a>
                </li>
            </ul>
        </nav>
        <div class='copyright pull-right'>
            &copy; <script>document.write(new Date().getFullYear())</script>, template made with <i class='fa fa-heart heart'></i> by <a href='http://www.creative-tim.com'>Creative Tim</a>
        </div>
    </div>
</footer>

</div>
</div>
</body>
</html>
