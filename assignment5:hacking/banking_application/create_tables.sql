-- Database name = test

use test;
-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS accounts (
  accno int(25) NOT NULL,
  customerid int(10) NOT NULL,
  accopendate date NOT NULL,
  accounttype varchar(25) NOT NULL,
  accountbalance double(10,2) NOT NULL,
  PRIMARY KEY (accno)
) ;

--
-- Dumping data for table `accounts`
--
/*
INSERT INTO `accounts` (`accno`, `customerid`, `accopendate`, `accounttype`, `accountbalance`) VALUES
('4666', 98682, '2013-02-02', 'saving', 100000.00),
('4667', 98683, '2013-02-09', 'current', 20000.00);
*/
-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS customers (
  customerid int(10) NOT NULL AUTO_INCREMENT,
  firstname varchar(25) NOT NULL,
  lastname varchar(25) NOT NULL,
  loginid varchar(25) NOT NULL,
  accpassword varchar(129) NOT NULL,
  transpasword varchar(129) NOT NULL,
  email_id varchar(50) NOT NULL,
  accopendate date NOT NULL,
  lastlogin datetime NOT NULL,
  PRIMARY KEY (customerid)
) ;

--
-- Dumping data for table `customers`
--

/*
INSERT INTO customers (customerid,firstname,lastname,loginid,accpassword,transpasword,accopendate,lastlogin) VALUES
(98680, 'sadf', 'werwe', 'user1', 'fgdfg', 'werwe','2013-02-02', '0000-00-00 00:00:00'),
(98682,'Raj', 'kiran', 'rajkiran','raj', 'kiran' , '2013-02-02', '0000-00-00 00:00:00'),
(98683, 'john', 'mark', 'johnmark', 'john', 'mark','2013-02-09', '2013-02-16 05:25:20');
*/
-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS transaction (
  transactionid int(10) NOT NULL AUTO_INCREMENT,
  transactiondate datetime NOT NULL,
  payeeaccno int(25) NOT NULL,
  receiveraccno int(25) NOT NULL,
  amount float(10,2) NOT NULL,
  remarks varchar(40) ,
  PRIMARY KEY (transactionid)
) ;

--
-- Dumping data for table `transaction`
--

/*
INSERT INTO `transaction` (`transactionid`, `transactiondate`, `paymentdate`, `payeeid`, `receiveid`, `debitac`, `amount`, `paymentstat`) VALUES
(2147483647, '2012-12-13', '2012-12-03 04:21:10', 111232154, 0, '150000', 100000.00, 'active');
*/
-- ---------------------------------------------------------
-- Table structure for table 'beneficiaries'
--

CREATE TABLE IF NOT EXISTS beneficiaries (
	customerid int(10) NOT NULL,
	benef_accno int(25) NOT NULL,
	benef_nickname varchar(40),
	benef_limit float(10,2) NOT NULL,
	PRIMARY KEY (customerid, benef_accno)
) ;