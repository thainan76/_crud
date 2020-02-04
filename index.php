<?php

    require('conexao.php');

    /* Criando um estaciamento */
    $mysqli = new conexao();

    /* Trazendo todos os clientes do banco de dados */
    $clientes = $mysqli->getClientes();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>CRUD</title>
        <meta charset="UTF-8">

        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>
    <body>
        
        <div class="container">

            <h1 class="text-center mt-5 mb-5">C<small>reate</small>R<small>ead</small>U<small>pdate</small>D<small>elete</small></h1>

            <div id="table">
                <button type="button" class="btn btn-success mb-5" data-toggle="modal" data-target="#create" onclick="limpaCampo()" >
                <i class="fas fa-plus"></i> Adicionar
                </button>
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-sm">Nome
                    </th>
                    <th class="th-sm">E-mail
                    </th>
                    <th class="th-sm">Telefone
                    </th>
                    <th class="th-sm">Endereço
                    </th>
                    <th class="th-sm">Bairro
                    </th>
                    <th class="th-sm">
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clientes as $cliente){?>
                    <tr>
                    <td><?php echo $cliente['nome'] ?></td>
                    <td><?php echo $cliente['email'] ?></td>
                    <td><?php echo $cliente['telefone']?></td>
                    <td><?php echo $cliente['endereco'] ?></td>
                    <td><?php echo $cliente['bairro'] ?></td>
                    <td>         
                        <input type="hidden" value=<?php echo preg_replace('/\s+/', '-',json_encode($cliente)) ?> id=<?php echo $cliente['id'] ?> />
                        <button type="button" class="btn btn-primary" onclick="adicionaCampo(<?php echo $cliente['id'] ?>)" data-toggle="modal" data-target="#create"><i class="fas fa-user-edit"></i> Editar</button>
                        <button type="button" class="btn btn-danger" onclick="remove(<?php echo $cliente['id'] ?>)"><i class="fas fa-trash-alt"></i> Remover</button>
                    </td>
                    </tr>
                    <?php }?>
                </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header" id="headerModal">
                <h5 class="modal-title" id="label">Adicionar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo">
                        <small class="validacao" id="validaNome">O campo nome não pode está vazio.</small>
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control"  id="email" name="email" placeholder="E-mail">
                        <small class="validacao" id="validaEmail">O campo E-mail não pode está vazio.</small>
                        <input type="hidden" id="id" name="id">
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="telefone" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Endereço">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success" id="botaoAcao" onclick="addOrUpdate()">Adicionar</button>
            </div>
            </div>
        </div>
        </div>

        <!-- JQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="js/crud.js" type="text/javascript"></script>

    </body>
    <footer>
    </footer>
</html>