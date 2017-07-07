<?php

    //*** receive query string from ajaxFunction
    $acity = $_REQUEST['acity'];
    
    //*** execute the query
    $query = "select * from pa_universities where city like '%$acity%'";

    $result = executeSQL($query, $acity);

    //*** print the result
    print($result);

?>







<?php

   //*** connect to mysql and run the query
   function executeSQL ($dbquery, $searchKey) {

		$dbhost = 'localhost';
		$dbuser  = "user13";
		$dbpass  = "CAskzSST";
		$dbname  = "user13db";

		//*** create a connection object
		$conn = mysql_connect($dbhost, $dbuser, $dbpass)
				or die (mysql_error());

		mysql_select_db($dbname)
				or die (mysql_error());

		//*** execute the query
		$result = mysql_query($dbquery);

		//*** die if no result
		if (!$result)
			 die("Query Failed.");



		//*** return query results in a string
		$query_result = "<table border=0 cellspacing=0 cellpadding=5 width=500 align=center>\n";

		$query_result = $query_result . "<tr>";
		for ($i = 0; $i<mysql_num_fields($result); $i++)
			$query_result = $query_result . "<th style=\"color:gray\">" . ucfirst(mysql_field_name($result, $i)) . "</th>";
		$query_result = $query_result . "</tr>";

              //*** background colors for printing
		$ptr = 0;
		$colors = array("white", "#dcebf8");

		while ($row = mysql_fetch_row($result)) {

		//*** alternate colors
              $ptr = ($ptr + 1)%2;
	       $query_result = $query_result . "<tr bgcolor=$colors[$ptr]>\n";

              $counter = 0;
		foreach ($row as $item) {

		        //*** zip appear in bold face
		        if ($counter==4)
		            $item = "<b style=\"color:#800080\">$item</b>";

		        //*** search key appears in bold face only in the city field

		        else if ($counter==2)
		            $item = str_replace($searchKey, "<b>$searchKey</b>", $item);


			    $query_result = $query_result . "   <td>$item</td>\n";

                         //*** advance column counter
			    $counter = $counter + 1;
                }

		  $query_result = $query_result . "</tr>\n";
		}
		$query_result = $query_result . "</table>\n";



		//*** Free the resources associated with the result
		mysql_free_result($result);

		//*** close this connection
		mysql_close($conn);

		return $query_result;
   }

?>