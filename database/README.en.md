# Database

Translations: [:brazil: Português (BR)](README.md)

[TD;DR - Too long, didn't read (summary)](#tldr)

---

We are using MySQL as the database.

## Setting up

To create the database and the tables, execute the `setup.sql` file, it will:

- Create a new database `etec_tectok_teclados`;
- Create a table for the product categories;
- Create a table for the products.

## Populating

Once the database is created, data can be inserted as you prefer. But is recommended to execute the `base_data.sql` file, it creates basic categories and products.

## Views

In the class [Aula 13 - Usando comando Inner join e criação de View](https://youtu.be/Bg-Uhy_wRlo), we've created a view with all the necessary fields for the PHP code.

To create the view, execute the `product_with_category_view.sql` file.

In the view, basically is possible to get the category name of the products.

## TL;DR

> TL;DR: Too long, didn't read (summary)

Execute the following files:

1. `setup.sql` - Creates the database and the tables.
2. `base_data.sql` - Initially populates the database (optional).
3. `product_with_category_view.sql` - Creates a view of the products with their categories.
