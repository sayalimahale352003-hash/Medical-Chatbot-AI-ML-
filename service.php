<?php
session_start();
$page = 'service'; // To set active link in navbar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Overview</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<div class="container text-center text-white py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-4">Project Overview</h1>

            <!-- Symptom Diagnosis (Text on the left, Image on the right) -->
            <div class="row mt-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="display-5">Symptom Diagnosis</h2>
                    <p class="lead">"Symptom Diagnosis involves developing machine learning models to accurately interpret and diagnose user-reported symptoms. These models are trained on medical datasets and continuously refined to ensure reliable results. The goal is to provide users with timely, preliminary diagnoses that help guide their next steps in seeking medical care."</p>
                </div>
                <div class="col-lg-6">
                    <img src="human.jpg" alt="Digital Health Assistant" class="img-fluid">
                </div>
            </div>

            <!-- Doctor Recommendation System (Image on the left, Text on the right) -->
            <div class="row mt-5 align-items-center">
                <div class="col-lg-6">
                    <img src="medi.jpg" alt="Digital Health Assistant" class="img-fluid">
                </div>
                <div class="col-lg-6">
                    <h2 class="display-5">Doctor Recommendation System</h2>
                    <p class="lead">"Doctor Recommendation System uses AI to suggest suitable doctors based on diagnosed symptoms. By analyzing user inputs and the diagnosed conditions, the system matches patients with healthcare professionals who specialize in their specific needs, enhancing the process of finding appropriate medical care."</p>
                </div>
            </div>

            <!-- Natural Language Processing (Text on the left, No Image) -->
            <div class="row mt-5 align-items-center">
                <div class="col-lg-12">
                    <h2 class="display-5">Natural Language Processing (NLP)</h2>
                    <p class="lead">"Natural Language Processing (NLP) is used to understand and interpret user-reported symptoms by analyzing the text input. NLP techniques extract and process symptom descriptions, enabling the system to accurately interpret diverse ways users describe their health issues and improve overall diagnosis accuracy."</p>
                </div>
            </div>

            <!-- User Interaction (Image on the left, Text on the right) -->
            <div class="row mt-5 align-items-center">
                <div class="col-lg-12">
                    <h2 class="display-5">User Interaction</h2>
                    <p class="lead">"User Interaction focuses on enhancing the user experience through AI-driven tools such as chatbots and interactive interfaces. These tools help users by guiding them through symptom input and providing feedback, making the process of obtaining diagnoses and recommendations more intuitive and engaging."</p>
                </div>
            </div>

            <!-- Continuous Improvement (Text on the left, Image on the right) -->
            <div class="row mt-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="display-5">Continuous Improvement</h2>
                    <p class="lead">"Continuous Improvement involves regularly updating and refining AI models with new data and user feedback. This ensures that the system remains accurate, relevant, and effective over time, incorporating enhancements and new features to better meet user needs."</p>
                </div>
                <div class="col-lg-6">
                    <img src="improve.jpg" alt="Continuous Improvement" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>