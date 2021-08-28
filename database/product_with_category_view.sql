use etec_tectok_teclados;

create view product_with_category as
select product.id,
       product.name  as name,
       product.price,
       product.description,
       product.quantity_available,
       product.image_url,
       product.category_id,
       product.is_new,
       category.name as category
from product
         inner join category on product.category_id = category.id;