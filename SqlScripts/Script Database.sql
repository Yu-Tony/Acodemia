create database AcodemiaDB;
use AcodemiaDB;

create table Usuario (
usuarioId varchar(16) primary key not null comment'Guarda el nombre de usuario del usuario que sera tambien su id', 
usuarioNombre varchar(60) not null comment 'Guarda el o los nombres del usuario', 
usuarioApellido varchar(60) not null comment 'Guarda el o los apellidos del usuario', 
usuarioContraseña varchar(16) not null comment 'Guarda la contraseña del usuario', 
usuarioFechaRegistro date not null comment 'Guarda la fecha en la que el usuario se dio de alta', 
usuarioFotoPerfil blob comment 'Guarda la foto de pperfil del usuario', 
usuarioTipo bool not null comment 'Guarda el tipo de usuario, que dictamina si es alumno o escuela', 
usuarioFechaNacimiento date not null comment 'Guarda la fecha de nacimiento del usuario', 
usuarioGenero enum('hombre', 'mujer', 'no binario', 'ninguno', 'no decir') not null comment 'Guarda el genero del usuario', 
usuarioEmail varchar(60) not null comment 'Guarda el correo electronico del usuario', 
usuarioEstado bool not null comment 'Guarda el estado del usuario, true para activo, false para dado de baja'
);

create table Categorias (
categoriaId int primary key auto_increment comment 'Guarda el id de la categoria', 
categoriaNombre varchar(30) not null comment 'Guarda el nombre de la categoria'
);

create table Curso (
cursoId int primary key auto_increment comment 'Guarda el id del curso', 
cursoNombre varchar(100) not null comment 'Guarda el nombre del curso', 
cursoDescripcion varchar(255) not null comment 'Guarda la descripcion sobre lo que trata el curso',
cursoCosto float not null comment 'Guarda el precio que va costar el curso',
cursoNiveles int not null comment 'Guarda la cantidad de niveles que tendra el curso',
cursoFechaPublicacion date not null comment 'Guarda la fecha en la que se publico el curso', 
cursoVideoIntroductorio blob comment 'Guarda el video de presentacion del curso', 
cursoMiniatura blob not null comment 'Guarda la imagen que sera la miniatura del curso', 
cursoEstado bool not null comment 'Guarda el estado del curso, true para activo, false para dado de baja', 
cursoProfesorId varchar(16) not null comment 'Guarda la referencia la tabla de usuario de quien es el profesor del curso', 
foreign key(cursoProfesorId) references Usuario(usuarioId)
);

create table Categoria_curso (
categoriaId int not null comment 'Guarda la referencia a la tabla categoria de la categoia que tendra el curso',
cursoId int not null comment 'Guarda la referencia a la tabla curso de el curso a la que se le esta asignando esta categoria',
foreign key(categoriaId) references Categorias(categoriaId),
foreign key(cursoId) references Curso(cursoId)
);

create table Nivel (
nivelId int auto_increment primary key comment 'Guarda el id que tendra el nivel del curso',
nivelNumero int not null comment 'Guarda el numero que tendra este nivel en el orden de los cursos', 
nivelNombre varchar(200) not null comment 'Guarda el nombre que tendra este nivel', 
nivelCosto float not null comment 'Guarda el costo que tendra este nivel', 
nivelContenido varchar(500) not null comment 'Guarda el contenido informativo que tendra este nivel', 
nivelVideo blob not null comment 'Guarda el video informativo de este nivel', 
nivelImagen blob not null comment 'Guarda una imagen informativa de este nivel', 
nivelImagen2 blob comment 'Espacio extra para una segunda imagen en el nivel', 
nivelImagen3 blob comment 'Espacio extra para una tercera imagen en el nivel', 
nivelPDF blob comment 'Espacio extra para un archivo pdf en el nivel', 
cursoId int not null comment 'Guarda la referencia la tabla curso para saber el curso al que pertenece este nivel',
foreign key(cursoId) references Curso(cursoId)
);

create table Ventas_curso (
ventaCursoId int auto_increment primary key comment 'Guarda el id de la venta que se generara cuando un usuario compra un curso', 
ventaCursoMonto float not null comment 'Guarda el monto total por comprar un curso', 
ventaCursoFormaPago enum('tarjeta de credito', 'paypal') not null comment 'Guarda la forma de pago con la que se compro un curso', 
usuarioId varchar(16) not null comment 'Guarda la referencia a el usuario que compro el curso', 
cursoId int not null comment 'Guarda la referencia al curso que compro el usuario',
foreign key(usuarioId) references Usuario(usuarioId),
foreign key(cursoId) references Curso(cursoId)
);

create table Ventas_nivel (
ventaNivelId int auto_increment primary key comment 'Guarda el id de la venta que se genera cuando un usuario compra el nivel de un curso', 
ventaNivelMonto float not null comment 'Guarda el monto totl por comprar el nivel de un curso', 
ventaNivelFormaPago enum('tarjeta de credito', 'paypal') not null comment 'Guarda la forma de pago con la que se compro el nivel de un curso',
usuarioId varchar(16) not null comment 'Guarda la referencia del usuario que compro el nivel', 
cursoId int not null comment 'Guarda la referencia del curso al que pertenece el nivel que se compro', 
nivelId int not null comment 'Guarda la referencia del nivel que se compro',
foreign key(usuarioId) references Usuario(usuarioId),
foreign key(cursoId) references Curso(cursoId),
foreign key(nivelId) references Nivel(nivelId)
);

create table Comentarios (
comentarioId int auto_increment primary key comment 'Guarda el id del comentario que se hizo', 
comentarioContenido varchar(500) not null comment 'Guarda el contenido del comentario', 
comentarioCalificacion int not null comment 'Guarda la calificacion que el usuario le da al curso',
usuarioId varchar(16) not null comment 'Guarda la referencia al usuario que hizo el comentario',
cursoId int not null comment 'Guarda la referencia al curso que se esta calificando',
foreign key(usuarioId) references Usuario(usuarioId),
foreign key(cursoId) references Curso(cursoId)
);

create table Chat (
chatId int auto_increment primary key comment 'Guarda el id de un chat', 
usuarioId1 varchar(16) not null comment 'Guarda la referencia a uno de los usuarios que participan en este chat', 
usuarioId2 varchar(16) not null comment 'Guarda la referencia al otro usuario que participa en este chat',
foreign key(usuarioId1) references Usuario(usuarioId),
foreign key(usuarioId2) references Usuario(usuarioId)
);

create table Mensaje_chat (
mensajeId int auto_increment primary key comment 'Guarda el id de un mensaje', 
mensajeContenido varchar(255) not null comment 'Guarda el contenido de un mensaje', 
mensajeFecha datetime not null comment 'Guarda la fecha y hora en que se envio un mensaje', 
chatId int not null comment 'Guarda la referencia al chat al que pertenece un mensaje', 
usuarioId varchar(16) not null comment 'Gurda la referencia al usuario que envio un mensaje',
foreign key(chatId) references Chat(chatId),
foreign key(usuarioId) references Usuario(usuarioId)
);

create table Historial_curso (
historialCursoId int auto_increment primary key comment 'Guarda el id del historial de curso', 
historialAdquirido bool not null comment 'Guarda si se adquirio un curso completo o solo algunos niveles, true para adquirido y false para solo algunos niveles', 
historialCursoNivelesC int not null comment 'Guarda la cantidad de niveles completados del curso', 
historialCursoFechaInicio date not null comment 'Guarda la fecha en la que se adquirio/comenzo el curso', 
historialCursoFechaFinal date comment 'Guarda la fecha en la que se finalizo el curso', 
historialCursoConcluido bool not null comment 'Guarda si ya se completo un curso, true para completado y false si aun no se completa', 
cursoId int not null comment 'Guarda la referencia del curso al que pertenece este historial', 
usuarioId varchar(16) not null comment 'Guarda la referecia al usuario que esta llevando a cabo este curso',
foreign key(cursoId) references Curso(cursoId),
foreign key(usuarioId) references Usuario(usuarioId)
);

create table Historial_nivel (
historialNivelId int auto_increment primary key comment 'Guarda el id del historial de un nivel', 
historialNivelCompletado bool not null comment 'Guarda si ya se completo o no un Nivel, true si ya se completo y false si no', 
historialNivelFechaFinal date comment 'Guarda la fecha en la que se finalizo un nivel', 
nivelId int not null comment 'Guarda la referencia al nivel al que pertenece este historial de nivel', 
historialCursoId int not null comment 'Guarda la referencia al historial al que pertenece este historial de nivel',
foreign key(nivelId) references Nivel(nivelId),
foreign key(historialCursoId) references Historial_curso(historialCursoId)
);

create table Firma_maestro (
firmaId int auto_increment primary key comment 'Guarda el id de la firma de un maestro', 
firmaImagen blob not null comment 'Guarda la imagen de la firma de un maestro', 
idUsuarioMaestro varchar(16) not null comment 'Guarda la referencia del maestro al que pertenece esta firma',
foreign key(idUsuarioMaestro) references Usuario(usuarioId)
);

create table Diplomas (
diplomaId int auto_increment primary key comment 'Guarda el id del diploma de un usuario', 
diplomaImagenFirmaR int not null comment 'Guarda la referencia a la firma del Rector', 
diplomaImagenFirmaM int not null comment 'Guarda la referencia a la firma del Maestro que impartio el curso al que pertenece el diploma', 
historialCursoId int not null comment 'Guarda la referencia al historial de curso al que pertenece este diploma', 
estudianteId varchar(16) not null comment 'Guarda la referencia al usuario al que pertenece este diploma', 
maestroId varchar(16) not null comment 'Guarda la referencia al maestro que impartio el curso de este diploma', 
cursoId int not null comment 'Guarda la referencia al curso al que pertenece este diploma',
foreign key(diplomaImagenFirmaR) references Firma_maestro(firmaId),
foreign key(diplomaImagenFirmaM) references Firma_maestro(firmaId),
foreign key(historialCursoId) references Historial_curso(historialCursoId),
foreign key(estudianteId) references Usuario(usuarioId),
foreign key(maestroId) references Usuario(usuarioId),
foreign key(cursoId) references Curso(cursoId)
);


/*--------------------------------------------------------------------*/
