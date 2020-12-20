<?php
if(isset($_COOKIE['handle'])){
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Status</title>
        <script>
            var handle = "<?php echo $_COOKIE['handle'];?>";
            var api_url = "https://codeforces.com/api/user.status?handle=";
            api_url+=handle;
            api_url+="&from=1&count=100";

            async function getapi(url){
                const response = await fetch(url);
                var data = await response.json();
                console.log(data);
                if(response){
                    show(data);
                }

            }

            getapi(api_url);

            function show(data) {
                var problems_AC = [];
                var problems_WA = [];
                var problems_CH = [];
                var name_p="";
                var prev_wa="";
                var count=0;
                for (var i=0;i<50;i++){
                    if(data.result[i].verdict==="OK"&&data.result[i].author.participantType==="CONTESTANT"){
                        name_p+=data.result[i].problem.index;
                        name_p+=" : ";
                        name_p+=data.result[i].problem.name;
                        problems_AC.push(name_p);
                        name_p="";
                        count++;
                    }
                    else if(data.result[i].verdict==="WRONG_ANSWER"&&data.result[i].author.participantType==="CONTESTANT"){
                        name_p+=data.result[i].problem.index;
                        name_p+=" : ";
                        name_p+=data.result[i].problem.name;
                        if(prev_wa!==name_p){
                            problems_WA.push(name_p);
                        }
                        prev_wa=name_p;
                        name_p="";
                    }
                    else if(data.result[i].verdict==="CHALLENGED"&&data.result[i].author.participantType==="CONTESTANT"){
                        name_p+=data.result[i].problem.index;
                        name_p+=" : ";
                        name_p+=data.result[i].problem.name;
                        problems_CH.push(name_p);
                        name_p="";
                    }
                    if(count===10) break;
                }
                var acc_text ="";
                for(var a=0;a<problems_AC.length;a++){
                    acc_text+=problems_AC[a];
                    acc_text+='<br><br>';
                }
                var wa_text ="";
                for(var b=0;b<problems_WA.length;b++){
                    wa_text+=problems_WA[b];
                    wa_text+='<br><br>';
                }
                var ch_text ="";
                for(var c=0;c<problems_CH.length;c++){
                    ch_text+=problems_CH[c];
                    ch_text+='<br><br>';
                }


                if(problems_AC.length>0) document.getElementById("accepted").innerHTML= acc_text;
                if(problems_WA.length>0) document.getElementById("wrong").innerHTML= wa_text;
                if(problems_CH.length>0) document.getElementById("hacked").innerHTML= ch_text;

            }


        </script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <style>
            body{
                font-size:40px;
            }
        </style>
    </head>
    <body><br><br>
    <center>
        <p style="font-size:60px;font-weight:bold;">Recent Submissions Status</p><br>
        <br><br>
        <div class="card text-white bg-success mb-3" style="max-width: 50rem;">
            <div class="card-header">Latest ACCEPTED Solutions</div>
            <div class="card-body">
                <p class="card-text" id="accepted">(No Data)</p>
            </div>
        </div>
        <br>
        <div class="card text-white bg-primary mb-3" style="max-width: 50rem;">
            <div class="card-header">Latest WRONG Solutions</div>
            <div class="card-body">
                <p class="card-text" id="wrong">(No Wrong Answers Recently)</p>
            </div>
        </div>
        <br>
        <div class="card text-white bg-danger mb-3" style="max-width: 50rem;">
            <div class="card-header">Latest HACKED Solutions</div>
            <div class="card-body">
                <p class="card-text" id="hacked">(No Hacked Answers Recently)</p>
            </div>
        </div>

    </center>
    </body>
    </html>
    <?php
}

else{
    ?>

    Login again
    <?php
    header('location:https://www.itoi.club/mycf');
}
?>