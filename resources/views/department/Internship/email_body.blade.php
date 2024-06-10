<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <style>
            body{
            font-family: system-ui;
            }
            .center {
            text-align: center;
            }
            .container{
            margin: 30px 0px;
            }
            a {
            text-decoration: none;
            }
        </style>


        <title>Document</title>
    </head>
    <body>





        <section class="container">
            <div class="center" id="mail-title">
            <h1>Weekly Internship Report</h1>
            <p class="lead">University of Jordan - KASIT School</p>
            </div>

            <div class="container" id="mail-body">
                <p>
                    Hi Mr.{{ $details['supervisor'] }}, you are a superviser of {{ $details['student'] }} in Hoho {{ $details['company_name'] }} company.
                </p>
                <p>
                    The following form is weekly following form for {{ $details['week'] }} week. <br>
                    Note: you can submit the form many times.
                </p>

                <a href="{{ route('weekly.following-form', $details['student_username']) }}">Weekly Following Form</a>
            </div>

            <div class="" id="mail-footer">
                <span>Thank you.</span>
            </div>
        </section>




    </body>
</html>