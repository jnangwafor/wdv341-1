<?php   

class DatabaseConnect {
	//This class will use PDO to access and process database requests


	//properties
	
	private	$databaseName="";
	private $userName="";
	private $password="";
	private $serverName="";
	
	private $conn="";		//Connection object
	private $stmt="";		//Statement object

	//Public constructor 
	public function __construct() {
		
		
		//$this->connectPDO();  // call connectPDO function
	}
	
	//Setter methods
	public function setDatabaseName($inDatabaseName){
		$this->databaseName = $inDatabaseName;
	}

	public function setUserName($inUserName){
		$this->userName = $inUserName;
	}

	public function setPassword($inPassword){
		$this->password = $inPassword;
	}

	public function setServerName($inServerName){
		$this->serverName = $inServerName;
	}	
	
	//Get methods
	public function getDatabaseName() {
		return $this->databaseName;
	}

	public function getUserName() {
		return $this->userName;
	}	

	public function getPassword() {
		return $this->password;
	}	

	public function getServerName() {
		return $this->serverName;
	}

	//Processing Methods
	
	public function connectPDO() {
		
		$serverName = $this->serverName;
		$username = $this->userName;
		$password = $this->password;
		$database = $this->databaseName;

		try {
			$this->conn = new PDO("mysql:host=$serverName;dbname=$database", $username, $password);
			// set the PDO error mode to exception
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Connected successfully"; 
			}
		catch(PDOException $e)
			{
			
			
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			
				
			}		
	}//end connect()

	public function preparePDO($inSql) {
		
		try {

				$this->stmt = $this->conn->prepare($inSql);	
				
				
				if($this->stmt) {
					echo "<p>PDO prepare failed</p>";	
					echo  $inSql;
									
				} else {
					echo "<p>PDO prepare successful</p>";
				}
			}
		catch(PDOException $e)
			{
				echo "Prepare failed: " . $e->getMessage();
			
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			
			}		
						
	}//end preparePDO()

	public function executePDO($arrayParams) {
		try {
				$this->stmt->execute($arrayParams);	
				return $this->stmt->rowCount();					
			}
		catch(PDOException $e)
			{
				echo "Execute failed: " . $e->getMessage();
			
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			
			}				
	}//end executePDO()



	
}

?>

<?php  
//Test database class



//Create an instance of the database object

$testConnection = new DatabaseConnect();

$testConnection->setDatabaseName('wd341');
$testConnection->setuserName("root");
$testConnection->setPassword("");

$testConnection->setServerName("localhost");

$testConnection->connectPDO();


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Database Class</title>
	
	<style>
	
	#button1{
		background-color: #411A1A;
			color:whitesmoke;
			font-size: 16px;
	}
	</style>
</head>

<body>
	<p>
	<a href= "homework.htm"><button id="button1" name="button1">Homework page</button></a>
	</p>
	<h1>Welcome to WDV341</h1>
	<h2>This is a database class</h2>
	<p>The database class is use for the following:</p>
	<p>
		<ul>
			<li>Create connection to the database.</li>
			<li>Create SQL queries</li>
			<li>Create prepare statements, and,</li>
			<li>Create execute function</li>
		
	</ul>
	
	</p>
	<p>Below is a test of the database class. It will reveal the database name above.</p>
	<p>Database name is: <strong><?php echo $testConnection->getDatabaseName();  ?></strong></p>
</body>
</html>


