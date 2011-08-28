<?php
/*#####################################################################*|
|                          SaphpLesson4.0                               |
| --------------------------------------------------------------------- |
|  This Script Is Free To Use But don't Delete copyright                |
|  Programmed By : Saleh AlMatrafe                                      |
|  Mobile : +966505545229 | Skype phone : saphps                        |
|  http://www.saphplesson.org  |  saphplesson@live.com(mail only)       |
|*#####################################################################*/

require_once('./global.php');

    header('Content-Type: text/xml');
    echo '<?xml version="1.0" encoding="windows-1256"?>'. "\r\n";
    echo '<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">'."\r\n";
    echo "\t<ShortName>".$settings['sitetitle']."</ShortName>\r\n";
    echo "\t<Description>محرك بحث ".$settings['sitetitle']."</Description>\r\n";
    echo "\t<InputEncoding>windows-1256</InputEncoding>\r\n";
    echo "\t".'<Url type="text/html" template="'.$settings['SiteLink'].'/search.php?Word={searchTerms}&amp;rel=provider&amp;Find=less&amp;Cat=0&amp;Order=Relevance&amp;Dir=DESC"/>'."\r\n";
    echo "</OpenSearchDescription>";
?>