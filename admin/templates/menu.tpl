<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Language" content="ar-sa">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1256">
    <title>سكربت الدروس العربي - القائمة الجانبية</title>
    <link rel="stylesheet" href="style.css">
    <base target="main">
</head>

<body style="margin:0;">

    <img width="200" src="images/cp-logo.gif" border="0" height="76"><br />
    <div style="text-align: center;">
    <a href="../" target="_blank">الصفحة الرئيسية للسكربت</a>
    </div>
    <div class="Box_H">الدروس العربي</div>
    <ul class="Box_F">
    	<IF Name="{Premission.0}"><li class="Box_C"><a href="settings.php">الإعدادات العامة</a></li></IF>
    	<IF Name="{Premission.1}"><li class="Box_C"><a href="words.php">الكلمات الممنوعة</a></li></IF>
    	<li class="Box_C"><a href="index.php?action=Welcome">رئيسية التحكم</a></li>
    </ul>
    <IF Name="{Premission.2}">
    <div class="Box_H">المشرفين</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="moderator.php?action=add">اضافة مشرف جديد</a></li>
    	<li class="Box_C"><a href="moderator.php">عرض كافة المشرفين</a></li>
    </ul>
    </IF>
    <IF Name="{Premission.3}">
    <div class="Box_H">الاقسام</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="cat.php?action=add">اضافة قسم جديد</a></li>
    	<li class="Box_C"><a href="cat.php">عرض كافة الاقسام</a></li>
    </ul>
    </IF>
    <IF Name="{Premission.4}">
    <div class="Box_H">الدروس</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="lesson.php?action=add">اضافة درس جديد</a></li>
    	<li class="Box_C"><a href="lesson.php">عرض الدروس المفعّلة</a></li>
    	<li class="Box_C"><a href="lesson.php?action=active">عرض الدروس الغير مفعّلة</a></li>
    </ul>
    </IF>
    <IF Name="{Premission.5}">
    <div class="Box_H">التعليقات</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="comment.php?action=lsn">عرض الدروس التي تحتوي على تعليقات</a></li>
    	<li class="Box_C"><a href="comment.php?action=byid">عرض التعليقات بواسطة رقم الدرس</a></li>
    	<li class="Box_C"><a href="comment.php?action=bycat">عرض التعليقات بواسطة الاقسام</a></li>
    </ul>
    </IF>
    <IF Name="{Premission.6}">
    <div class="Box_H">المرفقات</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="attach.php?action=files">حذف ملف المرفق</a></li>
    	<li class="Box_C"><a href="attach.php">امتدادات الملفات</a></li>
    </ul>
    </IF>
    <IF Name="{Premission.7}">
    <div class="Box_H">الصيانة</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="backup.php">نسخة احتياطية</a></li>
    	<li class="Box_C"><a href="index.php?action=phpinfo">عرض معلومات php</a></li>
    </ul>
    </IF>
    <div class="Box_H">الدعم الفني</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="http://www.saphplesson.org/send.html" target="_blank">ابلاغ عن خطأ برمجي</a></li>
    	<li class="Box_C"><a href="http://www.saphplesson.org/send.html" target="_blank">ابلاغ عن ثغرة</a></li>
    	<li class="Box_C"><a href="http://www.saphplesson.org" target="_blank">الموقع الرسمي</a></li>
    	<li class="Box_C"><a href="http://www.dt-live.com" target="_blank">فريق التقنيات الرقمية</a></li>
    </ul>
    <div class="Box_H">تسجيل الخروج</div>
    <ul class="Box_F">
    	<li class="Box_C"><a href="login.php?action=logout" target="_parent">خـــروج</a></li>
    </ul>
    <p>&nbsp;</p>

</body>

</html>
