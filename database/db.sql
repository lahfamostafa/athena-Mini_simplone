create database athena ;

use athena;

create table users(
    id int primary key auto_increment,
    nom varchar(100) Not null,
    prenom varchar(100) Not null,
    email varchar(100) unique Not null,
    mdpss varchar(255) Not null,
    etat ENUM('active','désactive') default 'active',
    roleUser ENUM('admin','chef_projet','membre') Not null
)ENGINE=InnoDB;

create table projet(
    id int primary key auto_increment,
    titre varchar(100) Not null,
    descriptionP varchar(255) Not null,
    date_debut date Not null,
    date_fin date Not null,
    etat ENUM('active','désactive') default 'active',
    idUser int Not null,
    foreign key (idUser) references users(id) 
)ENGINE=InnoDB;

create table sprint(
    id int primary key auto_increment,
    nom varchar(100) Not null,
    date_debut date Not null,
    date_fin date Not null,
    idProjet int Not null,
    foreign key (idProjet) references projet(id) 
)ENGINE=InnoDB;

create table task(
    id int primary key auto_increment,
    titre varchar(100) unique Not null,
    descriptionT varchar(255) Not null,
    statu ENUM('aFaire','enCours','terminé') default 'aFaire',
    idSprint int Not null,
    foreign key (idSprint) references sprint(id) 
)ENGINE=InnoDB;

create table UserTask(
    id int primary key auto_increment,
    idUser int Not null,
    foreign key (idUser) references users(id),
    idTask int Not null,
    foreign key (idTask) references task(id)
)ENGINE=InnoDB;

create table notifications(
    id int primary key auto_increment,
    titre varchar(50),
    emailDestinataire varchar(50),
    dateSent datetime default current_timestamp,
    idUser int not null,
    foreign key (idUser) references users(id)
)ENGINE=InnoDB;

create table commentaire(
    id int primary key auto_increment,
    contenu varchar(255),
    dateCreation datetime default current_timestamp,
    idTask int Not null,
    foreign key (idTask) references task(id),
    idUser int Not null,
    foreign key (idUser) references users(id)
)ENGINE=InnoDB;
