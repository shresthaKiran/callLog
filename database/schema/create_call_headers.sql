CREATE TABLE IF NOT EXISTS call_headers (
    `call_id` int NOT NULL PRIMARY KEY,
    `date` timestamp NOT NULL,
    `it_person` char(32) NOT NULL,
    `username` varchar(32) NOT NULL,
    `subject` varchar(64) NOT NULL,
    `details` text NOT NULL,
    `total_hours` int,
    `total_minutes` int,
    `status` char(1) NOT NULL
);