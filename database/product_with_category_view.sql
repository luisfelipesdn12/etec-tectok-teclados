use etec_tectok_teclados;

create view product_with_category as
select product.*,
       category.name as category
from product
         inner join category on product.category_id = category.id;