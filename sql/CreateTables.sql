DROP TABLE IF EXISTS CustomerData;
DROP TABLE IF EXISTS LineItems;
DROP TABLE IF EXISTS Quotes;
DROP TABLE IF EXISTS SalesAssociate;

CREATE TABLE Quotes (
  QuoteID int AUTO_INCREMENT PRIMARY KEY,
  Date_ int(15) NOT NULL,
  SecretNote char(255),
  Status int(1) NOT NULL
);

CREATE TABLE CustomerData (
  UserID int AUTO_INCREMENT PRIMARY KEY,
  Name char(40) NOT NULL,
  Email char(40) NOT NULL,
  Country char(40) NOT NULL,
  Address char(60) NOT NULL,
  QuoteID int(15) NOT NULL,
  FOREIGN KEY (QuoteID) REFERENCES Quotes(QuoteID)
);

CREATE TABLE LineItems (
  LineID int AUTO_INCREMENT PRIMARY KEY,
  ItemName char(40) NOT NULL,
  Quantity int(3) NOT NULL,
  UnitPrice float(5) NOT NULL,
  Discount float(5),
  TotalPrice float(7) NOT NULL,
  QuoteID int(15) NOT NULL,
  FOREIGN KEY (QuoteID) REFERENCES Quotes(QuoteID)
);

CREATE TABLE SalesAssociate (
  AssocID int AUTO_INCREMENT PRIMARY KEY,
  Name char(40) NOT NULL,
  Email char(40) NOT NULL,
  Address char(40) NOT NULL,
  Username char(40) UNIQUE NOT NULL,
  Password char(40) NOT NULL,
  commission float(6) NOT NULL,
  QuoteID int(15) NOT NULL,
  FOREIGN KEY (QuoteID) REFERENCES Quotes(QuoteID)
);
