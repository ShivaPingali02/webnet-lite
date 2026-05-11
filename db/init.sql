CREATE TABLE IF NOT EXISTS generators (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    location VARCHAR(50),
    voltage INT DEFAULT 230,
    frequency DECIMAL(4,1) DEFAULT 50.0,
    load_kw DECIMAL(5,2) DEFAULT 0.00
);

INSERT INTO generators (name, location, voltage, frequency, load_kw)
SELECT 'K8s-Gen-1', 'London', 232, 50.0, 110.5
WHERE NOT EXISTS (
    SELECT 1 FROM generators WHERE name = 'K8s-Gen-1'
);

