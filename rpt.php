<?php 
    include('db168.php');
    $qry_select="SELECT * FROM tbl_2d3d";
    $select=$conn->query($qry_select);
    
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>2D</title>
</head>
<body>
    
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <style>
                    .fonttd{font-size:12px;}
                </style>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class='table-primary'>
                            <th class="fonttd">2ខ្ទង់</th>
                            <th class="fonttd">ដុល្លារ</th>
                            <th class="fonttd">រៀល</th>
                            <th class="fonttd">ប៉ុស្ដិ៍</th>
                            <th class="fonttd">$ប៉ុស្ដិ៍</th>
                            <th class="fonttd">៛ប៉ុស្ដិ៍</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($select as $row)
                            {
                                if($row['tA']=="A"){$pa=1;}else{$pa="";}
                                if($row['tB']=='B'){$pb=1;}else{$pb="";}
                                if($row['tC']=='C'){$pc=1;}else{$pc="";}
                                if($row['tD']=='D'){$pd=1;}else{$pd="";}
                                if($row['tH']=='H'){$ph=1;}else{$ph="";}
                                if($row['tI']=='I'){$pi=1;}else{$pi="";}
                                if($row['tN']=='N'){$pn=1;}else{$pn="";}
                                $ptotal=$pa+$pb+$pc+$pd+$ph+$pi+$pn;
                                if($row['tL23']=='L23')
                                {
                                   
                                   $totalus=$row['tus']*23;
                                   $totalkh=$row['tkh']*23;
                                }
                                
                                elseif($row['tL29']=='L29')
                                {
                                   
                                   $totalus=$row['tus']*29;
                                   $totalkh=$row['tkh']*29;
                                }
                                
                                else{
                                    $totalus=$row['tus']*$ptotal;
                                    $totalkh=$row['tkh']*$ptotal;
                                }
                                if($row['tus']==''){$totalus='';}
                                if($row['tkh']==''){$totalkh='';}
                                $allus+=$totalus;
                                $allkh+=$totalkh;
                                
                            ?>
                            <tr>
                                <td class="fonttd"><?php echo $row['t2d']?></td>
                                <td class="fonttd"><?php echo $row['tus']?></td>
                                <td class="fonttd"><?php echo $row['tkh']?></td>
                                <td class="fonttd"><?php echo $row['tA'],$row['tB'], $row['tC'],$row['tD'],$row['tH'],$row['tI'],$row['tN'],$row['tL23'], $row['tL29']; ?></td>
                                <td class="fonttd"><?=$totalus?></td>
                                <td class="fonttd"><?=$totalkh?></td>
                                
                            </tr>
                            <?php
                            
                            }
                            
                        ?>
                        <tr>
        
                            <td colspan="4" align="right" class="fonttd">សរុប</td>   
                            <td class="fonttd"><?=number_format($allus,2)?></td>   
                            <td class="fonttd"><?=$allkh?></td>   
                        </tr>
                        <tr>
                               
                            <td colspan="4" align="right" class="fonttd">សរុបកាត់ទឹក <?= $row['upt']?></td>   
                            <td class="fonttd"><?=number_format($allus*0.7,2)?></td>   
                            <td class="fonttd"><?=$allkh*0.7?></td>   
                        </tr>
                        <tr>
                               
                            <td colspan="6" align="right" class="fonttd">Q-<?php echo $row['uid']?> : <?php echo $row['tdate']?> <input type='button' value='Print' onclick='window.print()' /> </td>   
                        </tr>
                    </tbody>
                </table>
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