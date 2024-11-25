create table address (
   iddistrict int not null,
   idaddress int not null auto_increment,
   primary key (idaddress)  -- Consider using only idaddress as PK
);
create table region (
   idregion int not null AUTO_INCREMENT,
   nameregion varchar(254) NOT NULL,
   statusregion BOOLEAN DEFAULT '1',
   dateregion timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   primary key (idregion)
);

create table town (
   idtown int not null AUTO_INCREMENT,
   idregion int not null,
   nametown varchar(254) NOT NULL,
   statustown BOOLEAN DEFAULT '1',
   primary key (idtown),
   FOREIGN KEY (idregion) REFERENCES region(idregion)
);
create table district (
   iddistrict int not null AUTO_INCREMENT,
   idtown int not null,
   namedistrict varchar(254) NOT NULL,
   statusdistrict BOOLEAN DEFAULT '1',
   primary key (iddistrict),
   FOREIGN KEY (idtown) REFERENCES town(idtown)
);
create table booksurvey (
   idbooking int not null AUTO_INCREMENT,
   bookingdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   deliverydate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   number int,
   statusbs BOOLEAN DEFAULT '1',
   primary key (idbooking)
);

create table land (
   idland int not null AUTO_INCREMENT,
   idregion int not null,
   idtown int not null,
   idaddress int not null,
   iddistrict int not null,
   districtname varchar(254) DEFAULT NULL,
   uniteprice DECIMAL(10, 2) NOT NULL DEFAULT 0,
   totalprice DECIMAL(10, 2) NOT NULL DEFAULT 0,
   titleland varchar(254) DEFAULT NULL,
   descriptionland text NOT NULL,
   imageland varchar(254) NOT NULL,
   locationland varchar(254) NOT NULL,
   statusland enum('available', 'reserved') DEFAULT 'available',
   land_type varchar(254) NOT NULL,
   land_purpose varchar(254) NOT NULL,
   dateland timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   size  DECIMAL(10, 2) NOT NULL DEFAULT 0 AFTER locationland;
   primary key (idland),
   FOREIGN KEY (idregion) REFERENCES region(idregion),
   FOREIGN KEY (idtown) REFERENCES town(idtown),
   FOREIGN KEY (iddistrict) REFERENCES district(iddistrict)
);

create table cart (
   id int(11) NOT NULL AUTO_INCREMENT,
    land_id INT NOT NULL;
   location varchar(255) NOT NULL,
   descriptionland text NOT NULL,
   image varchar(255) NOT NULL,
   primary key (id)
);


create table user (
   id int not null AUTO_INCREMENT,
   idregion int not null,
   idtown int not null,
   idaddress int not null,
   iddistrict int not null,
   fname varchar(254) NOT NULL,
   lname varchar(254) NOT NULL,
   email varchar(254) NOT NULL UNIQUE,
   password varchar(254) NOT NULL,
   phone varchar(254) DEFAULT NULL,
   districtname varchar(255) DEFAULT NULL,
   photo varchar(255) NOT NULL,
   unitprice DECIMAL(10, 2) DEFAULT NULL,
   totalprice DECIMAL(10, 2) DEFAULT NULL,
   created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   status bool DEFAULT true,
   profile varchar(254) DEFAULT NULL,
   role_as enum('notary', 'admin', 'client', 'surveyor') NOT NULL,
   primary key (id),
   FOREIGN KEY (idregion) REFERENCES region(idregion),
   FOREIGN KEY (idtown) REFERENCES town(idtown),
   FOREIGN KEY (iddistrict) REFERENCES district(iddistrict)
);
create table proposedland (
   idpropose int not null AUTO_INCREMENT,
   id int not null,
   datepl timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   descriptionpl varchar(254) NOT NULL,
   statuspl BOOLEAN DEFAULT true,
   primary key (idpropose),
   FOREIGN KEY (id) REFERENCES user(id)
);

CREATE TABLE pending_land (
   id INT AUTO_INCREMENT PRIMARY KEY,
   surveyor_id INT NOT NULL,
   latitude DECIMAL(10, 8) NOT NULL,
   longitude DECIMAL(11, 8) NOT NULL,
   description VARCHAR(254) NOT NULL,
   imageland VARCHAR(255) DEFAULT NULL,
   status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY (surveyor_id) REFERENCES user(id)
);
create table consultation (
   idconsult int not null AUTO_INCREMENT,
   id int not null,
   consultationdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   message varchar(254) NOT NULL,
   statusconsult BOOLEAN DEFAULT '1',
   primary key (idconsult),
  FOREIGN KEY (id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE transactions (
    transactionid INT NOT NULL AUTO_INCREMENT,               
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,       
    amount DECIMAL(10, 2),                                   
    name VARCHAR(254) NOT NULL,                              
    phonenumber VARCHAR(254),                                
    email VARCHAR(254) NOT NULL,                             
    country VARCHAR(254) NOT NULL,                           
    city VARCHAR(254) NOT NULL,                              
    status BOOLEAN DEFAULT '1',                              
    user_id INT,                                           
    reference VARCHAR(255) NOT NULL,                         
    item_ids VARCHAR(255) NOT NULL,                          
    item_names VARCHAR(255) NOT NULL,                        
    PRIMARY KEY (transactionid),                             
    FOREIGN KEY (user_id) REFERENCES user(id)                
);

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    admin_id INT DEFAULT NULL,
    message TEXT NOT NULL,
    file_path VARCHAR(255) DEFAULT NULL,
    file_type VARCHAR(255)  DEFAULT NULL,
    sent_by ENUM('user', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (admin_id) REFERENCES user(id)
);
CREATE TABLE websocket_connections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    connection_id VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id)
);
create table userland (
   id int not null,
   idland int not null,
   primary key (id, idland),
   FOREIGN KEY (id) REFERENCES user(id),
   FOREIGN KEY (idland) REFERENCES land(idland)
);

create table usersurvey (
   id int not null,
   idbooking int not null,
   primary key (id, idbooking),
   FOREIGN KEY (id) REFERENCES user(id),
   FOREIGN KEY (idbooking) REFERENCES booksurvey(idbooking)
);
