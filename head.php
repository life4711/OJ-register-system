<?php
/*
 * Created on 2014-10-29
 * by Yellow
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 * OJ网站的logo和导航栏部分，不能单独运行，需嵌入到各网页中
 */
?>
<script language='JavaScript'> 
     function color(obj,the)
	    {
			if(the==1)
			    obj.style.backgroundColor='#D3EBFD';
			else 
			    obj.style.backgroundColor='#f1f1fd'
	    }
</script>   
	<div id="page">
		<!-- logo -->
		<div id="top">
			<table border='0' style='width:100%; height:100%;border-radius:10px;'>
	            <tr>
	               <td style='width:78%;border-radius:10px;background: url(images/top_01.jpg) no-repeat'></td>
	               <td style='width:5%; border=0'></td>
	               <td style='width:17%;'><img height='120px' width='120px' src='images/log_0.jpg'/></td>
	               
	               <!-- ljy
				   <td style='height:80px; width:10%;'><A href='showbang.php' target=_blank><img src='images/jinbang.jpg' style=' border=0' border='0'/></A></td>
				   -->
	            </tr>
	        </table>
		</div>
		<!--logo end-->
		<div class="cl">&nbsp;</div>
		<!--navigation-->
		<div id="navigation">
			<table style='width:100%;'>
				<tr>
	         		<th style='width:20%;'>Login</th>
	         		<th style='width:20%;'>Judge Home</th>
	         		<th style='width:20%;'>Problem Set</th>
	         		<th style='width:20%;'>Users</th>
	         		<th style='width:20%;'>Contests</th>
	         	</tr>
	         	<tr>
	            	            
					<?php
 						if(empty($_SESSION["login"])||$_SESSION["login"]=="0")
    					{
    						echo "<td  onmouseover='color(this,1)' onmouseout='color(this,0)'>
	    							<center>
	                 					<form  method='POST' action='login.php'>
	                   						<table style='text-align:center;'>
	                        					<tr style='height:30px;'>
	                            					<td style='width:40%;'>User ID :</td>
	                            					<td style='width:60%;'><input type='text' name='user_id' size='15'></td>
	                       						</tr>
	                      	 					<tr style='height:30px;'>
	                            					<td>Password:</td>
	                            					<td><input type='password' name='password' size='15'></td>
	                       						</tr>
	                       						<tr style='height:30px;'>
	                            					<td colspan='2'><input class='button' type=Submit value=login name=B1>&nbsp;&nbsp;<a href=register.php target=_parent>Register</a></td>
	                       						</tr>
	                   						</table>
	                   						
	                					</form>
	                				  </center>
	                				 </td>
					             	 <td  onmouseover='color(this,1)' onmouseout='color(this,0)'>
						                <center>
						                <A href='index.php'>Home Page</A><BR>
						                <A href='discuss.php'>Web Board</A><BR>
						                <A href='kj.php' target=_blank>Tools Download</A>
						                </center>
						             </td>
									 <td onmouseover='color(this,1)' onmouseout='color(this,0)'>
						                <center>
						                <A href='problem.php'>Problems</A><BR>
						
						                <A href='status.php'>Status</A><BR>
						                </center>
						             </td>";
                		}
						if(!empty($_SESSION["login"])&&$_SESSION["login"]=="1")
    					{
       						$user_id1=$_SESSION["user_id"];
       						$query_remind="select count(*) from remind where user_id_receive='".$user_id1."' and flag=1";
             				$result_remind=mysql_query($query_remind)
             				or die("Invalid query: " . mysql_error());
             				$row_remind=mysql_fetch_array($result_remind);
					$query_Exp="select isExp from users where user_id='".$user_id1."'";
             				$result_Exp=mysql_query($query_Exp)
             				or die("Invalid query: " . mysql_error());
             				$row_Exp=mysql_fetch_array($result_Exp);
             				if((preg_match('/^team[0-9]*/',$_SESSION["user_id"]))||$row_Exp["isExp"]>0)
							{
								echo "<td  onmouseover='color(this,1)' onmouseout='color(this,0)'>
		       							<center>
											".$user_id1."<br>
											Update Your Info<br>
											<a href='login.php?order=2'>Login out</a>
				        				</center>
		                			  </td>
						              <td  onmouseover='color(this,1)' onmouseout='color(this,0)'>
							                <center>
							                <A href='index.php'>Home Page</A><BR>
							                Web Board<BR>
							                <A href='kj.php' target=_blank>Tools Download</A>
							                </center>
							           </td>
									   <td onmouseover='color(this,1)' onmouseout='color(this,0)'>
							                <center>
							                Problems<BR>
											Status<BR>
							                </center>
						               </td>";
							}
							else 
							{
								echo "<td  onmouseover='color(this,1)' onmouseout='color(this,0)'>
		       							<center>
											<a href=showuser.php>".$user_id1."</a><br>
											<a href='UpdateInfo.php'>Update Your Info</a><br>
											<a href='login.php?order=2'>Login Out</a>
				        				</center>
		                			  </td>
						              <td  onmouseover='color(this,1)' onmouseout='color(this,0)'>
							                <center>
							                <A href='index.php'>Home Page</A><BR>
							                <A href='discuss.php'>Web Board</A>&nbsp;<a href='remind.php'>(".$row_remind["count(*)"].")</a><BR>
							                <A href='kj.php' target=_blank>Tools Download</A>
							                </center>
							           </td>
									   <td onmouseover='color(this,1)' onmouseout='color(this,0)'>
						                    <center>
						                    <A href='problem.php'>Problems</A><BR>
						
						                    <A href='status.php'>Status</A><BR>
						                    </center>
						               </td>";
							}
       						   	
	    				}
	    				
					?>            
					<td onmouseover='color(this,1)' onmouseout='color(this,0)'><center>
							<a href=userlist.php>All Users Ranklist</a><br>
							<A href='showbang.php' target=_blank>金榜题名</A><br>
						</center>
					</td>
		            <td onmouseover='color(this,1)' onmouseout='color(this,0)'>
		                 <div align='center'>
		                    <a href='contest.php'><font color=red>Contests</font></a><br>
							 <a href='contest_register.php'><font color=red>比赛报名</font></a><br>
		                    <?php
		                    	if(!empty($_SESSION["login"])&&$_SESSION["login"]=="1"&&($_SESSION["privilege"]==6||$_SESSION["privilege"]==4))
		                    	{
		                    		echo " <A href='admin.php'><font color=red>Adminstations</font></A>";
		                    	}
		                    ?>
		                 </div>
		            </td>
	         	</tr>
			</table>
		</div>
		<!--navigation end-->
		
		<br>
		<MARQUEE SCROLLAMOUNT=3 BEHAVIOR=ALTERNATE SCROLLDELAY=150>
              <font color=red>
              <?php
              $query="select title from notice where notice_id=(select max(notice_id) from notice where notice_show=1)";
              $result = mysql_query($query)
              or die("Invalid query: " . mysql_error());
              $row=mysql_fetch_array($result);
              echo $row["title"];
              ?>
              </font>
        </MARQUEE>