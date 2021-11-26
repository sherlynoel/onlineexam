<!DOCTYPE html>

<html>
	<head>
		<title>Excel upload</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
        <script src="jquery.tabledit.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        
        <style>
        * {
        box-sizing: border-box;
        }

        #FirstName {
        background-image: url('/css/searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 70%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        
        border: 1px solid #ddd;
        margin-top: 12px;
        margin-bottom: 12px;
        }

        #studentTable {
        border-collapse: collapse;
        width: 90%;
        border: 1px solid #ddd;
        font-size: 18px;
        }

        #studentTable th, #studentTable td {
        text-align: left;
        padding: 2px;
        }

        #studentTable tr {
        border-bottom: 1px solid #ddd;
        }

        #studentTable tr.header, #studentTable tr:hover {
        background-color: #f1f1f1;
        }
        </style>

	</head>

  <body>
    
  <form action='' method='post'>
    <label for="cars">Select Department :</label>
    <select name="Department" onchange='this.form.submit()'>
        <option value=""></option>
        <option value="All">All</option>
        <option value="CSE">CSE</option>
        <option value="ISE">ISE</option>
        <option value="ECE">ECE</option>
    </select>
  </form>

  <input type="text" id="FirstName" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">



    <?php 

        date_default_timezone_set('Africa/Dar_es_salaam');
        include 'database/config.php';
        include 'includes/uniques.php';
        
        $get_cols = "SHOW COLUMNS FROM `tbl_users`";
        $result= $conn->query($get_cols);
        $columns = array();

        // while($row = mysqli_fetch_array($result))
        //     array_push($columns, $row['Field']);
        
        $cols = "first_name,last_name,gender,email,sem_sec,usn,department";        

        $columns = explode (",", $cols);    
        
        $query = "SELECT first_name, last_name, gender, email, sem_sec, usn, department FROM tbl_users";

        
        if($_POST['Department'] == 'CSE'){
            
            $query .= " WHERE department='CSE'";
        
        }
        elseif($_POST['Department'] == 'ISE') {
            
            $query .= " WHERE department='ISE'";
        
        }
        elseif($_POST['Department'] == 'ECE') {
            
            $query .= " WHERE department='ECE'";
        
        } else{

            $query .= "";

        }        
        
        $result = $conn->query($query);

        // For selecting columns
        // $selected_fields = array();
        // for(int $i=0;$i<count($columns);$i++)
        //     array_push($selected_fields, $i);
        
        echo '<div id="student_table"><table class="table table-bordered table-striped" id="studentTable" border="1"><tr>';
        
        foreach ($columns as $key) {
            echo "<th>".$key."</th>";
        }
        
        echo "</tr>";

        if ($result->num_rows > 0) {
            
            // output data of each row
            while($row = $result->fetch_assoc()) 
                {
                    echo "<tr>";
                    for($i=0; $i<count($columns); $i++){

                        echo "<td>".$row[$columns[$i]]."</td>";
                    }
                    echo "</tr>";

                }

        } else {
            echo "0 results";
        }
        echo "</table></div>";
        print "Alright";
    ?>
    
  <br></br>
    
    <button id="create_excel" >Create Excel File</button>  
    
    <script>
    function myFunction() {

    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("FirstName");
    filter = input.value.toUpperCase();
    table = document.getElementById("studentTable");
    tr = table.getElementsByTagName("tr");
    
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }       
    }
    }
    </script>
    
    <script>

    $(document).ready(function(){  
        $('#create_excel').click(function(){  
            var excel_data = $('#student_table').html();
            
            excel_data = excel_data.replace(/&nbsp;/g, "");
            var page = "excel.php?data=" +excel_data;  
            window.location = page;  
        });  
    });  
    </script>
    
    <script>  
        $(document).ready(function(){  
            $('#studentTable').Tabledit({
            url:'editable.php',
            				
            columns:{
            identifier:[0, "first_name"],
            editable:[[1, 'last_name'], [2, 'gender'], [3, 'email'], [4, 'sem_sec'], [5, 'usn'], [6,'department']]
            },
            restoreButton:false,
            onDraw: function() {
                console.log('onDraw()');
            },
            onSuccess: function(data, textStatus, jqXHR) {
                console.log('onSuccess(data, textStatus, jqXHR)');
                console.log(data);
                console.log(textStatus);
                console.log(jqXHR);
            },
            onFail: function(jqXHR, textStatus, errorThrown) {
                console.log('onFail(jqXHR, textStatus, errorThrown)');
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            },
            onAlways: function() {
                console.log('onAlways()');
            },
            onAjax: function(action, serialize) {
                console.log('onAjax(action, serialize)');
                console.log(action);
                console.log(serialize);
            }
            });
        
        });  
    </script>
        
    </body>

</html>