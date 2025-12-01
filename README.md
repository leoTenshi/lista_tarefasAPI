### API Lista de Tarefas (PHP + JWT)



#### API construída em PHP puro seguindo o padrão MVC adaptado para API, com autenticação via JWT.



Todas as operações que lidam com tarefas e categorias exigem token de autenticação.



##### Tecnologias Utilizadas:

\- PHP 8+

\- MySQL

\- Composer

\- Biblioteca JWT: firebase/php-jwt

\- Arquitetura MVC adaptada para API



##### Como rodar o projeto:

Clonar este repositório dentro do XAMPP:

D:\\xampp\\htdocs\\lista_tarefas





##### Criar o banco no MySQL e rodar o script SQL fornecido (usuarios, categorias, tarefas):

Instalar dependências via Composer:

composer require firebase/php-jwt





A aplicação ficará acessível em:

http://localhost/lista_tarefas





##### Padrão de Resposta da API

Todas as respostas seguem este formato:



Sucesso:

{

&nbsp; "status": true,

&nbsp; "erro": null,

&nbsp; "retorno": { }

}



Erro:

{

&nbsp; "status": false,

&nbsp; "erro": "Mensagem amigável",

&nbsp; "retorno": null

}



Nenhum erro técnico (SQL, stacktrace, warning, etc.) é exposto ao usuário.





##### Autenticação

Antes de acessar qualquer endpoint protegido, é necessário gerar um token usando o endpoint /login.



1\. Login

POST /login

Content-Type: application/json



Body (JSON)

{

&nbsp; "email": "admin@example.com",

&nbsp; "senha": "123456"

}



Retorno

{

&nbsp;   "status": true,

&nbsp;   "erro": null,

&nbsp;   "retorno": {

&nbsp;       "token": "..."

&nbsp;   }

}



##### Como enviar o token nas demais requisições:

Coloque no header:

Authorization: Bearer SEU\_TOKEN\_AQUI



##### Endpoints de Tarefas:



Todos os endpoints abaixo exigem token JWT.



2.1 Listar tarefas

GET /tarefa

Authorization: Bearer TOKEN



Retorno
{

&nbsp;   "erro": null,

&nbsp;   "retorno": \[

&nbsp;       {

&nbsp;           "id": 2,

&nbsp;           "titulo": "Estudar para prova",

&nbsp;           "descricao": "Revisar conteúdo de banco de dados",

&nbsp;           "status": "em\_andamento",

&nbsp;           "usuario\_id": 1,

&nbsp;           "categoria\_id": 2,

&nbsp;           "usuario\_nome": "Admin"

&nbsp;       }

&nbsp;    ]

}



2.2 Criar tarefa

POST /tarefa

Content-Type: application/json

Authorization: Bearer TOKEN



Body

{

&nbsp; "titulo": "Estudar API",

&nbsp; "descricao": "Ler os slides",

&nbsp; "usuario\_id": 1,

&nbsp; "categoria\_id": 2

}



Retorno

{

&nbsp; "status": true,

&nbsp; "erro": null,

&nbsp; "retorno": {

&nbsp;   "mensagem": "Tarefa cadastrada com sucesso"

&nbsp; }

}



2.3 Alterar status da tarefa

PATCH /tarefa

Content-Type: application/json

Authorization: Bearer TOKEN



Body

{

&nbsp; "id": 1,

&nbsp; "status": "concluida"

}



2.4 Excluir tarefa

DELETE /tarefa

Content-Type: application/json

Authorization: Bearer TOKEN



Body

{

&nbsp; "id": 1

}



##### Endpoints de Categorias



Também exigem token JWT.



3.1 Listar categorias

GET /categoria

Authorization: Bearer TOKEN



3.2 Criar categoria

POST /categoria

Authorization: Bearer TOKEN

Content-Type: application/json



Body

{

&nbsp; "nome": "Saúde"

}



3.3 Excluir categoria

DELETE /categoria

Authorization: Bearer TOKEN

Content-Type: application/json



Body

{

&nbsp; "id": 3

}



##### Erros e Autenticação

Token não enviado

{

&nbsp; "status": false,

&nbsp; "erro": "Token não enviado",

&nbsp; "retorno": null

}



Token inválido ou expirado

{

&nbsp; "status": false,

&nbsp; "erro": "Token inválido ou expirado",

&nbsp; "retorno": null

}



##### Observações finais



Todos os endpoints retornam JSON.

Todos os métodos da API passaram por tratamento de erros com try/catch.

Nenhuma mensagem técnica é exibida diretamente ao usuário.

Tarefas e categorias exigem autenticação via JWT.

