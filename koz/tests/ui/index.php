<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <title></title>
    <meta charset="utf-8" />

    <!-- https://developer.mozilla.org/pt-PT/docs/utilizando_meta_tags -->
    <!-- https://developer.mozilla.org/pt-BR/docs/Mozilla/Mobile/Viewport_meta_tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="stylesheet" href="ui/css/fonts/font-awesome-4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700" type="text/css">
    <style type="text/css">
        /**
         * Reset
         */
        @charset 'utf-8';
        /*
        html5doctor.com Reset Stylesheet
        v1.6.1
        Last Updated: 2010-09-17
        Author: Richard Clark - http://richclarkdesign.com
        Twitter: @rich_clark
        */

        * {
            margin:0;
            padding:0;
            border:0;
            outline:0;
            font-size:100%;
            vertical-align: baseline;
            background: transparent;
            list-style: none;
        }

        body {
            line-height:1;
        }

        article,aside,details,figcaption,figure,
        footer,header,hgroup,menu,nav,section {
            display:block;
        }

        blockquote, q {
            quotes:none;
        }

        blockquote:before, blockquote:after,
        q:before, q:after {
            content:'';
            content:none;
        }

        a {
            margin:0;
            padding:0;
            font-size:100%;
            vertical-align:baseline;
            background:transparent;
            text-decoration: none;
            color: #000;
        }

        /* change colours to suit your needs */
        ins {
            background-color:#ff9;
            color:#000;
            text-decoration:none;
        }

        /* change colours to suit your needs */
        mark {
            background-color:#ff9;
            color:#000;
            font-style:italic;
            font-weight:bold;
        }

        del {
            text-decoration: line-through;
        }

        abbr[title], dfn[title] {
            border-bottom:1px dotted;
            cursor:help;
        }

        table {
            border-collapse:collapse;
            border-spacing:0;
        }

        /* change border colour to suit your needs */
        hr {
            display:block;
            height:1px;
            border:0;
            border-top:1px solid #cccccc;
            margin:1em 0;
            padding:0;
        }
        input, select {
            vertical-align:middle;
        }

        /**
         * Style
         */
        body {
            font-family: 'Open Sans', sans-serif;
            color: #333;
            font-size: 13px;
            padding-bottom: 30px;
        }

        header {
            padding: 10px 0;
        }

        .red {
            color: rgb(255, 68, 0);
        }

        .green {
            color: rgb(0, 205, 150);
        }

        .gray {
            color: #7d7d7d;
        }

        h1 {
            font-size: 25px;
        }

        .right {
            float: right;
        }

        .fa {
            font-size: 20px;
        }

        .wrapper {
            width: 90%;
            margin: 0 auto;
        }

        .wrapper > header {
            margin-bottom: 40px;
        }

        .wrapper > header .logo {
            font: 15px 'Arial';
            display: block;
        }

        .wrapper > header .first {
            display: inline-block;
            text-indent: -1px;
            font-size: 30px;
            font-weight: bold;
        }

        .graphics {

        }

        .container-test {
            overflow: hidden;
            margin-top: 10px;
            border: solid 1px #ddd;
        }

        .container-test:first-child {
            margin-top: 0px;
        }

        .container-test > header {
            position: relative;
            z-index: 1;
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .container-test > header > h1{
            font-size: 18px;
            font-weight: normal;
        }

        .container-test > header > .fa {
            margin: 0px 10px;
            width: 20px;
            display: none;
        }

        .container-test.open > header > .fa-plus {
            display: none;
        }

        .container-test.open > header > .fa-minus, .container-test > header > .fa-plus, .container-test[u-error] > header > .fa-times, .container-test[u-pass] > header > .fa-check {
            display: inline-block;
        }

        .container-test h1 {
            display: inline-block;
        }

        .container-test .content {
            position: relative;
            z-index: 0;
            padding: 0 25px;
            height: 0px;

            -webkit-transition: all .4s ease-out;
            -o-transition: all .4s ease-out;
            transition: all .4s ease-out;
        }

        .container-test.open > header {
            border-bottom: solid 1px #ddd;
        }

        .container-test.open > .content {
            padding: 25px;
            height: auto;
        }

        .container-test .content > div > .fa {
            display: none;
            font-size: 14px;
            position: relative;
            top: -1px;
        }

        .container-test .content > div {
            font-size: 16px;
            padding: 5px 0;
            border-top: solid 1px #ddd;
        }

        .container-test .content > div[u-error] {
            cursor: pointer;
        }

        .container-test .content > [u-error] > .fa-times {
            display: inline-block;
        }

        .container-test .content > [u-pass] > .fa-check {
            display: inline-block;
        }

        .container-test .content > [u-error] > .hover-legend {
            display: none;
        }

        .container-test .content > [u-error]:hover > .hover-legend {
            display: inline-block;
            font-size: 12px;
            position: relative;
            top: -2px;
            margin-left: 10px;
            color: #999;
        }

        .container-test .content > div.open .snippet {
            height: 140px;
        }

        .container-test .content > div:first-child {
            border-top: solid 0px;
        }

        .snippet {
            position: relative;
            top: 5px;
            overflow: hidden;
            height: 0px;

            -webkit-transition: height .4s ease-out;
            -o-transition: height .4s ease-out;
            transition: height .4s ease-out;
        }

        .snippet p {
            font-family: 'Courier New';
            font-size: 13px !important;
        }

        .snippet p span {
            background-color: #f5f5f5;
            width: 35px;
            display: inline-block;
            text-align: right;
            padding: 5px 10px;
        }

        .snippet .highlight {
            background-color: rgb(254, 255, 202);
        }

        .snippet .highlight span {
            background-color: #F3F5BF;
        }

    </style>
</head>
<body>

    <!-- Your code begin here -->
    <div class="wrapper">
        <header>
            <h1>
                <a class="logo" href=""><span class="first">U.PHP</span><br />Unit Test Library</a>
            </h1>
        </header>

        <section id="main">
            <!-- <section class="graphics">
                <header>
                    <h1>Graphics</h1>
                </header>
                <section class="content"></section>
            </section> -->

            <section class="tests">
                <header>
                    <h1>Report</h1>
                </header>

                <?php foreach ($reports['reports'] as $report): ?>
                <?php echo UCore::view('ui/group.php', ['reports' => $report]); ?>
                <?php endforeach; ?>
            </section>
        </section>
        <footer class="main-footer">

        </footer>
    </div>

    <script>
        var groups = document.querySelectorAll('.container-test');
        var errorsItems = document.querySelectorAll('.container-test > .content > div');
        var i;
        var to;

        for (i = 0; i < groups.length; i++) {
            groups[i].querySelector('header').addEventListener('click', function(e){
                var group = e.currentTarget.parentNode;
                var section = group.querySelector('section');

                if (group.classList.contains('open')) {
                    section.style.height = (section.scrollHeight - 50)+'px';
                    setTimeout(function(section){ section.style.height = '0px'; }, 0, section);
                    group.classList.remove('open');
                } else {
                    group.classList.add('open');
                    section.style.height = section.scrollHeight+'px';

                    section.addEventListener('transitionend', function(e){
                        if (e.currentTarget.style.height !== '0px') {
                            e.currentTarget.style.height = 'auto';
                        }
                    });
                }
            });
        }

        for (i = 0; i < errorsItems.length; i++) {
            errorsItems[i].addEventListener('mouseover', function(e){
                var item = e.currentTarget;

                clearTimeout(to);
                to = setTimeout(function(item){ item.classList.add('open'); }, 400, item);
            });

            errorsItems[i].addEventListener('mouseleave', function(e){
                var item = e.currentTarget;

                clearTimeout(to);
                item.classList.remove('open');
            });
        }
    </script>
</body>
</html>
