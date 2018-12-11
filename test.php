<?php


//SQS_AWS_ACCESS_KEY_ID

//SQS_AWS_SECRET_ACCESS_KEY

if(getenv('SQS_AWS_ACCESS_KEY_ID') !== false)
    {
        $SQS_AWS_ACCESS_KEY_ID=getenv('SQS_AWS_ACCESS_KEY_ID');
       //Debug
        //echo "Found AI endpoint at: $SQS_AWS_ACCESS_KEY_ID<hr>";
     }else{
        echo "<font color=red><b>! \$SQS_AWS_ACCESS_KEY_ID variable not set...<br>Add secrets to application...</font>";
        echo "</body>";
     exit(1);
     }
if(getenv('SQS_AWS_SECRET_ACCESS_KEY') !== false)
    {
        $textAnalyticsKey=getenv('SQS_AWS_SECRET_ACCESS_KEY');
        //DEBUG
        //echo "Found aiKey at: $SQS_AWS_SECRET_ACCESS_KEY<hr>";
     }else{
        echo "<font color=red><b>! \$SQS_AWS_SECRET_ACCESS_KEY variable not set...<br>Check bindings in openshift...</font>";
        echo "</body>";
     exit(1);
     }



?>

<!DOCTYPE html>
<html>

<head>
    <title>Amazon Translate</title>
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.372.0.min.js"></script>
</head>

<body>
    <h1 style="text-align: left">Amazon Translate Demo</h1>
    <br/>
    <table class="tg">
        <tr>
            <th align="left">
Source Language Code:
                <select id="sourceLanguageCodeDropdown">
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
                <select id="targetLanguageCodeDropdown">
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
        <tr>
            <th>
                <textarea id="inputText" name="inputText" rows="10" cols="50" placeholder="Text to translate..."></textarea>
            </th>
            <th>
                <textarea id="outputText" name="outputText" rows="10" cols="50" placeholder="Translated text..."></textarea>
            </th>
        </tr>
        <tr>
            <th align="left">
                <button type="button" name="translateButton" onclick="doTranslate()">Translate</button>
                <button type="button" name="synthesizeButton" onclick="doSynthesizeInput()">Synthesize Input Speech</button>
                <button type="button" name="clearButton" onclick="clearInputs()">Clear</button>
            </th>
            <th align="left">
                <button type="button" name="synthesizeButton" onclick="doSynthesizeOutput()">Synthesize Output Speech</button>
            </th>
        </tr>
    </table>
    <script type="text/javascript">
        // set the focus to the input box
        document.getElementById("inputText").focus();

     
        
        AWS.config.credentials = new AWS.Credentials("$SQS_AWS_ACCESS_KEY_ID", "$SQS_AWS_SECRET_ACCESS_KEY);

        var translate = new AWS.Translate({endpoint: ep, region: AWS.config.region});
        var polly = new AWS.Polly();

        function doTranslate() {
            var inputText = document.getElementById('inputText').value;
            if (!inputText) {
                alert("Input text cannot be empty.");
                exit();
            }

            // get the language codes
            var sourceDropdown = document.getElementById("sourceLanguageCodeDropdown");
            var sourceLanguageCode = sourceDropdown.options[sourceDropdown.selectedIndex].text;

            var targetDropdown = document.getElementById("targetLanguageCodeDropdown");
            var targetLanguageCode = targetDropdown.options[targetDropdown.selectedIndex].text;

            var params = {
                Text: inputText,
                SourceLanguageCode: sourceLanguageCode,
                TargetLanguageCode: targetLanguageCode
            };

            translate.translateText(params, function(err, data) {
                if (err) {
                    console.log(err, err.stack);
                    alert("Error calling Amazon Translate. " + err.message);
                    return;
                }
                if (data) {
                    var outputTextArea = document.getElementById('outputText');
                    outputTextArea.value = data.TranslatedText;
                }
            });
        }

        function doSynthesizeInput() {
            var text = document.getElementById('inputText').value.trim();
            if (!text) {
                return;
            }
            var sourceLanguageCode = document.getElementById("sourceLanguageCodeDropdown").value;
            doSynthesize(text, sourceLanguageCode);
        }

        function doSynthesizeOutput() {
            var text = document.getElementById('outputText').value.trim();
            if (!text) {
                return;
            }
            var targetLanguageCode = document.getElementById("targetLanguageCodeDropdown").value;
            doSynthesize(text, targetLanguageCode);
        }

        function doSynthesize(text, languageCode) {
            var voiceId;
            switch (languageCode) {
                case "de":
                    voiceId = "Marlene";
                    break;
                case "en":
                    voiceId = "Joanna";
                    break;
                case "es":
                    voiceId = "Penelope";
                    break;
                case "fr":
                    voiceId = "Celine";
                    break;
                case "pt":
                    voiceId = "Vitoria";
                    break;
                default:
                    voiceId = null;
                    break;
            }
            if (!voiceId) {
                alert("Speech synthesis unsupported for language code: \"" + languageCode + "\"");
                return;
            }
            var params = {
                OutputFormat: "mp3", 
                SampleRate: "8000", 
                Text: text, 
                TextType: "text", 
                VoiceId: voiceId
            };
            polly.synthesizeSpeech(params, function(err, data) {
                if (err) {
                    console.log(err, err.stack); // an error occurred
                    alert("Error calling Amazon Polly. " + err.message);
                }
                else {
                    var uInt8Array = new Uint8Array(data.AudioStream);
                    var arrayBuffer = uInt8Array.buffer;
                    var blob = new Blob([arrayBuffer]);
                    var url = URL.createObjectURL(blob);

                    audioElement = new Audio([url]);
                    audioElement.play();
                }
            });
        }

        function clearInputs() {
            document.getElementById('inputText').value = "";
            document.getElementById('outputText').value = "";
            document.getElementById("sourceLanguageCodeDropdown").value = "en";
            document.getElementById("targetLanguageCodeDropdown").value = "en";
        }
    </script>
</body>

</html>