# etec-tectok-teclados
Uma loja virtual de teclados feita nas aulas de PW-II na ETEC com PHP e bootstrap

Translations: [:us: English](README.en.md)

---

<a href="https://tectok.herokuapp.com" target="_blank" rel="noopener noreferrer">
    <img src="https://tectok.herokuapp.com/assets/tectok-banner.svg" width="100%" />
</a>

<p align="center">
    <strong><a href="https://tectok.herokuapp.com" target="_blank" rel="noopener noreferrer">tectok.herokuapp.com</a></strong>
</p>

## Funcionalidades

- 📂 Conexão com banco de dados MySQL
- 🛑 Cuidadoso tratamento de erros
- 💥 Seção de "novidades"
- 🔖 Seção para cada categoria
- 🆔 Log-in de usuário
- 🔍 Sistema de buscas
- 👤 Seção de administrador
- 🌐 Implantação do site na web e atualizações baseadas em Git

## Demo

### Desktop

![](demo/desktop.png)

### Mobile

<img src="demo/mobile.png" height="500rem" />

## Rodando

Como rodar o projeto localmente.

### Usando o Servidor de Desenvolvimento do PHP

Para o meu uso pessoal, eu acho que a CLI [`php`](https://www.php.net/downloads.php) é a melhor maneira de inicial um servidor local.

1. Clone este repositório
2. No diretório raiz do repositório, rode:

```sh
php -S localhost:4002 -t src

# ou usando o composer:
composer start
```

> Você pode escolher qualquer outra porta

3. Vá para `http://localhost:4002`
