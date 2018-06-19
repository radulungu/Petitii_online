--USERS
DROP TABLE USERS CASCADE CONSTRAINTS;
/
CREATE TABLE USERS
(
  ID       INTEGER NOT NULL PRIMARY KEY,
  username VARCHAR2(30) NOT NULL UNIQUE,
  password VARCHAR(30) NOT NULL,
  email    VARCHAR(50) NOT NULL UNIQUE,
  is_admin INTEGER NOT NULL,
  created_at DATE
);
/

--SEQUENCE SI TRIGGER PENTRU AUTO-INCREMENTARE USERS ID
DROP SEQUENCE users_id_seq;
/
CREATE SEQUENCE users_id_seq START WITH 1;
/
create or replace TRIGGER users_id_increment 
BEFORE INSERT ON users
referencing OLD as old NEW as new
FOR EACH ROW

BEGIN
  SELECT users_id_seq.NEXTVAL
      INTO   :new.id
      FROM   dual;
END;
/

--PETITII
DROP TABLE PETITII CASCADE CONSTRAINTS;
/
CREATE TABLE PETITII (

  ID INTEGER NOT NULL PRIMARY KEY,
  creator_id INTEGER NOT NULL,
  name VARCHAR2(100) NOT NULL UNIQUE,
  domeniu VARCHAR2(20) NOT NULL,
  descriere VARCHAR2(1000) NOT NULL,
  numar_semnaturi INTEGER,
  expirare DATE NOT NULL,
  created_at DATE,
  
  CONSTRAINT fk_petitii_creator 
    FOREIGN KEY (creator_id)
    REFERENCES users(ID)
    ON DELETE CASCADE

);
/

--SEQUENCE SI TRIGGER PENTRU AUTO-INCREMENTARE PETITII ID
DROP SEQUENCE petitii_id_seq;
/
CREATE SEQUENCE petitii_id_seq START WITH 1;
/
create or replace TRIGGER petitii_id_increment 
BEFORE INSERT ON petitii
referencing OLD as old NEW as new
FOR EACH ROW

BEGIN
  SELECT petitii_id_seq.NEXTVAL
      INTO   :new.id
      FROM   dual;
END;
/

--CREATOR
DROP TABLE CREATOR CASCADE CONSTRAINTS;
/
CREATE TABLE CREATOR (

  ID INTEGER NOT NULL PRIMARY KEY,
  user_id INTEGER NOT NULL,
  petitie_id INTEGER NOT NULL,
  
  CONSTRAINT fk_creator_user 
    FOREIGN KEY (user_id)
    REFERENCES users(ID)
    ON DELETE CASCADE,
    
  CONSTRAINT fk_creator_petitie 
    FOREIGN KEY (petitie_id)
    REFERENCES petitii(ID)
    ON DELETE CASCADE

);
/

--SEQUENCE SI TRIGGER PENTRU AUTO-INCREMENTARE CREATOR ID
DROP SEQUENCE creator_id_seq;
/
CREATE SEQUENCE creator_id_seq START WITH 1;
/
create or replace TRIGGER creator_id_increment 
BEFORE INSERT ON CREATOR
referencing OLD as old NEW as new
FOR EACH ROW

BEGIN
  SELECT creator_id_seq.NEXTVAL
      INTO   :new.id
      FROM   dual;
END;
/

--SUPPORTERS
DROP TABLE SUPPORTERS CASCADE CONSTRAINTS;
/
CREATE TABLE SUPPORTERS (

  ID INTEGER NOT NULL PRIMARY KEY,
  user_id INTEGER NOT NULL,
  petitie_id INTEGER NOT NULL,
  
  CONSTRAINT fk_supporters_user 
    FOREIGN KEY (user_id)
    REFERENCES users(ID)
    ON DELETE CASCADE,
    
  CONSTRAINT fk_supporters_petitie 
    FOREIGN KEY (petitie_id)
    REFERENCES petitii(ID)
    ON DELETE CASCADE

);
/

--SEQUENCE SI TRIGGER PENTRU AUTO-INCREMENTARE SUPPORTERS ID
DROP SEQUENCE supporters_id_seq;
/
CREATE SEQUENCE supporters_id_seq START WITH 1;
/
create or replace TRIGGER supporters_id_increment 
BEFORE INSERT ON SUPPORTERS
referencing OLD as old NEW as new
FOR EACH ROW

BEGIN
  SELECT supporters_id_seq.NEXTVAL
      INTO   :new.id
      FROM   dual;
END;
/

--Un user creeaza o petitie aka o petitie este creata -> se adauga o intrare corespunzatoare in tabela CREATOR
create or replace TRIGGER creator_add
AFTER INSERT ON PETITII
referencing OLD as old NEW as new
FOR EACH ROW

BEGIN
  INSERT INTO CREATOR VALUES(null, :new.creator_id, petitii_id_seq.CURRVAL);
END;
/

--Un user semneaza o petitie -> numar_semnaturi a petitiei e incrementat
create or replace TRIGGER petitii_nr_semnaturi_increment 
AFTER INSERT ON SUPPORTERS
referencing OLD as old NEW as new
FOR EACH ROW

BEGIN
  UPDATE PETITII
  SET numar_semnaturi = numar_semnaturi + 1
  WHERE ID = :new.petitie_id;
END;
/

--Un user vrea sa-si revoce semnatura unei petitii -> numar_semnaturi a petitiei e decrementat
/*create or replace TRIGGER petitii_nr_semnaturi_decrement 
AFTER DELETE ON SUPPORTERS
referencing OLD as old NEW as new
FOR EACH ROW

BEGIN
  UPDATE PETITII
  SET numar_semnaturi = numar_semnaturi - 1
  WHERE ID = :old.petitie_id;
END;*/
/



--DATA



DELETE FROM USERS WHERE 1=1;
/
--INSERTURI USERI
INSERT INTO USERS VALUES(null, 'Paul', 'smantana', 'smantana@gmail.com', 0, TO_DATE('2015/01/12', 'yyyy/mm/dd'));
/
INSERT INTO USERS VALUES(null, 'Ion', 'castravete', 'castravete@gmail.com', 0, TO_DATE('2014/09/11', 'yyyy/mm/dd'));
/
INSERT INTO USERS VALUES(null, 'Robert', 'portocala', 'portocala@yahoo.com', 0, TO_DATE('2017/01/22', 'yyyy/mm/dd'));
/
INSERT INTO USERS VALUES(null, 'Razvan', 'lamaie', 'lamaie@gmail.com', 0, TO_DATE('2016/02/01', 'yyyy/mm/dd'));
/
INSERT INTO USERS VALUES(null, 'Radu', 'prajitura', 'prajitura@gmail.com', 0, TO_DATE('2016/12/28', 'yyyy/mm/dd'));
/
INSERT INTO USERS VALUES(null, 'Razvan2', 'boss', 'boss@gmail.com', 1, TO_DATE('2016/12/28', 'yyyy/mm/dd'));
/


DELETE FROM PETITII WHERE 1=1;
/
--INSERTURI PETITII
INSERT INTO PETITII VALUES(null, 1,'Salvati balenele albastre!', 'Ecologic', 'Acum cateva saptamani am asistat la un spectacol odios in care autoritatile au "declarat razboi" balenelor albastre. Pe langa pericolele ecologice evidente cred ca organizatorii au lipsit de la orele de biologie. Cum poti scapa de balenele albastre cu 2 vaci rosii?', 1412, TO_DATE('2017/07/21', 'yyyy/mm/dd'), TO_DATE('2016/04/30', 'yyyy/mm/dd'));
/
INSERT INTO PETITII VALUES(null, 2,'Opriti taxa de timbru pe cultura!', 'Cultural', 'Proiectul de lege privind instituirea timbrului cultural a fost initiat de 84 de deputati si senatori din mai multe partide, si a fost adoptat de Senat pe 8 decembrie 2014. Totodata, pe 15 decembrie 2014, proiectul de lege a fost prezentat in Biroul Permanent al Camerei Deputatilor, iar pe 3 februarie a primit aviz de la Comisia juridica, de disciplina si imunitati.Potrivit editurii Nemira, proiectul de lege nu mentioneaza modul in care pot fi folosite sumele colectate de organisme precum Uniunea Scriitorilor din Romania, lucru sesizat si in Avizul Comisiei legislative din Senatul Romaniei.', 1001, TO_DATE('2017/12/05', 'yyyy/mm/dd'), TO_DATE('2016/05/02', 'yyyy/mm/dd'));
/
INSERT INTO PETITII VALUES(null, 4,'Suntem impotriva OUG 13/2017 de modificare a Codului Penal', 'Legislativ', 'Miercuri, 1 februarie 2017, presedintele Romaniei, domnul Klaus Iohannis, i-a transmis Prim-ministrului Romaniei, domnul Sorin Mihai Grindeanu, scrisoarea de mai jos, in care solicita abrogarea Ordonantei de urgenta nr. 13/2017 pentru modificarea si completarea Legii nr. 286/2009 privind Codul Penal si a Legii nr. 135/2010 privind Codul de Procedura Penala. Subsemnasii, semnatari ai acestei petitii, dorim ca aceasta Ordonanta sa fie retrasa, astfel incat sa nu produca nici un efect.', 3509, TO_DATE('2017/05/21', 'yyyy/mm/dd'), TO_DATE('2017/04/30', 'yyyy/mm/dd'));
/
INSERT INTO PETITII VALUES(null, 4,'Moldova vrea autostrada!', 'Economic', 'Semnatarii acestei petitii solicita Guvernului Romaniei sa decida asupra cofinantarii constructiei autostrazii Ungheni-Targu Mures. Conform Variantei finale revizuita privind Master Planul pe termen scurt, mediu si lung, pe intreaga perioada de investitii 2014-2030, Moldova va beneficia doar de un drum-expres Ungheni-Targu Mures. Noi credem ca un pas important pentru dezvoltarea regiunii de Est si Nord-Est a tarii consta in construirea acestui acestui segment in regim de autostrada Ungheni-Targu Mures care ar insemna legatura care faciliteaza apropierea dintre oameni, localitati, regiuni, provincii, tari surori.', 244, TO_DATE('2020/08/09', 'yyyy/mm/dd'), TO_DATE('2015/01/29', 'yyyy/mm/dd'));
/
INSERT INTO PETITII VALUES(null, 5,'Spune NU desfiintarii SMURD', 'Social', 'Gama interventiilor la care este solicitat SMURD include toate urgentele ce pun viata unei persoane sau mai multora in pericol imediat. Acestea includ accidentele rutiere, exploziile, accidentele de munca sau casnice cum ar fi caderea de la inaltime sau electrocutarea, starile de inconstienta ce includ si stopurile cardiorespiratorii, suspiciunile de infarct, insuficientele respiratorii acute si nu in ultimul rind accidentele cu multiple victime. Echipajul se deplaseaza indiferent de virsta victimei, aproximativ 7% din cazurile noastre fiind copii sub varsta de 16 ani.', 776, TO_DATE('2017/12/28', 'yyyy/mm/dd'), TO_DATE('2015/05/20', 'yyyy/mm/dd'));
/
INSERT INTO PETITII VALUES(null, 6,'TEST', 'Social', 'Gama interventiilor la care este solicitat SMURD include toate urgentele ce pun viata unei persoane sau mai multora in pericol imediat. Acestea includ accidentele rutiere, exploziile, accidentele de munca sau casnice cum ar fi caderea de la inaltime sau electrocutarea, starile de inconstienta ce includ si stopurile cardiorespiratorii, suspiciunile de infarct, insuficientele respiratorii acute si nu in ultimul rind accidentele cu multiple victime. Echipajul se deplaseaza indiferent de virsta victimei, aproximativ 7% din cazurile noastre fiind copii sub varsta de 16 ani.', 776, TO_DATE('2017/12/28', 'yyyy/mm/dd'), TO_DATE('2015/05/20', 'yyyy/mm/dd'));
/

DELETE FROM SUPPORTERS WHERE 1=1;
/
--INSERTURI SUPPORTERS
INSERT INTO SUPPORTERS VALUES(null, 1, 1);
/
INSERT INTO SUPPORTERS VALUES(null, 1, 2);
/
INSERT INTO SUPPORTERS VALUES(null, 1, 5);
/
INSERT INTO SUPPORTERS VALUES(null, 2, 4);
/
INSERT INTO SUPPORTERS VALUES(null, 2, 5);
/
INSERT INTO SUPPORTERS VALUES(null, 3, 1);
/
INSERT INTO SUPPORTERS VALUES(null, 4, 2);
/
INSERT INTO SUPPORTERS VALUES(null, 5, 1);
/
INSERT INTO SUPPORTERS VALUES(null, 5, 3);
/
INSERT INTO SUPPORTERS VALUES(null, 5, 4);
/
INSERT INTO SUPPORTERS VALUES(null, 6, 4);
/

--DELETE FROM PETITII WHERE ID = 2;

--SELECT * FROM PETITII WHERE id NOT IN (SELECT p.id FROM PETITII p LEFT JOIN SUPPORTERS s on p.id=s.Petitie_ID WHERE p.CREATOR_ID = 1 OR s.USER_ID = 1) AND numar_semnaturi>0 AND numar_semnaturi<5000;



