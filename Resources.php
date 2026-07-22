<?php
session_start();
$page = 'team'; // To set active link in navbar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Team</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container text-center text-white py-5">
        <h1 class="display-4">Project Team</h1>

        <!-- Project Team Members -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <h2 class="display-5">Project Team Members</h2>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Yashashree Kamble</td>
                            <td><a href="mailto:yashashree.kamble@cumminscollege.in" class="text-white">yashashree.kamble@cumminscollege.in</a></td>
                            <td>Member</td>
                        </tr>
                        <tr>
                            <td>Pratibha Lohakare</td>
                            <td><a href="mailto:pratibha.lohakare@cumminscollege.in" class="text-white">pratibha.lohakare@cumminscollege.in</a></td>
                            <td>Member</td>
                        </tr>
                        <tr>
                            <td>Sayali Mahale</td>
                            <td><a href="mailto:sayali.mahale@cumminscollege.in" class="text-white">sayali.mahale@cumminscollege.in</a></td>
                            <td>Member</td>
                        </tr>
                        <tr>
                            <td>Srushti More</td>
                            <td><a href="mailto:srushti.more@cumminscollege.in" class="text-white">srushti.more@cumminscollege.in</a></td>
                            <td>Member</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Development and Design Team -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <h2 class="display-5">Development and Design</h2>
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <h4 class="card-title">Software Developers</h4>
                                <p class="card-text"><strong>Roles:</strong> Coding, testing, and debugging of application functionalities. Ensuring integration with AI/ML models.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <h4 class="card-title">Data Scientists</h4>
                                <p class="card-text"><strong>Roles:</strong> Data preprocessing, model training, and evaluation. Ensuring data quality and model performance.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <h4 class="card-title">Designers</h4>
                                <p class="card-text"><strong>Roles:</strong> Creating user-friendly designs, improving user experience, and ensuring accessibility.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <h4 class="card-title">Testers</h4>
                                <p class="card-text"><strong>Roles:</strong> Performing unit testing, integration testing, and ensuring the application meets quality standards.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>