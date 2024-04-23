<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Shop Management</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }
        footer.site-footer {
            background-color:#EDA43D;
            color: white;
            padding:45px 0 20px;
            font-size:15px;
            line-height:24px;
        }
        footer.site-footer hr {
            border-top-color:white;
            opacity:0.5
        }
        footer.site-footer hr.small {
            margin:20px 0
        }
        footer.site-footer h6 {
            color:#fff;
            font-size:16px;
            text-transform:uppercase;
            margin-top:5px;
            letter-spacing:2px
        }
        footer.site-footer a {
            color:white;
        }
        footer.site-footer a:hover {
            color:#3366cc;
            text-decoration:none;
        }
        footer.site-footer .footer-links {
            padding-left:0;
            list-style:none
        }
        footer.site-footer .footer-links li {
            display:block
        }
        footer.site-footer .footer-links a {
            color:#737373
        }
        footer.site-footer .footer-links a:active,
        footer.site-footer .footer-links a:focus,
        footer.site-footer .footer-links a:hover {
            color:#3366cc;
            text-decoration:none;
        }
        footer.site-footer .footer-links.inline li {
            display:inline-block
        }
        footer.site-footer .social-icons {
            text-align:right
        }
        footer.site-footer .social-icons a {
            width:40px;
            height:40px;
            line-height:40px;
            margin-left:6px;
            margin-right:0;
            border-radius:100%;
            background-color:#EDA43D; 
        }
        footer.site-footer .social-icons a i {
            color: white; }
        footer.site-footer .copyright-text {
            margin:0
        }
        @media (max-width:991px) {
            footer.site-footer [class^=col-] {
                margin-bottom:30px
            }
        }
        @media (max-width:767px) {
            footer.site-footer {
                padding-bottom:0
            }
            footer.site-footer .copyright-text, footer.site-footer .social-icons {
                text-align:center
            }
        }
        .social-icons {
            padding-left:0;
            margin-bottom:0;
            list-style:none
        }
        .social-icons li {
            display:inline-block;
            margin-bottom:4px
        }
        .social-icons li.title {
            margin-right:15px;
            text-transform:uppercase;
            color:#96a2b2;
            font-weight:700;
            font-size:13px
        }
        .social-icons a{
            background-color:#EDA43D;
            color:#818a91;
            font-size:16px;
            display:inline-block;
            line-height:44px;
            width:44px;
            height:44px;
            text-align:center;
            margin-right:8px;
            border-radius:100%;
            -webkit-transition:all .2s linear;
            -o-transition:all .2s linear;
            transition:all .2s linear
        }
        .social-icons a:active,.social-icons a:focus,.social-icons a:hover {
            color:#fff;
            background-color:#EDA43D
        }
        .social-icons.size-sm a {
            line-height:34px;
            height:34px;
            width:34px;
            font-size:14px
        }
        .social-icons a.facebook:hover {
            background-color:#3b5998
        }
        .social-icons a.twitter:hover {
            background-color:#00aced
        }
        .social-icons a.linkedin:hover {
            background-color:#007bb6
        }
        .social-icons a.dribbble:hover {
            background-color:#ea4c89
        }
        @media (max-width:767px) {
            .social-icons li.title {
                display:block;
                margin-right:0;
                font-weight:600
            }
        }
    </style>
</head>
<body>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>About</h6>
                    <p class="text-justify">Welcome to this site, your one-stop destination for all your sweet cravings! At Sweet Shop Management, we understand the joy of indulging in delicious sweets and desserts, which is why we've curated a wide range of mouthwatering treats just for you</p>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p class="copyright-text">Copyright &copy; 2024 All Rights Reserved by 
                        <a href="#">Sweet Shop</a>.
                    </p>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="social-icons">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>   
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
