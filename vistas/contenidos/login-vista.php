

<div class="container-scroller">

    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">

        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">

            <div class="row w-100">

                <div class="col-lg-4 mx-auto">

                    <div class="auto-form-wrapper">



                        <form action="" method="POST" class="forms-sample">


                   
       
                            <h3  class="text-center">Login </h3><br>
                            <p>SERVER 2.0</p>

                            <div class="form-group">

                                <label class="label">Usuario</label>

                                <div class="input-group">

                                    <input required=""  type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">

                                    <div class="input-group-append">

                                        <span class="input-group-text">

                                            <i class="mdi mdi-check-circle-outline"></i>

                                        </span>

                                    </div>

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="label">Contraseña</label>

                                <div class="input-group">

                                    <input required="" type="password" name="pass" id="pass" class="form-control" placeholder="*********">

                                    <div class="input-group-append">

                                        <span class="input-group-text">

                                            <i class="mdi mdi-check-circle-outline"></i>

                                        </span>

                                    </div>

                                </div>

                            </div>

                            <div class="form-group">

                                <button class="btn btn-primary submit-btn btn-block">Iniciar Sesion</button>

                            </div>

                      

                           

                       

                        </form>

                    </div>

                    <ul class="auth-footer">



                    </ul>

                    <p class="footer-text text-center">copyright © 2019 Cersa- ÁREA DE SISTEMAS.<BR> Todos los derechos reservados.</p>

                </div>

            </div>

        </div>

        <!-- content-wrapper ends -->

    </div>

    <!-- page-body-wrapper ends -->

</div>

<?php

 if(isset($_POST['usuario']) && isset($_POST['pass'])){

    require_once("./core/configgeneral.php");

     require_once("./controladores/loginControlador.php");

     $instanciaLogin= new loginControlador();

     echo   $instanciaLogin->iniciar_sesion_controlador();

 }

?> 
<script>
var Snowflake = (function() {

var flakes;
var flakesTotal = 250;
var wind = 0;
var mouseX;
var mouseY;

function Snowflake(size, x, y, vx, vy) {
    this.size = size;
    this.x = x;
    this.y = y;
    this.vx = vx;
    this.vy = vy;
    this.hit = false;
    this.melt = false;
    this.div = document.createElement('div');
    this.div.classList.add('snowflake');
    this.div.style.width = this.size + 'px';
    this.div.style.height = this.size + 'px';
}

Snowflake.prototype.move = function() {
    if (this.hit) {
        if (Math.random() > 0.995) this.melt = true;
    } else {
        this.x += this.vx + Math.min(Math.max(wind, -10), 10);
        this.y += this.vy;
    }

    // Wrap the snowflake to within the bounds of the page
    if (this.x > window.innerWidth + this.size) {
        this.x -= window.innerWidth + this.size;
    }

    if (this.x < -this.size) {
        this.x += window.innerWidth + this.size;
    }

    if (this.y > window.innerHeight + this.size) {
        this.x = Math.random() * window.innerWidth;
        this.y -= window.innerHeight + this.size * 2;
        this.melt = false;
    }

    var dx = mouseX - this.x;
    var dy = mouseY - this.y;
    this.hit = !this.melt && this.y < mouseY && dx * dx + dy * dy < 2400;
};

Snowflake.prototype.draw = function() {
    this.div.style.transform =
    this.div.style.MozTransform =
    this.div.style.webkitTransform =
        'translate3d(' + this.x + 'px' + ',' + this.y + 'px,0)';
};

function update() {
    for (var i = flakes.length; i--; ) {
        var flake = flakes[i];
        flake.move();
        flake.draw();
    }
    requestAnimationFrame(update);
}

Snowflake.init = function(container) {
    flakes = [];

    for (var i = flakesTotal; i--; ) {
        var size = (Math.random() + 0.2) * 12 + 1;
        var flake = new Snowflake(
            size,
            Math.random() * window.innerWidth,
            Math.random() * window.innerHeight,
            Math.random() - 0.5,
            size * 0.3
        );
        container.appendChild(flake.div);
        flakes.push(flake);
    }

container.onmousemove = function(event) {
      mouseX = event.clientX;
      mouseY = event.clientY;
      wind = (mouseX - window.innerWidth / 2) / window.innerWidth * 6;
  };

  container.ontouchstart = function(event) {
      mouseX = event.targetTouches[0].clientX;
      mouseY = event.targetTouches[0].clientY;
      event.preventDefault();
  };

  window.ondeviceorientation = function(event) {
      if (event) {
          wind = event.gamma / 10;
      }
  };

  update();
};

return Snowflake;

}());

window.onload = function() {
setTimeout(function() {
  Snowflake.init(document.getElementById('snow'));
}, 500);
}</script>