SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `cabinet_permissions` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `hd_skin` varchar(100) NOT NULL,
  `cloak` varchar(100) NOT NULL,
  `hd_cloak` varchar(100) NOT NULL,
  `privilage` varchar(100) NOT NULL DEFAULT 'Игрок'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `cabinet_permissions`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `cabinet_permissions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;


ALTER TABLE `dle_users` ADD `balance` VARCHAR(11) NOT NULL DEFAULT '0' AFTER `name`;

CREATE TABLE `cabinet_pay_logs` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sum` int(11) NOT NULL,
  `pay_date` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `pay_date_success` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `cabinet_pay_logs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cabinet_pay_logs`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;