#Restaurants
INSERT INTO `mezamu`.`restaurants` (`id`, `company_name`, `name`, `logo`,`nit`,`slug`) VALUES ('1', 'Balu', 'Balu', 'balu.png','1030599027','balu');

#Branch
INSERT INTO `mezamu`.`branches` (`id`, `created_at`, `updated_at`, `location`, `restaurant_id`, `tables`, `telefono`, `email`, `latitude`, `longitude`, `delivery_price_type`, `delivery_price`, `coverage`) VALUES ('1', NULL, NULL, 'cajica', '1', '5', '573182659093', 'andresmaomorales@gmail.com', '4.620221','-74.113875', '1', '1000', '10000');

#User - admin_mezamu
INSERT INTO `mezamu`.`users` (`id`, `name`, `email`, `password`, `role`, `branch_id`) VALUES ('1', 'Admin MeZamÜ', 'mezamucorporativo@gmail.com', '$2y$10$8iK5BlsTeFYgMw5d054iI.s2fGlb14/tBq8uaufk5s8lMj4TpnzcW', 'administrador', '1');

#Categorias
INSERT INTO `mezamu`.`categories` ( `description`) VALUES ('Para Comenzar');
INSERT INTO `mezamu`.`categories` ( `description`) VALUES ('Fuertes');
INSERT INTO `mezamu`.`categories` ( `description`) VALUES ('Menú Infantil');
INSERT INTO `mezamu`.`categories` ( `description`) VALUES ('Bebidas Frías');
INSERT INTO `mezamu`.`categories` ( `description`) VALUES ('Bebidas Calientes');
INSERT INTO `mezamu`.`categories` ( `description`) VALUES ('La Cocina Dulce Balú');

#Dish
INSERT INTO `mezamu`.`dishes` (`category_id`, `name`, `description`, `price`, `photo`) VALUES ('1', 'Patacones', '(2 UNIDADES) Con Hogao y Guacamole.', '12000', 'patacones.png');
INSERT INTO `mezamu`.`dishes` (`category_id`, `name`, `description`, `price`, `photo`) VALUES ('1', 'Empanadas Balú', '(3 UNIDADES) Rellenas de Carne Molida y
Papa Criolla, con Ají.', '8000', 'empanadas.png');
INSERT INTO `mezamu`.`dishes` (`category_id`, `name`, `description`, `price`, `photo`) VALUES ('1', 'Empanadas de Lechona', '(3 UNIDADES) De Masa de Arroz y Maíz,
con Ají.', '10000', 'empanadas.png');
INSERT INTO `mezamu`.`dishes` (`category_id`, `name`, `description`, `price`, `photo`) VALUES ('1', 'Cacho Balu', '(5 UNIDADES) Cinco Dados de Queso
Campesino, Apanados en Polvo de Achiras, sobre Una Base de Tomates Asados.', '10000', 'cacho.png');
INSERT INTO `mezamu`.`dishes` (`category_id`, `name`, `description`, `price`, `photo`) VALUES ('1', 'Croquetas de Balú', '(3 UNIDADES) Rellenas De Quesos
Colombianos y Salsa de Bocadillo y Coco.', '8000', 'croqueta-maduro.jpg');
INSERT INTO `mezamu`.`dishes` (`category_id`, `name`, `description`, `price`, `photo`) VALUES ('1', 'Arepa de choclo', 'Con Mezcla de Quesos
Colombianos y Maíz.', '15000', 'arepa-choclo.png');
INSERT INTO `mezamu`.`dishes` (`category_id`, `name`, `description`, `price`, `photo`) VALUES ('1', 'Superchicharrón', 'Con Picadillo Criollo, Papas
Nativas y Guacamole.', '20000', 'superchicharron.png');
INSERT INTO `mezamu`.`dishes` (`category_id`, `name`, `description`, `price`, `photo`) VALUES ('1', 'Chorizos Aguarapados', 'Base de Papa Criolla Con
Chorizos Salteados en Reducción de Guarapo.', '15000', 'default.png');
INSERT INTO `mezamu`.`dishes` (`category_id`, `name`, `description`, `price`, `photo`) VALUES ('1', 'Sopa de Cebolla', 'Con Queso, Setas y Pan
Fresco.', '16000', 'default.png');
INSERT INTO `mezamu`.`dishes` (`category_id`, `name`, `description`, `price`, `photo`) VALUES ('2', 'Pasta Fesca Con Queso', 'Pasta Artesanal
Acompañada de Pan.', '25000', 'pasta-quesos.png');


#Dish Branch
INSERT INTO `mezamu`.`dish_branch` (`branch_id`, `dish_id`) VALUES ('1', '1');
INSERT INTO `mezamu`.`dish_branch` (`branch_id`, `dish_id`) VALUES ('1', '2');
INSERT INTO `mezamu`.`dish_branch` (`branch_id`, `dish_id`) VALUES ('1', '3');
INSERT INTO `mezamu`.`dish_branch` (`branch_id`, `dish_id`) VALUES ('1', '4');
INSERT INTO `mezamu`.`dish_branch` (`branch_id`, `dish_id`) VALUES ('1', '5');
INSERT INTO `mezamu`.`dish_branch` (`branch_id`, `dish_id`) VALUES ('1', '6');
INSERT INTO `mezamu`.`dish_branch` (`branch_id`, `dish_id`) VALUES ('1', '7');
INSERT INTO `mezamu`.`dish_branch` (`branch_id`, `dish_id`) VALUES ('1', '8');
INSERT INTO `mezamu`.`dish_branch` (`branch_id`, `dish_id`) VALUES ('1', '9');
INSERT INTO `mezamu`.`dish_branch` (`branch_id`, `dish_id`) VALUES ('1', '10');

#Dish schedule_branch
INSERT INTO `mezamu`.`schedule_branch` (`day`, `branch_id`, `open`, `close`) VALUES ('Monday', '1', '08:00:00', '2:00:00');
INSERT INTO `mezamu`.`schedule_branch` (`day`, `branch_id`, `open`, `close`) VALUES ('Tuesday', '1', '08:00:00', '2:00:00');
INSERT INTO `mezamu`.`schedule_branch` (`day`, `branch_id`, `open`, `close`) VALUES ('Wednesday', '1', '08:00:00', '2:00:00');
INSERT INTO `mezamu`.`schedule_branch` (`day`, `branch_id`, `open`, `close`) VALUES ('Thursday', '1', '08:00:00', '2:00:00');
INSERT INTO `mezamu`.`schedule_branch` (`day`, `branch_id`, `open`, `close`) VALUES ('Friday', '1', '08:00:00', '2:00:00');
INSERT INTO `mezamu`.`schedule_branch` (`day`, `branch_id`, `open`, `close`) VALUES ('Saturday', '1', '08:00:00', '2:00:00');
INSERT INTO `mezamu`.`schedule_branch` (`day`, `branch_id`, `open`, `close`) VALUES ('Sunday', '1', '08:00:00', '2:00:00');
