<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ນໍາເຂົ້າສິນຄ້າ</title>
    <link rel="shortcut icon" href="../../photo/logo2.png" type="image/x-icon">
        <link rel="stylesheet" href="../../node_modules/custom.css">
            <style type="text/css">
            body,td,th{font-family: Phetsarath OT;}
        </style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <div class="container">
        <?php include_once '../prodiv/icon.php';  ?>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../index.php">ໜ້າຫຼັກ <span class="sr-only">(current)</span></a>
            </li>
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-edit'></span>&nbsp;ນໍາເຂົ້າສິນຄ້າ
                </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
               <a class="dropdown-item" href="CheckLessStock.php">ກວດສອບສິນຄ້າ</a>
               <a class="dropdown-item" href="OrderOut.php"> ຈັດຊື້ສິນຄ້າ</a>
        <a class="dropdown-item" href="importProduct.php"> ນໍາສິນຄ້າເຂົ້າ</a>
              </div>
          </li>
           </ul>
        <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <span class="fa fa-calendar"></span>  <?php
                            $Today=date('y:m:d');
                            $new=date('l, F d, Y',strtotime($Today));
                            echo $new; ?>
                        &nbsp;
                    </li> 
            <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <?php extract($_SESSION); echo $admin_username; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="../logout.php">
                                <span class="fa fa-power-off"></span> ອອກລະບົບ</a></li>
                        </ul>
                    </li>
                </ul>
      </div>
    </div>
</nav> <!-- End nav -->
    <div class="container container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div style="background-color: #7DA0B1">
                    <div class="card" style="height: auto;  box-shadow: 1px 1px 1px 1px #1c7430">
                        <br>
                        <div class="card-title">
                            <div>
                                <div class="row">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <img src="{{asset('img/nopic.jpg')}}" alt="" style="width: 120px;margin-bottom: 10px">
                                    </div>
                                    <div class="col-md-8 col-lg-8 col-xl-8">
                                        &nbsp;&nbsp;
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xl-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="height: auto; box-shadow: 1px 1px 1px 1px #B3E5FC">
                            <div  style="overflow: scroll;height: 800px">
                                <!-- <div style="text-align: right;">
                                    <a href="../index.php" class="btn btn-success" style="margin-right: 10px">ໜ້າຫຼັກ</a>
                                </div>
                                <br> -->
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="table-responsive">
                                            <table class="table table-hover" style="">
                                                <tr>
                                                    <th style="background-color: #B3E5FC;text-align: center">ລະຫັດສັ່ງຊື້</th>
                                                    <th style="background-color: #B3E5FC;text-align: center">ວັນທີ່ສັ່ງຊື້ອອກ</th>
                                                    <th style="background-color: #B3E5FC;text-align: center">ປະເພດ</th>
                                                    <th style="background-color: #B3E5FC;text-align: center">ຜູ້ສະໜອງ</th>
                                                    <th style="background-color: #B3E5FC;text-align: center">ນໍາເຂົ້າ</th>
                                                </tr>
                                                <?php
                                                include("../../config.php");
                                                
                                                $stmt = $DB_con->prepare('SELECT * FROM orders where status= 0');
                                                $stmt->execute();
                                                
                                                if($stmt->rowCount() > 0)
                                                {
                                                    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                                                    {
                                                        extract($row);      
                                                        ?>
                                                        
                                                        <tr>
                                                              
                                                            <td style="text-align: center"><?php echo $row['OrderID']; ?></td>
                                                            <td style="text-align: center"> <?php echo $row['OrderDate']; ?></td>

                                                            <?php
                                                            include("../db.php");
                                        $producttype = "select ctg.CategoryName as ctg_name  from categories as ctg where ctg.CategoryID ='".$row['CategoryID']."' ";

                                        $typename = mysqli_query($conn,$producttype);

                                        while ($row1 = mysqli_fetch_assoc($typename)) {
                                           ?>
                                            <td><?php echo $row1['ctg_name']; ?></td>
                                           <?php
                                        }
                                       ?>

                                                           <?php
                                                            include("../db.php");
                                        $Company_name = "select sp.CompanyName as sp_name  from supplier as sp where sp.SupID ='".$row['SupID']."' ";

                                        $spCompany_name = mysqli_query($conn,$Company_name);

                                        while ($row2 = mysqli_fetch_assoc($spCompany_name)) {
                                           ?>
                                            <td><?php echo $row2['sp_name']; ?></td>
                                           <?php
                                        }
                                       ?>

                                                             <td style="text-align: center">
                                                                <a href="OrderoutDetail.php?id=<?php echo $row['OrderID']; ?>" class="btn btn-warning">ນໍາເຂົ້າ</a>
                                                                </td>
                                                        </tr>
                                                           
                                               <?php
                                                    }
                                                    
                                                }
                                                
                                               ?>  
                                                
                                            </table>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>