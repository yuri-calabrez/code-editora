# Desenvolvendo uma Editora Online com Laravel 5.3 - Code Education
## Fase 1 - Abrindo a Editora
Nesta fase você deverá cria o ambiente da aplicação Laravel 5.3 mostrado no capítulo inicial, bem como o CRUD de categorias.
Você deverá criar também um CRUD para os livros da loja virtual. O model livro deverá conter os seguintes campos:

* title - string (obrigatório)
* subtitle - string (obrigatório)
* price - float (obrigatório)

## Fase 2 - Form Request e autorização

Nesta fase você deverá criar um form request validation para categoria e livro. Crie também as regras de validação para os campos de cada modelo.

Agora você deverá criar uma relação entre livro e autor. Todo livro cadastrado deverá ter o seu respectivo autor associado.
A edição dos dados do livro só poderá ser feita pelo próprio autor, então, teremos que usar o form request validation para autorizar isto.

## Fase 3 - Organização da área administrativa

Nesta fase você deverá aplicar o Bootstrapper nos CRUD de categorias e livros.

Além disto quando o usuário enviar dados via formulário e estes dados forem inválidos e logo em seguida o cadastro for realizado, o usuário deve ser direcionado para a página anterior (Lembrando que no momento isto não ocorre, porque se os dados forem inválidos, a URL armazenada será a da própria página).

## Fase 4 - Repositories e Criterias

Nesta fase você deverá refatorar toda aplicação para trabalhar com repositories e criar buscas na listagem de livros e categorias

## Fase 5 - Exclusão lógica

Nesta fase você deverá:

* Criar o relacionamento entre livros e categorias
* Adicionar na busca de livros, a oportunidade de buscar livros pelo nome de um categoria por like.
* Implementar a exclusão lógica para livros e categorias
* Criar a lixeira de livros
* Estilizar as categorias excluídas quando mostradas na área de livros

## Fase 6 - Criando primeiro módulo

Nesta fase, você deverá criar o módulo de administração de livros e categorias como demonstrado no capítulo.

## Fase 7 - Cmeçando com Autorização

Nesta fase você deve implementar a autorização da área administrativa mostrada no capítulo e também toda parte de ACL. Além disto implemente um CRUD de Roles (só admins podem cadastrar roles).

O nome da Role deve ser único no banco de dados, então é necessário validar se o nome não existe e não deve ser permitido excluir a Role Admin padrão.