CREATE TABLE IF NOT EXISTS call_details (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `call_id` int NOT NULL,
    `date` datetime NOT NULL,
    `details` text NOT NULL,
    `hours` int,
    `minutes` int,
    FOREIGN KEY(call_id) REFERENCES call_headers(call_id)
);