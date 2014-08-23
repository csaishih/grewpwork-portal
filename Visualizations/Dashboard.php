<?php
	class Dashboard {
		const LOGIN_DIR = 'X:\Program Files\wamp\www\portal\login.php';
		const APP_TOKENS_DIR = 'X:\Program Files\wamp\www\portal\app_tokens.php';
		const CONFIG_DIR = 'X:\Program Files\wamp\www\portal\config.php';
		

		function get_tweet_sentiment_JSON() {
		
			include self::LOGIN_DIR;
			include self::CONFIG_DIR;

			$data_array = array();

			// Connect to database
			$connection = mysqli_connect($host, $username, $password, $database);

			// Get keywords of interest
			$keywordSQL = "SELECT Word FROM $movie_keywords_table";
			$keywordResult = mysqli_query($connection, $keywordSQL);

			$num_movies =  mysqli_num_rows($keywordResult) / $keywords_per_movie;

			// For each movie
			for ($i = 0; $i < $num_movies; $i++)
			{
				// For each set of keywords for 1 movie
				// SETUP the SQL to get tweets for this set of keywords
				$dataSQL = "SELECT Created_At, Sentiment FROM $movie_tweets_table WHERE ";
				for ($j = 0; $j < $keywords_per_movie; $j++)
				{
					$row = mysqli_fetch_array($keywordResult);
					// First word is the movie title
					if ($j == 0)
					{
						$movie_title = $row['Word'];
						$data_array[$movie_title] = array();
					}
					$dataSQL = $dataSQL . "Tweet_Keyword = '" . $row['Word'] . "' OR ";
				}
				$dataSQL = substr($dataSQL, 0, strlen($dataSQL) - 3);
				
				// Get tweet dates for this set of keywords
				$dataResult = mysqli_query($connection, $dataSQL);
				// Process tweet dates into displayable dates
				$row_count_array = array();
				$tally_array[$movie_title] = 0;
				while($row = mysqli_fetch_array($dataResult))
				{	
					$created_at = $row['Created_At'];
					// To bypass "undefined offset" notice in the case that 'Created_At' is empty
					if ($created_at == null)
						continue;
					
					$exploded_date = explode(" ", $created_at);
					$unixdate = strtotime($exploded_date[1] . "-" . $exploded_date[2] . "-" . $exploded_date[5]);
					
					if (array_key_exists($movie_title, $data_array) and array_key_exists(strval($unixdate), $data_array[ $movie_title ])) {
						$data_array[ $movie_title ] [ $unixdate ] += $row [ 'Sentiment' ];
						$row_count_array[ $unixdate ]++;
					}
					else {
						$data_array[ $movie_title ] [ $unixdate ] = $row [ 'Sentiment' ];
						$row_count_array[ $unixdate ] = 1;
					}
					$tally_array[$movie_title] += $row['Sentiment'];
				}
				
				// Divide by the row_count for each day
				foreach ($row_count_array as $key => $value)
				{
					//echo $key . " " . $value . "<br>";
					$data_array[ $movie_title ][ $key ] /= $value;
				}
			}
			// Find the most hyped movies
			arsort($tally_array);
			$tally_array = array_chunk($tally_array, 5, true)[0];
			foreach ($tally_array as $movie => $total) {
				$temp[$movie] = $data_array[$movie];
			}

			// Return result to JS file
			echo json_encode($temp);
		}
		
		
		function get_tweet_tally_JSON() {
		
			include self::LOGIN_DIR;
			include self::CONFIG_DIR;

			$data_array = array();

			// Connect to database
			$connection = mysqli_connect($host, $username, $password, $database);

			// Get keywords of interest
			$keywordSQL = "SELECT Word FROM $movie_keywords_table";
			$keywordResult = mysqli_query($connection, $keywordSQL);

			$num_movies =  mysqli_num_rows($keywordResult) / $keywords_per_movie;

			// For each movie
			for ($i = 0; $i < $num_movies; $i++)
			{
				// For each set of keywords for 1 movie
				// SETUP the SQL to get tweets for this set of keywords
				$dataSQL = "SELECT Tally_Number, Update_Date FROM $movie_daily_tally_table WHERE ";
				for ($j = 0; $j < $keywords_per_movie; $j++)
				{
					$row = mysqli_fetch_array($keywordResult);
					// First word is the movie title
					if ($j == 0)
					{
						$movie_title = $row['Word'];
						$data_array[$movie_title] = array();
					}
					$dataSQL = $dataSQL . "Keyword = '" . $row['Word'] . "' OR ";
				}
				$dataSQL = substr($dataSQL, 0, strlen($dataSQL) - 3);
				
				// Get tweet dates for this set of keywords
				$dataResult = mysqli_query($connection, $dataSQL);
				// Process tweet dates into displayable dates
				$tally_array[$movie_title] = 0;
				while($row = mysqli_fetch_array($dataResult))
				{
					if (array_key_exists($movie_title, $data_array) and array_key_exists(strval($row[ 'Update_Date' ]), $data_array[ $movie_title ]))
						$data_array[ $movie_title ] [ $row [ 'Update_Date' ] ] += intval($row [ 'Tally_Number' ]);
					else
						$data_array[ $movie_title ] [ $row [ 'Update_Date' ] ] = intval($row [ 'Tally_Number' ]);
					$tally_array[$movie_title] += $row['Tally_Number'];
				}
			}
			// Find the most tweeted movies
			arsort($tally_array);
			$tally_array = array_chunk($tally_array, 5, true)[0];
			foreach ($tally_array as $movie => $total) {
				$temp[$movie] = $data_array[$movie];
			}
			
			// Return result to JS file
			echo json_encode($temp);
		}
	
	
		function get_user_stats_JSON($user_screen_name) {
			
			include self::LOGIN_DIR;
			
			// Connect to database
			$connection = mysqli_connect($host, $username, $password, $database);
			
			// Access Activity_Level table and get all entries about this user
			$result = mysqli_query($connection, "SELECT * FROM $user_stats_daily_table WHERE User_Screen_Name = '$user_screen_name'");
			
			// --- Encode into JSON format
			$data_array = array();
			// Define the column headings
			$metrics = array('Follower_Count', 'Friends_Count', 'Statuses_Count', 'Favourites_Count', 'Listed_Count', 'Activity_Level');
			// For each row from the database
			while ($row = mysqli_fetch_assoc($result)) {
				// Make an entry in data_array for each column heading
				foreach ($metrics as $metric)
					$data_array[str_replace("_", " ", $metric)][$row['Day_Updated']] = $row[$metric];
			}
			echo json_encode($data_array);
		}
		
		
		function get_word_cloud_CSV($user_screen_name, $type) {
		
			include self::LOGIN_DIR;
			
			switch ($type) {
				case "Entity":
					$curr_table = $entity_user_stats_table;
					break;
				case "At":
					$curr_table = $at_user_stats_table;
					break;
			}
			// Get entities from DB
			$connection = mysqli_connect($host, $username, $password, $database);
			$result = mysqli_query($connection, "SELECT $type, Count FROM $entity_user_stats_table WHERE User_Screen_Name = '$user_screen_name'");
			$list = array("name,word,count");
			
			while($row = mysqli_fetch_assoc($result)) {
				array_push( $list, implode( ",", array($row[$type], $row[$type], $row['Count']) ) );
			}
			
			// Write data to .csv file
			$file = fopen("data\\$user_screen_name.csv","w");
			foreach ($list as $line)
				fputcsv($file,explode(',',$line));
			fclose($file);
		}
	
	
		function get_BI_avg($user_screen_name) {
			
			include SELF::LOGIN_DIR;
			
			$connection = mysqli_connect($host, $username, $password, $database);
			
			// Convert User_Screen_Name to User_ID
			$result = mysqli_query($connection, "SELECT User_ID FROM $user_table WHERE User_Screen_Name = '$user_screen_name'");
			$user_id = mysqli_fetch_assoc($result)['User_ID'];

			$result = mysqli_query($connection, "SELECT * FROM $BI_avg_table WHERE User_ID = '$user_id'");
			
			$data_array = array();
			$metrics = ['avg_seed_req', 'avg_seed_pur', 'avg_foll_pur'];
			// encode JSON
			while ($row = mysqli_fetch_assoc($result)) {
				foreach ($metrics as $metric) {
					$data_array[$metric][$row['created_at']] = $row[$metric];
				}
			}
			echo json_encode($data_array);
		}
	
		
		function get_cluster_info_JSON() {
			
			include self::LOGIN_DIR;
			include self::CONFIG_DIR;
			
			$connection = mysqli_connect($host, $username, $password, $database);
			
			// Grab the most recent row for each cluster from cluster_info_table
			$data_array = array();
			for ($i=1; $i<=$cluster_count; $i++) {
				$data_array[$i] = mysqli_fetch_assoc( mysqli_query($connection, "SELECT MAX(Created_At) FROM $cluster_info_table WHERE Cluster_ID = '$i'") );
			}
			
			echo json_encode($data_array);
		}
		
		
		function get_BI_rev() {
			include self::LOGIN_DIR;
			
			$connection = mysqli_connect($host, $username, $password, $database);
			
			$result = mysqli_query($connection, "SELECT * FROM $BI_rev_table");
			
			$data_array = array();
			// encode JSON
			while ($row = mysqli_fetch_assoc($result)) {
				$data_array['revenue'][$row['created_at']] = $row['revenue'];
			}
			echo json_encode($data_array);
		}
		
		
		function get_BI_n_req_pur($user_id) {
		
			include self::LOGIN_DIR;
					
			// Connect to database
			$connection = mysqli_connect($host, $username, $password, $database);

			// Access BI_users table and get all entries 
			$result = mysqli_query($connection, "SELECT * FROM $BI_users WHERE user_id = '$user_id'");
			
			$data_array = array();
			$metrics = ['num_seed_req', 'num_seed_pur', 'num_foll_pur'];
			// encode JSON
			while ($row = mysqli_fetch_assoc($result)) {
				foreach ($metrics as $metric) {
					$data_array[$metric][$row['created_at']] = $row[$metric];
				}
			}
			echo json_encode($data_array);
		}
	}

?>