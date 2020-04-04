create database pedalpals;
use pedalpals;

create table user_(username varchar(30) primary key,
                  first_name varchar(30) not null,
                  last_name varchar(30),
                  email_id varchar(40) not null,
                  room varchar(10),
                  hall varchar(50),
                  rating numeric(3,2),
                  passw varchar(50) not null,
                  securityq varchar(100)not null,
                  securityans varchar(20) not null,
                  wallet int not null default 0);

create table mobilenumber(username varchar(30),
                       	  number char(11),
                          primary key(username,number),
                          unique(number),
                          foreign key(username) references user_(username) on delete cascade);
                  

create table contactus (name varchar(50),
                      email_id varchar(50),
                      subject varchar(100),
                      body varchar(1000),
                      qdate date not null,
                      primary key(name,email_id,subject));

create table Admin(username varchar(30) primary key,
                  first_name varchar(30) not null,
                  last_name varchar(30),
                  email_id varchar(40) not null,
                  passw varchar(50) not null);

create table location(name varchar(30) primary key);


create table cycle(reg_no int primary key,
                   model varchar(30) not null,
                   color varchar(20) not null,
                   hasCarrier char not null,
                   location_name varchar(30),
                   username varchar(30) not null,
                   cycle_condition varchar(50),
                   price int not null,
                   reg_type char not null,
                   rating numeric(3,2) default 0,
                   foreign key(username) references user_(username) on delete cascade,
                   foreign key(location_name) references location(name) on delete cascade);


create table pending_buy_cycle_requests (buyer varchar(30),
                                 reg_no int,
                                 price int,
                                 request_date date,
                                 primary key(buyer,reg_no),
                                 foreign key(buyer) references user_(username)  on delete cascade,
                                 foreign key(reg_no) references cycle(reg_no)  on delete cascade);

create table completed_buy_cycle_requests (buyer varchar(30) default "NA",
                                 reg_no int,
                                 seller varchar(30) default "NA",
                                 price int,
                                 status char,
                                 request_date date,
                                 completion_date date,
                                 foreign key(buyer) references user_(username)  on delete cascade,
                                 foreign key(seller) references user_(username)  on delete cascade,
                                 foreign key(reg_no) references cycle(reg_no)  on delete cascade);

create table Coupon(coupon_id varchar(30) primary key,
                  discount int not null,
                  min_rating numeric(3,2) not null,
                  max_amount int not null);

create table User_Coupon(username varchar(30),
                         coupon_id varchar(30),
                         expiry_date date,
                         primary key(username, coupon_id),
                         foreign key(username) references user_(username) on delete cascade,
                         foreign key(coupon_id) references Coupon(coupon_id) on delete cascade);

create table transaction(transaction_id int,
                         username varchar(30),
                         owner varchar(30),
                         reg_no int,
                         start_date date,
                         end_date date,
                         price_per_day int,
                         coupon_id varchar(30),
                         user_rating numeric(3,2),
                         cycle_rating numeric(3,2),
                         primary key(transaction_id),
                         foreign key(username) references user_(username) on delete cascade,
                         foreign key(owner) references user_(username) on delete cascade,
                         foreign key(coupon_id) references Coupon(coupon_id) on delete cascade,
                         foreign key(reg_no) references cycle(reg_no) on delete cascade
                         );

