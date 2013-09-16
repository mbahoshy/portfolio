<!DOCTYPE HTML>

<html lang="en-US">
<head>
	<title>Matthew Ross</title>
	<?php include("../php/head.php"); ?>
	<script></script>
	
</head>
<body>
	<?php include("../php/header.php"); ?>
	
	<div id='content_container'>
		<div class='content_title'>the database project</div>
		<div class=''>
			<p>The database project is one that developed in response to a need. While working at Alpine Aire, I noticed that there was a major information crisis occurring. Details about jobs, customers, and inventory were simply getting lost in the clutter. Oftentimes, essential information resided only in one person's mind, making it impossible to access that information collectively. The database project was a way to synthesize this information, and make it available to everyone in the company. This project was eventually abandoned in favor of a professional office software that smoothly integrated with our accounting system.</p>
		</div>
		<div class='pane-wrap-full'>
			<div class='pane-top'>Overview</div>
			<div class='pane'>
				<div id='4ouncggya6Y' class='vid-click fright'>
					<img class='vid-thumb' src='../images/database_vid_thumb.png'	/>
					<p class='vid-expand'>Promotional Video - Click to play</p>
				</div>
				<p>The database structure of this project revolves around customer creation. No jobs, service, or inventory items can be created without being linked to a customer. Jobs and service items can be attached to new or existing customers. A 'job' refers to a new construction, or a retro-fit (exchanging an old furnace for a new one). A 'service' is when a technician is scheduled to diagnose and fix system problems. This website is organized so that once a job, service, or inventory item is created, you can track it through it's various stages, and anyone looking at the program will see the status of that item. A service, for instance, will go through the following stages: Open, Scheduled, Completed, Billed, Collected.</p>
				<p>mySQL is the primary database used in this application, although service tickets (which contain dynamic information) are stored in XML databases.</p>

			</div>
		</div>
		<div class='pane-wrap-full'>
			<div class='pane-top'>Coding Examples <span id='slider1'></span></div>
			<div class='pane padding-zero'>
				<div class='arrow-left'>
					<div class='triangle-left'></div>
				</div>
				<div class='slide active-slide'>
					<p>The primary database was built using mySQL. Below is the 'customers' and 'jobs' tables that are used with this website. A 'customerid' is generated in the customers table using the auto_increment attribute. This customerid is used to link information across different tables.</p>
					<p>For instance, when a 'job' is created, the customerid is entered into a column in the jobs table. This way, one customer can be linked to many jobs. The jobs themselves each have a unique auto_increment key. Adding service, equipment, and files works in a similar fashion.</p>
					<p>Click on the arrow to your right to advance to the next slide.</p>
					<div class='code-holder-full fleft'>
						<script type="syntaxhighlighter" class="brush: sql">

						<![CDATA[
create table customers
(customerid int unsigned not null auto_increment primary key,
namefirst char(50) not null,
namelast char(50) not null,
address char(100) not null,
city char (30) not null,
cstate char (2) not null,
zip char(5) not null,
phone char(10) not null,
email char(30) not null,
customertype char(20)
);


create table jobs
(jobid int unsigned not null auto_increment primary key,
customerid int unsigned not null,
jobname char(30),
jobaddress char (30),
jobcity char (30),
jstate char (2),
jzip char (5),
jobdescription char(200) not null,
jobtype char (20) not null,
jobstatus char(20),
stamp_created timestamp default '0000-00-00 00:00:00', 
stamp_updated timestamp default now() on update now() 
);]]>
					
						</script>
					</div>
				</div>
				<div class='slide'>
							<p>Below is the function that adds a customer to the database.</p>
				<div class='code-holder-full fleft'>
						<script type="syntaxhighlighter" class="brush: php">

						<![CDATA[
	function addcustomer ($addcustomer_values) {
	
			//connect to database, and alert usr if there is an error
			@ $db = new mysqli('localhost', $usr, $pass, $dname);

			if (mysqli_connect_errno()) {
			 echo 'Error: Could not connect to database.  Please try again later.';
			 exit;
			}
			
			// create short variable names
			$namefirst = $addcustomer_values['namefirst'];
			$namelast = $addcustomer_values['namelast'];
			$address = $addcustomer_values['address'];
			$city = $addcustomer_values['city'];
			$zip = $addcustomer_values['zip'];
			$phone = $addcustomer_values['phone'];
			$email = $addcustomer_values['email'];
			$customertype = $addcustomer_values['customertype'];
			$cstate = $addcustomer_values['cstate'];

			// verify all information has been entered
			if (!$namefirst || !$namelast || !$address || !$city || !$zip || !$phone || !$email || !$customertype || !$cstate)
				{
				echo "You have not entered all the required details.<br	/>";
				exit;
				}
			
			// calls addslashes if get_magic_quotes is turned off
			if (!get_magic_quotes_gpc()) {
				$namefirst = addslashes($namefirst);
				$namelast = addslashes($namelast);
				$address = addslashes($address);
				$city = addslashes($city);
				$zip = addslashes($zip);
				$phone = addslashes($phone);
				$email = addslashes($email);
				$customertype = addslashes($customertype);
				$cstate = addslashes($cstate);
				}
				
			// create sql search query, and add customer into database
			$add_query = "insert into customers values (NULL, '".$namefirst."', '".$namelast."', '".$address."', '".$city."', '".$cstate."', '".$zip."', '".$phone."', '".$email."', '".$customertype."')";
			
			$add_result = $db->query($add_query);
			
			// retrieves newly created customer id
			$custid = $db->insert_id;
			
			// generates success or failure message to user
			if ($add_result) {
				$message = ("<h3 class='green'>".$db->affected_rows." customers added to database.</h3>");
				echo $message;
			} else {
				$message = "<h3 class='red'>An error has occured.</h3>";
				echo $message;
			}
			
			//closes database
			$db->close();
	}]]>
					
						</script>
				</div>
				</div>
				<div class='slide'>
							<p>On this slide is an example of php used on the page that displays customers. This is the page on the website that displays a single customers information after their name has been clicked on.</p>
					<div class='code-holder-full fleft'>
						<script type="syntaxhighlighter" class="brush: php">
							<![CDATA[
							//start session
							session_start();
								
								//the page variable is used load the correct css color scheme
								$page = $_SESSION['page'];
								
								//connect to database
								@ $db = new mysqli('localhost', $usr, $pass, $dname);

								if(mysqli_connect_errno()) {
									echo "Error: Could not connect to database.";
									exit;
								}
								
								//checks to see if a custid (customer id) has been passed through get method. If so this overrides to session variable and becomes the new custid
								if (isset($_GET['custid'])) {
								
									$custid = $_GET['custid'];
									$_SESSION['custid'] = $custid;
								} else {
									$custid = $_SESSION['custid'];
								}
								
								//loads customer info to display on the page.
								//get_customer_info is a function that returns an array of customer data
								$customer_info = get_customer_info ($custid);
								
								//searches service database to load all associated services
								//this function is used in many places of the website
								//the first parameter is the search category (ie first name, last name, zip code, etc)
								//the second parameter is the search term
								service_search('customerid', $custid);
							]]>							
						</script>
					</div>
				</div>
				<div class='arrow-right'>
					<div class='triangle-right'></div>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class='footer'>
	</div>
</div>
</body>
</html>