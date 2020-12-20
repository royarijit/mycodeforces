<?php
if(isset($_COOKIE['handle'])){
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script>

            // user profile data
            var handle = "<?php echo $_COOKIE['handle'];?>";
            var api_url = "https://codeforces.com/api/user.info?handles=";
            api_url+=handle;
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
                for (let r of data.result) {
                    image = `${r.titlePhoto}`;
                    rank = `${r.rank}`;
                }
                var name=handle;
                // Setting innerHTML as tab variable
                max_rank = data.result[0].maxRank;
                max_rating = data.result[0].maxRating;
                document.getElementById("userName").innerHTML = name;
                document.getElementById("avatar").src = image;
                if(rank==="newbie"){
                    document.getElementById("rank").style.color="gray";
                }
                if(rank==="pupil"){
                    document.getElementById("rank").style.color="green";
                }
                document.getElementById("rank").innerHTML = rank;
                document.getElementById("maxRank").innerHTML = max_rank;
                document.getElementById("maxRating").innerHTML = max_rating;
            }


            //rating data
            var api_url_rating = "https://codeforces.com/api/user.rating?handle=";
            api_url_rating+=handle;
            async function getapi_rating(url_rating){
                const response_rating = await fetch(url_rating);
                var data_rating = await response_rating.json();
                console.log(data_rating);
                if(response_rating){
                    show_rating(data_rating);
                }

            }

            getapi_rating(api_url_rating);
            function show_rating(data_rating) {
                down=0;
                up=0;
                var size = data_rating.result.length;
                contest_name = data_rating.result[size-1].contestName;
                contest_rank = data_rating.result[size-1].rank;
                rating_new = data_rating.result[size-1].newRating;
                rating_old = data_rating.result[size-1].oldRating;
                rating_ch = rating_new-rating_old;
                var total_rating_up=0;
                var total_rating_down=0;
                for(var i=0;i<size;i++){
                    rating_new_t = data_rating.result[i].newRating;
                    rating_old_t = data_rating.result[i].oldRating;
                    rating_ch_t = rating_new_t-rating_old_t;
                    if(rating_ch_t<0){
                        total_rating_down+= Math.abs(rating_ch_t);
                        down++;
                    }
                    else {
                        total_rating_up+=rating_ch_t;
                        up++;
                    }
                }
                var total_rating_score = (total_rating_up+((up-down)*10))-total_rating_down;
                if(rating_ch>0){
                    rating_change = "(+"+rating_ch.toString()+")";
                }
                else {
                    rating_change = "("+rating_ch.toString()+")";
                }

                if(rating_ch<0){
                    document.getElementById("ratingChange").style.color="red";
                }
                else{
                    document.getElementById("ratingChange").style.color="green";
                }
                document.getElementById("newRating").innerHTML= rating_new;
                document.getElementById("codingKarma").innerHTML= total_rating_score;
                document.getElementById("oldRating").innerHTML= rating_old;
                document.getElementById("ratingChange").innerHTML= rating_change;
                document.getElementById("lastContest").innerHTML= contest_name;
                document.getElementById("lastContestRank").innerHTML= contest_rank;
                var comment;
                if(size<21&&size>=0){
                    comment = "It is just the beginning keep the spirit up and running!";
                }
                if (size<51&&size>=21){
                    comment = "Here goes a champion in making!";
                }
                if (size<101&&size>=51){
                    comment = "Let the fire burn and you lite up the code!";
                }
                if(size>101){
                    comment = "Legends never stop coding!"
                }
                document.getElementById("totalContests").innerHTML= size;
                document.getElementById("extraComment").innerHTML= comment;
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    // Create the data table.
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Activity');
                    data.addColumn('number', 'Total');
                    data.addRows([
                        ['UP', up],
                        ['DOWN',down]
                    ]);

                    // Set chart options
                    var options = {'title':'MyCF Hustle Chart',
                        'width':300,
                        'height':300};

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                }
            }


        </script>
        <script>
            
            function showLoader(){
                document.getElementById("loader").style.display="inline";
            }
            
            function hideLoader(){
                document.getElementById("loader").style.display="none";
            }
        </script>
        <meta charset="UTF-8" />
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0" />
        <title>Profile</title>
    </head>
    <body onload="hideLoader()">

    <br><br>
    <img src="avatar" class="rounded mx-auto d-block" alt="avatar" id="avatar">
    <center>
        <br><br>
        <p class="text-muted" id="greeting">greeting</p>
        <p class="h2" id="userName">UserName</p><br>
        <a href="status/" ><button type="button" class="btn btn-primary" onclick="showLoader()">Check Recent Submission Status</button></a><br>
            <div id="loader">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets6.lottiefiles.com/datafiles/bEYvzB8QfV3EM9a/data.json"  background="transparent"  speed="1"  style="width: 100px; height: 100px;"  loop  autoplay></lottie-player>
            </div>
        <br>
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-award" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M9.669.864L8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193l-1.51-.229L8 1.126l-1.355.702-1.51.229-.684 1.365-1.086 1.072L3.614 6l-.25 1.506 1.087 1.072.684 1.365 1.51.229L8 10.874l1.356-.702 1.509-.229.684-1.365 1.086-1.072L12.387 6l.248-1.506-1.086-1.072-.684-1.365z"/>
            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
        </svg><br><span class="rank" id="rank" style="color: black;font-size: 30px;">(rank)</span><br><br>
        MyCF Karma Score:<br> <span class="codingKarma" id="codingKarma" style="color: black;font-size: 30px;">(Karma score)</span><br>
        Current Rating:<br> <span class="rating" id="newRating" style="color: black;font-size: 30px;">(rating)</span> &nbsp;<span class="rating" id="ratingChange" style="color: black;font-size: 25px;">(rating)</span><br>
        Previous Rating:<br> <span class="rating" id="oldRating" style="color: black;font-size: 30px;">(rating)</span><br>
        Latest Contest Given:<br> <span class="lastContest" id="lastContest" style="color: black;font-size: 15px;font-weight: bold;">(Last Contest)</span><br><br>
        Latest Contest Rank:<br> <span class="lastContestRank" id="lastContestRank" style="color: black;font-size: 25px;">(Last Contest Rank)</span>
        <br><br>
        <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">Total Contests Given</div>
            <div class="card-body">
                <h5 class="card-title" id="totalContests" style="font-size: 25px;">(total)</h5>
                <p class="card-text" id="extraComment">(Comments)</p>
            </div>
        </div>
        <br>
        <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">Your Highest Rating</div>
            <div class="card-body">
                <h5 class="card-title" id="maxRating" style="font-size: 25px;">(rating)</h5>
                <p class="card-text" id="maxRank">(rank)</p>
            </div>
        </div>
        <br><br>
        <div id="chart_div"></div>
    </center>

    <!-- table for showing data -->


    <script>
        const time = new Date();
        const curr_time = parseInt(time.getHours());
        if(curr_time>=4 && curr_time<12){
            document.getElementById("greeting").innerHTML = "Good Morning!";
        }
        else if(curr_time>=12&&curr_time<18){
            document.getElementById("greeting").innerHTML = "Good Afternoon!";
        }
        else if(curr_time>=18&&curr_time<22){
            document.getElementById("greeting").innerHTML = "Good Evening!";
        }
        else{
            document.getElementById("greeting").innerHTML = "Good Night!";
        }
    </script>
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