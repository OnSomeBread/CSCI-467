-- Insert data into Quotes table
INSERT INTO Quotes (Date_, SecretNote, Status) VALUES
  (20230101, 'Confidential Note 1', 1);

-- Insert data into SalesAssociate table
INSERT INTO SalesAssociate (Name, Email, Address, Username, Password, commission, QuoteID) VALUES
  ('John Doe', 'john.doe@example.com', '123 Main St', 'john_doe', 'password123', 5.0, 1);
