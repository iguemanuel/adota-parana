CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  password VARCHAR(255),
  phone VARCHAR(50),
  role_user VARCHAR(50)
);

CREATE TABLE pets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  specie VARCHAR(100),
  race VARCHAR(100),
  age INT,
  sex VARCHAR(10),
  description TEXT,
  img_url VARCHAR(255),
  status VARCHAR(50),
  id_user INT,
  date_post DATETIME,
  FOREIGN KEY (id_user) REFERENCES users(id)
);

CREATE TABLE adoptions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_pet INT,
  id_user INT,
  date_adoption DATETIME,
  status VARCHAR(50),
  FOREIGN KEY (id_pet) REFERENCES pets(id),
  FOREIGN KEY (id_user) REFERENCES users(id)
);

CREATE TABLE denunciations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario_denunciante INT,
  id_animal INT,
  motivo TEXT,
  data_denuncia DATETIME,
  status VARCHAR(50),
  FOREIGN KEY (id_usuario_denunciante) REFERENCES users(id),
  FOREIGN KEY (id_animal) REFERENCES pets(id)
);

CREATE TABLE moderation (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_denunciation INT,
  id_admin INT,
  justify TEXT,
  date_aval DATETIME,
  FOREIGN KEY (id_denunciation) REFERENCES denunciations(id),
  FOREIGN KEY (id_admin) REFERENCES users(id)
);

CREATE TABLE favorites (
  id_user INT,
  id_pet INT,
  date_favorited DATETIME,
  PRIMARY KEY (id_user, id_pet),
  FOREIGN KEY (id_user) REFERENCES users(id),
  FOREIGN KEY (id_pet) REFERENCES pets(id)
);
