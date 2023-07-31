<div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa fa-graduation-cap text-primary icon-lg"></i>Lista de alumnos</h4>
                    
                      <!--tabla de cursos-->
            <style type="text/css">
                .tooltipjose {
                
                    color: black;
                    outline: none;
                    cursor: help;
                    text-decoration: none;
                    position: relative;
                }
                
                .tooltipjose span {
                    margin-left: -999em;
                    position: absolute;
                }
                
                .tooltipjose:hover span {
                    border-radius: 5px 5px;
                    -moz-border-radius: 5px;
                    -webkit-border-radius: 5px;
                    box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);
                    -webkit-box-shadow: 5px 5px rgba(0, 0, 0, 0.1);
                    -moz-box-shadow: 5px 5px rgba(0, 0, 0, 0.1);
                    position: absolute;
                    left: 1em;
                    top: 2em;
                    z-index: 99;
                    margin-left: 0;
                    width: 380px;
                }
                
                .tooltipjose:hover img {
                    border: 0;
                    margin: -10px 0 0 -55px;
                    float: left;
                    position: absolute;
                }
                
                .tooltipjose:hover em {
                    
                    font-weight: bold;
                    display: block;
                    padding: 0.2em 0 0.6em 0;
                }
                
                .custom {
                    padding: 0.5em 0.8em 0.8em 2em;
                }
                
                * html a:hover {
                    background: red;
                }
                
                .info {
                    background: white;
                    border: 1px solid #2BB0D7;
                }
            </style>

                    
                 <hr>
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-hover" id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead class="bg bg-primary text-white">
                                    <tr>
                                        <th>N°</th>
                                     
                                        <th>Alumno</th>
                                        <th>Curso</th>
                                   
                                    
                                       
                                       
                                      

                                    </tr>
                                </thead>
                                <tbody>

                                    <!--resgistro de un alumno-->
                                    <?php
                                    require_once("./controladores/clienteControlador.php");
                                    $insCurso = new clienteControlador();
                                    echo $insCurso->alumno_total_controlador();
                                    ?>

                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>