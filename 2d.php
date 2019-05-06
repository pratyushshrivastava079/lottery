<?php 
    include('db168.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CSS for the things we want to print (print view) -->
    <style type="text/css" media="print">
    
    #SCREEN_VIEW_CONTAINER{
            display: none;
        }
    .other_print_layout{
            background-color:#FFF;
        }
    </style>
    
    <!-- CSS for the things we DO NOT want to print (web view) -->
    <style type="text/css" media="screen">
    
       #PRINT_VIEW{
          display: none;
       }
    .other_web_layout{
            background-color:#E0E0E0;
        }
    </style>

    <title>2D</title>
</head>
<body>
    <div class="container">    
    <?php
    if(isset($_POST['bsubmit']))
    {
        $t2d=$_POST['t2d'];
        $t3d="";
        $tus=$_POST['tus'];
        $tkh=$_POST['tkh'];
        $opt=$_POST['opt'];
        $a=$_POST['a'];
        $b=$_POST['b'];
        $c=$_POST['c'];
        $d=$_POST['d'];
        $h=$_POST['h'];
        $i=$_POST['i'];
        $n=$_POST['n'];
        $l23=$_POST['l23'];
        $l29=$_POST['l29'];
        $tdate=date("Y-m-d G:i:s");
        $tuid=1;
        
        if(($t2d!="" and $tus!="") or ($t2d!="" and $tkh!=""))
        {   
            if($a=="A"){$pa=1;}
            if($b=="B"){$pb=1;}
            if($c=="C"){$pc=1;}
            if($d=="D"){$pd=1;}
            if($h=="H"){$ph=1;}
            if($i=="I"){$pi=1;}
            if($n=="N"){$pn=1;}
            
            
            $ptotal=$pa+$pb+$pc+$pd+$ph+$pi+$pn;
            
            
            echo "<table class='table table-sm'><tr class='table-primary'><td>2ខ្ទង់</td><td>ដុល្លារ</td><td>រៀល</td><td>ប៉ុស្តិ៍</td></tr>";
            if($opt==1)
            {
                $t2dcon=$t2d+8;
                $tustotal=0;
                $tkhtotal=0;
                for($t2d=$t2d; $t2d<=$t2dcon; $t2d+=2)
                {
                    
                        $t2d2s = sprintf("%02d", $t2d);
                    
                    $sqry="INSERT INTO tbl_2d3d(id, uid, t2d, t3d, tus, tkh, tdate, toe, t5, t10, tA, tB, tC, tD, tH, tI, tN, tL23, tL29) VALUES(Null, '$tuid', '$t2d2s', '$t3d', '$tus', '$tkh', '$tdate', '1', '','', '$a', '$b', '$c', '$d','$h', '$i', '$n', '$l23', '$l29')";
                    
                    $tustotal=$tustotal+$tus;
                    $tkhtotal=$tkhtotal+$tkh;
                    
                    $insert2d=$conn->query($sqry);
                    if($insert2d)
                    {
                          echo "<tr><td>$t2d2s</td><td>$tus</td><td>$tkh</td><td>($a$b$c$d$h$i$n$l23$l29)</td></tr>";
                    }
                    else
                    {
                        echo "No";
                    }
                    
                 }
            }
            elseif($opt==2)
            {
                $t2dcon=$t2d+4;
                $tustotal=0;
                $tkhtotal=0;
                
                for($t2d=$t2d; $t2d<=$t2dcon; $t2d++)
                {
                    $t2d2s = sprintf("%02d", $t2d);
                    $sqry="INSERT INTO tbl_2d3d(id, uid, t2d, t3d, tus, tkh, tdate, toe, t5, t10, tA, tB, tC, tD, tH, tI, tN, tL23, tL29) VALUES(Null, '$tuid', '$t2d2s', '$t3d', '$tus', '$tkh', '$tdate', '', '1','', '$a', '$b', '$c', '$d','$h', '$i', '$n', '$l23', '$l29')";
                    $tustotal=$tustotal+$tus;
                    $tkhtotal=$tkhtotal+$tkh;
                    
                    $insert2d=$conn->query($sqry);
                    if($insert2d)
                    {
                          echo "<tr><td>$t2d2s</td><td>$tus</td><td>$tkh</td><td>($a$b$c$d$h$i$n$l23$l29)</td></tr>";
                    }
                    else
                    {
                        echo "No";
                    }    
                 }
            }
            elseif($opt==3)
            {
                $t2dcon=$t2d+9;
                $tustotal=0;
                $tkhtotal=0;
                for($t2d=$t2d; $t2d<=$t2dcon; $t2d++)
                {
                    $t2d2s = sprintf("%02d", $t2d);
                    $sqry="INSERT INTO tbl_2d3d(id, uid, t2d, t3d, tus, tkh, tdate, toe, t5, t10, tA, tB, tC, tD, tH, tI, tN, tL23, tL29) VALUES(Null, '$tuid', '$t2d2s', '$t3d', '$tus', '$tkh', '$tdate', '', '','1', '$a', '$b', '$c', '$d','$h', '$i', '$n', '$l23', '$l29')";
                    $tustotal=$tustotal+$tus;
                    $tkhtotal=$tkhtotal+$tkh;
                    $insert2d=$conn->query($sqry);
                    if($insert2d)
                    {
                         echo "<tr><td>$t2d2s</td><td>$tus</td><td>$tkh</td><td>($a$b$c$d$h$i$n$l23$l29)</td></tr>";
                        
                    }
                    else
                    {
                        echo "No";
                    }    
                 }
            }
            else
            {

                $sqry="INSERT INTO tbl_2d3d(id, uid, t2d, t3d, tus, tkh, tdate,toe, t5, t10, tA, tB, tC, tD,tH, tI, tN, tL23, tL29) VALUES(Null, '$tuid', '$t2d', '$t3d', '$tus', '$tkh', '$tdate', '', '','', '$a', '$b', '$c', '$d', '$h', '$i', '$n', '$l23', '$l29')";
                    $tustotal=$tus;
                    $tkhtotal=$tkh;
                    $insert2d=$conn->query($sqry);
                    
                    if($insert2d)
                    {
                        echo "<tr><td>$t2d</td><td>$tus</td><td>$tkh</td><td>($a$b$c$d$h$i$n$l23$l29)</td></tr>";
                    }
                    else
                    {
                        echo "No";
                    }    
            }
            
        
                   
                    
                    if($l23=="L23"){$tusall=23*$tustotal;$tkhall=23*$tkhtotal;}
                    elseif($l29=="L29"){$tusall=29*$tustotal;$tkhall=29*$tkhtotal;}
                    else{$tusall=$ptotal*$tustotal;
                    $tkhall=$ptotal*$tkhtotal;
                    }
                    
                     if ($tkhall==0){
                        $tkhall="";
                    }
                    if ($tusall==0){
                        $tusall="";
                    }

                    echo "<tr class='table-primary'><td>សរុប</td><td>$tusall</td><td>$tkhall</td><td>$tdate</td></tr></table>";
                    echo "<div id='SCREEN_VIEW_CONTAINER'><center><input type='button' value='Print' onclick='window.print()' /></center></div";

        }
        else
        {
            
           echo "<center>សូមបញ្ចូលប្រាក់ដុល្លារឬប្រាក់រៀល</center>";
        }  

        
    }
    ?>
    

        <div class="row">
            <div class="col-12">
<div id="SCREEN_VIEW_CONTAINER">
            <form method="POST" name="mydigit">
    <script type="text/javascript">
        function onlyNumbersWithDot(e) {           
            var charCode;
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 46)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row no-gutters">
                            <div class="col ml-1">
                            <input type="text" name="t2d" maxlength="2" id="t2d" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="2ខ្ទង់" required>
                            </div>
                        
                            <div class="col-3 ml-1">
                            <input type="text" name="tus" maxlength="5" class="form-control" onkeypress="return onlyNumbersWithDot(event);" placeholder="$">
                            </div>
                        
                            <div class="col-3 ml-1">
                            <input type="text" name="tkh" maxlength="5" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="៛">
                            </div>
                            <div class="col-3">
                                &nbsp;&nbsp;&nbsp;<input type="submit" name="bsubmit" value="ចាក់" class="btn btn-primary">
                               
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mt-2">
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="radio" name="opt" value="1">
                            <label>5(សេស/គូ)</label>
                        </div>
                    </div>
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="radio" name="opt" value="2">
                            <label>5លំដាប់</label>
                        </div>
                    </div>
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="radio" name="opt" value="3">
                            <label>10លំដាប់</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    
                    <script>
                    function check() {
                      document.getElementById("ua").checked = false;
                      document.getElementById("ub").checked = false;
                      document.getElementById("uc").checked = false;
                      document.getElementById("ud").checked = false;
                      document.getElementById("uh").checked = false;
                      document.getElementById("uf").checked = false;
                      document.getElementById("un").checked = false;
                      document.getElementById("ul29").checked = false;
                    }
                    function check2() {
                      document.getElementById("ul23").checked = false;
                      document.getElementById("ul25").checked = false;
                      document.getElementById("ul27").checked = false;
                      document.getElementById("ul29").checked = false;
                    }
                    function checkall() {
                      document.getElementById("ua").checked = false;
                      document.getElementById("ub").checked = false;
                      document.getElementById("uc").checked = false;
                      document.getElementById("ud").checked = false;
                      document.getElementById("uh").checked = false;
                      document.getElementById("uf").checked = false;
                      document.getElementById("un").checked = false;
                      document.getElementById("ul23").checked = false;
                      document.getElementById("ul25").checked = false;
                      document.getElementById("ul27").checked = false;
                    }
                    </script>
                    
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="checkbox" name="a" value="A" id="ua"  onclick="check2()">
                            <label>A</label>
                        </div>
                    </div>
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="checkbox" name="b" value="B" id="ub" onclick="check2()">
                            <label>B</label>
                        </div>
                    </div>
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="checkbox" name="c" value="C" id="uc" onclick="check2()">
                            <label>C</label>
                        </div>
                    </div>
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="checkbox" name="d" value="D" id="ud" onclick="check2()">
                            <label>D</label>
                        </div>
                    </div>
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="checkbox" name="h" value="H" id="uh" onclick="check2()">
                            <label>H</label>
                        </div>
                    </div>
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="checkbox" name="f" value="F" id="uf" onclick="check2()">
                            <label>F</label>
                        </div>
                    </div>
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="checkbox" name="n" value="N" id="un" onclick="check2()">
                            <label>N</label>
                        </div>
                    </div>
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="checkbox" name="l23" value="L23" id="ul23" onclick="check()">
                            <label>L23</label>
                        </div>
                    </div>
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="checkbox" name="l25" id="ul25" value="L25" onclick="checkall()">
                            <label>L25</label>
                        </div>
                    </div>
                    
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="checkbox" name="l27" value="L27" id="ul27" onclick="check()">
                            <label>L27</label>
                        </div>
                    </div>
                    <div class="form-check-inline">
                        <div class="form-check-input">
                            <input type="checkbox" name="l29" id="ul29" value="L29" onclick="checkall()">
                            <label>L29</label>
                        </div>
                    </div>
                    
                </div>
                
            <?php
            /*
            <input type="reset" name="reset" value="C" class="btn btn-success col-12">
                    <style>.btnnum{width:50px; font-size:18px; height:50px; border:2px solid #000; border-radius: 50%;text-align:center;margin:2px 0px;background-color:#9acbfd;}
                    </style>
                   <input type="button" name="one" value="1" onclick="mydigit.t2d.value += '1'" class="btnnum">
                   <input type="button" name="two" value="2" onclick="mydigit.t2d.value += '2'"  class="btnnum">
                   <input type="button" name="three" value="3" onclick="mydigit.t2d.value += '3'"  class="btnnum"><br>
                   <input type="button" name="four" value="4" onclick="mydigit.t2d.value += '4'"  class="btnnum">
                   <input type="button" name="five" value="5" onclick="mydigit.t2d.value += '5'"  class="btnnum">
                   <input type="button" name="six" value="6" onclick="mydigit.t2d.value += '6'"  class="btnnum"><br>
                   <input type="button" name="seven" value="7" onclick="mydigit.t2d.value += '7'"  class="btnnum">
                   <input type="button" name="eight" value="8" onclick="mydigit.t2d.value += '8'" class="btnnum">
                   <input type="button" name="nine" value="9" onclick="mydigit.t2d.value += '9'"  class="btnnum"><br>
                    <input type="reset" id="reset" name="reset" value="C" onclick="mydigit.t2d.value = ''"  class="btnnum">
                   <input type="button" name="zero" value="0" onclick="mydigit.t2d.value += '0'"  class="btnnum">
                   <input type="button" name="dot" value="." onclick="mydigit.t2d.value += '.'"  class="btnnum">
                  */
                  ?>
            </form>
</div>            
        
            </div>
        </div>    
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>