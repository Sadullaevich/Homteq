CREATE TABLE Product(
    prodId              INTEGER         AUTO_INCREMENT,
    prodName            VARCHAR(200)    NOT NULL,
    prodPicNameSmall    VARCHAR(200)    NOT NULL,    
    prodPicNameLarge    VARCHAR(200)    NOT NULL,
    prodDescripShort    VARCHAR(1000),
    prodDescripLong     VARCHAR(3000),
    prodPrice           DECIMAL(8,2)    NOT NULL,
    prodQuantity        INTEGER         NOT NULL,
    CONSTRAINT p_pid_pk PRIMARY KEY (prodId)
);

INSERT INTO 
product 
(prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity)
VALUES
('Ring Smart Video Doorbell', 'prodimg1.jpg', 'prodimg1.jpg', "Ring's range of smart video doorbells and security cameras let you monitor your home from anywhere, so you never miss a visitor.", "They help to keep your home secure by protecting you against intruders and unwanted guests. Using the free Ring app (available on iOS, Android and Windows 10) 
you can get instant alerts on your smart device whenever anyone presses your doorbell or triggers a motion sensor. You can even see, hear and speak to visitors from your smart phone, tablet or PC. Ring products allow you to set up an integrated ring of security around your home for peace of mind.
", 99.99, 100),
('Add-On Smart Thermostat', 'prodimg2.jpg', 'prodimg2.jpg', "tado's Add-On Smart Thermostat is the ideal complement to the tado Wireless thermostat kit, if you would like to control underfloor heating or separate heating zones", "tado's Add-On Smart Thermostat is the ideal complement to the tado Wireless thermostat kit, if you would like to control underfloor heating or separate heating zones. It's used in place of conventional room thermostats, letting you control your heating system remotely with the tado app (available on iOS and Android). Please note, the Internet Bridge is required for it to work, which is sold separately, as part of tado's starter kits.", 119.99, 12),
( 'Smart Speaker With Clock & Alexa', 'prodimg3.jpg', 'prodimg3.jpg',"Amazon's most popular smart speaker features a sleek design and an improved LED display that shows the time, weather, song titles and more.","Amazon's most popular smart speaker features a sleek design and an improved LED display that shows the time, weather, song titles and more. Enjoy an improved audio experience compared to any previous Echo Dot with Alexa for clearer vocals, deeper bass and vibrant sound in any room.", 13.99, 250),
('Smart Home Devices Wifi Touch Light Switch', 'prodimg4.jpg', 'prodimg4.jpg', 'Touch Control The wifi light switch is with capacitive touch control, turn on/off your light at a single touch','New design with scratch resistance glass panel, gives the best look to blend with any wall design.
App Remote Control and Voice Control WiFi Switch is compatible with Alexa (Echo/Dot/Tap) , Google Home/Assistant for voice control directly. IFTTT or Free Smart Life Tuya APP is available for remote control via smart phone. You can also track the devices real-time status anytime from the smart phone APP.', 64.99, 45);

CREATE TABLE Users(
    userId          INTEGER         AUTO_INCREMENT,
    userType        VARCHAR(20)     NOT NULL,
    userFName       VARCHAR(100)    NOT NULL,
    userSName       VARCHAR(100)    NOT NULL,
    userAddress     VARCHAR(200)    NOT NULL,
    userPostcode    VARCHAR(20)     NOT NULL,
    userTelNo       VARCHAR(20)     NOT NULL,
    userEmail       VARCHAR(100)    UNIQUE NOT NULL,
    userPassword    VARCHAR(100)    NOT NULL,
    CONSTRAINT      u_uid_pk        PRIMARY KEY (userId)
)

INSERT INTO 
Users
(userType, userFName, userSName, userAddress, userPostcode, userTelNo, userEmail, userPassword)
VALUES
('Customer', 'James', 'Smith', '7 Markhouse Avenue, London', 'E17 8AY', '07884554555', 'Jsm1th@gmail.com', 'alwaysJames1' ),
('Admin', 'Shokhbozbek', 'Tulanov', '4 Downsell Road, London', 'E15 2BU', '07884606684', 'tulanovshokhboz@gmail.com', 'theTERRIFIC'),
('Customer', 'Magnus', 'Carlsen', '115 New Cavendish St, London', 'W1W 6UW', '02044205255', 'Maglsenking@gmail.com', 'kingofchess');

CREATE TABLE Orders(
    orderNo         INTEGER         AUTO_INCREMENT,
    userId          INTEGER         NOT NULL,
    orderDateTime   DATETIME        NOT NULL,
    orderTotal      DECIMAL(8,2)    DEFAULT 0.00    NOT NULL,
    orderStatus     VARCHAR(50),
    shippingDate    DATE,
    CONSTRAINT o_odn_pk PRIMARY KEY (orderNo),
    CONSTRAINT fk_userId FOREIGN KEY (userId) REFERENCES Users(userId) ON DELETE CASCADE
)

CREATE TABLE Order_Line(
    orderLineId     INTEGER         AUTO_INCREMENT,
    orderNo         INTEGER         NOT NULL,
    prodId          INTEGER         NOT NULL,
    quantityOrdered     INTEGER     NOT NULL,
    subTotal        DECIMAL(8,2)    DEFAULT 0.00    NOT NULL,
    CONSTRAINT o_odl_pk PRIMARY KEY (orderLineId),
    CONSTRAINT fk_orderNo FOREIGN KEY (orderNo) REFERENCES Orders(orderNo) ON DELETE CASCADE,
    CONSTRAINT fk_prodId FOREIGN KEY (prodId) REFERENCES Products(prodId) ON DELETE CASCADE
)