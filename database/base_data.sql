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
       (default, 'Testador de switches Kono BOX', 50, 'Perfeito para você testar múltiplos switches antes de escolher um.',
        10, 'https://i.ibb.co/7yjF0Gg/image.png', 3, true),
       (default, 'Teclado Retrotrip Deskmats', 203.21, 'Ergonômico e confortável, junta minimalismo com funcionalidade.',
        10, 'https://i.ibb.co/j4sgLmW/image.png', 1, false),
       (default, 'Luvas Quentinhas para digitação', 39.9, 'Luvinhas para digitação mesmo em um um dia friozinho. Confortáveis e quentinhas.',
        10, 'https://i.ibb.co/4S2thkr/image.png', 7, false);

insert into user
values (default, 'Luis Felipe', 'luisfelipesdn12@gmail.com', 'nDwzAPz5fF8Nl43u', 'admin', '17560057', 1000),
       (default, 'Yuri', 'yuri@discovery.kids', 'golias<3', default, '13233300', 544),
       (default, 'Golias', 'golias@discovery.kids', 'yuriS2', default, '12919381', 956);
