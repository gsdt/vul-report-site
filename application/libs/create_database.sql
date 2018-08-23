create table report
(
  id           int auto_increment
    primary key,
  name         tinytext                           not null,
  date_created datetime default CURRENT_TIMESTAMP null,
  target       tinytext                           not null,
  author_id    int                                not null,
  recipient_id int                                not null
);

create table reset_password
(
  id           int(12) auto_increment
    primary key,
  username     varchar(30) charset utf8           not null,
  email        varchar(100) charset utf8          not null,
  token        varchar(60) charset utf8           not null,
  validator    varchar(60)                        not null,
  date_created datetime default CURRENT_TIMESTAMP not null
);

create table users
(
  id            int auto_increment
    primary key,
  username      varchar(30) charset utf8                not null,
  password      varchar(255) charset utf8               not null,
  roles         varchar(20) charset utf8 default 'user' not null,
  email         varchar(255) charset utf8               not null,
  date_modified datetime default CURRENT_TIMESTAMP      null,
  constraint users_email_uindex
  unique (email),
  constraint users_username_uindex
  unique (username)
);

create table template
(
  id            int auto_increment
    primary key,
  name          tinytext                           not null,
  description   mediumtext                         not null,
  date_modified datetime default CURRENT_TIMESTAMP null,
  author_id     int                                not null,
  constraint template_users_id_fk
  foreign key (author_id) references users (id)
);

create table user_report
(
  id        int auto_increment
    primary key,
  user_id   int                      null,
  report_id int                      null,
  status    varchar(30) charset utf8 not null,
  constraint user_report_report_id_fk
  foreign key (report_id) references report (id),
  constraint user_report_users_id_fk
  foreign key (user_id) references users (id)
);

create table vulnerable
(
  id           int auto_increment
    primary key,
  name         tinytext                           not null,
  description  mediumtext                         not null,
  date_created datetime default CURRENT_TIMESTAMP null,
  report_id    int                                not null,
  level        int default '0'                    not null,
  constraint vulnerable_report_id_fk
  foreign key (report_id) references report (id)
);


