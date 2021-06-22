<?
	include"getsession.php";
?>
<html>
<head>
<title>BPT Garuda - Login</title>

<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 10px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

body,td,th {
	font-family: Georgia, Times New Roman, Times, serif;
	font-size: 12px;
}
</style>
</head>
<body>

<table width="800" border="0" align="center">
  <tr>
    <td colspan="3"><? include "header.php"; ?></td>
  </tr>
  <tr>
    <td width="200" valign="top"><?php include"menuuser.php"; ?></td>
    <td width="584" colspan="2" valign="top">
    
    <span class="error"><?php echo validation_errors(); echo $msg; ?><?php echo form_open('login'); ?></span>
    
   
      <table width="341" border="0">
        <tr>
          <td width="112">Email</td>
          <td width="219"><label>
            <input type="text" name="email" id="email">
          </label></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="password" id="password"></td>
        </tr>
        <tr>
          <td colspan="2"><label>
            <div align="center">
              <input type="submit" name="button" id="button" value="Login">
            </div>
          </label></td>
          </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

<div align="center">Page rendered in {elapsed_time} seconds </div>
</body>
</html>