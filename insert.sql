
--
-- Inserer dans departement 
--
INSERT INTO `departement` (`id`, `name`, `capacity`) VALUES
(1, 'informatique', 1),
(2, 'economie', 2),
(3, 'Histoire', 3);

-- --------------------------------------------------------

--
-- inserer dans student
--


INSERT INTO `student` (`id`, `first_name`, `last_name`, `num_etud`, `departement_id`) VALUES
(2, 'john1', 'doe2', 2, 1),
(3, 'john2', 'doe3', 3, 1),
(4, 'john4', 'doe4', 1111222233, 3),
(5, 'john 5', 'doe5', 12373883, 3),
(6, 'dupent', 'doe', 7668, 2),
(7, 'laurent', 'michel', 98, 2);
