<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Language" content="ar-sa">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1256">
    <title>����� ������ ������ - ������� ��������</title>
    <link rel="stylesheet" href="style.css">
    <base target="main">
</head>

<body style="margin:0;">

    <img width="200" src="images/cp-logo.gif" border="0" height="76"><br />
    <div style="text-align: center;">
    <a href="../" target="_blank">������ �������� �������</a>
    </div>
    <div class="Box_H">������ ������</div>
    <ul class="Box_F">
    	<IF Name="{Premission.0}"><li class="Box_C"><a href="settings.php">��������� ������</a></li></IF>
    	<IF Name="{Premission.1}"><li class="Box_C"><a href="words.php">������� ��������</a></li></IF>
    	<li class="Box_C"><a href="index.php?action=Welcome">������ ������</a></li>
    </ul>
    <IF Name="{Premission.2}">
    <div class="Box_H">��������</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="moderator.php?action=add">����� ���� ����</a></li>
    	<li class="Box_C"><a href="moderator.php">��� ���� ��������</a></li>
    </ul>
    </IF>
    <IF Name="{Premission.3}">
    <div class="Box_H">�������</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="cat.php?action=add">����� ��� ����</a></li>
    	<li class="Box_C"><a href="cat.php">��� ���� �������</a></li>
    </ul>
    </IF>
    <IF Name="{Premission.4}">
    <div class="Box_H">������</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="lesson.php?action=add">����� ��� ����</a></li>
    	<li class="Box_C"><a href="lesson.php">��� ������ ��������</a></li>
    	<li class="Box_C"><a href="lesson.php?action=active">��� ������ ����� ������</a></li>
    </ul>
    </IF>
    <IF Name="{Premission.5}">
    <div class="Box_H">���������</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="comment.php?action=lsn">��� ������ ���� ����� ��� �������</a></li>
    	<li class="Box_C"><a href="comment.php?action=byid">��� ��������� ������ ��� �����</a></li>
    	<li class="Box_C"><a href="comment.php?action=bycat">��� ��������� ������ �������</a></li>
    </ul>
    </IF>
    <IF Name="{Premission.6}">
    <div class="Box_H">��������</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="attach.php?action=files">��� ��� ������</a></li>
    	<li class="Box_C"><a href="attach.php">�������� �������</a></li>
    </ul>
    </IF>
    <IF Name="{Premission.7}">
    <div class="Box_H">�������</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="backup.php">���� ��������</a></li>
    	<li class="Box_C"><a href="index.php?action=phpinfo">��� ������� php</a></li>
    </ul>
    </IF>
    <div class="Box_H">����� �����</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="http://www.saphplesson.org/send.html" target="_blank">����� �� ��� �����</a></li>
    	<li class="Box_C"><a href="http://www.saphplesson.org/send.html" target="_blank">����� �� ����</a></li>
    	<li class="Box_C"><a href="http://www.saphplesson.org" target="_blank">������ ������</a></li>
    	<li class="Box_C"><a href="http://www.dt-live.com" target="_blank">���� �������� �������</a></li>
    </ul>
    <div class="Box_H">����� ������</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="login.php?action=logout" target="_parent">�������</a></li>
    </ul>
    <p>&nbsp;</p>

</body>

</html>
