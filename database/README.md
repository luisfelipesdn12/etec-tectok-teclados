# Banco de dados

Translations: [:us: English](README.en.md)

[TD;DR - Muito longo, não li (resumo)](#tldr)

---

Estamos usando o MySQL como banco de dados.

## Configurando

Para criar o banco de dados e as tabelas, execute o arquivo `setup.sql`, isso irá:

- Criar um novo banco de dados chamado `etec_tectok_teclados`;
- Criar uma tabela de para as categorias dos produtos;
- Criar uma tabela para os produtos.

## Populando

Usa vez que o banco está criado, pode-se inserir os dados como quiser. Mas é recomendado executar o arquivo `base_data.sql` que criará categorias e produtos básicos.

## Views

Na aula [Aula 13 - Usando comando Inner join e criação de View](https://youtu.be/Bg-Uhy_wRlo) nós criamos uma view com todos os campos necessários para o código PHP.

Para criar a view, execute o arquivo `product_with_category_view.sql`.

Na view, basicamente se pode ver o nome da categoria dos produtos.

## TL;DR

> TL;DR: Muito longo, não li (resumo)

Execute os seguintes arquivos:

1. `setup.sql` - Cria o banco de dados e as tabelas.
2. `base_data.sql` - Popula inicialmente o banco de dados (opcional).
3. `product_with_category_view.sql` - Cria uma visualização dos produtos com a categoria.

## Solução de problemas

1. PDOException “could not find driver”

    Na primeira vez que eu rodei (no Linux), eu tive esse erro. Com uma pesquisa rápida eu encontrei [uma página do StackOverflow](https://stackoverflow.com/questions/2852748/pdoexception-could-not-find-driver) com várias opções de solução. A que funcionou pra mim foi instalar o driver mysql com:
    
    ```sh
    sudo apt-get install php7.0-mysql
    ```
