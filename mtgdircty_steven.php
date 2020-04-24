<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>- Meeting Directory -</title>
  <!-- --------------------- added by GSD 7-24-15  -->
  <link href="/css/suffolk-sia.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <LINK REL="SHORTCUT ICON" HREF="/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Neuton|Playfair+Display+SC" rel="stylesheet">


    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="css/v2Main19.css" rel="stylesheet" />
    <link href="css/V2Main-Custom.css" rel="stylesheet">
    <!-- - -->
    <script type="text/javascript" language="javascript">
    <!-- //
    function ClearForm(){
      document.meetingSearch.reset();
    }
    // -->
  </script>
</head>
<body onload="ClearForm()">
  <!-- --- added by GSD 7-24-15 - -->

  <!-- ----- -->
  <div class="d-flex" id="wrapper">
    <div>
      <? readfile("menu_steven.php"); ?>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <button class="btn btn-primary" id="menu-toggle">Menu</button>
      <h6 class="ml-auto text-right">A.A - Suffolk, NY</h6>
    </nav>
    <div id="page-content-wrapper">
      <h5>A.A. Meetings in Suffolk County, New York</h5>
      <div class="interestFont">Today is&nbsp;
        <?php
        date_default_timezone_set('America/New_York'); //added 1-12-15 by GSD due to server error message
        echo( date("l, F jS Y") );
        ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
        <div class="container-fluid" id="townTable">
          <!-- change form action to showMeeting2.php -->
          <form action="showMeetings99.php" method="post" name="meetingSearch" id="meetingSearch">

            <div class="row">

              <div class="col-sm-6">Select Town
                <?php
                // SQL Connect scripts
                include ("process/sql-connect.php");
                include ("process/sql-open.php");
                //
                /* Dynamic list box maker for towns */
                function townList($table, $selected, $boxname, $displayfield){
                  $sql = "SELECT DISTINCT $displayfield FROM $table order by $displayfield";
                  $result = mysql_query($sql) or die("dynamic list box query failed.");
                  $boxcode = '<select name="'.$boxname.'"'.' class="generalText" id="ddTown">';
                  $boxcode .= "<option>Choose Town</option>";
                  while ($row = mysql_fetch_array($result)){
                    list ($i) = $row;
                    $boxcode .= '<option value="'.ucwords(strtolower($i)).'"';
                    if(ucwords(strtolower($i)) == $selected) $boxcode .= " selected";
                    $boxcode .= ">".ucwords(strtolower($i))."</option>";
                  }
                  $boxcode .= "</select>";
                  return $boxcode;
                }
                // this function is called using
                $boxcode = townList('meeting', 'Choose Town', 'ddTown', 'town');
                // and displayed using
                echo $boxcode;
                /* Dynamic list box maker for groups */
                function groupList($gtable, $gselected, $gboxname, $gdisplayfield){
                  $gsql = "SELECT DISTINCT $gdisplayfield FROM $gtable order by $gdisplayfield";
                  $gresult = mysql_query($gsql) or die("dynamic list box query failed.");
                  $gboxcode = '<select name="'.$gboxname.'"'.' class="generalText" id="ddGroup">';
                  $gboxcode .= "<option>Choose Group</option>";
                  while ($grow = mysql_fetch_array($gresult)){
                    list ($j) = $grow;
                    $gboxcode .= '<option value="'.ucwords(strtolower($j)).'"';
                    if(ucwords(strtolower($j)) == $gselected) $gboxcode .= " selected";
                    $gboxcode .= ">".ucwords(strtolower($j))."</option>";
                  }
                  $gboxcode .= "</select>";
                  return $gboxcode;
                  //	mysql_close();
                }
                // this function is called using
                $gboxcode = groupList('meeting', 'Choose Group', 'ddGroup', 'group_name');
                ?>
              </div>
              <div class="col-sm-6">


                &nbsp;And/Or Choose Day of Week
                <select name="ddDay" class="generalText" id="ddDay">
                  <option>Choose Day</option>
                  <option value="SU">Sunday</option>
                  <option value="MN">Monday</option>
                  <option value="TU">Tuesday</option>
                  <option value="WD">Wednesday</option>
                  <option value="TH">Thursday</option>
                  <option value="FR">Friday</option>
                  <option value="SA">Saturday</option>
                </select>

              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                Or Search by Group Name: <?php echo $gboxcode;?>
                &nbsp;
                <input type="submit" name="Submit" value="Submit"/>
                &nbsp;
                <input name="Reset" type="reset" id="Reset" value="Reset" />
              </div>
            </div>
<div class="container">



        <?php
        // code to display towns in table from database.  This way if a town is added or deleted from the database the change will automatically show here.
        // so when someone adds a meeting in a new town the only thing that needs to be done is add the meeting to the database.
        $query = "SELECT DISTINCT town FROM meeting order by town";
        $result = mysql_query($query) or die ("Table query failed.");
        $num=mysql_numrows($result);
        //echo "found $num towns";
        for ($i = 1; $i <= $num; $i++) {
          $town = mysql_result($result,$i-1,"town");
          $town = ucwords(strtolower($town));
          $townLink = '<a href="showMeetings99.php?town='.$town.'">'.$town.'</a>';
          echo '<td nowrap="nowrap" align="center">';
          echo $townLink;
          echo "</td>";
          if ($i % 6 == 0)
          {
            echo '</div>
            <div class="row">';
          }

        }

        mysql_close($conn);

        ?>
</div>
      </form>
      <script>
      document.forms['meetingSearch'].reset()
    </script>

  </div>
</div>
</div>

<!-- -- added by GSD 7-24-15 - -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});
</script>
<!-- - -->
</body>
</html>
