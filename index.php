<!DOCTYPE html>
<html>
<body>

<form action="/translate.php" id="translate">

    <h1 style="text-align: left">Amazon Translate Demo</h1>
    <br/>
    <table>
        <tr>
            <th align="left">
Source Language Code:
                <select id="sourceLang">
                      <option value="en">en</option>
                      <option value="ar">ar</option>
                      <option value="de">de</option>
                      <option value="es">es</option>
                      <option value="fr">fr</option>
                      <option value="pt">pt</option>
                      <option value="zh">zh</option>
                </select>
            </th>
            <th align="left">
Target Language Code:
                <select id="targLang">
                      <option value="en">en</option>
                      <option value="ar">ar</option>
                      <option value="de">de</option>
                      <option value="es">es</option>
                      <option value="fr">fr</option>
                      <option value="pt">pt</option>
                      <option value="zh">zh</option>
                </select>
            </th>
        </tr>

        <tr><td>Text to translate:</td><td><textarea rows="4" cols="50" name="textToTranslate" form="usrform">
Enter text here...</textarea>
  <input type="submit" name="translate"></td></tr> 

        
</table>
<input type="submit" name="translate">
<br>


</body>
</html>


