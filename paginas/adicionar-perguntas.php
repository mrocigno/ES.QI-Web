<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata" />
        <link rel="stylesheet" href="../css/default_css.css"/>
        <script language="javascript" type="text/javascript">
            $(document).ready(function() {
                function msg(mensgem, tempo, tipo){
                    switch(tipo){
                        case 0:
                            $("#msgError").css("border-top", "#f00 solid 2px");
                            break;
                        case 1:
                            $("#msgError").css("border-top", "#0f0 solid 2px"); 
                            break;
                        default :
                            $("#msgError").css("border-top", "#f00 solid 2px");
                            break;
                    }
                    
                    $("#msgError").css("display", "block");
                    $("#msgError").html(mensgem);
                    setTimeout(function(){
                        $("#msgError").css("display", "none");
                    }, tempo)
                }
                
                $("#sltImg").change(function(e) {
                    for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                        var file = e.originalEvent.srcElement.files[i];
                        var extPermitidas = ['jpg', 'png', 'gif'];
                        
                        var reader = new FileReader();
                        reader.onloadend = function() {
                            if(typeof extPermitidas.find(function(ext){ return file.name.split('.').pop() == ext; }) == 'undefined'){
                                $("#fakeSelect").attr("class", "btn btn-danger");
                                msg("Você deve selecionar uma imagem", 3000);
                                setTimeout(function(){
                                    $("#fakeSelect").attr("class", "btn btn-success");
                                }, 1000)
                            }else{
                                $("#imgPreview").attr("src", reader.result);
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
                
                $("#fakeSelect").click(function(){
                    $("#sltImg").click();
                });
                
                function verifieEmptyField(campo){
                    if(campo.val() === ""){
                        campo.css("border", "#f00 solid 1px");
                        return false;
                    }else{
                        campo.css("border", "lightgray solid 1px");
                        return true;
                    }
                }
                
                $(".form-control").blur(function(){
                    verifieEmptyField($(this));
                });
                
                $("#salvar").click(function(){
                    var ok = [
                        verifieEmptyField($("#iptTitulo")),
                        verifieEmptyField($("#iptPergunta")),
                        verifieEmptyField($("#iptCerta")),
                        verifieEmptyField($("#iptErrada1")),
                        verifieEmptyField($("#iptErrada2")),
                        verifieEmptyField($("#iptErrada3"))
                    ];
                    
                    if(ok.every(function(item){return item;})){
                        $("#form").submit();
                    }else{
                        msg("Preencha os campos destacados", 3000);
                    }
                });
                
                <?php 
                    if(isset($_GET["id"]) && $_GET["id"] != ""){
                        echo "msg(\"Pergunta adcionada com sucesso!\", 3000, 1);";
                    }
                ?>
                
            });
        </script>
    </head>
    <body>
        <?php include '../utils/header.php'; ?> 
        <main>
            <form id="form" enctype="multipart/form-data" action="../actions/salvar_pergunta.php" style="position: relative; padding-left: 15px; padding-right: 15px;" method="POST">
                <div class="row">
                    <div class="col-md-12" style="padding: 10px 15px">
                        <center>
                            <label for="iptTitulo">Informe o título da pergunta</label>
                            <br>
                            <input class="form-control" type="text" name="iptTitulo" id="iptTitulo" value="" maxlength="100" style="width: 100%; text-align: center"/>
                        </center>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="padding-top: 10px; padding-bottom: 10px">
                        <label for="iptTitulo">Pergunta</label>
                        <br>
                        <textarea class="form-control" name="iptPergunta" id="iptPergunta" style="width: 100%; height: 108px"></textarea>
                    </div>
                    <div class="col-md-6" style="padding-top: 10px; padding-bottom: 10px">
                        <center>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="iptCerta"><b>Resposta certa</b></label>
                                    <br>
                                    <input class="form-control" type="text" name="iptCerta" id="iptCerta" value="" />
                                </div>
                                <div class="col-md-6">
                                    <label for="iptCerta">Resposta errada</label>
                                    <br>
                                    <input class="form-control" type="text" name="iptErrada1" id="iptErrada1" value="" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="iptCerta">Resposta errada</label>
                                    <br>
                                    <input class="form-control" type="text" name="iptErrada2" id="iptErrada2" value="" />
                                </div>
                                <div class="col-md-6">
                                    <label for="iptCerta">Resposta errada</label>
                                    <br>
                                    <input class="form-control" type="text" name="iptErrada3" id="iptErrada3" value="" />
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="padding-top: 10px; padding-bottom: 10px;">
                        <center>
                            <img id="imgPreview" src="../img/logo.jpg" style="border: #000 solid 2px;"/>
                            <input type="button" value="Selecione uma imagem" class="btn btn-success" id="fakeSelect" />
                            <input type="button" value="Concluir" id="salvar" class="btn btn-success" />
                            <input id="sltImg" type="file" name="sltImg" value="" hidden="true"/>
                        </center>
                    </div>
                </div>
            </form>
        </main>
        <div id='msgError' style='height: 60px; width: 100%; position: fixed; bottom: 0; line-height: 60px; text-align: center; border-top: #f00 solid 2px; display: none; background-color: white'>teste</div>
    </body>
</html>