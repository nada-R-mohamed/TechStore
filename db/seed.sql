INSERT INTO cats (`name`) VALUES ('Laptops'),('PCs'),('Mobiles');


INSERT INTO  products
(`name`, `desc`, `price`, `pieces_no`, `img`, `cat_id`)
VALUES
('lenovo','this is dummy description for Project', 15000, 10, '1.jpg', 1),
('dell laptop','this is dummy description for Project', 10000, 10, '2.jpg', 1),
('hp laptop','this is dummy description for Project', 8000, 8, '3.jpg', 1),
('lenovo thinkpad','this is dummy description for Project', 13000, 5, '4.jpg', 1),
('pc 123','this is dummy description for Project', 5000, 3, '5.jpg', 2),
('pc 456','this is dummy description for Project', 6000, 4, '6.jpg', 2),
('pc 789','this is dummy description for Project', 7000, 2, '7.jpg', 2),
('samsung ay 7aga','this is dummy description for Project', 5000, 100, '8.jpg', 3),
('oppo ay 7aga','this is dummy description for Project', 5500, 50, '9.jpg', 3),
('macbook m1 ', 'macbook m1 16', 30000 , 50 , 'macbook.jpg',1),
('hwawei ay 7aga','this is dummy description for Project', 5200, 30, '10.jpg', 3),
('iphone 11', 'all colors', '12000.00', 25, '11.jpg', 3),
('hp pavilon', 'SSD 256G and 16G RAM', '30000.00', 35, '12.jpg', 1),
('headphone jbl', 'headphone JBL wireless', '5000.00', 50, 'JBL.jpg', 2);


INSERT INTO admins (`name`, `email`, `password`) VALUES ('Nada Rafat', 'nada@admin.com', '$2y$10$twqPoqKzk3b2qfBNC0.uPe83O0UcqYvnKp7n4j4.pwjK/SpPlBiPK');