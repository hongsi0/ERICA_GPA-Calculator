DROP TABLE IF EXISTS class;

create table class (
  class_name  varchar(250)  not null primary key,
  class_grade int not null
);

insert into class (class_name,class_grade) values
('논리학',3),
("프로그래밍기초",3),
("창의융합설계",2),
("말과문화",2),
("소프트웨어의이해",1),
("일반물리학실험1",1),
("미분적분학1",3),
("일반물리학1",3),
("PBL과비전설계",1);
