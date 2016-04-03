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
    echo "<script>alert('请您先登录！');location.href='admin.php';</script>";
    return;
}
if(empty($_SESSION["privilege"])||($_SESSION["privilege"]!=6))
{
    echo "<script>alert('您不具备该权限！');location.href='admin.php';</script>";
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

if($order!=1)
{
    if($order!=2)
    {
        if($order!=3)
        {
            if($order!=4)
            {
                echo "<script>location.href='index.php';</script>";
                return;
            }
        }
    }
}
if($order==1)///管理比赛报名主界面
{
    include("head.php");
    ?>
    <table style='background-image:url(images/table_bg.jpg); width:100%; border-radius:10px;'>
        <tr style='height:30px;'>
            <td align='top' style='background-color:#6589d1;color:#FFFFFF;font-style:inherit;font-weight:bold;font-size: 25px;border-top-left-radius:10px;border-top-right-radius:10px;'>
                <center>
                    管理比赛报名<br>
                </center>
            </td>
        </tr>
        <tr>
            <td>
                <table cellSpacing=0 cellPadding=0 width=100% border=1 bordercolor=#FFFFFF style='text-align:center;'>
                    <tr style='background-color:#6589d1;font-style:inherit;height:35px;color:#FFFFFF;'>
                        <td width=10%>比赛编号</td>
                        <td width=20%>比赛名称</td>
                        <td width=20%>报名开始时间</td>
                        <td width=20%>报名结束时间</td>
                        <td width=10%>生成名单</td>
                        <td width=10%>下载名单</td>
                        <td width=10%>修改报名限制</td>
                    </tr>
                    <?php
                    $query = "select count(*) from contest_register_list";
                    $result = mysql_query($query)
                    or die("Invalid query: " . mysql_error());
                    $row = mysql_fetch_array($result);
                    $num_contest=$row["count(*)"];
                    $pagesize=10;
                    $startrow=0;
                    if(empty($_GET["pageno"])){
                        $pageno=1;
                    }
                    else {
                        $pageno=$_GET["pageno"];
                        $startrow=($pageno-1)*$pagesize;
                    }
                    $query="select * from contest_register_list order by id DESC limit ".$startrow.",".$pagesize."";
                    $result = mysql_query($query)
                    or die("Invalid query: " . mysql_error());
                    $maxpage= ceil($num_contest/$pagesize);
                    $colorCount=0;
                    while($row = mysql_fetch_array($result))
                    {
                        $start=$row["start_time"];
                        $end=$row["end_time"];
                        if($colorCount%2==0)
                        {
                            $color="";
                            $colorCount++;
                        }
                        else
                        {
                            $color="#FFFFFF";
                            $colorCount--;
                        }
                        echo "<tr style='height:35px;' bgcolor='".$color."'>
									    <td>".$row["id"]."</td>";
                        echo "<td>".$row["title"]."</td>";
                        echo "<td>".$row["start_time"]."</td>
							   <td>".$row["end_time"]."</td>";
                        echo "<td><A href='admincontestregistermod.php?order=4&contest_id=".$row["id"]."'>生成名单</A></td>";
                        $dir="./ContestRegister/比赛".$row["id"].".doc";
                        echo "<td><A href=".$dir.">下载名单</A></td>";
                        echo "<td><A href='admincontestregistermod.php?order=2&contest_id=".$row["id"]."'>修改</A></td>";
                    }
                    ?>
                </table>
            </td>
        </tr>
        <tr>
            <td style='text-align:center;height:30px;'>
                <?php
                $pagelast=$pageno-1;
                if($pagelast==0)
                {
                    $pagelast=1;
                }
                $pagenext=$pageno+1;
                if($pagenext>$maxpage)
                {
                    $pagenext=$maxpage;
                }
                echo "[<a href='contest_register.php?order=1&pageno=".$pagelast."'>Last</a>][<a href='contest_register.php?order=1&pageno=".$pagenext."'>Next</a>]";
                ?>
            </td>
        </tr>
    </table>
    <?php
}
else if($order==2)///修改比赛前端页面
{
    include("head.php");
    if(empty($_GET["contest_id"])){
        echo "<script type='text/javascript'>alert(\"比赛id不能为空\")</script><meta http-equiv='refresh' content='0;url=admincontestregistermod.php'>";
        return;
    }
    else {
        $id=$_GET["contest_id"];
    }
    ?>
    <table id='tablemain' style='height:450px;'>
        <tr id='trmain' style=''>
            <td colspan='' id='tdmain' style=''>
                修改比赛报名
            </td>
        </tr>
        <tr>
            <td>
                <form action='admincontestregistermod.php?order=3&contest_id=<?php echo $id?>' method='post' name="form_addContest">
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
else if($order==3)///更新比赛后台
{
    if(empty($_GET["contest_id"])){
        echo "<script type='text/javascript'>alert(\"比赛id不能为空\")</script><meta http-equiv='refresh' content='0;url=admincontestregistermod.php'>";
        return;
    }
    else {
        $id=$_GET["contest_id"];
    }
    if(!empty($_POST["title"]))
    {
        $title=$_POST["title"];
    }
    else
    {
        echo "<script>location.href=admincontestregistermod.php;</script>";
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
    $query="update contest_register_list set title='".$title1."',start_time='".$start_time."',end_time='".$end_time."'where id=".$id."";
    //echo $query;
    $result = mysql_query($query)
    or die("Invalid query: " . mysql_error());
    echo "<script type='text/javascript'>alert('更新比赛报名成功!');</script><meta http-equiv='refresh' content='0;url=admin.php'>";
    return;
}
else if($order==4)///生成比赛名单
{
    ?>
    <?php
    if(empty($_GET["contest_id"]))
    {
        echo "<script type='text/javascript'>alert('没有指明比赛id！');location.href='adimincontestregistermod.php';</script>";
        return;
    }
    else
    {
        $contest_id=$_GET["contest_id"];
    }
    $path="ContestRegister/";
    if(!file_exists($path))
    {  mkdir($path,0777,true);  chmod($path,0777);}
    $query = "select * from contest_register_user where contest_id=".$contest_id." and status=1";
    $result = mysql_query($query)
    or die("Invalid query: " . mysql_error());
    $file= "比赛".$contest_id.".doc";
    if(file_exists($path.$file))
    {
        $file_handle = fopen($path.$file,"w");
        fclose($file_handle);
    }
    while($row=mysql_fetch_array($result))
    {
        $file_handle = fopen($path.$file,"a");
        fprintf($file_handle,"%s %s\r\n",$row["id"],$row["name"]);
    }
    fclose($file_handle3);
    echo "<script type='text/javascript'>alert('生成名单成功!');</script><meta http-equiv='refresh' content='0;url=admincontestregistermod.php'>";
    return;
}
include("end.php");
?>
</body>
</html>
