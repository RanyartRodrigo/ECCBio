<?php
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="dist/app-v1.css" rel="stylesheet" media="all">
<script src="dist/app-v1.js"></script>
<div id="myDiv3"></div>
                                <script>
                                        setTimeout(function(){
                                        $.ajax({
                                            url : "http://www.wegp.unam.mx/admin/Conabio2/graficaSweet/grafica.php",
                                                dataType : "jsonp",
                                                data: {
                                                        format: "json"
                                                },
                                                type:"POST",
                                                success: function(json) {
                                                        var id="myDiv3";
                                                        $("#"+id).html("");
                                                        $("#"+id).html(json);
                                                }
                                        });
                                        },4000);
                                </script>

