DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
    	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		`owner` varchar(36) NOT NULL,
    	`name` varchar(1024) NOT NULL,
    	`price` int(10) unsigned NOT NULL DEFAULT 0,
    	PRIMARY KEY (`id`)
    );

INSERT INTO products (owner, name, price) VALUES ("MeganChen", "Plush Turtle", 199);
INSERT INTO products (owner, name, price) VALUES ("JamminJoel", "Leet Hacking Tools", 124);
INSERT INTO products (owner, name, price) VALUES ("JamminJoel", "My Kid", 6);
INSERT INTO products (owner, name, price) VALUES ("Hayyyley", "Kidney", 9129912);