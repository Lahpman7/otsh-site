<!DOCTYPE html>
<html lang="en" >
    <?php session_start();?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Matching</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="../js/jquery-3.1.1.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
                <li><a href="../index.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
          </ul>
<body>

    <!-- Page Content -->
    <div class="container">

        <!-- Heading Row -->
        <div class="row">

            </div>
            <!-- /.col-md-8 -->
            <div class="col-md-6 ">
                <br>Logged in as <?php echo $_SESSION['emails'];?></br>
                <h1>Pass Share</h1>
                <p>Click below to find pass sharing (retrieve a pass from a user done with pass)</p>
                <div class="row">
                    <form class = "dayForm">

                        <div class="col-md-6">
                          <select class="form-control" id="daySelect" name = "daySelect" required>
                                <option value = "Monday">Monday</option>
                                <option value = "Tuesday">Tuesday</option>
                                <option value = "Wednesday">Wednesday</option>
                                <option value = "Thursday">Thursday</option>
                                <option value = "Friday">Friday</option>
                          </select>
                        </div>

                        <div class="col-md-6">
                            <input type="button" class="btn btn-default" name="submit" id="submit" value="Find a share match!" />
                        </div>

                </div>
                <div class = "row">
                    <div class="col-md-6">
                        <input id = "usr_time" class = "form-control" type="time" name="usr_time" required>
                    </div>


                    </form>
                    <!--Entd of pass-share form-->
                </div>
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <br>
            <div class="col-md-1">&nbsp</div>
            <div id = "message" class="col-md-8">Sorry! We haven't found any matches for you! Check back later or press the button to try again</div>
        </div>
        <div class = "row">
            <div class ="col-md-1">
            </div>
            <div id = "shares" class = "col-md-8">
                Click <b>"Find a share match"</b> for results!
            </div>
    </div>
    <!-- /.container -->

    <script>
        function emailUser(email , name){
            console.log(email);
            $.ajax({
                url: "email.php",
                method: "POST",
                data: {
                       email : email,
                       name : name
                      },
                success: function(data) {
                    //$('form').trigger("reset");
                    $('#message').fadeIn().html(data);
                    setTimeout(function() {
                        $('#return').fadeOut("slow");
                    }, 12000);
                }
            });
        }
        $( document ).ready(function() {
            $.ajax({
                url: "searchmatch.php",
                method: "POST",
                data: "",
                success: function(data) {
                    //$('form').trigger("reset");
                    $('#message').fadeIn().html(data);
                    setTimeout(function() {
                        $('#return').fadeOut("slow");
                    }, 12000);
                }
            });
            $('#submit').click(function() {
                //need to validate (make sure everything is filled in)
                var isValid = true;
                if($('#daySelect').val() =='' || $('#usr_time').val() ==''){
                    isValid = false;
                }
                if(isValid == true){

                    $.ajax({
                    url: "sharematch.php",
                    method: "POST",
                    data: $(":input").not("#submit").serialize(),
                    success: function(data) {
                        //$('form').trigger("reset");
                        $('#shares').fadeIn().html(data);
                        setTimeout(function() {
                            $('#return').fadeOut("slow");
                        }, 12000);
                    }
                });
            }
            else{
                alert("Please fill out all fields before searching for a pass share!");
            }

            });



        });
    </script>

</body>

</html>
