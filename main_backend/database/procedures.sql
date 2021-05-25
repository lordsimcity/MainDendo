
/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS AddOrder;
DELIMITER //
CREATE PROCEDURE AddOrder(pId_user INT,pOrder_status VARCHAR(50),pDate_created_order DATETIME,pDate_modified_order DATETIME,pAmount_order DECIMAL(8,2),pNumberadress_order VARCHAR(5),pStreetadress_order VARCHAR(50),pCityadress_order VARCHAR(30),pPostalcode_order VARCHAR(10),pFirstname_bill VARCHAR(50),pLastname_bill VARCHAR(30),pAdress_bill VARCHAR(100),pAmount_bill DECIMAL(10,2))
BEGIN
    INSERT INTO Orders(id_user,order_status,date_created_order,date_modified_order,amount_order,numberadress_order,streetadress_order,cityadress_order,postalcode_order,firstname_bill,lastname_bill,adress_bill,amount_bill)
    VALUES(pId_user,pOrder_status,pDate_created_order,pDate_modified_order,pAmount_order,pNumberadress_order,pStreetadress_order,pCityadress_order,pPostalcode_order,pFirstname_bill,pLastname_bill,pAdress_bill,pAmount_bill);
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS UserOrders;
DELIMITER //
CREATE PROCEDURE UserOrders(pUser_id INT)
BEGIN
    SELECT * FROM Orders o
    WHERE o.id_user = pUser_id;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS GetUserAddress;
DELIMITER //
CREATE PROCEDURE GetUserAddress(pUser_id INT)
BEGIN
    SELECT * FROM Addresses a
    WHERE a.id_user = pUser_id;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SpecificUserOrder;
DELIMITER //
CREATE PROCEDURE SpecificUserOrder(pUser_id INT, pOrder_date DATETIME)
BEGIN
    SELECT * FROM Orders o
    WHERE o.id_user = pUser_id
    AND o.date_created_order = pOrder_date;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS GetBasket;
DELIMITER //
CREATE PROCEDURE GetBasket(pFk_user_id INT)
BEGIN
    SELECT * FROM Baskets b
    WHERE b.fk_idUsers = pFk_user_id;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS DeleteSpecificBasket;
DELIMITER //
CREATE PROCEDURE DeleteSpecificBasket(pFk_user_id INT)
BEGIN
    DELETE FROM Baskets WHERE fk_idUsers = pFk_user_id;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS AddNewOrderLine;
DELIMITER //
CREATE PROCEDURE AddNewOrderLine(pId_user INT,pId_order INT,pDate_created_order_line DATETIME,pDate_modified_order_line DATETIME,pId_type_product INT,pId_product INT,pProduct_name VARCHAR(100),pUnitPrice DECIMAL(8,2),pTotalPrice DECIMAL(8,2),pQuantity INT)
BEGIN
    INSERT INTO Orders_lines(id_user,id_order,date_created_order_line,date_modified_order_line,id_type_product,id_product,product_name,unitPrice,totalPrice,quantity)
    VALUES(pId_user,pId_order,pDate_created_order_line,pDate_modified_order_line,pId_type_product,pId_product,pProduct_name,pUnitPrice,pTotalPrice,pQuantity);
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS GetOrderLines;
DELIMITER //
CREATE PROCEDURE GetOrderLines(pId_user INT,pId_order INT)
BEGIN
    SELECT * FROM Orders_lines 
    WHERE id_user = pId_user 
    AND id_order = pId_order;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS AddUser;
DELIMITER //
CREATE PROCEDURE AddUser(pLastname VARCHAR(30), pFirstname VARCHAR(30), pEmail VARCHAR(30), pPassword VARCHAR(100), pDate_created_user DATETIME, pDate_modified_user DATETIME)
BEGIN

    INSERT INTO Users(lastname,firstname,mail_address,password,date_created_user,date_modified_user) VALUES (pLastname,pFirstname,pEmail,pPassword,pDate_created_user,pDate_modified_user);

END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SelectUser;
DELIMITER //
CREATE PROCEDURE SelectUser(pEmail VARCHAR(30))
BEGIN

    SELECT * FROM Users WHERE mail_address = pEmail;

END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS UpdateUserPassword;
DELIMITER //
CREATE PROCEDURE UpdateUserPassword(pNewPassword VARCHAR(255),pNewDate DATETIME,pEmail_address VARCHAR(100)) 
BEGIN 
    UPDATE Users SET password = pNewPassword, date_modified_user = pNewDate WHERE mail_address = pEmail_address; 
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS UpdateUserEmail;
DELIMITER //
CREATE PROCEDURE UpdateUserEmail(pNewEmailAddress VARCHAR(100), pNewDate DATETIME, pOldEmailAddress VARCHAR(100)) 
BEGIN 
    UPDATE Users SET mail_address = pNewEmailAddress, date_modified_user = pNewDate WHERE mail_address = pOldEmailAddress;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS AddUserAddress;
DELIMITER //
CREATE PROCEDURE AddUserAddress(pId_user INT, pNumber VARCHAR(10), pStreet VARCHAR(100), pCity VARCHAR(50), pPostal_code VARCHAR(10)) 
BEGIN 
    INSERT INTO Addresses(id_user,number,street,city,postal_code) VALUES(pId_user,pNumber,pStreet,pCity,pPostal_code);
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS UpdateUserAddress;
DELIMITER //
CREATE PROCEDURE UpdateUserAddress(pNumber VARCHAR(10), pStreet VARCHAR(100), pCity VARCHAR(50), pPostal_code VARCHAR(10), pId_user INT) 
BEGIN 
    UPDATE Addresses SET number = pNumber, street = pStreet, city = pCity, postal_code = pPostal_code WHERE id_user = pId_user;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SelectFavorite;
DELIMITER //
CREATE PROCEDURE SelectFavorite(pIdProduct INT, pFkIdUser INT)
BEGIN
    SELECT * FROM Favorites WHERE id_product = pIdProduct AND fk_id_user = pFkIdUser;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS AddFavorite;
DELIMITER //
CREATE PROCEDURE AddFavorite(pFkIdUser INT, pIdProduct INT)
BEGIN
    INSERT INTO Favorites(fk_id_user,id_product) VALUES(pFkIdUser,pIdProduct);
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SelectUserFavorite;
DELIMITER //
CREATE PROCEDURE SelectUserFavorite(pFkIdUser INT)
BEGIN
    SELECT * FROM Favorites WHERE fk_id_user = pFkIdUser;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS DeleteSpecificFavorite;
DELIMITER //
CREATE PROCEDURE DeleteSpecificFavorite(pIdProduct INT, pFkIdUser INT)
BEGIN
    DELETE FROM Favorites WHERE id_product = pIdProduct AND fk_id_user = pFkIdUser;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SelectBasket;
DELIMITER //
CREATE PROCEDURE SelectBasket(pProductName VARCHAR(255), pFkIdUser INT)
BEGIN
    SELECT * FROM Baskets WHERE productName = pProductName AND fk_idUsers = pFkIdUser;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SelectBasketProductQuantity;
DELIMITER //
CREATE PROCEDURE SelectBasketProductQuantity(pProductName VARCHAR(255), pFkIdUser INT)
BEGIN
    SELECT quantity FROM Baskets WHERE productName = pProductName AND fk_idUsers = pFkIdUser;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS AddToBasket;
DELIMITER //
CREATE PROCEDURE AddToBasket(pProductName VARCHAR(255),pDescription VARCHAR(255),pQuantity INT,pPrice FLOAT,pFk_idUsers INT,pId_product INT,pId_type_product INT)
BEGIN
    INSERT INTO Baskets(productName,description,quantity,price,fk_idUsers,id_product,id_type_product) VALUES(pProductName,pDescription,pQuantity,pPrice,pFk_idUsers,pId_product,pId_type_product);
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SelectUserBasket;
DELIMITER //
CREATE PROCEDURE SelectUserBasket(pFkIdUser INT)
BEGIN
    SELECT * FROM Baskets WHERE fk_idUsers = pFkIdUser;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS UpdateUserBasket;
DELIMITER //
CREATE PROCEDURE UpdateUserBasket(pQuantity INT, pProductName VARCHAR(255), pFk_idUsers INT) 
BEGIN 
    UPDATE Baskets SET quantity = pQuantity WHERE productName = pProductName AND fk_idUsers = pFk_idUsers;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS DeleteProductFromBasket;
DELIMITER //
CREATE PROCEDURE DeleteProductFromBasket(pProductName VARCHAR(255), pFkIdUser INT)
BEGIN
    DELETE FROM Baskets WHERE productName = pProductName AND fk_idUsers = pFkIdUser;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SelectProduct;
DELIMITER //
CREATE PROCEDURE SelectProduct(pIdProduct INT)
BEGIN
    SELECT * FROM Products WHERE id_product = pIdProduct;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SelectIdProduct;
DELIMITER //
CREATE PROCEDURE SelectIdProduct(pIdProduct INT)
BEGIN
    SELECT * FROM Products WHERE id_product = pIdProduct;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SelectAllProducts;
DELIMITER //
CREATE PROCEDURE SelectAllProducts()
BEGIN
    SELECT * FROM Products;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS ProductDescription;
DELIMITER //
CREATE PROCEDURE ProductDescription(pId_product INT)
BEGIN
    SELECT name_product, description_product, autonomy, motor, battery, price_product, picture_product, brand, stock FROM Products WHERE id_product = pId_product;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SelectStock;
DELIMITER //
CREATE PROCEDURE SelectStock(pIdProduct INT)
BEGIN
    SELECT stock FROM Products WHERE id_product = pIdProduct;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS UpdateProductStock;
DELIMITER //
CREATE PROCEDURE UpdateProductStock(pNewStock INT, pId_product INT) 
BEGIN 
    UPDATE Products SET stock = pNewStock WHERE id_product = pId_product;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS SelectComments;
DELIMITER //
CREATE PROCEDURE SelectComments(pIdProduct INT)
BEGIN
    SELECT username, comment FROM Comments WHERE id_product = pIdProduct;
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */
DROP PROCEDURE IF EXISTS AddComment;
DELIMITER //
CREATE PROCEDURE AddComment(pId_product INT, pUsername VARCHAR(255), pComment TEXT, pDate DATETIME)
BEGIN
    INSERT INTO Comments(id_product,username,comment,date) VALUES(pId_product, pUsername, pComment, pDate);
END //
DELIMITER ;

/* -------------------------------------------------------------------------------------------------- */

DROP PROCEDURE IF EXISTS AddComment;
DELIMITER //
CREATE PROCEDURE AddComment(pId_product INT, pUsername VARCHAR(255), pComment TEXT, pDate DATETIME)
BEGIN
    INSERT INTO Comments(id_product,username,comment,date) VALUES(pId_product, pUsername, pComment, pDate);
END //
DELIMITER ;

/* ================================================================================================== */
/* Procédures stockées utilisées dans l'application JAVA */

DROP PROCEDURE IF EXISTS AddDelivery;
DELIMITER //
CREATE PROCEDURE AddDelivery(pDelivery INT, pAdress VARCHAR(255), pName VARCHAR(30), pFirstname VARCHAR(30), pStatus VARCHAR(20))
BEGIN
    INSERT INTO Delivery(id_delivery, adress_delivery, name_delivery, firstname_delivery, status_delivery) VALUES(pDelivery , pAdress , pName, pFirstname, pStatus);
END //
DELIMITER ;

/* ---- */

DROP PROCEDURE IF EXISTS AddProduct;
DELIMITER //
CREATE PROCEDURE AddProduct(pId_type_product INT, pName_product VARCHAR(50) ,pDescription_product VARCHAR(255),pAutonomy VARCHAR(20),pMotor VARCHAR(20),pBattery VARCHAR(20),pPrice_product DECIMAL(8,2),pPicture_product VARCHAR(255),pDate_created_product DATETIME,pDate_modified_product DATETIME,pBrand VARCHAR(50),pStock INT)
BEGIN
    INSERT INTO Products (id_type_product, name_product,description_product,autonomy,motor,battery,price_product,picture_product,date_created_product,date_modified_product,brand,stock) VALUES (pId_type_product, pName_product,pDescription_product,pAutonomy,pMotor,pBattery,pPrice_product,pPicture_product,pDate_created_product,pDate_modified_product,pBrand,pStock);
END //
DELIMITER ;