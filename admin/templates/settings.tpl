<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta content="ar-sa" http-equiv="Content-Language" />
  <meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
  <title>الاعدادات العامة | سكربت الدروس العربي</title>
  <link href="style.css" rel="stylesheet" />
  <script type="text/javascript" language="javascript">
      function set_title()
      {
          if (document.title != '')
          {
              parent.document.title = document.title;
          }
          else
          {
              parent.document.title = "سكربت الدروس العربي - لوحة التحكم";
          }
      }
  </script>
</head>

<body onload="set_title()" style="background-color: #F1F1F1">

<div class="PageTitle">
الإعـــدادات العـــامـــة
</div>
<br />

<div align="center" style="text-align:center;">
	<form action="settings.php" method="post">
	    <table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		بيانات الموقع والخيارات الإفتراضية</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C">
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 40%; height: 39px"><span class="Win_Elem">
						اسم الموقع &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">اكتب هنا اسم الموقع الذي تريد عرضه
						في صفحات الموقع</span></td>
	    				<td style="width: 60%; height: 39px"><input name="sitetitle" class="TextBox" type="text" value="{settings.sitetitle}" /></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px"><span class="Win_Elem">
						البريد الإلكتروني للموقع &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">سيتم إرسال رسائل الزوار لهذا البريد</span></td>
	    				<td style="width: 60%; height: 39px">
						<input name="adminmail" class="TextBox" type="text" value="{settings.adminmail}" /></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px"><span class="Win_Elem">
						رابط السكربت &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">الرابط المؤدي للموقع بدون / في
						نهاية الرابط
                        <br />على سبيل المثال : http://www.demo.com/saphplesson</span></td>
	    				<td style="width: 60%; height: 39px">
						<input name="SiteLink" class="TextBox" type="text" value="{settings.SiteLink}" /></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px"><span class="Win_Elem">
						التصميم الإفتراضي &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">حدد التصميم الذي تريد عرضه
						للزوار</span></td>
	    				<td style="width: 60%; height: 39px">
						<select class="TextBox" name="SiteStyle">
                        <IF Name="{stylen}">
                          <LOOP Name="{styles}">
                              <option <IF Name="{settings.SiteStyle} eq {{style}}">selected="selected"</IF> value="{{style}}">{{style}}</option>
                          </LOOP>
                        <ELSE>
                            <option selected="selected" value="0">لايوجد تصاميم</option>
                        </IF>
						</select>&nbsp;</td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">&nbsp;نظام التاريخ&nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 60%; height: 39px">
						<input id="Hijry" <IF Name="{settings.DateFormat} eq 0">checked="checked"</IF> name="DateFormat" type="radio" value="0" />&nbsp;<label for="Hijry">هجري
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="Melady" <IF Name="{settings.DateFormat} eq 1">checked="checked"</IF> name="DateFormat" type="radio" value="1" /> <label for="Melady">ميلادي .</label></td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
	    	<tr>
	    		<td><img alt="" height="20" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F">&nbsp;</td>
	    		<td><img alt="" height="20" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
	    <br />
	    	<table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
	    		حالة الموقع</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C">
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 40%; height: 39px"><span class="Win_Elem">
						هل الموقع مغلق ؟ &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">إذا اخترت نعم فسيتم منع الزوار من
						مشاهدة الموقع .</span></td>
	    				<td style="width: 60%; height: 39px">
						<input id="f1" <IF Name="{settings.SiteStatus} eq 1">checked="checked"</IF> name="SiteStatus" type="radio" value="1" />&nbsp;<label for="f1">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f2" <IF Name="{settings.SiteStatus} eq 0">checked="checked"</IF> name="SiteStatus" type="radio" value="0" />
						<label for="f2">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px"><span class="Win_Elem">
						سبب الإغلاق &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">في حال كان الموقع مغلق يرجى كتابة الرسالة التي تريد عرضها للزوار.</span></td>
	    				<td style="width: 60%; height: 39px">
						<textarea cols="20" name="StatusText" rows="2">{settings.StatusText}</textarea>&nbsp;</td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
	    	<tr>
	    		<td><img alt="" height="20" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F">&nbsp;</td>
	    		<td><img alt="" height="20" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
	    <br />
	    	<table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
				خيارات الدروس</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C">
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						عدد الدروس في الصفحة الواحدة&nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">حدد عدد الدروس التي تريد عرضها
						في صفحة الأقسام .</span></td>
	    				<td style="width: 60%; height: 39px">
						<input name="PageNO" class="TextBox" type="text" value="{settings.PageNO}" /></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						السماح للزوار بإضافة دروس ؟ &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">في حال اخترت لا لن يتمكن الزوار
						من إضافة دروس للمكتبة .</span></td>
	    				<td style="width: 60%; height: 39px">
						<input id="f3" <IF Name="{settings.VisitedAdd} eq 1">checked="checked"</IF> name="VisitedAdd" type="radio" value="1" />&nbsp;<label for="f3">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f4" <IF Name="{settings.VisitedAdd} eq 0">checked="checked"</IF> name="VisitedAdd" type="radio" value="0" />
						<label for="f4">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						إضافة الدروس مباشرة ؟ &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">إذا اخترت لا فلن يتم عرض الدرس
						للزوار حتى تقوم بتفعيله من لوحة التحكم .</span></td>
	    				<td style="width: 60%; height: 39px">
						<input id="f5" <IF Name="{settings.HiDaN} eq 0">checked="checked"</IF> name="HiDaN" type="radio" value="0" />&nbsp;<label for="f5">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f6" <IF Name="{settings.HiDaN} eq 1">checked="checked"</IF> name="HiDaN" type="radio" value="1" />
						<label for="f6">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						استخدام المحرر المتطور&nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">المحرر المتطور يساعد في عملية
						النسخ واللصق .</span></td>
	    				<td style="width: 60%; height: 39px">
						<input id="f7" <IF Name="{settings.TextBox} eq 1">checked="checked"</IF> name="TextBox" type="radio" value="1" />&nbsp;<label for="f7">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f8" <IF Name="{settings.TextBox} eq 0">checked="checked"</IF> name="TextBox" type="radio" value="0" />
						<label for="f8">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						السماح بحفظ الدرس كملف <span lang="en-us">Word</span> &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">إذا اخترت نعم فسيتم السماح
						للزوار بتحميل الدرس كملف <span lang="en-us">word</span>
						.</span></td>
	    				<td style="width: 60%; height: 39px">
						<input id="f9" <IF Name="{settings.SaveWord} eq 1">checked="checked"</IF> name="SaveWord" type="radio" value="1" />&nbsp;<label for="f9">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f10" <IF Name="{settings.SaveWord} eq 0">checked="checked"</IF> name="SaveWord" type="radio" value="0" />
						<label for="f10">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						السماح بحفظ الدرس كملف <span lang="en-us">PDF</span> &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">إذا اخترت نعم فسيتم السماح
						للزوار بتحميل الدرس بتنسيق <span lang="en-us">PDF</span>
						وهو نوع أفضل من <span lang="en-us">Word</span> لأنه لا
						يمكن تعديله.</span></td>
	    				<td style="width: 60%; height: 39px">
						<input id="f11" <IF Name="{settings.SavePDF} eq 1">checked="checked"</IF> name="SavePDF" type="radio" value="1" />&nbsp;<label for="f11">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f12" <IF Name="{settings.SavePDF} eq 0">checked="checked"</IF> name="SavePDF" type="radio" value="0" />
						<label for="f12">لا .</label>&nbsp;</td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
	    	<tr>
	    		<td><img alt="" height="20" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F">&nbsp;</td>
	    		<td><img alt="" height="20" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
		<br />
	    	<table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
				خيارات التعليقات</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C">
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						السماح بنظام التعليقات ؟ &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 60%; height: 39px">
						<input id="f13" <IF Name="{settings.Comment} eq 1">checked="checked"</IF> name="Comment" type="radio" value="1" />&nbsp;<label for="f13">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f14" <IF Name="{settings.Comment} eq 0">checked="checked"</IF> name="Comment" type="radio" value="0" />
						<label for="f14">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						عدد التعليقات في الصفحة الواحدة &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">إذا كان نظام التعليقات مسموح به
						فكم عدد التعليقات التي تريد عرضها في صفحة الدرس .</span></td>
	    				<td style="width: 60%; height: 39px">
						<input name="CmntNO" class="TextBox" type="text" value="{settings.CmntNO}" /></td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
	    	<tr>
	    		<td><img alt="" height="20" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F">&nbsp;</td>
	    		<td><img alt="" height="20" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
	    <br />
	    	<table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
				خيارات الملفات المرفقة</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C">
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						السماح بإرفاق الملفات في الدروس ؟ &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 60%; height: 39px">
						<input id="f15" <IF Name="{settings.Attach} eq 1">checked="checked"</IF> name="Attach" type="radio" value="1" />&nbsp;<label for="f15">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f16" <IF Name="{settings.Attach} eq 0">checked="checked"</IF> name="Attach" type="radio" value="0" />
						<label for="f16">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						أقصى حجم للملف المرفق بالكيلوبايت:&nbsp;</span><br />
	    				<span class="GraySmall">1ميقا بايت = 1024 كيلو بايت.</span></td>
	    				<td style="width: 60%; height: 39px">
						<input name="ASize" class="TextBox" type="text" value="{settings.ASize}" /></td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
	    	<tr>
	    		<td><img alt="" height="20" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F">&nbsp;</td>
	    		<td><img alt="" height="20" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
	    <br />
	    	<table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
				خيارات الـ<span lang="en-us">SEO</span> ومحركات البحث</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C">
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						السماح بخاصية اختصار الروابط&nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">عند السماح بهذه الخاصية فسيتم
						جعل روابط الدروس تنتهي بـ<span lang="en-us">html</span>
						حتى يسهل الوصول لها من قبل محركات البحث.</span></td>
	    				<td style="width: 60%; height: 39px">
						<input id="f17" <IF Name="{settings.SrchLink} eq 1">checked="checked"</IF> name="SrchLink" type="radio" value="1" />&nbsp;<label for="f17">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f18" <IF Name="{settings.SrchLink} eq 0">checked="checked"</IF> name="SrchLink" type="radio" value="0" />
						<label for="f18">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						إنشاء خريطة <span lang="en-us">Google</span> تلقائياً ؟ &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">في حال اخترت نعم فسيتم إنتاج
						صفحة تحتوي على روابط الدروس متوافقة مع خريطة
						<span lang="en-us">Google</span> .</span></td>
	    				<td style="width: 60%; height: 39px">
						<input id="f19" <IF Name="{settings.Sitemap} eq 1">checked="checked"</IF> name="Sitemap" type="radio" value="1" />&nbsp;<label for="f19">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f20" <IF Name="{settings.Sitemap} eq 0">checked="checked"</IF> name="Sitemap" type="radio" value="0" />
						<label for="f20">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						إضافة rel=&quot;nofollow&quot; للروابط الخارجية داخل الدرس؟ &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">إذا اخترت نعم فمحركات البحث لن
						تقتفي الروابط داخل الدرس .</span></td>
	    				<td style="width: 60%; height: 39px">
						<input id="f21" <IF Name="{settings.NoFollow} eq 1">checked="checked"</IF> name="NoFollow" type="radio" value="1" />&nbsp;<label for="f21">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f22" <IF Name="{settings.NoFollow} eq 0">checked="checked"</IF> name="NoFollow" type="radio" value="0" />
						<label for="f22">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						استبدال محتوى وصف الصفحة في صفحات الدروس&nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">اذا اخترت نعم سيتم تغيير وصف
						الصفحة في الـ<span lang="en-us">meta</span> ليوافق محتوى
						الدرس .</span></td>
	    				<td style="width: 60%; height: 39px">
						<input id="f23" <IF Name="{settings.SEO1} eq 1">checked="checked"</IF> name="SEO1" type="radio" value="1" />&nbsp;<label for="f23">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f24" <IF Name="{settings.SEO1} eq 0">checked="checked"</IF> name="SEO2" type="radio" value="0" />
						<label for="f24">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						استبدال كلمات البحث في صفحات الدروس&nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">إذا اخترت نعم فسيتم تغيير كلمات
						البحث في الـ<span lang="en-us">meta</span> لتوافق محتوى
						الدرس.</span></td>
	    				<td style="width: 60%; height: 39px">
						<input id="f25" <IF Name="{settings.SEO2} eq 1">checked="checked"</IF> name="SEO2" type="radio" value="1" />&nbsp;<label for="f25">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f26" <IF Name="{settings.SEO2} eq 0">checked="checked"</IF> name="SEO2" type="radio" value="0" />
						<label for="f26">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						وصف الصفحات الافتراضي &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">يتم إضافة هذا الوصف في كل
						الصفحات ويتم قراءته من قبل محرك البحث(أقصى حد 225 حرف).</span></td>
	    				<td style="width: 60%; height: 39px">
						<textarea cols="20" name="Meta1" rows="2">{settings.Meta1}</textarea></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						كلمات البحث الافتراضية &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">يتم إضافة هذه الكلمات في كل
						الصفحات ويتم قراءتها من قبل محرك البحث (أقصى حد 225 حرف).</span></td>
	    				<td style="width: 60%; height: 39px">
						<textarea cols="20" name="Meta2" rows="2">{settings.Meta2}</textarea></td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
	    	<tr>
	    		<td><img alt="" height="20" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F">&nbsp;</td>
	    		<td><img alt="" height="20" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
	    	<table cellpadding="0" align="center" cellspacing="0" style="width: 90%">
	    	<tbody>
	    	<tr>
	    		<td><img alt="" height="39" src="images/win_hr.gif" width="19" /></td>
	    		<td class="Win_H" style="width: 100%">
	    		<img alt="" height="39" src="images/win_ht.gif" style="vertical-align: middle;" width="16" />
				خيارات آخرى</td>
	    		<td class="Win_HL">
	    		<img alt="" height="39" src="images/win_hl.gif" width="12" /></td>
	    	</tr>
	    	<tr>
	    		<td class="Win_R">&nbsp;</td>
	    		<td class="Win_C">
	    		<table cellpadding="0" cellspacing="3" style="width: 100%">
	    			<tbody>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						السماح بخلاصة <span lang="en-us">RSS</span> ؟ &nbsp;:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 60%; height: 39px">
						<input id="f27" name="Show_RSS" type="radio" value="1" <IF Name="{settings.Show_RSS} eq 1">checked="checked"</IF> />&nbsp;<label for="f27">نعم
						.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="f28" name="Show_RSS" type="radio" value="0" <IF Name="{settings.Show_RSS} eq 0">checked="checked"</IF> />
						<label for="f28">لا .</label></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						عدد الدروس في خلاصة الـ<span lang="en-us">RSS</span>:&nbsp;</span><br />
	    						</td>
	    				<td style="width: 60%; height: 39px">
						<input name="RssCount" class="TextBox" type="text" value="{settings.RssCount}" /></td>
	    			</tr>
	    			<tr>
	    				<td class="Win_Lin" colspan="2" style="height: 1px">
	    				<img alt="" height="1" src="images/spacer.gif" width="1" /></td>
	    			</tr>
	    			<tr>
	    				<td style="width: 40%; height: 39px">
						<span class="Win_Elem">
						عرض صورة التحقق من الهوية ؟ &nbsp;:&nbsp;</span><br />
	    				<span class="GraySmall">يرجى تحديد الصفحات التي تريد عرض
						صورة التحقق من الهوية بها حيث ان صورة التحقق من الهوية
						تفيد من السبام .</span></td>
	    				<td style="width: 60%; height: 39px">
						<table style="width: 100%">
							<tr>
								<td>
								<input id="f29" <IF Name="{captcha.0}">checked="checked"</IF> name="Captcha[0]" type="checkbox" value="lesson" />&nbsp;<label for="f29">إضافة
								درس .</label></td>
										<td>
										<input id="f30" <IF Name="{captcha.1}">checked="checked"</IF> name="Captcha[1]" type="checkbox" value="comment" />&nbsp;<label for="f30">إضافة
										تعليق .</label></td>
									</tr>
									<tr>
										<td>
										<input id="f31" <IF Name="{captcha.2}">checked="checked"</IF> name="Captcha[2]" type="checkbox" value="search" />&nbsp;<label for="f31">البحث
										.</label></td>
										<td>
										<input id="f32" <IF Name="{captcha.3}">checked="checked"</IF> name="Captcha[3]" type="checkbox" value="tellfrind" />&nbsp;<label for="f32">أخبر
										صديق .</label></td>
									</tr>
									<tr>
										<td>
										<input id="f33" <IF Name="{captcha.4}">checked="checked"</IF> name="Captcha[4]" type="checkbox" value="contact" />&nbsp;<label for="f33">مراسلة
										الموقع .</label></td>
										<td>&nbsp;</td>
									</tr>
								</table>
								</td>
	    			</tr>
	    		</tbody>
	    		</table>
	    		<br />
	    		</td>
	    		<td class="Win_L">&nbsp;</td>
	    	</tr>
	    	<tr>
	    		<td><img alt="" height="20" src="images/win_fr.gif" width="19" /></td>
	    		<td class="Win_F">&nbsp;</td>
	    		<td><img alt="" height="20" src="images/win_fl.gif" width="15" /></td>
	    	</tr>
	    </tbody>
	    </table>
        <br />
        <div style="text-align: center;">
            <input type="submit" id="Button" name="Submit" value="حفظ التغيرات" />
            <input type="reset" id="Button" name="Rest" value="استعادة البيانات" />
        </div>
	</form>
</div>

<br />
<div style="text-align: center;">
سكربت الدروس العربي 4.0
<br />
<a href="http://www.saphplesson.org">http://www.saphplesson.org</a>
</div>

</body>

</html>