-- Insert data into Quotes table
INSERT INTO Quotes (Date_, SecretNote, Status) VALUES
  (20230101, 'Confidential Note 1', 1),
  (20230215, 'Secret Note 2', 0),
  (20230320, 'Top Secret Note 3', 1),
  (20230321, 'Top Secret Note 4', 2);

-- Insert data into LineItems table
INSERT INTO LineItems (ItemName, Quantity, UnitPrice, Discount, TotalPrice, QuoteID) VALUES
  ('Pencil', 2, 10.99, 1.5, 19.48, 1),
  ('Chair', 1, 5.99, NULL, 5.99, 1),
  ('Lamp', 3, 8.75, 2.25, 24.75, 2),
  ('Table', 5, 3.50, 0.75, 15.75, 3);

-- Insert data into SalesAssociate table
INSERT INTO SalesAssociate (Name, Email, Address, Username, Password, commission) VALUES
  ('John Doe', 'john.doe@example.com', '123 Main St', 'john_doe', 'password123', 5.0);
