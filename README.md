# Sistema Gerenciador de Tarefas

Um sistema simples para controle de tarefas, desenvolvido em PHP com MySQL, que permite cadastrar, gerenciar e acompanhar tarefas, responsáveis e categorias.

## Funcionalidades

- **Cadastro de Tarefas**: Adicione novas tarefas com título, descrição, categoria e responsável.
- **Gerenciamento de Tarefas**: Iniciar, pausar, reiniciar e finalizar tarefas.
- **Cálculo de Duração**: Exibição do tempo total decorrido e do tempo total pausado para cada tarefa.
- **Gestão de Categorias e Responsáveis**: Cadastre, edite e exclua categorias e responsáveis.
- **Interface Intuitiva**: Desenvolvido com HTML, CSS e Bootstrap.

## Estrutura do Projeto

O projeto é dividido nos seguintes arquivos e diretórios:

- **`pagina_inicial.php`**: Página inicial com links para todas as funcionalidades.
- **`listar_tarefas.php`**: Lista todas as tarefas cadastradas e permite ações como editar e excluir.
- **`cadastrar_tarefa.php` e `salvar_tarefa.php`**: Funcionalidades para criar novas tarefas.
- **`editar_tarefa.php` e `salvar_editar_tarefa.php`**: Funcionalidades para editar tarefas existentes.
- **`excluir_tarefa.php`**: Permite excluir tarefas.
- **`iniciar_tarefa.php`, `pausar_tarefa.php`, e `reiniciar_tarefa.php`**: Gerenciamento do status das tarefas.
- **Banco de Dados**:
  - `tarefas`: Tabela principal das tarefas.
  - `categorias`: Tabela para categorias.
  - `responsaveis`: Tabela para responsáveis.

## Tecnologias Utilizadas

- **Backend**: PHP
- **Banco de Dados**: MySQL
- **Frontend**: HTML, CSS e Bootstrap

## Requisitos para Instalação

1. **Servidor PHP** (ex.: [XAMPP](https://www.apachefriends.org/) ou [Laragon](https://laragon.org/))
2. **MySQL** para gerenciar o banco de dados.
3. **Navegador Web** para acessar a interface.

## Configuração do Ambiente

1. Clone este repositório e execute o comando a seguir no terminal ou na linha de comando:
   ```bash
   git clone https://github.com/ana-ruth-bezerra/controle-de-tarefas.git
   cd controle-de-tarefas

  1.1 Ou faça o download deste repositório; 
   
2. Configure o banco de dados:
  Crie um banco de dados chamado controle_tarefas.
  Importe o arquivo **`scripts.sql`**

3. Inicie o servidor e acesse o projeto via navegador:
  http://localhost/controle-de-tarefas/

## Como Usar

1. Acesse a página inicial (`pagina_inicial.php`).
2. Utilize os links para cadastrar, listar e gerenciar tarefas, categorias e responsáveis.
3. Gerencie o status das tarefas através das opções disponíveis na tabela.

## Licença

  Este projeto está sob a licença [MIT](https://mit-license.org/).

## Desenvolvido por:
  Ana Ruth Bezerra

## Contato

  an.bezerra@gmail.com
