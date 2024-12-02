<!DOCTYPE html>
<html>
<head>
    <title>Footer Design</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        footer {
            background-color: black;
            color: white;
            padding: 30px 0;
            font-family: Arial, sans-serif;
            text-align: center; /* Centers all text in the footer */
        }

        footer h3 {
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
        }

        .contact-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
        }

        .contact-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contact-item .icon-container {
            background-color: #0077b5;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .contact-item .icon-container i {
            color: white;
            font-size: 30px;
            transition: transform 0.3s;
        }

        .contact-item .icon-container:hover i {
            transform: scale(1.1);
        }

        .contact-item p {
            margin-top: 10px;
            font-weight: bold;
            text-align: center;
        }

        .email-container {
            margin-top: 20px;
            font-size: 14px;
            line-height: 1.6;
            font-weight: bold; /* Makes the email text bold */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
                gap: 20px;
            }

            footer h3 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
<footer>
    <h3>Contact us through:</h3>
    <div class="contact-container">
        <div class="contact-item">
            <div class="icon-container">
                <i class="fa fa-linkedin"></i>
            </div>
            <p>Adyasha Jha</p>
        </div>
        <div class="contact-item">
            <div class="icon-container">
                <i class="fa fa-linkedin"></i>
            </div>
            <p>Ipsita Prusty</p>
        </div>
        <div class="contact-item">
            <div class="icon-container">
                <i class="fa fa-linkedin"></i>
            </div>
            <p>Saishrita Mohapatra</p>
        </div>
    </div>
    <div class="email-container">
        <p>Email:</p>
        <p>ucse22003@stu.xim.edu.in (Adyasha Jha)</p>
        <p>ucse22051@stu.xim.edu.in (Ipsita Prusty)</p>
        <p>ucse22053@stu.xim.edu.in (Saishrita Mohapatra)</p>
    </div>
</footer>
</body>
</html>
