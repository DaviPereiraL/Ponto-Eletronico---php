# Sistema de Pontos Eletrônicos

Este é um sistema de pontos eletrônicos desenvolvido em PHP com MySQL, projetado para gerenciar projetos e rastrear o tempo gasto neles pelos usuários. O sistema oferece funcionalidades de autenticação, cadastro de projetos, visualização de projetos e registro de tempo de entrada e saída em projetos.

## Funcionalidades

### Autenticação de Usuário
- **Login**: Permite que os usuários façam login com nome de usuário e senha.
- **Cadastro**: Permite que novos usuários se registrem no sistema.
- **Segurança**: As senhas são protegidas com criptografia para garantir a segurança dos dados.

### Gerenciamento de Projetos
- **Cadastrar Projetos**: Usuários autenticados podem criar novos projetos fornecendo um nome e uma descrição.
- **Visualizar Projetos**: Lista todos os projetos cadastrados com nome, descrição e quantidade de horas gastas.
- **Detalhes do Projeto**: Exibe os detalhes de um projeto específico, incluindo os registros de entrada e saída dos usuários.

### Rastreamento de Tempo
- **Entrar em Projetos**: Inicia um temporizador que registra a hora de entrada do usuário em um projeto.
- **Registrar Saída**: Salva a data e hora de saída quando o usuário termina o trabalho no projeto.

## Requisitos
- **Servidor Web**: Apache ou Nginx
- **PHP**: Versão 7.4 ou superior
- **Banco de Dados**: MySQL

## Instalação
1. **Clone o repositório**:
    ```sh
    git clone https://github.com/DaviPereiraL/Ponto-Eletronico---php.git
    ```
2. **Navegue até o diretório do projeto**:
    ```sh
    cd sistema-de-pontos-eletronicos
    ```
3. **Configure o banco de dados**:
    - Crie o banco de dados e as tabelas usando o script SQL fornecido em `db.sql`.
    - Configure a conexão com o banco de dados em `db.php`.
4. **Inicie o servidor web** e acesse o sistema através do navegador.

## Estrutura do Projeto
```plaintext
projeto/
├── css/
│   └── styles.css
├── php/
│   ├── db.php
│   ├── login.php
│   ├── register.php
│   ├── menu.php
│   ├── add_project.php
│   ├── view_projects.php
│   ├── project_details.php
│   ├── select_project.php
│   ├── delete_project.php
│   ├── logout.php
├── MySQL/
│   └── create_database.sql
└── index.php
```

## Principais Arquivos
- **index.php**: Página de login.
- **register.php**: Página de cadastro de novos usuários.
- **menu.php**: Menu principal após o login.
- **add_project.php**: Página para cadastrar novos projetos.
- **view_projects.php**: Página para visualizar todos os projetos.
- **select_project.php**: Página para selecionar um projeto.
- **delete_project.php**: Página para excluir um projeto.
- **db.php**: Arquivo de configuração da conexão com o banco de dados.
- **styles.css**: Arquivo CSS para estilização das páginas.

## Imagens 

Capturas de tela das principais páginas:
- **Login**:
  
![Login](https://github.com/user-attachments/assets/85e4b020-45a0-4520-9c9d-1a0f9764b159)

- **Cadastar novos usuários**:

![Cadastrar usuario](https://github.com/user-attachments/assets/af44cd44-3ee7-4db0-9b1c-dc1c6871380c)

- **Menu Principal**:

![Menu Principal](https://github.com/user-attachments/assets/4024ddc7-d1ef-404a-a06a-a780a1b12c44)

- **Cadastrar novos projetos**:

![Cadastar Projeto](https://github.com/user-attachments/assets/2fb9618d-3af8-42ad-8cf5-04e8bc31b717)

- **Visualizar todos os projetos**:

![Visualizar Projetos](https://github.com/user-attachments/assets/0c741ec3-e705-4f78-91ab-d861cacf7ee5)

- **Selecionar um projeto**:

![Selecionar Projeto](https://github.com/user-attachments/assets/014cc30a-bae4-4840-a64c-06c08893ee01)

- **Detalhes do Projeto**:

![Detalhes do Projeto](https://github.com/user-attachments/assets/4d94f59c-fefb-434c-bf1f-c49f0d699225)

- **Excluir um projeto**:

![Excluir Projeto](https://github.com/user-attachments/assets/69f09f7d-d19c-414e-9866-8e0ee0584853)

  
## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests.
