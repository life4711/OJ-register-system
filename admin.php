<?php
/*
 * Created on 2014-11-06
 * by Yellow
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
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
	echo "<script>alert('请您先登录！');location.href='index.php';</script>";
	return;
}
if(empty($_SESSION["privilege"])||($_SESSION["privilege"]!=6&&$_SESSION["privilege"]!=4))
{
	echo "<script>alert('您不具备该权限！');location.href='index.php';</script>";
	return;
}
include("head.php");
?>

	<table id='tablemain' style='height:450px;'>
		<tr id='trmain' style=''>
			<td colspan='3' id='tdmain' style=''>
					Welcome to Administration
			</td>
		</tr>
		<tr style='height:45px;'>
			<td colspan='3'>
			</td>
		</tr>
		<tr>
			<td style='vertical-align:top;width:33%;'>
				<center>
				<table id='tablemain' style='width:80%;text-align:center;height:100%;' cellSpacing='0' cellPadding='0'>
					<tr id='trmain' style=''>
						<td id='tdmain' style=''>题目编辑</td>
					</tr>		
					<tr style='height:75px;'>
						<td style='background-color:#f1f1fd;'><A href='adminProblemAdd.php'>添加新题目</A></td>
					</tr>	
					<tr style='height:75px;'>
						<td style='background-color:#f1f1fd;border-bottom-left-radius:10px;border-bottom-right-radius:10px;'>
								<A href='adminProblemMod.php'>上传图片数据及修改题目</A></td>
					</tr>
				</table>
				</center>
			</td>
			<td style='vertical-align:top;width:34%;'>
				<center>
				<table id='tablemain' style='width:80%;text-align:center;background-color:#f1f1fd;' cellSpacing='0' cellPadding='0'>
					<tr id='trmain' style=''>
						<td id='tdmain' style=''>比赛编辑</td>
					</tr>
					<tr style='height:37px;'>
						<td style='background-color:#f1f1fd;'><A href='adminContestAdd.php'>创建新比赛</A>&nbsp;&nbsp;&nbsp;<A href='adminExperiment.php'>录入实验名单</A></td>
					</tr>
					<tr style='height:38px;'>
						<td style='background-color:#f1f1fd;'><A href='adminContestMod.php'>修改比赛</A>&nbsp;&nbsp;&nbsp;<A href='adminContestDownload.php'>下载比赛名单和结果</A></td>
					</tr>
					<tr style='height:38px;'>
						<td style='background-color:#f1f1fd;border-bottom-left-radius:10px;border-bottom-right-radius:10px;'><A href='adminSourceCodeCmp.php'>代码查重</A>&nbsp;&nbsp;&nbsp;<A href='adminDownloadCmp.php'>下载代码查重结果</A></td>
					</tr>
					<tr style='height:38px;'>
						<td style='background-color:#f1f1fd;border-bottom-left-radius:10px;border-bottom-right-radius:10px;'><A href='admincontestregister.php'>添加比赛报名</A>&nbsp;&nbsp;&nbsp;<A href='admincontestregistermod.php'>管理比赛报名</A></td>
					</tr>
				</table>
				</center>
			</td>
			<td style='vertical-align:top;width:33%;'>
				<center>
				<table id='tablemain' style='width:80%;text-align:center;background-color:#f1f1fd;' cellSpacing='0' cellPadding='0'>
					<tr id='trmain' style=''>
						<td id='tdmain' style=''>新闻编辑</td>
					</tr>
					<tr style='height:75px;'>
						<td style='background-color:#f1f1fd;'><A href='adminNewsAdd.php'>添加新闻</A></td>
					</tr>
					<tr style='height:75px;'>
						<td style='background-color:#f1f1fd;border-bottom-left-radius:10px;border-bottom-right-radius:10px;'><A href='adminNewsMod.php'>修改新闻</A></td>
					</tr>
				</table>
				</center>
			</td>
		</tr>
		<?php 
			if($_SESSION["privilege"]==6)
			{
				$query="select count(*) from users where privilege=3";
				$result=mysql_query($query)
				or die("Invalid query: " . mysql_error());
				$row=mysql_fetch_array($result);
				$pri3_num=$row["count(*)"];
				$query="select count(*) from users where user_id like '%team%'";
				$result=mysql_query($query)
				or die("Invalid query: " . mysql_error());
				$row=mysql_fetch_array($result);
				$team_num=$row["count(*)"];
				echo 
		"<tr style='height:45px;'>
			<td colspan='3'>
			</td>
		</tr>
		<tr>
			<td style='vertical-align:top;'>
				<center>
				<table id='tablemain' style='width:80%;text-align:center;background-color:#f1f1fd;' cellSpacing='0' cellPadding='0'>
					<tr id='trmain' style=''>
						<td id='tdmain' style=''>通知编辑</td>
					</tr>
					<tr style='height:75px;'>
						<td style='background-color:#f1f1fd;'><A href='adminNoticeAdd.php'>添加通知</A></td>
					</tr>
					<tr style='height:75px;'>
						<td style='background-color:#f1f1fd;border-bottom-left-radius:10px;border-bottom-right-radius:10px;'><A href='adminNoticeAdd.php?order=3'>不显示通知</A></td>
					</tr>
				</table>
				</center>
			</td>
			<td style='vertical-align:top;'>
				<center>
				<table id='tablemain' style='width:80%;text-align:center;height:100%;' cellSpacing='0' cellPadding='0'>
					<tr id='trmain' style=''>
						<td id='tdmain' style=''>金榜题名</td>
					</tr>		
					<tr style='height:75px;'>
						<td style='background-color:#f1f1fd;'><A href='adminJinbangAdd.php'>添加名单</A></td>
					</tr>		
					<tr style='height:75px;'>
						<td style='background-color:#f1f1fd;border-bottom-left-radius:10px;border-bottom-right-radius:10px;'><A href='adminJinbangMod.php'>修改名单及上传照片</A></td>
					</tr>
				</table>
				</center>
			</td>
			<td style='vertical-align:top;'>
				<center>
				<table id='tablemain' style='width:80%;text-align:center;height:100%;' cellSpacing='0' cellPadding='0'>
					<tr id='trmain' style=''>
						<td id='tdmain' style=''>用户权限</td>
					</tr>		
					<tr style='height:50px;'>
						<td style='background-color:#f1f1fd;'><A href='adminPrivilegeMod.php'>修改用户权限</A></td>
					</tr>			
					<tr style='height:50px;'>
						<td style='background-color:#f1f1fd;'><A href='adminPrivilegeCon.php'>认证用户权限（ ".$pri3_num." ） </A></td>
					</tr>	
					<tr style='height:50px;'>
						<td style='background-color:#f1f1fd;border-bottom-left-radius:10px;border-bottom-right-radius:10px;'><A href='javascript:if(confirm(\"确实要删除该内容吗?\"))location=\"adminContestMod.php?order=5\"'>删除Team用户（ ".$team_num." ） </A></td>
					</tr>
				</table>
				</center>
			</td>
		</tr>";
			}
		?>
		
		<tr style='height:45px;'>
			<td colspan='3'>
			</td>
		</tr>
	</table>




	</div><!--page end-->
<?php 
include("end.php");
?>
</body>
</html>