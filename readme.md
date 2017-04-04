#Desenvolvendo uma Editora Online com Laravel 5.3 - Code Education
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