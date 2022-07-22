<?php
    
    $getDebug = isset($_GET["debug"]) && $_GET["debug"] == "true" ? true : false;
    define("IS_DEBUG", $_SERVER["HTTP_HOST"] == "localhost" || $getDebug ? true : false);

    $firstname = $lastname = $subject = $email = $phone = $message = "";
    $firstnameError = $lastnameError = $subjectError = $emailError = $phoneError = $messageError = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(IS_DEBUG){
            echo "POST<br>";
        }
        $noError = true;
        $emailTo = "nvformateurdwdm@gmail.com";
        $emailText = "";
        // firstname
        $firstname = isset($_POST["firstname"]) ? checkInput($_POST["firstname"]) : "";

        if(empty($firstname)){
            $firstnameError = "Veuillez renseigner votre prénom.";
        }else{
            $emailText .= "Prénom : " . $firstname . "\n";
        }
        // lastname
        $lastname = isset($_POST["lastname"]) ? checkInput($_POST["lastname"]) : "";
        if(empty($lastname)){
            $lastnameError = "Veuillez renseigner votre nom.";
        }else{
            $emailText .= "Nom : " . $lastname . "\n";
        }
        //
        $subject = isset($_POST["subject"]) ? checkInput($_POST["subject"]) : "";
        if(empty($subject)){
            $subjectError = "Veuillez renseigner le sujet.";
        }
        //
        $email = isset($_POST["email"]) ? checkInput($_POST["email"]) : "";
        if(!isEmail($email)){
            $emailError = "Veuillez vérifier votre email.";
        }else{
            $emailText .= "email : " . $email . "\n";
        }
        //
        $phone = isset($_POST["phone"]) ? checkInput($_POST["phone"]) : "";
        if(isPhone($phone) == 0){
            $phoneError = "Veuillez vérifier votre numéro de téléphone.";
        }else{
            $emailText .= "phone : " . $phone . "\n";
        }
        //
        $message = isset($_POST["message"]) ? checkInput($_POST["message"]) : "";
        if(empty($message)){
            $messageError = "Veuillez taper votre message.";
        }else{
            $emailText .= "Message : " . $message . "\n";
        }

        $noError = $firstnameError == "" && $lastnameError == "" && $subjectError == "" && $emailError == "" && $messageError == "";

        if($noError){
            $headers = "From: $firstname $lastname <$email>\r\nReply-To: $email";
            mail($emailTo, $subject, $emailText, $headers);

            $firstname = $lastname = $subject = $email = $message = "";
        }

    }else{
        if(IS_DEBUG){
            echo "Pas POST";
        }
    }

    function checkInput($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        // $input = utf8_encode($input);
        if(IS_DEBUG){
            echo $input;
            echo "<br>";
        }
        return $input;
    }

    function isEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function isPhone($phone){
        return preg_match("/^[0-9 ]*$/", $phone);
    }

    function getError($error){
        $html = '<h2 class="error">' . $error .'</h2>'; 
        return $html; 
    }

    // class Form {
    //     private _formItems = [];
    //     private _invalidFormItems = [];
        
    //     addItem(formItem)

    //     isValid(){

    //     }
    // }

    // class FormItem{
    //     isValid()
    // }


?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>TP Discord</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css" media="all and (max-width: 768px)">
</head>

<body>

    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ullamcorper est vel ante porttitor molestie. Vestibulum ullamcorper enim ut tortor ullamcorper, quis porta arcu eleifend. Aliquam erat volutpat. Etiam venenatis urna at lectus bibendum, non faucibus magna condimentum. Vivamus turpis tortor, finibus eget lectus in, dignissim ullamcorper risus. Phasellus posuere risus non est tincidunt, sit amet suscipit nibh euismod. Nulla facilisi. Ut vitae pulvinar odio, a imperdiet est. Ut sodales mauris a ligula euismod dapibus. Aenean libero risus, molestie non semper euismod, interdum id diam. Mauris dapibus luctus est, in cursus sapien consequat at. Proin vitae porttitor sapien, non accumsan massa.

Integer a finibus ipsum. Nullam viverra lectus nec hendrerit laoreet. Mauris non lorem non augue tincidunt molestie. Aenean sapien massa, tempor a velit nec, tincidunt aliquam turpis. Fusce neque metus, consectetur non facilisis sit amet, semper a risus. Aenean in elit blandit, tempor ex ac, convallis metus. In quis lacus interdum diam gravida fringilla a id lacus. Etiam eu varius ante, a placerat nunc. Mauris rutrum urna ultricies, dapibus lacus a, dictum felis. Quisque porta quis risus vitae luctus. Ut aliquet nisi a mi finibus, quis sodales lacus placerat. Nullam scelerisque mauris at tortor aliquet elementum. Duis dignissim consequat ipsum a imperdiet. Praesent at tincidunt est. Proin varius efficitur dolor eget mollis.

Praesent at placerat ante. Aliquam erat volutpat. Morbi vel nibh eget erat tempus laoreet eu et lectus. Nunc ut tristique augue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas sapien est, lobortis nec auctor et, vestibulum vel risus. In iaculis justo massa, sit amet consectetur ipsum interdum ac. Suspendisse erat libero, malesuada id consectetur quis, egestas sed ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut fermentum ligula ut pretium ullamcorper. Nunc id tortor sit amet mi pretium consectetur. Nunc urna urna, vulputate sed dui ac, tincidunt varius quam. Sed ultricies iaculis dui.

Aenean eget vulputate nisl, vel porta nisi. Morbi elementum dapibus dui bibendum ullamcorper. Aliquam vulputate ornare sapien at ullamcorper. Phasellus vel condimentum lorem. Suspendisse cursus lectus lacus, vitae convallis urna auctor et. Donec a viverra est, eget elementum arcu. Donec fermentum sapien eget ex porta, eu scelerisque ipsum fermentum. Pellentesque placerat libero orci, at aliquam est sagittis vel.

Morbi malesuada leo nec turpis venenatis bibendum. In nisi turpis, molestie id rhoncus congue, porttitor ac ligula. Donec faucibus metus sit amet sem laoreet, ut elementum metus fringilla. Nullam elementum mauris sit amet mi sodales tincidunt. Suspendisse facilisis pretium neque, non ullamcorper risus sodales in. Mauris molestie dignissim diam, at bibendum felis pulvinar quis. Duis consequat congue leo eget ornare. Donec id dui vehicula, consectetur purus eu, malesuada erat. Donec et magna finibus, placerat lorem non, imperdiet mauris. Nunc convallis, quam tempus mattis gravida, diam libero tempus lorem, quis consectetur magna tellus non tellus. Suspendisse vestibulum arcu in justo sagittis, sed bibendum libero sodales. Pellentesque in orci a neque posuere sollicitudin elementum et elit. Donec ut dui dictum, fringilla orci in, pretium quam. Donec consequat suscipit augue, in semper diam cursus quis. Ut interdum nunc tempor, accumsan tellus eu, condimentum urna.

Phasellus quis diam nulla. Sed venenatis ultricies purus ac varius. Morbi et mollis leo. Ut pretium magna vitae enim sollicitudin, vel porttitor tellus fermentum. Aenean sit amet mauris porta, pellentesque eros ac, facilisis purus. Integer pretium sapien non orci ultricies efficitur. Suspendisse eget neque nisl. Vestibulum congue lectus id urna fringilla sodales. Nam fringilla fermentum mauris in aliquam. Nunc sed neque ac elit sollicitudin pulvinar. Cras diam dui, tristique ut volutpat eget, vulputate vel metus. Etiam iaculis dui erat, ac tempus sapien molestie vitae. Curabitur vehicula, lorem quis vehicula posuere, leo neque sollicitudin ante, a placerat augue urna eget lorem. Etiam non bibendum nisl. Etiam malesuada tortor quis elit bibendum, sed laoreet nunc mollis.

Duis faucibus nulla eu dapibus commodo. Sed augue massa, mollis eu gravida ultricies, auctor dictum justo. Nunc ultricies metus ipsum. Mauris fermentum neque vel leo consectetur, ac rhoncus magna egestas. Proin aliquam elementum laoreet. Pellentesque ullamcorper aliquam euismod. Duis convallis imperdiet orci, at tincidunt ex tincidunt ac. Nunc viverra laoreet erat eu lobortis. Quisque fermentum, nibh at consequat commodo, ex enim auctor magna, eget laoreet elit felis at leo. Mauris convallis tristique nisl, quis gravida magna tristique sed. Donec condimentum purus id aliquam vulputate. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque non auctor mauris. Sed eu odio condimentum, dictum orci nec, imperdiet magna.

Nulla dignissim eros in mi tempus pellentesque. Mauris a consectetur quam. Nullam at ornare ligula, sed varius odio. Nam faucibus iaculis interdum. Nulla massa erat, commodo sed ante et, accumsan blandit lacus. Duis tincidunt nisi dui, nec facilisis nibh ullamcorper ac. Aliquam euismod fermentum tempor. Nam cursus dui sit amet egestas dapibus. Nulla eget lacinia ante, a sagittis ex. Vestibulum vehicula blandit elementum. Morbi maximus urna dictum urna fringilla accumsan. Aenean quis mauris id lorem feugiat faucibus non non tellus.

Sed vel nunc sed massa viverra congue a sit amet neque. Vestibulum eleifend arcu pretium aliquam fringilla. Curabitur id tortor ante. Fusce consectetur ligula in risus faucibus consequat. Nulla dui metus, sagittis quis volutpat a, auctor sit amet nunc. Cras efficitur imperdiet ante in egestas. Vestibulum sit amet accumsan dui, ac maximus lectus. Curabitur libero elit, pharetra fringilla dapibus sit amet, volutpat vel elit. Sed eget augue vehicula, porta lectus ac, vestibulum nulla. Quisque quis risus a leo lacinia convallis. Duis ac viverra nibh, in mattis quam. Duis rutrum, velit vel molestie feugiat, sem urna euismod felis, quis lobortis turpis arcu sed orci. Donec condimentum aliquet risus vitae hendrerit. Etiam hendrerit ipsum id mi posuere, id pellentesque velit bibendum. Donec elit sapien, interdum varius consequat vel, ultricies eu quam.

Morbi imperdiet, justo et vulputate porttitor, ante urna cursus est, ut varius nisi ligula et dui. Curabitur consequat tristique arcu, sit amet aliquam justo elementum at. Nam tincidunt, tortor sed ultrices volutpat, est ligula pharetra justo, faucibus accumsan libero arcu nec urna. Maecenas arcu libero, tempus a vestibulum nec, mollis non mauris. Donec ut vulputate elit. Mauris malesuada tincidunt lorem ut eleifend. Maecenas maximus imperdiet ultricies. Fusce fermentum tempor sem, sed rhoncus ipsum scelerisque vel. Quisque lobortis lectus eu nibh iaculis semper a nec sapien.

Sed nec nunc in risus eleifend egestas in id sapien. Quisque pretium, risus et ullamcorper tristique, enim quam fermentum enim, non elementum neque quam ac nunc. Aliquam porttitor efficitur eros at blandit. Pellentesque et eros sed eros cursus dapibus. Suspendisse potenti. Morbi eget ipsum maximus, dapibus sem non, ornare nunc. Vivamus vehicula ultricies placerat. Integer et molestie diam. Aliquam felis turpis, pellentesque vitae ultricies ut, volutpat id ligula. Mauris suscipit, mauris a cursus blandit, justo neque congue nisl, vitae vestibulum quam enim id erat. Proin at metus ac lorem sodales scelerisque. Suspendisse tincidunt massa varius blandit pretium.

Duis at ornare sapien, vitae vestibulum enim. Ut pretium tincidunt metus nec lacinia. Aliquam imperdiet finibus dui, et suscipit nulla blandit et. Duis commodo semper venenatis. Vestibulum id elementum quam. Etiam sagittis aliquam massa. In dictum massa at sagittis auctor. Pellentesque a venenatis nulla. Pellentesque dictum consequat nisi, id iaculis leo malesuada quis. Suspendisse vitae purus non leo dignissim dictum. Integer sagittis volutpat sagittis. Fusce blandit fringilla erat, sit amet pharetra quam dapibus ac. Morbi ut elit ac erat hendrerit lacinia. Integer vehicula pretium urna, eget ornare velit tincidunt a. Nulla sit amet mi a sapien sollicitudin iaculis.

Etiam molestie elit et arcu consectetur ornare. Suspendisse viverra feugiat urna, eleifend pretium risus. Maecenas pretium augue at mauris tincidunt gravida. Integer hendrerit, turpis eu tristique auctor, sem justo tristique urna, a auctor libero felis vel tortor. Integer vel purus in nibh efficitur hendrerit ac non justo. Donec a lacinia urna. Vestibulum eu odio lectus. Pellentesque tincidunt dictum elementum. Nunc pellentesque lectus sed dolor commodo auctor.

Vivamus maximus dolor turpis, sed iaculis turpis vulputate ut. Proin condimentum sodales libero, gravida sollicitudin quam. Phasellus scelerisque luctus gravida. Aliquam egestas quis felis eu commodo. Praesent vestibulum tristique lacinia. Mauris in nisi et odio iaculis porta et id mauris. Donec aliquam leo ac magna pharetra, nec vestibulum nisl blandit. Donec efficitur elit quam. Vestibulum eu erat bibendum, ultricies nibh id, elementum nulla. Vivamus finibus, justo a maximus posuere, lacus turpis consectetur velit, sit amet tristique neque nibh vel risus. In consequat nunc sed cursus blandit.

Proin ullamcorper eros cursus tincidunt bibendum. Phasellus varius consectetur ex, at tincidunt quam eleifend fringilla. Maecenas semper ligula elementum nunc elementum hendrerit. Praesent semper velit nulla, non varius justo dictum eu. Fusce aliquet eget ligula vel malesuada. Morbi id rhoncus leo. Donec augue ligula, facilisis id interdum at, ornare quis neque. Etiam a tincidunt lacus. Nullam non magna ut lectus cursus pretium ut eu leo. Phasellus non gravida velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;

Quisque quis volutpat justo. Integer euismod imperdiet mollis. Mauris mollis posuere fringilla. Aliquam aliquam libero ac nisi hendrerit viverra. Aenean eu orci sit amet massa iaculis pellentesque. Mauris ornare, mauris a viverra varius, dolor libero lacinia turpis, vel suscipit magna lectus nec sapien. Proin a tortor semper augue volutpat pellentesque a tristique risus. Maecenas egestas semper leo in mollis. Suspendisse potenti. Aliquam placerat at nunc vitae ornare. Proin ut ante at neque auctor venenatis. Cras suscipit libero non felis egestas tincidunt.

Maecenas viverra scelerisque purus vel congue. Vestibulum in odio turpis. Nulla venenatis eu dolor sit amet vestibulum. Etiam ultrices eu dolor quis pulvinar. Phasellus dictum blandit tincidunt. Duis eget rhoncus neque, sed volutpat sem. In non dolor vestibulum ante consectetur vulputate eu ut nibh. Morbi eget purus sed neque venenatis aliquet et eget purus. Fusce tempus non massa sed consequat.

Aliquam erat volutpat. Pellentesque a consequat nulla. Pellentesque dolor quam, auctor a consectetur at, elementum id neque. Nam pellentesque ultrices sapien, non tincidunt nibh viverra eget. Proin placerat convallis eros, vitae feugiat tellus tincidunt quis. Etiam sit amet dignissim odio, in porttitor leo. Ut quis magna vitae nibh pellentesque vehicula. Sed nunc nisl, semper id nibh ut, ornare facilisis felis. Phasellus vulputate tincidunt leo, a scelerisque quam rhoncus in. Vestibulum posuere scelerisque augue, id venenatis turpis semper non. Nunc euismod velit at maximus elementum. In non ligula vel urna maximus tempor. Nullam nec viverra lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.

Nullam varius dapibus magna, quis tincidunt velit aliquet a. Ut venenatis sed nunc at finibus. Quisque nec est vel sem maximus dictum. Sed id imperdiet massa. Integer venenatis lectus eget metus euismod sollicitudin. Donec eu dapibus dolor. Suspendisse dignissim elementum sem. In quis ante feugiat, fringilla tellus vel, commodo dui. In hac habitasse platea dictumst. Aenean suscipit erat at tellus sagittis tempus. In ultricies elementum libero. Aenean vestibulum consectetur nisl eget maximus. Sed diam augue, fermentum non orci non, viverra sagittis erat.

Morbi nec lacus varius justo ullamcorper mattis et sed est. Maecenas dapibus dictum blandit. Maecenas lacinia libero orci, sed vestibulum nisi condimentum eget. Nulla porta vulputate leo, id mollis dui volutpat sit amet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent accumsan leo ac faucibus luctus. Fusce tincidunt leo enim, vel scelerisque sapien pretium non. Sed auctor diam non suscipit pulvinar. Phasellus semper justo sit amet lorem pharetra, non viverra ex bibendum. Phasellus diam odio, semper quis magna a, imperdiet volutpat ante.</div>
    <div id="formulaire"> 
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <input type="text" placeholder="Prénom" name="firstname" value="<?php echo $firstname ?>" <?php echo !IS_DEBUG ? "required" : "" ?> >
            <?php
                if($firstnameError != ""){
                    echo getError($firstnameError);
                }
            ?>
            <input type="text" placeholder="Nom" name="lastname" value="<?php echo $lastname ?>" <?php echo !IS_DEBUG ? "required" : "" ?> >
            <?php
                if($lastnameError != ""){
                    echo getError($lastnameError);
                }
            ?>
            <input type="text" placeholder="Sujet" name="subject" value="<?php echo $subject ?>" <?php echo !IS_DEBUG ? "required" : "" ?> >
            <?php
                if($subjectError != ""){
                    echo getError($subjectError);
                }
            ?>
            <input type="email" placeholder="exemple@email.com" name="email" value="<?php echo $email ?>" <?php echo !IS_DEBUG ? "required" : "" ?> >
            <?php 
                if($emailError != ""){
                    echo getError($emailError);   
                }
            ?>
            <input type="tel" placeholder="06 90 90 90 90" name="phone" pattern="(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})" value="<?php echo $email ?>" <?php echo !IS_DEBUG ? "required" : "" ?> >
            <?php 
                if($emailError != ""){
                    echo getError($emailError);   
                }
            ?>
            <!-- <p class="error">Veuillez vérifier votre email.</p> -->
            <textarea cols="30" placeholder="Tapez votre message." rows="10" name="message" <?php echo !IS_DEBUG ? "required" : "" ?> ><?php echo $message ?></textarea>
            <?php
                if($messageError != ""){
                    echo getError($messageError);
                }
            ?>
            <!-- <input type="password" placeholder="mot de passe" required> -->
            <!-- <div id="select"> 
            <select name="date">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <select name="month">
                <option>Janviers</option>
                <option>Février</option>
                <option>Mars</option>
                <option>Avril</option>
                <option>Mai</option>
            </select>
            <select>
                <option>2021</option>
                <option> 2022</option>
                <option> 2023</option>
                <option> 2024</option>
                <option> 2025</option>
            </select>
            </div> -->
            <input type="submit" value="ENVOYER">
            <p class="message" style="display: <?php echo (isset($noError) && $noError) ? "block" : "none"; ?>" >Message envoyé !</p>
        </form>
    </div>
</body></html>
