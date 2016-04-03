<?php
/*
 * Created on 2016-2-25
 * by lvshubao
 *
 */
?>
<?php
session_start();
include("connect.php");
?>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/buttonstyle.css" />
    <title>NEFU JudgeOnline</title>
</head>
<body>
<?php
if(empty($_SESSION["login"])||$_SESSION["login"]!=1)
{
    echo "<script type='text/javascript'>alert('请您先登录！');location.href='index.php';</script>";
    return;
}
if(empty($_SESSION["privilege"])||($_SESSION["privilege"]!=6))
{
    echo "<script type='text/javascript'>alert('您不具备该权限！');location.href='index.php';</script>";
    return;
}
if(empty($_GET["order"]))
{
    $order=1;
}
else
{
    $order=$_GET["order"];
}
if($order!=1) {
    if($order!=2){
        echo "<script>location.href='admin.php';</script>";
        return;
    }
}
if($order==1)///添加比赛主界面
{
    include("head.php");?>
    <table id='tablemain' style='height:450px;'>
        <tr id='trmain' style=''>
            <td colspan='' id='tdmain' style=''>
                创建一个新的比赛报名
            </td>
        </tr>
        <tr>
            <td>
                <form action='admincontestregister.php?order=2' method='post' name="form_addContest">
                    <table border=0 style='width:100%;'>
                        <tr>
                            <td style='width:35%;text-align:right;'>比赛名称 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                            <td style='width:10%;'></td>
                            <td ><input type=text name='title'size="26"></td>
                        </tr>
                        <tr>
                            <td style='text-align:right;'>报名开始时间:</td>
                            <td></td>
                            <td><select name='start_year'>
                                    <?php
                                    $dateY=date('Y');
                                    for($i=0;$i<=4;$i++)
                                    {
                                        echo "<option value='".($dateY+$i)."'>".($dateY+$i)."</option>";
                                    }
                                    ?>
                                </select>-<select name='start_month'>
                                    <?php
                                    $dateM=date('m');
                                    for($i=0;$i<=11;$i++)
                                    {
                                        $j = sprintf('%02d',01+$i);
                                        if($i==$dateM-1)
                                        {
                                            echo "<option value='".$j."' selected>".$j."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$j."'>".$j."</option>";
                                        }

                                    }
                                    ?>
                                </select>-<select name='start_day'>
                                    <?php
                                    $dateD=date('d');
                                    for($i=0;$i<=30;$i++)
                                    {
                                        $j = sprintf('%02d',01+$i);
                                        if($i==$dateD-1)
                                        {
                                            echo "<option value='".$j."' selected>".$j."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$j."'>".$j."</option>";
                                        }

                                    }
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td style='text-align:right;'>报名截止时间:</td>
                            <td></td>
                            <td><select name='end_year'>
                                    <?php
                                    $dateY=date('Y');
                                    for($i=0;$i<=4;$i++)
                                    {
                                        echo "<option value='".($dateY+$i)."'>".($dateY+$i)."</option>";
                                    }
                                    ?>
                                </select>-<select name='end_month'>
                                    <?php
                                    $dateM=date('m');
                                    for($i=0;$i<=11;$i++)
                                    {
                                        $j = sprintf('%02d',01+$i);
                                        if($i==$dateM-1)
                                        {
                                            echo "<option value='".$j."' selected>".$j."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$j."'>".$j."</option>";
                                        }
                                    }
                                    ?>
                                </select>-<select name='end_day'>
                                    <?php
                                    $dateD=date('d');
                                    for($i=0;$i<=30;$i++)
                                    {
                                        $j = sprintf('%02d',01+$i);
                                        if($i==$dateD-1)
                                        {
                                            echo "<option value='".$j."' selected>".$j."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$j."'>".$j."</option>";
                                        }

                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='3'><center>
                                    <input type='hidden' name='start_time'><input type='hidden' name='end_time'>
                                    <input class='button' type='submit' value='submit'><input class='button' type='reset' value='reset'>
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
    <?php
}
else if($order==2)///添加比赛报名后台界面
{
    if(!empty($_POST["title"]))
    {
        $title=$_POST["title"];
    }
    else
    {
        echo "<script>location.href=adminContestAdd.php;</script>";
        return;
    }
    $start_year=$_POST["start_year"];
    $start_month=$_POST["start_month"];
    $start_day=$_POST["start_day"];
    $start_time=$start_year."-".$start_month."-".$start_day;
    $end_year=$_POST["end_year"];
    $end_month=$_POST["end_month"];
    $end_day=$_POST["end_day"];
    $end_time=$end_year."-".$end_month."-".$end_day;
    $title2=addslashes($title);
    $title1=trim($title2);
    $query="insert into contest_register_list(title,start_time,end_time) values('".$title1."','".$start_time."','".$end_time."')";
    $result = mysql_query($query)
    or die("Invalid query: " . mysql_error());
    echo "<script type='text/javascript'>alert('添加比赛报名成功!');</script><meta http-equiv='refresh' content='0;url=admin.php'>";
    return;
}
include("end.php");
?>
</body>
</html>
