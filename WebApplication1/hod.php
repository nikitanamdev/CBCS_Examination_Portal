
  <?php include ('config.php') ;

  session_start();  ?>
    <!DOCTYPE html>
<html lan="en">
<head>
    <title>exam portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style5.css" />
    <script src="includes/jquery-1.6.2.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <style>
{
  box-sizing: border-box;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
  

table {
  border-collapse: collapse;
  text-align: center;
   width: 75%;

}

th {
  height: 30px;
    color: white;
}
 tr:nth-child(even){background-color: #f2f2f2}  
        
tr
        {
height: 25px;}
        

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
 
    overflow: hidden;

}
        .floatLeft { width: 50%; float: left; }
.floatRight {width: 50%; float: right; }

.col-25 {
  float: left;
  width: 20%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 40%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
    

</head>
<body>

   <div id="image">
        <img src="https://img.collegepravesh.com/2015/12/IGDTUW-Logo.png" alt="IGDTUW" width="150" height="150"  style="margin-left:8%">
    </div>
  <div class="top" style=" margin-top:-10%;margin-left:23%; align:center">
  <p style="font-size:30px; color:green"><b>INDIRA GANDHI DELHI TECHNICAL UNIVERSITY FOR WOMEN</b></p>
  <p style="margin-left:33%; margin-top:-2%; font-size:20px"><b>Kashmere Gate, Delhi-110006<b></p>
  </div>
  <br>
  <hr size='10'; color='green'></hr>
    <div id="navbar">
        <ul>
            <li><a href="homeH.php">Home</a></li>
            <li><a href="hod.php">Moderate Grades</a></li>
        </ul>
    </div>
    <br>
    <div id="navbar1">
       <ul>
            <li><a href="#enrollno.">Welcome <?php echo $_SESSION['username']; ?></a></li>
            <li><a href="front.php?logout='1'">Log Out</a></li>

        </ul>
    </div>
<br>
<br>
<br>
    

<h2>Provide the details</h2>

<div class="container">
    <div id = 'main' class="floatLeft">
  <form action="hod_prev_grades.php" method="post">
    <div class="row">
      <div class="col-25">
        <label for="department">Department</label>
      </div>
      <div class="col-75">
<select id="dept" name="dept" required>
  <option value=''>Please select from below</option>
	 <option value="CSE">Computer Science Engineering</option>
    <option value="IT">Information Technology </option>
    <option value="ECE">Electrical Engineering</option>
    <option value="MAE">Mechanical Engineering</option>
  </select>
        </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="semester">Semester</label>
      </div>
      <div class="col-75">
   <select id="sem" name="sem" required>
    <option value=''>Please select from below</option>
    <option value="1">1</option>
    <option value="2">2 </option>
  </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subjectcode">Subject</label>
      </div>
      <div class="col-75">
        <select id="sub" name="sub" required>
          <option value=''>Please select from below</option>
      <option name='CSE 1' value='BAS-101'>BAS-101 Applied Mathematics-I</option>
      <option name='CSE 1' value='BAS-103'>BAS-103 Applied Physics-I</option>
      <option name='CSE 1' value='BAS-105'>BAS-105 Applied Chemistry</option>
      <option name='CSE 1' value='BMA-110'>BMA-110 Engineering Mechanics</option>
      <option name='CSE 1' value='BEC-110'>BEC-110 Basic Electrical Engineering</option>
      <option name='CSE 1' value='BMA-120'>BMA-120 Workshop Practice</option>
      <option name='CSE 1' value='BMA-130'>BMA-130 Engineering Graphics Lab</option>
      <option name='CSE 1' value='HMC-110'>HMC-110 Humanities and Social Science</option>
      <option name='CSE 1' value='BCS-110'>BCS-110 Programming in C Language</option>
      <option name='CSE 1' value='MCS-101'>MCS-101 Problem Solving Through AI</option>
      <option name='CSE 1' value='MCS-103'>MCS-103 Soft Computing</option>
      <option name='CSE 1' value='MCS-105'>MCS-105 Intelligent Data and Information Retrieval</option>
      <option name='CSE 1' value='MCS-107'>MCS-107 Data Structures and Algorithm Analysis</option>
      <option name='CSE 1' value='GEC_101'>GEC-101 Generic Open Elective</option>
      <option name='CSE 1' value='ROC-101'>ROC-101 Research Methodology</option>

      <option name='CSE 2' value='BAS-102'>BAS-102 Applied Mathematics-II</option>
      <option name='CSE 2' value='BAS-104'>BAS-104 Applied Physics-II</option>
      <option name='CSE 2' value='BAS-106'>BAS-106 Environmental Science</option>
      <option name='CSE 2' value='BMA-110'>BMA-110 Engineering Mechanics</option>
      <option name='CSE 2' value='BEC-110'>BEC-110 Basic Electrical Engineering</option>
      <option name='CSE 2' value='BMA-120'>BMA-120 Workshop Practice</option>
      <option name='CSE 2' value='BMA-130'>BMA-130 Engineering Graphics Lab</option>
      <option name='CSE 2' value='HMC-110'>HMC-110 Humanities and Social Science</option>
      <option name='CSE 2' value='BCS-110'>BCS-110 Programming in C Language</option>
      <option name='CSE 2' value='MIS-102'>MIS-102 Machine Learning</option>
      <option name='CSE 2' value='MCS-104'>MCS-104 IoT and its Applications in AI</option>
      <option name='CSE 2' value='MCS-106'>MCS-106 Social Network Analysis</option>
      <option name='CSE 2' value='MCS-108'>MCS-108 Introduction to Cognitive Science</option>
      <option name='CSE 2' value='MCS-110'>MCS-110 AI Based Programming Tools</option>
      <option name='CSE 2' value='ROC-102'>ROC-102 Research Ethics</option>
      <option name='CSE 2' value='MCS-112'>MCS-112 Knowledge Engineering</option>
      <option name='CSE 2' value='MCS-114'>MCS-114 Cloud Computing</option>
      <option name='CSE 2' value='MCS-116'>MCS-116 Big Data Analysis</option>
      <option name='CSE 2' value='MCS-118'>MCS-118 Parallel Algorithms</option>
      <option name='CSE 2' value='MCS-120'>MCS-120 Knowledge Based System Design</option>
      <option name='CSE 2' value='MIS-112'>MIS-112 Computer Vision</option>

      <option name='IT 1' value='BAS-101'>BAS-101 Applied Mathematics-I</option>
      <option name='IT 1' value='BAS-103'>BAS-103 Applied Physics-I</option>
      <option name='IT 1' value='BAS-105'>BAS-105 Applied Chemistry</option>
      <option name='IT 1' value='BMA-110'>BMA-110 Engineering Mechanics</option>
      <option name='IT 1' value='BEC-110'>BEC-110 Basic Electrical Engineering</option>
      <option name='IT 1' value='BMA-120'>BMA-120 Workshop Practice</option>
      <option name='IT 1' value='BMA-130'>BMA-130 Engineering Graphics Lab</option>
      <option name='IT 1' value='HMC-110'>HMC-110 Humanities and Social Science</option>
      <option name='IT 1' value='BCS-110'>BCS-110 Programming in C Language</option>
      <option name='IT 1' value='MIS-101'>MIS-101 Advanced Programming</option>
      <option name='IT 1' value='MIS-103'>MIS-103 Advanced Data Structure and Algorithms</option>
      <option name='IT 1' value='MIS-105'>MIS-105 Advances in Machine Learning</option>
      <option name='IT 1' value='MIS-107'>MIS-107 Fundamentals of Information Security</option>
      <option name='IT 1' value='GEC_101'>GEC-101 Generic Open Elective</option>
      <option name='IT 1' value='ROC-101'>ROC-101 Research Methodology</option>

      <option name='IT 2' value='BAS-102'>BAS-102 Applied Mathematics-II</option>
      <option name='IT 2' value='BAS-104'>BAS-104 Applied Physics-II</option>
      <option name='IT 2' value='BAS-106'>BAS-106 Environmental Science</option>
      <option name='IT 2' value='BMA-110'>BMA-110 Engineering Mechanics</option>
      <option name='IT 2' value='BEC-110'>BEC-110 Basic Electrical Engineering</option>
      <option name='IT 2' value='BMA-120'>BMA-120 Workshop Practice</option>
      <option name='IT 2' value='BMA-130'>BMA-130 Engineering Graphics Lab</option>
      <option name='IT 2' value='HMC-110'>HMC-110 Humanities and Social Science</option>
      <option name='IT 2' value='BCS-110'>BCS-110 Programming in C Language</option>
      <option name='IT 2' value='MIS-102'>MIS-102 Secure Coding and Security Engineering</option>
      <option name='IT 2' value='MIS-104'>MIS-104 Applied Cryptography</option>
      <option name='IT 2' value='MIS-106'>MIS-106 Cyber Forensics</option>
      <option name='IT 2' value='MIS-108'>MIS-508 Adv. Database Management Systems</option>
      <option name='IT 2' value='MIS-510'>MIS-510 Introduction to Biometrics</option>
      <option name='IT 2' value='MIS-512'>MIS-512 Wireless Networks</option>
      <option name='IT 2' value='MIS-514'>MIS-514 Blockchain Fundamentals</option>
      <option name='IT 2' value='MIS-518'>MIS-518 Soft Computing</option>
      <option name='IT 2' value='MIS-520'>MIS-520 Semantic Web</option>
      <option name='IT 2' value='MIS-522'>MIS-522 Security Testing and Risk Management</option>
      <option name='IT 2' value='MIS-524'>MIS-524 Natural Language Processing and Information Retrieval</option>
      <option name='IT 2' value='ROC-102'>ROC-102 Research Ethics</option>

      <option name='ECE 1' value='BAS-101'>BAS-101 Applied Mathematics-I</option>
      <option name='ECE 1' value='BAS-103'>BAS-103 Applied Physics-I</option>
      <option name='ECE 1' value='BAS-105'>BAS-105 Applied Chemistry</option>
      <option name='ECE 1' value='BMA-110'>BMA-110 Engineering Mechanics</option>
      <option name='ECE 1' value='BEC-110'>BEC-110 Basic Electrical Engineering</option>
      <option name='ECE 1' value='BMA-120'>BMA-120 Workshop Practice</option>
      <option name='ECE 1' value='BMA-130'>BMA-130 Engineering Graphics Lab</option>
      <option name='ECE 1' value='HMC-110'>HMC-110 Humanities and Social Science</option>
      <option name='ECE 1' value='BCS-110'>BCS-110 Programming in C Language</option>
      <option name='ECE 1' value='MVD-101'>MVD-101 CMOS Analog Circuit Design</option>
      <option name='ECE 1' value='MVD-103'>MVD-103 Semiconductor Devices for Digital Integrated Circuits</option>
      <option name='ECE 1' value='MVD-105'>MVD-105 Hardware Description Languages</option>
      <option name='ECE 1' value='MVD-107'>MVD-107 Advanced IC Processing</option>
      <option name='ECE 1' value='GEC_101'>GEC-101 Generic Open Elective</option>
      <option name='ECE 1' value='ROC-101'>ROC-101 Research Methodology</option>

      <option name='ECE 2' value='BAS-102'>BAS-102 Applied Mathematics-II</option>
      <option name='ECE 2' value='BAS-104'>BAS-104 Applied Physics-II</option>
      <option name='ECE 2' value='BAS-106'>BAS-106 Environmental Science</option>
      <option name='ECE 2' value='BMA-110'>BMA-110 Engineering Mechanics</option>
      <option name='ECE 2' value='BEC-110'>BEC-110 Basic Electrical Engineering</option>
      <option name='ECE 2' value='BMA-120'>BMA-120 Workshop Practice</option>
      <option name='ECE 2' value='BMA-130'>BMA-130 Engineering Graphics Lab</option>
      <option name='ECE 2' value='HMC-110'>HMC-110 Humanities and Social Science</option>
      <option name='ECE 2' value='BCS-110'>BCS-110 Programming in C Language</option>
      <option name='ECE 2' value='MVD-102'>MVD-102 Device Modeling and Circuit Simulation</option>
      <option name='ECE 2' value='MVD-104'>MVD-104 Digital System Design with FPGA</option>
      <option name='ECE 2' value='MVD-106'>MVD-106 Analog Integrated Circuits</option>
      <option name='ECE 2' value='MVD-108'>MVD-108 Semiconductor Memory Design</option>
      <option name='ECE 2' value='MVD-110'>MVD-110 Digital VLSI Design</option>
      <option name='ECE 2' value='ROC-102'>ROC-102 Research Ethics</option>
      <option name='ECE 2' value='MVD-112'>MVD-112 Analog Filter Design</option>
      <option name='ECE 2' value='MVD-114'>MVD-114 Digital Techniques for High Speed Design</option>
      <option name='ECE 2' value='MVD-116'>MVD-116 CMOS Mixed-Signal VLSI Design</option>
      <option name='ECE 2' value='MVD-118'>MVD-118 Advanced Embedded System Design</option>
      <option name='ECE 2' value='MVD-120'>MVD-120 Deep Submicron CMOS ICs</option>
      <option name='ECE 2' value='MVD-122'>MVD-122 Digital System Design using Verilog</option>
      <option name='ECE 2' value='MVD-124'>MVD-124 MEMS & Microsystems</option>
      <option name='ECE 2' value='MVD-126'>MVD-126 Internet of Things</option>

      <option name='MAE 1' value='BAS-101'>BAS-101 Applied Mathematics-I</option>
      <option name='MAE 1' value='BAS-103'>BAS-103 Applied Physics-I</option>
      <option name='MAE 1' value='BAS-105'>BAS-105 Applied Chemistry</option>
      <option name='MAE 1' value='BMA-110'>BMA-110 Engineering Mechanics</option>
      <option name='MAE 1' value='BEC-110'>BEC-110 Basic Electrical Engineering</option>
      <option name='MAE 1' value='BMA-120'>BMA-120 Workshop Practice</option>
      <option name='MAE 1' value='BMA-130'>BMA-130 Engineering Graphics Lab</option>
      <option name='MAE 1' value='HMC-110'>HMC-110 Humanities and Social Science</option>
      <option name='MAE 1' value='BCS-110'>BCS-110 Programming in C Language</option>
      <option name='MAE 1' value='MRA-103'>MRA-103 Mechatronics Systems and Applications</option>
      <option name='MAE 1' value='MRA-105'>MRA-105 Computer Aided Modeling and Analysis</option>
      <option name='MAE 1' value='MRA-107'>MRA-107 Automation in Manufacturing</option>
      <option name='MAE 1' value='GEC_101'>GEC-101 Generic Open Elective</option>
      <option name='MAE 1' value='ROC-101'>ROC-101 Research Methodology</option>

      <option name='MAE 2' value='BAS-102'>BAS-102 Applied Mathematics-II</option>
      <option name='MAE 2' value='BAS-104'>BAS-104 Applied Physics-II</option>
      <option name='MAE 2' value='BAS-106'>BAS-106 Environmental Science</option>
      <option name='MAE 2' value='BMA-110'>BMA-110 Engineering Mechanics</option>
      <option name='MAE 2' value='BEC-110'>BEC-110 Basic Electrical Engineering</option>
      <option name='MAE 2' value='BMA-120'>BMA-120 Workshop Practice</option>
      <option name='MAE 2' value='BMA-130'>BMA-130 Engineering Graphics Lab</option>
      <option name='MAE 2' value='HMC-110'>HMC-110 Humanities and Social Science</option>
      <option name='MAE 2' value='BCS-110'>BCS-110 Programming in C Language</option>
      <option name='MAE 2' value='MRA-102'>MRA-102 Pneumatic and Hydraulic Controls</option>
      <option name='MAE 2' value='MRA-104'>MRA-104 Computer Integrated Manufacturing</option>
      <option name='MAE 2' value='MRA-106'>MRA-106 Microcontroller & Applications</option>
      <option name='MAE 2' value='MRA-108'>MRA-108 Modern Control Theory</option>
      <option name='MAE 2' value='MRA-110'>MRA-110 MEMS and MicroSystems</option>
      <option name='MAE 2' value='MRA-112'>MRA-112 Artificial Intelligence</option>
      <option name='MAE 2' value='MRA-114'>MRA-114 Instrumentation and Control Engineering</option>
      <option name='MAE 2' value='MRA-116'>MRA-116 Numeric Methods</option>
      <option name='MAE 2' value='MRA-118'>MRA-118 Advanced Digital Signal Processing</option>
      <option name='MAE 2' value='MRA-120'>MRA-120 Advanced Finite Element Methods</option>
      <option name='MAE 2' value='MRA-122'>MRA-122 Neural Network and Fuzzy Logic</option>
      <option name='MAE 2' value='MRA-124'>MRA-124 Optimization for Engineering</option>
      <option name='MAE 2' value='MRA-126'>MRA-126 Modelling & Simulation</option>
      <option name='MAE 2' value='ROC-102'>ROC-102 Research Ethics</option>
        </select>
		<!--<div id="textDiv">
		</div>-->
      </div>
    </div>
   <script>
      $(document).ready(function(){
       
          $("#dept").change(function() {
             if ($(this).data('options') === undefined) {
      /*Taking an array of all options-2 and kind of embedding it on the select1*/
      $(this).data('options', $('#sub option').clone());
      }
          var id = $(this).val() + ' ' + $("#sem").val();
          var options = $(this).data('options').filter('[name="' + id + '"]');
          $("#sub").html(options);
        });

          $("#sem").change(function() {
            if ($("#dept").data('options') === undefined) {
      /*Taking an array of all options-2 and kind of embedding it on the select1*/
      $("#dept").data('options', $('#sub option').clone());
      }
          var id = $("#dept").val() + ' ' + $("#sem").val();
          var options = $("#dept").data('options').filter('[name="' + id + '"]');
          $("#sub").html(options);
        });
    });
    </script> 
    <!-- <div class="row">
      <div class="col-25">
        <label for="subjectname">Subject</label>
      </div>
      <div class="col-75">
        <textarea id="textDiv" style="height:20px" readonly></textarea>
      </div>
    </div> -->
	<br>
    <div >
	<center>
      <input type="submit" value="Submit">
    </center>
	</div>
  </form>
</div>
   
   
   <!-- <div class="floatRight">
    <table align="center">
    <tr align="center" bgcolor="green" height="40px" >
		<th style="color:white;width:60px;text-align:center;">Grade</th>
		<th style="color:white;width:100px;text-align:center;" >Upper Limit</th>
		<th style="color:white;width:100px;text-align:center;">Lower Limit</th>
		<th style="color:white;width:100px;text-align:center;">Count</th>
     </tr>
    <tr>
        <td>A+</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>A</td>
         <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>B+</td>
         <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>B</td>
         <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>C+</td>
         <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>C</td>
         <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>D</td>
         <td></td>
        <td></td>
        <td></td>
    </tr>

        <td>F</td>
     <td></td>
        <td></td>
        <td></td>
    </tr>  
</table>

    <br>

    <form action="moderation.php">
     <div >
	<center>
      <input type="submit" value="Edit">
    </center>
	</div>
    </form>
    </div> -->
   
    <!--<form action="moderation.php" >
    <button class="float-right  submit-button"  style="height:40px; width :70px ;color :white; background-color:#54A548; float:right;" >Edit</button>
   </form>-->


    
<script type="text/javascript">

	var sem1=new Array()
	sem1[0]="Applied Mathematics-I"
	sem1[1]="Applied Physics"
	sem1[2]="Applied Chemistry"
	sem1[3]="Elements of Mechanical Engineering"
	sem1[4]="Introduction to Computers and Programming"
	sem1[5]="Communication Skills-I"
	sem1[6]="Applied Physics Lab-I"
	sem1[7]="Applied Chemistry Lab"
	sem1[8]="Computers and Programming Lab"
	var sem2=new Array()
	sem2[0]="Applied Mathematics-II"
	sem2[1]="Applied Physics-II"
	sem2[2]="Environmental Sciences"
	sem2[3]="Electrical Science"
	sem2[4]="Engineering Mechanics"
	sem2[5]="Comummnication Skills-II"
	sem2[6]="Applied Physics-II"
	sem2[7]="Environmental Science Lab"
	sem2[8]="Electrical Science Lab"
	sem2[9]="Engineering Mechanics Lab"
	sem2[10]="Engineering Graphics Lab"
function getText(slction)
{
   txtselected=slction.selectedIndex;
   document.getElementById('textDiv').innerHTML = sem1[txtselected];
}		
</script>
</body>
</html>
