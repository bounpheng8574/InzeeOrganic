<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ຂໍ້ມູນຍອດຂາຍ</title>
    <link rel="shortcut icon" href="../../photo/logo2.png" type="image/x-icon">
        <link rel="stylesheet" href="../../node_modules/custom.css">
            <style type="text/css">
            body,td,th{font-family: Phetsarath OT;}
        </style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            @page{
                margin:0;
            }
        </style>
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
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fa fa-filter'></span>&nbsp;ເລືອກລາຍງານ 
              </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="printpro.php">ລາຍງານສິນຄ້າທີ່ມີໃນຮ້ານ</a>
            <a class="dropdown-item" href="Importproduct.php">ລາຍງານສິນຄ້ານໍາເຂົ້າ   </a>
            <a class="dropdown-item" href="printcust.php">ລາຍງານຂໍ້ມູນລູກຄ້າ</a>
            <a class="dropdown-item" href="print2.php">ລາຍງານການຂາຍສິນຄ້າ</a>
           <!--  <a class="dropdown-item" href="#">ລາຍງານລາຍຮັບ</a>
            <a class="dropdown-item" href="#">ລາຍງານລາຍຈ່າຍ</a>         -->           
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
                </ul>
      </div>
    </div>
</nav> <!-- End nav -->
<br/>
<div class="text-center"><h3>ລາຍງານການຂາຍສິນຄ້າ</h3></div>

    <div class="row" style="margin-top: 2%; margin-left: 2%; margin-right: 2%">
        <div class="col-sm-12 my-4" style="box-shadow: 1px 1px 1px 1px #1c7430; height: auto; background-color: white" id="leftSide">
            <div style="text-align: center; margin-top: 1%"><h5>ລາຍງານຊ່ວງໃດໜື່ງເຖີງປະຈຸບັນ</h5></div>
            <div class="row" style="margin-top: 2%">

                <div class="col-sm-4 my-4">

                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <br>
                    <input type="date" name="date1" id="date1" class="form-control">
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <br>
                    <a class="btn btn-warning" id="btn1">ລາຍງານ</a>
                </div>
            </div>
            <div style="margin-top: 2%">

                <div id="Notification" style="margin-left: 3%; margin-top: 2%; color: #990000"></div>
                <div style="margin-top: 2%; display: none;" id="showcontent">
                    
                    <br>
                    <br>
                    <div class="table-responsive " id="tableResponsive">
                        <table class="table table-hover">
                            <tr>
                                <th style="">ລະຫັດສິນຄ້າ</th>
                                <th style="">ຊື່ສິນຄ້າ</th>
                                <th style="">ຈໍານວນ</th>
                                <th style="">ລາຄາ/ຫົວໜ່ວຍ</th>
                                <th style="">ລາຄາລວມ</th>
                                <th style="">ວັນທີນຳເຂົ້າ</th>
                            </tr>
                            <tbody id="detail">
                               
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-top: 2%; margin-right: 5%; text-align: right">
                        <button class="btn btn-success" id="windowprint" onclick="printPage1()">ລາຍງານ</button>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1" style=" height:10px ">

        </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
<script  type="text/javascript">

    $('#btn1').click(function () {

        if($('#date1').val() !=""){
            var date1 = $('#date1').val();
            $.ajax({
                type:'POST',
                 url:'getsales.php',
                 data : 'date1='+ date1,
                  dataType : 'html',
                success: function(data){ // What to do if we succeed
                    console.log(data);
                    document.getElementById('showcontent').style.display="block";
                    $('#detail').html(data);
                    }
                   
                });

            }else {
                       $("#show2").html("ກະລູນາເລືອກວັນທີ່ ເດືອນ ປີ");
                  }
    });


    function printPage1() {
        document.getElementById('windowprint').style.display='none';
        document.getElementById('btn1').style.display='none';
        document.getElementById('tableResponsive').classList.remove("table-responsive");
        // document.getElementById('rightSide').style.display='none';
        window.print();
        document.getElementById('btn1').style.display='block';
        document.getElementById('windowprint').style.display='block';
        document.getElementById('tableResponsive').classList.add("table-responsive");
        // document.getElementById('rightSide').style.display='block';
    }
    // function printPage2() {
    //     document.getElementById('windowprint2').style.display='none';
    //     document.getElementById('btn2').style.display='none';
    //     document.getElementById('tableResponsive').classList.remove("table-responsive");
    //     document.getElementById('leftSide').style.display='none';
    //     window.print();
    //     document.getElementById('btn1').style.display='block';
    //     document.getElementById('windowprint2').style.display='block';
    //     document.getElementById('tableResponsive').classList.add("table-responsive");
    //     document.getElementById('leftSide').style.display='block';
    // }


</script>



</html>