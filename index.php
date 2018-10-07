<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata" />
        <link rel="stylesheet" href="css/customScroll.css"/>
        <link rel="stylesheet" href="css/cometa.css"/>
        <script>
            $(function(){
                $("#layer1").load(function(){
                    alert("teste");
                });
                $("#space").scroll(function(){
                    if($("#space").scrollTop() > $(document).height()){
                        $("#header").addClass("header-fixed");
                        $("#header").css("top", $("#space").scrollTop() - $(document).height());
                    }else{
                        $("#header").removeClass("header-fixed");
                        $("#header").css("top",0);
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="space">
            <div class="layer" id="layer1"></div>
            <div class="layer" id="layer2"></div>
            <div class="layer" id="layer3">
                
            </div>
            <div class="layer" id="layer4"></div>
            <div class="cometa c1"></div>
            <div class="cometa c2"></div>
            <div class="cometa c3"></div>
            <div class="cometa c4"></div>
            <div class="cometa c5"></div>
            <div class="cometa c6"></div>
            <div class="layer" id="layer5"></div>
            <div class="layer" id="layer6"></div>
            <div class="layer" id="layer7"></div>
            <div class="layer" id="layer8"></div>
            <div class="layer" id="layer9">
                <!--<div id="myPhoto"></div>-->
            </div>
            <div style="background:rgb(41,9,3);display:block;position:absolute;top:100%;left:0;right:0;height:2000px;z-index:2;">
                <!--Todo o resto do site deve ser inserido dentro desta DIV-->
                <?php include './utils/header.php';?>
            </div>
        </div>
    </body>
</html>
