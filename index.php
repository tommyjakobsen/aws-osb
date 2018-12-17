<!DOCTYPE html>
<html>
<body>

<form action="/translate.php" id="translate"  method="post">

    <h1 style="text-align: left">Amazon Translate Demo</h1>
    <br/>
    <table>
        <tr>
            <td align="left">
<b>Source Language Code:</b>
                </td><td>
                <select name="sourceLang">
                      <option value="en">en</option>
                      <option value="ar">ar</option>
                      <option value="de">de</option>
                      <option selected value="es">es</option>
                      <option value="fr">fr</option>
                      <option value="pt">pt</option>
                      <option value="zh">zh</option>
                </select>
            </td></tr>
            <td align="left">
<b>Target Language Code:</b>
            </td><td>
                <select name="targLang">
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

        <tr><td><b>Text to translate:</b></td><td><textarea rows="4" cols="50" name="textToTranslate">
        ¡Ahora estoy tan enojado con esta mierda!
¡Mi red pierde conexión todo el tiempo!
¡Mis genes españoles están gritando de furia!
¡AYUDAME AHORA!</textarea>
</td></tr>

</table>
<br>
<input type="submit" name="translate">
<br>


</body>
</html>