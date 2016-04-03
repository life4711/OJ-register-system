# OJ-register-system
2016.2 nefuOJ register system v01</br>
为林大oj添加报名界面
NEFUJudgeOnline新增报名系统说明
=========================================
Author：lvshubao
Time：2016-2-27
=========================================
安装说明
1,将head.php,admin.php,contest_register.php,admincontestregister.php,admincontestregistermod.php五个php文件植入到JudgeOnline文件夹中，
并替换原有文件（不会对原系统产生其他影响）。
2,在数据库acmoj中导入register.sql文件
=========================================
对于数据库改动的说明
在原有数据库中增加了两个表格
1. contest_register_list   存储要添加的比赛信息
表机构如下：
+------------+--------------+------+-----+---------+----------------+
| Field      | Type         | Null | Key | Default | Extra          |
+------------+--------------+------+-----+---------+----------------+
| id         | bigint(20)   | NO   | PRI | NULL    | auto_increment |
| title      | varchar(255) | YES  |     | NULL    |                |
| start_time | date         | YES  |     | NULL    |                |
| end_time   | date         | YES  |     | NULL    |                |
+------------+--------------+------+-----+---------+----------------+


2. contest_register_user   存储报名人的信息
表结构如下：
+------------+--------------+------+-----+---------+----------------+
| Field      | Type         | Null | Key | Default | Extra          |
+------------+--------------+------+-----+---------+----------------+
| id         | bigint(20)   | YES  |     | NULL    |                |
| name       | varchar(255) | YES  |     | NULL    |                |
| sex        | varchar(10)  | YES  |     | NULL    |                |
| major      | varchar(255) | YES  |     | NULL    |                |
| school     | varchar(255) | YES  |     | NULL    |                |
| email      | varchar(255) | YES  |     | NULL    |                |
| status     | int(11)      | YES  |     | NULL    |                |
| contest_id | int(11)      | YES  |     | NULL    |                |
| num        | int(11)      | NO   | PRI | NULL    | auto_increment |
+------------+--------------+------+-----+---------+----------------+

=========================================
使用说明
1.权限为6的用户可以添加一个比赛报名，修改比赛报名，核验删除报名人信息，生成并下载已通过核验人的报名表（文件名：比赛1.doc）
2.其他权限的用户或者未登录的情况下可以报名并查看目前的报名信息，不能修改报名信息，如果提交错误可以重新填写，等待root用户删除原先错误提交即可