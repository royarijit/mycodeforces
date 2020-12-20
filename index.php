<?php
if(isset($_POST['handle'])){
    setcookie('handle', $_POST['handle'], time() + (60*5), "/");
    header('location:dash/');
}
else{
    ?>

    <!--HTML part for the login page with handle -->

    <html>
    <head>
        <title>myCF</title>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="/script.js" defer></script>
        <link rel="manifest" href="/manifest.json">
        <script>
            
            function showLoader(){
                document.getElementById("loader").style.display="inline";
            }
            
            function hideLoader(){
                document.getElementById("loader").style.display="none";
            }
        </script>
        <style>
            input{
                border-radius:20px;
                border:2px solid gray;
                width:650px;
                height:120px;
                font-size:70px;
            }
            button{
                width:350px;
                height:100px;
                font-size:100px;
            }
        </style>
    </head>
    <body onload="hideLoader()">
    <br><br><br><br><br><br><br><br>
    <center>
    <font size=7>myCF</font>
    <br><br><br><br><br>
    
        <form action="" method="post">
                <lable style="font-size:50px;font-weight:bold;">Enter Codeforces Handle</lable><br><br>
                <input type="text" id="handle" name="handle" required>
                <br><br>
            <button type="submit" class="btn btn-primary" onclick="showLoader()">Submit</button>
            <br><br>
            <div id="loader">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets6.lottiefiles.com/datafiles/bEYvzB8QfV3EM9a/data.json"  background="transparent"  speed="1"  style="width: 500px; height: 500px;"  loop  autoplay></lottie-player>
            </div>
        </form>
    </center>
    </body>

    </html>
<?php
}
?>