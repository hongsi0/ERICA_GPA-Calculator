DROP TABLE IF EXISTS class;

create table class (
  class_name  varchar(250)  not null primary key,
  class_credit int not null,
  class_year int not null,
  class_semester int not null
);

insert into class (class_name,class_credit,class_year,class_semester) values
("논리학",3,1,1),
("프로그래밍기초",3,1,1),
("창의융합설계",2,1,1),
("말과문화",2,1,1),
("소프트웨어의이해",1,1,1),
("일반물리학실험1",1,1,1),
("미분적분학1",3,1,1),
("일반물리학1",3,1,1),
("PBL과비전설계",1,1,1);
