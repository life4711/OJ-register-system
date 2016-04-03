<?php
/*
 * Create on 2016-2-24
 * by lvshubao
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
        <SCRIPT src="js/Clock.js" type=text/javascript></SCRIPT>
    </head>
<body>
<?php
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
    if($order!=3) {
        if ($order != 4) {
            if ($order != 5) {
                if ($order != 6) {
                    echo "<script>location.href='index.php';</script>";
                    return;
                }
            }
        }
    }
}
}
?>

<?php
if($order==1)///报名主界面
{
    include("head.php");
    ?>
    <table style='background-image:url(images/table_bg.jpg); width:100%; border-radius:10px;'>
        <tr style='height:30px;'>
            <td align='top' style='background-color:#6589d1;color:#FFFFFF;font-style:inherit;font-weight:bold;font-size: 25px;border-top-left-radius:10px;border-top-right-radius:10px;'>
                <center>
                    比赛报名首页(注：报名信息一旦提交无法修改，若有错误请重新提交！)
                    <br>
                </center>
            </td>
        </tr>
        <tr>
            <td>
                <table cellSpacing=0 cellPadding=0 width=100% border=1 bordercolor=#FFFFFF style='text-align:center;'>
                    <tr style='background-color:#6589d1;font-style:inherit;height:35px;color:#FFFFFF;'>
                        <td width=10%>比赛编号</td>
                        <td width=30%>比赛名称</td>
                        <td width=20%>报名开始时间</td>
                        <td width=20%>报名结束时间</td>
                        <td width=7%>开始报名</td>
                        <td width=7%>报名信息</td>
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
                    $now=date("Y-m-d");
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
                        echo "
									<td>".$row["start_time"]."</td>
									<td>".$row["end_time"]."</td>";
                        $query1="select * from contest_register_list where id=".$row["id"].""
                        or die("Invalid query: " . mysql_error());
                        $result1 = mysql_query($query1);
                        $row1=mysql_fetch_array($result1);
                        $start=$row1["start_time"];
                        $end=$row1["end_time"];
                        if($start<=$now&&$end>=$now) {
                            echo "<td><A href='contest_register.php?order=3&contest_id=".$row["id"]."'>进入</A></td>";
                        }else
                        {
                            if($start<$now)
                                echo "<td>已结束</td>";
                            else
                                echo "<td>未开始</td>";
                            //echo $query1;
                        }
                        echo "<td><A href='contest_register.php?order=4&contest_id=".$row["id"]."'>查看</A></td>";
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
else if($order==2)///报名信息处理界面
{
    if(empty($_GET["contest_id"])){
        echo "<script>alert(\"比赛id不能为空\")</script><meta http-equiv='refresh' content='0;url=contest_register.php'>";
        return;
    }
    else {
        $id=$_GET["contest_id"];
    }
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    if(empty($_POST["num"]))
    {
        echo "<script type='text/javascript'>alert('请输入学号！');history.go(-1);</script>";
        return;
    }
    else
    {
        $user_id = $_POST["num"];
    }
    if(empty($_POST["name"]))
    {
        echo "<script type='text/javascript'>alert('请输入姓名！');history.go(-1);</script>";
        return;
    }
    else
    {
        $name = $_POST["name"];
    }
    if(empty($_POST["sex"]))
    {
        echo "<script type='text/javascript'>alert('请输入性别！');history.go(-1);</script>";
        return;
    }
    else
    {
        $sex = $_POST["sex"];
    }
    if(empty($_POST["major"]))
    {
        echo "<script type='text/javascript'>alert('请输入专业！');history.go(-1);</script>";
        return;
    }
    else
    {
        $major = $_POST["major"];
    }
    if(empty($_POST["school"]))
    {
        echo "<script type='text/javascript'>alert('请输入学校！');history.go(-1);</script>";
        return;
    }
    else
    {
        $school = $_POST["school"];
    }
    if(empty($_POST["email"]))
    {
        echo "<script type='text/javascript'>alert('请输入邮箱！');history.go(-1);</script>";
        return;
    }
    else
    {
        $email = $_POST["email"];
    }
    //验证邮箱格式
    $pattern="/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
    if(!preg_match($pattern,$email)){
        echo "<script type='text/javascript'>alert('邮箱格式不正确！');history.go(-1);</script>";
        return;
    }
    ///验证结束
    if(empty($_POST["checknum"]))
    {
        echo "<script type='text/javascript'>alert('请输入验证码！');history.go(-1);</script>";
        return;
    }
    else
    {
        $checknum = $_POST["checknum"];
    }
    if(strlen($user_id)<1||strlen($user_id)>15)
    {
        echo "<script type='text/javascript'>alert('学号应大于1位且小于15位！');history.go(-1);</script>";
        return;
    }

    if(strcasecmp($checknum,$_SESSION["code"]))
    {
        echo "<script type='text/javascript'>alert('验证码不正确！');history.go(-1);</script>";
        return;
    }
    $query = "select * from contest_register_user where id= ".$user_id." and contest_id=".$id." ";
    //echo $query;
    $result = mysql_query($query)
    or die("Invalid query: " . mysql_error());
    if($row = mysql_fetch_array($result))
    {
        echo "<script type='text/javascript'>alert('本次比赛报名表中该学号已存在！');history.go(-1);</script>";
        return;
    }
    $nick1=addslashes($name);
    if(strlen($nick1)>30)
    {
        echo "<script type='text/javascript'>alert('姓名长度应小于30！ ');history.go(-1);</script>";
        return;
    }
    $name=trim($nick1);
    if(strstr($name,"<") || strstr($name,">") ||strstr($name,";") )
    {
        echo "<script type='text/javascript'>alert('姓名不可使用标签符号和分号！ ');history.go(-1);</script>";
        return;
    }
    $school1=addslashes($school);
    $query = "insert into contest_register_user (id,email,name,sex,school,major,contest_id,status) values (".$user_id.",'".$email."','".$name."','".$sex."','".$school1."','".$major."',".$id.",0)";
    $result = mysql_query($query)
    or die("Invalid query: " . mysql_error());
    echo "<script type='text/javascript'>alert('报名成功!');</script><meta http-equiv='refresh' content='0;url=contest_register.php'>";
    return;
}
else if($order==3)///报名信息填写界面
{
    ?>
    <script type="text/javascript">
        function showHint(str)
        {
            var xmlhttp;
            if (window.XMLHttpRequest)
            {
                xmlhttp = new XMLHttpRequest();
            }
            else
            {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function ()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    document.getElementById("text").innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET","registerimage.php?order=2&a="+ new Date().getTime(), true);
            xmlhttp.send();
        }
    </script>
    <?php
    include("head.php");
    if(empty($_GET["contest_id"])){
        echo "<script>alert(\"比赛id不能为空\")</script><meta http-equiv='refresh' content='0;url=contest_register.php'>";
        return;
    }
    else {
        $id=$_GET["contest_id"];
    }
    $query="select * from contest_register_list where id=".$id."";

    $result = mysql_query($query)
    or die("Invalid query: " . mysql_error());
    $row = mysql_fetch_array($result);
    $now=date("Y-m-d");
    if($row["start_time"]>$now)
    {
        echo "<script type='text/javascript'>alert('报名未开始!');</script><meta http-equiv='refresh' content='0;url=contest_register.php'>";
        return;
    }
    if($row["end_time"]<$now)
    {
        echo "<script type='text/javascript'>alert('报名已结束!');</script><meta http-equiv='refresh' content='0;url=contest_register.php'>";
        return;
    }
    ?>
    <table  style='background-image:url(images/table_bg.jpg); width:100%; border-radius:10px;'>
        <tr style='height:30px;'>
            <td align='top' style='background-color:#6589d1;color:#FFFFFF;font-style:inherit;font-weight:bold;font-size: 25px;border-top-left-radius:10px;border-top-right-radius:10px;'>
                <center>
                    <?php
                    $query="select title from contest_register_list where id=".$id."";
                    $result = mysql_query($query)
                    or die("Invalid query: " . mysql_error());
                    $row = mysql_fetch_array($result);
                    echo $row[0]."比赛报名";
                    ?>
                </center>
            </td>
        </tr>
        <tr>
            <td align='top'>
                <center>
                    <form action='contest_register.php?order=2&contest_id=<?php echo $id?>' method='post'  >
                        <table style='width:70%;border-spacing:2px 2px;'>
                            <tr style='height:25px;'>
                                <td style='width:25%;'></td>
                                <td style='width:20%;'></td>
                                <td style='width:55%;'></td>
                            </tr>
                            <tr style='height:55px;'>
                                <td rowspan='6' ></td>
                                <td >&nbsp;&nbsp;&nbsp;&nbsp;姓名:</td>
                                <td ><input type='text' name='name' size='25' /></td>
                            </tr>
                            <tr style='height:55px;'>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;学号:</td>
                                <td ><input type='text' name='num' size='25' /></td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;性别:</td>
                                <td><input type=radio  name='sex' value='2' />女&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio  name='sex' value='1' />男<td>
                            </tr>
                            <tr style='height:55px;'>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;专业 :</td>
                                <td><input type='text' name='major' size='25' /></td>
                            </tr>
                            <tr style='height:55px;'>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;学校 :</td>
                                <td><input type='text' name='school' size='25' /></td>
                            </tr>
                            <tr style='height:55px;'>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;邮箱:</td>
                                <td ><input type='text' name='email' size='25' /></td>
                            </tr>
                            <tr style='height:90px;'>
                                <td style='width:25%'></td>
                                <td><span id='text'><img id='pic' border=0 src='registerimage.php' alt='30'></span></td>
                                <td><input type='text' name='checknum' />
                                    <input class='button' type='button' name='button' value='Change' onclick='showHint()' />
                                </td>
                            </tr>
                            <tr style='height:25px;'>
                                <td colspan='3' >
                                    <center>
                                        <input class='button' type='submit' value='submit'  />
                                        <input class='button' type='reset' value=reset />
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </form>
                </center>
            </td>
        </tr>
    </table>
    <?php
}
else if($order==4)///报名名单查看界面
{
    include("head.php");
    if(empty($_GET["contest_id"])){
        echo "<script>alert(\"比赛id不能为空\")</script><meta http-equiv='refresh' content='0;url=contest_register.php'>";
        return;
    }
    else {
        $id=$_GET["contest_id"];
    }
    if(empty($_SESSION["privilege"]))
    {
        $pri=0;
    }
    else
    {
        $pri=$_SESSION["privilege"];
    }
    ?>
    <table style='background-image:url(images/table_bg.jpg); width:100%; border-radius:10px;'>
        <tr style='height:30px;'>
            <td align='top' style='background-color:#6589d1;color:#FFFFFF;font-style:inherit;font-weight:bold;font-size: 25px;border-top-left-radius:10px;border-top-right-radius:10px;'>
                <center>
                    <?php
                    $query="select title from contest_register_list where id=".$id."";
                    $result = mysql_query($query)
                    or die("Invalid query: " . mysql_error());
                    $row = mysql_fetch_array($result);
                    echo $row[0]."报名信息表";
                    ?>
                    <br>
                </center>
            </td>
        </tr>
        <tr>
            <td>
                <table cellSpacing=0 cellPadding=0 width=100% border=1 bordercolor=#FFFFFF style='text-align:center;'>
                    <tr style='background-color:#6589d1;font-style:inherit;height:35px;color:#FFFFFF;'>
                        <td width=15%>学号</td>
                        <td width=15%>姓名</td>
                        <td width=10%>性别</td>
                        <td width=15%>专业</td>
                        <td width=15%>学校</td>
                        <?php
                        if($pri=="6") {
                            ?>
                            <td width=15%>邮箱</td>
                            <td width=8%>删除</td>
                            <td width=7%>状态</td>
                            <?php
                        }
                        else
                        {
                            ?>
                            <td width=20%>邮箱</td>
                            <td width=10%>状态</td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                    $query = "select count(*) from contest_register_user";
                    $result = mysql_query($query)
                    or die("Invalid query: " . mysql_error());
                    $row = mysql_fetch_array($result);
                    $num_contest=$row["count(*)"];
                    $pagesize=50;
                    $startrow=0;
                    if(empty($_GET["pageno"])){
                        $pageno=1;
                    }
                    else {
                        $pageno=$_GET["pageno"];
                        $startrow=($pageno-1)*$pagesize;
                    }
                    $query="select * from contest_register_user where contest_id=".$id." order by contest_id DESC limit ".$startrow.",".$pagesize."";
                    $result = mysql_query($query)
                    or die("Invalid query: " . mysql_error());
                    $maxpage= ceil($num_contest/$pagesize);
                    $now=date("Y-m-d H:i:s");
                    $colorCount=0;
                    while($row = mysql_fetch_array($result))
                    {
                        if($row["2"]=="1")
                            $sex='男';
                        else
                            $sex='女';
                        echo " <tr>  	<td>".$row["0"]."</td>
									    <td>".$row["1"]."</td>
									    <td>".$sex."</td>
									    <td>".$row["3"]."</td>
									    <td>".$row["4"]."</td>
									    <td>".$row["5"]."</td>";
                        if($pri==6)
                        {?>
                            <td>
                                <form action='contest_register.php?order=6&num=<?php echo $row["num"]?>' method='post'>
                                    <input class='button' type='submit' value='删除'/>
                                </form>
                            </td>
                            <?php
                            if($row[6]==0) {
                                ?>
                                <td>
                                    <form action='contest_register.php?order=5&num=<?php echo $row["num"]?>&status=2' method='post'>
                                        <input class='button' type='submit' name='button' value='待核验'/>
                                    </form>
                                </td>
                                <?php
                            }
                            else
                            {
                                ?>
                                <td>
                                    <form action='contest_register.php?order=5&num=<?php echo $row["num"]?>&status=1' method='post'>
                                        <input class='button' type='submit' name='button' value='已通过'/>
                                    </form>
                                </td>
                                <?php
                            }
                        }
                        else
                        {
                            if($row[6]==0)
                                echo "<td><font color=red>待核验</font></td>";
                            else
                                echo "<td><font color=green>已通过</font></td>";
                        }
                        echo "</tr>";
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
                echo "[<a href='contest_register.php?order=4&contest_id=".$id."&pageno=".$pagelast."'>Last</a>][<a href='contest_register.php?order=4&contest_id=".$id."&pageno=".$pagenext."'>Next</a>]";
                ?>
            </td>
        </tr>
    </table>
    <?php
}
else if($order==5)///核验信息
{
    if(empty($_SESSION["login"])||$_SESSION["login"]!=1)
    {
        echo "<script>alert('请您先登录！');location.href='index.php';</script>";
        return;
    }
    if(empty($_SESSION["privilege"])||($_SESSION["privilege"]!=6))
    {
        echo "<script>alert('您不具备该权限！');location.href='index.php';</script>";
        return;
    }
    if(empty($_GET["num"])){
        echo "<script>alert(\"序号不能为空\")</script><meta http-equiv='refresh' content='0;url=contest_register.php'>";
        return;
    }
    else {
        $num=$_GET["num"];
    }
    if(empty($_GET["status"])){
        echo "<script>alert(\"状态码不能为空\")</script><meta http-equiv='refresh' content='0;url=contest_register.php'>";
        return;
    }
    else {
        $status=$_GET["status"];
    }
    if($status==2)
        $query="update contest_register_user set status=1 where num=".$num."";
    else
        $query="update contest_register_user set status=0 where num=".$num."";
    $result = mysql_query($query)
    or die("Invalid query: " . mysql_error());
    echo "<script>history.go(-1);</script>";
}
else if($order==6)///删除报名记录
{
    if(empty($_SESSION["login"])||$_SESSION["login"]!=1)
    {
        echo "<script>alert('请您先登录！');location.href='index.php';</script>";
        return;
    }
    if(empty($_SESSION["privilege"])||($_SESSION["privilege"]!=6))
    {
        echo "<script>alert('您不具备该权限！');location.href='index.php';</script>";
        return;
    }
    if(empty($_GET["num"])){
        echo "<script>alert(\"序号不能为空\")</script><meta http-equiv='refresh' content='0;url=contest_register.php'>";
        return;
    }
    else {
        $num=$_GET["num"];
    }
    $query="delete from contest_register_user  where num=".$num."";
    $result = mysql_query($query)
    or die("Invalid query: " . mysql_error());
    echo "<script>history.go(-1);</script>";
}
include("end.php");
?>
</body>
    </html>
