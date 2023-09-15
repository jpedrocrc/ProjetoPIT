<?php
ini_set( 'default_charset', 'UTF-8' );
//Chamando arquivos externos
require_once './Classes/ConexaoBD.php';
include_once './Classes/config.php';
require_once './Classes/CadastrarHabilidade.php';
session_start();
//Classe ConexaoBD
$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();
//classe CadastrarHabilidade
$CadastrarHabilidade = new CadastrarHabilidade($conexaoBanco);
$CadastrarHabilidade->verificarUsuarioLogado();
$CadastrarHabilidade->cadastrar();
$conexaoBanco->fecharConexao();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>Document</title>
  <style>
    header {
      background-color: #646B71;
      padding: 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    header img {
      cursor: pointer;
    }
  </style>
</head>

<body class="bg-image" style="background-image: url('../PHP/mainimg.png'); height: 100vh">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <img id="logoo" src="logo.png" onclick="window.location.href='paginaprincipal.php'"
        class="navbar-brand img-fluid scale-down" alt="Logo" style="width: 150px">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown"
        aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
        <ul class="navbar-nav">
          <!-- Adicione seus itens de menu aqui -->
        </ul>
        <?php if (!empty($nomeUsuario)): ?>
          <label class="navbar-text text-light">Bem-vindo,
            <?php echo $nomeUsuario; ?>
          </label>
        <?php endif; ?>
      </div>
      <div class="d-flex">
        <?php if (!empty($nomeUsuario)): ?>
          <form method="post" action="logout.php">
            <button class="btn btn-outline-light me-2" type="submit">Logout</button>
          </form>
        <?php else: ?>
          <button class="btn btn-outline-light me-2" type="button"
            onclick="window.location.href='PaginaLogin.php'">Login</button>
        <?php endif; ?>
        <button class="btn btn-light" type="button"
          onclick="window.location.href='CadastroTalento.php'">Registrar-se</button>
      </div>
    </div>
  </nav>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card text-white bg-dark p-3">
          <h1>Registro de Serviço</h1>
          <form method="POST" onsubmit="return validarFormulario()">
            <!-- Coluna 1 -->
            <div class="mb-3">
              <label for="descricao" class="form-label">Descrição sobre sua habilidade:</label>
              <textarea name="descricao" rows="5" cols="40" class="form-control"></textarea>
            </div>
            <div class="mb-3">
              <label for="servico" class="form-label">Tipo de Serviço:</label>
              <select id="servico" name="servico" required class="form-select">
                <option value="">Selecione o serviço</option>
                <option value="Agricultura">Agricultura</option>
                <option value="Alvenaria">Alvenaria</option>
                <option value="Arquitetura">Arquitetura</option>
                <option value="Assessoria Contábil">Assessoria Contábil</option>
                <option value="Assessoria Jurídica">Assessoria Jurídica</option>
                <option value="Concretagem">Concretagem</option>
                <option value="Construção civil">Construção civil</option>
                <option value="Construção e Reforma">Construção e Reforma</option>
                <option value="Demolição">Demolição</option>
                <option value="Design Gráfico">Design Gráfico</option>
                <option value="Design de Interiores">Design de Interiores</option>
                <option value="Desenvolvimento de Software">Desenvolvimento de Software</option>
                <option value="Eletricista">Eletricista</option>
                <option value="Encanador">Encanador</option>
                <option value="Fotografia">Fotografia</option>
                <option value="Jardinagem">Jardinagem</option>
                <option value="Limpeza residencial">Limpeza residencial</option>
                <option value="Manutenção Residencial">Manutenção Residencial</option>
                <option value="Manutenção de Veículos">Manutenção de Veículos</option>
                <option value="Marketing Digital">Marketing Digital</option>
                <option value="Montagem de móveis">Montagem de móveis</option>
                <option value="Movimentação de cargas">Movimentação de cargas</option>
                <option value="Paisagismo">Paisagismo</option>
                <option value="Pedreiro">Pedreiro</option>
                <option value="Pintura residencial">Pintura residencial</option>
                <option value="Redação de Conteúdo">Redação de Conteúdo</option>
                <option value="Serralheria">Serralheria</option>
                <option value="Serviços de Delivery">Serviços de Delivery</option>
                <option value="Serviços de Limpeza">Serviços de Limpeza</option>
                <option value="Serviços de TI">Serviços de TI</option>
                <option value="Telhados">Telhados</option>
                <option value="Topografia">Topografia</option>
                <option value="Tradução">Tradução</option>
                <option value="Vídeo e Edição">Vídeo e Edição</option>
                <option value="Web Design">Web Design</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="formacao" class="form-label">Formação:</label>
              <textarea id="formacao" name="formacao" rows="5" cols="40" class="form-control"></textarea>
            </div>
            <!-- Fim da Coluna 1 -->
        </div>
      </div>
      <div class="col-md-6">
        <div class="card text-white bg-dark p-3">
          <!-- Início da Coluna 2 -->
          <div class="mb-3">
            <label for="objetivo" class="form-label">Objetivo:</label>
            <textarea id="objetivo" name="objetivo" rows="5" cols="40" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label for="cursos_complementares" class="form-label">Cursos Complementares:</label>
            <textarea name="cursosComplementares" rows="5" cols="40" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label for="experiencia" class="form-label">Experiência:</label>
            <textarea name="experiencia" rows="5" cols="40" class="form-control"></textarea>
          </div>
          <div class="text-center mt-2">
            <button type="submit" class="btn btn-light">Registrar</button>
          </div>
          <!-- Fim da Coluna 2 -->
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>