<!DOCTYPE html>
<html>
<body>

<form action="/translate.php" id="translate">

    <h1 style="text-align: left">Amazon Translate Demo</h1>
    <br/>
    <table>
        <tr>
            <td align="left">
<b>Source Language Code:</b>
                </td><td>
                <select id="sourceLang">
                      <option value="en">en</option>
                      <option value="ar">ar</option>
                      <option value="de">de</option>
                      <option value="es">es</option>
                      <option value="fr">fr</option>
                      <option value="pt">pt</option>
                      <option value="zh">zh</option>
                </select>
            </td></tr>
            <td align="left">
<b>Target Language Code:</b>
            </td><td>
                <select id="targLang">
                      <option value="en">en</option>
                      <option value="ar">ar</option>
                      <option value="de">de</option>
                      <option value="es">es</option>
                      <option value="fr">fr</option>
                      <option value="pt">pt</option>
                      <option value="zh">zh</option>
                </select>
            </td>
        </tr>

        <tr><td><b>Text to translate:</b></td><td><textarea rows="4" cols="50" name="textToTranslate" form="usrform">
Enter text here...</textarea>
</td></tr>
        
</table>
<br>
<input type="submit" name="translate">
<br>


</body>
</html>


