use etec_tectok_teclados;

insert into category
values (default, 'Teclados'),
       (default, 'Teclas'),
       (default, 'Switches'),
       (default, 'Ferramentas'),
       (default, 'Adesivos'),
       (default, 'Mousepads'),
       (default, 'Acessórios'),
       (default, 'Outros');

insert into product
values (default, 'Teclado ePBT Sweet', 389.90, 'Com cores em tons pastéis contrastando o rosa com o azul.',
        10, 'https://i.ibb.co/NTDTSpz/image.png', 1, true),
       (default, 'Testador de switches Kono BOX', 50,
        'Perfeito para você testar múltiplos switches antes de escolher um.',
        10, 'https://i.ibb.co/7yjF0Gg/image.png', 3, true),
       (default, 'Teclado Retrotrip Deskmats', 203.21,
        'Ergonômico e confortável, junta minimalismo com funcionalidade.',
        10, 'https://i.ibb.co/j4sgLmW/image.png', 1, false),
       (default, 'Luvas Quentinhas para digitação', 39.9,
        'Luvinhas para digitação mesmo em um um dia friozinho. Confortáveis e quentinhas.',
        10, 'https://i.ibb.co/4S2thkr/image.png', 7, false),
       (default, 'Teclado Shurikey Hanzo', 239.9,
        'Com diversas opções de switches e um design agradável para diversos setups.', 6,
        'https://i.ibb.co/m9BpP8M/image.png', 1, true),
       (default, 'Pad para Teclado Marble', 35.9,
        'Um mousepad grande para mouse e teclado com estampa abstrata.', 50,
        'https://i.ibb.co/Yj0q3Kx/image.png', 6, false),
       (default, 'Micro Monitor e Micro Teclado', 450,
        'Tecladinho e monitorzinho em miniatura, funciona com USB-C.', 4,
        'https://i.ibb.co/HPjRLj3/image.png', 8, false),
       (default, 'Teclado GMK Pride', 240,
        'Teclado ergonômico e com teclas coloridas. Parte das vendas destinadas à instituições acolhimento', 40,
        'https://i.ibb.co/jbkqWDL/image.png', 1, true),
       (default, 'Adesivos para Notebook Octocat', 25,
        'Adesivo horizontal para a traseira de notebook do GitHub.', 1230,
        'https://i.ibb.co/N285zP2/image.png', 5, false),
       (default, 'Kit de Ferramentas para Teclados', 59.9,
        'Ferramentas para limpar, tirar teclas e cuidar dos teclados.', 20,
        'https://i.ibb.co/vCNw1W9/image.png', 4, false),
       (default, 'Pad Magic Subway para Teclado e Mouse', 32,
        'Cuidadosamente feito designers emergentes, com acabamento minucioso.', 223,
        'https://i.ibb.co/LCcHCT3/image.png', 6, false),
       (default, 'Cabo USB-C', 18,
        'Cabo durável, resistente e de alta qualidade.', 2183,
        'https://i.ibb.co/FD2Xq8W/image.png', 7, false);

insert into user
values (default, 'Luis Felipe', 'luisfelipesdn12@gmail.com', 'nDwzAPz5fF8Nl43u', 'admin', '17560057', 1000),
       (default, 'Yuri', 'yuri@discovery.kids', 'golias<3', default, '13233300', 544),
       (default, 'Golias', 'golias@discovery.kids', 'yuriS2', default, '12919381', 956);
