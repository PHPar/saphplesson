var coloroptions = new Array("#000000" ,"#A0522D" ,"#556B2F" ,"#006400" ,"#483D8B" ,"#000080" ,"#4B0082" ,"#2F4F4F" ,"#8B0000" ,"#FF8C00" ,"#808000" ,"#008000" ,"#008080" ,"#0000FF" ,"#708090" ,"#696969" ,"#FF0000" ,"#F4A460" ,"#9ACD32" ,"#2E8B57" ,"#48D1CC" ,"#4169E1" ,"#800080" ,"#808080" ,"#FF00FF" ,"#FFA500" ,"#FFFF00" ,"#00FF00" ,"#00FFFF" ,"#00BFFF" ,"#9932CC" ,"#C0C0C0" ,"#FFC0CB" ,"#F5DEB3" ,"#FFFACD" ,"#98FB98" ,"#AFEEEE" ,"#ADD8E6" ,"#DDA0DD" ,"#FFFFFF");
var colorarabic = new Array("«·√·Ê«‰","√”Êœ","»‰Ì","√Œ÷— “Ì Ì","√Œ÷— œ«ﬂ‰","√“—ﬁ „Œ÷— œ«ﬂ‰","√“—ﬁ œ«ﬂ‰","‰Ì·Ì","—„«œ—Ì-80%","√Õ„— œ«ﬂ‰","»— ﬁ«·Ì","√’›— œ«ﬂ‰","√Œ÷—","√“—ﬁ „Œ÷—","√“—ﬁ","√“—ﬁ-—„«œÌ","—„«œÌ-50%","√Õ„—","»— ﬁ«·Ì ›« Õ","·Ì„Ê‰Ì","√Œ÷— »Õ—Ì","√“—ﬁ „«∆Ì","√“—ﬁ ›« Õ","»‰›”ÃÌ","—„«œÌ-40%","“Â—Ì","–Â»Ì","√’›—","√Œ÷— ”«ÿ⁄"," —ﬂÊ«“Ì","√“—ﬁ ”„«ÊÌ","√—ÃÊ«‰Ì „“—ﬁ œ«ﬂ‰","—„«œÌ-25%","Ê—œÌ","√”„— „’›—","√’›— ›« Õ","√Œ÷— ›« Õ"," —ﬂÊ«“Ì ›« Õ","√“—ﬁ ‘«Õ»","√—ÃÊ«‰Ì ‘«Õ»","√»Ì÷");
var editor_loaded = false;

var colorindex = new Array();
var buttonstatus = new Array();

var imgurl = "http://";
var linkurl = "http://";

function format_control(elm, elmtype, controlstate)
{
	// if we do not *need* to change the control state, then don't
	if (typeof(elm.controlstate) != "undefined" && controlstate == elm.controlstate)
	{
		return;
	}

	// construct the name of the appropriate array key from the istyles array
	var istyle = "pi_" + elmtype + "_" + controlstate;

	// set element background, color, padding and border
	elm.style.background = istyles[istyle][0];
	elm.style.color = istyles[istyle][1];
	if (elmtype != "menu")
	{
		elm.style.padding = istyles[istyle][2];
	}
	elm.style.border = istyles[istyle][3];

	// set the element controlstate variable
	elm.controlstate = controlstate;

	// handle some special cases for popup elements
	if (typeof(elm.cmd) != "undefined")
	{
		var tds = elm.getElementsByTagName("td");
		for (var i = 0; i < tds.length; i++)
		{
			switch (tds[i].className)
			{

				// set the left-padding and left-border for alt_pickbutton elements
				case "alt_pickbutton":
				{
					if (buttonstatus[elm.cmd])
					{
						tds[i].style.paddingLeft = istyles["pi_button_normal"][2];
						tds[i].style.borderLeft = istyles["pi_button_normal"][3];
					}
					else
					{
						tds[i].style.paddingLeft = istyles[istyle][2];
						tds[i].style.borderLeft = istyles[istyle][3];
					}
				}
			}
		}
	}
}

function build_fontoptions()
{
		for (key in fontoptions)
		{
			document.writeln('<option value="' + fontoptions[key] + '">' + fontoptions[key] + '</option>');
		}
}

function build_sizeoptions()
{
		for (key in sizeoptions)
		{
			document.writeln('<option value="' + sizeoptions[key] + '">' + sizeoptions[key] + '</option>');
		}
}

function build_coloroptions(w)
{
    if (w){
        for (var y = 0; y < 5; y++)
	{
	  document.write('<tr align="center">');
	  for (var x = 0; x < 8; x++)
	  {
	     document.write('<td class="ocolor"><div></div></td>');
	  }
	  document.write('</tr>');
	}
    }else{
      for (key in coloroptions)
      {
           var str = key;
           str++;
	   document.writeln('<option value="' + coloroptions[key] + '" style="background-color:' + coloroptions[key] + ';">' + colorarabic[str] + '</option>');
      }
    }
}

function set_unselectable(elm)
{
	if (is_ie4)
	{
		return;
	}
	else if (typeof(elm.tagName) != "undefined")
	{
		if (elm.hasChildNodes())
		{
			for (var i = 0; i < elm.childNodes.length; i++)
			{
				set_unselectable(elm.childNodes[i]);
			}
		}
		elm.unselectable = true;
	}
}

function set_default_text(textvalue)
{
		if (is_ie)
		{
			if (textvalue == "")
			{
				textvalue = "<p style=\"margin:0px\"></p>";
			}
			var htb = fetch_object("htmlbox");
			htb.innerHTML = textvalue;
			htb.style.backgroundColor = "#ffffff";
			htb.style.color = "#000000";
			htb.style.fontFamily = "Tahoma";
			htb.style.fontSize = "10pt";
		}
		else
		{
			var htb = fetch_object("htmlbox").contentWindow.document;
			htb.open();
			htb.write("<html dir='rtl'><head><title>Mozilla WYSIWYG</title></head><body>" + textvalue + "</body></html>");
			htb.close();
			htb.body.style.cursor = "text";
			htb.body.style.backgroundColor = "#ffffff";
			htb.body.style.color = "#000000";
			htb.body.style.fontFamily = "Tahoma";
			htb.body.style.fontSize = "10pt";
		}
}