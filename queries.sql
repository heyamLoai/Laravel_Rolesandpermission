  CREATE TABLE admins(
     id BIGINT(8) UNSIGNED AUTO_INCREMENT,
     name VARCHAR(50) NOT NULL,
     email VARCHAR(50) NOT NULL UNIQUE,
     password VARCHAR(100) NOT NULL ,
     gender ENUM('M','F') NOT NULL DEFAULT 'M',
     active BOOLEAN NOT NULL DEFAULT FALSE,
     city_id BIGINT(8) UNSIGNED
     FOREIGN KEY(city_id) references cities(id),
     PRIMARY KEY (id),  
);
