-- Create and use the database
DROP DATABASE IF EXISTS stage_finder;
CREATE DATABASE stage_finder;
USE stage_finder;

-- =====================================================
-- USERS TABLE
-- =====================================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student', 'company') NOT NULL,
    profile_picture VARCHAR(255) NULL,
    bio TEXT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================
-- STUDENTS TABLE
-- =====================================================
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE NOT NULL,
    university VARCHAR(150) NOT NULL,
    specialite VARCHAR(100) NOT NULL,
    graduation_year YEAR NULL,
    skills TEXT NULL,
    cv_path VARCHAR(255) NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- COMPANIES TABLE
-- =====================================================
CREATE TABLE companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE NOT NULL,
    company_name VARCHAR(150) NOT NULL,
    industry VARCHAR(100) NULL,
    location VARCHAR(150) NOT NULL,
    description TEXT NULL,
    website VARCHAR(255) NULL,
    logo_path VARCHAR(255) NULL,
    phone VARCHAR(45) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- OFFERS TABLE
-- =====================================================
CREATE TABLE offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    requirements TEXT NULL,
    location VARCHAR(150) NOT NULL,
    duration INT NULL COMMENT 'Duration in months',
    type ENUM('full-time', 'part-time', 'remote') DEFAULT 'full-time',
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- APPLICATIONS TABLE
-- =====================================================
CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    offer_id INT NOT NULL,
    cover_letter_text TEXT NULL,
    cv_file VARCHAR(255) NULL,
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    applied_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (offer_id) REFERENCES offers(id) ON DELETE CASCADE,
    UNIQUE KEY unique_application (student_id, offer_id)
) ENGINE=InnoDB;

-- =====================================================
-- CONVERSATIONS TABLE
-- =====================================================
CREATE TABLE conversations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================
-- CONVERSATION PARTICIPANTS TABLE (Junction table)
-- =====================================================
CREATE TABLE conversation_participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conversation_id INT NOT NULL,
    user_id INT NOT NULL,
    joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (conversation_id) REFERENCES conversations(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_participant (conversation_id, user_id)
) ENGINE=InnoDB;

-- =====================================================
-- MESSAGES TABLE
-- =====================================================
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conversation_id INT NOT NULL,
    sender_id INT NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    sent_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (conversation_id) REFERENCES conversations(id) ON DELETE CASCADE,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- EVALUATIONS TABLE
-- =====================================================
CREATE TABLE evaluations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL UNIQUE,
    overall INT DEFAULT 0,
    technical INT DEFAULT 0,
    communication INT DEFAULT 0,
    teamwork INT DEFAULT 0,
    initiative INT DEFAULT 0,
    comment TEXT NULL,
    completed TINYINT(1) DEFAULT 0,
    certificate TINYINT(1) DEFAULT 0,
    start_date DATE NULL,
    end_date DATE NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (application_id) REFERENCES applications(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- ADMIN ACTIONS TABLE
-- =====================================================
CREATE TABLE admin_actions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action_type ENUM('approve_offer', 'reject_offer', 'delete_user', 'delete_offer', 'other') NOT NULL,
    target_type ENUM('user', 'offer', 'company', 'student') NULL,
    target_id INT NULL,
    description TEXT NULL,
    action_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- EVENTS TABLE
-- =====================================================
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    version_id INT NOT NULL,
    user_id INT NOT NULL,
    joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- PASSWORD RESET TOKENS TABLE
-- =====================================================
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(64) NOT NULL,
    abilities TEXT NULL,
    last_used_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================
-- MIGRATIONS TABLE
-- =====================================================
CREATE TABLE migrations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INT NOT NULL
) ENGINE=InnoDB;

-- =====================================================
-- INSERT SAMPLE DATA
-- =====================================================

-- Insert users
INSERT INTO users (name, email, password, role, profile_picture, bio) VALUES
-- Students
('Ahmed Benali', 'ahmed.benali@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uq0srX7mS', 'student', '/uploads/profiles/ahmed.jpg', 'CS student passionate about web development and AI'),
('Fatima Zahra El Idrissi', 'fatima.elidrissi@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uq0srX7mS', 'student', '/uploads/profiles/fatima.jpg', 'Business student looking for marketing internship'),
('Youssef Alaoui', 'youssef.alaoui@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uq0srX7mS', 'student', '/uploads/profiles/youssef.jpg', 'Engineering student specialized in industrial systems'),
('Khadija Bennani', 'khadija.bennani@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uq0srX7mS', 'student', '/uploads/profiles/khadija.jpg', 'Graphic design student with passion for UI/UX'),
('Omar Tazi', 'omar.tazi@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uq0srX7mS', 'student', '/uploads/profiles/omar.jpg', 'Data science enthusiast, looking for hands-on experience'),

-- Companies
('Karim Fassi', 'hr@attijariwafa.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uq0srX7mS', 'company', '/uploads/companies/attijari.png', 'HR Manager at Attijariwafa Bank'),
('Salma Benjelloun', 'salma@maroctelecom.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uq0srX7mS', 'company', '/uploads/companies/maroc-telecom.jpg', 'Tech Recruiter at Maroc Telecom'),
('Rachid El Ouafi', 'rachid@oncf.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uq0srX7mS', 'company', '/uploads/companies/oncf.png', 'HR Director at ONCF'),
('Nadia Berrada', 'nadia@ocp.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uq0srX7mS', 'company', '/uploads/companies/ocp.jpg', 'Talent Acquisition Specialist at OCP'),
('Mohammed Ghallab', 'mohammed@yazaki.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uq0srX7mS', 'company', '/uploads/companies/yazaki.png', 'HR Manager at Yazaki Morocco'),

-- Admin
('Admin System', 'admin@stagefinder.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uq0srX7mS', 'admin', '/uploads/profiles/admin.jpg', 'Platform Administrator');

-- Insert student profiles
INSERT INTO students (user_id, university, specialite, graduation_year, skills, cv_path) VALUES
(1, 'Université Mohammed V - Rabat', 'Génie Informatique', 2024, 'Python, JavaScript, React, Node.js, MySQL', '/uploads/cvs/ahmed_benali_cv.pdf'),
(2, 'Université Al Akhawayn - Ifrane', 'Marketing et Communication', 2024, 'Social Media Marketing, Content Creation, SEO, Google Analytics', '/uploads/cvs/fatima_elidrissi_cv.pdf'),
(3, 'Ecole Mohammadia d''Ingénieurs (EMI)', 'Génie Industriel', 2025, 'AutoCAD, SolidWorks, Supply Chain Management, Lean Six Sigma', '/uploads/cvs/youssef_alaoui_cv.pdf'),
(4, 'Ecole Supérieure des Arts Visuels - Marrakech', 'Design Graphique', 2024, 'Adobe Photoshop, Illustrator, Figma, UI/UX Design', '/uploads/cvs/khadija_bennani_cv.pdf'),
(5, 'Université Hassan II - Casablanca', 'Data Science', 2025, 'Python, R, SQL, Machine Learning, Tableau', '/uploads/cvs/omar_tazi_cv.pdf');

-- Insert company profiles
INSERT INTO companies (user_id, company_name, industry, location, description, website, logo_path, phone) VALUES
(6, 'Attijariwafa Bank', 'Finance/Banking', 'Casablanca', 'Leading banking group in Morocco and Africa', 'https://www.attijariwafa.com', '/uploads/logos/attijariwafa.png', '+212522345678'),
(7, 'Maroc Telecom', 'Telecommunications', 'Rabat', 'Leading telecommunications operator in Morocco', 'https://www.iam.ma', '/uploads/logos/maroc-telecom.png', '+212537654321'),
(8, 'ONCF', 'Transportation', 'Rabat', 'Moroccan national railway office', 'https://www.oncf.ma', '/uploads/logos/oncf.png', '+212537567890'),
(9, 'OCP Group', 'Mining/Chemicals', 'Casablanca', 'World leader in phosphate and its derivatives', 'https://www.ocpgroup.ma', '/uploads/logos/ocp.png', '+212522456789'),
(10, 'Yazaki Morocco', 'Automotive', 'Tangier', 'Japanese automotive components manufacturer', 'https://www.yazaki.com', '/uploads/logos/yazaki.png', '+212539876543');

-- Insert job offers
INSERT INTO offers (company_id, title, description, requirements, location, duration, type, status) VALUES
(1, 'Développeur Full Stack (Stage PFE)', 'Nous recherchons un stagiaire développeur full stack pour rejoindre notre équipe digitale. Vous participerez au développement de notre nouvelle application mobile banking.', 
 'Étudiant en dernière année d''école d''ingénieurs ou master informatique. Maîtrise de React, Node.js et MongoDB. Bonne connaissance des API REST.', 
 'Casablanca', 6, 'full-time', 'approved'),
(1, 'Data Analyst (Stage)', 'Stage en analyse de données pour le département risque crédit. Vous travaillerez sur l''analyse des données clients et la création de tableaux de bord.',
 'Étudiant en Data Science ou Mathématiques appliquées. Maîtrise de SQL, Python et Power BI. Bonnes capacités analytiques.',
 'Casablanca', 4, 'full-time', 'approved'),
(2, 'Ingénieur Réseaux et Télécoms (Stage)', 'Stage au sein de la direction technique. Participation à l''optimisation du réseau 4G/5G et analyse des performances.',
 'Étudiant en télécommunications ou réseaux. Connaissances des technologies 4G/5G, IP/MPLS. Certifications CISCO sont un plus.',
 'Rabat', 5, 'full-time', 'approved'),
(2, 'Chargé de Marketing Digital (Stage)', 'Support à l''équipe marketing digital pour la création de contenu et l''animation des réseaux sociaux.',
 'Étudiant en marketing ou communication. Maîtrise des réseaux sociaux, créativité, bonne rédaction.',
 'Rabat', 3, 'part-time', 'pending'),
(3, 'Ingénieur Logistique et Supply Chain', 'Stage au département supply chain pour l''optimisation des flux et la gestion des stocks.',
 'Étudiant en logistique ou génie industriel. Connaissance des outils de gestion de stock et ERP.',
 'Casablanca', 4, 'full-time', 'approved'),
(3, 'Assistant RH (Stage)', 'Support au département RH pour la gestion administrative, le recrutement et la formation.',
 'Étudiant en gestion des ressources humaines. Bonne organisation, discrétion, maîtrise du pack Office.',
 'Rabat', 3, 'full-time', 'approved'),
(4, 'Ingénieur Automatisme et Contrôle-Commande', 'Stage au sein des unités industrielles de Jorf Lasfar. Participation aux projets d''automatisation.',
 'Étudiant en génie électrique ou automatisme. Connaissances des automates Siemens, supervision.',
 'Jorf Lasfar', 6, 'full-time', 'approved'),
(4, 'Technicien Maintenance Industrielle (Stage PFE)', 'Stage de fin d''études en maintenance préventive et curative des équipements industriels.',
 'Étudiant en BTS ou DUT maintenance industrielle. Connaissances en mécanique et électrotechnique.',
 'Khouribga', 4, 'full-time', 'approved'),
(5, 'Ingénieur Qualité Fournisseurs (Stage)', 'Stage au département qualité pour l''évaluation et le suivi des fournisseurs.',
 'Étudiant en qualité industrielle ou génie mécanique. Connaissances des normes ISO, outils qualité.',
 'Tanger', 4, 'full-time', 'pending'),
(5, 'Assistant Chef de Projet Industriel', 'Support à la gestion de projets d''industrialisation de nouveaux produits.',
 'Étudiant en gestion de projet industriel. Bonne organisation, anglais courant, maîtrise du MS Project.',
 'Tanger', 5, 'full-time', 'approved');

-- Insert applications
INSERT INTO applications (student_id, offer_id, cover_letter_text, cv_file, status) VALUES
(1, 1, 'Je suis très intéressé par ce stage car je souhaite développer mes compétences en développement bancaire. J''ai déjà réalisé un projet similaire lors de mes études...', '/uploads/cvs/ahmed_benali_cv.pdf', 'accepted'),
(1, 3, 'Passionné par les télécommunications, je souhaite mettre mes compétences en réseaux au service de Maroc Telecom...', '/uploads/cvs/ahmed_benali_cv.pdf', 'pending'),
(2, 4, 'Je suis une passionnée du marketing digital et je souhaite intégrer votre équipe pour apprendre aux côtés des experts de Maroc Telecom...', '/uploads/cvs/fatima_elidrissi_cv.pdf', 'pending'),
(2, 6, 'Je recherche un stage en RH pour développer mes compétences en recrutement et gestion des talents...', '/uploads/cvs/fatima_elidrissi_cv.pdf', 'rejected'),
(3, 5, 'Mon parcours en génie industriel m''a préparé à relever les défis logistiques. Je serais ravi de contribuer à l''optimisation des flux à l''ONCF...', '/uploads/cvs/youssef_alaoui_cv.pdf', 'accepted'),
(3, 10, 'Je suis intéressé par ce stage qui allie gestion de projet et industrie. Mon expérience en tant que chef de projet associatif...', '/uploads/cvs/youssef_alaoui_cv.pdf', 'pending'),
(4, 2, 'Je souhaite mettre mes compétences en design et data visualisation au service de votre équipe data. J''ai créé plusieurs dashboards lors de mes projets...', '/uploads/cvs/khadija_bennani_cv.pdf', 'pending'),
(5, 2, 'Je suis passionné par l''analyse de données et je souhaite appliquer mes connaissances en machine learning à des cas concrets dans le secteur bancaire...', '/uploads/cvs/omar_tazi_cv.pdf', 'pending'),
(5, 8, 'Je cherche à appliquer mes compétences en data science dans le secteur industriel. L''OCP serait un cadre idéal pour mon stage de fin d''études...', '/uploads/cvs/omar_tazi_cv.pdf', 'accepted');

-- Insert conversations
INSERT INTO conversations (created_at, updated_at) VALUES
(NOW() - INTERVAL 5 DAY, NOW() - INTERVAL 3 DAY),
(NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 2 DAY),
(NOW() - INTERVAL 2 DAY, NOW() - INTERVAL 1 DAY),
(NOW() - INTERVAL 1 DAY, NOW()),
(NOW(), NOW());

-- Insert conversation participants
INSERT INTO conversation_participants (conversation_id, user_id, joined_at) VALUES
(1, 1, NOW() - INTERVAL 5 DAY),
(1, 6, NOW() - INTERVAL 5 DAY),
(2, 2, NOW() - INTERVAL 3 DAY),
(2, 7, NOW() - INTERVAL 3 DAY),
(3, 3, NOW() - INTERVAL 2 DAY),
(3, 8, NOW() - INTERVAL 2 DAY),
(4, 4, NOW() - INTERVAL 1 DAY),
(4, 9, NOW() - INTERVAL 1 DAY),
(5, 5, NOW() - INTERVAL 12 HOUR),
(5, 9, NOW() - INTERVAL 12 HOUR);

-- Insert messages
INSERT INTO messages (conversation_id, sender_id, message, is_read, sent_at, created_at, updated_at) VALUES
(1, 6, 'Bonjour Ahmed, nous avons bien reçu votre candidature pour le poste de Développeur Full Stack. Seriez-vous disponible pour un entretien cette semaine ?', TRUE, NOW() - INTERVAL 4 DAY, NOW() - INTERVAL 4 DAY, NOW() - INTERVAL 4 DAY),
(1, 1, 'Bonjour, merci pour votre message. Oui, je suis disponible jeudi après-midi ou vendredi matin.', TRUE, NOW() - INTERVAL 4 DAY, NOW() - INTERVAL 4 DAY, NOW() - INTERVAL 4 DAY),
(1, 6, 'Parfait. Je vous propose jeudi à 14h30 dans nos locaux à Casablanca. Je vous envoie l''adresse exacte.', TRUE, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 3 DAY),
(1, 1, 'C''est noté, merci. Je serai présent.', TRUE, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 3 DAY),
(2, 2, 'Bonjour, je postule pour le stage en marketing digital. Je suis très motivée à l''idée de rejoindre votre équipe !', TRUE, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 3 DAY),
(2, 7, 'Bonjour Fatima, merci pour votre intérêt. Pouvez-vous nous envoyer votre portfolio ?', TRUE, NOW() - INTERVAL 2 DAY, NOW() - INTERVAL 2 DAY, NOW() - INTERVAL 2 DAY),
(2, 2, 'Bien sûr, voici le lien vers mon portfolio : www.fatimaelidrissi.design', FALSE, NOW() - INTERVAL 2 DAY, NOW() - INTERVAL 2 DAY, NOW() - INTERVAL 2 DAY),
(3, 8, 'Félicitations Youssef ! Votre candidature pour le stage en logistique a été retenue. Pouvez-vous passer signer la convention demain ?', TRUE, NOW() - INTERVAL 1 DAY, NOW() - INTERVAL 1 DAY, NOW() - INTERVAL 1 DAY),
(3, 3, 'Génial ! Merci beaucoup. Oui, je peux passer demain vers 10h. C''est à votre bureau de Rabat ?', TRUE, NOW() - INTERVAL 1 DAY, NOW() - INTERVAL 1 DAY, NOW() - INTERVAL 1 DAY),
(3, 8, 'Oui, exactement. Je vous attends à 10h. N''oubliez pas votre convention signée par votre école.', FALSE, NOW() - INTERVAL 1 DAY, NOW() - INTERVAL 1 DAY, NOW() - INTERVAL 1 DAY),
(4, 4, 'Bonjour, je suis très intéressée par le stage Data Analyst chez OCP. J''aimerais en savoir plus sur les missions quotidiennes.', TRUE, NOW() - INTERVAL 20 HOUR, NOW() - INTERVAL 20 HOUR, NOW() - INTERVAL 20 HOUR),
(4, 9, 'Bonjour Khadija. Les missions incluent l''analyse des données de production, la création de dashboards pour le management...', FALSE, NOW() - INTERVAL 18 HOUR, NOW() - INTERVAL 18 HOUR, NOW() - INTERVAL 18 HOUR),
(5, 5, 'Bonjour, je confirme ma présence à l''entretien de demain à 11h.', TRUE, NOW() - INTERVAL 10 HOUR, NOW() - INTERVAL 10 HOUR, NOW() - INTERVAL 10 HOUR),
(5, 9, 'Parfait Omar. Voici le lien Google Meet pour l''entretien à distance : meet.google.com/xyz', FALSE, NOW() - INTERVAL 8 HOUR, NOW() - INTERVAL 8 HOUR, NOW() - INTERVAL 8 HOUR);

-- Insert evaluations
INSERT INTO evaluations (application_id, overall, technical, communication, teamwork, initiative, comment, completed, certificate, start_date, end_date) VALUES
(1, 8, 8, 9, 7, 8, 'Excellent candidat, très motivé et compétent', 1, 1, '2024-02-01', '2024-08-01'),
(5, 9, 8, 9, 9, 9, 'Très bon profil, recommandé', 1, 1, '2024-03-01', '2024-07-01'),
(9, 7, 8, 7, 6, 7, 'Bon potentiel, à suivre', 1, 0, '2024-04-01', '2024-08-01');

-- Insert admin actions
INSERT INTO admin_actions (admin_id, action_type, target_type, target_id, description, action_date) VALUES
(11, 'approve_offer', 'offer', 1, 'Approbation de l''offre Développeur Full Stack - Attijariwafa', NOW() - INTERVAL 10 DAY),
(11, 'approve_offer', 'offer', 2, 'Approbation de l''offre Data Analyst - Attijariwafa', NOW() - INTERVAL 9 DAY),
(11, 'approve_offer', 'offer', 3, 'Approbation de l''offre Ingénieur Réseaux - Maroc Telecom', NOW() - INTERVAL 8 DAY),
(11, 'reject_offer', 'offer', 4, 'Rejet de l''offre - Informations insuffisantes sur les missions', NOW() - INTERVAL 7 DAY),
(11, 'approve_offer', 'offer', 5, 'Approbation de l''offre Logistique - ONCF', NOW() - INTERVAL 6 DAY),
(11, 'approve_offer', 'offer', 6, 'Approbation de l''offre Assistant RH - ONCF', NOW() - INTERVAL 5 DAY),
(11, 'approve_offer', 'offer', 7, 'Approbation de l''offre Automatisme - OCP', NOW() - INTERVAL 4 DAY),
(11, 'approve_offer', 'offer', 8, 'Approbation de l''offre Maintenance - OCP', NOW() - INTERVAL 3 DAY),
(11, 'reject_offer', 'offer', 9, 'Rejet - Format de l''offre non conforme aux standards de la plateforme', NOW() - INTERVAL 2 DAY),
(11, 'approve_offer', 'offer', 10, 'Approbation de l''offre Assistant Chef de Projet - Yazaki', NOW() - INTERVAL 1 DAY);